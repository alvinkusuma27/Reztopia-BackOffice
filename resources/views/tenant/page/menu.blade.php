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
        <div class="d-flex justify-content-lg-between">
            <div class="col-lg-12 col-md-6">
                <div class="flex-start">
                    <h3>Produk Kantin {{ $categories[0]->name }}</h3>
                    <p>Pantau produk kantin dari sini</p>
                </div>
                <div class="flex-end">
                    <div class="btn-group mb-1 mr-3">
                        <div class="dropdown">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-pencil"></i>
                                Atur Kategori
                            </button>
                            <div class="dropdown-menu">
                                <button class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#modalTambahCategory"><i class="bi bi-plus"></i>
                                    <span>Tambah Produk</span></button>
                                <button class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#modalEditCategory"><i class="bi bi-pencil"></i>
                                    <span>Edit Produk</span></button>
                                <button class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#modalHapusCategory"><i class="bi bi-trash"></i>
                                    <span>Hapus Produk</span></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    @foreach ($categories as $item)
                        <div class="col-6 col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <h6 class="text-muted font-semibold">
                                            {{ $item->name }}
                                        </h6>
                                        <h6 class="font-extrabold mb-0">{{ $item->jumlah_produk }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Produk</h4>
                                <div class="d-flex justify-content-lg-between">
                                    <p>Produk yang dijual baik ready stok maupun out of stok</p>
                                    <div class="btn-group mb-1">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                Atur Produk
                                            </button>
                                            <div class="dropdown-menu">
                                                <button class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#modalTambahProduk"><i class="bi bi-plus"></i>
                                                    <span>Tambah Produk</span></button>
                                                {{-- <button class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#modalEditProduk"><i class="bi bi-pencil"></i>
                                                    <span>Edit Produk</span></button> --}}
                                                <button class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapusProduk"><i class="bi bi-trash"></i>
                                                    <span>Hapus Produk</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($categories as $item)
                                        <div class="col-3">
                                            <div class="card">
                                                <div class="card-content">
                                                    <button class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditProduk">
                                                        <img src="assets/images/samples/motorcycle.jpg"
                                                            class="card-img-top img-fluid" alt="singleminded">
                                                        <div class="card-body color-card">
                                                            <h5 class="card-title">{{ $item->nama_makanan }}</h5>
                                                            <p class="card-text">
                                                                {{ $item->type_product }}
                                                            </p>
                                                            <p class="card-text">
                                                                Rp.{{ number_format($item->original_price) }}
                                                            </p>
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @push('scripts')
                <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
                <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
            @endpush
        </section>
    </div>

    {{-- MODAL TAMBAH Category --}}
    <div class="modal fade" id="modalTambahCategory" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Kategori</h5>
                    {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button> --}}
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
                                            <img src="assets/images/samples/motorcycle.jpg" class="card-img-top img-fluid"
                                                alt="singleminded" alt="#" class="img-fluid">
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
                                            <img src="assets/images/samples/motorcycle.jpg" class="card-img-top img-fluid"
                                                alt="singleminded" alt="#" class="img-fluid">
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

    {{-- MODAL EDIT Category --}}
    <div class="modal fade" id="modalEditCategory" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Kategori</h5>
                    {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="basicInput">Edit Nama Kategori</label>
                        <input type="text" class="form-control mt-3" id="basicInput" name="kategori" value="Soto">
                    </div>
                    <label for="basicInput">Pilih Makanan dan Minuman</label>
                    <div class="row mt-3">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body color-card">
                                        <input type="checkbox" class="custom-control-input" id="ck3a">
                                        <label class="custom-control-label" for="ck3a">
                                            <img src="assets/images/samples/motorcycle.jpg" class="card-img-top img-fluid"
                                                alt="singleminded" alt="#" class="img-fluid">
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
                                        <input type="checkbox" class="custom-control-input" id="ck4a">
                                        <label class="custom-control-label" for="ck4a">
                                            <img src="assets/images/samples/motorcycle.jpg" class="card-img-top img-fluid"
                                                alt="singleminded" alt="#" class="img-fluid">
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


    {{-- MODAL HAPUS Category --}}
    <div class="modal fade" id="modalHapusCategory" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">HAPUS Kategori</h5>
                    {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body color-card">
                                        <input type="checkbox" class="custom-control-input" id="ck5a">
                                        <label class="custom-control-label" for="ck5a">
                                            <h5 class="card-title text-center mt-3">
                                                Ayam Goreng
                                            </h5>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body color-card">
                                        <input type="checkbox" class="custom-control-input" id="ck6a">
                                        <label class="custom-control-label" for="ck6a">
                                            <h5 class="card-title text-center mt-3">
                                                Ayam Goreng
                                            </h5>
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


    {{-- MODAL TAMBAH PRODUK --}}
    <div class="modal fade" id="modalTambahProduk" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Produk</h5>
                    {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="basicInput">Nama Produk</label>
                        <input type="text" class="form-control mt-3" id="basicInput" name="nama_produk">
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Deskripsi</label>
                        <input type="text" class="form-control mt-3" id="basicInput" name="deskripsi">
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Harga</label>
                        <input type="number" class="form-control mt-3" id="basicInput" name="harga">
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Kategori</label>
                        <select class="form-select" name="kategori">
                            <option selected hidden>Pilih Salah satu kategori</option>
                            <option value="square">Square</option>
                            <option value="rectangle">Rectangle</option>
                            <option value="rombo">Rombo</option>
                            <option value="romboid">Romboid</option>
                            <option value="trapeze">Trapeze</option>
                            <option value="traible">Triangle</option>
                            <option value="polygon">Polygon</option>
                        </select>
                        <p class="text-muted mt-1">ukuran foto maksimal 2mb</p>
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Upload Foto Produk</label>
                        <input class="form-control mt-2" type="file" name="photo" id="formFile">
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

    {{-- MODAL EDIT PRODUK --}}
    <div class="modal fade" id="modalEditProduk" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Produk</h5>
                    {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="basicInput">Nama Produk</label>
                        <input type="text" class="form-control mt-3" id="basicInput" name="nama_produk">
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Deskripsi</label>
                        <input type="text" class="form-control mt-3" id="basicInput" name="deskripsi">
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Harga</label>
                        <input type="number" class="form-control mt-3" id="basicInput" name="harga">
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Kategori</label>
                        <select class="form-select" name="kategori">
                            <option selected hidden>Pilih Salah satu kategori</option>
                            <option value="square">Square</option>
                            <option value="rectangle">Rectangle</option>
                            <option value="rombo">Rombo</option>
                            <option value="romboid">Romboid</option>
                            <option value="trapeze">Trapeze</option>
                            <option value="traible">Triangle</option>
                            <option value="polygon">Polygon</option>
                        </select>
                        <p class="text-muted mt-1">ukuran foto maksimal 2mb</p>
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Upload Foto Produk</label>
                        <input class="form-control mt-2" type="file" name="photo" id="formFile">
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

    {{-- MODAL HAPUS PRODUK --}}
    <div class="modal fade" id="modalHapusProduk" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">HAPUS PRODUK</h5>
                    {{-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{-- <div class="col-4">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body color-card">
                                        <input type="checkbox" class="custom-control-input" id="ck5a">
                                        <label class="custom-control-label" for="ck5a">

                                            <h5 class="card-title text-center mt-3">
                                                Ayam Goreng
                                            </h5>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-4">
                            <div class="card">
                                <div class="card-content">
                                    <input type="checkbox" class="custom-control-input" id="aaa">
                                    <label class="custom-control-label" for="aaa">
                                        <img src="assets/images/samples/motorcycle.jpg" class="card-img-top img-fluid"
                                            alt="singleminded">
                                        <div class="card-body color-card">
                                            <h5 class="card-title fs-6">Ayam Goreng</h5>
                                            <p class="card-text fs-6">
                                                Makanan
                                            </p>
                                            <p class="card-text fs-6">
                                                Rp.12000
                                            </p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-content">
                                    <input type="checkbox" class="custom-control-input" id="aaa">
                                    <label class="custom-control-label" for="aaa">
                                        <img src="assets/images/samples/motorcycle.jpg" class="card-img-top img-fluid"
                                            alt="singleminded">
                                        <div class="card-body color-card">
                                            <h5 class="card-title fs-6">Ayam Goreng</h5>
                                            <p class="card-text fs-6">
                                                Makanan
                                            </p>
                                            <p class="card-text fs-6">
                                                Rp.12000
                                            </p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-content">
                                    <input type="checkbox" class="custom-control-input" id="aaa">
                                    <label class="custom-control-label" for="aaa">
                                        <img src="assets/images/samples/motorcycle.jpg" class="card-img-top img-fluid"
                                            alt="singleminded">
                                        <div class="card-body color-card">
                                            <h5 class="card-title fs-6">Ayam Goreng</h5>
                                            <p class="card-text fs-6">
                                                Makanan
                                            </p>
                                            <p class="card-text fs-6">
                                                Rp.12000
                                            </p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-content">
                                    <input type="checkbox" class="custom-control-input" id="aaa">
                                    <label class="custom-control-label" for="aaa">
                                        <img src="assets/images/samples/motorcycle.jpg" class="card-img-top img-fluid"
                                            alt="singleminded">
                                        <div class="card-body color-card">
                                            <h5 class="card-title fs-6">Ayam Goreng</h5>
                                            <p class="card-text fs-6">
                                                Makanan
                                            </p>
                                            <p class="card-text fs-6">
                                                Rp.12000
                                            </p>
                                        </div>
                                    </label>
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


@endsection

@push('scripts')
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
@endpush
