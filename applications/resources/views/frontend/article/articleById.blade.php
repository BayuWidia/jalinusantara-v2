@extends('frontend.master.layouts.master')

@section('banner')
<!-- Breadcrumb Area Start -->
<section class="breadcrumb-area bg-img bg-gradient-overlay jarallax" style="background-image: url({{url('themeuser/img/bg-img/video-bg.jpg')}});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content">
					          <br><br><br><br><br>
                    <h2 class="page-title">{{$getArticle[0]->nama_kategori}}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item">{{$getArticle[0]->nama_kategori}}</li>
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
<!-- Blog Area Start -->
<section class="confer-blog-details-area section-padding-100-0">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Single Post Details Area -->
            <div class="col-12 col-lg-8 col-xl-9">
                <div class="pr-lg-4 mb-100">
                    <!-- Post Content -->
                    <div class="post-details-content">

                        <!-- Post Thumbnail -->
                        <div class="post-blog-thumbnail mb-30">
                            <img src="{{ url('images/article/') }}/{{$getArticle[0]->url_foto}}" alt="">
                        </div>

                        <!-- Post Title -->
                        <h4 class="post-title">{{$getArticle[0]->judul_informasi}}</h4>

                        <!-- Post Meta -->
                        <div class="post-meta">
                            <?php $date = explode(' ', $getArticle[0]->created_at) ?>
                            <a class="post-date" href="#"><i class="zmdi zmdi-calendar-check"></i> {{ \Carbon\Carbon::parse($getArticle[0]->created_at)->format('M d, Y')}}</a>
                            <a class="post-author" href="#"><i class="zmdi zmdi-account"></i> {{$getArticle[0]->fullname}}</a>
                            <a class="post-author" href="#"><i class="zmdi zmdi-favorite-outline"></i> {{$getArticle[0]->view_counter}} views</a>
                            <a class="post-author" href="#"><i class="zmdi zmdi-alarm-check"></i> {{$date[1]}}</a>
                        </div>
                        <p><?php echo $getArticle[0]->isi_informasi ?></p>
                        <hr>
                        <h5>Share Article This</h5>
                        <br>
                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58a5140167663aee"></script>
                        <div class="addthis_inline_share_toolbox"></div>
                    </div>
                    <hr>

                    @if($getCountComment != 0)
                    <!-- Comment Area -->
                      <div class="comment-area mb-80">
                          <!-- Comments Area -->
                          <div class="comment_area clearfix">
                              <h4 class="mb-30">{{$getCountComment}} Comments</h4>

                              <ol>
                                  @foreach($getComment as $key)
                                      <!-- Single Comment Area -->
                                      <li class="single_comment_area">
                                          <!-- Comment Content -->
                                          <div class="comment-content d-flex">
                                              <!-- Comment Author -->
                                              <div class="comment-author">
                                                  <img src="{{asset('themeuser/img/core-img/robot.png')}}" alt="author">
                                              </div>
                                              <!-- Comment Meta -->
                                              <div class="comment-meta">
                                                  <div class="comment-meta-data">
                                                      <?php $date = explode(' ', $key->created_at) ?>
                                                      <a href="#">{{$key->nama}}</a>
                                                      <span><i class="zmdi zmdi-calendar-check"></i> {{ \Carbon\Carbon::parse($key->created_at)->format('M d, Y')}} at {{$date[1]}}</span>
                                                  </div>
                                                  <p>{{$key->subject}}</p>
                                              </div>
                                          </div>
                                          @if($key->id_tanggapan != null)
                                          <ol class="children">
                                              <li class="single_comment_area">
                                                  <!-- Comment Content -->
                                                  <div class="comment-content d-flex">
                                                      <!-- Comment Author -->
                                                      <div class="comment-author">
                                                          <img src="{{asset('themeuser/img/core-img/robot2.png')}}" alt="author">
                                                      </div>
                                                      <!-- Comment Meta -->
                                                      <div class="comment-meta">
                                                          <div class="comment-meta-data">
                                                              <a href="#">Admin</a>
                                                              <?php $date = explode(' ', $key->created_at2) ?>
                                                              <span><i class="zmdi zmdi-calendar-check"></i> {{ \Carbon\Carbon::parse($key->created_at2)->format('M d, Y')}} at {{$date[1]}}</span>
                                                          </div>
                                                          <p>{{$key->tanggapan}}</p>
                                                      </div>
                                                  </div>
                                              </li>
                                          </ol>
                                          @endif
                                        @endforeach

                                  </li>
                              </ol>
                          </div>
                      </div>
                    @endif
                    <br>
                    <!-- Leave A Reply -->
                    <div class="confer-leave-a-reply-form clearfix">
                        <h4 class="mb-30">Leave A Comment</h4>
                        <div class="row">
                          <div class="col-md-12">
                            @if(Session::has('message'))
                              <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                                <p>{{ Session::get('message') }}</p>
                              </div>
                            @endif
                            @if(Session::has('messagefail'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4><i class="icon fa fa-ban"></i> Oops, terjadi kesalahan!</h4>
                              <p>{{ Session::get('messagefail') }}</p>
                            </div>
                            @endif
                          </div>
                        </div>

                        <!-- Leave A Reply -->
                        <div class="contact_form">
                            <form action="{{route('articleById.store')}}" method="post" enctype="multipart/form-data">
                              {{csrf_field()}}
                                <div class="contact_input_area">
                                    <div class="row">
                                        <!-- Form Group -->
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                @if ($errors->has('nama'))
                                                  <small style="color:red">* {{$errors->first('nama')}}</small>
                                                @endif
                                                <input type="hidden" name="id" value="{{$getArticle[0]->id}}">
                                                <input type="hidden" name="idKategori" value="{{$getArticle[0]->id_kategori}}">
                                						    <input type="text" class="form-control mb-30" id="name" name="nama" value="{{ old('nama') }}" placeholder="Your Name">
                                            </div>
                                        </div>
                                        <!-- Form Group -->
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                @if ($errors->has('email'))
                                                  <small style="color:red">* {{$errors->first('email')}}</small>
                                                @endif
                                                <input type="email" class="form-control mb-30" id="email" name="email" value="{{ old('email') }}"
                                                placeholder="E-mail">

                                            </div>
                                        </div>
                                        <!-- Form Group -->
                                        <div class="col-12 col-lg-12">
                                            <div class="form-group">
                                                @if ($errors->has('subject'))
                                                  <small style="color:red">* {{$errors->first('subject')}}</small>
                                                @endif
                                                <input type="text" class="form-control mb-30" id="subject" name="subject" value="{{ old('subject') }}" placeholder="Subject">

                                            </div>
                                        </div>
                                        <!-- Form Group -->
                                        <div class="col-12">
                                            <div class="form-group">
                                              @if ($errors->has('message'))
                                                <small style="color:red">* {{$errors->first('message')}}</small>
                                              @endif
                                              <textarea class="form-control mb-30" rows="5" name="message" placeholder="Messege">{{ old('message') }}</textarea>
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

            <!-- Blog Sidebar Area -->
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="confer-sidebar-area mb-100">

                    <!-- Single Widget Area -->
                    <div class="single-widget-area">
                        <div class="search-widget">
                            <form action="#" method="post">
                                <input type="search" name="search-form" id="searchForm" placeholder="Search">
                                <button type="submit"><i class="zmdi zmdi-search"></i></button>
                            </form>
                        </div>
                    </div>

                    @foreach($getDataPesan as $key)
                      <!-- Single Widget Area -->
                      <div class="single-widget-area">
                          <!-- Post Author Widget -->
                          <div class="post-author-widget">
                              <!-- Thumbnail -->
                              <div class="post-author-avatar">
                                  <img src="{{asset('themeuser/img/core-img/robot.png')}}" alt="">
                              </div>
                              <!-- Author Content -->
                              <div class="post-author-content">
                                  <h5>{{$key->nama}}</h5>
                                  <span>{{$key->email}}</span>
                                  <p>{{$key->isi}}</p>
                              </div>
                          </div>
                      </div>
                    @endforeach

                    <hr>
                    <!-- Single Widget Area -->
                    <div class="single-widget-area">
                        <h5 class="widget-title mb-30">Related Article's</h5>

                        @foreach($getArticleTerkait as $key)
                          <!-- Single Recent Post Area -->
                          <div class="single-recent-post-area d-flex align-items-center">
                              <!-- Thumb -->
                              <div class="post-thumb">
                                  <a href="single-blog.html"><img src="{{ url('images/article/') }}/{{$key->url_foto}}" alt=""></a>
                              </div>
                              <!-- Content -->
                              <div class="post-content">
                                  <a href="{{url('articleById')}}/{{$key->id}}/{{$key->id_kategori}}" class="post-title">{{$key->judul_informasi}}</a>
                                  <a href="#" class="post-date"><i class="zmdi zmdi-time"></i> <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($key->created_at))->diffForHumans() ?></a>
                              </div>
                          </div>
                        @endforeach
                    </div>
                    <hr>
                    <!-- Single Widget Area -->
                    <div class="single-widget-area">
                        <h5 class="widget-title mb-30">Article's Popular</h5>

                        @foreach($getArticlePopuler as $key)
                          <!-- Single Recent Post Area -->
                          <div class="single-recent-post-area d-flex align-items-center">
                              <!-- Thumb -->
                              <div class="post-thumb">
                                  <a href="single-blog.html"><img src="{{ url('images/article/') }}/{{$key->url_foto}}" alt=""></a>
                              </div>
                              <!-- Content -->
                              <div class="post-content">
                                  <a href="{{url('articleById')}}/{{$key->id}}/{{$key->id_kategori}}" class="post-title">{{$key->judul_informasi}}</a>
                                  <a href="#" class="post-date"><i class="zmdi zmdi-time"></i> <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($key->created_at))->diffForHumans() ?></a>
                              </div>
                          </div>
                        @endforeach
                    </div>
                    <hr>
                    <!-- Single Widget Area -->
                    <div class="single-widget-area">
                        <h5 class="widget-title mb-30">Categories</h5>

                        <!-- Catagories List -->
                        <ul class="categories-list">
                            @foreach($getJumlahKategori as $key)
                              <li><a href="{{ route('article', $key->id_kategori) }}">{{$key->nama_kategori}} <span>({{$key->jumlah}})</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                    <hr>
                    <!-- Single Widget Area -->
                    <div class="single-widget-area">
                        <h5 class="widget-title mb-30">Tag Clouds</h5>
                        <!-- Tag Cloud -->
                        <ul class="tag-cloud">
                            <?php $isiTags = explode(",", $getArticle[0]->tags);?>
                            @for($i=0; $i < count($isiTags); $i++)
                                <li><a href="#"><?php echo $isiTags[$i] ?></a></li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Area End -->
@endsection

@section('footscript')

@endsection
