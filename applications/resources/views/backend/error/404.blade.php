@extends('master.layouts.master')

@section('title')
  <title>Adik Bang Taru</title>
  <link rel="stylesheet" href="{{asset('theme/css/uniform.css')}}" />
  <link rel="stylesheet" href="{{asset('theme/css/select2.css')}}" />
  <link rel="stylesheet" href="{{ asset('backend/css/jquery.gritter.css') }}" />
@endsection

@section('breadcrumb')
  <div id="content-header">
    <div id="breadcrumb">
      <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
      <a href="{{ route('kpa.index') }}" class="current">Manajemen KPA</a>
    </div>
    <h1>Manajemen KPA</h1>
  </div>
@endsection


@section('content')
<div class="container-fluid">
  <div class="widget-box">
    <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
      <h5>Error 404</h5>
    </div>
    <div class="widget-content">
      <div class="error_ex">
        <h1>404</h1>
        <h3>Opps, You're lost.</h3>
        <p>We can not find the page you're looking for.</p>
        <a class="btn btn-warning btn-big"  href="{{ redirect()->back()->getTargetUrl() }}">Back</a> </div>
    </div>
  </div>
</div>


@endsection
