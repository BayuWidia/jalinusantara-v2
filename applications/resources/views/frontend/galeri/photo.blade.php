@extends('frontend.master.layouts.master')

@section('banner')
<!-- Breadcrumb Area Start -->
<section class="breadcrumb-area bg-img bg-gradient-overlay jarallax" style="background-image: url({{url('themeuser/img/bg-img/video-bg.jpg')}});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h2 class="page-title">Gallery Photo</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Photo</li>
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
                    <h1>Gallery Photo</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Our Speakings Area End -->
<!-- Our Gallery Area Start -->
<div class="our-gallery-area section-padding-0-85">
    <div class="container-fluid">
        <div class="row" id="load-data">
          @php
              $temp = '';
          @endphp
          @foreach($getPhoto as $key)
            @if ($key->id_events == $temp)
                  <div class="col-12 col-sm-3">
                      <div class="wow fadeInUp" data-wow-delay="300ms">
                          <a href="{{ url('images/galeri/asli/') }}/{{$key->url_gambar}}" class="single-gallery-item">
                            <img src="{{ url('images/galeri/') }}/{{$key->url_gambar}}" alt=""></a>
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
                <div class="col-12 col-sm-3">
                    <div class="wow fadeInUp" data-wow-delay="300ms">
                        <a href="{{ url('images/galeri/asli/') }}/{{$key->url_gambar}}" class="single-gallery-item">
                          <img src="{{ url('images/galeri/') }}/{{$key->url_gambar}}" alt=""></a>
                    </div>
                    <br>
                </div>
              @php
                $temp = $key->id_events;
              @endphp
            @endif
          @endforeach
        </div>

        <!-- <div class="row" id="remove-row">
            <div class="col-12">
                <div class="more-blog-btn text-center">
                    <a class="btn confer-btn" id="loadmore" href="#">Load more <i class="zmdi zmdi-refresh"></i></a>
                </div>
            </div>
        </div> -->

    </div>
</div>
<!-- Our Gallery Area End -->
@endsection

@section('footscript')
<script>
    $(document).ready(function(){
       $(document).on('click','#loadmore',function(){
           $("#loadmore").html("Loading....");
           $.ajax({
               url : '{{ url("photo") }}',
               method : "POST",
               data : {_token:"{{csrf_token()}}"},
               dataType : "text",
               success : function (data)
               {
                  if(data != '')
                  {
                      $('#remove-row').remove();
                      $('#load-data').append(data);
                  }
                  else
                  {
                      $('#btn-more').html("No Data");
                  }
               }
           });
       });
    });
</script>

@endsection
