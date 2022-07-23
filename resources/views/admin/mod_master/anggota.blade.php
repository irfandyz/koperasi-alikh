@extends('admin.template')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex flex-row justify-content-between">
                    <h4 class="card-title">
                        <button class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Anggota
                        </button>
                    </h4>
                    <h4 class="card-title">
                        <button class="btn btn-secondary" data-toggle="modal" data-target="#importData">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Import Data Anggota
                        </button>
                    </h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>NIK</th>
                                <th>NIP</th>
                                <th>Alamat</th>
                                <th>JK</th>
                                <th>Pekerjaan</th>
                                <th>Tanggal masuk</th>
                                <th>Gaji Bersih</th>
                                <th>Telp</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Foto</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($record as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_anggota }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->pekerjaan }}</td>
                                <td>{{ $item->tgl_masuk }}</td>
                                <td>{{ $item->gaji_bersih }}</td>
                                <td>{{ $item->tempat_lahir }}</td>
                                <td>{{ $item->telp }}</td>
                                <td>{{ $item->tgl_lahir }}</td>

                                <td>
                                    <div class="avatar">
                                        <img src="foto_anggota/{{ $item->foto }}" alt="..." class="avatar-img rounded-circle">
                                    </div>
                                </td>
                                <td><button type="button" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task" data-toggle="modal" data-target="#anggota{{ $item->id_anggota }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a href="{{ asset('hapus-anggota/' . $item->id_anggota) }}" button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove" <?php echo " onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\" "; ?>>
                                        <i class="fa fa-times"></i>
                                        </button></a>
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
<form action="{{ asset('simpan-anggota') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama Anggota </label>
                        <input type="text" name="nama_anggota" required="required" class="form-control" placeholder="Nama  pinjaman..">
                    </div>
                    <div class="form-group">
                        <label>Nik</label>
                        <input type="text" name="nik" required="required" class="form-control" placeholder="NIk penduduk ..">
                    </div>
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="number" name="nip" required="required" class="form-control" placeholder="NIP">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" required="required" class="form-control" placeholder="Alamat ..">
                    </div>
                    <div class="form-group">
                        <label>Gaji Bersih</label>
                        <input type="number" name="gaji_bersih" required="required" class="form-control" placeholder="Gaji Bersih">
                    </div>
                    <div class="form-group">
                        <label>Rekening</label>
                        <input type="number" name="rekening" required="required" class="form-control" placeholder="Rekening">
                    </div>
                    <div class="form-check">
                        <label>Jenis Kelamin</label><br />
                        <label class="form-radio-label">
                            <input class="form-radio-input" type="radio" name="jenis_kelamin" value="Laki-laki" checked="">
                            <span class="form-radio-sign">Laki-laki</span>
                        </label>
                        <label class="form-radio-label ml-3">
                            <input class="form-radio-input" type="radio" name="jenis_kelamin" value="Perempuan">
                            <span class="form-radio-sign">Perempuan</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" name="pekerjaan" required="required" class="form-control" placeholder="Pekerjaan  ..">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Masuk </label>
                        <input type="date" name="tgl_masuk" required="required" class="form-control" placeholder="Tanggal masuk ..">
                    </div>
                    <div class="form-group">
                        <label>No Telp</label>
                        <input type="text" name="telp" required="required" class="form-control" placeholder="No Telp  ..">
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" required="required" class="form-control" placeholder="Tempat Lahir ..">
                    </div>
                    <div class="form-group">
                        <label>Tanggal lahir</label>
                        <input type="date" name="tgl_lahir" required="required" class="form-control" placeholder="Tanggal  lahir ..">
                    </div>
                    <div class="form-group">
                        <label>Foto Anggota</label>
                        <input type="file" name="foto" required="required" class="form-control" placeholder="Foto anggota  ..">
                    </div>
                    <div class="form-group">
                        <label>Setoran Awal / Simpanan Pokok</label>
                        <input type="number" disabled required="required" class="form-control" value="{{ $jenis->besar_simpanan }}">
                        <input type="hidden" name="pokok" required="required" class="form-control" value="{{ $jenis->besar_simpanan }}">
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
<form action="{{ asset('edit-anggota') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="anggota{{ $item->id_anggota }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Pinjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $item->id_anggota }}">
                    <div class="form-group">
                        <label>Nama Anggota </label>
                        <input type="text" name="nama_anggota" value="{{ $item->nama_anggota }}" required="required" class="form-control" placeholder="Nama  pinjaman..">
                    </div>
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" value="{{ $item->nik }}" required="required" class="form-control" placeholder="NIk penduduk ..">
                    </div>
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="number" class="form-control" name="nip" value="{{$item->nip}}" required>
                    </div>
                    <div class="form-group">
                        <label>Golongan</label>
                        <select name="golongan" class="form-control">
                            <option 
                                <?php
                                if ($item->golongan == "I/A") {
                                    echo "selected";
                                }
                                ?>
                            >I/A</option>
                            <option 
                                <?php
                                if ($item->golongan == "I/B") {
                                    echo "selected";
                                }
                                ?>
                            >I/B</option>
                            <option 
                                <?php
                                if ($item->golongan == "I/C") {
                                    echo "selected";
                                }
                                ?>
                            >I/C</option>
                            <option 
                                <?php
                                if ($item->golongan == "I/D") {
                                    echo "selected";
                                }
                                ?>
                            >I/D</option>
                            <option 
                                <?php
                                if ($item->golongan == "II/A") {
                                    echo "selected";
                                }
                                ?>
                            >II/A</option>
                            <option 
                                <?php
                                if ($item->golongan == "II/B") {
                                    echo "selected";
                                }
                                ?>
                            >II/B</option>
                            <option 
                                <?php
                                if ($item->golongan == "II/C") {
                                    echo "selected";
                                }
                                ?>
                            >II/C</option>
                            <option 
                                <?php
                                if ($item->golongan == "II/D") {
                                    echo "selected";
                                }
                                ?>
                            >II/D</option>
                            <option 
                                <?php
                                if ($item->golongan == "III/A") {
                                    echo "selected";
                                }
                                ?>
                            >III/A</option>
                            <option 
                                <?php
                                if ($item->golongan == "III/B") {
                                    echo "selected";
                                }
                                ?>
                            >III/B</option>
                            <option 
                                <?php
                                if ($item->golongan == "III/C") {
                                    echo "selected";
                                }
                                ?>
                            >III/C</option>
                            <option 
                                <?php
                                if ($item->golongan == "III/D") {
                                    echo "selected";
                                }
                                ?>
                            >III/D</option>
                            <option 
                                <?php
                                if ($item->golongan == "IV/A") {
                                    echo "selected";
                                }
                                ?>
                            >IV/A</option>
                            <option 
                                <?php
                                if ($item->golongan == "IV/B") {
                                    echo "selected";
                                }
                                ?>
                            >IV/B</option>
                            <option 
                                <?php
                                if ($item->golongan == "IV/C") {
                                    echo "selected";
                                }
                                ?>
                            >IV/C</option>
                            <option 
                                <?php
                                if ($item->golongan == "IV/D") {
                                    echo "selected";
                                }
                                ?>
                            >IV/D</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Satuan Kerja</label>
                        <select name="satuan_kerja" class="form-control">
                            <option
                            <?php
                                if ($item->satuan_kerja == "SETJEN") {
                                    echo "selected";
                                }
                            ?>
                            >SETJEN</option>
                            <option 
                            <?php
                                if ($item->satuan_kerja == "BIMAS") {
                                    echo "selected";
                                }
                            ?>
                            >BIMAS</option>
                            <option
                            <?php
                                if ($item->satuan_kerja == "PENDIS") {
                                    echo "selected";
                                }
                            ?>
                            >PENDIS</option>
                            <option
                            <?php
                                if ($item->satuan_kerja == "PHU") {
                                    echo "selected";
                                }
                            ?>
                            >PHD</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" value="{{ $item->alamat }}" required="required" class="form-control" placeholder="Alamat ..">
                    </div>
                    <div class="form-group">
                        <label>Gaji Bersih</label>
                        <input type="nominal" name="gaji_bersih" value="{{$item->gaji_bersih}}" required class="form-control">
                    </div>
                    <div class="form-check">
                        <label>Jenis Kelamin</label><br />
                        <label class="form-radio-label">
                            <input class="form-radio-input" type="radio" name="jenis_kelamin" value="Laki-laki" checked="">
                            <span class="form-radio-sign">Laki-laki</span>
                        </label>
                        <label class="form-radio-label ml-3">
                            <input class="form-radio-input" type="radio" name="jenis_kelamin" value="Perempuan">
                            <span class="form-radio-sign">Perempuan</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" name="pekerjaan" value="{{ $item->pekerjaan }}" required="required" class="form-control" placeholder="Pekerjaan  ..">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Masuk </label>
                        <input type="date" name="tgl_masuk" value="{{ $item->tgl_masuk }}" required="required" class="form-control" placeholder="Tanggal masuk ..">
                    </div>
                    <div class="form-group">
                        <label>No Telp</label>
                        <input type="text" name="telp" value="{{ $item->telp }}" required="required" class="form-control" placeholder="No Telp  ..">
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ $item->tempat_lahir }}" required="required" class="form-control" placeholder="Tempat Lahir ..">
                    </div>
                    <div class="form-group">
                        <label>Tanggal lahir</label>
                        <input type="date" name="tgl_lahir" value="{{ $item->tgl_lahir }}" required="required" class="form-control" placeholder="Tanggal  lahir ..">
                    </div>
                    <div class="form-group">
                        <label>Foto Anggota</label>
                        <input type="file" name="foto" value="{{ $item->foto }}" class="form-control" placeholder="Foto anggota  ..">
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
                <h5 class="modal-title">Upload File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{asset('upload-anggota')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="">Upload Excel File</label>
                        <input type="file" name="file" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    
                    <a class="btn btn-success" href="{{asset('assets/template import anggota.xlsx')}}" download>Download Template</a>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection