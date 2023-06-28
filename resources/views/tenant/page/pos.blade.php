<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app-dark.css">
    <title>POINT OF SALE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .navbar {
            width: 100%;
            height: 1.5cm;
            position: fixed;
            z-index: 3;
            background-color: white;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
            padding-left: 20px;
            display: flex;
            align-items: center;
        }

        .sidebar {
            width: 110px;
            height: 100vh;
            z-index: 2;
            background-color: white;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
            padding: 10px;
            position: fixed;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .card {
            width: 350px;
            min-height: 300px;
            border-radius: 20px;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
            padding: 15px;
            margin-right: 20px;

        }

        .main {
            padding: 20px;
            z-index: 1;
            padding-left: 150px;
            padding-top: 2cm;
        }
    </style>
    <script>
        let colorMerah = '#FF0707'
        let colorBiru = '#6597BF'

        function startStopwatch(time, idStopWatch) {
            const date = new Date()
            const stopwatch = {
                elapsedTime: 0
            }
            //reset start time
            stopwatch.startTime = time;
            // run `setInterval()` and save the ID
            stopwatch.intervalId = setInterval(() => {
                //calculate elapsed time
                const elapsedTime = Date.now() - stopwatch.startTime + stopwatch.elapsedTime
                //calculate different time measurements based on elapsed time
                const milliseconds = parseInt((elapsedTime % 1000) / 10)
                const seconds = parseInt((elapsedTime / 1000) % 60)
                const minutes = parseInt((elapsedTime / (1000 * 60)) % 60)
                const hour = parseInt((elapsedTime / (1000 * 60 * 60)) % 24);
                if (minutes >= 30 || hour > 0) {
                    document.getElementById(idStopWatch).style.backgroundColor = colorMerah
                }
                displayTime(hour, minutes, seconds, milliseconds, idStopWatch)
            }, 100);

        }

        function displayTime(hour, minutes, seconds, milliseconds, idStopWatch) {
            const leadZeroTime = [hour, minutes, seconds].map(time => time < 10 ? `0${time}` : time)
            document.getElementById(idStopWatch).innerHTML = leadZeroTime.join(':')
        }

        // function toTimestamp(strDate) {
        //     var datum = Date.parse(strDate);
        //     console.log(datum / 1000, strDate)
        //     return datum / 1000;
        // }

        // startStopwatch(1686330401000, 'time-1')
        // startStopwatch(1686501782, 'time-2')

        let data = {!! $order !!};
        console.log(data);
        let forLoop = 0;
        data.forEach(value => {
            // let timestamp = toTimestamp(value['time_order']);
            let timestamp = value['time_order'];
            forLoop++;
            startStopwatch(timestamp, `time-${forLoop}`);
            // console.log(startStopwatch())
            // let yaya = ;
            console.log(timestamp)

        });
        const konfirmasi = (waktuBerhenti) => {
            console.log(waktuBerhenti);
            // alert(document.getElementById('time-1').innerText)
        }
    </script>
</head>

<body>
    @include('sweetalert::alert')
    <div class="navbar">
        <img src="{{ asset('assets/pos/logo.png') }}" alt="">
    </div>
    <div class="sidebar">
        <div style="margin-bottom: 50px;cursor:pointer">
            <img src="{{ asset('assets/pos/detail.png') }}" style="margin-bottom:3px" alt="">
            <h5>Detail</h5>
        </div>
        <div style="margin-bottom: 50px;cursor:pointer">
            <img src="{{ asset('assets/pos/history.png') }}" style="margin-bottom:3px" alt="">
            <h5>History</h5>
        </div>
    </div>
    <div class="main" style="display: flex;flex-wrap:wrap">
        @php
            // dd($order, strtotime($order[0]->time_order));
            // dd($order);
        @endphp



        @foreach ($order as $item)
            <div class="card">
                <form action="{{ route('accept_order') }}" method="POST">
                    @csrf
                    <div style="margin-bottom: 20px;">
                        <input type="number" name="id" value="{{ $item->id }}" hidden>
                        <h4>{{ $item->user[0]->name }}</h4>
                        <div style="display: flex;justify-content:space-between;align-items:center;">
                            <p style="margin: 0;">Meja : {{ $item->table_number }}</p>
                            <div style="display: flex;">
                                <p id="time-{{ $loop->iteration }}"
                                    style="margin: 0;padding: 10px;border-radius:20px;background-color:#6597BF;display:flex;justify-content:center;align-items:center;color:white;margin-right:10px;">
                                    00:00</p>
                                <button onclick="konfirmasi()" class="btn btn-success">Konfirmasi</button>
                            </div>
                        </div>
                    </div>
                    <div style="width: 100%; height:3px;background-color:#ECDF6C">
                    </div>
                    <table class="table table-borderless">
                        @foreach ($item->order_detail as $key)
                            <tr>
                                <td>
                                    <h5>{{ $loop->iteration }}</h5>
                                </td>
                                <td>
                                    <div>
                                        <h5>{{ $key->product_laporan_and_pesanan->name }}</h5>
                                        <p>{{ $key->note }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </form>
            </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
