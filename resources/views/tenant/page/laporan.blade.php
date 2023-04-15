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
                                    <h6 class="font-extrabold mb-0">12</h6>
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
                                    <h6 class="font-extrabold mb-0">2</h6>
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
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-bold-500">Michael Right</td>
                                                <td>$15/hr</td>
                                                <td class="text-bold-500">UI/UX</td>
                                                <td>Remote</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-500">Mikkey Mice</td>
                                                <td>$15/hr</td>
                                                <td class="text-bold-500">Animation</td>
                                                <td>Remote</td>
                                            </tr>
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

@endsection

@push('scripts')
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/js/pages/simple-datatables.js"></script>
@endpush
