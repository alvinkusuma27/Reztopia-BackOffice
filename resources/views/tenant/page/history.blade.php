<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    <style>
        body {
            background: #F6FBFD;

        }

        .navbar {
            background-color: #FFF;
        }

        .sidebar {
            background-color: #FFF;
            width: 110px;
            height: 100vh;
            box-shadow: 6px 8px 14px 0px rgba(192, 192, 192, 0.12);
            position: fixed;
            display: flex;
            align-items: center;
        }

        .icon {
            margin: auto;
        }

        .logo {
            background-color: #007bff;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logout {
            position: fixed;
            bottom: 0;
            margin-left: 10px;
            margin-bottom: 50px;
        }

        .logo img {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }

        .container {
            margin-top: 120px;
            margin-left: 140px;
            margin-right: 140px;

        }

        .table-main thead th {
            border: none;
        }


        .table-main {
            width: 110%;
        }

        .table-main tbody:before {
            content: "@";
            display: block;
            line-height: 36px;
            border-style: none;
            text-indent: -99999px;
        }

        .navbar-brand img {
            margin-left: 50px;
        }

        .detail {
            border: none;
            background: none;
        }

        .icon a {
            text-decoration: none;
        }
    </style>
</head>

<body>

    <nav class="navbar fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://i.ibb.co/KKRc356/rp-horiz-3.png" alt="Bootstrap" width="131" height="38">
            </a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-3 sidebar">
                <div class="icon">
                    <div class="detail text-center mt-3">
                        <a href="{{ route('pesanan') }}" style="color:#C6D9E8">
                            <svg width="57" height="57" viewBox="0 0 57 58" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="material-symbols:checklist-rtl-rounded">
                                    <path id="Vector"
                                        d="M7.125 21.9099C6.45208 21.9099 5.88842 21.6819 5.434 21.2259C4.978 20.7715 4.75 20.2078 4.75 19.5349C4.75 18.862 4.978 18.2975 5.434 17.8415C5.88842 17.3871 6.45208 17.1599 7.125 17.1599H23.75C24.4229 17.1599 24.9874 17.3871 25.4434 17.8415C25.8978 18.2975 26.125 18.862 26.125 19.5349C26.125 20.2078 25.8978 20.7715 25.4434 21.2259C24.9874 21.6819 24.4229 21.9099 23.75 21.9099H7.125ZM7.125 40.9099C6.45208 40.9099 5.88842 40.6819 5.434 40.2259C4.978 39.7715 4.75 39.2078 4.75 38.5349C4.75 37.862 4.978 37.2975 5.434 36.8415C5.88842 36.3871 6.45208 36.1599 7.125 36.1599H23.75C24.4229 36.1599 24.9874 36.3871 25.4434 36.8415C25.8978 37.2975 26.125 37.862 26.125 38.5349C26.125 39.2078 25.8978 39.7715 25.4434 40.2259C24.9874 40.6819 24.4229 40.9099 23.75 40.9099H7.125ZM37.2281 24.9974L32.1219 19.8912C31.6865 19.4558 31.4688 18.9016 31.4688 18.2287C31.4688 17.5558 31.6865 17.0016 32.1219 16.5662C32.5573 16.1308 33.1115 15.913 33.7844 15.913C34.4573 15.913 35.0115 16.1308 35.4469 16.5662L38.8312 19.9505L47.2625 11.5193C47.7375 11.0443 48.2917 10.8163 48.925 10.8353C49.5583 10.8559 50.1125 11.1037 50.5875 11.5787C51.0229 12.0537 51.2406 12.6078 51.2406 13.2412C51.2406 13.8745 51.0229 14.4287 50.5875 14.9037L40.5531 24.9974C40.0781 25.4724 39.524 25.7099 38.8906 25.7099C38.2573 25.7099 37.7031 25.4724 37.2281 24.9974ZM37.2281 43.9974L32.1219 38.8912C31.6865 38.4558 31.4688 37.9016 31.4688 37.2287C31.4688 36.5558 31.6865 36.0016 32.1219 35.5662C32.5573 35.1308 33.1115 34.913 33.7844 34.913C34.4573 34.913 35.0115 35.1308 35.4469 35.5662L38.8312 38.9505L47.2625 30.5193C47.7375 30.0443 48.2917 29.8163 48.925 29.8353C49.5583 29.8559 50.1125 30.1037 50.5875 30.5787C51.0229 31.0537 51.2406 31.6078 51.2406 32.2412C51.2406 32.8745 51.0229 33.4287 50.5875 33.9037L40.5531 43.9974C40.0781 44.4724 39.524 44.7099 38.8906 44.7099C38.2573 44.7099 37.7031 44.4724 37.2281 43.9974Z"
                                        fill="#C6D9E8" />
                                </g>
                            </svg>
                            Detail
                        </a>
                    </div>
                    <div class="history text-center mt-3">
                        <a href="{{ route('history') }}" style="color:#6597BF">
                            <svg width="57" height="57" viewBox="0 0 57 58" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="ic:round-history">
                                    <path id="Vector"
                                        d="M31.4925 7.6599C19.4038 7.3274 9.50001 17.0412 9.50001 29.0349H5.24876C4.18001 29.0349 3.65751 30.3174 4.41751 31.0537L11.0438 37.7036C11.5188 38.1786 12.255 38.1786 12.73 37.7036L19.3563 31.0537C19.5204 30.8862 19.6313 30.674 19.6749 30.4436C19.7186 30.2133 19.6931 29.9751 19.6017 29.7593C19.5103 29.5434 19.357 29.3594 19.1611 29.2305C18.9653 29.1016 18.7357 29.0335 18.5013 29.0349H14.25C14.25 19.7724 21.8025 12.2912 31.1125 12.4099C39.9475 12.5287 47.3813 19.9624 47.5 28.7974C47.6188 38.0837 40.1375 45.6599 30.875 45.6599C27.0513 45.6599 23.5125 44.3537 20.71 42.1449C20.2551 41.7865 19.6844 41.6079 19.1063 41.6429C18.5283 41.678 17.9833 41.9242 17.575 42.3349C16.5775 43.3324 16.6488 45.0187 17.765 45.8736C21.4964 48.8245 26.1178 50.4236 30.875 50.4099C42.8688 50.4099 52.5825 40.5061 52.25 28.4174C51.9413 17.2787 42.6313 7.96865 31.4925 7.6599ZM30.2813 19.5349C29.3075 19.5349 28.5 20.3424 28.5 21.3161V30.0562C28.5 30.8874 28.9513 31.6712 29.6638 32.0987L37.0738 36.4924C37.9288 36.9912 39.0213 36.7062 39.52 35.8749C40.0188 35.0199 39.7338 33.9274 38.9025 33.4287L32.0625 29.3674V21.2924C32.0625 20.3424 31.255 19.5349 30.2813 19.5349Z"
                                        fill="#6597BF" />
                                </g>
                            </svg>
                            Riwayat
                        </a>
                    </div>
                    <div class="logout align-self-end">
                        <a href="{{ route('pos_logout') }}">
                            <svg width="57" height="58" viewBox="0 0 57 58" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="LogOut">
                                    <g id="Group">
                                        <path id="Vector" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M24.0777 4.84554C25.1415 4.52642 26.2652 4.4604 27.359 4.65276C28.4529 4.84512 29.4866 5.29053 30.3777 5.95343C31.2688 6.61633 31.9926 7.47836 32.4913 8.47072C32.99 9.46309 33.2498 10.5583 33.25 11.6689V46.4009C33.2498 47.5115 32.99 48.6067 32.4913 49.5991C31.9926 50.5915 31.2688 51.4535 30.3777 52.1164C29.4866 52.7793 28.4529 53.2247 27.359 53.4171C26.2652 53.6094 25.1415 53.5434 24.0777 53.2243L9.82775 48.9493C8.36024 48.5091 7.07372 47.6075 6.15904 46.3784C5.24437 45.1493 4.75025 43.658 4.75 42.1259V15.9439C4.75025 14.4118 5.24437 12.9206 6.15904 11.6914C7.07372 10.4623 8.36024 9.56077 9.82775 9.12054L24.0777 4.84554ZM35.625 10.0349C35.625 9.40503 35.8752 8.80093 36.3206 8.35554C36.766 7.91014 37.3701 7.65991 38 7.65991H45.125C47.0147 7.65991 48.8269 8.41058 50.1631 9.74678C51.4993 11.083 52.25 12.8952 52.25 14.7849V17.1599C52.25 17.7898 51.9998 18.3939 51.5544 18.8393C51.109 19.2847 50.5049 19.5349 49.875 19.5349C49.2451 19.5349 48.641 19.2847 48.1956 18.8393C47.7502 18.3939 47.5 17.7898 47.5 17.1599V14.7849C47.5 14.155 47.2498 13.5509 46.8044 13.1055C46.359 12.6601 45.7549 12.4099 45.125 12.4099H38C37.3701 12.4099 36.766 12.1597 36.3206 11.7143C35.8752 11.2689 35.625 10.6648 35.625 10.0349ZM49.875 38.5349C50.5049 38.5349 51.109 38.7851 51.5544 39.2305C51.9998 39.6759 52.25 40.28 52.25 40.9099V43.2849C52.25 45.1746 51.4993 46.9869 50.1631 48.3231C48.8269 49.6592 47.0147 50.4099 45.125 50.4099H38C37.3701 50.4099 36.766 50.1597 36.3206 49.7143C35.8752 49.2689 35.625 48.6648 35.625 48.0349C35.625 47.405 35.8752 46.8009 36.3206 46.3555C36.766 45.9101 37.3701 45.6599 38 45.6599H45.125C45.7549 45.6599 46.359 45.4097 46.8044 44.9643C47.2498 44.5189 47.5 43.9148 47.5 43.2849V40.9099C47.5 40.28 47.7502 39.6759 48.1956 39.2305C48.641 38.7851 49.2451 38.5349 49.875 38.5349ZM21.375 26.6599C20.7451 26.6599 20.141 26.9101 19.6956 27.3555C19.2502 27.8009 19 28.405 19 29.0349C19 29.6648 19.2502 30.2689 19.6956 30.7143C20.141 31.1597 20.7451 31.4099 21.375 31.4099H21.3774C22.0073 31.4099 22.6114 31.1597 23.0568 30.7143C23.5022 30.2689 23.7524 29.6648 23.7524 29.0349C23.7524 28.405 23.5022 27.8009 23.0568 27.3555C22.6114 26.9101 22.0073 26.6599 21.3774 26.6599H21.375Z"
                                            fill="#FC6262" />
                                        <path id="Vector_2"
                                            d="M38 29.0349H49.875M49.875 29.0349L45.125 24.2849M49.875 29.0349L45.125 33.7849"
                                            stroke="#FC6262" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <!-- Konten halaman -->
                <div class="container">
                    <table class="table table-main">
                        <thead>
                            <tr>
                                <th scope="col">Waktu</th>
                                <th scope="col">Nama Pemesan</th>
                                <th scope="col">Nomor Meja</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $item)
                                @php
                                    // dd($item);
                                @endphp
                                <tr>
                                    <td>{{ $item->created_at != null ? $item->created_at->toTimeString() : '' }}</td>
                                    <td>{{ $item->user[0]->name }}</td>
                                    <td>{{ $item->table_number }}</td>
                                    <td>{{ $item->order_type }}</td>
                                    <td>Rp. {{ number_format($item->total) }}</td>
                                    <td>
                                        <button type="button" class="detail" data-bs-toggle="modal"
                                            data-bs-target="#modalDetail{{ $item->id }}">
                                            <svg width="28" height="28" viewBox="0 0 28 29" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="ion:eye">
                                                    <path id="Vector"
                                                        d="M14 18.0349C15.933 18.0349 17.5 16.4679 17.5 14.5349C17.5 12.6019 15.933 11.0349 14 11.0349C12.067 11.0349 10.5 12.6019 10.5 14.5349C10.5 16.4679 12.067 18.0349 14 18.0349Z"
                                                        fill="#6597BF" />
                                                    <path id="Vector_2"
                                                        d="M26.8429 13.5834C25.3959 11.3455 23.5185 9.4446 21.4141 8.08562C19.0861 6.58062 16.5157 5.78491 13.9815 5.78491C11.6562 5.78491 9.36972 6.44937 7.1855 7.75968C4.95808 9.09569 2.94011 11.0475 1.18738 13.5604C0.989512 13.8444 0.880539 14.1808 0.874307 14.5269C0.868074 14.8729 0.964865 15.213 1.15238 15.504C2.59668 17.7642 4.4555 19.6679 6.52707 21.0083C8.85949 22.5193 11.3696 23.2849 13.9815 23.2849C16.536 23.2849 19.1118 22.4958 21.43 21.0033C23.5332 19.6487 25.4068 17.7407 26.8484 15.4843C27.0294 15.2001 27.1252 14.87 27.1242 14.533C27.1232 14.1961 27.0256 13.8665 26.8429 13.5834ZM14.0001 19.7849C12.9618 19.7849 11.9467 19.477 11.0834 18.9001C10.22 18.3232 9.54711 17.5033 9.14975 16.544C8.75239 15.5847 8.64842 14.5291 8.85099 13.5107C9.05356 12.4923 9.55358 11.5568 10.2878 10.8226C11.022 10.0884 11.9575 9.58836 12.9759 9.38579C13.9943 9.18322 15.0499 9.28718 16.0092 9.68455C16.9685 10.0819 17.7885 10.7548 18.3653 11.6182C18.9422 12.4815 19.2501 13.4966 19.2501 14.5349C19.2485 15.9268 18.6949 17.2612 17.7107 18.2455C16.7264 19.2297 15.392 19.7833 14.0001 19.7849Z"
                                                        fill="#6597BF" />
                                                </g>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    @foreach ($order as $item)
        <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1"
            aria-labelledby="modalDetailLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDetailLabel{{ $item->id }}">Order Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead class="theads">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->order_detail as $row)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $row->product_laporan_and_pesanan->name }}</td>
                                        <td>{{ $row->quantity }}</td>
                                        <td>Rp. {{ number_format($row->product_laporan_and_pesanan->price_final) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</body>

</html>
