@extends('components.layouts.mail')
@section('content')
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="text">
                <p style="color:#3B3B3B; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height:22px; text-align:left; margin-bottom: 5px !important;">
                    <multiline>Hi {{$user['first_name']}} {{$user['last_name']}},</multiline>
                </p>

                <p style="color:#3B3B3B; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height:22px; text-align:left; margin-bottom: 25px !important;">
                    <multiline>You have requested to recover your password. To do so, we have sent you the following verification code:</multiline>
                </p>

                <div style="padding-top: 15px; text-align: center; padding-bottom: 15px; background-color: #F6F3F3; color:#000000; font-family: Arial,sans-serif; font-size:18px; font-weight: bold; line-height:22px; margin-bottom: 25px !important;">
                    <multiline>{{$user['reset_password_code']}}</multiline>
                </div>

                <p style="color:#3B3B3B; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height:22px; text-align:left; margin-bottom: 5px !important;">
                    <multiline>Next, enter this code on the Fusion website and click on validate to continue.</multiline>
                </p>
            </td>
        </tr>

        <tr>
            <td align="center" style="padding-bottom: 20px;">
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="text-button button-blue2" style="font-family:'Raleway', Arial, serif; font-size:14px; line-height:18px; text-align:center; padding: 10px 30px; border-radius:20px; background:#8DC65E; color:#ffffff;">
                            <multiline>
                                <a href="{{route('page', ['slug' => 'update-password'])}}?token={{$user['reset_password_token']}}" target="_blank" class="link-white" style="color:#ffffff; text-decoration:none;">
                                    <span class="link-white" style="color:#ffffff; text-decoration:none;">Validar código</span>
                                </a>
                            </multiline>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endsection
