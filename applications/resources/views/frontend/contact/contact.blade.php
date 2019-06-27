@extends('frontend.master.layouts.master')

@section('banner')
<!-- Breadcrumb Area Start -->
<section class="breadcrumb-area bg-img bg-gradient-overlay jarallax" style="background-image: url({{url('themeuser/img/bg-img/video-bg.jpg')}});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h2 class="page-title">Contact</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->
@endsection


@section('content')
<!-- Contact Us Area Start -->
<section class="contact--us-area section-padding-100-0">
    <div class="container">
        <div class="row">
            <!-- Contact Us Thumb -->
            <div class="col-12 col-lg-6">
                <div class="contact-us-thumb mb-100">
                    <img src="{{asset('themeuser/img/bg-img/contact.png')}}" alt="">
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-12 col-lg-6">
                <div class="contact_from_area mb-100 clearfix">
                    <!-- Contact Heading -->
                    <div class="contact-heading">
                        <h4>Contact us</h4>
                    </div>
                    <div class="contact_form">
                        <form action="{{route('contact.store')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="contact_input_area">
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
<!-- Contact Us Area End -->


<!-- Contact Info Area -->
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="contact--info-area bg-boxshadow">
                <div class="row">
                    <!-- Single Contact Info -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="single-contact--info text-center">
                            <!-- Contact Info Icon -->
                            <div class="contact--info-icon">
                                <img src="{{asset('themeuser/img/core-img/icon-5.png')}}" alt="">
                            </div>
                            <h7>Jl. GADING KIRANA TIMUR. <br>Blok H13. No. 31 <br>JAKARTA 14240. INDONESIA</h7>
                        </div>
                    </div>

                    <!-- Single Contact Info -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="single-contact--info text-center">
                            <!-- Contact Info Icon -->
                            <div class="contact--info-icon">
                                <img src="{{asset('themeuser/img/core-img/icon-6.png')}}" alt="">
                            </div>
                            <h7>+62 21 451 7337 (office)<br>+62 812 8778 7266</h7>
                        </div>
                    </div>

                    <!-- Single Contact Info -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="single-contact--info text-center">
                            <!-- Contact Info Icon -->
                            <div class="contact--info-icon">
                                <img src="{{asset('themeuser/img/core-img/icon-7.png')}}" alt="">
                            </div>
                            <h7>office@jalinnusantara.com<br>sandi@jalinnusantara.com</h7>
                        </div>
                    </div>

                    <!-- Single Contact Info -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="single-contact--info text-center">
                            <!-- Contact Info Icon -->
                            <div class="contact--info-icon">
                                <img src="{{asset('themeuser/img/core-img/icon-8.png')}}" alt="">
                            </div>
                            <h7>www.jalinnusantara.com</h7>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footscript')

@endsection
