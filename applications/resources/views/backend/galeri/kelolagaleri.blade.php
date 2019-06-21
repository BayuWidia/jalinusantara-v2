@extends('backend.master.layouts.master')

@section('title')
    <title>Jalinusantara</title>
@endsection


@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>FORM KELOLA FOTO</h2>
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
                                    <th style="text-align:center">Event</th>
                                    <th style="text-align:center">Judul</th>
                                    <th style="text-align:center">Keterangan</th>
                                    <th style="text-align:center">Foto</th>
                                    <th style="text-align:center">Status</th>
                                    <th style="text-align:center">Status Publish</th>
                                    <th style="text-align:center;width:12%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @php $i=1; @endphp
                              @foreach($getGaleri as $key)
                                <tr>
                                  <td>{{$i++}}</td>
                                  <td>{{$key->judul_event}}</td>
                                  <td>{{$key->judul}}</td>
                                  <td>{{$key->keterangan_gambar}}</td>
                                  <td>
                                    @if($key->url_gambar!="")
                                      <img src="{{url('_thumbs/galeri')}}/{{$key->url_gambar}}">
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
                                    @if($key->flag_gambar=="1")
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content bounceInRight">
                  <div class="modal-header">
                      <h4 class="modal-title">Tambah Konten Foto</h4>
                  </div>
                  <div class="modal-body">
                      <form action="{{route('galeri.store')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Events</label>
                                        @if ($errors->has('eventsId'))
                                          <small style="color:red">* {{$errors->first('eventsId')}}</small>
                                        @endif
                                        <select name="eventsId" class="form-control" style="width: 100%;">
                                          <option value="">-- Pilih --</option>
                                          @foreach($getDataEvents as $key)
                                            <option value="{{ $key->id }}" {{ old('eventsId') == $key->id ? 'selected=""' : ''}}>{{ $key->nama_kategori }} - {{ $key->judul_event }}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Gambar Foto</label>
                                        @if ($errors->has('urlSlider'))
                                          <small style="color:red">* {{$errors->first('urlGaleri')}}</small>
                                        @endif
                                        <input type="file" name="urlGaleri" class="form-control" value="{{ old('urlGaleri') }}" >
                                    </div>
                                    <div>
                                      <span class="text-muted"><i>* Max Size: 2MB.</i></span><br>
                                      <span class="text-muted"><i>* Rekomendasi ukuran terbaik: 457 x 250 px.</i></span>
                                    </div>
                                </div> -->
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Judul Foto</label>
                                        @if ($errors->has('judul'))
                                          <small style="color:red">* {{$errors->first('judul')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('judul') }}" class="form-control" placeholder="Ketikkan Judul Foto..." name="judul" id="judul"/>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Keterangan Foto</label>
                                        @if ($errors->has('keteranganGaleri'))
                                          <small style="color:red">* {{$errors->first('keteranganGaleri')}}</small>
                                        @endif
                                        <textarea rows="4" class="form-control no-resize" placeholder="Ketikkan Keterangan Foto..." name="keteranganGaleri" id="keteranganGaleri">{{ old('keteranganGaleri') }}</textarea>
                                    </div>
                                </div>
                                <table class="table" id="itemList">
                                  <thead>
                                      <tr>
                                          <th width="3%">#</th>
                                          <th>Unggah Foto</th>
                                          <th width="3%">
                                            <button type ="button" name="addItem" id="addItem" class="btn btn-success btn-sm">
                                              Tambah</button></th>
                                      </tr>
                                  </thead>
                                  <tbody>

                                  </tbody>
                                </table>
                                <div>
                                  <span class="text-muted"><i>* Max Size: 2MB.</i></span><br>
                                  <span class="text-muted"><i>* Rekomendasi ukuran terbaik: 457 x 250 px.</i></span>
                                </div>
                                <br>
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
                      <h4 class="modal-title">Edit Konten Foto</h4>
                  </div>
                  <div class="modal-body">
                      <form action="{{route('galeri.update')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Events</label>
                                        @if ($errors->has('eventsIdEdit'))
                                          <small style="color:red">* {{$errors->first('eventsIdEdit')}}</small>
                                        @endif
                                        <select name="eventsIdEdit" id="eventsIdEdit" class="form-control" style="width: 100%;">
                                          <option value="">-- Pilih --</option>
                                          @foreach($getDataEvents as $key)
                                            <option value="{{ $key->id }}" {{ old('eventsIdEdit') == $key->id ? 'selected=""' : ''}}>{{ $key->nama_kategori }} - {{ $key->judul_event }}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Gambar Foto</label>
                                        @if ($errors->has('urlGaleriEdit'))
                                          <small style="color:red">* {{$errors->first('urlGaleriEdit')}}</small>
                                        @endif
                                        <input type="file" name="urlGaleriEdit" class="form-control" id="urlGaleriEdit">
                                        <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                                    </div>
                                    <div>
                                      <span style="color:red;">* Biarkan kosong jika tidak ingin diganti.</span><br>
                                      <span class="text-muted"><i>* Max Size: 2MB.</i></span><br>
                                      <span class="text-muted"><i>* Rekomendasi ukuran terbaik: 457 x 250 px.</i></span>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Judul Foto</label>
                                        @if ($errors->has('judulEdit'))
                                          <small style="color:red">* {{$errors->first('judulEdit')}}</small>
                                        @endif
                                        <input type="text" class="form-control" value="{{ old('judulEdit') }}" placeholder="Ketikkan Judul Foto..." name="judulEdit" id="judulEdit"/>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Keterangan Foto</label>
                                        @if ($errors->has('keteranganGaleriEdit'))
                                          <small style="color:red">* {{$errors->first('keteranganGaleriEdit')}}</small>
                                        @endif
                                        <textarea rows="4" class="form-control no-resize" placeholder="Ketikkan Keterangan Foto..." name="keteranganGaleriEdit" id="keteranganGaleriEdit">{{ old('keteranganGaleriEdit') }}</textarea>
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
                      <h4 class="modal-title">Publish Data Foto</h4>
                  </div>
                  <div class="modal-body">
                        <p>Apakah anda yakin untuk mengubah status foto ini?</p>
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
                      <h4 class="modal-title">Non Aktifkan Data Foto</h4>
                  </div>
                  <div class="modal-body">
                      <p>Apakah anda yakin untuk mengnonaktifkan data foto ini?</p>
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
                  <h4 class="modal-title">Aktifkan Data Foto</h4>
              </div>
              <div class="modal-body">
                  <p>Apakah anda yakin untuk mengaktifkan data foto ini?</p>
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
  @if ($errors->has('eventsId') || $errors->has('urlGaleri.*') || $errors->has('judul') || $errors->has('keteranganGaleri') || $errors->has('activated'))
  $('#modalinsert').modal('show');
  @endif

  @if ($errors->has('eventsIdEdit') || $errors->has('judulEdit') || $errors->has('keteranganGaleriEdit'))
  $('#modaledit').modal('show');
  @endif

  $("#addItem").click(function () {
        var totalRow = $('#itemList tr').length - 1;
        var html = '';
        html += '<tr class="rowData">';
        html += '<td>'+totalRow+'</td>';
        html += '<td><div class="form-group mandatory"><div class="form-line"><input id="urlGaleri'+totalRow+'" type="file" class="form-control urlGaleri" name="data_item['+totalRow+'][urlGaleri]"></div></div></td>';
        html += '<td><button type="button" name="removeItem" class="btn btn-danger btn-sm removeItem">Hapus</button></td>';
        html += '</tr>';
        $('#itemList tbody').append(html);
        refreshTableNumber();
  });

  $(document).on('click', '.removeItem', function () {
      $(this).closest('tr').remove();
      refreshTableNumber();
  });

  function refreshTableNumber() {
      $('#itemList tbody tr').each(function (idx) {
          $(this).children("td:eq(0)").html(idx + 1);
      });
  };

  $("#tabelinfo").on("click", "a.flagpublish", function(){
    var a = $(this).data('value');
    $('#setFlagPublish').attr('href', '{{url('admin/publish-galeri/')}}/'+a);
  });

  $("#tabelinfo").on("click", "a.hapus", function(){
    var a = $(this).data('value');
    var b = "hapus";
    $('#setYaHapus').attr('href', '{{url('admin/delete-galeri/')}}/'+a+'/'+b);
  });

  $("#tabelinfo").on("click", "a.aktifkan", function(){
    var a = $(this).data('value');
    var b = "aktifkan";
    $('#setYaAktifkan').attr('href', '{{url('admin/delete-galeri/')}}/'+a+'/'+b);
  });

  $("#tabelinfo").on("click", "a.edit", function(){
    var a = $(this).data('value');
    $.ajax({
      url: "{{url('/')}}/admin/bind-galeri/"+a,
      dataType: 'json',
      success: function(data){
        var id = data.id;
        var id_events = data.id_events;
        var judul = data.judul;
        var keterangan_gambar = data.keterangan_gambar;
        var url_gambar = data.url_gambar;

        $('#id').attr('value', id);
        $("#eventsIdEdit").val(0).trigger("change");
        $('#judulEdit').val(judul);
        $('#keteranganGaleriEdit').val(keterangan_gambar);
        $("#eventsIdEdit").val(id_events).trigger("change");
      }
    })
  });

</script>
@endsection
