<table cellspacing="0" cellpadding="0" border="1" width="100%" style="font-family: Arial, Helvetica, sans-serif;">
    <tbody>
        <tr>
            <td style="background: #FE9E14; color: #000000; text-align: center; padding-top: 5px; padding-bottom: 5px;" width="15">Order ID</td>
            <td style="background: #FE9E14; color: #000000; text-align: center;" width="15">Date</td>
            <td style="background: #FE9E14; color: #000000; text-align: center;" width="15">School</td>
            <td style="background: #FE9E14; color: #000000; text-align: center;" width="15">Student</td>
            <td style="background: #FE9E14; color: #000000; text-align: center;" width="15">Grade</td>
            <td style="background: #FE9E14; color: #000000; text-align: center;" width="15">Allergies</td>
            <td style="background: #FE9E14; color: #000000; text-align: center;" width="15">Product</td>
            <td style="background: #FE9E14; color: #000000; text-align: center;" width="15">Quantity</td>
        </tr>
        @foreach($records as $record)
            @php
                $allergies = $record['allergies'] ?? [];
                $rowspan = max(1, count($allergies));
            @endphp

            @if($rowspan === 1)
                @php
                    $allergy = $allergies[0] ?? '-';
                    $color = '#f49cba';

                    if ($allergy === 'Vegetarian') {
                        $color = '#61b361';
                    }

                    if ($allergy === 'Gluten Free') {
                        $color = '#ffa521';
                    }

                    if ($allergy === 'Dairy Free') {
                        $color = '#3cc2ff';
                    }
                @endphp
                <tr>
                    <td style="padding: 5px;">{{$record['order_code']}}</td>
                    <td style="padding: 5px;">{{$record['date']}}</td>
                    <td style="padding: 5px; color: #000000; background-color: {{$record['color']}}">{{$record['school']}}</td>
                    <td style="padding: 5px;">
                        <b>{{$record['first_name']}} {{$record['last_name']}}</b>
                    </td>
                    <td style="padding: 5px;">{{$record['grade']}}</td>
                    <td style="padding: 5px; @if($allergy !== '-') background-color: {{$color}}; color:#000000; text-align:center; @endif">
                        {{$allergy}}
                    </td>
                    <td style="padding: 5px;">{{$record['product']}}</td>
                    <td @if($record['quantity'] > 1) style="background-color: #ffff5e; padding: 5px;" @else style="padding: 5px;" @endif>
                        {{$record['quantity']}}
                    </td>
                </tr>
            @else
                @php
                    // Primera alergia
                    $firstAllergy = $allergies[0];
                    $color = '#f49cba';

                    if ($firstAllergy === 'Vegetarian') {
                        $color = '#61b361';
                    }

                    if ($firstAllergy === 'Gluten Free') {
                        $color = '#ffa521';
                    }

                    if ($firstAllergy === 'Dairy Free') {
                        $color = '#3cc2ff';
                    }
                @endphp
                <tr>
                    <td rowspan="{{$rowspan}}" style="padding: 5px;">{{$record['order_code']}}</td>
                    <td rowspan="{{$rowspan}}" style="padding: 5px;">{{$record['date']}}</td>
                    <td rowspan="{{$rowspan}}" style="padding: 5px; color: #000000; background-color: {{$record['color']}}">{{$record['school']}}</td>
                    <td rowspan="{{$rowspan}}" style="padding: 5px;">
                        <b>{{$record['first_name']}} {{$record['last_name']}}</b>
                    </td>
                    <td rowspan="{{$rowspan}}" style="padding: 5px;">{{$record['grade']}}</td>
                    <td style="padding: 5px; background-color: {{$color}}; color:#000000; text-align:center;">
                        {{$firstAllergy}}
                    </td>
                    <td rowspan="{{$rowspan}}" style="padding: 5px;">{{$record['product']}}</td>
                    <td rowspan="{{$rowspan}}"
                        @if($record['quantity'] > 1)
                            style="background-color: #ffff5e; padding: 5px;"
                        @else
                            style="padding: 5px;"
                        @endif
                    >
                        {{$record['quantity']}}
                    </td>
                </tr>

                @for($i = 1; $i < $rowspan; $i++)
                    @php
                        $allergy = $allergies[$i];
                        $color = '#f49cba';

                        if ($allergy === 'Vegetarian') {
                            $color = '#61b361';
                        }

                        if ($allergy === 'Gluten Free') {
                            $color = '#ffa521';
                        }

                        if ($allergy === 'Dairy Free') {
                            $color = '#3cc2ff';
                        }
                    @endphp
                    <tr>
                        <td style="padding: 5px; background-color: {{$color}}; color:#000000; text-align:center;">
                            {{$allergy}}
                        </td>
                    </tr>
                @endfor
            @endif
        @endforeach
        <tr>
            <td colspan="7" style="padding: 5px;"></td>
            <td style="padding: 5px;">{{$total_quantity}}</td>
        </tr>
    </tbody>
</table>
