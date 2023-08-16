/*
 *  SIKTEC Tabbed Product Gallery - v4.0.0
 *  Author: Shlomo Hassid.
 *  Contact: siktec.lab@gmail.com
 */
(function ($, window, document, undefined) {
  "use strict";

  // Create the defaults once
  var pluginName = "productGallery";
  var defaults = {
    thumbs: {
      scrollable: true,
      keepWidth: false
    },
    onSwitch: function (obj, prev, current) {
      //console.log(prev, current);
    },
    onLoad: function (obj) {
      //console.log("loaded", obj);
    },
    onRemove: function (obj, img) {
      //console.log("remove", obj, img);
    },
    onAdd: function (obj, img) {
      //console.log("added", obj, img);
    },
    zoom: {
      enable: true,
      scale: 1.5,
      callback: false,
      target: false,
      duration: 120,
      on: "mouseover", // other options: grab, click, toggle
      touch: true, // enables a touch fallback
      onZoomIn: false,
      onZoomOut: false,
      magnify: 1
    }
  };

  // The actual plugin constructor
  function ProductGallery(element, options) {
    this.element = element;
    this.$element = $(element);
    this.settings = $.extend(true, {}, defaults, options);
    this._defaults = defaults;
    this._name = pluginName;
    this.parts = {
      container: null,
      currentContainer: null,
      currentImage: null,
      thumbsContainer: null,
      thumbsList: null
    };
    this.init();
  }

  // Avoid Plugin.prototype conflicts
  $.extend(ProductGallery.prototype, {
    init: function () {
      // Initialization logic here
      this.build();
      //callback:
      if (this.settings.onLoad instanceof Function) {
        this.settings.onLoad(this);
      }
    },
    build: function () {
      // Parts:
      this.parts.container = this.$element;
      this.parts.currentContainer = this.$element.find(
        ".gallery-current > ul "
      );
      this.parts.currentImage = this.$element
        .find(".gallery-current > ul > li > img")
        .eq(0);
      this.parts.thumbsContainer = this.$element.find(".gallery-thumbs");
      this.parts.thumbsList = this.$element.find(".gallery-thumbs > ul");

      //Validate:
      if (
        this.parts.currentContainer.length === 0 ||
        this.parts.thumbsContainer.length === 0 ||
        this.parts.thumbsList.length === 0
      ) {
        console.warn("Invalid HTML Structure");
        return;
      }

      //Load main images:
      this.parts.thumbsList.find("li > img").each((i, el) => {
        let full = $(el).data("full") ?? $(el).attr("src");
        this._addPrimary(full);
      });

      //Set displayed:
      this._addDisplayed();

      //Set sizes:
      this._setSizes();
      //Attach events:
      $(this.element).on("click", ".gallery-thumbs > ul > li > img", (e) =>
        this._clickSwitch(e)
      );
    },
    addImage: function (img, pos = -1) {
      let thumb = img[0];
      let full = img.length > 1 ? img[1] : img[0];
      let $img = $(`<li><img src='${thumb}' data-full='${full}' /></li>`);

      // add the thumb elements
      if (pos === 0) {
        this.parts.thumbsList.prepend($img);
      } else if (pos < 0) {
        this.parts.thumbsList.append($img);
      } else {
        let thumbs = this.parts.thumbsList.find("li > img");
        if (pos < thumbs.length) {
          $img.insertAfter(thumbs.eq(pos).parent());
        } else {
          this.parts.thumbsList.append($img);
        }
      }

      //add the full element:
      this._addPrimary(full);

      //Re-Displayed:
      this._addDisplayed();

      //callback:
      if (this.settings.onAdd instanceof Function) {
        this.settings.onAdd(this, img);
      }
    },
    addImages: function (images, pos = -1) {
      for (const img of images) {
        this.addImage(img, pos);
      }
    },
    removeImage: function (img) {
      let thumbs = this.parts.thumbsList.find("li > img");
      let ele = $();
      //Get the element:
      if (typeof img === "number" && img >= 0 && img < thumbs.length) {
        ele = thumbs.eq(img);
      } else if (typeof img === "string") {
        ele = thumbs
          .filter(function () {
            return $(this).attr("src") === img || $(this).data("full") === img;
          })
          .eq(0);
      }
      //Remove:
      if (ele.length) {
        //get primary:
        let thumbSrc = ele.attr("src");
        let fullSrc = ele.data("full") ?? ele.attr("src");
        let primary = this.parts.currentContainer.find(
          `li > img[src='${fullSrc}']`
        );

        primary.parent().trigger("zoom.destroy");
        primary.parent().remove();
        ele.parent().remove();
        //Re-Displayed:
        this._addDisplayed();
        //callback:
        if (this.settings.onRemove instanceof Function) {
          this.settings.onRemove(this, [thumbSrc, fullSrc]);
        }
      }
    },
    removeImages: function (images) {
      let sorted = images.sort(function (a, b) {
        return typeof b === "string" || typeof a === "string" ? b > a : b - a;
      });
      for (const img of sorted) {
        this.removeImage(img);
      }
    },
    clearAll: function () {
      let thumbs = this.parts.thumbsList.find("li > img");
      let _this = this;
      thumbs.each(function (i, e) {
        _this.removeImage(0);
      });
    },
    switchImage: function (to_img = 0) {
      // index or src
      let thumbs = this.parts.thumbsList.find("li > img");
      let thumb = $();
      if (typeof to_img === "number" && thumbs.length > to_img && to_img >= 0) {
        thumb = thumbs.eq(to_img);
      } else if (typeof to_img === "string") {
        thumb = thumbs
          .filter(function () {
            return (
              $(this).attr("src") === to_img || $(this).data("full") === to_img
            );
          })
          .eq(0);
      }
      //Set displayed:
      if (thumb.length) {
        thumbs.not(thumb).removeClass("displayed");
        thumb.addClass("displayed");
        let prev = this.parts.currentImage.attr("src");
        //Repaint:
        this._addDisplayed();
        //callback:
        if (this.settings.onSwitch instanceof Function) {
          this.settings.onSwitch(this, prev, thumb.attr("src"));
        }
      }
    },
    _clickSwitch: function (e) {
      let img = $(e.currentTarget);
      if (img.attr("src")) {
        this.switchImage(img.attr("src"));
      }
    },
    _addPrimary: function (src) {
      let $pri = $(`<li><img src='${src}' /></li>`);
      this.parts.currentContainer.append($pri);
      //Build zoomer if needed:
      if (this.settings.zoom.enable) {
        this._attachZoom($pri);
      }
    },
    _addDisplayed: function () {
      let thumb = this.parts.thumbsList.find("li > img.displayed");
      if (thumb.length == 0) {
        thumb = this.parts.thumbsList.find("li > img").eq(0);
      }
      let full = thumb.data("full");
      let thumbs = this.parts.thumbsList.find("li > img");
      thumbs.removeClass("displayed");
      thumb.addClass("displayed");

      let current = this.parts.currentContainer
        .find(`li > img[src='${full}']`)
        .eq(0);
      if (!current.parent().hasClass("displayed")) {
        this.parts.currentContainer
          .find("li > img")
          .parent()
          .removeClass("displayed");
        current.parent().addClass("displayed");
        this.parts.currentImage = current;
      }
    },
    _zoom: function (target, source, img, magnify) {
      var targetHeight,
        targetWidth,
        sourceHeight,
        sourceWidth,
        xRatio,
        yRatio,
        offset,
        $target = $(target),
        position = $target.css("position"),
        $source = $(source);

      // The parent element needs positioning so that the zoomed element can be correctly positioned within.
      target.style.position = /(absolute|fixed)/.test(position)
        ? position
        : "relative";
      target.style.overflow = "hidden";
      img.style.width = img.style.height = "";

      $(img)
        .addClass("zoomImg")
        .css({
          position: "absolute",
          top: 0,
          left: 0,
          opacity: 0,
          width: img.width * magnify,
          height: img.height * magnify,
          border: "none",
          maxWidth: "none",
          maxHeight: "none"
        })
        .appendTo(target);

      return {
        init: function () {
          targetWidth = $target.outerWidth();
          targetHeight = $target.outerHeight();
          if (source === target) {
            sourceWidth = targetWidth;
            sourceHeight = targetHeight;
          } else {
            sourceWidth = $source.outerWidth();
            sourceHeight = $source.outerHeight();
          }
          xRatio = (img.width - targetWidth) / sourceWidth;
          yRatio = (img.height - targetHeight) / sourceHeight;
          offset = $source.offset();
        },
        move: function (e) {
          var left = e.pageX - offset.left,
            top = e.pageY - offset.top;

          top = Math.max(Math.min(top, sourceHeight), 0);
          left = Math.max(Math.min(left, sourceWidth), 0);

          img.style.left = left * -xRatio + "px";
          img.style.top = top * -yRatio + "px";
        }
      };
    },
    _attachZoom: function (ele) {
      //target will display the zoomed image
      let $ele = $(ele);
      let target = $ele[0];
      //source will provide zoom location info (thumbnail)
      let source = $ele[0];
      let $source = $(source);
      let img = document.createElement("img");
      let $img = $(img);
      let mousemove = "mousemove.zoom";
      let clicked = false;
      let touched = false;
      let settings = this.settings.zoom;
      // If a url wasn't specified, look for an image element.
      let srcElement = source.querySelector("img");
      if (srcElement) {
        settings.url =
          srcElement.getAttribute("data-src") ||
          srcElement.currentSrc ||
          srcElement.src;
      } else {
        return;
      }

      $source.one(
        "zoom.destroy",
        function (position, overflow) {
          $source.off(".zoom");
          target.style.position = position;
          target.style.overflow = overflow;
          img.onload = null;
          $img.remove();
        }.bind(this, target.style.position, target.style.overflow)
      );

      img.onload = () => {
        var zoom = this._zoom(target, source, img, settings.magnify);
        function start(e) {
          zoom.init();
          zoom.move(e);

          // Skip the fade-in for IE8 and lower since it chokes on fading-in
          // and changing position based on mousemovement at the same time.
          $img
            .stop()
            .fadeTo(
              $.support.opacity ? settings.duration : 0,
              1,
              $.isFunction(settings.onZoomIn)
                ? settings.onZoomIn.call(img)
                : false
            );
        }
        function stop() {
          $img
            .stop()
            .fadeTo(
              settings.duration,
              0,
              $.isFunction(settings.onZoomOut)
                ? settings.onZoomOut.call(img)
                : false
            );
        }
        // Mouse events
        if (settings.on === "grab") {
          $source.on("mousedown.zoom", function (e) {
            if (e.which === 1) {
              $(document).one("mouseup.zoom", function () {
                stop();

                $(document).off(mousemove, zoom.move);
              });

              start(e);

              $(document).on(mousemove, zoom.move);

              e.preventDefault();
            }
          });
        } else if (settings.on === "click") {
          $source.on("click.zoom", function (e) {
            if (clicked) {
              // bubble the event up to the document to trigger the unbind.
              return;
            } else {
              clicked = true;
              start(e);
              $(document).on(mousemove, zoom.move);
              $(document).one("click.zoom", function () {
                stop();
                clicked = false;
                $(document).off(mousemove, zoom.move);
              });
              return false;
            }
          });
        } else if (settings.on === "toggle") {
          $source.on("click.zoom", function (e) {
            if (clicked) {
              stop();
            } else {
              start(e);
            }
            clicked = !clicked;
          });
        } else if (settings.on === "mouseover") {
          zoom.init(); // Preemptively call init because IE7 will fire the mousemove handler before the hover handler.

          $source
            .on("mouseenter.zoom", start)
            .on("mouseleave.zoom", stop)
            .on(mousemove, zoom.move);
        }
        // Touch fallback
        if (settings.touch) {
          $source
            .on("touchstart.zoom", function (e) {
              e.preventDefault();
              if (touched) {
                touched = false;
                stop();
              } else {
                touched = true;
                start(
                  e.originalEvent.touches[0] ||
                    e.originalEvent.changedTouches[0]
                );
              }
            })
            .on("touchmove.zoom", function (e) {
              e.preventDefault();
              zoom.move(
                e.originalEvent.touches[0] || e.originalEvent.changedTouches[0]
              );
            })
            .on("touchend.zoom", function (e) {
              e.preventDefault();
              if (touched) {
                touched = false;
                stop();
              }
            });
        }
        if ($.isFunction(settings.callback)) {
          settings.callback.call(img);
        }
      };
      img.setAttribute("role", "presentation");
      img.alt = "";
      img.src = settings.url;
    },
    _setSizes() {
      if (this.settings.thumbs.scrollable) return;
      let height = this.parts.container.height();
      let thumbs = this.parts.thumbsList.find("li");
      let thumbsCount = thumbs.length;
      if (thumbsCount === 0) return;
      let spacing = parseInt(thumbs.eq(0).css("margin-bottom"));
      let targetHeight = (height - (thumbsCount - 1) * spacing) / thumbsCount;
      let currentWidth = this.parts.thumbsList.width();

      //disable scrolling:
      this.parts.thumbsList.css({ overflowX: "hidden", overflowY: "hidden" });

      thumbs.each((i, el) => {
        thumbs.css("height", targetHeight + "px");
      });

      if (!this.settings.thumbs.keepWidth) {
        this.parts.thumbsList
          .parent()
          .css("flexBasis", targetHeight + spacing + "px");
      }
    }
  });

  // A really lightweight plugin wrapper around the constructor,
  // preventing against multiple instantiations
  $.fn[pluginName] = function (options = {}) {
    return this.each(function () {
      if (!$.data(this, pluginName)) {
        $.data(this, pluginName, new ProductGallery(this, options));
      }
    });
  };
})(jQuery, window, document);
