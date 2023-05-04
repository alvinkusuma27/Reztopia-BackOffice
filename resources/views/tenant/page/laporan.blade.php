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
    </style>
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}">
@endpush

@section('container')
    <div class="page-heading">
        <h3>Laporan Keuangan</h3>
        <p>Laporan Keuangan Resto Bawah Tanah</p>
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
                                        Today's Order
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
                                        Today's Omzet
                                    </h6>
                                    <h6 class="font-extrabold mb-0">Rp.{{ number_format($omzet_today) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <form action="{{ route('filter_date') }}" method="post" id="filter_date">
                                    @csrf
                                    <input type="date" name="date" class="btn btn-primary mr-4">
                                    <button type="submit" class="btn btn-outline-secondary">Filter</button>
                                </form>
                                <a href="{{ route('print', $day) }}" class="btn btn-primary"><i
                                        class="bi bi-printer"></i>&nbsp
                                    Print</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama</th>
                                            <th>Jumlah</th>
                                            <th>Bukti Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order as $item)
                                            <tr>
                                                <td class="text-bold-500">{{ $item->date_order }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td class="text-bold-500">{{ $item->quantity }}</td>
                                                <td>
                                                    <a href="#" {{-- class="btn" --}} data-bs-toggle="modal"
                                                        data-bs-target="#modalToggle{{ $item->id }}">
                                                        <i class="bi bi-eye-fill"></i>
                                                    </a>
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

@endsection

@push('scripts')
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#tableLaporan').DataTable();
        });
    </script>
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
    {{-- <script type="text/javascript">
        document.forms['filter_date'].submit();
    </script> --}}
@endpush
