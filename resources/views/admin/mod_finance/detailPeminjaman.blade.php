@extends('admin.template')
@section('content')
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
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
                                    <th>Jasa</th>
                                    <th>Pokok</th>
                                    <th>Barang</th>
                                    <th>Zakat Profesi</th>
                                    <th>Pokja</th>
                                    <th>{{$peminjaman->nama_bank}}</th>
                                    <th>Admin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Rp. {{number_format($peminjaman->jasa)}}</td>
                                    <td>Rp. {{number_format($peminjaman->pokok)}}</td>
                                    <td>Rp. {{number_format($peminjaman->barang)}}</td>
                                    <td>Rp. {{number_format($peminjaman->zakat_profesi)}}</td>
                                    <td>Rp. {{number_format($peminjaman->pokja)}}</td>
                                    <td>Rp. {{number_format($peminjaman->jumlah)}}</td>
                                    <td>Rp. {{number_format($admin)}}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-left" colspan="1">Gaji Bersih</th>
                                    <th class="text-right" colspan="5">Rp. {{ number_format($anggota->gaji_bersih)}}</th>
                                </tr>
                                <tr>
                                    <th class="text-left" colspan="1">Total Utang</th>
                                    <th class="text-right" colspan="5">Rp. {{ number_format($peminjaman->jasa + $peminjaman->pokok + $peminjaman->barang + $peminjaman->zakat_profesi + $peminjaman->jumlah + $peminjaman->pokja + $admin)}}</th>
                                </tr>
                                <tr>
                                    <th class="text-left" colspan="1">Sisa Gaji</th>
                                    <th class="text-right" colspan="5">Rp. {{number_format($anggota->gaji_bersih - ($peminjaman->jasa + $peminjaman->jumlah + $peminjaman->pokok + $peminjaman->barang + $peminjaman->zakat_profesi + $peminjaman->pokja + $admin))}}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
