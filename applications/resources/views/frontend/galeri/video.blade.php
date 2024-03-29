@extends('frontend.master.layouts.master')

@section('banner')
<!-- Breadcrumb Area Start -->
<section class="breadcrumb-area bg-img bg-gradient-overlay jarallax" style="background-image: url({{url('themeuser/img/bg-img/video-bg.jpg')}});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content">
					          <br><br><br><br><br>
                    <h2 class="page-title">Gallery Video</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Video</li>
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
                    <h1>Gallery Video</h1>
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
          @php
              $temp = '';
          @endphp
          @foreach($getVideo as $key)
            @if ($key->id_events == $temp)
                  <div class="col-12 col-sm-6">
                      <div class="wow fadeInUp" data-wow-delay="300ms">
                        <div class="embed-responsive embed-responsive-16by9">
                          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo substr($key->url_video,-11,23)?>" allowfullscreen></iframe>
                        </div>
                      </div>
                      <br>
                  </div>
            @else
                <div class="col-12">
                  <div class="single-schedule-area wow fadeInUp" data-wow-delay="300ms">
                      <!-- Single Schedule Thumb and Info -->
                      <h3>{{$key->judul_event}}</h3>
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="wow fadeInUp" data-wow-delay="300ms">
                        <div class="embed-responsive embed-responsive-16by9">
                          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo substr($key->url_video,-11,23)?>" allowfullscreen></iframe>
                        </div>
                    </div>
                    <br>
                </div>
              @php
                $temp = $key->id_events;
              @endphp
            @endif
          @endforeach
        </div>
    </div>
</div>
<!-- Our Gallery Area End -->
@endsection

@section('footscript')
<script>
    $(function () {
        $('#tabelinfo').DataTable({
            "pageLength": 25,
            "scrollX": true
        })

    });
</script>

@endsection
