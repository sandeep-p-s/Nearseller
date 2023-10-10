<!-- footer starts  -->
<footer class="footer-section py-5 section_wrapper">
    <div class="container-fluid">
        <div class="footer-content pt-5">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="index.html"><img src="{{ asset('/img/header_logo.png') }}" class="img-fluid"
                                    alt="logo"></a>
                        </div>
                        <div class="footer-text">
                            <p>Lorem ipsum dolor sit amet, consec tetur adipisicing elit, sed do eiusmod tempor
                                incididuntut consec tetur adipisicing
                                elit,Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2">
                    <div class="footer-widget">
                        <div class="footer-widget-heading">
                            <h3>Follow Us</h3>
                        </div>
                        <div class="footer-social-icon">
                            <ul>
                                <li class=" text-secondary"><i class="fab fa-facebook-f text-secondary"></i><a
                                        href="#">Facebook </a></li>
                                <li class=" text-secondary"><i class="fab fa-twitter"></i><a
                                        href="#">instagram</a>
                                </li>
                                <li class=" text-secondary"><i class="fab fa-google-plus-g"></i><a
                                        href="#">Twitter
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2">
                    <div class="footer-widget">
                        <div class="footer-widget-heading">
                            <h3>Quick Links</h3>
                        </div>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="product_listing.html">Products</a></li>
                            <!-- <li><a href="#">Services</a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2">
                    <div class="footer-widget">
                        <div class="footer-widget-heading">
                            <h3>Company</h3>
                        </div>
                        <ul>
                            <li><a href="terms.html">Terms and condition</a></li>
                            <li><a href="privacy_policy.html">Privacy Policy</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area pt-4">
        <div class="container-fluid">
            <div class="copyright ">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="copyright-text">
                            <p>Copyright &copy; 2023. <a href="#" class="text-white"> HYZ Venture Intl Private
                                    Ltd.</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer ends -->

{{-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    new Mmenu(
        document.querySelector("#menu"),
        {
            theme: "white",
            setSelected: {
                hover: true,
                parent: true,
            },
            // counters: {
            //     add: true,
            // },
            searchfield: {
                add: true,
                placeholder: "Search menu items",
                splash: "<p>What are you looking for?</p>",
                title: "Search",
            },
            iconbar: {
                use: "(min-width: 450px)",
                top: [
                    '<a href="#/"><span class="fa fa-home"></span></a>',
                ],
                bottom: [
                    '<a href="#/"><span class="fa fa-twitter"></span></a>',
                    '<a href="#/"><span class="fa fa-facebook"></span></a>',
                    '<a href="#/"><span class="fa fa-youtube"></span></a>',
                ],
            },
            iconPanels: {
                add: true,
                visible: 1,
            },
            // sidebar: {
            //     collapsed: {
            //         use: "(min-width: 200px)",
            //     },
            //     expanded: {
            //         use: "(min-width: 1920px)",
            //         initial: "closed",
            //     },
            // },
            navbars: [
                {
                    content: ["searchfield"],
                },
                {
                    type: "tabs",
                    content: [
                        '<a href="#panel-menu"><i class="fa fa-bars"></i> <span>Menu</span></a>',
                        '<a href="#panel-account"><i class="fa fa-user"></i> <span></span></a>',
                        '<a href="#panel-cart"><i class="fa fa-shopping-cart"></i> <span></span></a>',
                    ],
                },
                {
                    content: ["prev", "breadcrumbs", "close"],
                },

            ],
        },
        {
            searchfield: {
                cancel: true,
                clear: true,
            },
        }
    );


</script>


</body>

</html>
