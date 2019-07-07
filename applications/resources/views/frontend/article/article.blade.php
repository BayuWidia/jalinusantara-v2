@extends('frontend.master.layouts.master')

@section('banner')
<!-- Breadcrumb Area Start -->
<section class="breadcrumb-area bg-img bg-gradient-overlay jarallax" style="background-image: url({{url('themeuser/img/bg-img/video-bg.jpg')}});">
     <div class="container h-100">
         <div class="row h-100 align-items-center">
             <div class="col-12">
                 <div class="breadcrumb-content">
					<br><br><br><br><br><br><br>
					 <h2 class="page-title">{{$getKategori[0]->nama_kategori}}</h2>
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
<!-- Our Blog Area Start -->
<div class="our-blog-area section-padding-100">
    <div class="container">
        <div class="row">
            @foreach($getArticle as $key)
              <!-- Single Blog Area -->
              <div class="col-12 col-md-6 col-xl-4">
                  <div class="single-blog-area style-2 wow fadeInUp" data-wow-delay="300ms">
                      <!-- Single blog Thumb -->
                      <div class="single-blog-thumb">
                         <img src="{{ url('images/article/') }}/{{$key->url_foto}}">
                      </div>
                      <div class="single-blog-text text-center">
                          <a class="blog-title" href="#">{{$key->judul_informasi}}</a>
                          <!-- Post Meta -->
                          <div class="post-meta">
                              <a class="post-date" href="#"><i class="zmdi zmdi-alarm-check"></i> {{ \Carbon\Carbon::parse($key->created_at)->format('M d, y')}}</a>
                              <a class="post-author" href="#"><i class="zmdi zmdi-account"></i> {{$key->name}}</a>
                              <a class="post-author" href="#"><i class="zmdi zmdi-face"></i> {{$key->view_counter}}</a>
                          </div>
                          <p>
                            <?php $isiArticle = explode(" ", $key->isi_informasi); ?>
                            @if(count($isiArticle)<=20)
                              <span><?php echo $key->isi_informasi ?></span>
                            @else
                              @for($i=0; $i < 20; $i++)
                                <span><?php echo $isiArticle[$i] ?></span>
                              @endfor
                              [.....]
                            @endif
                          </p>
                      </div>
                      <div class="blog-btn">
                          <a href="{{url('articleById')}}/{{$key->id}}/{{$key->id_kategori}}"><i class="zmdi zmdi-long-arrow-right"></i></a>
                      </div>
                  </div>
              </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-12">
                <div class="more-blog-btn text-center">
                    <a class="btn confer-btn" href="#">Load more <i class="zmdi zmdi-refresh"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Our Blog Area End -->

@endsection

@section('footscript')

@endsection
