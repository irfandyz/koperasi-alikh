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
											Pengambilan Tabungan
										</button></h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>No</th>
													<th>Tanggal pengambilan</th>
													<th>Nama anggota</th>
													<th>Jumlah</th>
													<th>Jenis Pengambilan</th>
                          <th>Action</th>
												</tr>
											</thead>
											
											<tbody>
												@foreach ($record as $item)
												<tr>
													<td>{{$loop->iteration}}</td>
													<td>{{$item->tgl_pengambilan}}</td>
													<td>{{$item->anggota->nama_anggota ?? ''}}</td>
													<td>{{$item->besar_ambil}}</td>
													<td>{{$item->jenispengambilan->nama_jenispengambilan ?? ''}}</td>
                          <td><button type="button"  title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"  data-toggle="modal" data-target="#pengambilan{{$item->id_pengambilan}}">
																<i class="fa fa-edit"></i>
															</button>
															<a href="{{asset('hapus-pengambilan/'.$item->id_pengambilan)}}" button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove" <?php echo" onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\" "; ?> >
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
                    <form action="{{asset('simpan-pengambilan')}}" method="post"  enctype="multipart/form-data">
                @csrf
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Pengambilan Tabungan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                     
					  <div class="form-group">
                        <label>Tanggal simpanan</label>
                        <input type="date" name="tgl_pengambilan" required="required" class="form-control" placeholder="Tanggal  Pengambilan..">
                      </div>
                      <div class="form-group">
                        <label>Nama Anggota</label>
                        <select class="form-control" name="id_anggota">
                        <?php $anggota = DB::select('select * from tb_anggota');
                        foreach ($anggota as $r) {
                         ?>
                        <option value="<?php echo $r->id_anggota; ?>"><?php echo $r->nik; ?> :: <?php echo $r->nama_anggota; ?></option>
                        <?php } ?>
                        </select>
                      </div>
                       
                     <div class="form-group">
                        <label>Besar Pengambilan</label>
                        <input type="text" name="besar_ambil" required="required" class="form-control" placeholder="Besar simpanan ..">
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
            <form action="{{asset('edit-pengambilan')}}" method="post"  enctype="multipart/form-data">
                @csrf
              <div class="modal fade" id="pengambilan{{$item->id_pengambilan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Pengambilan tabungan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                     <input type="hidden" name="id" value="{{$item->id_pengambilan}}" >
					   <div class="form-group">
                        <label>Tanggal simpanan</label>
                        <input type="date" name="tgl_pengambilan" value="{{$item->tgl_pengambilan}}" required="required" class="form-control" placeholder="Tanggal  Pengambilan..">
                      </div>
                      <div class="form-group">
                        <label>Nama Anggota</label>
                        <select class="form-control" name="id_anggota">
                            <option value="<?php echo $item->id_anggota; ?>"><?php echo $item->nik; ?> :: <?php echo $item->nama_anggota; ?></option>
                        <?php $anggota = DB::select('select * from tb_anggota');
                        foreach ($anggota as $r) {
                         ?>
                        <option value="<?php echo $r->id_anggota; ?>"><?php echo $r->nik; ?> :: <?php echo $r->nama_anggota; ?></option>
                        <?php } ?>
                        </select>
                      </div>
                       
                     <div class="form-group">
                        <label>Besar Pengambilan</label>
                        <input type="text" name="besar_ambil" value="{{$item->besar_ambil}}" required="required" class="form-control" placeholder="Besar simpanan ..">
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