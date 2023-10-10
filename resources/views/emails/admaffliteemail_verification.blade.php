<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td bgcolor="#426899" align="center">
        <table border="0" cellpadding="0" cellspacing="0" width="600">
            <tr>
            <td align="center" valign="top" style="padding: 40px 0px 5px 0px;">
                <div border="0">
                <img src="{{ asset('img/email_banner.png') }}" style="width: 100%;">
            </div>
            </td>
            </tr>
        </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#426899" align="center" style="padding: 0px 10px 0px 10px;">
        <table border="0" cellpadding="0" cellspacing="0" width="600">
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
        <table border="0" cellpadding="0" cellspacing="0" width="600">
            <tr>
            <td bgcolor="#ffffff" align="left">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="2" style="padding-left:30px;padding-right:15px;padding-bottom:10px; font-family: Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">
                    <h4 style="margin:0;">Dear {{ $userName }},</h4>
                    <p><b>Verify Your Email Address</b></p>
                    </td>
                </tr>
                <tr>
                    <th align="left" valign="top" style="padding-left:30px;padding-right:15px;padding-bottom:10px;
                    font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">&nbsp;Email :&nbsp;</th>
                    <td align="left" valign="top" style="padding-left:15px;padding-right:30px;padding-bottom:10px;
                    font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">&nbsp;{{ $userEmail }}</td>
                </tr>
                <tr>
                    <th align="left" valign="top" style="padding-left:30px;padding-right:15px;padding-bottom:10px;
                    font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">&nbsp;Password :&nbsp;</th>
                    <td align="left" valign="top" style="padding-left:15px;padding-right:30px;padding-bottom:10px;
                    font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">&nbsp;{{ $passwdVal }}</td>
                </tr>
                <tr>
                    <th align="left" valign="top" style="padding-left:30px;padding-right:15px;padding-bottom:10px;
                    font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">&nbsp;Referral ID :&nbsp;</th>
                    <td align="left" valign="top" style="padding-left:15px;padding-right:30px;padding-bottom:10px;
                    font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">&nbsp;{{ $refidId }}</td>
                </tr>
                <tr>
                    <th align="left" valign="top" style="padding-left:30px;padding-right:15px;padding-bottom:10px;
                    font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">&nbsp;Web Site :&nbsp;</th>
                    <td align="left" valign="top" style="padding-left:15px;padding-right:30px;padding-bottom:10px;
                    font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">https://www.nearsellers.com/</td>
                </tr>
                </table>
            </td>
            </tr>
            <tr>
            <td bgcolor="#ffffff" align="center">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td bgcolor="#ffffff" align="center" style="padding: 30px 30px 30px 30px; border-top:1px solid #dddddd;">
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                        <td align="left" style="border-radius: 3px;" bgcolor="#426899">
                            <a href="http://nearsellerdemo/verifyMail/{{ $verificationToken }}" target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif;
                            color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 11px 22px;
                            border-radius: 2px; border: 1px solid #426899; display: inline-block;">Verify</a>
                        </td>
                        </tr>
                    </table>
                    </td>
                </tr>
                </table>
            </td>
            </tr>
        </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
        <table border="0" cellpadding="0" cellspacing="0" width="600">
            <tr>
            <td bgcolor="#f4f4f4" align="left" style="padding: 30px 30px 30px 30px; color: #666666; font-family: Helvetica, Arial,
            sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;">
                <p style="margin: 0;"><b> {{date('Y')}} @ IT Support, HYZ Ventures Intl Pvt Ltd.</b></p>
            </td>
            </tr>
        </td>
    </tr>
    </table>
</body>
</html>
