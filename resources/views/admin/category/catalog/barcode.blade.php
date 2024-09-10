<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Page A4</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .a4 {
            width: 21cm;
            height: 29.7cm;
            padding: 0.5cm;
            margin: 1cm auto;
            border: 1px solid #000;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
            box-sizing: border-box;
            background: white;
            text-align: center;
        }

        .barcode-container {
            display: inline-block;
            padding: 0.5cm;
            border: 1px solid #000;
            margin: 0.1cm;
            position: relative;
        }

        .barcode-text {
            font-size: 0.8em;
            text-align: center;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            body, html {
                width: 210mm;
                height: 297mm;
                margin: 0;
                padding: 0;
            }

            .a4 {
                margin: 0;
                border: none;
                box-shadow: none;
                width: auto;
                height: auto;
            }

            button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="a4">
        @if ($allSerial != null)
            @foreach ($allSerial as $serial)
            <div class="barcode-container">
                {!! QrCode::size(100)->generate($serial->serial_number) !!}
                <div class="barcode-text">{{ $serial->serial_number }}</div>
            </div>
            @endforeach
        @else
            <div class="barcode-container">
                {!! QrCode::size(100)->generate($barcode) !!}
                <div class="barcode-text">{{ $barcode }}</div>
            </div>
        @endif
        
    </div>
    <button onclick="window.print()">Print this page</button>
</body>
</html>

<script>
    window.onload = function() {
        window.print();
    }
</script>