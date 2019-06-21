@extends('frontend.master.layouts.master')

@section('banner')
<!-- Breadcrumb Area Start -->
<section class="breadcrumb-area bg-img bg-gradient-overlay jarallax" style="background-image: url({{url('themeuser/img/bg-img/video-bg.jpg')}});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h2 class="page-title">Event</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Event</li>
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
              <div class="schedule-tab">
                  <!-- Nav Tabs -->
                  <ul class="nav nav-tabs wow fadeInUp" data-wow-delay="300ms" id="conferScheduleTab" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" id="monday-tab" data-toggle="tab" href="#step-one" role="tab" aria-controls="step-one" aria-expanded="true">
                            Today <br> <span>{{ \Carbon\Carbon::now()->format('M d, Y')}}</span></a>
                      </li>
                      <!-- Nav Item -->
                      <li class="nav-item">
                          <a class="nav-link" id="tuesday-tab" data-toggle="tab" href="#step-two" role="tab" aria-controls="step-two" aria-expanded="true">
                            Tomorrow <br> <span>{{date('M d, Y', strtotime('+1 day'))}}</span></a>
                      </li>
                      <!-- Nav Item -->
                      <li class="nav-item">
                          <a class="nav-link" id="wednesday-tab" data-toggle="tab" href="#step-three" role="tab" aria-controls="step-three" aria-expanded="true">
                            Etc <br> <span>{{date('M d, Y', strtotime('+2 day'))}}</span></a>
                      </li>
                  </ul>
              </div>

              <!-- Tab Content -->
              <div class="tab-content" id="conferScheduleTabContent">
                  <div class="tab-pane fade show active" id="step-one" role="tabpanel" aria-labelledby="monday-tab">
                      <!-- Single Tab Content -->
                      <div class="single-tab-content">
                          <div class="row">
                              <div class="col-12">
                                  <!-- Single Schedule Area -->
                                  @foreach($getDataEventsToday as $key)
                                    <div class="single-schedule-area single-page d-flex flex-wrap justify-content-between align-items-center wow fadeInUp" data-wow-delay="300ms">
                                        <!-- Single Schedule Thumb and Info -->
                                        <div class="single-schedule-tumb-info d-flex align-items-center">
                                            <!-- Single Schedule Thumb -->
                                            <div class="single-schedule-tumb">
                                                <img src="{{asset('themeuser/img/event.png')}}" alt="">
                                            </div>
                                            <!-- Single Schedule Info -->
                                            <div class="single-schedule-info">
                                                <h6 style="color:#111343">{{$key->judul_event}}</h6>
                                                <p>by <span style="color:#111343">Admin jalinnusantara</span></p>
                                            </div>
                                        </div>
                                        <!-- Single Schedule Info -->
                                        <div class="schedule-time-place">
                                            <p style="color:#111343"><i class="zmdi zmdi-time"></i> {{ \Carbon\Carbon::parse($key->tanggal_mulai)->format('d/M/y')}} - {{ \Carbon\Carbon::parse($key->tanggal_akhir)->format('d/M/y')}}</p>
                                            <p style="color:#111343"><i class="zmdi zmdi-map"></i> {{$key->lokasi}}</p>
                                            <p style="color:#111343"><i class="zmdi zmdi-pin-drop"></i> {{$key->alamat}}</p>
                                        </div>
                                        <!-- Schedule Btn -->
                                        <a href="{{url('eventsById')}}/{{$key->id}}/{{$key->id_kategori}}" class="btn confer-btn">View More <i class="zmdi zmdi-long-arrow-right"></i></a>
                                    </div>
                                  @endforeach
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="tab-pane fade" id="step-two" role="tabpanel" aria-labelledby="tuesday-tab">
                      <!-- Single Tab Content -->
                      <div class="single-tab-content">
                          <div class="row">
                              <div class="col-12">
                                  <!-- Single Schedule Area -->
                                  @foreach($getDataEventsTomorrow as $key)
                                    <div class="single-schedule-area single-page d-flex flex-wrap justify-content-between align-items-center wow fadeInUp" data-wow-delay="300ms">
                                        <!-- Single Schedule Thumb and Info -->
                                        <div class="single-schedule-tumb-info d-flex align-items-center">
                                            <!-- Single Schedule Thumb -->
                                            <div class="single-schedule-tumb">
                                                <img src="{{asset('themeuser/img/event.png')}}" alt="">
                                            </div>
                                            <!-- Single Schedule Info -->
                                            <div class="single-schedule-info">
                                                <h6 style="color:#111343">{{$key->judul_event}}</h6>
                                                <p>by <span style="color:#111343">Admin jalinnusantara</span></p>
                                            </div>
                                        </div>
                                        <!-- Single Schedule Info -->
                                        <div class="schedule-time-place">
                                            <p style="color:#111343"><i class="zmdi zmdi-time"></i> {{ \Carbon\Carbon::parse($key->tanggal_mulai)->format('d/M/y')}} - {{ \Carbon\Carbon::parse($key->tanggal_akhir)->format('d/M/y')}}</p>
                                            <p style="color:#111343"><i class="zmdi zmdi-map"></i> {{$key->lokasi}}</p>
                                            <p style="color:#111343"><i class="zmdi zmdi-pin-drop"></i> {{$key->alamat}}</p>
                                        </div>
                                        <!-- Schedule Btn -->
                                        <a href="{{url('eventsById')}}/{{$key->id}}/{{$key->id_kategori}}" class="btn confer-btn">View More <i class="zmdi zmdi-long-arrow-right"></i></a>
                                    </div>
                                  @endforeach
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="tab-pane fade" id="step-three" role="tabpanel" aria-labelledby="wednesday-tab">
                      <!-- Single Tab Content -->
                      <div class="single-tab-content">
                          <div class="row">
                              <div class="col-12">
                                  <!-- Single Schedule Area -->
                                  @foreach($getDataEventsEtc as $key)
                                    <div class="single-schedule-area single-page d-flex flex-wrap justify-content-between align-items-center wow fadeInUp" data-wow-delay="300ms">
                                        <!-- Single Schedule Thumb and Info -->
                                        <div class="single-schedule-tumb-info d-flex align-items-center">
                                            <!-- Single Schedule Thumb -->
                                            <div class="single-schedule-tumb">
                                                <img src="{{asset('themeuser/img/event.png')}}" alt="">
                                            </div>
                                            <!-- Single Schedule Info -->
                                            <div class="single-schedule-info">
                                                <h6 style="color:#111343">{{$key->judul_event}}</h6>
                                                <p>by <span style="color:#111343">Admin jalinnusantara</span></p>
                                            </div>
                                        </div>
                                        <!-- Single Schedule Info -->
                                        <div class="schedule-time-place">
                                            <p style="color:#111343"><i class="zmdi zmdi-time"></i> {{ \Carbon\Carbon::parse($key->tanggal_mulai)->format('d/M/y')}} - {{ \Carbon\Carbon::parse($key->tanggal_akhir)->format('d/M/y')}}</p>
                                            <p style="color:#111343"><i class="zmdi zmdi-map"></i> {{$key->lokasi}}</p>
                                            <p style="color:#111343"><i class="zmdi zmdi-pin-drop"></i> {{$key->alamat}}</p>
                                        </div>
                                        <!-- Schedule Btn -->
                                        <a href="{{url('eventsById')}}/{{$key->id}}/{{$key->id_kategori}}" class="btn confer-btn">View More <i class="zmdi zmdi-long-arrow-right"></i></a>
                                    </div>
                                  @endforeach
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
</section>
<!-- Our Schedule Area End -->

@endsection

@section('footscript')

@endsection
