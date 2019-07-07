@extends('frontend.master.layouts.master')

@section('banner')
<!-- Breadcrumb Area Start -->
<section class="breadcrumb-area bg-img bg-gradient-overlay jarallax" style="background-image: url({{url('themeuser/img/bg-img/video-bg.jpg')}});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content">
					          <br><br><br><br><br>
                    <h2 class="page-title">Events</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$getKategori[0]->nama_kategori}}</li>
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
<!-- Our Schedule Area Start -->
<section class="our-schedule-area bg-white section-padding-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{$getKategori[0]->nama_kategori}} Event</h1>
                <hr>
                @foreach($getEvents as $key)
                  <!-- Single Schedule Area -->
                  <div class="single-schedule-area single-page d-flex flex-wrap justify-content-between align-items-center wow fadeInUp" data-wow-delay="300ms">
                      <!-- Single Schedule Thumb and Info -->
                      <div class="single-schedule-tumb-info d-flex align-items-center">
                          <!-- Single Schedule Thumb -->
                          <div class="single-schedule-tumb">
                              <img src="{{asset('themeuser/img/core-img/event.png')}}" alt="">
                          </div>
                          <!-- Single Schedule Info -->
                          <div class="single-schedule-info">
                              <h6>{{$key->judul_event}}</h6>
                              <p>by <span>Admin</span></p>
                          </div>
                      </div>
                      <!-- Single Schedule Info -->
                      <div class="schedule-time-place">
                          <p><i class="zmdi zmdi-time"></i> {{ \Carbon\Carbon::parse($key->tanggal_mulai)->format('d M Y')}} - {{ \Carbon\Carbon::parse($key->tanggal_akhir)->format('d M Y')}}</p>
                          <p><i class="zmdi zmdi-pin-drop"></i> {{$key->lokasi}}</p>
                          <!-- <p><i class="zmdi zmdi-pin-drop"></i> {{$key->alamat}}</p> -->
                      </div>
                      <!-- Schedule Btn -->
                      <a href="{{url('eventsById')}}/{{$key->id}}/{{$key->id_kategori}}" class="btn confer-btn">View More <i class="zmdi zmdi-long-arrow-right"></i></a>
                  </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Our Schedule Area End -->

@endsection

@section('footscript')

@endsection
