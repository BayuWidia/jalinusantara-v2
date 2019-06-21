@extends('backend.master.layouts.master')

@section('title')
    <title>Jalinusantara</title>
@endsection


@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>FORM KELOLA REGISTRASI</h2>
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
                    List Data Registrasi
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="tabelinfo">
                            <thead>
                                <tr>
                                    <th style="text-align:center">No</th>
                                    <th style="text-align:center">No Registrasi</th>
                                    <th style="text-align:center">Judul Events</th>
                                    <th style="text-align:center">Email</th>
                                    <th style="text-align:center">Nama Driver</th>
                                    <th style="text-align:center">No Telp</th>
                                    <th style="text-align:center">No Pintu</th>
                                    <th style="text-align:center">Approve</th>
                                    <th style="text-align:center;width:12%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                              @php $i=1; @endphp
                              @foreach($getRegistrasiEvents as $key)
                                <tr>
                                  <td>{{$i++}}</td>
                                  <td>{{$key->no_registrasi}}</td>
                                  <td>{{$key->judul_event}}</td>
                                  <td>{{$key->email}}</td>
                                  <td>{{$key->nama_driver}}</td>
                                  <td>{{$key->no_telp_driver}}</td>
                                  <td>{{$key->nomor_pintu}}</td>
                                  <td style="text-align:center">
                                    @if($key->flag_approve=="1")
                                      <a href="#" class="btn btn-warning btn-circle waves-effect waves-circle waves-float flagapprove"
                                      data-toggle="modal" data-target="#modalflagapprove"
                                      data-value="{{$key->id}}" data-backdrop="static"
                                      data-keyboard="false"><i class="material-icons">favorite</i></a>
                                    @else
                                      <a href="#" class="btn bg-blue-grey btn-circle waves-effect waves-circle waves-float flagapprove"
                                      data-toggle="modal" data-target="#modalflagapprove" data-value="{{$key->id}}"
                                      data-backdrop="static" data-keyboard="false"><i class="material-icons">favorite_border</i></a>
                                    @endif
                                  </td>
                                  <td style="text-align:center">
                                    <a href="{{ route('registrasi.edit', $key->id) }}" class="btn btn-success btn-circle waves-effect waves-circle waves-float">
                                        <i class="material-icons">open_in_new</i></a>
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

    <!-- Modal Publish-->
    <div class="modal fade" id="modalflagapprove" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bounceInRight">
                  <div class="modal-header">
                      <h4 class="modal-title">Approve Data Registrasi</h4>
                  </div>
                  <div class="modal-body">
                        <p>Apakah anda yakin untuk approve data ini?</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-white" data-dismiss="modal"  onclick="resetPage()">Tidak</button>
                      <a href="" class="btn btn-primary" id="setFlagApprove">Ya, saya yakin</a>
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
  $("#tabelinfo").on("click", "a.flagapprove", function(){
    var a = $(this).data('value');
    $('#setFlagApprove').attr('href', '{{url('admin/approve-registrasi/')}}/'+a);
  });


</script>
@endsection
