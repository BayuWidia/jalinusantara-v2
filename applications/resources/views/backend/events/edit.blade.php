@extends('backend.master.layouts.master')

@section('title')
    <title>Jalinusantara</title>
@endsection


@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>FORM KELOLA EVENTS</h2>
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
                      @if(isset($editEvents))
                        Edit Events Jalinusantara
                      @else
                        View Events Jalinusantara
                      @endif
                  </h2>
                </div>
                <div class="body">
                  <form action="{{route('events.update')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Judul</label>
                                    @if ($errors->has('judul'))
                                      <small style="color:red">* {{$errors->first('judul')}}</small>
                                    @endif
                                    @if(isset($editEvents))
                                      <input type="text" class="form-control" value="{{$editEvents->judul_event}}" placeholder="Ketikkan Judul..." name="judul" id="judul"/>
                                      <input type="hidden" value="{{$editEvents->id}}" name="id" id="id"/>
                                    @else
                                      <input type="text" disabled class="form-control" value="{{$viewEvents->judul_event}}" placeholder="Ketikkan Judul..." name="judul" id="judul"/>
                                      <input type="hidden" value="{{$viewEvents->id}}" name="id" id="id"/>
                                    @endif
                                  </div>
                            </div>
                            <div class="form-group mandatory">
                              <div class="form-line">
                                  <label>Kategori</label>
                                  @if ($errors->has('kategoriId'))
                                    <small style="color:red">* {{$errors->first('kategoriId')}}</small>
                                  @endif
                                      @if(isset($editEvents))
                                    <select class="form-control show-tick" name="kategoriId" id="kategoriId">
                                        <option value="-- Pilih --">-- Pilih --</option>
                                        @foreach($getKategori as $key)
                                          @if($editEvents->id_kategori==$key->id)
                                            <option value="{{$key->id}}" selected>{{$key->nama_kategori}}</option>
                                          @else
                                            <option value="{{$key->id}}" {{ old('kategoriId') == $key->id ? 'selected=""' : ''}}>{{$key->nama_kategori}}</option>
                                          @endif
                                        @endforeach
                                      @else
                                    <select class="form-control show-tick" name="kategoriId" id="kategoriId" disabled>
                                        <option value="-- Pilih --">-- Pilih --</option>
                                        @foreach($getKategori as $key)
                                          @if($viewEvents->id_kategori==$key->id)
                                            <option value="{{$key->id}}" selected>{{$key->nama_kategori}}</option>
                                          @endif
                                        @endforeach
                                      @endif
                                  </select>
                              </div>
                            </div>
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Fasilitator</label>
                                    @if ($errors->has('fasilitator'))
                                      <small style="color:red">* {{$errors->first('fasilitator')}}</small>
                                    @endif
                                    @if(isset($editEvents))
                                      <input type="text" class="form-control" value="{{$editEvents->fasilitator}}" placeholder="Ketikkan Fasilitator..." name="fasilitator" id="fasilitator"/>
                                    @else
                                      <input type="text" class="form-control" value="{{$viewEvents->fasilitator}}" placeholder="Ketikkan Fasilitator..." name="fasilitator" id="fasilitator" disabled/>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Entrance Fee</label>
                                    @if ($errors->has('entranceFee'))
                                      <small style="color:red">* {{$errors->first('entranceFee')}}</small>
                                    @endif
                                    @if(isset($editEvents))
                                      <input type="text" class="form-control" value="{{$editEvents->entranceFee}}" placeholder="Ketikkan Entrance Fee..." name="entranceFee" id="entranceFee"/>
                                    @else
                                      <input type="text" class="form-control" value="{{$viewEvents->entranceFee}}" placeholder="Ketikkan Entrance Fee..." name="entranceFee" id="entranceFee" disabled/>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Payment</label>
                                    @if ($errors->has('fasilitator'))
                                      <small style="color:red">* {{$errors->first('payment')}}</small>
                                    @endif
                                    @if(isset($editEvents))
                                      <input type="text" class="form-control" value="{{$editEvents->payment}}" placeholder="Ketikkan Payment..." name="payment" id="payment"/>
                                    @else
                                      <input type="text" class="form-control" value="{{$viewEvents->payment}}" placeholder="Ketikkan Payment..." name="payment" id="payment" disabled/>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Jumlah Peserta</label>
                                    @if ($errors->has('jmlPeserta'))
                                      <small style="color:red">* {{$errors->first('jmlPeserta')}}</small>
                                    @endif
                                    @if(isset($editEvents))
                                      <input type="number" class="form-control" value="{{$editEvents->jumlah_peserta}}" placeholder="Ketikkan Jumlah Peserta..." name="jmlPeserta" id="jmlPeserta"/>
                                    @else
                                      <input type="number" class="form-control" value="{{$viewEvents->jumlah_peserta}}" placeholder="Ketikkan Jumlah Peserta..." name="jmlPeserta" id="jmlPeserta" disabled/>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Lokasi</label>
                                    @if ($errors->has('lokasi'))
                                      <small style="color:red">* {{$errors->first('lokasi')}}</small>
                                    @endif
                                    @if(isset($editEvents))
                                      <input type="text" class="form-control" value="{{$editEvents->lokasi}}" placeholder="Ketikkan Lokasi..." name="lokasi" id="lokasi"/>
                                    @else
                                      <input type="text" class="form-control" value="{{$viewEvents->lokasi}}" placeholder="Ketikkan Lokasi..." name="lokasi" id="lokasi" disabled/>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Alamat</label>
                                    @if ($errors->has('alamat'))
                                      <small style="color:red">* {{$errors->first('alamat')}}</small>
                                    @endif
                                    @if(isset($editEvents))
                                      <textarea rows="4" class="form-control no-resize" placeholder="Ketikkan Alamat..." name="alamat" id="alamat">{{$editEvents->alamat}}</textarea>
                                    @else
                                      <textarea rows="4" class="form-control no-resize" placeholder="Ketikkan Alamat..." name="alamat" id="alamat" disabled>{{$viewEvents->alamat}}</textarea>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Maps</label>
                                    @if ($errors->has('maps'))
                                      <small style="color:red">* {{$errors->first('maps')}}</small>
                                    @endif
                                    @if(isset($editEvents))
                                      <input type="text" class="form-control" value="{{$editEvents->maps}}" placeholder="Ketikkan Maps..." name="maps" id="maps"/>
                                    @else
                                      <input type="text" class="form-control" value="{{$viewEvents->maps}}" placeholder="Ketikkan Maps..." name="maps" id="maps" disabled/>
                                    @endif
                                </div>
                                <div>
                                  <div>
                                    <span class="text-muted"><i>* Isikan Longitude koma Latitude dari google maps.</i></span><br>
                                    <span class="text-muted" style="color:red"><i>* Ex: -6.143693, 106.902062</i></span>
                                  </div>
                                </div>
                            </div>
                            <div class="form-group mandatory">
                                <label>Tanggal</label>
                                @if ($errors->has('tglAwal'))
                                  <small style="color:red">* {{$errors->first('tglAwal')}}</small>
                                @endif
                                @if(isset($editEvents))
                                  <div class="input-daterange input-group" id="bs_datepicker_range_container">
                                      <div class="form-line">
                                          <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($editEvents->tanggal_mulai)->format('m/d/Y')}}" placeholder="Ketikkan Tanggal awal..." name="tglAwal" id="tglAwal">
                                      </div>
                                      <span class="input-group-addon">sampai</span>
                                      <div class="form-line">
                                          <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($editEvents->tanggal_akhir)->format('m/d/Y')}}" placeholder="Ketikkan Tanggal Akhir..." name="tglAkhir" id="tglAkhir">
                                      </div>
                                  </div>
                                @else
                                  <div class="input-daterange input-group" id="bs_datepicker_range_container">
                                      <div class="form-line">
                                          <input type="text" class="form-control" value="{{$viewEvents->tanggal_mulai}}" placeholder="Ketikkan Tanggal awal..." name="tglAwal" id="tglAwal" disabled>
                                      </div>
                                      <span class="input-group-addon">sampai</span>
                                      <div class="form-line">
                                          <input type="text" class="form-control" value="{{$viewEvents->tanggal_akhir}}" placeholder="Ketikkan Tanggal Akhir..." name="tglAkhir" id="tglAkhir" disabled>
                                      </div>
                                  </div>
                                @endif
                            </div>
                            @if(isset($editEvents))
                              <div class="form-group mandatory">
                                  <div class="form-line">
                                      <label>Gambar Events</label>
                                      @if ($errors->has('urlFoto'))
                                        <small style="color:red">* {{$errors->first('urlFoto')}}</small>
                                      @endif
                                      <input type="file" name="urlFoto" class="form-control" value="{{ old('urlFoto') }}" >
                                  </div>
                                  <div>
                                    <span style="color:red;">* Biarkan kosong jika tidak ingin diganti.</span><br>
                                    <span class="text-muted"><i>* Max Size: 4MB.</i></span><br>
                                    <span class="text-muted"><i>* Rekomendasi ukuran terbaik: 555 x 280 px.</i></span>
                                  </div>
                              </div>
                            @else
                              <div class="form-group mandatory">
                                  <label>Gambar Events</label>
                                  @if($viewEvents->url_foto!="")
                                    <img src="{{url('images/events/')}}/{{$viewEvents->url_foto}}" class="js-animating-object img-responsive">
                                  @else
                                    <img src="{{url('images/')}}/no_image.jpg" class="js-animating-object img-responsive">
                                  @endif
                                  <div>
                                    <span class="text-muted"><i>* Rekomendasi ukuran terbaik: 555 x 280 px.</i></span>
                                  </div>
                              </div>
                            @endif

                            @if(isset($editEvents))
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Form Scrutneering</label>
                                    @if ($errors->has('urlScrut'))
                                      <small style="color:red">* {{$errors->first('urlScrut')}}</small>
                                    @endif
                                    <input type="file" name="urlScrut" class="form-control" value="{{ old('urlScrut') }}" >
                                </div>
                                <div>
                                  <span style="color:red;">* Biarkan kosong jika tidak ingin diganti.</span><br>
                                  <span class="text-muted"><i>* Form harus berbentuk Pdf, Excel atau Word.</i></span>
                                </div>
                            </div>
                            @else
                            <div class="form-group mandatory">
                                <label>Form Scrutneering</label>
                                @if($viewEvents->url_scrut!="")
                                  <a href="{{url('documents/')}}/{{$viewEvents->url_scrut}}" download><img src="{{url('images/')}}/doc.png" width="32px" height="32px"/></a>
                                @else
                                  <span class="text-muted"><i>* File tidak tersedia.</i></span>
                                @endif
                            </div>
                            @endif

                            @if(isset($editEvents))
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Form Rules</label>
                                    @if ($errors->has('urlRules'))
                                      <small style="color:red">* {{$errors->first('urlRules')}}</small>
                                    @endif
                                    <input type="file" name="urlRules" class="form-control" value="{{ old('urlRules') }}" >
                                </div>
                                <div>
                                  <span style="color:red;">* Biarkan kosong jika tidak ingin diganti.</span><br>
                                  <span class="text-muted"><i>* Form harus berbentuk Pdf, Excel atau Word.</i></span>
                                </div>
                            </div>
                            @else
                            <div class="form-group mandatory">
                                <label>Form Rules</label>
                                @if($viewEvents->url_rules!="")
                                  <a href="{{url('documents/')}}/{{$viewEvents->url_rules}}" download><img src="{{url('images/')}}/doc.png" width="32px" height="32px"/></a>
                                @else
                                  <span class="text-muted"><i>* File tidak tersedia.</i></span>
                                @endif
                            </div>
                            @endif

                            <div class="form-group">
                                <div class="form-line">
                                    <label>Tags</label>
                                    @if ($errors->has('tags'))
                                      <small style="color:red">* {{$errors->first('tags')}}</small>
                                    @endif
                                    <br>
                                    @if(isset($editEvents))
                                      <input type="text" class="form-control" value="{{$editEvents->tags}}" name="tags" data-role="tagsinput" id="tagsinput"/>
                                    @else
                                      <input type="text" class="form-control" value="{{$viewEvents->tags}}" name="tags" data-role="tagsinput" id="tagsinput" disabled/>
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
                                    @if(isset($editEvents))
                                        @if($editEvents->flag_headline == 1)
                                          <input type="checkbox" id="md_checkbox_21" name="flagHeadline" class="filled-in chk-col-red" value="1" checked/>
                                        @else
                                          <input type="checkbox" id="md_checkbox_21" name="flagHeadline" class="filled-in chk-col-red" value="1" />
                                        @endif
                                    @else
                                      @if($viewEvents->flag_headline == 1)
                                        <input type="checkbox" id="md_checkbox_21" name="flagHeadline" class="filled-in chk-col-red" value="1" checked disabled/>
                                      @else
                                        <input type="checkbox" id="md_checkbox_21" name="flagHeadline" class="filled-in chk-col-red" value="1" disabled/>
                                      @endif
                                    @endif
                                    <label for="md_checkbox_21">* Ya, tampilkan events ini sebagai headline.</label>
                                </div>
                            </div>
                            <div class="form-group mandatory">
                              <div class="form-line">
                                  <label>Isi Konten</label>
                                  @if ($errors->has('isiKonten'))
                                    <small style="color:red">* {{$errors->first('isiKonten')}}</small>
                                  @endif
                                  @if(isset($editEvents))
                                    <textarea id="ckeditor" name="isiKonten">
                                      {{$editEvents->isi_event}}
                                  @else
                                    <textarea id="ckeditor" name="isiKonten" disabled>
                                      {{$viewEvents->isi_event}}
                                  @endif
                                   </textarea>
                              </div>
                            </div>
                            @if(isset($editEvents))
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
