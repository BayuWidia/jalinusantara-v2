@extends('backend.master.layouts.master')

@section('title')
    <title>Jalinusantara</title>
@endsection


@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>FORM KELOLA SPONSOR</h2>
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
                                    <th style="text-align:center">Sponsor</th>
                                    <th style="text-align:center">Status</th>
                                    <th style="text-align:center">Status Publish</th>
                                    <th style="text-align:center;width:12%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @php $i=1; @endphp
                              @foreach($getSponsor as $key)
                                <tr>
                                  <td>{{$i++}}</td>
                                  <td>{{$key->nama_sponsor}}</td>
                                  <td>
                                    @php
                                      if (strpos($key->link_sponsor, 'http') !== false) {
                                        @endphp
                                          <a href="{{$key->link_sponsor}}" target="_blank">{{$key->link_sponsor}}</a>
                                        @php
                                      } else {
                                        @endphp
                                        <a href="http://{{$key->link_sponsor}}" target="_blank">{{$key->link_sponsor}}</a>
                                        @php
                                      }
                                    @endphp
                                  </td>
                                  <td>{{$key->keterangan_sponsor}}</td>
                                  <td style="text-align:center">
                                      @if($key->url_sponsor!="")
                                        <img src="{{url('images/sponsor/')}}/{{$key->url_sponsor}}">
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
                                    @if($key->flag_sponsor=="1")
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
                      <h4 class="modal-title">Tambah Konten Sponsor</h4>
                  </div>
                  <div class="modal-body">
                      <form action="{{route('sponsor.store')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Gambar Sponsor</label>
                                        @if ($errors->has('urlSponsor'))
                                          <small style="color:red">* {{$errors->first('urlSponsor')}}</small>
                                        @endif
                                        <input type="file" name="urlSponsor" class="form-control" value="{{ old('urlSponsor') }}" >
                                    </div>
                                    <div>
                                      <span class="text-muted"><i>* Max Size: 2MB.</i></span><br>
                                      <span class="text-muted"><i>* Rekomendasi ukuran terbaik: 188 x 126 px.</i></span>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Nama Sponsor</label>
                                        @if ($errors->has('namaSponsor'))
                                          <small style="color:red">* {{$errors->first('namaSponsor')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('namaSponsor') }}" class="form-control" placeholder="Ketikkan Nama Sponsor..." name="namaSponsor" id="namaSponsor"/>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Link Sponsor</label>
                                        @if ($errors->has('linkSponsor'))
                                          <small style="color:red">* {{$errors->first('linkSponsor')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('linkSponsor') }}" class="form-control" placeholder="Ketikkan Link Sponsor..." name="linkSponsor" id="linkSponsor"/>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Keterangan Sponsor</label>
                                        @if ($errors->has('keteranganSponsor'))
                                          <small style="color:red">* {{$errors->first('keteranganSponsor')}}</small>
                                        @endif
                                        <textarea rows="4" class="form-control no-resize" placeholder="Ketikkan Keterangan Sponsor..." name="keteranganSponsor" id="keteranganSponsor">{{ old('keteranganSponsor') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Nilai Rekomendasi</label>
                                        <input type="number" value="{{ old('rekomendasi') }}" class="form-control" placeholder="Ketikkan Nilai Rekomendasi..." name="rekomendasi" id="rekomendasi"/>
                                    </div>
                                    <div>
                                      <span class="text-muted"><i>* Berikan nilai terbaik anda untuk sponsor ini.</i></span>
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
                      <h4 class="modal-title">Edit Konten Sponsor</h4>
                  </div>
                  <div class="modal-body">
                      <form action="{{route('sponsor.update')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Gambar Sponsor</label>
                                        @if ($errors->has('urlSponsor'))
                                          <small style="color:red">* {{$errors->first('urlSponsor')}}</small>
                                        @endif
                                        <input type="file" name="urlSponsor" class="form-control" value="{{ old('urlSponsor') }}" >
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
                                        <label>Nama Sponsor</label>
                                        @if ($errors->has('namaSponsorEdit'))
                                          <small style="color:red">* {{$errors->first('namaSponsorEdit')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('namaSponsorEdit') }}" class="form-control" placeholder="Ketikkan Nama Sponsor..." name="namaSponsorEdit" id="namaSponsorEdit"/>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Link Sponsor</label>
                                        @if ($errors->has('linkSponsorEdit'))
                                          <small style="color:red">* {{$errors->first('linkSponsorEdit')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('linkSponsorEdit') }}" class="form-control" placeholder="Ketikkan Link Sponsor..." name="linkSponsorEdit" id="linkSponsorEdit"/>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Keterangan Sponsor</label>
                                        @if ($errors->has('keteranganSponsorEdit'))
                                          <small style="color:red">* {{$errors->first('keteranganSponsorEdit')}}</small>
                                        @endif
                                        <textarea rows="4" class="form-control no-resize" placeholder="Ketikkan Keterangan Sponsor..." name="keteranganSponsorEdit" id="keteranganSponsorEdit">{{ old('keteranganSponsorEdit') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Nilai Rekomendasi</label>
                                        <input type="number" value="{{ old('rekomendasiEdit') }}" class="form-control" placeholder="Ketikkan Nilai Rekomendasi..." name="rekomendasiEdit" id="rekomendasiEdit"/>
                                    </div>
                                    <div>
                                      <span class="text-muted"><i>* Berikan nilai terbaik anda untuk sponsor ini.</i></span>
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
                      <h4 class="modal-title">Publish Data Sponsor</h4>
                  </div>
                  <div class="modal-body">
                        <p>Apakah anda yakin untuk mengubah status sponsor ini?</p>
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
                      <h4 class="modal-title">Non Aktifkan Data Sponsor</h4>
                  </div>
                  <div class="modal-body">
                      <p>Apakah anda yakin untuk mengnonaktifkan data sponsor ini?</p>
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
                  <h4 class="modal-title">Aktifkan Data Sponsor</h4>
              </div>
              <div class="modal-body">
                  <p>Apakah anda yakin untuk mengaktifkan data sponsor ini?</p>
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
  @if ($errors->has('urlSponsor') || $errors->has('namaSponsor') || $errors->has('linkSponsor') || $errors->has('keteranganSponsor') || $errors->has('rekomendasi') || $errors->has('activated'))
  $('#modalinsert').modal('show');
  @endif

  @if ($errors->has('namaSponsorEdit') || $errors->has('linkSponsorEdit') || $errors->has('keteranganSponsorEdit') || $errors->has('rekomendasiEdit'))
  $('#modaledit').modal('show');
  @endif

  $("#tabelinfo").on("click", "a.flagpublish", function(){
    var a = $(this).data('value');
    $('#setFlagPublish').attr('href', '{{url('admin/publish-sponsor/')}}/'+a);
  });

  $("#tabelinfo").on("click", "a.hapus", function(){
    var a = $(this).data('value');
    var b = "hapus";
    $('#setYaHapus').attr('href', '{{url('admin/delete-sponsor/')}}/'+a+'/'+b);
  });

  $("#tabelinfo").on("click", "a.aktifkan", function(){
    var a = $(this).data('value');
    var b = "aktifkan";
    $('#setYaAktifkan').attr('href', '{{url('admin/delete-sponsor/')}}/'+a+'/'+b);
  });

  $("#tabelinfo").on("click", "a.edit", function(){
    var a = $(this).data('value');
    $.ajax({
      url: "{{url('/')}}/admin/bind-sponsor/"+a,
      dataType: 'json',
      success: function(data){
        var id = data.id;
        var nama_sponsor = data.nama_sponsor;
        var link_sponsor = data.link_sponsor;
        var keterangan_sponsor = data.keterangan_sponsor;
        var rekomendasi = data.rekomendasi;
        var url_sponsor = data.url_sponsor;

        $('#id').attr('value', id);
        $('#namaSponsorEdit').val(nama_sponsor);
        $('#linkSponsorEdit').val(link_sponsor);
        $('#keteranganSponsorEdit').val(keterangan_sponsor);
        $('#rekomendasiEdit').val(rekomendasi);
      }
    })
  });

</script>
@endsection
