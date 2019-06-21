@extends('backend.master.layouts.master')

@section('title')
    <title>Jalinusantara</title>
@endsection


@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>FORM KELOLA KATEGORI</h2>
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
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-orange">
                    Formulir Set Kategori
                </div>
                <div class="body">
                  <form action="{{route('kategori.store')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Nama Kategori</label>
                                    @if ($errors->has('namaKategori'))
                                      <small style="color:red">* {{$errors->first('namaKategori')}}</small>
                                    @endif

                                    <input type="text" class="form-control" value="{{ old('namaKategori') }}" placeholder="Ketikkan Nama Kategori..." name="namaKategori" id="namaKategori"/>

                                    <input type="hidden" value="{{ $getParams }}" name="flagUtama" id="flagUtama"/>
                                </div>
                            </div>
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Keterangan Kategori</label>
                                    @if ($errors->has('keteranganKategori'))
                                      <small style="color:red">* {{$errors->first('keteranganKategori')}}</small>
                                    @endif
                                    <textarea rows="4" class="form-control no-resize" placeholder="Ketikkan Keterangan Kategori..." name="keteranganKategori" id="keteranganKategori">{{ old('keteranganKategori') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Status</label>
                                    <select class="form-control show-tick" name="activated" id="activated">
                                        <option value="1" {{old('activated')=="1"? 'selected':''}}>Active</option>
                                        <option value="0"{{old('activated')=="0"? 'selected':''}}>Non Active</option>
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
          <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
              <div class="card">
                  <div class="header bg-orange">
                      List Data Kategori
                  </div>
                  <div class="body">
                      <div class="table-responsive">
                          <table class="table table-bordered table-striped table-hover" id="tabelinfo">
                              <thead>
                                  <tr>
                                      <th style="text-align:center">No</th>
                                      <th style="text-align:center">Nama</th>
                                      <th style="text-align:center">Keterangan</th>
                                      <th style="text-align:center">Status</th>
                                      <th style="text-align:center">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @php $i=1; @endphp
                                @foreach($getKategori as $key)
                                  <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$key->nama_kategori}}</td>
                                    <td>{{$key->keterangan_kategori}}</td>
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

    <!-- Modal Update-->
    <div class="modal fade" id="modaledit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Edit Konten Kategori</h4>
                  </div>
                  <div class="modal-body">
                      <form action="{{route('kategori.update')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Nama Kategori</label>
                                        @if ($errors->has('namaKategoriEdit'))
                                          <small style="color:red">* {{$errors->first('namaKategoriEdit')}}</small>
                                        @endif
                                        <input type="text" class="form-control" value="{{ old('namaKategoriEdit') }}" placeholder="Ketikkan Link..." name="namaKategoriEdit" id="namaKategoriEdit"/>
                                        <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                                        <input type="hidden" name="flagUtamaEdit" id="flagUtamaEdit" value="{{ old('flagUtamaEdit') }}">
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Keterangan Kategori</label>
                                        @if ($errors->has('keteranganKategoriEdit'))
                                          <small style="color:red">* {{$errors->first('keteranganKategoriEdit')}}</small>
                                        @endif
                                        <textarea rows="4" class="form-control no-resize" placeholder="Ketikkan Keterangan Kategori..." name="keteranganKategoriEdit" id="keteranganKategoriEdit">{{ old('keteranganKategoriEdit') }}</textarea>
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

    <!-- Modal Delete-->
    <div class="modal fade" id="modaldelete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bounceInRight">
                  <div class="modal-header">
                      <h4 class="modal-title">Non Aktifkan Data Kategori</h4>
                  </div>
                  <div class="modal-body">
                      <p>Apakah anda yakin untuk mengnonaktifkan data kategori ini?</p>
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
                  <h4 class="modal-title">Aktifkan Data Kategori</h4>
              </div>
              <div class="modal-body">
                  <p>Apakah anda yakin untuk mengaktifkan data kategori ini?</p>
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

  @if ($errors->has('namaKategoriEdit') || $errors->has('keteranganKategoriEdit'))
  $('#modaledit').modal('show');
  @endif


  $("#tabelinfo").on("click", "a.hapus", function(){
    var getParams = "<?php Print($getParams); ?>";
    var a = $(this).data('value');
    var b = "hapus";
    $('#setYaHapus').attr('href', '{{url('admin/delete-kategori/')}}/'+a+'/'+b+'/'+getParams);
  });

  $("#tabelinfo").on("click", "a.aktifkan", function(){
    var getParams = "<?php Print($getParams); ?>";
    var a = $(this).data('value');
    var b = "aktifkan";
    $('#setYaAktifkan').attr('href', '{{url('admin/delete-kategori/')}}/'+a+'/'+b+'/'+getParams);
  });

  $("#tabelinfo").on("click", "a.edit", function(){
    var a = $(this).data('value');
    $.ajax({
      url: "{{url('/')}}/admin/bind-kategori/"+a,
      dataType: 'json',
      success: function(data){
        console.log(data);
        var id = data.id;
        var nama_kategori = data.nama_kategori;
        var keterangan_kategori = data.keterangan_kategori;
        var flag_utama = data.flag_utama;

        $('#id').attr('value', id);
        $('#namaKategoriEdit').val(nama_kategori);
        $('#keteranganKategoriEdit').val(keterangan_kategori);
        $('#flagUtamaEdit').val(flag_utama);
      }
    })
  });

</script>
@endsection
