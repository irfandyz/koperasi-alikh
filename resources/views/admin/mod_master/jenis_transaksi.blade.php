@extends('admin.template')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><button class="btn btn-secondary" data-toggle="modal"
                            data-target="#exampleModal">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Bank
                        </button></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Transaksi</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jenistransaksi as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ucwords($data->nama_jenis_transaksi)}}</td>
                                        <td>{{$data->ket}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal" id="exampleModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form method="post" action="{{asset('tambahJenisTransaksi')}}">
                  @csrf
                  <div class="form-group">
                      <label>Nama Jenis Transaksi</label>
                      <input class="form-control" type="text" name="nama_jenis_transaksi">
                  </div>
                  <div class="form-group">
                      <label>Keterangan</label>
                        <select class="form-control" name="ket">
                            <option>-</option>
                            <option value="kredit">Kredit</option>
                            <option value="debit">Debit</option>
                        </select>
                  </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
              </form>
        </div>
      </div>
    </div>
@endsection
