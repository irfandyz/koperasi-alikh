@extends('admin.template')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <h4>Data Transfer</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Transfer</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Jumlah Transfer</th>
                                    <th>Penerima</th>
                                    <th>Pengirim</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($transfer as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kode_transfer }}</td>
                                        <td>{{ date('d-m-Y',strtotime($item->created_at)) }}</td>
                                        <td>Rp.{{ number_format($item->jumlah) }}</td>
                                        <td>{{ $anggota->where('id_anggota',$item->id_pengirim)->first()->nama_anggota ?? '' }}</td>
                                        <td>{{ $anggota->where('id_anggota',$item->id_penerima)->first()->nama_anggota ?? '' }}</td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
