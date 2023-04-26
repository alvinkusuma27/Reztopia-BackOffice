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
            /* position: absolute;
                                    top: 0;
                                    left: 0;
                                    width: 100%; */
            max-width: 500px;
        }
    </style>
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
                                        Omzet Today
                                    </h6>
                                    <h6 class="font-extrabold mb-0">Rp.{{ number_format($omzet_today) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <h6 class="text-muted font-semibold">
                                        Omzet
                                    </h6>
                                    <h6 class="font-extrabold mb-0">Rp.{{ number_format($omzet_total) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-lg-between">
                                    <div class="flex-start">
                                        <input type="date" class="btn btn-primary">
                                        <input type="text" class="btn btn-outline-dark text-start ml-5">
                                    </div>
                                    <button class="btn btn-primary">Print</button>

                                </div>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="thead-dark">
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
@endpush
