<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Reztopia</title>
    <style>
        .box {
            display: block;
            height: 10px;
            width: 10px;
            border: 1px solid black;
        }

        body,
        html {
            width: 670px;
            font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
            font-size: 11px;
        }

        h1 {
            color: #F26522;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 0px;
            padding-bottom: 0px;

        }

        p.header {
            margin-top: 0px;
            margin-bottom: 0px;
            font-size: 9px;
            padding: 0px;
        }

        body,
        html {
            width: 670px;
            font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
            font-size: 11px;
        }

        h1 {
            color: #F26522;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 0px;
            padding-bottom: 0px;

        }

        p.header {
            margin-top: 0px;
            margin-bottom: 0px;
            font-size: 9px;
            padding: 0px;
        }

        /*----------------------------------------------------------
      CONTENT
----------------------------------------------------------*/


        .MenuContent {
            margin: 0 auto;
            padding: 0px;
            /*width:940px;*/
            width: 950px;
            display: block;
            /*height: 583px;*/
        }

        .content {
            margin: 0 auto;
            padding: 0px;
            /*width:940px;*/
            width: 885px;
            display: block;
            /*height: 583px;*/
        }

        .emailcontent {
            margin: 0 auto;
            padding: 0px;
            width: 90%;
            display: block;
        }

        div.boxtitle {
            background-color: #316eb5;

            height: 33px;
            width: 100%;
            color: white;
            font-size: 14px;
            text-transform: uppercase;
            vertical-align: middle;
            font-weight: bold;
            vertical-align: middle;
            line-height: 32px;
            margin-top: 10px;
            text-indent: 10px;
            text-shadow: #000 1px 1px 1px;
        }


        div.boxtitledashboard {
            background-color: #316EB5;


            height: 28px;
            width: 100%;
            color: white;
            font-size: 14px;
            text-transform: uppercase;
            font-weight: bold;
            vertical-align: middle;
            line-height: 28px;
            text-indent: 5px;
            text-shadow: black 1px 1px 1px;

        }


        div.boxcontainer {
            padding: 5px;
            height: auto;
            border: #316eb5 1px solid;
            margin-bottom: 10px;
        }

        div.boxcontainer a,
        a.sicycalink {
            color: #0061AF;
            text-decoration: none;
        }

        div.boxcontainer a:hover,
        a.sicycalink:hover {
            color: #0061AF;
            text-decoration: underline;
        }



        div.boxcontainer ul {
            padding-left: 20px;
        }

        div.boxcontainer ul li {
            padding: 2px;
            padding-left: 5px;
        }

        .urgent {
            background-color: #f26522;
            color: white;
        }



        thead {
            display: table-header-group;
        }

        @media print {
            thead {
                display: table-header-group;
            }
        }

        tbody {
            display: table-row-group;
        }


        div.tabletitle {
            height: 33px;
            width: 100%;
            color: white;
            font-size: 14px;
            text-transform: uppercase;
            vertical-align: middle;
            font-weight: bold;
            vertical-align: middle;
            line-height: 32px;
            margin-top: 5px;
            text-shadow: #000 1px 1px 1px;
        }


        div.tabletitle span.square,
        div.boxtitle span.square {
            background-repeat: no-repeat;
            float: left !important;
            background-position: 10px 12px;
            width: 20px;
        }


        div.boxtitledashboard span.square {
            background-repeat: no-repeat;
            float: left !important;
            background-position: 10px 10px;
            width: 20px;
        }


        div.tabletitle span {
            float: right;
            font-size: 12px;
            font-weight: normal;
            display: inline-block;
            margin-right: 10px;
            color: #e0e0e0;
        }


        .sicycatablecontainer {
            clear: both;
            border: none;
            height: 371px;
            overflow: hidden;
            width: 884px;
        }

        /* All other non-IE browsers.                                        */
        div.sicycatablecontainer table {
            width: 884px !important;
        }


        .sicycatablecontainerModal {
            clear: both;
            border: none;
            max-height: 371px;
            overflow: hidden;
            width: 672px
        }

        /* All other non-IE browsers.                                        */
        div.sicycatablecontainerModal table {
            width: 670px !important;
        }


        thead.fixedHeader tr {
            position: relative;
            width: 100%;
        }

        thead.fixedHeader tr {
            display: block
        }




        .sicycatablecontainer tbody.scrollContent {
            display: block;
            height: 337px;
            overflow: auto;
            width: 100%
        }

        .sicycatablecontainerModal tbody.scrollContent {
            display: block;
            max-height: 337px;
            overflow: auto;
            width: 100%
        }

        .materitablecontainer {
            display: block;
            max-height: 300px;
            overflow: auto;
            width: 100%
        }



        table.sicycatable,
        table.sicycatablemanual {
            font-family: "Trebuchet MS";
            font-size: 12px;
            border-collapse: collapse;
            width: 100%;
            margin-top: 2px;
            margin-bottom: 2px;
        }

        table.sicycatable tr th,
        table.sicycatablemanual tr th {
            margin-top: 2px;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            height: 33px;
            color: #242424;
            font-size: 14px;
            text-transform: capitalize;
            text-align: left;
            vertical-align: middle;
            font-weight: bold;
        }




        table.sicycatable tr td,
        table.sicycatablemanual tr td {
            height: 25px;
            color: #000;
            font-size: 12px;
            text-transform: capitalize;
            vertical-align: middle;


        }

        table.sicycatable tr td {
            background-color: white;
            /*border-top: 1px dashed black;*/

        }

        table.sicycatable tr:nth-child(odd),
        table.sicycatablemanual tr.odd {
            background-color: white;
            border-top: 1px dashed #A5A5A5;
            border-bottom: 1px dashed #A5A5A5;

        }

        table.sicycatable tr:nth-child(odd) td,
        table.sicycatablemanual tr.odd td {
            font-weight: bold;
            padding-left: 2px;
            text-align: left;
            background-color: white;
            border-top: 1px dashed #A5A5A5;
            border-bottom: 1px dashed #A5A5A5;
        }



        table.sicycatablemanual tr.special {
            background-image: linear-gradient(top, #fcf5df 0%, #fdeda5 50%, #ffdf93 90%);
            background-image: -o-linear-gradient(top, #fcf5df 0%, #fdeda5 50%, #ffdf93 90%);
            background-image: -moz-linear-gradient(top, #fcf5df 0%, #fdeda5 50%, #ffdf93 90%);
            background-image: -webkit-linear-gradient(top, #fcf5df 0%, #fdeda5 50%, #ffdf93 90%);
            background-image: -ms-linear-gradient(top, #fcf5df 0%, #fdeda5 50%, #ffdf93 90%);

            background-image: -webkit-gradient(linear,
                    left top,
                    left bottom,
                    color-stop(0, #fcf5df),
                    color-stop(0.5, #fdeda5),
                    color-stop(0.9, #ffdf93));
        }

        table.sicycatablemanual tr.special td {
            font-weight: normal;
            padding-left: 2px;
            text-align: center;
            background-color: white;
            border-bottom: 1px dashed black;

        }

        table.sicycatable tr:nth-child(even),
        table.sicycatablemanual tr.even {
            background-color: white;
            border-top: 1px dashed #A5A5A5;
            border-bottom: 1px dashed #A5A5A5;

        }

        table.sicycatable tr:nth-child(even) td,
        table.sicycatablemanual tr.even td {
            font-weight: normal;
            padding-left: 2px;
            text-align: left;
            background-color: white;
            border-top: 1px dashed #A5A5A5;
            border-bottom: 1px dashed #A5A5A5;
        }

        span.footnote {
            display: inline-block;
            float: left;
            font-size: 11px;
            color: #5f83af;
            margin-left: 8px;
        }

        span.footnote ul {
            padding-left: 10px;
            font-size: 11px;
            color: #5f83af;
            list-style-type: none;
        }

        span.footnote ul li:before {

            content: "-";
            position: relative;
            left: -5px;
        }

        span.footnote ul li {
            text-indent: -5px;
        }
    </style>
</head>

<body>
    {{-- <link media="all" rel="stylesheet" href="https://sicyca.dinamika.ac.id/static/css/print_table.css"
        type="text/css" /> --}}
    <table style="width:670px;">
        <tr style="vertical-align:top">
            <td style="text-align:left">
            </td>
            <td style="text-align:right;vertical-align:top">
            </td>
        </tr>
    </table>
    <hr noshade="noshade" style="border-color:black;height: 0px;" size="1" />


    <p style="text-align:center;font-weight: bold;font-size: 14px;margin-bottom:3px;padding-bottom:0px ">KANTIN COWOK
    </p>
    <p style="text-align:center;font-weight:normal;margin-top:0px;padding-top:0px" id="date"></p>
    <p style="text-align:center;font-weight:normal;margin-top:0px;padding-top:0px" id="time"></p>

    <br />
    <table>
        <tr>
            <td>ID TENANT </td>
            <td>: {{ empty($order[0]->outlet[0]->id) != true ? $order[0]->outlet[0]->id : 'Nan' }}</td>
        </tr>
        <tr>
            <td>NAMA TENANT </td>
            <td>: {{ empty($order[0]->outlet[0]->name) != true ? $order[0]->outlet[0]->name : 'Nan' }}</td>
        </tr>
    </table>



    <table class="sicycatablemanual">
        <tr>
            <th>Tanggal</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Nomor Meja</th>
            <th>Payment Code</th>
            <th>Total Order</th>
            {{-- <th>Type Order</th> --}}
            <th>Nama Pemesan</th>
        </tr>

        @foreach ($order as $item)
            <tr class="odd">
                <td>{{ $item->date_order }}</td>

                <td>
                    @foreach ($item->order_detail as $row)
                        {{ $row->product_laporan_and_pesanan->name }}<br>
                    @endforeach
                </td>
                <td>
                    @foreach ($item->order_detail as $row)
                        {{ $row->quantity }}<br>
                    @endforeach
                </td>
                <td>{{ $item->table_number }}</td>
                <td>{{ $item->payment_code }}</td>
                <td>{{ $item->total }}</td>
                {{-- <td>{{ $order->type_order }}</td> --}}
                <td>{{ $item->user[0]->name }}</td>
            </tr>
        @endforeach

    </table>
    <br /><br />
    <p style="text-align:right">Total: Rp.{{ $total }}</p>

    <script>
        // window.print();
    </script>
    <script type="text/javascript">
        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July',
            'August', 'September', 'October', 'November', 'December'
        ];
        // var tomorrow = new Date();
        // tomorrow.setTime(tomorrow.getTime() + (1000 * 3600 * 24));
        // document.getElementById("spanDate").innerHTML = months[tomorrow.getMonth()] + " " + tomorrow.getDate() + ", " +
        //     tomorrow.getFullYear();
        var today = new Date();
        var day = today.getDate();
        var month = months[today.getMonth()];

        function appendZero(value) {
            return "0" + value;
        }

        function theTime() {
            var d = new Date();
            document.getElementById("time").innerHTML = d.toLocaleTimeString("id-ID");
        }

        if (day < 10) {
            day = appendZero(day);
        }

        if (month < 10) {
            month = appendZero(month);
        }

        today = day + "/" + month + "/" + today.getFullYear();

        document.getElementById("date").innerHTML = today;

        var myVar = setInterval(function() {
            theTime();
        }, 1000);
    </script>
</body>

</html>
