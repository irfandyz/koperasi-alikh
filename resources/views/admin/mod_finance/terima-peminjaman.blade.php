@extends('admin.template')
@section('content')
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Nama anggota</th>
                                    <th>Jenis Pengajuan</th>
                                    <th>Tenor</th>
                                    <th>Besar Pinjaman</th>
                                    <th>Admin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($record as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tgl_pengajuan }}</td>
                                        <td>{{ $item->anggota->nama_anggota ?? ''}}</td>
                                        <td>{{ $item->tenor->jenispinjaman->nama_pinjaman ?? '' }}</td>
                                        <td>{{ $item->tenor->lama_tenor ?? '' }} Bulan</td>
                                        <td>Rp.{{ number_format($item->besar_pinjam) }}</td>
                                        <td>{{ $item->user->username ?? '' }}</td>
                                        <td><a href="{{asset('update-status-pengajuan/'.$item->id_pengajuan)}}" class="btn btn-primary btn-sm text-light">Terima</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
