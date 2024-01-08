<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="telephone=no" name="format-detection" />
    <title></title>
    <style type="text/css" data-premailer="ignore">
        @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700);
    </style>
    <style data-premailer="ignore">
        *{
            direction: rtl;
            text-align: right;
        }
        @media screen and (max-width: 600px) {
            u+.body {
                width: 100vw !important;
            }
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }
    </style>
    <!--[if mso]>
      <style type="text/css">
        body, table, td {
            font-family: Arial, Helvetica, sans-serif !important;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        .box {
            border-color: #eee !important;
        }
      </style>
    <![endif]-->
    <link rel="stylesheet" href="{{ asset('emails_assets/assets/theme.css') }}" />
</head>

<body class="bg-body">
    <center>
        <table class="main bg-body" width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <td align="center" valign="top">

                    <table class="wrap" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="p-sm">
                                <table cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="py-lg">
                                            <table cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" width="116"alt="" /></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <div class="main-content">
                                    <table class="box" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td>
                                                <table cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td class="content text-center pt-sm">
                                                            <strong> مرحبا بك {{ $name }} فى منصه حوكمنى </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="content text-center pt-sm">
                                                            <strong> بيانات الدخول</strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="content text-center pt-sm">
                                                            <strong>  {{ $email }} </strong>
                                                        </td>
                                                    </tr>
                                                     <tr>
                                                        <td class="content text-center pt-sm">
                                                            <strong> {{ $password }} </strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="content pt-sm">
                                                            <table cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td align="center">
                                                                        <table cellpadding="0" cellspacing="0" border="0" class="bg-blue rounded w-auto">
                                                                            <tr>
                                                                                <td align="center" valign="top" class="lh-1">
                                                                                    <a href="{{ route('login') }}" class="btn bg-blue border-blue">
                                                                                        <span class="btn-span"> دخول لوحه التحكم </span>
                                                                                    </a>
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
                                    </table>
                                </div>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>
