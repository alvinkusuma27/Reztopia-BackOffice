@extends('tenant.components.master')
@section('title', 'TENANT')

@push('scripts')
    <script>
        function myFunction() {
            // var y = document.getElementById("pass");
            // if (y.type === "password") {
            //     y.type = "text";
            //     document.getElementById('pass').type = 'password';
            //     console.log('password');
            // } else {
            //     document.getElementById('pass').type = "text";
            //     y.type = "password";
            //     console.log('text');
            // }
            const togglePasswordEdit = document.querySelector("#togglePasswordEdit");
            const passwordEdit = document.querySelector("#passwordEdit");
            // console.log(togglePassword)

            togglePasswordEdit.addEventListener("click", function() {
                // toggle the type attribute
                const type = passwordEdit.getAttribute("type") === "password" ? "text" : "password";
                passwordEdit.setAttribute("type", type);
                console.log(type)
                // toggle the icon
                // this.classList.toggle("bi-eye");
            });

            // prevent form submit
            const form = document.getElementById("formEdit");
            form.addEventListener('submit', function(e) {
                e.preventDefault();
            });
        }

        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");
        // console.log(togglePassword, password)

        togglePassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            // console.log(type)
            // toggle the icon
            this.classList.toggle("bi-eye");
        });

        // prevent form submit
        const form = document.querySelector("form");
        form.addEventListener('submit', function(e) {
            e.preventDefault();
        });


        // const functionEdit = () => {

        //     var temp = document.getElementById("password");
        //     if (temp.type === "password") {
        //         temp.type = "text";
        //     } else {
        //         temp.type = "password";
        //     }
        // }
    </script>
@endpush
@push('head')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}">
    <style>
        form i {
            margin-left: -30px;
            cursor: pointer;
        }
    </style>
@endpush

@section('container')
    <div class="page-heading">
        <h3>Data Akun</h3>
        <p>Atur data akun dan bundle disini</p>
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
                            <div class="card-header d-flex justify-content-end">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalCreate">Tambah</button>
                            </div>
                            <div class="card-body">
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
                                                    <button class="btn btn-outline-primary rounded-pill"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEdit{{ $item->id }}">Edit</button>
                                                    {{-- <button
                                                            class="btn btn-outline-primary rounded-pill mx-1">Atur</button> --}}
                                                    <a href="{{ route('tenant.destroy', $item->id) }}"
                                                        data-bs-toggle="modal" class="btn btn-outline-danger ml-1"
                                                        data-bs-target="#modalDelete{{ $item->id }}">
                                                        <i class="bi bi-trash-fill"></i>
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
        <div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger d-flex justify-content-center">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Delete User {{ $item->user[0]->name }}
                        </h5>
                    </div>
                    <div class="modal-body">
                        <center>
                            <a href="{{ route('tenant.destroy', $item->id) }}" class="btn btn-danger">
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


    {{-- MODAL CREATE TENANT --}}
    <div class="modal fade text-left" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Tambah Tenant</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ route('tenant.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label>Nama: </label>
                        <div class="form-group">
                            <input type="text" placeholder="nama" name="name" value="{{ old('name') }}"
                                class="form-control">
                        </div>
                        <label>Tenant: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Tenant" name="tenant" value="{{ old('tenant') }}"
                                class="form-control">
                        </div>
                        <label>Email: </label>
                        <div class="form-group">
                            <input type="email" placeholder="Email" name="email" value="{{ old('email') }}"
                                class="form-control">
                        </div>
                        <label>Phone: </label>
                        <div class="form-group">
                            <input type="number" placeholder="Phone Number" name="phone" value="{{ old('phone') }}"
                                class="form-control">
                        </div>
                        <label>Password: </label>
                        <div class="form-group">
                            {{-- <input type="password" name="password" id="password" class="form-control" /> --}}
                            {{-- <i class="bi bi-eye-slash" id="togglePassword"></i> --}}
                            <input type="password" placeholder="Password" name="password" id="password"
                                class="form-control">
                            <input type="checkbox" class="ml-3" id="togglePassword"> Show Password
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tambah</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT TENANT --}}
    @foreach ($outlet as $item)
        <div class="modal fade text-left" id="modalEdit{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Edit Tenant {{ $item->name }}</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="{{ route('tenant.update', $item->id) }}" method="post" id="formEdit">
                        {{-- @method('put') --}}
                        @csrf
                        <div class="modal-body">
                            <label>Nama: </label>
                            <div class="form-group">
                                <input type="text" placeholder="nama" name="name"
                                    value="{{ $item->user[0]->name }}" class="form-control">
                            </div>
                            <label>Tenant: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Tenant" name="tenant" value="{{ $item->name }}"
                                    class="form-control">
                            </div>
                            <label>Email: </label>
                            <div class="form-group">
                                <input type="email" placeholder="Email" name="email"
                                    value="{{ $item->user[0]->email }}" class="form-control">
                            </div>
                            <label>Phone: </label>
                            <div class="form-group">
                                <input type="number" placeholder="Phone Number" name="phone"
                                    value="{{ $item->user[0]->phone }}" class="form-control">
                            </div>
                            <label>Password: </label>
                            <div class="form-group">
                                {{-- <input type="password" name="password" id="password" class="form-control" /> --}}
                                {{-- <i class="bi bi-eye-slash" id="togglePassword"></i> --}}
                                <input type="password" placeholder="Password" name="password" id="passwordEdit"
                                    class="form-control">
                                <input type="checkbox" class="ml-3" id="togglePasswordEdit" onclick="myFunction()">
                                Show Password
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning ml-1" data-bs-dismiss="modal">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Edit</span>
                            </button>
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                        </div>
                    </form>
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
