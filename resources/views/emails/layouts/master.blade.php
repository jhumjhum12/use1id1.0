<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <!-- So that mobile webkit will display zoomed in -->
    <meta name="format-detection" content="telephone=no">
    <!-- disable auto telephone linking in iOS -->
    <title>1ID</title>
    <style type="text/css">
        /* Resets: see reset.css for details */
        a { color: #428bca; }
        .ReadMsgBody { width: 100%; background-color: #eee;}
        .ExternalClass {width: 100%; background-color: #eee;}
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height:100%;}
        body {-webkit-text-size-adjust:none; -ms-text-size-adjust:none;}
        body {margin:0; padding:0;}
        table {border-spacing:0;}
        table td {border-collapse:collapse;}
        .yshortcuts a {border-bottom: none !important;}
        .receiver-greeting {color:#428bca;}
        .success {background: #42566f;}
        .danger {background: #cb1f1f;}
        /* Constrain email width for small screens */
        @media screen and (max-width: 600px) {
            table[class="container"] {
                width: 95% !important;
            }
        }
        /* Give content more room on mobile */
        @media screen and (max-width: 480px) {
            td[class="container-padding"] {
                padding-left: 12px !important;
                padding-right: 12px !important;
            }
        }
    </style>
</head>
<body style="margin:0;" bgcolor="#fff" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<br>
<!-- 100% wrapper (grey background) -->
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#fff" style="font-size: 14px; line-height: 20px; font-family: Helvetica, sans-serif; color: #333;">
    <tr>
        <td align="center" valign="top" bgcolor="#fff" style="background-color: #fff;">
            <table border="0" width="100%" cellpadding="0" cellspacing="0" class="container">
                <tr>
                    <td align="left" valign="middle" width="50%" height="60">
                        <img src="{{ asset('img/1id.jpg') }}" style="-o-border-radius: 3px 3px 0 0; -moz-border-radius: 3px 3px 0 0; -webkit-border-radius: 3px 3px 0 0; border-radius: 3px 3px 0 0;">
                    </td>
                    <td align="right" valign="middle" width="50%" height="60">
                        <p style="font-size: 18px">
                            Global User ID & Company ID
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
            </table>
            <!-- 600px container (white background) -->
            <table border="0" width="100%" cellpadding="0" cellspacing="0" class="container" bgcolor="#ffffff" style="border: 10px solid #ddd; -o-border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px;">
                <tr>
                    <td>
                        <table border="0" width="100%" height="100%" cellpadding="20" cellspacing="0">
                            <tr>
                                <td align="left" style="color: #fff; background: #242527; -o-border-radius: 3px 3px 0 0; -moz-border-radius: 3px 3px 0 0; -webkit-border-radius: 3px 3px 0 0; border-radius: 3px 3px 0 0;">
										<span style="font-size: 22px">
											@yield('headline')
										</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" width="100%" height="100%" cellpadding="5" cellspacing="0" class="{{ 'success' }}" style="color: #fff; border-bottom: 1px solid #eee;">
                            <tr>
                                <td></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="container-padding" bgcolor="#ffffff" style="background-color: #ffffff; padding-left: 30px; padding-right: 30px; -o-border-radius: 0 0 3px 3px; -moz-border-radius: 0 0 3px 3px; -webkit-border-radius: 0 0 3px 3px; border-radius: 0 0 3px 3px;">
                        <br>
                        <!-- ### BEGIN CONTENT ### -->
                        @yield('content')
                        <p>
                            Thanks!<br>
                            The <a href="http://use1id.com/">1ID Team</a>
                        </p>
                        <p><i>YOUR PERSONAL DATA CENTRALISED</i></p>
                        <br>
                        <!-- ### END CONTENT ### -->
                    </td>
                </tr>
            </table>
            <!--/600px container -->
            <table border="0" width="100%" cellpadding="10" cellspacing="0" class="container">
                <tr>
                    <td align="center" width="100%" style="font-size: 11px; line-height: 14px;">
                        <p style="color: #555;">Please do not reply directly to this email. This email was sent from a notification-only<br> address that cannot accept incoming email.</p>
                        <p style="color: #555;"><a href="http://use1id.com/">1ID Team</a> | <a href="http://use1id.com/1id_solution.html">Our Solution</a> | <a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a></p>
                        <p style="color: #555;">LVIS GmbH &copy; {{ date("Y") }} All rights reserved.</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<!--/100% wrapper-->
<br>
</body>
</html>