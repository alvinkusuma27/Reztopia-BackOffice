@extends('tenant.components.master')
@section('title', 'MENU')
@push('head')
    <style>
        .color-card {
            background-color: rgb(14, 12, 27);
        }
    </style>
@endpush

@section('container')
    <div class="page-heading">
        <h3>Request Password</h3>
        <p>Lihat user yang request reset password</p>
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
        <div class="modal fade" id="modalToggle{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">
                            Tambah Kategori {{ $item->proof_of_payment }}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="basicInput">Nama Kategori</label>
                            <input type="text" class="form-control mt-3" id="basicInput" name="kategori">
                        </div>
                        <label for="basicInput">Pilih Makanan dan Minuman</label>
                        <div class="row mt-3">
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body color-card">
                                            <input type="checkbox" class="custom-control-input" id="ck2a">
                                            <label class="custom-control-label" for="ck2a">
                                                <img src="assets/images/samples/motorcycle.jpg"
                                                    class="card-img-top img-fluid" alt="singleminded" alt="#"
                                                    class="img-fluid">
                                                <h5 class="card-title mt-3">
                                                    Ayam Goreng
                                                </h5>
                                                <p class="card-text mt-2 mb-3">
                                                    Makanan
                                                </p>
                                                <p class="card-text">
                                                    Rp.12000
                                                </p>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body color-card">
                                            <input type="checkbox" class="custom-control-input" id="ck1a">
                                            <label class="custom-control-label" for="ck1a">
                                                <img src="assets/images/samples/motorcycle.jpg"
                                                    class="card-img-top img-fluid" alt="singleminded" alt="#"
                                                    class="img-fluid">
                                                <h5 class="card-title mt-3">
                                                    Ayam Goreng
                                                </h5>
                                                <p class="card-text mt-2 mb-3">
                                                    Makanan
                                                </p>
                                                <p class="card-text">
                                                    Rp.12000
                                                </p>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    @endforeach

@endsection

@push('scripts')
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
@endpush
