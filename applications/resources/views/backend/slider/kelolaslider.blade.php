@extends('backend.master.layouts.master')

@section('title')
    <title>Jalinusantara</title>
@endsection


@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>FORM KELOLA SLIDER</h2>
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
                <div class="header">
                    <h2>
                        Gambar dibawah ini adalah slider yang di tampilkan di web.
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="#" class="edit" data-toggle="modal" data-target="#modaledit" data-value="{{$getSlider[0]->id}}" data-backdrop="static" data-keyboard="false">Update</a></li>
                                @if($getSlider[0]->flag_slider=="1")
                                  <li><a href="#" class="flagpublish" data-toggle="modal" data-target="#modalflagedit" data-value="{{$getSlider[0]->id}}" data-backdrop="static" data-keyboard="false">Un Publish ?</a></li>
                                @else
                                  <li><a href="#" class="flagpublish" data-toggle="modal" data-target="#modalflagedit" data-value="{{$getSlider[0]->id}}" data-backdrop="static" data-keyboard="false">Publish ?</a></li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    @if($getSlider[0]->url_slider!="")
                      <img src="{{url('images/slider/')}}/{{$getSlider[0]->url_slider}}" class="js-animating-object img-responsive">
                    @else
                      <img src="{{url('images/')}}/no_image.jpg" class="js-animating-object img-responsive">
                    @endif
                    <div class="demo-image-copyright">
                        <b>
                          @if ($getSlider[0]->flag_slider == '1')
                            <span class="badge bg-deep-orange">Image Publish</span>
                          @else
                            <span class="badge bg-deep-purple">Image Un Publish</span>
                          @endif
                        </b>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="form-line">
                            <label>Judul Slider</label>
                            <input type="text" class="form-control" value="{{$getSlider[0]->judul}}" disabled/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <label>Keterangan Slider</label>
                            <textarea rows="4" class="form-control no-resize" disabled>{{$getSlider[0]->keterangan_slider}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <label>Status</label>
                            <select class="form-control show-tick" disabled>
                                @if ($getSlider[0]->activated == '1')
                                  <option value="1" selected>Active</option>
                                @else
                                  <option value="0" selected>Non Active</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Input -->

    <!-- Modal Update-->
    <div class="modal fade" id="modaledit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bounceInRight">
                  <div class="modal-header">
                      <h4 class="modal-title">Edit Konten Slider</h4>
                  </div>
                  <div class="modal-body">
                      <form action="{{route('slider.update')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Gambar Slider</label>
                                        @if ($errors->has('urlSliderEdit'))
                                          <small style="color:red">* {{$errors->first('urlSliderEdit')}}</small>
                                        @endif
                                        <input type="file" name="urlSliderEdit" class="form-control" id="urlSliderEdit">
                                        <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                                    </div>
                                    <div>
                                      <span style="color:red;">* Biarkan kosong jika tidak ingin diganti.</span><br>
                                      <span class="text-muted"><i>* Max Size: 5MB.</i></span><br>
                                      <span class="text-muted"><i>* Rekomendasi ukuran terbaik: 1920 x 900 px.</i></span>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Judul Slider</label>
                                        @if ($errors->has('judul'))
                                          <small style="color:red">* {{$errors->first('judul')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('judul') }}" class="form-control" placeholder="Ketikkan Judul Slider..." name="judul" id="judulEdit"/>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Keterangan Slider</label>
                                        @if ($errors->has('keteranganSlider'))
                                          <small style="color:red">* {{$errors->first('keteranganSlider')}}</small>
                                        @endif
                                        <textarea rows="4" class="form-control no-resize" placeholder="Ketikkan Keterangan Slider..." name="keteranganSlider" id="keteranganSliderEdit">{{ old('keteranganSlider') }}</textarea>
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
                      <h4 class="modal-title">Publish Data Slider</h4>
                  </div>
                  <div class="modal-body">
                        <p>Apakah anda yakin untuk mengubah status slider ini?</p>
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
                      <h4 class="modal-title">Non Aktifkan Data Slider</h4>
                  </div>
                  <div class="modal-body">
                      <p>Apakah anda yakin untuk mengnonaktifkan data slider ini?</p>
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
                  <h4 class="modal-title">Aktifkan Data Slider</h4>
              </div>
              <div class="modal-body">
                  <p>Apakah anda yakin untuk mengaktifkan data slider ini?</p>
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
  @if ($errors->has('judul') || $errors->has('keteranganSlider'))
  $('#modaledit').modal('show');
  @endif

  $("a.flagpublish").click(function(e){
      var a = $(this).data('value');
      $('#setFlagPublish').attr('href', '{{url('admin/publish-slider/')}}/'+a);
  });

  $("#tabelinfo").on("click", "a.hapus", function(){
    var a = $(this).data('value');
    var b = "hapus";
    $('#setYaHapus').attr('href', '{{url('admin/delete-slider/')}}/'+a+'/'+b);
  });

  $("a.aktifkan").click(function(e){
    var a = $(this).data('value');
    var b = "aktifkan";
    $('#setYaAktifkan').attr('href', '{{url('admin/delete-slider/')}}/'+a+'/'+b);
  });

  $("a.edit").click(function(e){
    var a = $(this).data('value');
    $.ajax({
      url: "{{url('/')}}/admin/bind-slider/"+a,
      dataType: 'json',
      success: function(data){
        var id = data.id;
        var judul = data.judul;
        var keterangan_slider = data.keterangan_slider;
        var url_slider = data.url_slider;

        $('#id').attr('value', id);
        $('#judulEdit').val(judul);
        $('#keteranganSliderEdit').val(keterangan_slider);
      }
    })
  });

</script>
@endsection
