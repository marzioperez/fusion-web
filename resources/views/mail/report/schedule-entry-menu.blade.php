@extends('components.layouts.mail')
@section('content')
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="text">
                <p style="color:#3B3B3B; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height:22px; text-align:left; margin-bottom: 5px !important;">
                    <multiline>Hi,</multiline>
                </p>

                <p style="color:#3B3B3B; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height:22px; text-align:left; margin-bottom: 25px !important;">
                    <multiline>We have attached the menu report for the requested range: <b>{{$from}}</b> - <b>{{$to}}</b></multiline>
                </p>

                <p style="color:#3B3B3B; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height:22px; text-align:left; margin-bottom: 5px !important;">
                    <multiline>Regards!</multiline>
                </p>
            </td>
        </tr>
    </table>
@endsection
