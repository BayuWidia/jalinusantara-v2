@extends('frontend.master.layouts.master')

@section('banner')
<!-- Breadcrumb Area Start -->
<section class="breadcrumb-area bg-img bg-gradient-overlay jarallax" style="background-image: url({{url('themeuser/img/bg-img/video-bg.jpg')}});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h2 class="page-title">Events</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$getEvents[0]->nama_kategori}}</li>
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
                <h1>{{$getEvents[0]->nama_kategori}} Event</h1>
                <hr>
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
                <!-- Single Schedule Area -->
                <div class="single-schedule-area wow fadeInUp" data-wow-delay="300ms">
                    <div class="row">
                      <div class="col-lg-7">
                        <h4>{{$getEvents[0]->judul_event}}</h4>
                        <hr>
                        <p><i class="zmdi zmdi-time"></i> Date : {{ \Carbon\Carbon::parse($getEvents[0]->tanggal_mulai)->format('d M Y')}} - {{ \Carbon\Carbon::parse($getEvents[0]->tanggal_akhir)->format('d M Y')}}</p>
                        <!-- <p><i class="zmdi zmdi-account-circle"></i> Fasilitator : {{$getEvents[0]->fasilitator}}</p> -->
                        <p><i class="zmdi zmdi-pin-drop"></i> Location : {{$getEvents[0]->lokasi}}</p>
                        <!-- <p><i class="zmdi zmdi-pin-drop"></i> Address : {{$getEvents[0]->alamat}}</p> -->
                        @if($getEvents[0]->url_scrut!="")
                          <p><i class="zmdi zmdi-file"></i> Download Scrutneering Form: <a href="{{url('documents/')}}/{{$getEvents[0]->url_scrut}}" download><img src="{{url('images/')}}/doc.png" width="32px" height="32px"/></a></p>
                        @endif
                        @if($getEvents[0]->url_rules!="")
                          <p><i class="zmdi zmdi-file"></i> Download Rules Form: <a href="{{url('documents/')}}/{{$getEvents[0]->url_rules}}" download><img src="{{url('images/')}}/doc.png" width="32px" height="32px"/></a></p>
                        @endif
                        <p><i class="zmdi zmdi-nature-people"></i> Participans : <a href="#" onclick="onClkarticipans()"><img style="margin-top:-2%" src="{{url('images/')}}/participans.png" width="32px" height="32px"/></a></p>
                        <p><i class="zmdi zmdi-money-box"></i> Entrance Fee : {{UtilHelper::convertToIdr($getEvents[0]->entrance_fee)}}</p>
                        <p><i class="zmdi zmdi-paypal"></i> Payment : {{$getEvents[0]->payment}}</p>
                        <p><i class="zmdi zmdi-layers"></i> Shirt Sizes : {{$getEvents[0]->shirt_sizes}}</p>
                      </div>
                      <div class="col-lg-5">
                        <img src="{{ url('images/events/asli') }}/{{$getEvents[0]->url_foto}}">
                      </div>
                      <a href="{{url('events.pendaftaran')}}/{{$getEvents[0]->id}}" class="btn confer-btn" target="_blank">Register</a>
                      &nbsp;&nbsp;
                      <a href="#" data-toggle='modal' data-target='#modalUpload' data-backdrop="static" data-keyboard="false" class="btn confer-btn">Upload</a>

                    </div>
                </div>
                <div class="single-schedule-area wow fadeInUp" data-wow-delay="300ms" id="divParticipans">
                    <!-- Single Schedule Thumb and Info -->
                    <h3>List Participans</h3>
                    <hr>
                    <table id="tabelinfo" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                      <thead>
                        <tr style="background-color:#111343;color:white">
                          <th>#</th>
                          <th>No Registrasi</th>
                          <th>Nama Driver</th>
                          <th>Nama Co Driver</th>
                          <th>Email</th>
                          <th>No Telp</th>
                          <th>No Pintu</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $i=1; @endphp
                          @foreach($getRegistrasiEvents as $key)
                            <tr>
                              <td>{{$i++}}</td>
                              <td>{{$key->no_registrasi}}</td>
                              <td>{{$key->nama_driver}}</td>
                              <td>{{$key->nama_co_driver}}</td>
                              <td>{{$key->email}}</th>
                              <td>{{$key->no_telp_driver}}</td>
                              <td>{{$key->nomor_pintu}}</td>
                            </tr>
                          @endforeach
                      </tbody>
                    </table>
                </div>

                <div class="single-schedule-area wow fadeInUp" data-wow-delay="300ms">
                    <!-- Single Schedule Thumb and Info -->
                    <h3>Isi Konten Event's</h3>
                    <hr>
                    <?php echo $getEvents[0]->isi_event ?>
                    <hr>
                    <h5>Share Event's this</h5>
                    <br>
                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58a5140167663aee"></script>
                    <div class="addthis_inline_share_toolbox"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Our Schedule Area End -->
<!-- Modal TAMBAH -->
<div id="modalUpload" class="modal fade" role="dialog">
  <div class="modal-dialog" style="max-width: 60%!important;" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data Upload Promo</h5>
      </div>
      <form action="{{route('registrasi.events.storeByUpload')}}" method='POST' name="Form" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-body">
          <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="alert alert-primary">
                    <label for="site">Download Template : </label>
                    <a href="{{ route('download.file.registrasi') }}" class="col-md-2 btn btn-success btn-sm">Download</a>
                  </div>
                </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                <div class="form-group mandatory">
                  <label for="uploadFile">Upload File</label>
                  <input type="hidden" name="idEvents" id="idEvents" value="{{$getEvents[0]->id}}">
                  <input type="hidden" name="idKategori" id="idKategori" value="{{$getEvents[0]->id_kategori}}">
                  <input type="file" name="uploadFile" id="uploadFile" class="form-control" required>
                </div>
              </div>
          </div>

        </div>
        <div class="modal-footer">
          <button class="col-md-2 btn btn-primary" id="submit" type="submit">Simpan</button>
          &nbsp;&nbsp;
          <button type="button" class="col-md-2 btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('footscript')
<script>
    $(document).ready(function() {
      $('#tabelinfo').DataTable({
          "pageLength": 25,
          "scrollX": true
      });
      var x = document.getElementById("divParticipans");
      x.style.display = "none";
    });
    function onClkarticipans() {
        var x = document.getElementById("divParticipans");
        if (x.style.display === "none") {
        x.style.display = "block";
        } else {
        x.style.display = "none";
        }
    }
</script>
@endsection
