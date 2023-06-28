@extends('tenant.components.master')
@section('title', 'TENANT')

@push('head')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}">
@endpush

@section('container')
    <div class="page-heading">
        <h3>Data Akun</h3>
        <p>Atur data active dan deactive akun</p>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                <div class="d-flex justify-content-lg-between">
                                    <div class="flex-start">
                                        <input type="text" class="btn btn-outline-dark text-start ml-5">
                                    </div>
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalCreate">Tambah</button>

                                </div>
                            </div> --}}
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table1">
                                        <thead>
                                            <tr>
                                                <th>Nomor</th>
                                                <th>Nama</th>
                                                <th>Tenant</th>
                                                <th>Pengaturan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($outlet as $item)
                                                <tr>
                                                    <td class="text-bold-500">{{ $item->user[0]->id }}</td>
                                                    <td>{{ $item->user[0]->name }}</td>
                                                    <td class="text-bold-500">{{ $item->name }}</td>
                                                    <td>
                                                        {{-- {{ route('changeActiveTenant', $item->id) }} --}}
                                                        <a href="" data-bs-toggle="modal"
                                                            class="btn {{ $item->active == 'active' ? 'btn-outline-success' : 'btn-outline-danger' }} ml-1"
                                                            data-bs-target="#modal{{ $item->id }}">
                                                            {{-- <i class="bi bi-trash-fill"></i> --}}
                                                            {{ $item->active == 'active' ? 'active' : 'deactive' }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- <table class="table mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Nomor</th>
                                                <th>Nama</th>
                                                <th>Tenant</th>
                                                <th>Pengaturan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($outlet as $item)
                                                <tr>
                                                    <td class="text-bold-500">{{ $item->user[0]->id }}</td>
                                                    <td>{{ $item->user[0]->name }}</td>
                                                    <td class="text-bold-500">{{ $item->name }}</td>
                                                    <td>
                                                        <a href="" data-bs-toggle="modal"
                                                            class="btn {{ $item->active == 'active' ? 'btn-outline-success' : 'btn-outline-danger' }} ml-1"
                                                            data-bs-target="#modal{{ $item->id }}">
                                                            {{ $item->active == 'active' ? 'active' : 'deactive' }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>

    @foreach ($outlet as $item)
        <div class="modal fade" id="modal{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger d-flex justify-content-center">
                        <h5 class="modal-title" id="exampleModalCenterTitle">
                            {{ $item->active == 'active' ? 'inactive' : 'activate' }} user {{ $item->user[0]->name }} ?
                        </h5>
                    </div>
                    <div class="modal-body">
                        <center>
                            <a href="{{ route('changeActiveTenant', $item->id) }}" class="btn btn-danger">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Ya</span>
                            </a>
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block ">Batal</span>
                            </button>
                        </center>
                    </div>
                    <div class="modal-footer">
                        <p class="m-auto text-muted">Tindakan ini tidak dapat diurungkan</p>
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
@endpush
