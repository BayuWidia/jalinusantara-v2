<!-- Footer Area Start -->
<footer class="footer-area bg-img bg-overlay-2 section-padding-100-0">
    <!-- Main Footer Area -->
    <div class="main-footer-area">
        <div class="container">
            <div class="row">
                <!-- Single Footer Widget Area -->
                <div class="col-12 col-sm-6 col-lg-6">
                    <div class="single-footer-widget mb-60 wow fadeInUp" data-wow-delay="300ms">
                        <!-- Footer Logo -->
                        <a href="#" class="footer-logo"><img src="{{asset('themeuser/img/core-img/logo.png')}}" alt=""></a>
                        <p style="text-transform: capitalize">“There is nothing more time-consuming than worries, and people who profess to believe
													in God should be ashamed when they are worried about something.” ~MAHATMA GANDHI~</p>

                        <!-- Social Info -->
                        <div class="social-info">
													<?php
														$getMedsos = \App\Models\MasterMedsos::all();
													?>
													@foreach($getMedsos as $key)
															<a href="http://{{$key->link_sosmed}}" target="_blank">
																@if($key->nama_sosmed == 'instagram')
																	<i style="margin-top:20%" class="zmdi zmdi-instagram"></i>
                                @elseif($key->nama_sosmed == 'facebook')
																	<i style="margin-top:20%" class="zmdi zmdi-facebook"></i>
																@elseif($key->nama_sosmed == 'twitter')
																	<i style="margin-top:20%" class="zmdi zmdi-twitter"></i>
																@elseif($key->nama_sosmed == 'youtube')
																	<i style="margin-top:20%" class="zmdi zmdi-youtube"></i>
																@elseif($key->nama_sosmed == 'google-plus')
																	<i style="margin-top:20%" class="zmdi zmdi-google-plus"></i>
																@elseif($key->nama_sosmed == 'linkedin')
																	<i style="margin-top:20%" class="zmdi zmdi-linkedin"></i>
																@endif
															</a>
													@endforeach
                        </div>
                    </div>
                </div>

                <!-- Single Footer Widget Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-footer-widget mb-60 wow fadeInUp" data-wow-delay="300ms">
                        <!-- Widget Title -->
                        <h5 class="widget-title">Contact</h5>

                        <!-- Contact Area -->
                        <div class="footer-contact-info">
                            <p><i class="zmdi zmdi-map"></i> Jl. GADING KIRANA TIMUR. <br>Blok H13. No. 31<br>JAKARTA 14240. INDONESIA</p>
                            <p><i class="zmdi zmdi-phone"></i> +62 21 451 7337 (office)</p>
                            <p><i class="zmdi zmdi-phone"></i> +62 812 8778 7266</p>
                            <p><i class="zmdi zmdi-email"></i> office@jalinnusantara.com</p>
                            <p><i class="zmdi zmdi-email"></i> sandi@jalinnusantara.com</p>
                            <p><i class="zmdi zmdi-globe"></i> www.jalinnusantara.com</p>
                        </div>
                    </div>
                </div>

                <!-- Single Footer Widget Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-footer-widget mb-60 wow fadeInUp" data-wow-delay="300ms">
                        <!-- Widget Title -->
                        <h5 class="widget-title">Gallery</h5>
                        <?php
    											$getGallery = \App\Models\MasterGaleri::select('master_galeri.*')
    												->where('master_galeri.flag_gambar', '=', '1')->orderby(DB::raw('rand()'))->limit(9)->get();
    										?>

                        <!-- Footer Gallery -->
                        <div class="footer-gallery">
                            <div class="row">
                                @foreach($getGallery as $key)
                                  <div class="col-4">
                                      <a href="{{url('images/galeri')}}/{{$key->url_gambar}}" class="single-gallery-item">
                                        <img src="{{url('images/galeri')}}/{{$key->url_gambar}}" alt=""></a>
                                  </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Copywrite Area -->
    <div class="container">
        <div class="copywrite-content">
            <div class="row">
                <!-- Copywrite Text -->
                <div class="col-12 col-md-12">
                    <div class="copywrite-text">
											<p class="footer-text" style="text-align:center">www.jalinusantara.com ||
												Sebuah Website Untuk Para Pecinta Offroad
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->
