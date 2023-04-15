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
        <h3>Informasi Tenant</h3>
        <p>Manager Kantin Baril</p>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="container emp-profile">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <form action="" method="post" enctype="multipart/form-data">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog"
                                    alt="" class="rounded" />
                                <input class="form-control mt-2" type="file" name="photo">
                            </form>
                            {{-- <p>Ganti profile</p> --}}
                            {{-- <div class="d-flex justify-content-between">
                                </div> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                            <h5>
                                Kshiti Ghelani
                            </h5>
                            <h6>
                                Web Developer and Designer
                            </h6>
                            <div class="d-flex justify-content-between mt-4">
                                <div class="flex-start">
                                    <div class="card p-5">
                                        <div class="card-content">
                                            <p>
                                                <i class="bi bi-telephone-fill"></i>
                                                <span>08128882881834</span>
                                            </p>
                                            <p>
                                                <i class="bi bi-mailbox2"></i>
                                                <span>woke@woke.com</span>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                                <div class="flex-end">
                                    <div class="card p-5">
                                        <div class="card-content">
                                            <h5 class="fs-5 text-muted">Kantin Cowok</h5>
                                            <p class="fs-4">
                                                Baril
                                            </p>
                                            <p class="fs-5 text-muted">
                                                Berlangganan pada
                                            </p>
                                            <p class="fs-6">
                                                2006
                                            </p>
                                            {{-- <div class="card-body">
                                                </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card p-5">
                                <div class="card-content">
                                    <p>
                                        Perusahaan: <span>PT. Telkom Indonesia</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditProfile">Edit
                            Profile</button>
                    </div>
                </div>
            </div>

            {{-- MODAL EDIT PROFILE --}}
            <div class="modal fade" id="modalEditProfile" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-center">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Profile</h5>
                            {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button> --}}
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="basicInput">Nomor Telepon</label>
                                <input type="text" class="form-control mt-3" id="basicInput" name="deskripsi">
                            </div>
                            <div class="form-group mb-3">
                                <label for="basicInput">Email</label>
                                <input type="number" class="form-control mt-3" id="basicInput" name="harga">
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
            </div>
        </section>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/js/pages/simple-datatables.js"></script>
@endpush
