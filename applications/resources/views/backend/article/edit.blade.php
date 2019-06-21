@extends('backend.master.layouts.master')

@section('title')
    <title>Jalinusantara</title>
@endsection


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
                      @if(isset($editArticle))
                        Edit Article Jalinusantara
                      @else
                        View Article Jalinusantara
                      @endif
                  </h2>
                </div>
                <div class="body">
                  <form action="{{route('article.update')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Judul</label>
                                    @if ($errors->has('judul'))
                                      <small style="color:red">* {{$errors->first('judul')}}</small>
                                    @endif
                                    @if(isset($editArticle))
                                      <input type="text" class="form-control" value="{{$editArticle->judul_informasi}}" placeholder="Ketikkan Judul..." name="judul" id="judul"/>
                                      <input type="hidden" value="{{$editArticle->id}}" name="id" id="id"/>
                                    @else
                                      <input type="text" disabled class="form-control" value="{{$viewArticle->judul_informasi}}" placeholder="Ketikkan Judul..." name="judul" id="judul"/>
                                      <input type="hidden" value="{{$viewArticle->id}}" name="id" id="id"/>
                                    @endif
                                  </div>
                            </div>
                            <div class="form-group mandatory">
                              <div class="form-line">
                                  <label>Kategori</label>
                                  @if ($errors->has('kategoriId'))
                                    <small style="color:red">* {{$errors->first('kategoriId')}}</small>
                                  @endif
                                      @if(isset($editArticle))
                                    <select class="form-control show-tick" name="kategoriId" id="kategoriId">
                                        <option value="-- Pilih --">-- Pilih --</option>
                                        @foreach($getKategori as $key)
                                          @if($editArticle->id_kategori==$key->id)
                                            <option value="{{$key->id}}" selected>{{$key->nama_kategori}}</option>
                                          @else
                                            <option value="{{$key->id}}" {{ old('kategoriId') == $key->id ? 'selected=""' : ''}}>{{$key->nama_kategori}}</option>
                                          @endif
                                        @endforeach
                                      @else
                                    <select class="form-control show-tick" name="kategoriId" id="kategoriId" disabled>
                                        <option value="-- Pilih --">-- Pilih --</option>
                                        @foreach($getKategori as $key)
                                          @if($viewArticle->id_kategori==$key->id)
                                            <option value="{{$key->id}}" selected>{{$key->nama_kategori}}</option>
                                          @endif
                                        @endforeach
                                      @endif
                                  </select>
                              </div>
                            </div>
                            @if(isset($editArticle))
                              <div class="form-group mandatory">
                                  <div class="form-line">
                                      <label>Gambar Article</label>
                                      @if ($errors->has('urlFoto'))
                                        <small style="color:red">* {{$errors->first('urlFoto')}}</small>
                                      @endif
                                      <input type="file" name="urlFoto" class="form-control" value="{{ old('urlFoto') }}" >
                                  </div>
                                  <div>
                                    <span style="color:red;">* Biarkan kosong jika tidak ingin diganti.</span><br>
                                    <span class="text-muted"><i>* Max Size: 4MB.</i></span><br>
                                    <span class="text-muted"><i>* Rekomendasi ukuran terbaik: 1000 x 589 px.</i></span>
                                  </div>
                              </div>
                            @else
                              <div class="form-group mandatory">
                                  <label>Gambar Article</label>
                                  @if($viewArticle->url_foto!="")
                                    <img src="{{url('images/article/')}}/{{$viewArticle->url_foto}}" class="js-animating-object img-responsive">
                                  @else
                                    <img src="{{url('images/')}}/no_image.jpg" class="js-animating-object img-responsive">
                                  @endif
                                  <div>
                                    <span class="text-muted"><i>* Rekomendasi ukuran terbaik: 555 x 280 px.</i></span>
                                  </div>
                              </div>
                            @endif

                            <div class="form-group">
                                <div class="form-line">
                                    <label>Tags</label>
                                    @if ($errors->has('tags'))
                                      <small style="color:red">* {{$errors->first('tags')}}</small>
                                    @endif
                                    <br>
                                    @if(isset($editArticle))
                                      <input type="text" class="form-control" value="{{$editArticle->tags}}" name="tags" data-role="tagsinput" id="tagsinput"/>
                                    @else
                                      <input type="text" class="form-control" value="{{$viewArticle->tags}}" name="tags" data-role="tagsinput" id="tagsinput" disabled/>
                                    @endif
                                </div>
                                <div>
                                  <span class="text-muted"><i>* Pisahkan isi tags dengan koma.</i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Headline</label>
                                    <br>
                                    @if(isset($editArticle))
                                        @if($editArticle->flag_headline == 1)
                                          <input type="checkbox" id="md_checkbox_21" name="flagHeadline" class="filled-in chk-col-red" value="1" checked/>
                                        @else
                                          <input type="checkbox" id="md_checkbox_21" name="flagHeadline" class="filled-in chk-col-red" value="1" />
                                        @endif
                                    @else
                                      @if($viewArticle->flag_headline == 1)
                                        <input type="checkbox" id="md_checkbox_21" name="flagHeadline" class="filled-in chk-col-red" value="1" checked disabled/>
                                      @else
                                        <input type="checkbox" id="md_checkbox_21" name="flagHeadline" class="filled-in chk-col-red" value="1" disabled/>
                                      @endif
                                    @endif
                                    <label for="md_checkbox_21">* Ya, tampilkan article ini sebagai headline.</label>
                                </div>
                            </div>
                            <div class="form-group mandatory">
                              <div class="form-line">
                                  <label>Isi Konten</label>
                                  @if ($errors->has('isiKonten'))
                                    <small style="color:red">* {{$errors->first('isiKonten')}}</small>
                                  @endif
                                  @if(isset($editArticle))
                                    <textarea id="ckeditor" name="isiKonten">
                                      {{$editArticle->isi_informasi}}
                                  @else
                                    <textarea id="ckeditor" name="isiKonten" disabled>
                                      {{$viewArticle->isi_informasi}}
                                  @endif
                                   </textarea>
                              </div>
                            </div>
                            @if(isset($editArticle))
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
    $(function(){
        $('#tagsinput').tagsinput();
    })
</script>
@endsection
