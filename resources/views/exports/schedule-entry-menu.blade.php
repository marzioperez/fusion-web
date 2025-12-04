<table cellspacing="0" cellpadding="0" border="1" width="100%" style="font-family: Arial, Helvetica, sans-serif;">
    <tbody>
        <tr>
            <td style="background: #000000; color: #FFFFFF; text-align: center; padding-top: 5px; padding-bottom: 5px;" width="15">Order ID</td>
            <td style="background: #000000; color: #FFFFFF; text-align: center;" width="15">Date</td>
            <td style="background: #000000; color: #FFFFFF; text-align: center;" width="15">School</td>
            <td style="background: #000000; color: #FFFFFF; text-align: center;" width="15">Student</td>
            <td style="background: #000000; color: #FFFFFF; text-align: center;" width="15">Grade</td>
            <td style="background: #000000; color: #FFFFFF; text-align: center;" width="15">Allergies</td>
            <td style="background: #000000; color: #FFFFFF; text-align: center;" width="15">Product</td>
            <td style="background: #000000; color: #FFFFFF; text-align: center;" width="15">Quantity</td>
        </tr>
        @foreach($records as $record)
            <tr>
                <td style="padding: 5px;">{{$record['order_code']}}</td>
                <td style="padding: 5px;">{{$record['date']}}</td>
                <td style="padding: 5px; color: #000000; background-color: {{$record['color']}}">{{$record['school']}}</td>
                <td style="padding: 5px;">
                    <b>{{$record['first_name']}} {{$record['last_name']}}</b>
                </td>
                <td style="padding: 5px;">{{$record['grade']}}</td>
                <td style="padding: 5px;">
                    @if($record['allergies'])
                        @foreach($record['allergies'] as $allergy)
                            @php
                                $color = '#f49cba';
                                if ($allergy === 'Vegetarian') {
                                    $color = "#61b361";
                                }

                                if ($allergy === 'Gluten Free') {
                                    $color = "#ffa521";
                                }

                                if ($allergy === 'Dairy Free') {
                                    $color = "#3cc2ff";
                                }
                            @endphp
                            <div style="padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px; margin-bottom: 2px; font-size: 14px; width: 100%; text-align: center; background-color: {{$color}};">
                                {{$allergy}}
                            </div>
                        @endforeach
                    @else
                        -
                    @endif
                </td>
                <td style="padding: 5px;">{{$record['product']}}</td>
                <td @if($record['quantity'] > 1) style="background-color: #ffff5e; padding: 5px;" @else style="padding: 5px;" @endif>{{$record['quantity']}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="7" style="padding: 5px;"></td>
            <td style="padding: 5px;">{{$total_quantity}}</td>
        </tr>
    </tbody>
</table>
