@extends('admin.template')
@section('content')
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="card-title"><button class="btn btn-secondary" data-toggle="modal"
                            data-target="#tambahTransaksi">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah Transaksi
                        </button></span>
                    <span class="card-title">
                        <a class="btn btn-primary text-white" data-toggle="modal" data-target="#laporan">
                            <span class="btn-label">
                                <i class="fa fa-file-alt"></i>
                            </span>
                            Cetak Laporan
                        </a>
                    </span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Nama Kategori</th>
                                    <th>Nama Jenis Transaksi</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                    <th>Keterangan</th>
                                    <th>Nama Bank</th>
                                    <th>Admin</th>
                                    <th>Print</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->kode_transaksi }}</td>
                                        <td>{{ $data->nama_kategori }}</td>
                                        <td>{{ $data->nama_jenis_transaksi }}</td>
                                        <td>{{ $data->ket == 'debit' ? $data->nominal : '' }}</td>
                                        <td>{{ $data->ket == 'kredit' ? $data->nominal : '' }}</td>
                                        <td>{{ $data->keterangan }}</td>
                                        <td>{{ $data->nama_bank }}</td>
                                        <td>{{ $data->user->username }}</td>
                                        <td><a target="__blank" href="{{ asset('printKeuangan/' . $data->id_transaksi) }}"
                                                class="badge badge-secondary"><i class="fas fa-print"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="laporan" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6 mt-3">
                            <a data-toggle="modal" data-target="#laporanUmum" aria-label="close"
                                class="btn btn-secondary w-100 text-white">Jurnal Umum</a>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <a data-toggle="modal" data-target="#laporanBesar" aria-label="close"
                                class="btn btn-secondary w-100 text-white">Buku Besar</a>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <a data-toggle="modal" data-target="#laporanNeraca" aria-label="close"
                                class="btn btn-secondary w-100 text-white">Neraca Saldo</a>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <a data-toggle="modal" data-target="#laporanIncome" aria-label="close"
                                class="btn btn-secondary w-100 text-white">Income Statement</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="laporanUmum" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="myForm" method="post" action="{{ asset('/laporanTransaksi') }}">
                        @csrf
                        <input type="hidden" name="type" value="laporanUmum">
                        <div class="row">
                            <div class="col">
                                <h4>Tanggal Awal</h4>
                                <input type="date" class="form-control" name="TanggalAwal">
                            </div>
                            <div class="col mt-3 h1">s.d</div>
                            <div class="col">
                                <h4>Tanggal Akhir</h4>
                                <input type="date" class="form-control" name="TanggalAkhir">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Buat Laporan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div id="laporanBesar" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="myForm" method="post" action="{{ asset('/laporanTransaksi') }}">
                        @csrf
                        <input type="hidden" name="type" value="laporanBesar">
                        <div class="row">
                            <div class="col">
                                <h4>Tanggal Awal</h4>
                                <input type="date" class="form-control" name="TanggalAwal">
                            </div>
                            <div class="col mt-3 h1">s.d</div>
                            <div class="col">
                                <h4>Tanggal Akhir</h4>
                                <input type="date" class="form-control" name="TanggalAkhir">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Buat Laporan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div id="laporanNeraca" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="myForm" method="post" action="{{ asset('/laporanTransaksi') }}">
                        @csrf
                        <input type="hidden" name="type" value="laporanNeraca">
                        <div class="row">
                            <div class="col">
                                <h4>Tanggal Awal</h4>
                                <input type="date" class="form-control" name="TanggalAwal">
                            </div>
                            <div class="col mt-3 h1">s.d</div>
                            <div class="col">
                                <h4>Tanggal Akhir</h4>
                                <input type="date" class="form-control" name="TanggalAkhir">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Buat Laporan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div id="laporanIncome" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="myForm" method="post" action="{{ asset('/laporanTransaksi') }}">
                        @csrf
                        <input type="hidden" name="type" value="laporanIncome">
                        <div class="row">
                            <div class="col">
                                <h4>Tanggal Awal</h4>
                                <input type="date" class="form-control" name="TanggalAwal">
                            </div>
                            <div class="col mt-3 h1">s.d</div>
                            <div class="col">
                                <h4>Tanggal Akhir</h4>
                                <input type="date" class="form-control" name="TanggalAkhir">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Buat Laporan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div id="tambahTransaksi" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="myForm" method="post" action="{{ asset('/tambah-transaksi') }}">
                        @csrf
                        <input type="hidden" name="type" value="tambahTransaksi">
                        <div class="form-group">
                            <label>Jenis Transaksi</label>
                            <select class="form-control" id="selectedTransaksi" name="id_jenis_transaksi">
                                <option>- Jenis Transaksi -</option>
                                @foreach ($jenistransaksi as $jt)
                                    <option value="{{ $jt->id_jenis_transaksi }}">{{ $jt->nama_jenis_transaksi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Transaksi</label>
                            <select class="form-control" name='id_kategori_transaksi' id="selectedKategori">
                                <option> - Transaksi - </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan"></textarea>
                        </div>

                        <div class="d-flex d-flex-row row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" name="nominal" placeholder="Jumlah">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="id_bank">
                                        <option>- Bank -</option>
                                        @foreach ($bank as $data)
                                            <option value="{{ $data->id_bank }}">{{ $data->nama_bank }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('#selectedTransaksi').on('change', function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                let data = $('#myForm').serialize();
                $.ajax({
                    url: '/requestTransaksi',
                    method: 'post',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        var x;
                        try {
                            x = JSON.parse(response);
                        } catch (e) {
                            x = response;
                        }
                        var data = x['kategori'];
                        var selectOpt = $('#selectedKategori');
                        selectOpt.empty();
                        var selOpts = "";
                        for (let i = 0; i < data.length; i++) {
                            var id = data[i]['id_kategori_transaksi'];
                            var val = data[i]['nama_kategori'];
                            selOpts += "<option value='" + id + "'>" + val + "</option>";
                        }
                        selectOpt.append(selOpts);
                    }
                });
            });
        });
    </script>
@endsection
