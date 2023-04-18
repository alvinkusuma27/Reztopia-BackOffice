@extends('tenant.components.master')
@section('title', 'MENU')
@push('head')
    <style>
        .color-card {
            background-color: rgb(14, 12, 27);
        }
    </style>
@endpush

@push('scripts')
    <script>
        function myFunction() {
            var x = document.getElementById("passOld");
            var y = document.getElementById("passNew");
            if (x.type === "password" && y.type == "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endpush

@section('container')
    <div class="page-heading">
        <h3>Profile</h3>
        <p>Manager Kantin {{ $outlet[0]->name }}</p>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="container emp-profile">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <form action="{{ route('update_image_profile') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <img src="{{ asset('storage/uploads/user/' . $outlet[0]->user[0]->image) }}"
                                    alt="{{ $outlet[0]->user[0]->image }}" width="100" />
                                <input class="form-control mt-2" type="file" name="photo">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                            {{-- <p>Ganti profile</p> --}}
                            {{-- <div class="d-flex justify-content-between">
                                </div> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                            <h5>
                                {{ $outlet[0]->user[0]->username }}
                            </h5>
                            <h6>
                                {{ $outlet[0]->name }}
                            </h6>
                            <div class="d-flex justify-content-between mt-4">
                                <div class="flex-start">
                                    <div class="card p-3">
                                        <div class="card-content">
                                            <p>
                                                <i class="bi bi-telephone-fill"></i>
                                                <span>{{ $outlet[0]->phone }}</span>
                                            </p>
                                            <p>
                                                <i class="bi bi-mailbox2"></i>
                                                <span>{{ $outlet[0]->user[0]->email }}</span>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                                {{-- <div class="flex-end">
                                    <div class="card p-3">
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
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="card p-3">
                                <div class="card-content">
                                    <p>
                                        Perusahaan: <span>PT. Telkom Indonesia</span>
                                    </p>
                                </div>
                            </div>
                            <button class="btn btn-primary mb-4" data-bs-toggle="modal"
                                data-bs-target="#modalChangePassword">Atur Kata Sandi</button>
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
                        <form action="{{ route('update_profile') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="basicInput">Nomor Telepon</label>
                                    <input type="number" class="form-control mt-3" id="basicInput" name="phone"
                                        value="{{ $outlet[0]->user[0]->phone }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Email</label>
                                    <input type="email" class="form-control mt-3" id="basicInput" name="email"
                                        value="{{ $outlet[0]->user[0]->email }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Accept</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- MODAL CHANGE PASSWORD --}}
            <div class="modal fade" id="modalChangePassword" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-center">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">Atur Kata Sandi</h5>
                            {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button> --}}
                        </div>
                        <form action="{{ route('change_password') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="basicInput">Kata Sandi Lama</label>
                                    <input type="te" class="form-control mt-3" id="passOld" name="passOld"
                                        value="{{ old('passOld') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Kata Sandi Baru</label>
                                    <input type="te" class="form-control mt-3" id="passNew" name="passNew"
                                        value="{{ old('passNew') }}">
                                    {{-- <input type="checkbox" class="ml-3" onclick="myFunction()"> Show Password --}}
                                    <p class="text-muted mt-2">Buat kata sandi yang sulit ditebak</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Accept</span>
                                </button>
                            </div>
                        </form>

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
