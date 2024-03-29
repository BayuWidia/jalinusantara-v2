@extends('frontend.master.layouts.master')

@section('banner')
<!-- Welcome Area Start -->
    <section class="welcome-area">
        <div class="welcome-slides owl-carousel">

            @foreach($getDataEventsHeadline as $key)
            <!-- Single Slide -->
            <div class="single-welcome-slide bg-img jarallax" style="background-image: url({{url('themeuser/img/bg-img/video-bg.jpg')}});">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <!-- Welcome Text -->
                        <div class="col-12">
                            <div class="welcome-text-two text-center">
                                <br><br>
                                <h5 data-animation="fadeInUp" data-delay="100ms">{{$key->judul_event}}</h5>
                                <h3 data-animation="fadeInUp" data-delay="300ms" style="color:white">{{$key->lokasi}}</h3>
                                <!-- Event Meta -->
                                <div class="event-meta" data-animation="fadeInUp" data-delay="500ms">
                                    <a class="event-date" href="#"><i class="zmdi zmdi-time"></i> {{ \Carbon\Carbon::parse($key->tanggal_mulai)->format('d M Y')}} - {{ \Carbon\Carbon::parse($key->tanggal_akhir)->format('d M Y')}}</a>
                                </div>
                                <div class="hero-btn-group" data-animation="fadeInUp" data-delay="700ms">
                                    <a href="{{url('eventsById')}}/{{$key->id}}/{{$key->id_kategori}}" class="btn confer-btn m-2">View more <i class="zmdi zmdi-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Scroll Icon -->
        <div class="icon-scroll" id="scrollDown"></div>
    </section>
    <!-- Welcome Area End -->
@endsection


@section('content')
<!-- About Us And Countdown Area Start -->
<section class="about-us-countdown-area section-padding-100-0" id="about" style="background-color:#031634">
    <div class="container">
        <div class="row align-items-center">
            <!-- About Content -->

            <!-- About Thumb -->
            <div class="col-12 col-md-12">
                <div class="about-thumb mb-80 wow fadeInUp" data-wow-delay="300ms">
                    <img src="{{asset('themeuser/img/core-img/jalin2.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Us And Countdown Area End -->

<!-- About Us And Countdown Area Start -->
<section class="about-us-countdown-area section-padding-100-0" id="about">
    <div class="container">
        <div class="row align-items-center">
            <!-- About Content -->
            <div class="col-12 col-md-6">
                <div class="about-content-text mb-80">
                    <h6 class="wow fadeInUp" data-wow-delay="300ms">{{$getDataSejarah[0]->judul_informasi}}</h6>
                    <p class="wow fadeInUp" data-wow-delay="300ms">
                      <?php $isiInformasi = explode(" ", $getDataSejarah[0]->isi_informasi); ?>
                      @if(count($isiInformasi)<=35)
                        <span style="color:black"><?php echo $getDataSejarah[0]->isi_informasi ?></span>
                      @else
                        @for($i=0; $i < 35; $i++)
                          <?php echo $isiInformasi[$i] ?>
                        @endfor
                        [.....]
                      @endif
                    </p>
                    <a href="{{ route('about.us', $getDataSejarah[0]->id) }}" class="btn confer-btn mt-50 wow fadeInUp" data-wow-delay="300ms">Interested <i class="zmdi zmdi-long-arrow-right"></i></a>
                </div>
            </div>

            <!-- About Thumb -->
            <div class="col-12 col-md-6">
                <div class="about-thumb mb-80 wow fadeInUp" data-wow-delay="300ms">
                    <img style="border:8px solid white;" src="{{asset('themeuser/img/bg-img/sejarah.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Us And Countdown Area End -->


<!-- Our Ticket Pricing Table Area Start -->
<!-- <section class="our-ticket-pricing-table-area bg-img bg-gradient-overlay section-padding-100-0 jarallax" style="background-image: url({{url('themeuser/img/bg-img/home4.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center wow fadeInUp" data-wow-delay="300ms">
                    <p>Product</p>
                    <h4>OFFICIAL PRODUCT</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="our-sponsor-area d-flex flex-wrap">
                    @foreach($getProduct as $key)
                    <div class="single-sponsor wow fadeInUp" data-wow-delay="300ms">
                        @if (strpos($key->link_product, 'http') !== false)
                          <a href="{{$key->link_product}}" target="_blank"><img src="{{url('images/product/asli')}}/{{$key->url_product}}" alt=""></a>
                        @else
                          <a href="http://{{$key->link_product}}" target="_blank"><img src="{{url('images/product/asli')}}/{{$key->url_product}}" alt=""></a>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <br>
    </div>
</section> -->
<!-- Our Ticket Pricing Table Area End -->

<!-- Our Speakings Area Start -->
<section class="our-speaker-area bg-img bg-gradient-overlay section-padding-100-60" style="background-image: url({{url('themeuser/img/bg-img/3.jpg')}});">
    <div class="container">
        <div class="row">
            <!-- Heading -->
            <div class="col-12">
                <div class="section-heading text-center wow fadeInUp" data-wow-delay="300ms">
                    <p>Our Certificate</p>
                    <!-- <h4>Who’s we are</h4> -->
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($getSertifikatLandscape as $key)
              <!-- Single Speaker Area -->
              <div class="col-12 col-md-6 col-lg-4">
                  <div class="single-speaker-area bg-gradient-overlay-2 wow fadeInUp" data-wow-delay="300ms">
                      <!-- Thumb -->
                      <div class="speaker-single-thumb">
                          <img src="{{ url('images/sertifikat/') }}/{{$key->url_sertifikat}}" alt="">
                      </div>
                  </div>
              </div>
            @endforeach

            @foreach($getSertifikatPortrait as $key)
              <!-- Single Speaker Area -->
              <div class="col-12 col-md-6 col-lg-4">
                  <div class="single-speaker-area bg-gradient-overlay-2 wow fadeInUp" data-wow-delay="300ms">
                      <!-- Thumb -->
                      <div class="speaker-single-thumb">
                          <img src="{{ url('images/sertifikat/') }}/{{$key->url_sertifikat}}" alt="">
                      </div>
                  </div>
              </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Our Speakings Area End -->

<!-- Our Ticket Pricing Table Area Start -->
<section class="our-ticket-pricing-table-area bg-img bg-gradient-overlay section-padding-100-0 jarallax" style="background-image: url({{url('themeuser/img/bg-img/home2.jpg')}});">
    <div class="container">
        <div class="row">
            <!-- Heading -->
            <div class="col-12">
                <div class="section-heading text-center wow fadeInUp" data-wow-delay="300ms">
                    <p>Our Sponsors</p>
                    <h4>OFFICIAL SPONSOR</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <!-- Our Sponsor area -->
                <div class="our-sponsor-area d-flex flex-wrap">
                    <!-- Single Sponsor -->
                    @foreach($getSponsor as $key)
                    <div class="single-sponsor wow fadeInUp" data-wow-delay="300ms">
                        @if (strpos($key->link_sponsor, 'http') !== false)
                          <a href="{{$key->link_sponsor}}" target="_blank"><img src="{{url('images/sponsor/asli')}}/{{$key->url_sponsor}}" alt=""></a>
                        @else
                          <a href="http://{{$key->link_sponsor}}" target="_blank"><img src="{{url('images/sponsor/asli')}}/{{$key->url_sponsor}}" alt=""></a>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <br>
    </div>
</section>
<!-- Our Ticket Pricing Table Area End -->

<!-- Our Sponsor And Client Area Start -->
<section class="our-sponsor-client-area section-padding-100">
    <div class="container">
        <div class="row">
            <!-- Heading -->
            <div class="col-12">
                <div class="section-heading-2 text-center wow fadeInUp" data-wow-delay="300ms">
                    <p>Testimonial</p>
                    <h4>they are Message</h4>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Our client area -->
            <div class="col-12">
                <div class="our-client-area wow fadeInUp" data-wow-delay="300ms">
                    <!-- client Slider -->
                    <div class="client-area owl-carousel">
                        @foreach($getDataPesan as $key)
                          <!-- Single client Slider -->
                          <div class="single-client-content">
                              <!-- Single client Text -->
                              <div class="single-client-text">
                                  <p>
                                    {{$key->isi}}
                                  </p>
                                  <!-- Single client Thumb and info -->
                                  <div class="single-client-thumb-info d-flex align-items-center">
                                      <!-- Single client Thumb -->
                                      <div class="single-client-thumb">
                                          <img src="{{asset('themeuser/img/core-img/robot.png')}}" alt="">
                                      </div>
                                      <!-- Single client Info -->
                                      <div class="client-info">
                                          <h6>{{$key->nama}}</h6>
                                          <p>{{$key->email}}</p>
                                      </div>
                                  </div>
                              </div>
                              <!-- Single client Icon -->
                              <div class="client-icon">
                                  <i class="zmdi zmdi-quote"></i>
                              </div>
                          </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Our Sponsor And Client Area End -->

<!-- Our Blog Area Start -->
<section class="our-blog-area bg-img bg-gradient-overlay section-padding-100-60" style="background-image: url({{url('themeuser/img/bg-img/review-bg.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Heading -->
                <div class="section-heading text-center wow fadeInUp" data-wow-delay="300ms">
                    <p>Our Blog</p>
                    <h4>Article Feed</h4>
                </div>
            </div>

            @foreach($getDataArticle as $key)
            <!-- Single Blog Area -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-blog-area wow fadeInUp" data-wow-delay="300ms">
                    <!-- Single blog Thumb -->
                    <div class="single-blog-thumb">
                        <img src="{{ url('images/article/') }}/{{$key->url_foto}}" alt="">
                    </div>
                    <div class="single-blog-text text-center">
                        <a class="blog-title" href="#">{{$key->judul_informasi}}</a>
                        <!-- Post Meta -->
                        <div class="post-meta">
                            <?php $date = explode(' ', $key->created_at) ?>
                            <a class="post-date" href="#"><i class="zmdi zmdi-alarm-check"></i> {{ \Carbon\Carbon::parse($key->created_at)->format('M d, Y')}}</a>
                            <a class="post-author" href="#"><i class="zmdi zmdi-account"></i> {{$key->name}}</a>
                        </div>
                        <p>
                            <?php $isiArticle = explode(" ", $key->isi_informasi); ?>
                          @if(count($isiArticle)<=10)
                            <span><?php echo $key->isi_informasi ?></span>
                          @else
                            @for($i=0; $i < 10; $i++)
                              <span><?php echo $isiArticle[$i] ?></span>
                            @endfor
                            [.....]
                          @endif
                        </p>
                    </div>
                    <div class="blog-btn">
                        <a href="{{url('articleById')}}/{{$key->id}}/{{$key->id_kategori}}"><i style="margin-top:20%" class="zmdi zmdi-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
<!-- Our Blog Area End -->

<!-- Contact Area Start -->
<section class="contact-our-area section-padding-100-0">
    <div class="container">
        <div class="row">
            <!-- Heading -->
            <div class="col-12">
                <div class="section-heading-2 text-center wow fadeInUp" data-wow-delay="300ms">
                    <p>Have Question?</p>
                    <h4>Contact us</h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
          @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4><i class="icon fa fa-check"></i> Success!</h4>
              <p>{{ Session::get('message') }}</p>
            </div>
          @endif
          @if(Session::has('messagefail'))
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4><i class="icon fa fa-ban"></i> Oops, error!</h4>
            <p>{{ Session::get('messagefail') }}</p>
          </div>
          @endif
        </div>

        <div class="row justify-content-between">
            <div class="col-12 col-sm-3">
                <div class="contact-information mb-100">
                    <!-- Single Contact Info -->
                    <div class="single-contact-info wow fadeInUp" data-wow-delay="300ms">
                        <p>Address:</p>
                        <h6>Jl. GADING KIRANA TIMUR<br>Blok H 13 No. 31 - 14240</h6>
                    </div>
                    <!-- Single Contact Info -->
                    <div class="single-contact-info wow fadeInUp" data-wow-delay="300ms">
                        <p>Phone:</p>
                        <h6>+62 21 451 7337 (office)</h6>
                        <h6>+62 812 8778 7266</h6>
                    </div>
                    <!-- Single Contact Info -->
                    <div class="single-contact-info wow fadeInUp" data-wow-delay="300ms">
                        <p>Email:</p>
                        <h6>office@jalinnusantara.com</h6>
                        <h6>sandi@jalinnusantara.com</h6>
                    </div>
                    <!-- Single Contact Info -->
                    <div class="single-contact-info wow fadeInUp" data-wow-delay="300ms">
                        <p>Website:</p>
                        <h6>www.jalinnusantara.com</h6>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-8">
                <!-- Contact Form -->
                <div class="contact_from_area mb-100 clearfix wow fadeInUp" data-wow-delay="300ms">
                    <div class="contact_form">
                        <form action="{{route('home.store')}}" method="post" id="main_contact_form" enctype="multipart/form-data" >
                          {{csrf_field()}}
                            <div class="contact_input_area">
                                <div id="success_fail_info"></div>
                                <div class="row">
                                    <!-- Form Group -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            @if ($errors->has('nama'))
                                              <small style="color:red">* {{$errors->first('nama')}}</small>
                                            @endif
                                            <input type="text" class="form-control mb-30" value="{{ old('nama') }}" name="nama" id="nama" placeholder="Your Name">
                                        </div>
                                    </div>
                                    <!-- Form Group -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            @if ($errors->has('subject'))
                                              <small style="color:red">* {{$errors->first('subject')}}</small>
                                            @endif
                                            <input type="text" class="form-control mb-30" value="{{ old('subject') }}" name="subject" id="subject" placeholder="Subject">
                                        </div>
                                    </div>
                                    <!-- Form Group -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            @if ($errors->has('email'))
                                              <small style="color:red">* {{$errors->first('email')}}</small>
                                            @endif
                                            <input type="email" class="form-control mb-30" value="{{ old('email') }}" name="email" id="email" placeholder="E-mail">
                                        </div>
                                    </div>
                                    <!-- Form Group -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            @if ($errors->has('telephone'))
                                              <small style="color:red">* {{$errors->first('telephone')}}</small>
                                            @endif
                                            <input type="text" class="form-control mb-30" value="{{ old('telephone') }}" name="telephone" id="telephone" placeholder="Your Number">
                                        </div>
                                    </div>
                                    <!-- Form Group -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            @if ($errors->has('message'))
                                              <small style="color:red">* {{$errors->first('message')}}</small>
                                            @endif
                                            <textarea name="message" class="form-control mb-30" id="message" cols="30" rows="6" placeholder="Your Message *">{{ old('message') }}</textarea>
                                        </div>
                                    </div>
                                    <!-- Button -->
                                    <div class="col-12">
                                        <button type="submit" class="btn confer-btn">Send Message <i class="zmdi zmdi-long-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Area End -->


@endsection

@section('footscript')

@endsection
