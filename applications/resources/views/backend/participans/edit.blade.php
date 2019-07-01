@extends('backend.master.layouts.master')

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
                        Edit Participans Jalinusantara
                      @else
                        View Participans Jalinusantara
                      @endif
                  </h2>
                </div>
                <div class="body">
                  <form action="{{route('participans.updateHeader')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group mandatory">
                              <div class="form-line">
                                  <label>Events</label>
                                  @if ($errors->has('eventsId'))
                                    <small style="color:red">* {{$errors->first('eventsId')}}</small>
                                  @endif
                                      @if(isset($editParticipans))
                                    <select class="form-control show-tick" name="eventsId" id="eventsId">
                                        <option value="-- Pilih --">-- Pilih --</option>
                                        @foreach($getDataEvents as $key)
                                          @if($editParticipans->id_events==$key->id)
                                            <option value="{{$key->id}}" selected>{{ $key->nama_kategori }} - {{ $key->judul_event }}</option>
                                          @else
                                            <option value="{{$key->id}}" {{ old('kategoriId') == $key->id ? 'selected=""' : ''}}>{{ $key->nama_kategori }} - {{ $key->judul_event }}</option>
                                          @endif
                                        @endforeach
                                      @else
                                    <select class="form-control show-tick" name="eventsId" id="eventsId" disabled>
                                        <option value="-- Pilih --">-- Pilih --</option>
                                        @foreach($getDataEvents as $key)
                                          @if($viewParticipans->id_events==$key->id)
                                            <option value="{{$key->id}}" selected>{{ $key->nama_kategori }} - {{ $key->judul_event }}</option>
                                          @endif
                                        @endforeach
                                      @endif
                                  </select>
                              </div>
                            </div>
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Nomor Pintu</label>
                                    @if ($errors->has('nomorPintu'))
                                      <small style="color:red">* {{$errors->first('nomorPintu')}}</small>
                                    @endif
                                    @if(isset($editParticipans))
                                      <input type="text" class="form-control" value="{{$editEvents->nomorPintu}}" placeholder="Ketikkan >Nomor Pintu..." name="nomorPintu" id="nomorPintu"/>
                                      <input type="hidden" value="{{$editEvents->id}}" name="id" id="id"/>
                                    @else
                                      <input type="text" class="form-control" value="{{$viewEvents->nomorPintu}}" placeholder="Ketikkan >Nomor Pintu..." name="nomorPintu" id="nomorPintu" disabled/>
                                    @endif
                                </div>
                            </div>

                            @if(isset($editParticipans))
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Upload File Participans</label>
                                    @if ($errors->has('urlRegister'))
                                      <small style="color:red">* {{$errors->first('urlRegister')}}</small>
                                    @endif
                                    <input type="file" name="urlFile" class="form-control" value="{{ old('urlFile') }}" >
                                </div>
                                <div>
                                  <span style="color:red;">* Biarkan kosong jika tidak ingin diganti.</span><br>
                                  <span class="text-muted"><i>* Form harus berbentuk Pdf, Excel atau Word.</i></span>
                                </div>
                            </div>
                            @else
                            <div class="form-group mandatory">
                                <label>Upload File Participans</label>
                                @if($viewParticipans->url_file!="")
                                  <a href="{{url('documents/')}}/{{$viewParticipans->url_file}}" download><img src="{{url('images/')}}/doc.png" width="32px" height="32px"/></a>
                                @else
                                  <span class="text-muted"><i>* File tidak tersedia.</i></span>
                                @endif
                            </div>
                            @endif

                            @if(isset($editEvents))
                            <button type="submit" class="btn pull-right btn-primary">Simpan Perubahan</button>
                            @endif
                            <a href="{{ URL::previous() }}" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Tidak</a>
                        </div>
                    </div>
                  </form>
                  <div class="table-responsive">
                      @if(isset($editParticipans))
                        <div class="header bg-orange">
                          <h2>
                              <a href="#" class="btn bg-blue"
                                 data-toggle="modal" data-target="#modalinsert"
                                 data-backdrop="static" data-keyboard="false"><i class="material-icons">playlist_add</i></a>
                          </h2>
                        </div>
                      @endif
                      <table class="table table-bordered table-striped table-hover" id="tabelinfo">
                          <thead>
                            <tr>
                                  <th width="3%">#</th>
                                  <th>Nama</th>
                                  <th>Posisi</th>
                                  <th>Pax</th>
                                  <th>Mobil</th>
                                  <th>Nomor Polisi</th>
                                  <th>Telephone</th>
                                  <th>Ukuran Baju</th>
                                  <th>Bahan Bakar</th>
                                  <tr>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @php $i=1; @endphp
                            @foreach($getDataParticipans as $key)
                              <tr>
                                <td>{{$i++}}</td>
                                <td>{{$key->nama}}</td>
                                <td>{{$key->posisi}}</td>
                                <td>{{$key->pax}}</td>
                                <td>{{$key->mobil}}</td>
                                <td>{{$key->nomor_polisi}}</td>
                                <td>{{$key->telephone}}</td>
                                <td>{{$key->ukuran_baju}}</td>
                                <td>{{$key->bahan_bakar}}</td>
                                <td style="text-align:center">
                                  @if(isset($editParticipans))
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
                                  @else
                                    <a href="#" class="btn btn-success btn-circle waves-effect waves-circle waves-float edit" disabled
                                       data-toggle="modal" data-target="#modaledit" data-value="{{$key->id}}"
                                       data-backdrop="static" data-keyboard="false"><i class="material-icons">open_in_new</i></a>
                                    @if($key->activated=="1")
                                      <a href="#" class="btn btn-danger btn-circle waves-effect waves-circle waves-float hapus" disabled
                                      data-toggle="modal" data-target="#modaldelete"
                                      data-value="{{$key->id}}" data-backdrop="static"
                                      data-keyboard="false"><i class="material-icons">delete_forever</i></a>
                                    @else
                                      <a href="#" class="btn bg-blue-grey btn-circle waves-effect waves-circle waves-float aktifkan" disabled
                                      data-toggle="modal" data-target="#modalAktifkan"
                                      data-value="{{$key->id}}" data-backdrop="static" data-keyboard="false"><i class="material-icons">thumb_down</i></a>
                                    @endif
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
                      <h4 class="modal-title">Tambah Participans</h4>
                  </div>
                  <div class="modal-body">
                      <form action="{{route('participans.insertDetail')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                @if(isset($editParticipans))
                                  <input type="hidden" value="{{$editEvents->id}}" name="participansIdHeader" id="participansIdHeader"/>
                                @endif
                                  <div class="form-group mandatory">
                                      <div class="form-line">
                                          <label>Nama</label>
                                          @if ($errors->has('nama'))
                                            <small style="color:red">* {{$errors->first('nama')}}</small>
                                          @endif
                                          <input type="text" value="{{ old('nama') }}" class="form-control" placeholder="Ketikkan Nama..." name="nama" id="nama"/>
                                      </div>
                                  </div>
                                  <div class="form-group mandatory">
                                      <div class="form-line">
                                          <label>Posisi</label>
                                          @if ($errors->has('posisi'))
                                            <small style="color:red">* {{$errors->first('posisi')}}</small>
                                          @endif
                                          <input type="text" value="{{ old('posisi') }}" class="form-control" placeholder="Ketikkan Posisi..." name="posisi" id="posisi"/>
                                      </div>
                                  </div>

                                  <div class="form-group mandatory">
                                      <div class="form-line">
                                          <label>Pax</label>
                                          @if ($errors->has('pax'))
                                            <small style="color:red">* {{$errors->first('pax')}}</small>
                                          @endif
                                          <input type="text" value="{{ old('pax') }}" class="form-control" placeholder="Ketikkan Pax..." name="pax" id="pax"/>
                                      </div>
                                  </div>
                                  <div class="form-group mandatory">
                                      <div class="form-line">
                                          <label>Mobil</label>
                                          @if ($errors->has('mobil'))
                                            <small style="color:red">* {{$errors->first('mobil')}}</small>
                                          @endif
                                          <input type="text" value="{{ old('mobil') }}" class="form-control" placeholder="Ketikkan Mobil..." name="mobil" id="mobil"/>
                                      </div>
                                  </div>

                                  <div class="form-group mandatory">
                                      <div class="form-line">
                                          <label>Nomor Polisi</label>
                                          @if ($errors->has('nomorPolisi'))
                                            <small style="color:red">* {{$errors->first('nomorPolisi')}}</small>
                                          @endif
                                          <input type="text" value="{{ old('nomorPolisi') }}" class="form-control" placeholder="Ketikkan Nomor Polisi..." name="nomorPolisi" id="nomorPolisi"/>
                                      </div>
                                  </div>
                                  <div class="form-group mandatory">
                                      <div class="form-line">
                                          <label>Telephone</label>
                                          @if ($errors->has('telephone'))
                                            <small style="color:red">* {{$errors->first('telephone')}}</small>
                                          @endif
                                          <input type="text" value="{{ old('telephone') }}" class="form-control" placeholder="Ketikkan Telephone..." name="telephone" id="telephone"/>
                                      </div>
                                  </div>

                                  <div class="form-group mandatory">
                                      <div class="form-line">
                                          <label>Ukuran Baju</label>
                                          @if ($errors->has('ukuranBaju'))
                                            <small style="color:red">* {{$errors->first('ukuranBaju')}}</small>
                                          @endif
                                          <input type="text" value="{{ old('ukuranBaju') }}" class="form-control" placeholder="Ketikkan Ukuran Baju..." name="ukuranBaju" id="ukuranBaju"/>
                                      </div>
                                  </div>
                                  <div class="form-group mandatory">
                                      <div class="form-line">
                                          <label>Bahan Bakar</label>
                                          @if ($errors->has('bahanBakar'))
                                            <small style="color:red">* {{$errors->first('bahanBakar')}}</small>
                                          @endif
                                          <input type="text" value="{{ old('bahanBakar') }}" class="form-control" placeholder="Ketikkan Bahan Bakar..." name="bahanBakar" id="bahanBakar"/>
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
                      <h4 class="modal-title">Edit Konten Sertifikat</h4>
                  </div>
                  <div class="modal-body">
                      <form action="{{route('participans.updateDetail')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Nama</label>
                                        @if ($errors->has('namaEdit'))
                                          <small style="color:red">* {{$errors->first('namaEdit')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('namaEdit') }}" class="form-control" placeholder="Ketikkan Nama..." name="namaEdit" id="namaEdit"/>
                                        <input type="hidden" name="idDetail" id="idDetail" value="{{ old('idDetail') }}">
                                        <input type="hidden" name="idDetail" id="participansIdHeaderEdit" value="{{ old('participansIdHeaderEdit') }}">
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Posisi</label>
                                        @if ($errors->has('posisiEdit'))
                                          <small style="color:red">* {{$errors->first('posisiEdit')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('posisiEdit') }}" class="form-control" placeholder="Ketikkan Posisi..." name="posisiEdit" id="posisiEdit"/>
                                    </div>
                                </div>

                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Pax</label>
                                        @if ($errors->has('paxEdit'))
                                          <small style="color:red">* {{$errors->first('paxEdit')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('paxEdit') }}" class="form-control" placeholder="Ketikkan Pax..." name="paxEdit" id="paxEdit"/>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Mobil</label>
                                        @if ($errors->has('mobilEdit'))
                                          <small style="color:red">* {{$errors->first('mobilEdit')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('mobilEdit') }}" class="form-control" placeholder="Ketikkan Mobil..." name="mobilEdit" id="mobilEdit"/>
                                    </div>
                                </div>

                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Nomor Polisi</label>
                                        @if ($errors->has('nomorPolisiEdit'))
                                          <small style="color:red">* {{$errors->first('nomorPolisiEdit')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('nomorPolisiEdit') }}" class="form-control" placeholder="Ketikkan Nomor Polisi..." name="nomorPolisiEdit" id="nomorPolisiEdit"/>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Telephone</label>
                                        @if ($errors->has('telephoneEdit'))
                                          <small style="color:red">* {{$errors->first('telephoneEdit')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('telephoneEdit') }}" class="form-control" placeholder="Ketikkan Telephone..." name="telephoneEdit" id="telephoneEdit"/>
                                    </div>
                                </div>

                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Ukuran Baju</label>
                                        @if ($errors->has('ukuranBajuEdit'))
                                          <small style="color:red">* {{$errors->first('ukuranBajuEdit')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('ukuranBajuEdit') }}" class="form-control" placeholder="Ketikkan Ukuran Baju..." name="ukuranBajuEdit" id="ukuranBajuEdit"/>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Bahan Bakar</label>
                                        @if ($errors->has('bahanBakarEdit'))
                                          <small style="color:red">* {{$errors->first('bahanBakarEdit')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('bahanBakarEdit') }}" class="form-control" placeholder="Ketikkan Bahan Bakar..." name="bahanBakarEdit" id="bahanBakarEdit"/>
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
                      <h4 class="modal-title">Non Aktifkan Data Participans Detail</h4>
                  </div>
                  <div class="modal-body">
                      <p>Apakah anda yakin untuk mengnonaktifkan data participans detail ini?</p>
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
                  <h4 class="modal-title">Aktifkan Data Participans Detail</h4>
              </div>
              <div class="modal-body">
                  <p>Apakah anda yakin untuk mengaktifkan data participans detail ini?</p>
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

<!-- Ckeditor -->
<script src="{{asset('theme/plugins/ckeditor/ckeditor.js')}}"></script>

<!-- TinyMCE -->
<script src="{{asset('theme/plugins/tinymce/tinymce.js')}}"></script>

<script src="{{asset('theme/js/pages/forms/editors.js')}}"></script>

<script>
  $(document).ready(function() {

  });

  $("#tabelinfo").on("click", "a.hapus", function(){
    var a = $(this).data('value');
    var b = "hapus";
    var c = <?php echo $editEvents->id?>;
    $('#setYaHapus').attr('href', '{{url('admin/delete-participans-detail/')}}/'+a+'/'+b+'/'+c);
  });

  $("#tabelinfo").on("click", "a.aktifkan", function(){
    var a = $(this).data('value');
    var b = "aktifkan";
    var c = <?php echo $editEvents->id?>;
    $('#setYaAktifkan').attr('href', '{{url('admin/delete-participans-detail/')}}/'+a+'/'+b+'/'+c);
  });

  $("#tabelinfo").on("click", "a.edit", function(){
    var a = $(this).data('value');
    $.ajax({
      url: "{{url('/')}}/admin/bind-participans-detail/"+a,
      dataType: 'json',
      success: function(data){
        var participansIdHeaderEdit = data.id_header;
        var namaEdit = data.nama;
        var posisiEdit = data.posisi;
        var paxEdit = data.pax;
        var mobilEdit = data.mobil;
        var nomorPolisiEdit = data.nomor_polisi;
        var telephoneEdit = data.telephone;
        var ukuranBajuEdit = data.ukuran_baju;
        var bahanBakarEdit = data.bahan_bakar;

        $('#participansIdHeaderEdit').val(participansIdHeaderEdit);
        $('#namaEdit').val(namaEdit);
        $('#posisiEdit').val(posisiEdit);
        $('#paxEdit').val(paxEdit);
        $('#mobilEdit').val(mobilEdit);
        $('#nomorPolisiEdit').val(nomorPolisiEdit);
        $('#telephoneEdit').val(telephoneEdit);
        $('#ukuranBajuEdit').val(ukuranBajuEdit);
        $('#bahanBakarEdit').val(bahanBakarEdit);
      }
    })
  });
</script>

@endsection
