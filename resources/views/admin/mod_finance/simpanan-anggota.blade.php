@extends('admin.template')
@section('style')
    <style>
        .autocomplete-items {
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 10;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
        }

        .autocomplete-items div {
            padding: 10px;
            display: block;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }

        .autocomplete-items div:hover {
            /*when hovering an item:*/
            background-color: #e9e9e9;
        }

        .autocomplete-active {
            /*when navigating through the items using the arrow keys:*/
            background-color: DodgerBlue !important;
            color: #ffffff;
        }

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="card-title"><button class="btn btn-secondary" data-toggle="modal"
                            data-target="#exampleModal">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Simpanan Anggota
                        </button></span>
                    <span class="card-title"><a class="btn btn-primary text-white" data-toggle="modal"
                            data-target="#laporan">
                            <span class="btn-label">
                                <i class="fa fa-file-alt"></i>
                            </span>
                            Cetak Laporan
                        </a></span>
                    
                    <span class="card-title"><a class="btn btn-primary text-white" data-toggle="modal"
                            data-target="#importData">
                            <span class="btn-label">
                                <i class="fa fa-file-alt"></i>
                            </span>
                            Import Data
                        </a></span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal bayar</th>
                                    <th>Nama anggota</th>
                                    <th>Jenis setoran</th>
                                    <th>Jumlah</th>
                                    <th>Admin</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($record as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tgl_simpan }}</td>
                                        <td>{{ $item->anggota->nama_anggota ?? '' }}</td>
                                        <td>{{ $item->jenissimpanan->nama_simpanan }}</td>
                                        <td>Rp.{{ number_format($item->besar_simpanan) }}</td>
                                        <td>{{ $item->user->username }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{$record->links('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>
    <div id="laporan" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="myForm" method="post" action="{{ asset('/laporanSimpanan') }}">
                        @csrf
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
    <form action="{{ asset('simpan-simpanananggota') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Simpanan Anggota</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Tanggal simpanan</label>
                            <input type="date" name="tgl_simpan" required="required" class="form-control"
                                placeholder="Tanggal  Simpanan..">
                        </div>
                        <div class="form-group">
                            <label>Nama Anggota</label>
                            <input type="text" name="id_anggota" class="form-control" autocomplete id="myInput">
                            {{-- <select class="form-control" name="id_anggota">
                                <?php $anggota = DB::select('select * from tb_anggota');
                                    foreach ($anggota as $r) {
                                ?>
                                <option value="<?php echo $r->id_anggota; ?>"><?php echo $r->nip; ?> :: <?php echo $r->nama_anggota; ?></option>
                                <?php } ?>
                            </select> --}}
                        </div>
                        <div class="form-group">
                            <label>Jenis Simpanan</label>
                            <select class="form-control" name="id_jenissimpanan">
                                <?php $simpanan = DB::select('select * from tb_jenissimpanan');
                        foreach ($simpanan as $rx) {
                         ?>
                                <option value="<?php echo $rx->id_jenissimpanan; ?>"><?php echo $rx->nama_simpanan; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Besar Simpanan</label>
                            <input type="text" name="besar_simpanan" required="required" class="form-control"
                                placeholder="Besar simpanan ..">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @foreach ($record as $item)
        <form action="{{ asset('edit-simpanananggota') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="simpanananggota{{ $item->id_simpan }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Simpanan Anggota/h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" value="{{ $item->id_simpan }}">
                            <div class="form-group">
                                <label>Tanggal simpanan</label>
                                <input type="date" name="tgl_simpan" value="{{ $item->tgl_simpan }}" required="required"
                                    class="form-control" placeholder="Tanggal  Simpanan..">
                            </div>
                            <div class="form-group">
                                <label>Nama Anggota</label>
                                <select class="form-control" name="id_anggota">
                                    <option value="<?php echo $item->id_anggota; ?>"><?php echo $item->nik; ?> :: <?php echo $item->nama_anggota; ?>
                                    </option>
                                    <?php $anggota = DB::select('select * from tb_anggota');
                        foreach ($anggota as $r) {
                         ?>
                                    <option value="<?php echo $r->id_anggota; ?>"><?php echo $r->nip; ?> :: <?php echo $r->nama_anggota; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jenis Simpanan</label>
                                <select class="form-control" name="id_jenissimpanan">
                                    <option value="<?php echo $item->id_jenissimpanan; ?>"><?php echo $item->nama_simpanan; ?></option>
                                    <?php $simpanan = DB::select('select * from tb_jenissimpanan');
                        foreach ($simpanan as $rx) {
                         ?>
                                    <option value="<?php echo $rx->id_jenissimpanan; ?>"><?php echo $rx->nama_simpanan; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Besar Simpanan</label>
                                <input type="text" name="besar_simpanan" value="{{ $item->besar_simpanan }}"
                                    required="required" class="form-control" placeholder="Besar simpanan ..">
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
    
    <div class="modal fade" id="importData" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ asset('upload-simpanan') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Import Data</label>
                            <input type="file" name="file" class="form-control" id="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!--<a class="btn btn-success" href="{{ asset('assets/template import tagihan.xlsx') }}"-->
                        <!--    download>Download Template</a>-->
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
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
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
                            var val = data[i]['lama_tenor'] + " Tahun";
                            selOpts += "<option value='" + id + "'>" + val + "</option>";
                        }
                        selectOpt.append(selOpts);
                    }
                });
            });
        });
    </script>
@endsection
