@extends('admin.template')
@section('content')
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{asset('tambah-nominal-bank')}}">
                        @csrf
                        <div class="form-group">
                            <label>Barang</label>
                            <input class="form-control" value="0" name="barang">
                        </div>
                        <div class="form-group">
                            <input value="{{$record->id_peminjaman}}" name="id_peminjaman" hidden>
                            <label>Bank</label>
                            <select class="form-control" name="id_bank">
                                <option> - Pilih Bank - </option>
                                @foreach($bank as $data)
                                    <option value="{{$data->id_bank}}">{{$data->nama_bank}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Utang Bank</label>
                            <input class="form-control" value="0" name="jumlah">
                        </div>
                        <div class="form-group">
                            <label>POKJA</label>
                            <select name="pokja" class="form-control">
                                <option value="0">Kosong</option>
                                <option value="150000">POKJAWAS</option>
                                <option value="100000">POKJAWAS PAI</option>
                                <option value="50000">POKJALUH</option>
                            </select>
                        </div>
                        <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
