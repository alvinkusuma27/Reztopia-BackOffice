@extends('tenant.components.master')
@section('title', 'MENU')
@push('head')
    <style>
        .color-card {
            background-color: rgb(14, 12, 27);
        }

        .img-container {
            /* position: relative; */
            /* padding-top: 100%; */
        }

        img {
            max-width: 500px;
        }

        body.theme-dark a {
            /* text-decoration: none !important;
                                                                                                                                                                                                                                                                                                            color: white; */
            color: inherit;
            text-decoration: none !important;
        }
    </style>
    <style>
        .cards-wrapper {
            display: flex;
            justify-content: center;
        }

        .card img {
            max-width: 100%;
            max-height: 100%;
        }

        .card {
            margin: 0 0.5em;
            box-shadow: 2px 6px 8px 0 rgba(22, 22, 26, 0.18);
            border: none;
            border-radius: 0;
        }

        .carousel-inner {
            padding: 1em;
        }

        .carousel-control-prev,
        .carousel-control-next {
            background-color: #e1e1e1;
            width: 5vh;
            height: 5vh;
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
        }

        @media (min-width: 768px) {
            .card img {
                height: 11em;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}">
@endpush

@section('container')
    <div class="page-heading d-flex justify-content-between">
        <div class="flex-start">
            <h3>Laporan Penjualan</h3>
            <p>Untuk Melihat Data Penjualan Tenant</p>
        </div>
        @if (auth()->user()->roles == 'admin')
            <div class="flex-end">
                <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Pilih Kantin
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('laporan') }}">All</a>
                    </li>
                    @foreach ($kantin as $item)
                        <li><a class="dropdown-item"
                                href="{{ route('laporan_admin', $item->id_user) }}">{{ $item->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-6 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <h6 class="text-muted font-semibold">
                                        Pesanan Hari Ini
                                    </h6>
                                    <h6 class="font-extrabold mb-0">{{ $order_today }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <h6 class="text-muted font-semibold">
                                        Omset Hari Ini
                                    </h6>
                                    <h6 class="font-extrabold mb-0">Rp.{{ number_format($omzet_today) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="margin-top:2.2rem">
                            <div class="card-header d-flex justify-content-between">
                                <form action="{{ route('filter_date') }}" method="post" id="filter_date">
                                    @csrf
                                    <div class="d-flex justify-content-center align-items-center">
                                        <input type="date" name="date_from"
                                            value="{{ empty($date_from) ? '' : $date_from }}" class="btn btn-primary mr-4">
                                        <p class="my-0 mx-2">to</p>
                                        <input type="date" name="date_to" value="{{ empty($date_to) ? '' : $date_to }}"
                                            class="btn btn-primary mr-4">
                                        <input type="text" name="id_user" value="{{ $id }}" hidden>
                                        <button type="submit" class="btn btn-outline-secondary"
                                            style="margin-left: 10px">Filter</button>
                                    </div>
                                </form>
                                <a href="{{ url('print_laporan/' . $day . '/' . $id) }}" class="btn btn-primary"><i
                                        class="bi bi-printer"></i>&nbsp
                                    Print</a>
                                {{-- <a href="{{ url('print_laporan/' . $day . '/' . $id) }}" class="btn btn-primary"><i
                                        class="bi bi-printer"></i>&nbsp
                                    Print</a> --}}
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Pemesan</th>
                                            {{-- <th>Jumlah</th> --}}
                                            <th>Nomor Meja</th>
                                            <th>Kode</th>
                                            <th>Total Order</th>
                                            {{-- <th>Type Order</th> --}}
                                            <th>Bukti Pembayaran</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order as $item)
                                            <tr>
                                                <td class="text-bold-500">
                                                    {{ empty($item->date_order) == false ? $item->date_order : '' }}
                                                </td>

                                                <td class="text-bold-500">
                                                    {{ empty($item->user[0]->name) == false ? $item->user[0]->name : '' }}
                                                </td>
                                                {{-- <td class="text-bold-500">
                                                    {{ empty($item->quantity) == false ? $item->quantity : '' }}
                                                </td> --}}
                                                <td class="text-bold-500">
                                                    {{ empty($item->table_number) == false ? $item->table_number : '' }}
                                                </td>
                                                <td class="text-bold-500">
                                                    {{ empty($item->payment_code) == false ? $item->payment_code : '' }}
                                                </td>
                                                <td class="text-bold-500">
                                                    {{ empty($item->total) == false ? $item->total : '' }}
                                                </td>
                                                <td>
                                                    <a class="tagA" href="#" {{-- class="btn" --}}
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalToggle{{ $item->id }}">
                                                        <i class="bi bi-eye-fill"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="tagA btn btn-primary" href="#"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalToggleDetail{{ $item->id }}">Detail
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
            </div>

        </section>
    </div>

    @foreach ($order as $item)
        <div class="modal fade text-left w-100" id="modalToggle{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel20" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-full" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel20">
                            Proof of Payment
                        </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body img-container d-flex justify-content-center">
                        <img src="{{ asset('storage/uploads/orders/' . $item->proof_of_payment) }}" alt="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Accept</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($order as $item)
        <div class="modal fade text-left w-100" id="modalToggleDetail{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel20" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-full" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel20">
                            Order Details
                        </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body img-container d-flex justify-content-center">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // dd($order);
                                @endphp
                                @foreach ($order->where('id', $id) as $row)
                                    <tr>
                                        <td class="text-bold-500">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-bold-500">
                                            {{ empty($row->name) == false ? $row->name : '' }}
                                        </td>
                                        <td class="text-bold-500">
                                            {{ empty($row->quantity) == false ? $row->quantity : '' }}
                                        </td>

                                        <td class="text-bold-500">
                                            {{ empty($row->price_final) == false ? $row->price_final : '' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <img src="{{ asset('storage/uploads/orders/' . $item->proof_of_payment) }}" alt=""> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@push('scripts')
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#tableLaporan').DataTable();
        }); <
        script src = "https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity = "sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin = "anonymous" >
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script> --}}
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
    {{-- <script type="text/javascript">
        document.forms['filter_date'].submit();
    </script> --}}
@endpush
