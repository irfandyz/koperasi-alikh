@extends('admin.template')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Profile
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input value="{{Session::get('username')}}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input value="{{Session::get('email')}}" class="form-control" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
