@extends('frontend.master.layouts.master')

@section('banner')
<!-- Breadcrumb Area Start -->
<section class="breadcrumb-area bg-img jarallax" style="background-image: url({{url('images/slider')}}/{{$getSlider[0]->url_slider}});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content">
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
<!-- Our Schedule Area Start -->
<section class="our-schedule-area bg-white section-padding-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Video Gallery</h1>
                <hr>
                <div class="single-schedule-area" data-wow-delay="300ms">
                    <!-- Single Schedule Thumb and Info -->
                    <h3>List Video's</h3>
                    <hr>
                    <table id="tabelinfo" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                      <thead>
                          <tr style="background-color:#111343;color:white;text-align:center">
                            <th>#</th>
                            <th>Judul</th>
                            <th>Video</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php $i=1; @endphp
                        @foreach($getVideo as $key)
                          <tr>
                            <td>{{$i++}}</td>
                            <td>{{$key->judul}}</td>
                            <td>
                              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo substr($key->url_video,-11,23)?>" allowfullscreen></iframe>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Our Schedule Area End -->

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
