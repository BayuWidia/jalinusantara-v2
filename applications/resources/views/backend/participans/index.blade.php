@extends('backend.master.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>FORM KELOLA EVENTS</h2>
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
                      List Data Participans Jalinusantara
                  </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tabelinfo">
                            <thead>
                                <tr>
                                    <th style="text-align:center">Judul</th>
                                    <th style="text-align:center">Nomor Pintu</th>
                                    <th style="text-align:center">Publish</th>
                                    <th style="text-align:center">Status</th>
                                    <th style="text-align:center;width:28%">Action</th>
                                </tr>
                            </thead>
                        </table>
                        <tbody>
                          @php $i=1; @endphp
                          @foreach($getDataParticipans as $key)
                            <tr>
                              <td>{{$i++}}</td>
                              <td>{{$key->judul_event}}</td>
                              <td>{{$key->nomor_pintu}}</td>
                              <td style="text-align:center">
                                @if($key->flag_publish=="1")
                                  <span class="badge bg-orange">
                                    Publish
                                  </span>
                                @else
                                  <span class="badge bg-blue-grey">
                                    Un Publish
                                  </span>
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
                                @if($key->flag_publish=="1")
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
                    </div>
                </div>
            </div>
          </div>
    </div>
    <!-- #END# Input -->

    <!-- Modal Publish-->
    <div class="modal fade" id="modalflagpublish" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bounceInRight">
                  <div class="modal-header">
                      <h4 class="modal-title">Publish Data Events</h4>
                  </div>
                  <div class="modal-body">
                        <p>Apakah anda yakin untuk mengubah status events ini?</p>
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
                      <h4 class="modal-title">Non Aktifkan Data participans</h4>
                  </div>
                  <div class="modal-body">
                      <p>Apakah anda yakin untuk mengnonaktifkan data participans ini?</p>
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
                  <h4 class="modal-title">Aktifkan Data participans</h4>
              </div>
              <div class="modal-body">
                  <p>Apakah anda yakin untuk mengaktifkan data participans ini?</p>
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

  $("#tabelinfo").on("click", "a.flagpublish", function(){
    var a = $(this).data('value');
    $('#setFlagPublish').attr('href', '{{url('admin/publish-participans/')}}/'+a);
  });

  $("#tabelinfo").on("click", "a.hapus", function(){
    var a = $(this).data('value');
    var b = "hapus";
    $('#setYaHapus').attr('href', '{{url('admin/delete-participans-header/')}}/'+a+'/'+b);
  });

  $("#tabelinfo").on("click", "a.aktifkan", function(){
    var a = $(this).data('value');
    var b = "aktifkan";
    $('#setYaAktifkan').attr('href', '{{url('admin/delete-participans-header/')}}/'+a+'/'+b);
  });


</script>
@endsection
