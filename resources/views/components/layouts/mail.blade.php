<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
        <!--[if gte mso 9]>
        <xml>
            <o:OfficeDocumentSettings>
                <o:AllowPNG/>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="format-detection" content="date=no" />
        <meta name="format-detection" content="address=no" />
        <meta name="format-detection" content="telephone=no" />
        <meta name="x-apple-disable-message-reformatting" />
        <!--[if !mso]><!-->
        <link href="https://fonts.googleapis.com/css?family=Kreon:400,700|Raleway:400,400i,700,700i|Roboto:400,400i,700,700i" rel="stylesheet" />
        <!--<![endif]-->
        <title>{{config('app.name')}}</title>
        <!--[if gte mso 9]>
        <style type="text/css" media="all">
            sup { font-size: 100% !important; }
        </style>
        <![endif]-->
        <style type="text/css" media="screen">
            /* Linked Styles */
            body { padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#F5F6F9; -webkit-text-size-adjust:none }
            a { color:#32B9F0; text-decoration:none }
            p { padding:0 !important; margin:0 !important }
            img { -ms-interpolation-mode: bicubic; /* Allow smoother rendering of resized image in Internet Explorer */ }
            .mcnPreviewText { display: none !important; }
            .text-footer2 a { color: #ffffff; }

            /* Mobile styles */
            @media only screen and (max-device-width: 480px), only screen and (max-width: 480px) {
                .mobile-shell { width: 100% !important; min-width: 100% !important; }

                .m-center { text-align: center !important; }
                .m-left { text-align: left !important; margin-right: auto !important; }

                .center { margin: 0 auto !important; }
                .content2 { padding: 8px 15px 12px !important; }
                .t-left { float: left !important; margin-right: 30px !important; }
                .t-left-2  { float: left !important; }

                .td { width: 100% !important; min-width: 100% !important; }

                .content { padding: 30px 15px !important; }
                .section { padding: 30px 15px 0px !important; }

                .m-br-15 { height: 15px !important; }
                .mpb5 { padding-bottom: 5px !important; }
                .mpb15 { padding-bottom: 15px !important; }
                .mpb20 { padding-bottom: 20px !important; }
                .mpb30 { padding-bottom: 30px !important; }
                .m-padder { padding: 0px 15px !important; }
                .m-padder2 { padding-left: 15px !important; padding-right: 15px !important; }
                .p70 { padding: 30px 0px !important; }
                .pt70 { padding-top: 30px !important; }
                .p0-15 { padding: 0px 15px !important; }
                .p30-15 { padding: 20px 15px !important; }
                .p30-15-0 { padding: 30px 15px 0px 15px !important; }
                .p0-15-30 { padding: 0px 15px 30px 15px !important; }


                .text-footer { text-align: center !important; }

                .m-td,
                .m-hide { display: none !important; width: 0 !important; height: 0 !important; font-size: 0 !important; line-height: 0 !important; min-height: 0 !important; }

                .m-block { display: block !important; }

                .fluid-img img { width: 100% !important; max-width: 100% !important; height: auto !important; }

                .column,
                .column-dir,
                .column-top,
                .column-empty,
                .column-top-30,
                .column-top-60,
                .column-empty2,
                .column-bottom { float: left !important; width: 100% !important; display: block !important; }

                .column-empty { padding-bottom: 15px !important; }
                .column-empty2 { padding-bottom: 30px !important; }

                .content-spacing { width: 15px !important; }
            }
        </style>
    </head>
    <body class="body" style="padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#F5F6F9; -webkit-text-size-adjust:none;">
    @php
        use \Spatie\MediaLibrary\MediaCollections\Models\Media;
    @endphp
        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F6F9">
            <tr>
                <td align="center" valign="top">
                    <!-- Main -->
                    <table width="650" border="0" cellspacing="0" cellpadding="0" class="mobile-shell">
                        <tr>
                            <td class="td" style="width:650px; min-width:650px; font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
                                <!-- Header -->
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <!-- Top bar -->
                                    <tr>
                                        <td class="p30-15" style="padding: 40px 0px 20px 0px;"></td>
                                    </tr>
                                    <!-- Logo -->
                                    <tr>
                                        <td bgcolor="#FFFFFF" class="p30-15 img-center" style="padding: 20px; border-radius: 20px 20px 0px 0px; font-size:0pt; line-height:0pt; text-align:center;">
                                            <a href="{{config('app.url')}}" target="_blank">
                                                @php
                                                    $general_setting = new \App\Settings\GeneralSettings();
                                                    $logo_mail = $general_setting->logo_mail;
                                                    $logo = null;
                                                    if ($logo_mail) {
                                                        $image = Media::find($logo_mail);
                                                        if ($image) {
                                                            $logo = ($image->hasGeneratedConversion('webp') ? $image->getFullUrl('webp') : $image->getUrl());
                                                        }
                                                    }
                                                @endphp
                                                <img src="{{$logo}}" style="height: 100px;" border="0" alt="{{config('app.name')}}" />
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- END Logo -->
                                </table>
                                <!-- END Header -->

{{--                                <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ebebeb">--}}
{{--                                    <tr>--}}
{{--                                        <td bgcolor="#ffffff">--}}
{{--                                            <img src="{{asset('img/bg-mail.png')}}" style="width: 100%;" alt="{{config('app.name')}}"/>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                </table>--}}

                                <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ebebeb">
                                    <tr>
                                        <td class="p0-15-30" style="padding: 15px 30px 30px 30px;" bgcolor="#ffffff">
                                            @yield('content')
                                        </td>
                                    </tr>
                                </table>

                                <!-- Footer -->
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td class="p30-15-0" bgcolor="#2B3CA2" style="border-radius: 0 0 20px 20px; padding: 30px 30px 0 30px;">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td class="m-padder2 pb30" align="center" style="padding-bottom:30px;">
                                                        <table class="center" border="0" cellspacing="0" cellpadding="0"style="text-align:center;">
                                                            <tr>
                                                                <td class="img" width="40" style="font-size:0pt; line-height:0pt; text-align:left;">
                                                                    <a href="https://www.facebook.com" target="_blank">
                                                                        <img src="https://montanaweb-bucket.s3.amazonaws.com/web/facebook.png" width="26" height="26" border="0" alt="" />
                                                                    </a>
                                                                </td>
                                                                <td class="img" width="40" style="font-size:0pt; line-height:0pt; text-align:left;">
                                                                    <a href="https://www.instagram.com" target="_blank">
                                                                        <img src="https://montanaweb-bucket.s3.amazonaws.com/web/instagram.png" width="26" height="26" border="0" alt="" />
                                                                    </a>
                                                                </td>
                                                                <td class="img" width="40" style="font-size:0pt; line-height:0pt; text-align:left;">
                                                                    <a href="https://www.youtube.com/" target="_blank">
                                                                        <img src="https://montanaweb-bucket.s3.amazonaws.com/web/youtube.png" width="26" height="26" border="0" alt="" />
                                                                    </a>
                                                                </td>
                                                                <td class="img" width="40" style="font-size:0pt; line-height:0pt; text-align:left;">
                                                                    <a href="https://www.linkedin.com" target="_blank">
                                                                        <img src="https://montanaweb-bucket.s3.amazonaws.com/web/linkedin.png" width="26" height="26" border="0" alt="" />
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
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td class="text-footer2 p30-15" style="padding: 30px 15px 10px 15px; color:#2B3CA2; font-family:'Raleway', Arial,sans-serif; font-size:12px; line-height:22px; text-align:center;">
                                            <multiline>© {{date('Y')}} <strong>{{config('app.name')}}</strong>. Todos los derechos reservados</multiline>
                                        </td>
                                    </tr>
                                </table>
                                <!-- END Footer -->
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
