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
                {{-- <div class="row">
                    <div class="col-6 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <h6 class="text-muted font-semibold">
                                        Omzet Today
                                    </h6>
                                    <h6 class="font-extrabold mb-0">Rp.ini</h6>
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
                                    <h6 class="font-extrabold mb-0">Rp.ini</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            
                            <div class="card-body">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Lokasi Tenant</th>
                                            <th>Nama Tenant</th>
                                            <th>Pengaturan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($outlet as $item)
                                                <tr>
                                                    <td class="text-bold-500">{{ $item->user[0]->id }}</td>
                                                    <td class="text-bold-500">{{ $item->position }}</td>
                                                    <td>{{ $item->user[0]->name }}</td>
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
