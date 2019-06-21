@extends('backend.master.layouts.master')

@section('title')
    <title>Jalinusantara</title>
@endsection

@section('content')
<div class="container-fluid">
  <div class="block-header">
      <h2>FORM KELOLA USERS</h2>
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
    <div class="panel-group" id="accordion_4">
        <div class="panel panel-warning">
            <div class="panel-heading" role="tab" id="headingOne_4">
                <h4 class="panel-title">
                    <a role="button">
                      Silahkan cari data user sesuai dengan pencarian anda...
                    </a>
                </h4>
            </div>
            <div id="collapseOne_4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_4">
                <div class="panel-body">
                  <form class="form-horizontal" action="{{ route('user.search') }}"  method="get">
                      <div class="input-group">
                          <input type="text" placeholder="Ketikkan Username atau Fullname..." name="search" class="form-control input-lg">
                          <div class="input-group-btn">
                              <button class="btn btn-xs btn-warning" type="submit">
                                  <i class="material-icons">search</i>
                              </button>
                          </div>&nbsp;
                          <div class="input-group-btn">
                               <a href="" class="btn btn-xs btn-primary edit" data-toggle="modal"
                                 data-target="#modalInsert" data-value="" data-backdrop="static" data-keyboard="false"
                                 style="color:white"><i class="material-icons">playlist_add</i></a>
                          </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
     </div>
  </div>
  <div class="row clearfix">
      @foreach($getDataUser as $key)
         <div class="col-xs-12 col-sm-4">
             <div class="card profile-card">
                 <div class="profile-header">&nbsp;</div>
                 <div class="profile-body">
                     <div class="image-area">
                         @if($key->url_foto!="")
                           <img alt="image" src="{{url('images/user/')}}/{{$key->url_foto}}">
                         @else
                           <img alt="image" src="{{asset('images/user/default.png')}}">
                         @endif
                     </div>
                     <div class="content-area">
                         <h3>{{$key->name}}</h3>
                         <p>{{$key->email}}</p>
                         <p>{{$key->nama_role}}</p>
                     </div>
                 </div>
                 <div class="profile-footer">
                     <ul>
                         <li>
                             <span>Full Name</span>
                             <span>{{$key->fullname}}</span>
                         </li>
                         <li>
                             <span>Status</span>
                               @if ($key->activated =="1")
                               <span class="badge bg-green">Active</span>
                               @elseif ($key->activated =="0")
                               <span class="badge bg-red">Non Active</span>
                               @endif
                         </li>
                         <li>
                             <span>Login Count</span>
                             <span class="badge bg-orange">{{$key->login_count}}</span>
                         </li>
                     </ul>
                     <hr>
                     <a href="" class="btn btn-xs btn-success edit" data-toggle="modal"
                       data-target="#modalUpdate" data-value="{{$key->id}}" data-backdrop="static" data-keyboard="false"
                       style="color:white"><i class="material-icons">open_in_new</i></a>
                     @if ($key->activated=="1")
                       <a href="" class="btn btn-xs btn-danger hapus" data-toggle="modal"
                         data-target="#modalDelete" data-value="{{$key->id}}" data-backdrop="static" data-keyboard="false"
                         style="color:white"><i class="material-icons">delete_forever</i></a>
                     @elseif ($key->activated=="0")
                       <a href="" class="btn btn-xs bg-blue-grey aktifkan" data-toggle="modal"
                         data-target="#modalAktifkan" data-value="{{$key->id}}" data-backdrop="static" data-keyboard="false"
                         style="color:white"><i class="material-icons">thumb_down</i></a>
                     @endif
                     <a href="" class="btn btn-xs btn-primary editPassword" data-toggle="modal"
                       data-target="#modalUpPassword" data-value="{{$key->id}}" data-backdrop="static" data-keyboard="false"
                       style="color:white"><i class="material-icons">vpn_key</i></a>
                 </div>
             </div>
         </div>
      @endforeach
    </div>
</div>


 <!-- Modal Insert-->
 <div class="modal fade" id="modalInsert" tabindex="-1" role="dialog">
     <div class="modal-dialog" role="document">
         <div class="modal-content bounceInRight">
               <div class="modal-header">
                   <h4 class="modal-title">Tambah Konten Sponsor</h4>
               </div>
               <div class="modal-body">
                   <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
                     {{csrf_field()}}
                     <div class="row clearfix">
                         <div class="col-sm-12">
                             <div class="form-group mandatory">
                                 <div class="form-line">
                                     <label>Role</label>
                                     @if ($errors->has('roleId'))
                                       <small style="color:red">* {{$errors->first('roleId')}}</small>
                                     @endif
                                     <select name="roleId" class="form-control" style="width: 100%;">
                                       <option value="">-- Pilih --</option>
                                       @foreach($getDataRole as $key)
                                         <option value="{{ $key->id }}" {{ old('roleId') == $key->id ? 'selected=""' : ''}}>{{ $key->nama_role }}</option>
                                       @endforeach
                                     </select>
                                 </div>
                             </div>
                             <div class="form-group mandatory">
                                 <div class="form-line">
                                     <label>Username</label>
                                     @if ($errors->has('username'))
                                       <small style="color:red">* {{$errors->first('username')}}</small>
                                     @endif
                                     <input type="text" value="{{ old('username') }}" class="form-control" placeholder="Ketikkan Username..." name="username" id="username"/>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <div class="form-line">
                                     <label>Fullname</label>
                                     @if ($errors->has('fullname'))
                                       <small style="color:red">* {{$errors->first('fullname')}}</small>
                                     @endif
                                     <input type="text" value="{{ old('fullname') }}" class="form-control" placeholder="Ketikkan Fullname..." name="fullname" id="fullname"/>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <div class="form-line">
                                     <label>Email</label>
                                     @if ($errors->has('email'))
                                       <small style="color:red">* {{$errors->first('email')}}</small>
                                     @endif
                                     <input type="email" value="{{ old('email') }}" class="form-control" placeholder="Ketikkan Email..." name="email" id="email"/>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <div class="form-line">
                                     <label>Password</label>
                                     @if ($errors->has('password'))
                                       <small style="color:red">* {{$errors->first('password')}}</small>
                                     @endif
                                     <input type="password" value="{{ old('password') }}" class="form-control" placeholder="Ketikkan Password..." name="password" id="password"/>
                                 </div>
                             </div>
                             <div class="form-group mandatory">
                                 <div class="form-line">
                                     <label>Photo</label>
                                     @if ($errors->has('urlPhoto'))
                                       <small style="color:red">* {{$errors->first('urlPhoto')}}</small>
                                     @endif
                                     <input type="file" name="urlPhoto" class="form-control" value="{{ old('urlPhoto') }}" >
                                 </div>
                                 <div>
                                   <span class="text-muted"><i>* Max Size: 2MB.</i></span><br>
                                   <span class="text-muted"><i>* Rekomendasi ukuran terbaik: 126 x 128 px.</i></span>
                                 </div>
                             </div>
                             <div class="form-group mandatory">
                                 <div class="form-line">
                                     <label>Status</label>
                                     <select class="form-control" name="activated" id="activated">
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
 <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog">
     <div class="modal-dialog" role="document">
         <div class="modal-content bounceInRight">
               <div class="modal-header">
                   <h4 class="modal-title">Ubah Konten User</h4>
               </div>
               <div class="modal-body">
                   <form action="{{route('user.update')}}" method="post" enctype="multipart/form-data">
                     {{csrf_field()}}
                     <div class="row clearfix">
                         <div class="col-sm-12">
                             <div class="form-group mandatory">
                                 <div class="form-line">
                                     <label>Role</label>
                                     @if ($errors->has('roleId_edit'))
                                       <small style="color:red">* {{$errors->first('roleId_edit')}}</small>
                                     @endif
                                     <select name="roleId_edit" id="roleId_edit" class="form-control" style="width: 100%;">
                                       <option value="">-- Pilih --</option>
                                       @foreach($getDataRole as $key)
                                         <option value="{{ $key->id }}" {{ old('roleId_edit') == $key->id ? 'selected=""' : ''}}>{{ $key->nama_role }}</option>
                                       @endforeach
                                     </select>
                                 </div>
                             </div>
                             <div class="form-group mandatory">
                                 <div class="form-line">
                                     <label>Username</label>
                                     @if ($errors->has('username_edit'))
                                       <small style="color:red">* {{$errors->first('username_edit')}}</small>
                                     @endif
                                     <input type="text" value="{{ old('username_edit') }}" class="form-control" placeholder="Ketikkan Username..." name="username_edit" id="username_edit"/>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <div class="form-line">
                                     <label>Fullname</label>
                                     @if ($errors->has('fullname_edit'))
                                       <small style="color:red">* {{$errors->first('fullname_edit')}}</small>
                                     @endif
                                     <input type="text" value="{{ old('fullname_edit') }}" class="form-control" placeholder="Ketikkan Fullname..." name="fullname_edit" id="fullname_edit"/>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <div class="form-line">
                                     <label>Email</label>
                                     @if ($errors->has('email_edit'))
                                       <small style="color:red">* {{$errors->first('email_edit')}}</small>
                                     @endif
                                     <input type="email" value="{{ old('email_edit') }}" class="form-control" placeholder="Ketikkan Email..." name="email_edit" id="email_edit"/>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <div class="form-line">
                                     <label>Photo</label>
                                     @if ($errors->has('urlPhoto_edit'))
                                       <small style="color:red">* {{$errors->first('urlPhoto_edit')}}</small>
                                     @endif
                                     <input type="file" name="urlPhoto_edit" class="form-control" value="{{ old('urlPhoto_edit') }}" >
                                     <input type="hidden" name="id" id="id">
                                     <span style="color:red;">* Biarkan kosong jika tidak ingin diganti.</span>
                                 </div>
                                 <div>
                                   <span class="text-muted"><i>* Max Size: 2MB.</i></span><br>
                                   <span class="text-muted"><i>* Rekomendasi ukuran terbaik: 126 x 128 px.</i></span>
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

 <!-- Modal Password-->
 <div class="modal fade" id="modalUpPassword" tabindex="-1" role="dialog">
     <div class="modal-dialog" role="document">
         <div class="modal-content bounceInRight">
               <div class="modal-header">
                   <h4 class="modal-title">Ubah Konten Password</h4>
               </div>
               <div class="modal-body">
                   <form action="{{route('user.update.password')}}" method="post" enctype="multipart/form-data">
                     {{csrf_field()}}
                     <div class="row clearfix">
                         <div class="col-sm-12">
                             <div class="form-group">
                                 <div class="form-line">
                                     <label>Role</label>
                                     <select name="roleId_pass" id="roleId_pass" class="form-control" style="width: 100%;" disabled>
                                       <option value="">-- Pilih --</option>
                                       @foreach($getDataRole as $key)
                                         <option value="{{ $key->id }}" {{ old('roleId_pass') == $key->id ? 'selected=""' : ''}}>{{ $key->nama_role }}</option>
                                       @endforeach
                                     </select>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <div class="form-line">
                                     <label>Username</label>
                                     <input type="text" value="{{ old('username_pass') }}" disabled class="form-control" placeholder="Ketikkan Username..." name="username_pass" id="username_pass"/>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <div class="form-line">
                                     <label>Fullname</label>
                                     <input type="hidden" name="id_pass" id="id_pass">
                                     <input type="text" value="{{ old('fullname_pass') }}" disabled class="form-control" placeholder="Ketikkan Fullname..." name="fullname_pass" id="fullname_pass"/>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <div class="form-line">
                                     <label>Email</label>
                                     <input type="email" value="{{ old('email_pass') }}" disabled class="form-control" placeholder="Ketikkan Email..." name="email_pass" id="email_pass"/>
                                 </div>
                             </div>
                             <div class="form-group mandatory">
                                 <div class="form-line">
                                     <label>Password</label>
                                     @if ($errors->has('passwordPass'))
                                       <small style="color:red">* {{$errors->first('passwordPass')}}</small>
                                     @endif
                                     <input type="password" value="" class="form-control" placeholder="Ketikkan Password..." name="passwordPass" id="passwordPass"/>
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
 <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
     <div class="modal-dialog" role="document">
         <div class="modal-content bounceInRight">
               <div class="modal-header">
                   <h4 class="modal-title">Non Aktifkan Data User</h4>
               </div>
               <div class="modal-body">
                   <p>Apakah anda yakin untuk mengnonaktifkan data user ini?</p>
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
               <h4 class="modal-title">Aktifkan Data User</h4>
           </div>
           <div class="modal-body">
               <p>Apakah anda yakin untuk mengaktifkan data user ini?</p>
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-white" data-dismiss="modal"  onclick="resetPage()">Tidak</button>
               <a href="" class="btn btn-primary" id="setYaAktifkan">Ya, saya yakin</a>
           </div>
       </div>
   </div>
 </div>

@endsection

@section('footscript')
<script src="{{asset('theme/js/pages/examples/profile.js')}}"></script>
<script>
  @if ($errors->has('roleId') || $errors->has('storeId')
        || $errors->has('username') || $errors->has('fullName')
        || $errors->has('email') || $errors->has('password'))
    $('#modalInsert').modal('show');
  @endif

  @if ($errors->has('roleId_edit') || $errors->has('storeId_edit')
        || $errors->has('username_edit') || $errors->has('fullname_edit')
        || $errors->has('email_edit'))
    $('#modalUpdate').modal('show');
  @endif

  @if ($errors->has('passwordPass'))
    $('#modalUpPassword').modal('show');
  @endif

  $('a.hapus').click(function(){
    var a = $(this).data('value');
    var b = "hapus";
      $('#setYaHapus').attr('href', "{{ url('/') }}/admin/delete-user/"+a+'/'+b);
  });

  $('a.aktifkan').click(function(){
   var a = $(this).data('value');
   var b = "aktifkan";
     $('#setYaAktifkan').attr('href', "{{ url('/') }}/admin/delete-user/"+a+'/'+b);
  });

  $(document).ready(function() {
      $('#tabelinfo').DataTable({
      });
  });

  $('a.edit').click(function(){
      var a = $(this).data('value');
      $.ajax({
        url: "{{url('/')}}/admin/bind-user/"+a,
        success: function(data){
          var id = data.id;
          var roleId = data.id_role;
          var username = data.name;
          var fullname = data.fullname;
          var email = data.email;
          //set
          $("#roleId_edit").val(0).trigger("change");
          $('#id').attr('value', id);
          $('#username_edit').attr('value', username);
          $('#fullname_edit').attr('value', fullname);
          $('#email_edit').attr('value', email);
          $("#roleId_edit").val(roleId).trigger("change");
        }
      });
    });

    $('a.editPassword').click(function(){
      var a = $(this).data('value');
      $.ajax({
        url: "{{url('/')}}/admin/bind-user/"+a,
        success: function(data){
          var id_pass = data.id;
          var roleId = data.id_role;
          var username = data.name;
          var fullname = data.fullname;
          var email = data.email;
          //set
          $("#roleId_pass").val(roleId).trigger("change");
          $('#id_pass').attr('value', id_pass);
          $('#username_pass').attr('value', username);
          $('#fullname_pass').attr('value', fullname);
          $('#email_pass').attr('value', email);
          $("#roleId_pass").val(roleId).trigger("change");
        }
      });
    });

</script>
@endsection
