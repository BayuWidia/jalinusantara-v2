@extends('frontend.master.layouts.master')

@section('banner')
<!-- Breadcrumb Area Start -->
<section class="breadcrumb-area bg-img bg-gradient-overlay jarallax" style="background-image: url({{url('themeuser/img/bg-img/video-bg.jpg')}});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content">
					<br><br><br><br><br><br><br>
                    <h2 class="page-title">About Us</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$getInformasi[0]->nama_kategori}}</li>
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
<!-- What We offer Area Start -->
<section class="what-we-offer-area section-padding-100-70">
  <div class="container">
      <div class="row align-items-center">
          <!-- About Content -->
          <div class="col-12 col-md-12">
              <div class="about-content-text mb-80">
                  <h6 class="wow fadeInUp" data-wow-delay="300ms">{{$getInformasi[0]->judul_informasi}}</h6>
                  <p class="wow fadeInUp" data-wow-delay="300ms"><?php echo $getInformasi[0]->isi_informasi ?></p>
              </div>
          </div>

          <!-- About Thumb -->
          <!-- <div class="col-12 col-md-4">
              <div class="about-thumb mb-80 wow fadeInUp" data-wow-delay="300ms">
                  <img src="{{asset('themeuser/img/jalinnusantara.png')}}" alt="">
              </div>
          </div> -->
      </div>
  </div>
</section>
<!-- What We offer Area End -->

@endsection

@section('footscript')

@endsection
