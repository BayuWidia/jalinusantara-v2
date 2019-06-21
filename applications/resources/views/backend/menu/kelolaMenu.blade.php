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
                                    <th style="text-align:center">Nama Menu</th>
                                    <th style="text-align:center">Url</th>
                                    <th style="text-align:center">Parent</th>
                                    <th style="text-align:center">Icon</th>
                                    <th style="text-align:center">Status</th>
                                    <th style="text-align:center;width:12%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @php $i=1; @endphp
                              @foreach($getListMenu  as $key)
                                <tr>
                                  <td>{{$i++}}</td>
                                  <td class='details-control' value='{{$key->id}}:{{$key->nama_menu}}'>{{$key->nama_menu}}</td>
                                  <td>{{$key->url}}</td>
                                  <td style="text-align:center">
                                    @if($key->id_parent=="#")
                                      <span class="badge bg-green">
                                        Parent
                                      </span>
                                    @else
                                      <span class="badge bg-blue">
                                        Child
                                      </span>
                                    @endif
                                  </td>
                                  <td><i class="material-icons">{{$key->icon}}</i> - {{$key->icon}}</td>
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
                                      data-toggle="modal" data-target="#modalaktifkan"
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content bounceInRight">
                  <div class="modal-header">
                      <h4 class="modal-title">Tambah Konten Menu</h4>
                  </div>
                  <div class="modal-body">
                      <form action="{{route('menu.store')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Menu Name</label>
                                        @if ($errors->has('namaMenu'))
                                          <small style="color:red">* {{$errors->first('namaMenu')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('namaMenu') }}" class="form-control" placeholder="Ketikkan Nama Menu..." name="namaMenu" id="namaMenu"/>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Menu Url</label>
                                        @if ($errors->has('urlMenu'))
                                          <small style="color:red">* {{$errors->first('urlMenu')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('urlMenu') }}" class="form-control" placeholder="Ketikkan Url Menu..." name="urlMenu" id="urlMenu"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Icon</label>
                                        @if ($errors->has('icon'))
                                          <small style="color:red">* {{$errors->first('icon')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('icon') }}" class="form-control" placeholder="Ketikkan Icon..." name="icon" id="icon"/>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Status Parent</label>
                                        <select class="form-control show-tick" name="statusMenu" id="statusMenu">
                                            <option value="0" {{old('statusMenu')=="0"? 'selected':''}}>Parent</option>
                                            <option value="1" {{old('statusMenu')=="1"? 'selected':''}}>Child</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mandatory" id="divParent">
                                  <div class="form-line">
                                      <label>Parent</label>
                                      @if ($errors->has('parentId'))
                                        <small style="color:red">* {{$errors->first('parentId')}}</small>
                                      @endif
                                      <select class="form-control show-tick" name="parentId" id="parentId">
                                          @foreach($getMenuParent as $key)
                                            <option value="{{ $key->id }}" {{ old('parentId') == $key->id ? 'selected=""' : ''}}>{{ $key->nama_menu }}</option>
                                          @endforeach
                                      </select>
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
                                <div class="row">
                                    <div class="col-md-12">
                                      <div class="table-responsive">
                                         <table class="table table-striped table-bordered table-hover" id="tabelroleEdit">
                                             <thead>
                                                 <tr style="background-color:grey;color:white">
                                                     <th style="width:5%">
                                                          <input type="checkbox" id="roleParent" onClick="toggleAll(this)"
                                                            class="filled-in chk-col-red" />
                                                            <label for="roleParent">
                                                     </th>
                                                     <th>Role Name</th>
                                                     <th>Deskripsi</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                               @php $i=1; @endphp
                                               @foreach($getRole as $key)
                                                 <tr>
                                                   <td><input type="checkbox" id="idrole{{$i}}[]" name='idrole[]'
                                                     class="filled-in chk-col-red" value="{{$key->id}}" />
                                                     <label for="idrole{{$i}}[]">
                                                   </td>
                                                   <td>{{$key->nama_role}}</td>
                                                   <td>{{$key->keterangan}}</td>
                                                 </tr>
                                                 @php $i++; @endphp
                                               @endforeach
                                             </tbody>
                                         </table>
                                     </div>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content bounceInRight">
                  <div class="modal-header">
                      <h4 class="modal-title">Edit Konten Menu</h4>
                  </div>
                  <div class="modal-body">
                      <form action="{{route('menu.update')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                          <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Menu Name</label>
                                        @if ($errors->has('namaMenuEdit'))
                                          <small style="color:red">* {{$errors->first('namaMenuEdit')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('namaMenuEdit') }}" class="form-control" placeholder="Ketikkan Nama Menu..." name="namaMenuEdit" id="namaMenuEdit"/>
                                        <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Menu Url</label>
                                        @if ($errors->has('urlMenuEdit'))
                                          <small style="color:red">* {{$errors->first('urlMenuEdit')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('urlMenuEdit') }}" class="form-control" placeholder="Ketikkan Url Menu..." name="urlMenuEdit" id="urlMenuEdit"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Icon</label>
                                        @if ($errors->has('iconEdit'))
                                          <small style="color:red">* {{$errors->first('iconEdit')}}</small>
                                        @endif
                                        <input type="text" value="{{ old('iconEdit') }}" class="form-control" placeholder="Ketikkan Icon..." name="iconEdit" id="iconEdit"/>
                                    </div>
                                </div>
                                <div class="form-group mandatory">
                                    <div class="form-line">
                                        <label>Status Parent</label>
                                        <select class="form-control" name="statusMenuEdit" id="statusMenuEdit">
                                            <option value="0" {{old('statusMenuEdit')=="0"? 'selected':''}} >Parent</option>
                                            <option value="1" {{old('statusMenuEdit')=="1"? 'selected':''}} >Child</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mandatory" id="divParentEdit">
                                  <div class="form-line">
                                      <label>Parent</label>
                                      @if ($errors->has('parentIdEdit'))
                                        <small style="color:red">* {{$errors->first('parentIdEdit')}}</small>
                                      @endif
                                      <select class="form-control" name="parentIdEdit" id="parentIdEdit">
                                          @foreach($getMenuParent as $key)
                                            <option value="{{ $key->id }}" {{ old('parentIdEdit') == $key->id ? 'selected=""' : ''}}>{{ $key->nama_menu }}</option>
                                          @endforeach
                                      </select>
                                  </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                      <div class="table-responsive">
                                         <table class="table table-striped table-bordered table-hover" id="tabelroleEdit">
                                             <thead>
                                                 <tr style="background-color:grey;color:white">
                                                     <th style="width:5%">
                                                          <input type="checkbox" id="roleParentEdit" onClick="toggleAllEdit(this)"
                                                            class="filled-in chk-col-red" />
                                                            <label for="roleParentEdit">
                                                     </th>
                                                     <th>Role Name</th>
                                                     <th>Deskripsi</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                               @php $i=1; @endphp
                                               @foreach($getRole as $key)
                                                 <tr>
                                                   <td><input type="checkbox" id="idroleEdit{{$i}}[]" name='idroleEdit[]'
                                                     class="filled-in chk-col-red" value="{{$key->id}}" />
                                                     <label for="idroleEdit{{$i}}[]">
                                                   </td>
                                                   <td>{{$key->nama_role}}</td>
                                                   <td>{{$key->keterangan}}</td>
                                                 </tr>
                                                 @php $i++; @endphp
                                               @endforeach
                                             </tbody>
                                         </table>
                                     </div>
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
                      <h4 class="modal-title">Non Aktifkan Data Menu</h4>
                  </div>
                  <div class="modal-body">
                      <p>Apakah anda yakin untuk mengnonaktifkan data menu ini?</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-white" data-dismiss="modal"  onclick="resetPage()">Tidak</button>
                      <a href="" class="btn btn-primary" id="setYaHapus">Ya, saya yakin</a>
                  </div>
              </div>
        </div>
    </div>

    <!-- Modal Aktikan-->
    <div class="modal inmodal fade" id="modalaktifkan" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content bounceInRight">
              <div class="modal-header">
                  <h4 class="modal-title">Aktifkan Data Menu</h4>
              </div>
              <div class="modal-body">
                  <p>Apakah anda yakin untuk mengaktifkan data menu ini?</p>
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
      $("#divParent").prop('hidden', true);

      // $("#divParentEdit").prop('hidden', true);

      $('#tabelinfo').DataTable({
      });
  });
</script>

<script>

  function toggleAll(pilih) {
    checkboxes = document.getElementsByName('idrole[]');
    console.log(checkboxes);
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = pilih.checked;
    }
  }

  function toggleAllEdit(pilih) {
    checkboxes = document.getElementsByName('idroleEdit[]');
    console.log(checkboxes);
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = pilih.checked;
    }
  }

  $("#statusMenu").change(function(){
    var a = $(this).val();
    if (a == 0) {
       $("#divParent").prop('hidden', true);
    } else {
       $("#divParent").prop('hidden', false);
    }
  });

  $("#statusMenuEdit").change(function(){
    var a = $(this).val();
    if (a == 0) {
       $("#divParentEdit").prop('hidden', true);
    } else {
       $("#divParentEdit").prop('hidden', false);
    }
  });

  @if ($errors->has('namaMenu') || $errors->has('urlMenu') || $errors->has('statusMenu') || $errors->has('activated'))
  $('#modalinsert').modal('show');
  @endif

  @if ($errors->has('namaMenuEdit') || $errors->has('urlMenuEdit') || $errors->has('statusMenuEdit'))
  $('#modaledit').modal('show');
  @endif

  //JAVASCRIPT MENU
  var valIdMenu = "";
  $('#tabelinfo tbody').on( 'click', 'td.details-control', function () {
    var dt = $('#tabelinfo').DataTable(
    );

    window.valIdMenu = $(this).attr('value');
    var tr = $(this).closest('tr');
    var row = dt.row( tr );

     if ( row.child.isShown() ) {
         row.child.hide();
         tr.removeClass('shown');
     }
     else {
       $('.shown').each(function(i, obj) {
          newtr = $(this).closest('tr');
          newrow = dt.row( newtr );
          newrow.child.hide();
          newtr.removeClass('shown');
        });

         row.child( format(window.valIdMenu) ).show();
         tr.addClass('shown');
     }

  } );

  function format ( d ) {
    var strD = d;
    var arrD = strD.split(":");
   $.ajax({
        url: "{{url('/')}}/admin/get-menu-child/"+arrD[0],
        dataType: 'json',
        success: function(data){
          if (data.length < 1) {
            $("<tr>").appendTo($("#itemList"))
               .append('<td colspan="6" style="text-align:center;color:Red"><i>Pada Menu Ini Tidak Memiliki Child</i></th>');
          } else {
            $n = 1;
            for (var i = 0; i < data.length; i++) {
              $statusChild = '';
              $parent = '';
              if (data[i].activated == 1) {
                $statusChild = "Active";
              } else {
                $statusChild = "Non Active";
              }

              if (data[i].id_parent == 0) {
                $parent = "Parent";
              } else {
                $parent = "Child dari " + arrD[1];
              }

              if($statusChild == 'Active'){
                $("<tr style='background-color:#FFB6C1'>").appendTo($("#itemList"))      // Create new row, append it to the table's html.
                 .append('<td>' + $n + '</td>')
                 .append('<td class="details-control-child" value="'+data[i].id+'">'+data[i].nama_menu+'</td>')
                 .append('<td>'+data[i].url+'</td>')
                 .append('<td><span class="badge bg-orange" style="color:white">'+$parent+'</span></td>')
                 .append('<td><span class="badge bg-red">'+$statusChild+'</span></td>')
                 .append('<td>'+
                      '<a href="#" data-value="'+data[i].id+'" class="btn btn-success btn-circle waves-effect waves-circle waves-float edit" data-toggle="modal" data-target="#modaledit" id="btnUbah" data-backdrop="static" data-keyboard="false"><i class="material-icons">open_in_new</i></a> &nbsp;'+
                      '<a href="#" data-value="'+data[i].id+'" class="btn btn-danger btn-circle waves-effect waves-circle waves-float hapus" data-toggle="modal" data-target="#modaldelete" id="btnHapus" data-backdrop="static" data-keyboard="false"><i class="material-icons">delete_forever</i></a>'+
                      '</td>')
                 $n++;
              }else{
                $("<tr style='background-color:#FFB6C1'>").appendTo($("#itemList"))      // Create new row, append it to the table's html.
                 .append('<td>' + $n + '</td>')
                 .append('<td class="details-control-child" value="'+data[i].id+'">'+data[i].nama_menu+'</td>')
                 .append('<td>'+data[i].url+'</td>')
                 .append('<td><span class="badge bg-orange" style="color:white">'+$parent+'</span></td>')
                 .append('<td><span class="badge bg-red">'+$statusChild+'</span></td>')
                 .append('<td>'+
                      '<a href="#" data-value="'+data[i].id+'" class="btn btn-success btn-circle waves-effect waves-circle waves-float edit" data-toggle="modal" data-target="#modaledit" id="btnUbah" data-backdrop="static" data-keyboard="false"><i class="material-icons">open_in_new</i></a> &nbsp;'+
                      '<a href="#" data-value="'+data[i].id+'"  style="color:white" class="btn bg-blue-grey btn-circle waves-effect waves-circle waves-float aktifkan" data-toggle="modal" data-target="#modalaktifkan" id="btnmodalAktifkan" data-backdrop="static" data-keyboard="false"><i class="material-icons">thumb_down</i></a>'+
                      '</td>')
                 $n++;
              }
            }
          }
        }
    });

    return '<table class="table table-striped table-bordered table-hover" style="width:100%" id="itemList">'+
        '<tr>'+
            '<td><b>No</b></td>'+
            '<td><b>Nama Menu</b></td>'+
            '<td><b>Url Menu</b></td>'+
            '<td><b>Child</b></td>'+
            '<td><b>Status</b></td>'+
            '<td><b>Aksi</b></td>'+
        '</tr>'+
    '</table>';

  }

  $("#tabelinfo").on("click", "a.hapus", function(){
    var a = $(this).data('value');
    var b = "hapus";
    $('#setYaHapus').attr('href', '{{url('admin/delete-menu/')}}/'+a+'/'+b);
  });

  $("#tabelinfo").on("click", "a.aktifkan", function(){
    var a = $(this).data('value');
    var b = "aktifkan";
    $('#setYaAktifkan').attr('href', '{{url('admin/delete-menu/')}}/'+a+'/'+b);
  });

  $("#tabelinfo").on("click", "a.edit", function(){
    var a = $(this).data('value');
    $.ajax({
      url: "{{url('/')}}/admin/bind-menu/"+a,
      dataType: 'json',
      success: function(data){
        var id = data.id;
        var nama_menu = data.nama_menu;
        var icon = data.icon;
        var url = data.url;

        $("#parentIdEdit").val(0).trigger("change");
        $('#id').attr('value', id);
        $('#namaMenuEdit').val(nama_menu);
        $('#iconEdit').val(icon);
        $('#urlMenuEdit').val(url)
        $("#parentIdEdit").val(data.id_parent).trigger("change");


        if(data.id_parent == "0") {
          $("#statusMenuEdit").val(0).trigger("change");
          $("#divParentEdit").prop('hidden', true);
        } else {
          $("#statusMenuEdit").val(1).trigger("change");
          $("#divParentEdit").prop('hidden', false);
        }

      }
    })

    $.ajax({
        url: "{{url('/')}}/admin/get-role-checked/"+a,
        dataType: 'json',
        success: function(json){
          console.log(json);
          $tempId = '';
          for (var i = 0; i < json.length; i++) {
            var checks = document.getElementsByName("idroleEdit[]");
            for (var j=0; j < checks.length; j++) {
                if ($(checks[j]).val() == json[i]['role_id']) {
                  checks[j].checked = true;
                  break;
                }
            }
          }
        }

    });

  });

</script>
@endsection
