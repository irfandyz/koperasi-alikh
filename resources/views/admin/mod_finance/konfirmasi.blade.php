@extends('admin.template')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Simpan</th>
                                    <th>Nama anggota</th>
                                    <th>Besar Simpanan</th>
                                    <th>Jenis Simpanan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($tabungan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->created_up)) }}</td>
                                        <td>{{ $item->anggota->nama_anggota }}</td>
                                        <td>Rp.{{ number_format($item->besar_simpanan) }}</td>
                                        <td>{{ $item->jenissimpanan->nama_simpanan ?? '' }}</td>
                                        <td><button type="button" class="btn btn-link btn-primary btn-lg"
                                                data-toggle="modal" data-target="#konfirmasi{{ $item->id_simpan }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
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
    @foreach ($tabungan as $item)
            @csrf
            <div class="modal fade" id="konfirmasi{{ $item->id_simpan }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Tabungan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row p-3">
                                <div class="col-md-5">
                                    <h4>Tanggal Simpanan</h4>
                                    <h4>Nama Anggota</h4>
                                    <h4>Besar Simpanan</h4>
                                    <h4>Jenis Simpanan</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>:</h4>
                                    <h4>:</h4>
                                    <h4>:</h4>
                                    <h4>:</h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>{{ date('d-m-Y', strtotime($item->created_up)) }}</h4>
                                    <h4>{{ $item->anggota->nama_anggota }}</h4>
                                    <h4>Rp.{{ number_format($item->besar_simpanan) }}</h4>
                                    <h4>{{ $item->jenissimpanan->nama_simpanan ?? '' }}</h4>
                                </div>
                            </div>
                            <img class="img-fluid" src="{{ asset('images/'.$item->foto) }}" alt="">
                        </div>
                        <div class="modal-footer">
                            <a href="{{ asset('konfirmasi/'.$item->id_simpan) }}" class="btn btn-primary">Konfirmasi Simpanan</a>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach
@endsection
