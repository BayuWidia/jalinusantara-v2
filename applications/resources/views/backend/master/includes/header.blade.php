<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="index.html">ADMINBSB - MATERIAL DESIGN</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Call Search -->
                <!-- <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                #END# Call Search -->
                <!-- Notifications -->

                <?php
                $getCountComment = \App\Models\MasterComment::where('flag_tanggapan','=' ,0)->count();
                $getComment = \App\Models\MasterComment::where('flag_tanggapan','=' ,0)->get();

                $getCountContact = \App\Models\MasterPesan::where('flag_pesan','=' ,0)->count();
                $getContact = \App\Models\MasterPesan::where('flag_pesan','=' ,0)->get();

                $getCountRegistrasi = \App\Models\RegistrasiEvents::where('flag_approve','=' ,0)->count();
                $getRegistrasi = \App\Models\RegistrasiEvents::where('flag_approve','=' ,0)->get();
                ?>

                <!-- #START# REGISTRASI -->
                <!-- <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="material-icons">perm_contact_calendar</i>

                        <span class="label-count">{{$getCountRegistrasi}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">REGISTRASI</li>
                        <li class="body">
                            <ul class="menu">
                                @foreach($getRegistrasi as $key)
                                  <li>
                                      <a href="javascript:void(0);">
                                          <div class="icon-circle bg-purple">
                                              <i class="material-icons">perm_contact_calendar</i>
                                          </div>
                                          <div class="menu-info">
                                              <h4><b>{{$key->no_registrasi}}</b> - {{$key->nama_driver}}</h4>
                                              <p>
                                                  <i class="material-icons">access_time</i> {{ \Carbon\Carbon::parse($key->created_at)->diffForHumans()}}
                                              </p>
                                          </div>
                                      </a>
                                  </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="{{route ('registrasi.index')}}">View All Registrasi</a>
                        </li>
                    </ul>
                </li> -->
                <!-- #END# REGISTRASI -->

                <!-- #START# COMMENT -->
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="material-icons">add_alert</i>

                        <span class="label-count">{{$getCountComment}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">NOTIFICATIONS</li>
                        <li class="body">
                            <ul class="menu">
                                @foreach($getComment as $key)
                                  <li>
                                      <a href="javascript:void(0);">
                                          <div class="icon-circle bg-purple">
                                              <i class="material-icons">add_alert</i>
                                          </div>
                                          <div class="menu-info">
                                              <h4><b>{{$key->nama}}</b> - {{$key->subject}}</h4>
                                              <p>
                                                  <i class="material-icons">access_time</i> {{ \Carbon\Carbon::parse($key->created_at)->diffForHumans()}}
                                              </p>
                                          </div>
                                      </a>
                                  </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="{{route ('comment.index')}}">View All Notifications</a>
                        </li>
                    </ul>
                </li>
                <!-- #END# COMMENT -->

                <!-- #START# CONTACT -->
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="material-icons">comment</i>
                        <span class="label-count">{{$getCountContact}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">MESSAGE</li>
                        <li class="body">
                            <ul class="menu">
                                @foreach($getContact as $key)
                                  <li>
                                      <a href="javascript:void(0);">
                                          <div class="icon-circle bg-orange">
                                              <i class="material-icons">comment</i>
                                          </div>
                                          <div class="menu-info">
                                              <h4><b>{{$key->nama}}</b> - {{$key->subject}}</h4>
                                              <p>
                                                  <i class="material-icons">access_time</i> {{ \Carbon\Carbon::parse($key->created_at)->diffForHumans()}}
                                              </p>
                                          </div>
                                      </a>
                                  </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="{{route ('contact.index')}}">View All Messages</a>
                        </li>
                    </ul>
                </li>
                <!-- #END# CONTACT -->
            </ul>
        </div>
    </div>
</nav>
<!-- #Top Bar -->
