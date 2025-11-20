@extends('components.layouts.mail')
@section('content')
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="text">
                <p style="color:#3B3B3B; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height:22px; text-align:left; margin-bottom: 5px !important;">
                    <multiline>Hi {{$user['first_name']}} {{$user['last_name']}},</multiline>
                </p>

                <p style="color:#3B3B3B; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height:22px; text-align:left; margin-bottom: 25px !important;">
                    <multiline>Your order has been successfully processed. Below are the details of your order:</multiline>
                </p>

                <p style="color:#3B3B3B; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height:22px; text-align:left; margin-bottom: 5px !important;">
                    <multiline>Order {{$order['code']}}</multiline>
                </p>

                <p style="color:#3B3B3B; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height:22px; text-align:left; margin-bottom: 5px !important;">
                    <multiline>Total: {{$order['total']}}</multiline>
                </p>
            </td>
        </tr>

    </table>
@endsection
