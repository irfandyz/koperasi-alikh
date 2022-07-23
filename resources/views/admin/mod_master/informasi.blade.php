@extends('admin.template')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><button class="btn btn-secondary" data-toggle="modal"
                            data-target="#tambah">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah Informasi
                        </button></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Informasi</th>
                                    <th>Warna Background</th>
                                    <th>Gambar Background</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Terakhir diubah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($informasi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->information }}</td>
                                        <td><input type="color" disabled value="{{ $item->bg_color }}"></td>
                                        <td><img src="{{ asset('information/'.$item->bg_image) }}" alt="" class="img-fluid"></td>
                                        <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                                        <td>{{ date('Y-m-d', strtotime($item->updated_at)) }}</td>
                                        <td><a data-toggle="modal" data-target="#informasi{{ $item->id_information }}" class="text-white badge badge-primary"><i class="fas fa-edit"></i></a><a
                                                href="{{ asset('hapus-informasi/'.$item->id_information) }}" class="badge text-white badge-danger "><i class="fas fa-times"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($informasi as $item)
        <form action="{{ asset('edit-informasi') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="informasi{{ $item->id_information }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Informasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <h4>Informasi :</h4>
                                <input type="text" name="informasi" value="{{ $item->information }}" class="form-control mb-3">
                                <input type="hidden" name="id" value="{{ $item->id_information }}" >
                                <h4>Warna Background :</h4>
                                <input type="color" name="color" value="{{ $item->bg_color }}" style="" class=" mb-3">
                                <h4>Gambar :</h4>
                                <img src="{{ asset('information/'.$item->bg_image) }}" class="img-fluid">
                                <input type="file" name="image" class="form-control mb-3">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endforeach
    <form action="{{ asset('tambah-informasi') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Informasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <h4>Informasi :</h4>
                            <input type="text" name="informasi" class="form-control mb-3">
                            <h4>Warna Background :</h4>
                            <input type="color" name="color" style="" class=" mb-3">
                            <h4>Gambar :</h4>
                            <input type="file" name="image" class="form-control mb-3">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
