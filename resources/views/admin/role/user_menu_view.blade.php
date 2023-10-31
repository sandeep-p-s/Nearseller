<form name="frm" method="post" class="card p-3 col-md-6">
    <table class="table table-bordered">
        <tr>
            <th width="70%" class="font-14 text-center"><b>MENUS</b></th>
            <th width="30%"class="text-uppercase font-14 text-center"><b>View/All Privilages</b></th>
        </tr>
        @foreach ($allmenus as $menu)
            <tr>
                <td
                    class="{{ $menu->menu_level_1 == 0 ? 'pl-1' : ($menu->menu_level_2 == 0 ? 'pl-3 bg-light font-weight-bold' : 'font-weight-normal pl-5') }}">
                    <input type="checkbox" name="chkmenu" id="chkm{{ $loop->index }}"
                        value="{{ $menu->id }}/{{ $menu->menu_level_1 }}/{{ $menu->menu_level_2 }}/{{ $menu->menu_level_3 }}"
                        onClick="chkone(this),enablepriv({{ $loop->index }});" />
                    <span class="pl-2">{{ $menu->menu_desc }}</span>
                </td>
                <td class="{{ $menu->menu_level_1 == 0 ? 'pl-0' : ($menu->menu_level_2 == 0 ? ' bg-light' : ' ') }}">
                    <div><input type="checkbox" name="checkprivilage" id="chkmm{{ $loop->index }}"
                            value="{{ $menu->id }}" /></div>
                </td>
            </tr>
        @endforeach
    </table>
    <div align="center">
        <input type="button" class="btn btn-primary px-5 font-weight-bold" name="btnsave" value="SAVE"
            onClick="saveusermenumap();" />
    </div>

    <!-- Message display area -->
    <div class="col-md-12">
        <div id="userpage-message" class="text-center" style="display: none;"></div>
    </div>
</form>


<script>
    function uncheckAll() {
        for (i = 0; i < document.frm.chkmenu.length; i++)
            document.frm.chkmenu[i].checked = false;
    }

    function uncheckAll1() {
        for (i = 0; i < document.frm.checkprivilage.length; i++)
            document.frm.checkprivilage[i].checked = false;
    }

    var uid;

    function showUserMenuitems(user_id) {
        //alert(user_id)
        uid = user_id;
        $('#loading-overlay').fadeIn();
        $('#loading-image').fadeIn();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{ route('user.getUserMenu') }}',
            type: 'POST',
            data: {
                user_id: user_id,
                _token: csrfToken
            },
            success: function(data) {
                $('#loading-image').fadeOut();
                $('#loading-overlay').fadeOut();
                uncheckAll();
                var checkpriv = document.frm.checkprivilage;
                var chkbtn = document.frm.chkmenu;
                var y = data.split(',');
                var n = y.length;
                var i = 0;
                var j = 0;
                var tempvalue;
                var tempval;
                var tempvalue1;
                var tempval1;
                for (i = 0; i < chkbtn.length; i++) {
                    for (j = 0; j < n; j++) {
                        tempvalue = chkbtn[i].value;
                        tempval = tempvalue.split('/');

                        tempvalue1 = checkpriv[i].value;
                        tempval1 = tempvalue1.split('/');
                        if (tempval[0] == y[j]) {
                            chkbtn[i].checked = true;
                        }
                    }
                }
                showRoleprivilage();
            }
        });

    }


    function showRoleprivilage() {
        alert('Check privilage Checkbox to provide All Privilages');
        $('#loading-overlay').fadeIn();
        $('#loading-image').fadeIn();
        var user_id = $('#userid').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{ route('user.getPrivilageMenu') }}',
            type: 'POST',
            data: {
                user_id: user_id,
                _token: csrfToken
            },
            success: function(datas) {
                $('#loading-image').fadeOut();
                $('#loading-overlay').fadeOut();
                uncheckAll1();
                var checkpriv = document.frm.checkprivilage;
                var a = datas.split(',');
                var n = a.length;
                var i = 0;
                var j = 0;
                var tempvalue;
                var tempval;
                for (i = 0; i < checkpriv.length; i++) {
                    for (j = 0; j < n; j++) {
                        tempvalue = checkpriv[i].value;
                        tempval = tempvalue.split('/');
                        if (tempval[0] == a[j])
                            checkpriv[i].checked = true;
                    }
                }
            }
        });

    }



    function chkone(me) {
        var value = me.value;
        var val = value.split('/');
        var chkbtn = document.frm.chkmenu;
        var checkpriv = document.frm.checkprivilage;
        var i = 0;
        var tempvalue;
        var tempval;

        if (me.checked) {
            if (val[2] == 0) {
                for (i = 0; i < chkbtn.length; i++) {
                    tempvalue = chkbtn[i].value;
                    tempval = tempvalue.split('/');
                    if (tempval[1] == val[1])
                        chkbtn[i].checked = true;
                    if (tempval[1] == val[1])
                        checkpriv[i].checked = true;
                }
            }
            //return;
            else if (val[3] == 0)

            {
                for (i = 0; i < chkbtn.length; i++) {
                    tempvalue = chkbtn[i].value;
                    tempval = tempvalue.split('/');
                    if ((tempval[1] == val[1]) && (tempval[2] == 0))
                        chkbtn[i].checked = true;
                    if ((tempval[1] == val[1]) && (tempval[2] == 0))
                        checkpriv[i].checked = true;
                }
            } else {
                for (i = 0; i < chkbtn.length; i++) {
                    tempvalue = chkbtn[i].value;
                    tempval = tempvalue.split('/');
                    if ((tempval[1] == val[1]) && (tempval[2] == 0))
                        chkbtn[i].checked = true;
                    else if ((tempval[1] == val[1]) && (tempval[2] == val[2]) && (tempval[3] == 0))
                        chkbtn[i].checked = true;
                    if ((tempval[1] == val[1]) && (tempval[2] == 0))
                        checkpriv[i].checked = true;
                    else if ((tempval[1] == val[1]) && (tempval[2] == val[2]) && (tempval[3] == 0))
                        checkpriv[i].checked = true;

                }
            }
        } else {
            if (val[2] == 0) { //alert('unchecked');
                for (i = 0; i < chkbtn.length; i++) {
                    tempvalue = chkbtn[i].value;
                    tempval = tempvalue.split('/');
                    if (tempval[1] == val[1])
                        chkbtn[i].checked = false;
                    if (tempval[1] == val[1])
                        checkpriv[i].checked = false;
                }
            } else if (val[3] == 0) {
                for (i = 0; i < chkbtn.length; i++) {
                    tempvalue = chkbtn[i].value;
                    tempval = tempvalue.split('/');
                    if ((tempval[1] == val[1]) && (tempval[2] == val[2]))
                        chkbtn[i].checked = false;
                    if ((tempval[1] == val[1]) && (tempval[2] == val[2]))
                        checkpriv[i].checked = false;
                }
            } else {
                return;
            }

        }
    }


    function enablepriv(sd) {
        var sdd = sd;
        if (document.getElementById('chkm' + sdd).checked == false) {
            document.getElementById('chkmm' + sdd).checked = false;
            document.getElementById('chkmm' + sdd).disabled = true;
        } else if (document.getElementById('chkm' + sdd).checked == true) {
            document.getElementById('chkmm' + sdd).disabled = false;
        }
    }


    function saveusermenumap() {
        var userid = $('#userid').val();
        if ((userid == null) || (userid == '')) {
            alert("Select User");
            return;
        }


        var chkbtn = document.frm.chkmenu;
        var checkpriv = document.frm.checkprivilage;
        var n = chkbtn.length;

        var i = 0;
        var value = '';
        var tempvalue;
        var tempval;

        var m = checkpriv.length;
        var value11 = '';
        var tempvalue11;
        var tempval11;
        for (i = 0; i < n; i++) {
            if (chkbtn[i].checked == true) {

                tempvalue = chkbtn[i].value;
                tempval = tempvalue.split('/');
                value = value + tempval[0] + ",";
            }
        }
        for (i = 0; i < m; i++) {
            if (checkpriv[i].checked == true) {
                tempvalue11 = checkpriv[i].value;
                tempval11 = tempvalue11.split('/');
                value11 = value11 + tempval11[0] + ",";
            }
        }
        $('#loading-overlay').fadeIn();
        $('#loading-image').fadeIn();

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{ route('user.userpagemenu') }}',
            type: 'POST',
            data: {
                user_id: userid,
                values: value,
                values11: value11,
                _token: csrfToken
            },
            success: function(data) {
                if ((data.result == 1)) {
                    $('#userpage-message').text(data.mesge).fadeIn();
                    $('#userpage-message').addClass('success-message');
                    setTimeout(function() {
                        $('#userpage-message').fadeOut();
                    }, 5000);
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    showUserMenuitems(userid);
                } else if ((data.result == 2)) {
                    $('#userpage-message').text(data.mesge).fadeIn();
                    $('#userpage-message').addClass('error');
                    setTimeout(function() {
                        $('#userpage-message').fadeOut();
                    }, 5000);
                    $('#loading-image').fadeOut();
                    $('#loading-overlay').fadeOut();
                    showUserMenuitems(userid);
                }
            }
        });
    }
</script>
