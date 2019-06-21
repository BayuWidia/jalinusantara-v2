<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
              @if(Auth::user())
                @if(Auth::user()->url_foto=="")
                  <img src="{{asset('images/user/default.png')}}" alt="image" width="48" height="48">
                @else
                  <img src="{{ url('images/user/') }}/{{Auth::user()->url_foto}}" alt="image" width="48" height="48">
                @endif
              @endif
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(Auth::user())
                      <b style="color:#136433">{{ Auth::user()->name }}</b>
                    @endif
                </div>
                <div class="email">
                    @if(Auth::user())
                      <b style="color:#136433">{{ Auth::user()->email }}</b>
                    @endif
                </div>
                <div class="btn-group user-helper-dropdown">
                    <i style="color:#136433" class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="{{ route('user.profile') }}"><i class="material-icons">person</i>Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">input</i>
                          Sign Out</a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                          </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li>
                    <a href="{{ route('backend.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Home</span>
                    </a>
                </li>
                <?php
                $menuChildParent = \App\Models\Menu::menusParent();
                foreach ($menuChildParent as $key) {
                  getMenuChild($key->id);
                }
                function getMenuChild($parent=0){
                  $menuChild = \App\Models\Menu::menusChild($parent);
                  $getDataParent = \App\Models\Menu::getDataMenusById($parent);

                ?>
                <li>
                    @if(sizeof($menuChild)>0)
                      <a href="javascript:void(0);" class="menu-toggle">
                    @else
                        <?php
                          echo '<li><a href="'.url('/'.$getDataParent[0]->url).'">';
                        ?>
                    @endif
                        <i class="material-icons">{{$getDataParent[0]->icon}}</i>
                        <span><b>{{$getDataParent[0]->nama_menu}}</b></span>
                    </a>
                    @if(sizeof($menuChild)>0)
                    <ul class="ml-menu">
                      <?php
                      foreach ($menuChild as $key) {
                        getMenuChild($key->id);
                      }
                      ?>
                    </ul>
                    @endif
                  </li>
                <?php } ?>
                <li class="header">DEVELOPER</li>
                <li>
                    <a href="{{ route('log.activity') }}">
                        <i class="material-icons">code</i>
                        <span>Log Activity</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('log.files') }}">
                        <i class="material-icons">attach_file</i>
                        <span>Log Files</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- #Menu -->
        <!-- Footer-->
        <div class="legal">
            <div class="copyright">
                <b>Jalinusantara</b> &copy; <?php echo date('Y'); ?>
            </div>
        </div>
      <!--  #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>
