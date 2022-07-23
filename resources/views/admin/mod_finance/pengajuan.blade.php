@extends('admin.template')
@section('content')
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-row justify-content-around">
                        <h4 class="card-title"><button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                <span class="btn-label">
                                    <i class="fa fa-cash-register"></i>
                                </span>
                                Konfirmasi Pengajuan <span class="badge badge-danger">
                                    {{ $record->where('status', '0')->count() }}</span>
                            </button>
                        </h4>
                        <h4 class="card-title"><button class="btn btn-primary" data-toggle="modal"
                                data-target="#importData">
                                Import Data
                            </button>
                        </h4>
                        <h4 class="card-title"><button class="btn btn-primary" data-toggle="modal"
                                data-target="#tambahPengajuan">
                                Tambah Data
                            </button></h4>
                    </div>
                </div>
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($record as $item)
                                    <tr
                                        class="{{ $item->status == '1' ? 'table-danger' : ($item->status == '2' ? 'table-success' : 'table-primary') }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tgl_pengajuan }}</td>
                                        <td>{{ $item->anggota->nama_anggota ?? '' }}</td>
                                        <td>{{ $item->tenor->jenispinjaman->nama_pinjaman ?? '' }}</td>
                                        <td>{{ $item->tenor->lama_tenor ?? '' }} Bulan</td>
                                        <td>Rp.{{ number_format($item->besar_pinjam) }}</td>
                                        <td>{{ $item->user->username ?? '' }}</td>
                                        @if ($item->status == '2')
                                            @if ($item->tenor->jenispinjaman->nama_pinjaman == 'pinjaman piutang')
                                                <td><a href="" class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#modalInfo{{ $item->id_pengajuan }}">Detail
                                                        Peminjaman</a>
                                                </td>
                                            @else
                                                <td><a href="" class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#modalInfo2{{ $item->id_pengajuan }}">Detail
                                                        Peminjaman</a>
                                                </td>
                                            @endif
                                        @elseif ($item->status == '1')
                                            <td>Menunggu Konfirmasi Pihak yang berkewajiban</td>
                                        @else
                                            <td>Sedang dalam pending</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($record->where('status', '2') as $item)
        <div class="modal fade" id="modalInfo2{{ $item->id_pengajuan }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Peminjaman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pokok</th>
                                        <th>Jasa</th>
                                        <th>Admin</th>
                                        <th>Total Utang</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $number = App\Models\Peminjaman::where('id_pengajuan', $item->id_pengajuan)->count();
                                    
                                    ?>
                                    @foreach (App\Models\Peminjaman::where('id_pengajuan', $item->id_pengajuan)->get() as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>Rp.{{ number_format($data->pokok) }}</td>
                                            <td>Rp.{{ number_format($data->jasa) }}</td>
                                            <td>
                                                <?php
                                                if ($number >= 10 && $number <= 20) {
                                                    $total = round(($data->pokok + $data->jasa) * 0.015);
                                                } elseif ($number > 20) {
                                                    $total = round(($data->pokok + $data->jasa) * 0.02);
                                                } else {
                                                    $total = round(($data->pokok + $data->jasa) * 0.01);
                                                }
                                                echo 'Rp. ' . number_format($total);
                                                ?>
                                            </td>
                                            <td>Rp. {{ number_format($data->pokok + $data->jasa + $total) }}</td>
                                            <td>{{ $data->status == 'N' ? 'Belum Terbayarkan' : 'Terbayar' }}</td>
                                            <td>
                                                @if ($data->status == 'N')
                                                    <a href="{{ asset('update-status/' . $data->id_peminjaman) }}"
                                                        class="btn btn-primary btn-sm">Lunas</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex text-left flex-row justify-content-start">
                            <div>
                                <h5>Total&nbsp;</h5>
                            </div>
                            <div>
                                <h5>Rp.
                                    {{ number_format(
                                        App\Models\Peminjaman::where([['id_pengajuan', '=', $item->id_pengajuan], ['status', '=', 'N']])->sum('jumlah'),
                                    ) }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($record->where('status', '2') as $item)
        <div class="modal fade" id="modalInfo{{ $item->id_pengajuan }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Peminjaman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pokok</th>
                                        <th>Jasa</th>
                                        <th>Status</th>
                                        <th>Periode</th>
                                        <th>Admin</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $number = App\Models\Peminjaman::where('id_pengajuan', $item->id_pengajuan)->count();
                                    
                                    ?>
                                    @foreach (App\Models\Peminjaman::where('id_pengajuan', $item->id_pengajuan)->get() as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>Rp.{{ number_format($data->pokok) }}</td>
                                            <td>Rp.{{ number_format($data->jasa) }}</td>
                                            <td>{{ $data->status == 'N' ? 'Belum Terbayarkan' : 'Terbayar' }}</td>
                                            <td>{{ $data->periode }}</td>
                                            <td>
                                                <?php
                                                if ($number >= 10 && $number <= 20) {
                                                    $total = round(($data->pokok + $data->jasa) * 0.015);
                                                } elseif ($number > 20) {
                                                    $total = round(($data->pokok + $data->jasa) * 0.02);
                                                } else {
                                                    $total = round(($data->pokok + $data->jasa) * 0.01);
                                                }
                                                echo 'Rp. ' . number_format($total);
                                                ?>
                                            </td>
                                            @if ($data->status == 'N' && $data->jumlah == null)
                                                <td>
                                                    <a href="{{ asset('addBankNominal/' . $data->id_peminjaman) }}"
                                                        class="btn btn-primary btn-sm">Input Utang Bank</a>
                                                </td>
                                            @elseif ($data->status == 'N' && $data->jumlah != null)
                                                <td>
                                                    <a href="{{ asset('update-status/' . $data->id_peminjaman) }}"
                                                        class="btn btn-primary btn-sm">Lunas</a>
                                                </td>
                                            @else
                                                <td>
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ asset('detailPeminjaman/' . $data->id_peminjaman) }}">Detail</a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex text-left flex-row justify-content-start">
                            <div>
                                <h5>Total&nbsp;</h5>
                            </div>
                            <div>
                                <h5>Rp.
                                    {{ number_format(App\Models\Peminjaman::where([['id_pengajuan', '=', $item->id_pengajuan], ['status', '=', 'N']])->sum('jasa') + App\Models\Peminjaman::where([['id_pengajuan', '=', $item->id_pengajuan], ['status', '=', 'N']])->sum('pokok')) }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach




    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pengajuan</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="basic-datatables" class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Nama anggota</th>
                                <th>Jenis Pengajuan</th>
                                <th>Tenor</th>
                                <th>Besar Pinjaman</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($record->where('status', '0') as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tgl_pengajuan }}</td>
                                    <td>{{ $item->anggota->nama_anggota ?? '' }}</td>
                                    <td>{{ $item->tenor->jenispinjaman->nama_pinjaman ?? '' }}</td>
                                    <td>{{ $item->tenor->lama_tenor ?? '' }} Bulan</td>
                                    <td>Rp.{{ number_format($item->besar_pinjam) }}</td>
                                    <td><a data-toggle="modal" data-target="#pengajuan{{ $item->id_pengajuan }}"
                                            class="btn btn-warning text-white btn-sm"><i class="fas fa-info"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($record as $item)
        <div class="modal fade" id="pengajuan{{ $item->id_pengajuan }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Tabungan</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row p-3">
                            <div class="col-md-5">
                                <h4>Tanggal Pengajuan</h4>
                                <h4>Nama anggota</h4>
                                <h4>Jenis Pinjaman</h4>
                                <h4>Tenor</h4>
                                <h4>Besar Pinjaman</h4>
                            </div>
                            <div class="col-md-1">
                                <h4>:</h4>
                                <h4>:</h4>
                                <h4>:</h4>
                                <h4>:</h4>
                                <h4>:</h4>
                            </div>
                            <div class="col-md-6">
                                <h4>{{ $item->tgl_pengajuan }}</h4>
                                <h4>{{ $item->anggota->nama_anggota ?? '' }}</h4>
                                <h4>{{ $item->tenor->jenispinjaman->nama_pinjaman ?? '' }}</h4>
                                <h4>{{ $item->tenor->lama_tenor ?? '' }} Bulan</h4>
                                <h4>Rp.{{ number_format($item->besar_pinjam) }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ asset('konfirmasi-pengajuan/' . $item->id_pengajuan) }}"
                            class="btn btn-success btn-block">Konfirmasi Pengajuan</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <div class="modal fade" id="tambahPengajuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Peminjam</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ asset('addPeminjaman') }}" id="myForm" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Anggota</label>
                            <input type="text" class="form-control" name="nama" autocomplete="off"
                                id="myInput">
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Pinjaman</label>
                            <select name="id_jenis_pinjaman" class="form-control" id="selectedJenisPinjaman">
                                <option> - Jenis Pinjaman - </option>
                                @foreach ($pinjaman as $data)
                                    <option value="{{ $data->id_jenispinjaman }}">{{ $data->nama_pinjaman }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tenor</label>
                            <select name="id_tenor" class="form-control" id="selectedTenor">
                                <option> - Tenor - </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nominal</label>
                            <input type="number" name="besar_pinjaman" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="importData" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ asset('upload-peminjaman') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Import Data</label>
                            <input type="file" name="file" class="form-control" id="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success" href="{{ asset('assets/template import tagihan.xlsx') }}"
                            download>Download Template</a>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var countries = <?= json_encode($member) ?>;

        function autocomplete(inp, arr) {
            var currentFocus;
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                closeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                this.parentNode.appendChild(a);
                for (i = 0; i < arr.length; i++) {
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        b = document.createElement("DIV");
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        b.innerHTML += "<input class='form-control' type='hidden' value='" + arr[i] + "'>";
                        b.addEventListener("click", function(e) {
                            inp.value = this.getElementsByTagName("input")[0].value;
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    currentFocus++;
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    currentFocus--;
                    addActive(x);
                } else if (e.keyCode == 13) {
                    e.preventDefault();
                    if (currentFocus > -1) {
                        if (x) x[currentFocus].click();
                    }
                }
            });

            function addActive(x) {
                if (!x) return false;
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                x[currentFocus].classList.add("autocomplete-active");
            }

            function removeActive(x) {
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }

            function closeAllLists(elmnt) {
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        }
        autocomplete(document.getElementById("myInput"), countries);

        $(function() {
            $('#selectedJenisPinjaman').on('change', function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                let data = $('#myForm').serialize();
                $.ajax({
                    url: '/requestTenor',
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
                        var data = x['tenor'];
                        console.log(data);
                        var selectOpt = $('#selectedTenor');
                        selectOpt.empty();
                        var selOpts = "";
                        for (let i = 0; i < data.length; i++) {
                            var id = data[i]['id_tenor'];
                            var val = data[i]['lama_tenor'] + " Bulan";
                            selOpts += "<option value='" + id + "'>" + val + "</option>";
                        }
                        selectOpt.append(selOpts);
                    }
                });
            });
        });
    </script>
@endsection
