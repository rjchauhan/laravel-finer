<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>@yield('title', __('Pdf'))</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        html {
            font-family: sans-serif;
        }

        body {
            background: #fff;
            background-image: none;
            font-size: 12px;
        }

        address {
            margin-top: 15px;
        }

        hr {
            border: 1px dotted lightgray;
        }

        h2 {
            font-size: 28px;
            color: #cccccc;
        }

        .container {
            padding-top: 30px;
        }

        .invoice-head td {
            padding: 0 8px;
        }

        .invoice-body {
            background-color: transparent;
        }

        .logo {
            padding-bottom: 10px;
        }

        .table th {
            vertical-align: bottom;
            font-weight: bold;
            padding: 8px;
            line-height: 20px;
            text-align: left;
        }

        .table td {
            padding: 8px;
            line-height: 20px;
            text-align: left;
            vertical-align: top;
            border-top: 1px solid #dddddd;
            padding-bottom: 20px;
        }

        .well {
            margin-top: 15px;
        }

        /*.row {*/
        /*overflow: hidden;*/
        /*margin-left: -15px;*/
        /*margin-right: -15px;*/
        /*}*/

        .pdf-table {
            display: table;
            width: 100%;
        }

        .pdf-table .row {
            display: table-row;
            width: 100%;
        }

        .pdf-table .col-md-6 {
            display: table-cell;
            width: 50%;
            padding-right: 20px;
        }

        .pdf-table .col-md-4 {
            display: table-cell;
            width: 33%;
            padding-right: 20px;
        }

        .pdf-table .col-md-8 {
            display: table-cell;
            width: 66%;
            padding-right: 20px;
        }

        .sign-here {
            /*padding-top: 50px;*/
        }

        .fill-out {
            padding-top: 30px;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .page-break {
            page-break-after: always;
        }

        /*.col-md-6 {*/
        /*width: calc(50% - 30px);*/
        /*float: left;*/
        /*padding: 15px;*/
        /*}*/
    </style>

    @yield('head')
</head>
<body>
<div class="container">
    @yield('content')

    {{-- PDF Pagination Script --}}
    <script type="text/php">
        if (isset($pdf)) {
            $text = "{PAGE_NUM} / {PAGE_COUNT}";
            $size = 10;
            $font = $fontMetrics->getFont("Verdana");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width) / 2;
            $y = $pdf->get_height() - 35;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</div>
</body>
</html>
