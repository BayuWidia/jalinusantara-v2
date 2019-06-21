@extends('backend.master.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>FORM KELOLA ARTICLE</h2>
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
                      Tambah Article Jalinusantara
                  </h2>
                </div>
                <div class="body">
                  <form action="{{route('article.store')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Judul</label>
                                    @if ($errors->has('judul'))
                                      <small style="color:red">* {{$errors->first('judul')}}</small>
                                    @endif
                                    <input type="text" class="form-control" value="{{ old('judul') }}" placeholder="Ketikkan Judul..." name="judul" id="judul"/>
                                </div>
                            </div>
                            <div class="form-group mandatory">
                              <div class="form-line">
                                  <label>Kategori</label>
                                  @if ($errors->has('kategoriId'))
                                    <small style="color:red">* {{$errors->first('kategoriId')}}</small>
                                  @endif
                                  <select class="form-control show-tick" name="kategoriId" id="kategoriId">
                                      <option value="-- Pilih --">-- Pilih --</option>
                                      @foreach($getKategori as $key)
                                        <option value="{{ $key->id }}" {{ old('kategoriId') == $key->id ? 'selected=""' : ''}}>{{ $key->nama_kategori }}</option>
                                      @endforeach
                                  </select>
                              </div>
                            </div>
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Gambar Article</label>
                                    @if ($errors->has('urlFoto'))
                                      <small style="color:red">* {{$errors->first('urlFoto')}}</small>
                                    @endif
                                    <input type="file" name="urlFoto" class="form-control" value="{{ old('urlFoto') }}" >
                                </div>
                                <div>
                                  <span class="text-muted"><i>* Max Size: 4MB.</i></span><br>
                                  <span class="text-muted"><i>* Rekomendasi ukuran terbaik: 1000 x 589 px.</i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Tags</label>
                                    @if ($errors->has('tags'))
                                      <small style="color:red">* {{$errors->first('tags')}}</small>
                                    @endif
                                    <br>
                                    <input type="text" class="form-control" value="{{ old('tags') }}" name="tags" data-role="tagsinput" id="tagsinput"/>
                                </div>
                                <div>
                                  <span class="text-muted"><i>* Pisahkan isi tags dengan koma.</i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Headline</label>
                                    <br>
                                    <input type="checkbox" id="md_checkbox_21" name="flagHeadline" class="filled-in chk-col-red" value="1" />
                                    <label for="md_checkbox_21">* Ya, tampilkan article ini sebagai headline.</label>
                                </div>
                            </div>
                            <div class="form-group mandatory">
                              <div class="form-line">
                                  <label>Isi Konten</label>
                                  @if ($errors->has('isiKonten'))
                                    <small style="color:red">* {{$errors->first('isiKonten')}}</small>
                                  @endif
                                    <textarea id="ckeditor" name="isiKonten">{{old('isiKonten')}}</textarea>
                              </div>
                            </div>
                            <button type="submit" class="btn pull-right btn-primary">Simpan Data</button>
                            <button type="reset" class="btn btn-danger">Reset Formulir</button>
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
    $(function(){
        $('#tagsinput').tagsinput();
    })
</script>
@endsection
