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
                    {{-- <h3>Produk Kantin {{ $products[0]->outlet_name != null ? $products[0]->outlet_name : 'nan' }}</h3> --}}
                    <h3>Produk Kantin {{ $outlet_name[0]->name != null ? $outlet_name[0]->name : 'nan' }}</h3>
                    <p>Pantau produk kantin dari sini</p>
                </div>
                <div class="flex-end">
                    <div class="btn-group mb-1 mr-3">
                        <div class="dropdown">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-pencil"></i>
                                Atur Category
                            </button>
                            <div class="dropdown-menu">
                                <button class="dropdown-item" data-bs-toggle="modal"
                                    data-bs-target="#modalTambahCategory"><i class="bi bi-plus"></i>
                                    <span>Tambah Category</span></button>
                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEditCategory"><i
                                        class="bi bi-pencil"></i>
                                    <span>Edit Category</span></button>
                                <button class="dropdown-item" data-bs-toggle="modal"
                                    data-bs-target="#modalDeleteCategory"><i class="bi bi-trash"></i>
                                    <span>Hapus Category</span></button>
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
                    @foreach ($for_categories as $item)
                        {{-- @foreach ($categories as $row) --}}
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
                        {{-- @endforeach --}}
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
                                                    data-bs-target="#modalDeleteProduct"><i class="bi bi-trash"></i>
                                                    <span>Hapus Produk</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($products as $item)
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="card">
                                                <div class="card-content">
                                                    <button class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditProduk{{ $item->id_product }}">
                                                        <img src="{{ $item->image_product != null ? asset('storage/uploads/products/' . $item->image_product) : asset('assets/no-image.png') }}"
                                                            class="card-img-top img-fluid" alt="{{ $item->image_product }}">
                                                        <div class="card-body color-card">
                                                            <h5 class="card-title">{{ $item->nama_makanan }}</h5>
                                                            <p class="card-text">
                                                                {{ $item->description }}
                                                            </p>
                                                            <p class="card-text">
                                                                Rp.{{ number_format($item->price_final) }}
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
        </section>
    </div>

    {{-- MODAL TAMBAH Category --}}
    <div class="modal fade" id="modalTambahCategory" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Category</h5>
                </div>
                <form action="{{ route('menu.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <input type="text" hidden name="id_outlet" value="{{ $id_outlet }}">
                            <label for="basicInput">Nama Category</label>
                            <input type="text" class="form-control mt-3" id="basicInput"
                                name="name"value="{{ old('name') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="basicInput">Deskripsi</label>
                            <input type="text" class="form-control mt-3" id="basicInput" name="description"
                                value="{{ old('description') }}">
                        </div>
                        {{-- <div class="form-group mb-3">
                            <label for="basicInput">Upload Foto Category</label>
                            <input class="form-control mt-2" type="file" name="image" id="formFile">
                        </div> --}}
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

    {{-- MODAL EDIT Category --}}
    <div class="modal fade" id="modalEditCategory" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Kategori</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @foreach ($categories as $item)
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-content">
                                        <button class="dropdown-item" href="#" data-bs-toggle="modal"
                                            data-bs-target="#modalEditDetailCategory{{ $item->id }}">
                                            <div class="card-body color-card">
                                                {{-- <img src="{{ $item->image != null ? asset('storage/uploads/categories/' . $item->image) : asset('assets/no-image.png') }}"
                                                    class="card-img-top img-fluid" alt="{{ $item->image }}"> --}}
                                                <h5 class="card-title text-center mt-2">{{ $item->name }}</h5>
                                                {{-- <p class="card-title text-center mt-2">{{ $item->description }}</p> --}}
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
            </div>
        </div>
    </div>

    {{-- MODAL EDIT DETAIL CATEGORY --}}
    @foreach ($categories as $item)
        <div class="modal fade" id="modalEditDetailCategory{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Category</h5>
                    </div>
                    <form action="{{ route('menu.update', $item->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <input type="text" hidden name="id_outlet" value="{{ $id_outlet }}">
                                <input type="text" hidden name="id_category" value="{{ $item->id }}">
                                <label for="basicInput">Nama Category</label>
                                <input type="text" class="form-control mt-3" id="basicInput"
                                    name="name"value="{{ $item->name }}">
                            </div>
                            <p>Pilih Makanan dan Minuman</p>
                            <div class="row">
                                @foreach ($products as $item)
                                    <div class="col-4">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body color-card">
                                                    <div class="custom-control custom-checkbox image-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            name="id_product[]" id="ck{{ $item->id_product }}"
                                                            value="{{ $item->id_product }}">
                                                        <label class="custom-control-label"
                                                            for="ck{{ $item->id_product }}">
                                                            <img src="{{ $item->image_product != null ? asset('storage/uploads/products/' . $item->image_product) : asset('assets/no-image.png') }}"
                                                                alt="#" class="img-fluid">
                                                            <h5 class="mt-2">{{ $item->nama_makanan }}</h5>
                                                            <p>{{ $item->description }}</p>
                                                            <p>Rp.{{ number_format($item->original_price) }}</p>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
    @endforeach

    {{-- MODAL HAPUS CATEGORY --}}
    <div class="modal fade" id="modalDeleteCategory" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">HAPUS Category</h5>
                </div>
                <form action="{{ route('menu.destroy') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            @foreach ($categories as $item)
                                <div class="col-4">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="card-body color-card">
                                                <div class="custom-control custom-checkbox image-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="id_product_{{ $item->id }}" id="ck{{ $item->id }}"
                                                        value="{{ $item->id }}">
                                                    <label class="custom-control-label" for="ck{{ $item->id }}">
                                                        <h5 class="mt-2">{{ $item->name }}</h5>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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

    {{-- MODAL HAPUS DETAIL CATEGORY --}}
    {{-- @foreach ($categories as $item)
        <div class="modal fade" id="modalDeleteDetailCategory{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Ingin Menghapus Category
                            {{ $item->name }}?</h5>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <a href="{{ route('menu.destroy', $item->id) }}" class="btn btn-danger ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Delete</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach --}}


    {{-- MODAL TAMBAH PRODUCT --}}
    <div class="modal fade" id="modalTambahProduk" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Produk</h5>
                </div>
                <form action="{{ route('menu.store.product') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="basicInput">Nama Produk</label>
                            <input type="text" class="form-control mt-3" id="basicInput" name="name"
                                value="{{ old('name') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="basicInput">Deskripsi</label>
                            <textarea type="text" class="form-control mt-3" id="basicInput" name="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="basicInput">Harga Jual</label>
                            <input type="number" class="form-control mt-3" id="basicInput" name="original_price"
                                value="{{ old('original_price') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="basicInput">Harga Modal</label>
                            <input type="number" class="form-control mt-3" id="basicInput" name="cost_price"
                                value="{{ old('cost_price') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="basicInput">Diskon</label>
                            <input type="number" class="form-control mt-3" id="basicInput" name="discount"
                                value="{{ old('discount') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="basicInput">Kategori</label>
                            <select class="form-select" name="id_category">
                                <option {{ old('id_category') == null ? 'selected' : '' }} hidden>Pilih Salah satu kategori
                                </option>
                                @foreach ($categories as $item)
                                    <option value="{{ old('id_category') != null ? old('id_category') : $item->id }}"
                                        {{ old('id_category') != null ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="basicInput">Upload Foto Produk</label>
                            <input class="form-control mt-2" type="file" name="image" id="formFile">
                            <p class="text-muted mt-1">ukuran foto maksimal 2mb</p>
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

    {{-- MODAL EDIT PRODUK BELUM --}}
    @foreach ($products as $item)
        <div class="modal fade" id="modalEditProduk{{ $item->id_product }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Produk</h5>
                    </div>
                    <form action="{{ route('menu.update.product', $item->id_product) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <input type="hidden" name="id_product" value="{{ $item->id_product }}">
                                <label for="basicInput">Nama Produk</label>
                                <input type="text" class="form-control mt-3" id="basicInput" name="name"
                                    value="{{ old('name') != null ? old('name') : $item->nama_makanan }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="basicInput">Deskripsi</label>
                                <textarea type="text" class="form-control mt-3" id="basicInput" name="description">{{ old('description') != null ? old('description') : $item->description }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="basicInput">Harga Jual</label>
                                <input type="number" class="form-control mt-3" id="basicInput" name="original_price"
                                    value="{{ old('original_price') != null ? old('original_price') : $item->original_price }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="basicInput">Harga Modal</label>
                                <input type="number" class="form-control mt-3" id="basicInput" name="cost_price"
                                    value="{{ old('cost_price') != null ? old('cost_price') : $item->cost_price }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="basicInput">Diskon</label>
                                <input type="number" class="form-control mt-3" id="basicInput" name="discount"
                                    value="{{ old('discount') != null ? old('discount') : $item->discount }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="basicInput">Kategori</label>
                                <select class="form-select" name="id_category">
                                    @foreach ($categories as $row)
                                        @if (old('id_category'))
                                            <option value="{{ old('id_category') }}"
                                                {{ old('id_category') == $row->id ? 'selected' : '' }}>
                                                {{ $row->name }}
                                            </option>
                                        @else
                                            <option value="{{ $row->id }}"
                                                {{ $item->id_category == $row->id ? 'selected' : '' }}>
                                                {{ $row->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="basicInput">Upload Foto Produk</label>
                                <input class="form-control mt-2" type="file" name="image" id="formFile">
                                <p class="text-muted mt-1">ukuran foto maksimal 2mb</p>
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
    @endforeach

    {{-- MODAL HAPUS PRODUK --}}
    <div class="modal fade" id="modalDeleteProduct" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">HAPUS PRODUCT</h5>
                </div>
                <form action="{{ route('menu.destroy.product') }}" method="post">
                    @csrf
                    <div class="modal-body mx-3">
                        <div class="row">
                            @foreach ($products as $item)
                                <div class="col-4">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="card-body color-card">
                                                <div class="custom-control custom-checkbox image-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="id_product_{{ $item->id_product }}"
                                                        id="ck{{ $item->id_product }}" value="{{ $item->id_product }}">
                                                    <label class="custom-control-label" for="ck{{ $item->id_product }}">
                                                        <img src="{{ $item->image_product != null ? asset('storage/uploads/products/' . $item->image_product) : asset('assets/no-image.png') }}"
                                                            alt="#" class="img-fluid">
                                                        <h5 class="mt-2">{{ $item->nama_makanan }}</h5>
                                                        <p>{{ $item->description }}</p>
                                                        <p>Rp.{{ number_format($item->original_price) }}</p>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-danger ml-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Delete</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL HAPUS DETAIL --}}
    {{-- @foreach ($products as $item)
        <div class="modal fade" id="modalDeleteDetailCategory{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Ingin Menghapus Category
                            {{ $item->name }}?</h5>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <a href="{{ route('menu.destroy', $item->id) }}" class="btn btn-danger ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Delete</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach --}}


@endsection

@push('scripts')
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
@endpush
