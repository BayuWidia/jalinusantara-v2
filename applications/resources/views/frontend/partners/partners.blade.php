@extends('frontend.master.layouts.master')

@section('banner')
<!-- Breadcrumb Area Start -->
<section class="breadcrumb-area bg-img bg-gradient-overlay jarallax" style="background-image: url({{url('themeuser/img/bg-img/video-bg.jpg')}});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content">
					          <br><br><br><br><br>
                    <h2 class="page-title">Partners</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Partners</li>
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
<!-- Our Speakings Area Start -->
    <section class="our-speaker-area section-padding-100-60">
        <div class="container">
            <div class="row">
                <!-- Heading -->
                <div class="col-12">
                    <div class="section-heading-3 text-center wow fadeInUp" data-wow-delay="300ms">
                        <h1>Our Partners</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Our Speakings Area End -->
<!-- Our Gallery Area Start -->
<div class="our-gallery-area section-padding-0-85">
    <div class="container-fluid">
        <div class="row">
            @foreach($getPartners as $key)
                <!-- Single Gallery Thumb -->
                <div class="col-12 col-sm-3" style="text-align:center">
                    <div class="wow fadeInUp" data-wow-delay="300ms">
                        <a href="{{ url('images/partners/asli/') }}/{{$key->url_partners}}" class="single-gallery-item">
                          <img src="{{ url('images/partners/asli/') }}/{{$key->url_partners}}" alt=""></a>
                    </div>
                    <br>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Our Gallery Area End -->


<!-- Our Speakings Area Start -->
<section class="our-speaker-area section-padding-50-60">
    <div class="container">
        <div class="row">
            <!-- Heading -->
            <div class="col-12">
                <div class="section-heading-3 text-center wow fadeInUp" data-wow-delay="300ms">
                    <h1>Our Certificate</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Our Speakings Area End -->
<!-- Our Certificate Area Start -->
<div class="our-gallery-area section-padding-0-85">
    <div class="container-fluid">
        <div class="row">
            @foreach($getSertifikatLandscape as $key)
                <!-- Single Certificate Thumb -->
                <div class="col-12 col-sm-4" style="text-align:center">
                    <div class="wow fadeInUp" data-wow-delay="300ms">
                        <a href="{{ url('images/sertifikat/') }}/{{$key->url_sertifikat}}" class="single-gallery-item">
                          <img src="{{ url('images/sertifikat/') }}/{{$key->url_sertifikat}}" alt=""></a>
                    </div>
                    <br>
                </div>
            @endforeach

            @foreach($getSertifikatPortrait as $key)
                <!-- Single Certificate Thumb -->
                <div class="col-12 col-sm-4" style="text-align:center">
                    <div class="wow fadeInUp" data-wow-delay="300ms">
                        <a href="{{ url('images/sertifikat/') }}/{{$key->url_sertifikat}}" class="single-gallery-item">
                          <img src="{{ url('images/sertifikat/') }}/{{$key->url_sertifikat}}" alt=""></a>
                    </div>
                    <br>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Our Certificate Area End -->

@endsection

@section('footscript')

@endsection
