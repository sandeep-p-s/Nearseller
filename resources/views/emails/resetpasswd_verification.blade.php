<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td bgcolor="#426899" align="center">
        <table border="0" cellpadding="0" cellspacing="0" width="480">
            <tr>
            <td align="center" valign="top" style="padding: 40px 0px 5px 0px;">
                <div border="0">
                <img src="{{ asset('/img/login_banner.png') }}" style="width: 100%;">
            </div>
            </td>
            </tr>
        </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#426899" align="center" style="padding: 0px 10px 0px 10px;">
        <table border="0" cellpadding="0" cellspacing="0" width="480">
            <tr>
            <td bgcolor="#ffffff" align="left" valign="top" style="padding: 30px 30px 10px 30px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; line-height: 48px;">
                <h1 style="font-size: 28px; font-weight: 400; margin: 0;text-align:center;"><b>NEAR SELLERS</b></h1>
            </td>
            </tr>
        </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
        <table border="0" cellpadding="0" cellspacing="0" width="480">
            <tr>
            <td bgcolor="#ffffff" align="left">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="2" style="padding-left:30px;padding-right:15px;padding-bottom:10px; font-family: Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">
                    <h4 style="margin:0;">Dear {{ $userName }},</h4>
                    <p><b>Password Successfully Reset</b></p>
                    </td>
                </tr>

                <tr>
                    <th align="left" valign="top" style="padding-left:30px;padding-right:15px;padding-bottom:10px;
                    font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">&nbsp;New Password &nbsp;</th>
                    <td align="left" valign="top" style="padding-left:15px;padding-right:30px;padding-bottom:10px;
                    font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">&nbsp;{{ $otpMessage }}</td>
                </tr>


                <tr>
                    <th align="left" valign="top" style="padding-left:30px;padding-right:15px;padding-bottom:10px;
                    font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">&nbsp;Email :&nbsp;</th>
                    <td align="left" valign="top" style="padding-left:15px;padding-right:30px;padding-bottom:10px;
                    font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">&nbsp;{{ $userEmail }}</td>
                </tr>


                <tr>
                    <th align="left" valign="top" style="padding-left:30px;padding-right:15px;padding-bottom:10px;
                    font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">&nbsp;Web Site :&nbsp;</th>
                    <td align="left" valign="top" style="padding-left:15px;padding-right:30px;padding-bottom:10px;
                    font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">http://nearsellerdemo/</td>
                </tr>

                </table>
            </td>
            </tr>
        </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
        <table border="0" cellpadding="0" cellspacing="0" width="480">
            <tr>
            <td bgcolor="#f4f4f4" align="left" style="padding: 30px 30px 30px 30px; color: #666666; font-family: Helvetica, Arial,
            sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;">
                <p style="margin: 0;"><b>IT Support, HYZ Ventures Intl Pvt Ltd.</b></p>
            </td>
            </tr>
        </td>
    </tr>
    </table>
</body>
</html>
