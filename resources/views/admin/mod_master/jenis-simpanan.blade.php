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
											Jenis Simpanan
										</button></h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>No</th>
													<th>Nama Simpanan</th>
													<th>Besar Simpanan</th>
													<th>Petugas</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											
											<tbody>
												
												@foreach ($record as $item)
												<tr>
													<td>{{$loop->iteration}}</td>
													<td>{{$item->nama_simpanan}}</td>
													<td>{{$item->besar_simpanan}}</td>
													<td>{{$item->id_users}}</td>
                                                    <td><button type="button"  title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"  data-toggle="modal" data-target="#jenissimpanan{{$item->id_jenissimpanan}}">
																<i class="fa fa-edit"></i>
															</button>
															<a href="{{asset('hapus-jenissimpanan/'.$item->id_jenissimpanan)}}" button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove" <?php echo" onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\" "; ?> >
																<i class="fa fa-times"></i>
															</button></a></td>
												</tr>
                                                @endforeach 
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>


					</div>
                    <form action="{{asset('simpan-jenissimpanan')}}" method="post"  enctype="multipart/form-data">
                @csrf
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Simpanan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                     
					  <div class="form-group">
                        <label>Nama Simpanan </label>
                        <input type="text" name="nama_simpanan" required="required" class="form-control" placeholder="Nama  Simpanan..">
                      </div>
                     <div class="form-group">
                        <label>Besar Simpanan</label>
                        <input type="text" name="besar_simpanan" required="required" class="form-control" placeholder="Lama angsuran  ..">
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
            <form action="{{asset('edit-jenissimpanan')}}" method="post"  enctype="multipart/form-data">
                @csrf
              <div class="modal fade" id="jenissimpanan{{$item->id_jenissimpanan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Simpanan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                     <input type="hidden" name="id" value="{{$item->id_jenissimpanan}}" >
					   <div class="form-group">
                        <label>Nama Simpanan </label>
                        <input type="text" name="nama_simpanan" value="{{$item->nama_simpanan}}" required="required" class="form-control" placeholder="Nama  Simpanan..">
                      </div>
                     <div class="form-group">
                        <label>Besar Simpanan</label>
                        <input type="text" name="besar_simpanan" value="{{$item->besar_simpanan}}" required="required" class="form-control" placeholder="Lama angsuran  ..">
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
@endsection