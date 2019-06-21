@extends('backend.master.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>FORM KELOLA PROFILE</h2>
    </div>
    <div class="row clearfix">
        <div class="col-md-12">
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
                      @if(isset($editProfile))
                        Edit Profile Jalinusantara
                      @else
                        View Profile Jalinusantara
                      @endif
                  </h2>
                </div>
                <div class="body">
                  <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Judul</label>
                                    @if ($errors->has('judul'))
                                      <small style="color:red">* {{$errors->first('judul')}}</small>
                                    @endif
                                    @if(isset($editProfile))
                                      <input type="text" class="form-control" value="{{$editProfile->judul_informasi}}" placeholder="Ketikkan Judul..." name="judul" id="judul"/>
                                      <input type="hidden" value="{{$editProfile->id}}" name="id" id="id"/>
                                    @else
                                      <input type="text" disabled class="form-control" value="{{$viewProfile->judul_informasi}}" placeholder="Ketikkan Judul..." name="judul" id="judul"/>
                                      <input type="hidden" value="{{$viewProfile->id}}" name="id" id="id"/>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group mandatory">
                              <div class="form-line">
                                  <label>Kategori</label>
                                  @if ($errors->has('kategoriId'))
                                    <small style="color:red">* {{$errors->first('kategoriId')}}</small>
                                  @endif
                                      @if(isset($editProfile))
                                    <select class="form-control show-tick" name="kategoriId" id="kategoriId">
                                        <option value="-- Pilih --">-- Pilih --</option>
                                        @foreach($getKategori as $key)
                                          @if($editProfile->id_kategori==$key->id)
                                            <option value="{{$key->id}}" selected>{{$key->nama_kategori}}</option>
                                          @else
                                            <option value="{{$key->id}}" {{ old('kategoriId') == $key->id ? 'selected=""' : ''}}>{{$key->nama_kategori}}</option>
                                          @endif
                                        @endforeach
                                      @else
                                    <select class="form-control show-tick" name="kategoriId" id="kategoriId" disabled>
                                        <option value="-- Pilih --">-- Pilih --</option>
                                        @foreach($getKategori as $key)
                                          @if($viewProfile->id_kategori==$key->id)
                                            <option value="{{$key->id}}" selected>{{$key->nama_kategori}}</option>
                                          @endif
                                        @endforeach
                                      @endif
                                  </select>
                              </div>
                            </div>
                            <div class="form-group mandatory">
                              <div class="form-line">
                                  <label>Isi Konten</label>
                                  @if ($errors->has('isiKonten'))
                                    <small style="color:red">* {{$errors->first('isiKonten')}}</small>
                                  @endif
                                  @if(isset($editProfile))
                                    <textarea id="ckeditor" name="isiKonten">
                                      {{$editProfile->isi_informasi}}
                                  @else
                                    <textarea id="ckeditor" name="isiKonten" disabled>
                                      {{$viewProfile->isi_informasi}}
                                  @endif
                                   </textarea>
                              </div>
                            </div>
                            @if(isset($editProfile))
                            <button type="submit" class="btn pull-right btn-primary">Simpan Perubahan</button>
                            @endif
                            <a href="{{ URL::previous() }}" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Tidak</a>
                        </div>
                    </div>
                  </form>
                </div>
            </div>
          </div>
    </div>
    <!-- #END# Input -->

</div>
@endsection

@section('footscript')
<script src="{{asset('theme/js/pages/forms/basic-form-elements.js')}}"></script>

<!-- Ckeditor -->
<script src="{{asset('theme/plugins/ckeditor/ckeditor.js')}}"></script>

<!-- TinyMCE -->
<script src="{{asset('theme/plugins/tinymce/tinymce.js')}}"></script>

<script src="{{asset('theme/js/pages/forms/editors.js')}}"></script>

<script>
  $(document).ready(function() {

  });
</script>

<script>
</script>
@endsection
