{{-- google translate --}}
<script type="text/javascript">
	function googleTranslateElementInit() {
		new google.translate.TranslateElement({pageLanguage: 'id'}, 'google_translate_element');
	}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
{{-- google translate --}}

<!-- Header Area Start -->
<header class="header-area">
		<div class="row" style="background-color:#9E46B0;height:30px">
			<div class="col-lg-12" style="text-align:center;color:white;margin-top:0.2%">
				<b>RESPECTING THE ENVIRONMENT, MUTUAL COOPERATION AND SPORTSMANSHIP</b>
			</div>
		</div>
    <div class="classy-nav-container breakpoint-off">
        <div class="container">
            <!-- Classy Menu -->
            <nav class="classy-navbar justify-content-between" id="conferNav">

                <!-- Logo -->
                <a class="nav-brand" href="{{ route('home') }}"><img style="width:110px;height:70px" src="{{asset('themeuser/img/core-img/logo.png')}}" alt=""></a>

                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>

                <!-- Menu -->
                <div class="classy-menu">
                    <!-- Menu Close Button -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Nav Start -->
										<?php
											$getMenuAbout = \App\Models\Informasi::join('master_kategori', 'informasi.id_kategori', '=', 'master_kategori.id')
												->select(DB::raw('distinct(master_kategori.nama_kategori)'), 'informasi.id')
												->where('informasi.flag_status', '=', 'profile')->where('informasi.activated', '=', '1')
												->orderby('nama_kategori','asc')->get();

											$getMenuArticle = \App\Models\MasterKategori::select('*')
												->where('master_kategori.flag_utama', '=', 'article')->where('master_kategori.activated', '=', '1')
												->orderby('nama_kategori','asc')->get();

											$getMenuEvents = \App\Models\MasterKategori::select('*')
												->where('master_kategori.flag_utama', '=', 'events')->where('master_kategori.activated', '=', '1')
												->orderby('nama_kategori','asc')->get();

											// $getMenuEvents = \App\Models\Events::join('master_kategori', 'events.id_kategori', '=', 'master_kategori.id')
											// 	->select(DB::raw('distinct(master_kategori.nama_kategori)'), 'master_kategori.id')
											// 	->where('master_kategori.activated', '=', '1')->orderby('nama_kategori','asc')->get();

											$getMenuGallery = \App\Models\Events::select('events.*')
												->where('events.flag_publish', '=', '1')->get();
										?>
                    <div class="classynav">
                        <ul id="nav">
                            <li><a href="{{ route('home') }}">Home</a></li>
														<li><a href="#">Events</a>
                                <ul class="dropdown" style="width:200px;">
																		@foreach($getMenuEvents as $key)
																			<li><a href="{{ route('events', $key->id) }}">{{$key->nama_kategori}}</a></li>
																		@endforeach
																		<!-- <li><a href="{{ route('events.today') }}">Event Today</a></li> -->
                                </ul>
                            </li>
														<li><a href="#">News</a>
                                <ul class="dropdown" style="width:200px;">
																		@foreach($getMenuArticle as $key)
																			<li><a href="{{ route('article', $key->id) }}">{{$key->nama_kategori}}</a></li>
																		@endforeach
                                </ul>
                            </li>
														<li><a href="{{ route('about.us', $getMenuAbout[0]->id) }}">About Us</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
														<li><a href="{{ route('partners') }}">Partners</a>
	                          </li>
														<li><a href="#">Media</a>
	                              <ul class="dropdown" style="width:200px;">
	                                  <li><a href="{{ route('galeri.photo') }}">Photo</a></li>
																		<li><a href="{{ route('galeri.video') }}">Video</a></li>
	                              </ul>
	                          </li>
                        </ul>
                      </div>
                    <!-- Nav End -->
                </div>
            </nav>
        </div>
		</div>
		<?php
		$getProduct = \App\Models\MasterProduct::select('master_product.*')
									->where('flag_product', 1)
									->orderby(DB::raw('rand()'))
									->get();
		 ?>
		<div class="row" style="background-color:white;height:90px" id="divProduct">
			<div class="col-lg-1">
			</div>
			<div class="col-lg-9">
				<marquee>
						@foreach($getProduct as $key)
							<img src="{{url('images/product/asli')}}/{{$key->url_product}}" alt="">&nbsp;&nbsp;&nbsp;
						@endforeach
				</marquee>
			</div>
			<div class="col-lg-2" style="margin-top:1.5%">
				<div id="google_translate_element" style="float:left;"></div>
			</div>

		</div>
</header>
<!-- Header Area End -->
<script type="text/javascript">
	window.onscroll = function() {scrollFunction()};

	function scrollFunction() {
		if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
				// document.getElementById("divProduct").style.display = "none";
				$("#divProduct").fadeOut(1600);
		} else {
			// document.getElementById("divProduct").style.display = "block";
			$("#divProduct").show();
			// $("#divProduct").show();
		}
	}

	function topFunc() {
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
	}
</script>
