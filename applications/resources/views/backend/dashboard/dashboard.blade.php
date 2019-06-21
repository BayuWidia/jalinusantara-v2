@extends('backend.master.layouts.master')

@section('title')
    <title>Jalinusantara</title>
@endsection


@section('content')
  <div class="container-fluid">
      <div class="block-header">
          <h2>DASHBOARD</h2>
      </div>

      <!-- Widgets -->
      <div class="row clearfix">
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-cyan hover-expand-effect">
                  <div class="icon">
                      <i class="material-icons">thumb_up</i>
                  </div>
                  <div class="content">
                      <div class="text">ART PUBLISH</div>
                      <div class="number count-to" data-from="0" data-to="{{$getCountInformasi}}"></div>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-pink hover-expand-effect">
                  <div class="icon">
                      <i class="material-icons">thumb_down</i>
                  </div>
                  <div class="content">
                      <div class="text">ART UN PUBLISH</div>
                      <div class="number count-to" data-from="0" data-to="{{$getCountInformasiUn}}"></div>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-light-green hover-expand-effect">
                  <div class="icon">
                      <i class="material-icons">event_available</i>
                  </div>
                  <div class="content">
                      <div class="text">EVENTS PUBLISH</div>
                      <div class="number count-to" data-from="0" data-to="{{$getCountEvents}}"></div>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-deep-purple hover-expand-effect">
                  <div class="icon">
                      <i class="material-icons">event_busy</i>
                  </div>
                  <div class="content">
                      <div class="text">EVENTS UN PUBLISH</div>
                      <div class="number count-to" data-from="0" data-to="{{$getCountEventsUn}}"></div>
                  </div>
              </div>
          </div>
      </div>
      <!-- #END# Widgets -->

      <div class="row clearfix">
          <!-- Answered Tickets -->
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="card">
                  <div class="body bg-teal">
                      <div class="font-bold m-b--35">EVENTS HARI INI</div>
                      <ul class="dashboard-stat-list">
                        @if(sizeof($getEventsToday) != 0)
                          @foreach($getEventsToday as $key)
                            <li>
                                {{$key->judul_event}}
                                <span class="pull-right"><b>{{$key->jumlah_peserta}}</b> <small>Peserta</small></span>
                            </li>
                          @endforeach
                        @else
                        <li style="text-align:center">
                            <i>Events hari ini belum tersedia</i>
                        </li>
                        @endif
                      </ul>
                  </div>
              </div>
          </div>
          <!-- #END# Answered Tickets -->
      </div>

      <div class="row clearfix">
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="card">
                  <div class="header bg-orange">
                      List Data Article Terbaru
                  </div>
                  <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="tabelinfoa">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th style="text-align:center">Judul</th>
                                    <th style="text-align:center">Pembuat Article</th>
                                    <th style="text-align:center">Tanggal</th>
                                    <th style="text-align:center">Views</th>
                                </tr>
                            </thead>
                            <tbody>
                              @if(!$informasiTerbaru == null)
                                @php $j=1; @endphp
                                @foreach($informasiTerbaru as $key)
                                  @if($j<=10)
                                    <tr>
                                      <td>{{$j}}</td>
                                      <td>
                                        @php $judul = explode(" ", $key->judul_informasi); @endphp
                                        @if(count($judul)<=2)
                                          {{$key->judul_informasi}}
                                        @else
                                          @for($i=0; $i < 2; $i++)
                                            {{$judul[$i]}}
                                          @endfor
                                          ...
                                        @endif
                                      </td>
                                      <td>
                                        {{$key->fullname}}
                                      </td>
                                      <td>
                                        @php $date = explode(" ", $key->created_at); echo $date[0]; @endphp
                                      </td>
                                      <td style="text-align:center">
                                        <span class="badge bg-blue">
                                          @if($key->view_counter=="")
                                            0
                                          @else
                                            {{$key->view_counter}}
                                          @endif
                                        </span>
                                      </td>
                                    </tr>
                                  @endif
                                  @php $j++ @endphp
                                @endforeach
                              @else
                                <tr>
                                  <td colspan="5" style="text-align:center" class="text-muted">
                                    Data tidak tersedia.
                                  </td>
                                </tr>
                              @endif
                            </tbody>
                        </table>
                      </div>
                      <div class="box-footer text-center">
                        <a href="{{route('article.index')}}" class="uppercase">Lihat Seluruh Article</a>
                      </div>
                  </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-orange">
                        List Data Events Terbaru
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="tabelinfob">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">#</th>
                                        <th style="text-align:center">Judul</th>
                                        <th style="text-align:center">Lokasi</th>
                                        <th style="text-align:center">Fasilitator</th>
                                        <th style="text-align:center">Peserta</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if(!$eventsTerbaru == null)
                                    @php $j=1; @endphp
                                    @foreach($eventsTerbaru as $key)
                                      @if($j<=10)
                                        <tr>
                                          <td>{{$j}}</td>
                                          <td>
                                            @php $judul = explode(" ", $key->judul_event); @endphp
                                            @if(count($judul)<=5)
                                              {{$key->judul_event}}
                                            @else
                                              @for($i=0; $i < 5; $i++)
                                                {{$judul[$i]}}
                                              @endfor
                                              ...
                                            @endif
                                          </td>
                                          <td>
                                            {{$key->lokasi}}
                                          </td>
                                          <td>
                                            {{$key->fasilitator}}
                                          </td>
                                          <td style="text-align:center">
                                            <span class="badge bg-green">
                                              @if($key->jumlah_peserta=="")
                                                0
                                              @else
                                                {{$key->jumlah_peserta}}
                                              @endif
                                            </span>
                                          </td>
                                        </tr>
                                      @endif
                                      @php $j++ @endphp
                                    @endforeach
                                  @else
                                    <tr>
                                      <td colspan="5" style="text-align:center" class="text-muted">
                                        Data tidak tersedia.
                                      </td>
                                    </tr>
                                  @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer text-center">
                          <a href="{{route('events.index')}}" class="uppercase">Lihat Seluruh Events</a>
                        </div>
                    </div>
                </div>
              </div>
      </div>
  </div>
@endsection

@section('footscript')
<script src="{{asset('theme/js/pages/index.js')}}"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="{{asset('theme/plugins/jquery-countto/jquery.countTo.js')}}"></script>
@endsection
