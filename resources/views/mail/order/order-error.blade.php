@extends('components.layouts.mail')
@section('content')
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="text">
                <p style="color:#3B3B3B; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height:22px; text-align:left; margin-bottom: 5px !important;">
                    <multiline>Hi {{$user['first_name']}} {{$user['last_name']}},</multiline>
                </p>

                <p style="color:#3B3B3B; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height:22px; text-align:left; margin-bottom: 25px !important;">
                    <multiline>Your order has not been processed. We have detected a problem with your payment method:</multiline>
                </p>

                <p style="color:#3B3B3B; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height:22px; text-align:left; margin-bottom: 25px !important;">
                    <multiline><strong>{{$order['payment_error_message']}}</strong></multiline>
                </p>

                <p style="color:#3B3B3B; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height:22px; text-align:left; margin-bottom: 25px !important;">
                    <multiline>Please try again.</multiline>
                </p>
            </td>
        </tr>

        <tr>
            <td class="text">
                <p style="color:#5d5c5c; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height:22px; text-align:left;"><multiline>Thank you for choosing us,<br>{{config('app.name')}}.</multiline></p>
            </td>
        </tr>
    </table>
@endsection
