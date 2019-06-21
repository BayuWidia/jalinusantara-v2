@extends('backend.master.layouts.master')

@section('title')
    <title>Jalinusantara</title>
@endsection

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>FORM PROFILE</h2>
    </div>
    <div class="row clearfix">
      <div class="col-xs-12 col-sm-4">
            <div class="card profile-card">
                <div class="profile-header">&nbsp;</div>
                <div class="profile-body">
                    <div class="image-area">
                        @if($getDataUserById->url_photo!="")
                          <img src="{{url('images/user')}}/{{$getDataUserById->url_photo}}">
                        @else
                          <img alt="image" src="{{asset('images/user/default.png')}}">
                        @endif
                    </div>
                    <div class="content-area">
                        <h3>{{$getDataUserById->name}}</h3>
                        <p>{{$getDataUserById->email}}</p>
                        <p>{{$getDataUserById->nama_role}}</p>
                    </div>
                </div>
                <div class="profile-footer">
                    <ul>
                        <li>
                            <span>Full Name</span>
                            <span>{{$getDataUserById->fullname}}</span>
                        </li>
                        <li>
                            <span>Status</span>
                              @if ($getDataUserById->activated =="1")
                              <span class="badge bg-green">Active</span>
                              @elseif ($getDataUserById->activated =="0")
                              <span class="badge bg-red">Non Active</span>
                              @endif
                        </li>
                        <li>
                            <span>Login Count</span>
                            <span class="badge bg-orange">{{$getDataUserById->login_count}}</span>
                        </li>
                        <li>
                            <span>Jumlah Article</span>
                            <span class="badge bg-blue">{{$getCountInformasi}}</span>
                        </li>
                        <li>
                            <span>Jumlah Events</span>
                            <span class="badge bg-red">{{$getCountEvents}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-8">
            <div class="card">
                <div class="body">
                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                              <li role="presentation" class="active"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Profile Settings</a></li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="profile_settings">
                                <form class="form-horizontal" action="{{route ('user.profile.password') }}" method="post">
                                    <div class="form-group mandatory">
                                        <label for="username" class="col-sm-3 control-label">Username</label>
                                        @if ($errors->has('username'))
                                          <small style="color:red">* {{$errors->first('username')}}</small>
                                        @endif
                                        <div class="col-sm-9">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="username" name="username" placeholder="Ketikkan Username..." value="{{$getDataUserById->name}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mandatory">
                                        <label for="fullname" class="col-sm-3 control-label">Fullname</label>
                                        @if ($errors->has('fullname'))
                                          <small style="color:red">* {{$errors->first('fullname')}}</small>
                                        @endif
                                        <div class="col-sm-9">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Ketikkan Fullname..." value="{{$getDataUserById->fullname}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="oldpassword" class="col-sm-3 control-label">Password Lama</label>
                                        @if ($errors->has('oldpassword'))
                                          <small style="color:red">* {{$errors->first('oldpassword')}}</small>
                                        @endif
                                        <div class="col-sm-9">
                                            <div class="form-line">
                                                <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Ketikkan Password Lama..." required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-3 control-label">Password Baru</label>
                                        @if ($errors->has('password'))
                                          <small style="color:red">* {{$errors->first('password')}}</small>
                                        @endif
                                        <div class="col-sm-9">
                                            <div class="form-line">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Ketikkan Password..." required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation" class="col-sm-3 control-label">Konfirmasi Password Baru</label>
                                        @if ($errors->has('password_confirmation'))
                                          <small style="color:red">* {{$errors->first('password_confirmation')}}</small>
                                        @endif
                                        <div class="col-sm-9">
                                            <div class="form-line">
                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ketikkan Konfirmasi Password Baru..." required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="submit" class="btn btn-primary">Simpan Data Perubahan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footscript')
<script src="{{asset('theme/js/pages/examples/profile.js')}}"></script>
<script>
  $(document).ready(function() {
      $('#tabelinfo').DataTable({
      });
  });
</script>
@endsection
