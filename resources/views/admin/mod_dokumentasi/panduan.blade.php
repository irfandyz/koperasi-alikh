@extends('admin.template')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row d-flex d-flex-row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex row d-flex-row justify-content-between">
                                <div class="col-md-10">
                                    Video
                                </div>
                                <div class="col-md-2">
                                    <a class="btn btn-primary btn-sm text-right text-light" target="_blank" href="https://www.youtube.com/embed/96bxFhd1-tQ">LIHAT</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <center>
                                <iframe width="100%" height="350" src="https://www.youtube.com/embed/96bxFhd1-tQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex row d-flex-row justify-content-between">
                                <div class="col-md-6">
                                    Buku Panduan
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-primary btn-sm text-right text-light" download target="_blank">Download</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                              <img class="img img-fluid" src="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
