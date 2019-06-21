@extends('backend.master.layouts.master')

@section('title')
    <title>Jalinusantara</title>
@endsection


@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>FORM KELOLA COMMENT'S</h2>
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
                    List Data Comment's
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="tabelinfo">
                            <thead>
                                <tr>
                                    <th style="text-align:center">No</th>
                                    <th style="text-align:center">Judul Informasi</th>
                                    <th style="text-align:center">Email</th>
                                    <th style="text-align:center">Keterangan</th>
                                    <th style="text-align:center">Subject</th>
                                    <th style="text-align:center">Message</th>
                                    <th style="text-align:center">Status Publish</th>
                                    <th style="text-align:center;width:12%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                              @php $i=1; @endphp
                              @foreach($getComment as $key)
                                <tr>
                                  <td>{{$i++}}</td>
                                  <td>{{$key->judul_informasi}}</td>
                                  <td>{{$key->email}}</td>
                                  <td>{{$key->nama}}</td>
                                  <td>{{$key->subject}}</td>
                                  <td>{{$key->message}}</td>
                                  <td style="text-align:center">
                                    @if($key->flag_comment=="1")
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
                                    @if($key->flag_tanggapan=="1")
                                    <a href="#" class="btn btn-primary btn-circle waves-effect waves-circle waves-float view"
                                       data-toggle="modal" data-target="#modalview" data-value="{{$key->id}}"
                                       data-backdrop="static" data-keyboard="false"><i class="material-icons">comment</i></a>
                                    @else
                                    <a href="#" class="btn btn-success btn-circle waves-effect waves-circle waves-float edit"
                                       data-toggle="modal" data-target="#modaledit" data-value="{{$key->id}}"
                                       data-backdrop="static" data-keyboard="false"><i class="material-icons">open_in_new</i></a>
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

    <!-- Modal Update-->
    <div class="modal fade" id="modaledit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bounceInRight">
                  <div class="modal-header">
                      <h4 class="modal-title">Tanggapan</h4>
                  </div>
                  <div class="modal-body">
                      <form action="{{route('comment.storeTanggapan')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Masukkan Tanggapan Anda...</label>
                                        @if ($errors->has('tanggapan'))
                                          <small style="color:red">* {{$errors->first('tanggapan')}}</small>
                                        @endif
                                        <input type="hidden" name="idComment" id="idComment" value="{{ old('idComment') }}">
                                        <textarea rows="4" class="form-control no-resize" placeholder="Ketikkan Tanggapan Anda..." name="tanggapan" id="tanggapan">{{ old('tanggapan') }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn pull-right btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Tidak</button>
                            </div>
                        </div>
                      </form>
                  </div>
              </div>
        </div>
    </div>

    <!-- Modal Update-->
    <div class="modal fade" id="modalview" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bounceInRight">
                  <div class="modal-header">
                      <h4 class="modal-title">View Tanggpan</h4>
                  </div>
                  <div class="modal-body">
                      <form action="" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Masukkan Tanggapan Anda...</label>
                                        <input type="hidden" name="idCommentView" id="idCommentView" value="{{ old('idCommentView') }}">
                                        <textarea rows="4" class="form-control no-resize" placeholder="Ketikkan Tanggapan Anda..." name="tanggapanView" id="tanggapanView"></textarea>
                                    </div>
                                </div>
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
                      <h4 class="modal-title">Publish Data Tanggapan</h4>
                  </div>
                  <div class="modal-body">
                        <p>Apakah anda yakin untuk mengubah status tanggapan ini?</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-white" data-dismiss="modal"  onclick="resetPage()">Tidak</button>
                      <a href="" class="btn btn-primary" id="setFlagPublish">Ya, saya yakin</a>
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
  @if ($errors->has('tanggapan'))
  $('#modaledit').modal('show');
  @endif

  $("#tabelinfo").on("click", "a.flagpublish", function(){
    var a = $(this).data('value');
    $('#setFlagPublish').attr('href', '{{url('admin/publish-comment/')}}/'+a);
  });

  $("#tabelinfo").on("click", "a.edit", function(){
    var a = $(this).data('value');
    $.ajax({
      url: "{{url('/')}}/admin/bind-comment/"+a,
      dataType: 'json',
      success: function(data){
        var id = data[0].id;
        var tanggapan = data[0].tanggapan;

        $('#idComment').attr('value', id);
        $('#tanggapan').val(tanggapan);
      }
    })
  });

  $("#tabelinfo").on("click", "a.view", function(){
    var a = $(this).data('value');
    $.ajax({
      url: "{{url('/')}}/admin/bind-comment/"+a,
      dataType: 'json',
      success: function(data){
        var id = data[0].id_tanggapan;
        var tanggapan = data[0].tanggapan;

        $('#idCommentView').attr('value', id);
        $('#tanggapanView').val(tanggapan);
      }
    })
  });

</script>
@endsection
