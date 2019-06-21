@extends('backend.master.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>FORM KELOLA LOGO PRODUCT</h2>
    </div>
    <div class="row clearfix">
        <div class="col-md-12">
          @if(Session::has('message'))
            <div class="alert bg-teal alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
              <p>{{ Session::get('message') }}</p>
            </div>
          @endif

          @if(Session::has('messagefail'))
          <div class="alert bg-pink alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4><i class="icon fa fa-ban"></i> Oops, terjadi kesalahan!</h4>
              <p>{{ Session::get('messagefail') }}</p>
            </div>
          @endif
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-orange">
                  <h2>
                      <a href="#" class="btn bg-blue"
                         data-toggle="modal" data-target="#modalinsert"
                         data-backdrop="static" data-keyboard="false"><i class="material-icons">playlist_add</i></a>
                  </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="tabelinfo">
                            <thead>
                                <tr>
                                    <th style="text-align:center">No</th>
                                    <th style="text-align:center">Nama</th>
                                    <th style="text-align:center">Link</th>
                                    <th style="text-align:center">Keterangan</th>
                                    <th style="text-align:center">Logo</th>
                                    <th style="text-align:center">Status</th>
                                    <th style="text-align:center">Status Publish</th>
                                    <th style="text-align:center;width:12%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @php $i=1; @endphp
                              @foreach($getProduct as $key)
                                <tr>
                                  <td>{{$i++}}</td>
                                  <td>{{$key->nama_product}}</td>
                                  <td>
                                    @php
                                      if (strpos($key->link_product, 'http') !== false) {
                                        @endphp
                                          <a href="{{$key->link_product}}" target="_blank">{{$key->link_product}}</a>
                                        @php
                                      } else {
                                        @endphp
                                        <a href="http://{{$key->link_product}}" target="_blank">{{$key->link_product}}</a>
                                        @php
                                      }
                                    @endphp
                                  </td>
                                  <td>{{$key->keterangan_product}}</td>
                                  <td style="text-align:center">
                                      @if($key->url_product!="")
                                        <img src="{{url('images/product/asli/')}}/{{$key->url_product}}">
                                      @else
                                        <img src="{{url('images/')}}/no_image.jpg" class="js-animating-object img-responsive">
                                      @endif
                                  </td>
                                  <td style="text-align:center">
                                    @if($key->activated=="1")
                                      <span class="badge bg-green">
                                        Active
                                      </span>
                                    @else
                                      <span class="badge bg-red">
                                        Non Active
                                      </span>
                                    @endif
                                  </td>
                                  <td style="text-align:center">
                                    @if($key->flag_product=="1")
                                      <a href="#" class="btn btn-warning btn-circle waves-effect waves-circle waves-float flagpublish"
                                      data-toggle="modal" data-target="#modalflagedit"
                                      data-value="{{$key->id}}" data-backdrop="static"
                                      data-keyboard="false"><i class="material-icons">favorite</i></a>
                                    @else
                                      <a href="#" class="btn bg-blue-grey btn-circle waves-effect waves-circle waves-float flagpublish"
                                      data-toggle="modal" data-target="#modalflagedit" data-value="{{$key->id}}"
                                      data-backdrop="static" data-keyboard="false"><i class="material-icons">favorite_border</i></a>
                                    @endif
                                  </td>
                                  <td style="text-align:center">
                                    <a href="#" class="btn btn-success btn-circle waves-effect waves-circle waves-float edit"
                                       data-toggle="modal" data-target="#modaledit" data-value="{{$key->id}}"
                                       data-backdrop="static" data-keyboard="false"><i class="material-icons">open_in_new</i></a>
                                    @if($key->activated=="1")
                                      <a href="#" class="btn btn-danger btn-circle waves-effect waves-circle waves-float hapus"
                                      data-toggle="modal" data-target="#modaldelete"
                                      data-value="{{$key->id}}" data-backdrop="static"
                                      data-keyboard="false"><i class="material-icons">delete_forever</i></a>
                                    @else
                                      <a href="#" class="btn bg-blue-grey btn-circle waves-effect waves-circle waves-float aktifkan"
                                      data-toggle="modal" data-target="#modalAktifkan"
                                      data-value="{{$key->id}}" data-backdrop="static" data-keyboard="false"><i class="material-icons">thumb_down</i></a>
                                    @endif

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
    <!-- #END# Input -->

    <!-- Modal Insert-->
    <div class="modal fade" id="modalinsert" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bounceInRight">
                  <div class="modal-header">
                      <h4 class="modal-title">Tambah Konten Product</h4>
                  </div>
                  <div class="modal-body">
                      <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Gambar Product</label>
                                        @if ($errors->has('urlProduct'))
                                          <small style="color:red">* {{$errors->first('urlProduct')}}</small>
                                        @endif
                                        <input type="file" name="urlProduct" class="form-control" value="{{ old('urlProduct') }}" >
                                    </div>
                                    <div>
                                      <span class="text-muted"><i>* Max Size: 2MB.</i></span><br>
                                      <span class="text-muted"><i>* Rekomendasi ukuran terbaik: 188 x 126 px.</i></span>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Nama Product</label>
                                        @if ($errors->has('namaProduct'))
                                          <small style="color:red">* {{$errors->first('namaProduct')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('namaProduct') }}" class="form-control" placeholder="Ketikkan Nama Product..." name="namaProduct" id="namaProduct"/>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Link Product</label>
                                        @if ($errors->has('linkProduct'))
                                          <small style="color:red">* {{$errors->first('linkProduct')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('linkProduct') }}" class="form-control" placeholder="Ketikkan Link Product..." name="linkProduct" id="linkProduct"/>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Keterangan Product</label>
                                        @if ($errors->has('keteranganProduct'))
                                          <small style="color:red">* {{$errors->first('keteranganProduct')}}</small>
                                        @endif
                                        <textarea rows="4" class="form-control no-resize" placeholder="Ketikkan Keterangan Product..." name="keteranganProduct" id="keteranganProduct">{{ old('keteranganProduct') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Status</label>
                                        <select class="form-control show-tick" name="activated" id="activated">
                                            <option value="1" {{old('activated')=="1"? 'selected':''}}>Active</option>
                                            <option value="0" {{old('activated')=="0"? 'selected':''}}>Non Active</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn pull-right btn-primary">Simpan Data</button>
                                <button type="reset" class="btn btn-danger" data-dismiss="modal">Reset Formulir</button>
                            </div>
                        </div>
                      </form>
                  </div>
              </div>
        </div>
    </div>

    <!-- Modal Update-->
    <div class="modal fade" id="modaledit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bounceInRight">
                  <div class="modal-header">
                      <h4 class="modal-title">Edit Konten Product</h4>
                  </div>
                  <div class="modal-body">
                      <form action="{{route('product.update')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Gambar Product</label>
                                        @if ($errors->has('urlProduct'))
                                          <small style="color:red">* {{$errors->first('urlProduct')}}</small>
                                        @endif
                                        <input type="file" name="urlProduct" class="form-control" value="{{ old('urlProduct') }}" >
                                        <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                                    </div>
                                    <div>
                                      <span style="color:red;">* Biarkan kosong jika tidak ingin diganti.</span><br>
                                      <span class="text-muted"><i>* Max Size: 2MB.</i></span><br>
                                      <span class="text-muted"><i>* Rekomendasi ukuran terbaik: 188 x 126 px.</i></span>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Nama Product</label>
                                        @if ($errors->has('namaProductEdit'))
                                          <small style="color:red">* {{$errors->first('namaProductEdit')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('namaProductEdit') }}" class="form-control" placeholder="Ketikkan Nama Product..." name="namaProductEdit" id="namaProductEdit"/>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Link Product</label>
                                        @if ($errors->has('linkProductEdit'))
                                          <small style="color:red">* {{$errors->first('linkProductEdit')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('linkProductEdit') }}" class="form-control" placeholder="Ketikkan Link Product..." name="linkProductEdit" id="linkProductEdit"/>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Keterangan Product</label>
                                        @if ($errors->has('keteranganProductEdit'))
                                          <small style="color:red">* {{$errors->first('keteranganProductEdit')}}</small>
                                        @endif
                                        <textarea rows="4" class="form-control no-resize" placeholder="Ketikkan Keterangan Product..." name="keteranganProductEdit" id="keteranganProductEdit">{{ old('keteranganProductEdit') }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn pull-right btn-primary">Simpan Perubahan</button>
                                <button type="reset" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Tidak</button>
                            </div>
                        </div>
                      </form>
                  </div>
              </div>
        </div>
    </div>

    <!-- Modal Publish-->
    <div class="modal fade" id="modalflagedit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bounceInRight">
                  <div class="modal-header">
                      <h4 class="modal-title">Publish Data Product</h4>
                  </div>
                  <div class="modal-body">
                        <p>Apakah anda yakin untuk mengubah status product ini?</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-white" data-dismiss="modal"  onclick="resetPage()">Tidak</button>
                      <a href="" class="btn btn-primary" id="setFlagPublish">Ya, saya yakin</a>
                  </div>
              </div>
        </div>
    </div>

    <!-- Modal Delete-->
    <div class="modal fade" id="modaldelete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bounceInRight">
                  <div class="modal-header">
                      <h4 class="modal-title">Non Aktifkan Data Product</h4>
                  </div>
                  <div class="modal-body">
                      <p>Apakah anda yakin untuk mengnonaktifkan data product ini?</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-white" data-dismiss="modal"  onclick="resetPage()">Tidak</button>
                      <a href="" class="btn btn-primary" id="setYaHapus">Ya, saya yakin</a>
                  </div>
              </div>
        </div>
    </div>

    <!-- Modal Aktikan-->
    <div class="modal inmodal fade" id="modalAktifkan" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content bounceInRight">
              <div class="modal-header">
                  <h4 class="modal-title">Aktifkan Data Product</h4>
              </div>
              <div class="modal-body">
                  <p>Apakah anda yakin untuk mengaktifkan data product ini?</p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-white" data-dismiss="modal"  onclick="resetPage()">Tidak</button>
                  <a href="" class="btn btn-primary" id="setYaAktifkan">Ya, saya yakin</a>
              </div>
          </div>
      </div>
    </div>

</div>
@endsection

@section('footscript')
<script src="{{asset('theme/js/pages/forms/basic-form-elements.js')}}"></script>

<script>
  $(document).ready(function() {
      $('#tabelinfo').DataTable({
      });
  });
</script>

<script>
  @if ($errors->has('urlProduct') || $errors->has('namaProduct') || $errors->has('linkProduct') || $errors->has('keteranganProduct') || $errors->has('activated'))
  $('#modalinsert').modal('show');
  @endif

  @if ($errors->has('namaProductEdit') || $errors->has('linkProductEdit') || $errors->has('keteranganProductEdit'))
  $('#modaledit').modal('show');
  @endif

  $("#tabelinfo").on("click", "a.flagpublish", function(){
    var a = $(this).data('value');
    $('#setFlagPublish').attr('href', '{{url('admin/publish-product/')}}/'+a);
  });

  $("#tabelinfo").on("click", "a.hapus", function(){
    var a = $(this).data('value');
    var b = "hapus";
    $('#setYaHapus').attr('href', '{{url('admin/delete-product/')}}/'+a+'/'+b);
  });

  $("#tabelinfo").on("click", "a.aktifkan", function(){
    var a = $(this).data('value');
    var b = "aktifkan";
    $('#setYaAktifkan').attr('href', '{{url('admin/delete-product/')}}/'+a+'/'+b);
  });

  $("#tabelinfo").on("click", "a.edit", function(){
    var a = $(this).data('value');
    $.ajax({
      url: "{{url('/')}}/admin/bind-product/"+a,
      dataType: 'json',
      success: function(data){
        var id = data.id;
        var nama_product = data.nama_product;
        var link_product = data.link_product;
        var keterangan_product = data.keterangan_product;
        var url_product = data.url_product;

        $('#id').attr('value', id);
        $('#namaProductEdit').val(nama_product);
        $('#linkProductEdit').val(link_product);
        $('#keteranganProductEdit').val(keterangan_product);
      }
    })
  });

</script>
@endsection
