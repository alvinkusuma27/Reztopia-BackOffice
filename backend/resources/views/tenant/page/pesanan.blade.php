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
@endpush

@section('container')
    <div class="page-heading d-flex justify-content-between">
        <div class="flex-start">
            <h3>Pesanan</h3>
            <p>Pesanan Resto Bawah Tanah</p>
        </div>
    </div>
    <div class="page-content">
        <section class="row">
            @foreach ($order as $item)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title">{{ $item->user[0]->name }}</h4>
                                <p class="card-text">
                                    Nomor Meja: {{ $item->table_number }}<br>
                                    Total: {{ $item->total }}
                                    Tanggal: {{ $item->date_order }}
                                </p>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            {{-- <span>Tanggal: {{ $item->date_order }}</span> --}}
                            <button class="btn btn-light-primary" data-bs-toggle="modal"
                                data-bs-target="#modalToggleDetail{{ $item->id }}">Details</button>
                            <a class="btn btn-light-success" data-bs-toggle="modal"
                                data-bs-target="#modalToggle{{ $item->id }}">Accept</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
    </div>

    @foreach ($order as $item)
        <div class="modal fade text-left w-100" id="modalToggle{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel20" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-full" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel20">
                            apakah data pesanan sudah benar?
                        </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <form action="{{ route('accept_order') }}" method="post">
                            @csrf
                            <input name="id" value="{{ $item->id }}" hidden>
                            <button type="submit" class="btn btn-success ml-1" data-bs-dismiss="modal">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Accept</span>
                            </button>
                        </form>
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
                                @foreach ($item->order_detail as $item)
                                    <tr>
                                        <td class="text-bold-500">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="text-bold-500">
                                            {{ empty($item->product_laporan_and_pesanan->name) == false ? $item->product_laporan_and_pesanan->name : '' }}
                                        </td>
                                        <td class="text-bold-500">
                                            {{ empty($item->quantity) == false ? $item->quantity : '' }}
                                        </td>
                                        <td class="text-bold-500">
                                            {{ empty($item->product_laporan_and_pesanan->price_final) == false ? $item->product_laporan_and_pesanan->price_final : '' }}
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
    <script>
        $(document).ready(function() {
            $('#tableLaporan').DataTable();
        }); <
        script src = "https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity = "sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin = "anonymous" >
    </script>

    <script>
        setTimeout(() => {
            location.reload()
        }, 10000)
    </script>
@endpush
