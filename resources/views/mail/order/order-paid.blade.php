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
                    <multiline>Order <strong>#{{$order['code']}}</strong></multiline>
                </p>
            </td>
        </tr>

        <tr>
            <td align="center" style="padding-bottom: 20px;">
                <table style="border-collapse: collapse; border: 1px solid #5d5c5c;" width="100%">
                    <thead>
                        <tr>
                            <th style="color: #FFFFFF; background-color: #8DC65E; border: 1px solid #5d5c5c; font-family:'Raleway', Arial,sans-serif; font-size:16px; line-height:22px; padding-top: 5px; padding-bottom: 5px; padding-right: 5px; padding-left: 5px; text-align: center;" width="60%">Product</th>
                            <th style="color: #FFFFFF; background-color: #8DC65E; border: 1px solid #5d5c5c; font-family:'Raleway', Arial,sans-serif; font-size:16px; line-height:22px; padding-top: 5px; padding-bottom: 5px; padding-right: 5px; padding-left: 5px; text-align: center;" width="20%">Quantity</th>
                            <th style="color: #FFFFFF; background-color: #8DC65E; border: 1px solid #5d5c5c; font-family:'Raleway', Arial,sans-serif; font-size:16px; line-height:22px; padding-top: 5px; padding-bottom: 5px; padding-right: 5px; padding-left: 5px; text-align: right;" width="20%">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order["items"] as $detail)
                            <tr>
                                <td style="color: #5d5c5c; text-align: left; border: 1px solid #5d5c5c; font-family:'Raleway', Arial,sans-serif; font-size:14px; padding-top: 5px; padding-bottom: 5px; padding-right: 5px; padding-left: 5px; line-height: 15px; vertical-align: middle;">
                                    <p>{{$detail["name"]}}</p>
                                    <p style="color: red;"><strong>{{$detail["label"]}}</strong></p>
                                    <p>{{$detail["student_name"]}}</p>
                                </td>
                                <td style="color: #5d5c5c; text-align: center; border: 1px solid #5d5c5c; font-family:'Raleway', Arial,sans-serif; font-size:14px; padding-top: 5px; padding-bottom: 5px; padding-right: 5px; padding-left: 5px; line-height: 15px; vertical-align: middle;">{{$detail["quantity"]}}</td>
                                <td style="color: #5d5c5c; text-align: right; border: 1px solid #5d5c5c; font-family:'Raleway', Arial,sans-serif; font-size:14px; padding-top: 5px; padding-bottom: 5px; padding-right: 5px; padding-left: 5px; line-height: 15px; vertical-align: middle;">${{number_format($detail["price"], 2)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2" style="color: #5d5c5c; text-align: right; border: 1px solid #5d5c5c; padding-top: 3px; padding-bottom: 3px; padding-right: 5px; padding-left: 5px; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height: 15px;"><b>Subtotal</b></td>
                        <td style="color: #5d5c5c; border: 1px solid #5d5c5c; text-align: right; padding-right: 5px; padding-left: 5px; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height: 15px;">${{number_format($order["sub_total"], 2)}}</td>
                    </tr>
                    @if($order['credits'] > 0)
                        <tr>
                            <td colspan="2" style="color: #5d5c5c; text-align: right; border: 1px solid #5d5c5c; padding-top: 3px; padding-bottom: 3px; padding-right: 5px; padding-left: 5px; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height: 15px;"><b>Credits applied</b></td>
                            <td style="color: #5d5c5c; border: 1px solid #5d5c5c; text-align: right; padding-right: 5px; padding-left: 5px; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height: 15px;">-${{number_format($order["credits"], 2)}}</td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="2" style="color: #5d5c5c; text-align: right; border: 1px solid #5d5c5c; padding-top: 3px; padding-bottom: 3px; padding-right: 5px; padding-left: 5px; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height: 15px;"><b>Processing fee / Delivery</b></td>
                        <td style="color: #5d5c5c; border: 1px solid #5d5c5c; text-align: right; padding-right: 5px; padding-left: 5px; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height: 15px;">${{number_format($order["processing_fee"], 2)}}</td>
                    </tr>
                    <tr>
                        <td bgcolor="#8DC65E" colspan="2" style="background-color: #8DC65E; color: #FFF; text-align: right; border: 1px solid #5d5c5c; font-family:'Raleway', Arial,sans-serif; font-size:18px; line-height: 15px; padding-top: 8px; padding-bottom: 8px; padding-right: 5px; padding-left: 5px;"><b>TOTAL</b></td>
                        <td bgcolor="#8DC65E" style="background-color: #8DC65E; color: #FFF; border: 1px solid #5d5c5c; text-align: right; font-family:'Raleway', Arial,sans-serif; font-size:18px; line-height: 15px; padding-top: 8px; padding-bottom: 8px; padding-right: 5px; padding-left: 5px;">${{number_format($order["total"], 2)}}</td>
                    </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
        <tr>
            <td class="text">
                <p style="color:#5d5c5c; font-family:'Raleway', Arial,sans-serif; font-size:14px; line-height:22px; text-align:left;"><multiline>Thank you for choosing us,<br>{{config('app.name')}}.</multiline></p>
            </td>
        </tr>
    </table>
@endsection
