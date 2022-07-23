@extends('admin.template')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><button class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Pinjaman Langsung
                        </button></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Nama</td>
                                    <td>NIP</td>
                                    <td>Pokok Jasa</td>
                                    <td>No Kas</td>
                                    <td>Tanggal Mulai</td>
                                    <td>Tanggal Selesai</td>
                                    <td>Tenor</td>
                                    <td>Simpanan Wajib</td>
                                    <td>Simpanan Hari Raya (SHR)</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $anggota->find($item->id_anggota)->nama_anggota }}</td>
                                        <td>{{ $item->nip }}</td>
                                        <td>{{ $item->pokok_jasa }}</td>
                                        <td>{{ $item->no_kas }}</td>
                                        <td>{{ $item->tgl_mulai }}</td>
                                        <td>{{ $item->tgl_selesai }}</td>
                                        <td>{{ $item->tenor }}</td>
                                        <td>{{ $item->simpanan_wajib }}</td>
                                        <td>{{ $item->shr }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{ asset('tambahLangsung') }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label>Nama Anggota</label>
                            <input class="form-control form-control-sm" onkeyup="search()" type="text" autocomplete="off"
                                id="name" name="nama">
                            <ul id="box"></ul>
                            <div id="afterComplete" class="d-none">
                                <label>NIP</label>
                                <input type="number" name="nip" id="nip" class="form-control form-control-sm">
                                <label>Pokok Jasa</label>
                                <input type="number" name="pokok_jasa" id="" class="form-control form-control-sm">
                                <label>No Kas</label>
                                <input type="text" name="no_kas" id="" class="form-control form-control-sm">
                                <label>Tanggal Mulai</label>
                                <input type="date" name="tgl_mulai" id="" class="form-control form-control-sm">
                                <label>Tanggal Selesai</label>
                                <input type="date" name="tgl_selesai" id=""
                                    class="form-control form-control-sm">
                                <label>Tenor ( Bulan )</label>
                                <input type="number" name="tenor" id="" class="form-control form-control-sm">
                                <label>Simpanan Wajib</label>
                                <input type="number" name="simpanan_wajib" id=""
                                    class="form-control form-control-sm">
                                <label>Simpanan Hari Raya ( SHR ) </label>
                                <input type="number" name="shr" id="" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function search() {
            var x = document.getElementById('name');
            $.ajax({
                url: "{{ asset('api/searchAnggota') }}",
                type: "post",
                data: {
                    'key': x.value
                },
                success: function(response) {
                    $('#box').empty();
                    response.forEach(element => {
                        $('#box').append("<li class='custom-box' onclick='pick(`" + element[
                            'nama_anggota'] + "`,`" + element['nip'] + "`)'>" + element[
                                'nama_anggota'] +
                            " <i class='fas fa-check' style='float:right'></i></li>");
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        function pick(name, nip) {
            document.getElementById('name').value = name;
            document.getElementById('nip').value = nip;
            $('#box').empty();
            document.getElementById('afterComplete').classList.remove('d-none');
        }
    </script>
@endsection
