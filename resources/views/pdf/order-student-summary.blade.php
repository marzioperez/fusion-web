<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Order {{ $order->code }} - {{ $student->first_name }}</title>
        <style>
            body { font-family: sans-serif; font-size: 14px; }
            h1 { font-size: 22px; margin-bottom: 4px; }
            h2 { font-size: 18px; margin-bottom: 4px; }
            table { width: 100%; border-collapse: collapse; margin-top: 10px; }
            th, td { border: 1px solid #ddd; padding: 4px 6px; }
            th { background: #f3f3f3; text-align: left; }
        </style>
    </head>
    <body>
        @php
            use \Spatie\MediaLibrary\MediaCollections\Models\Media;
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
        <div style="text-align: center; margin-bottom: 50px;">
            <img src="https://fusion-web-2025-bucket.s3.us-east-2.amazonaws.com/media-manager/1/logo-horizontal.png" style="height: 80px;" border="0" alt="{{config('app.name')}}" />
        </div>

        <h1>Order {{ $order->code }}</h1>
        <h2>Student: {{ $student->first_name }} {{ $student->last_name }}</h2>

        <p>Date: {{ $order->created_at->format('Y-m-d H:i') }}</p>

        <table>
            <thead>
                <tr>
                    <th>Product image</th>
                    <th>Product</th>
                    <th>Date</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>
                            @if($item->image_url)
                                <img src="https://fusion-web-2025-bucket.s3.us-east-2.amazonaws.com/media-manager/4/default-product-image.jpg" alt="" style="width: 100px; height: auto;">
                            @else
                                —
                            @endif
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->label }}</td>
                        <td>{{ $item->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p style="margin-top: 30px;">Thanks!</p>
    </body>
</html>
