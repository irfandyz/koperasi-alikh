@extends('admin.template')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-secondary text-light" data-toggle="modal" data-target="#dataBanner">Tambah Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Banner</th>
                                    <th>Aktif</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($banner as $data) 
                                  <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <th>{{$data->banner_name}}</th>
                                    <th>{{$data->aktif}}</th>
                                    <th>
                                        @if($data->aktif == "N")
                                        <a class="btn btn-success btn-sm" href="{{asset('updateBanner/'.$data->id_banner.'/1')}}">Aktifkan</a>
                                        @else
                                        <a class="btn btn-danger btn-sm" href="{{asset('updateBanner/'.$data->id_banner.'/2')}}">Non Aktifkan</a>
                                        @endif
                                    </th>
                                    <th><a class="btn btn-secondary btn-sm" target="_blank" href="http://koperasi-alikhlas.online/banner/{{$data->banner_name}}">Show</a></th>
                                </tr>  
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="dataBanner" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Banner</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form action="{{asset('/tambahBanner')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                      <label>Upload Image</label>
                      <input type="file" name="banner" class="form-control">
                      <small class="text-danger">Disarankan resolusi 825x1650</small>
                  </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
        </div>
      </div>
    </div>
@endsection
