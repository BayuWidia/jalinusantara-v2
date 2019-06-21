@extends('frontend.master.layouts.master')

@section('banner')
<!-- Breadcrumb Area Start -->
<section class="breadcrumb-area bg-img bg-gradient-overlay jarallax" style="background-image: url({{url('themeuser/img/video-bg.jpg')}});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h2 class="page-title">Formulir Pendaftaran</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form Register</li>
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
                <h1 style="text-align:center">{{$getEvents[0]->judul_event}}</h1>
                <p style="text-align:center">
                  {{ \Carbon\Carbon::parse($getEvents[0]->tanggal_mulai)->format('d-M-y')}} s/d
                  {{ \Carbon\Carbon::parse($getEvents[0]->tanggal_akhir)->format('d-M-y')}}
                </p>
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
                <div style="border-color:#E358BA" class="single-schedule-area" data-wow-delay="300ms">
                    <!-- Single Schedule Thumb and Info -->
                    <div class="row">
                      <div class="col-lg-12">
                				<form class="form-area " action="{{route('registrasi.events.store')}}" method="post" enctype="multipart/form-data" class="contact-form text-right">
                            {{csrf_field()}}
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                              <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#drivertab" id="tab_driver">DRIVER</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#drivercotab" id="tab_codriver">CO - DRIVER</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#mekanik1tab" id="tab_mekanik1">CREW / MEKANIK 1</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#mekanik2tab" id="tab_mekanik2">CREW / MEKANIK 2</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kendaraantab" id="tab_kendaraan">KENDARAAN</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#contacttab" id="tab_contact">EMERGENCY CONTACT</a>
                              </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                              {{-- START Data Driver --}}
                              <div class="tab-pane container active" id="drivertab">
                                <hr style="background-color:#E358BA;color:white">
                                <h3><b>DRIVER</b></h3>
                                <hr style="background-color:#E358BA;color:white">
                                <div class="row">
                                  {{-- START Data Input Driver Kolom 1 --}}
                                  <div class="col-lg-6 form-group">
                                	@if ($errors->has('email1'))
                                	  <small style="color:red">* {{$errors->first('email1')}}</small>
                                	@endif
                                	<label><b>Email</b></label>
                                	<input type="hidden" name="idEvents" id="idEvents" value="{{$getEvents[0]->id}}">
                                	<input name="email1" placeholder="Ketikkan Email..."
                                		   class="common-input mb-30 form-control" value="{{ old('email1') }}" type="email" required>

                                	@if ($errors->has('namaLengkap1'))
                                	  <small style="color:red">* {{$errors->first('namaLengkap1')}}</small>
                                	@endif
                                	<label><b>Nama Lengkap</b></label>
                                	<input name="namaLengkap1" placeholder="Ketikkan Nama Lengkap..."
                                		  class="common-input mb-30 form-control" value="{{ old('namaLengkap1') }}" type="text" required>

                                	@if ($errors->has('nama1'))
                                	  <small style="color:red">* {{$errors->first('nama1')}}</small>
                                	@endif
                                	<label><b>Nama Panggilan</b></label>
                                	<input name="nama1" placeholder="Ketikkan Nama Panggilan..."
                                		   class="common-input mb-30 form-control" value="{{ old('nama1') }}" type="text" required>

                                	 @if ($errors->has('golonganDarah1'))
                                	   <small style="color:red">* {{$errors->first('golonganDarah1')}}</small>
                                	 @endif
                                	 <label><b>Golongan Darah</b></label>
                                   <select style="height:50px;border-radius: 0" name="golonganDarah1" class="common-input mb-30 form-control" required>
                                   		<option value="" >-- Pilih --</option>
                                   		<option value="A">A</option>
                                      <option value="A-">A-</option>
                                      <option value="A+">A+</option>
                                   		<option value="B">B</option>
                                      <option value="B-">B-</option>
                                      <option value="B+">B+</option>
                                   		<option value="O">O</option>
                                   		<option value="O-">O-</option>
                                   		<option value="O+">O+</option>
                                   		<option value="AB">AB</option>
                                      <option value="AB-">AB-</option>
                                      <option value="AB+">AB+</option>
                                   	</select>

                                	  @if ($errors->has('tempatLahir1'))
                                		<small style="color:red">* {{$errors->first('tempatLahir1')}}</small>
                                	  @endif
                                	  <label><b>Tempat Lahir</b></label>
                                	  <input name="tempatLahir1" placeholder="Ketikkan Tempat Lahir..."
                                			 class="common-input mb-30 form-control" value="{{ old('tempatLahir1') }}" type="text" required>

                                	 @if ($errors->has('noTelp1'))
                                	   <small style="color:red">* {{$errors->first('noTelp1')}}</small>
                                	 @endif
                                	 <label><b>No Telepone</b></label>
                                	 <input name="noTelp1" placeholder="Ketikkan No Telepone..."  maxlength="13"
                                			class="common-input mb-30 form-control" value="{{ old('noTelp1') }}" type="number" required>

                                	  @if ($errors->has('alamat1'))
                                		<small style="color:red">* {{$errors->first('alamat1')}}</small>
                                	  @endif
                                	  <label><b>Alamat</b></label>
                                	  <textarea rows="4" class="common-input mb-30 form-control"
                                		placeholder="Ketikkan Alamat..." name="alamat1" required>{{ old('alamat1') }}</textarea>
                                  </div>
                                  {{-- END Data Input Driver Kolom 1 --}}


                                  {{-- START Data Input Driver Kolom 2 --}}
                                  <div class="col-lg-6 form-group">

                                	@if ($errors->has('ukuranKemeja1'))
                                	  <small style="color:red">* {{$errors->first('ukuranKemeja1')}}</small>
                                	@endif
                                	<label><b>Ukuran Baju</b></label>
                                	<select style="height:50px;border-radius: 0" name="ukuranKemeja1" class="common-input mb-30 form-control" required>
                                		<option value="" >-- Pilih --</option>
                                		<option value="XS">XS</option>
                                		<option value="S">S</option>
                                		<option value="M">M</option>
                                		<option value="L">L</option>
                                		<option value="XL">XL</option>
                                		<option value="XXL">XXL</option>
                                		<option value="XXXL">XXXL</option>
                                	</select>

                                	@if ($errors->has('kota1'))
                                	  <small style="color:red">* {{$errors->first('kota1')}}</small>
                                	@endif
                                	<label><b>Kota</b></label>
                                	<input name="kota1" placeholder="Ketikkan Kota..."
                                		 class="common-input mb-30 form-control" value="{{ old('kota1') }}" type="text" required>

                                	@if ($errors->has('noAnggotaIof1'))
                                	  <small style="color:red">* {{$errors->first('noAnggotaIof1')}}</small>
                                	@endif
                                	<label><b>No Anggota IOF</b></label>
                                	<input name="noAnggotaIof1" placeholder="Ketikkan No Anggota IOF..."
                                		  class="common-input mb-30 form-control" value="{{ old('noAnggotaIof1') }}" type="text" required>

                                	@if ($errors->has('rhesus1'))
                                	  <small style="color:red">* {{$errors->first('rhesus1')}}</small>
                                	@endif
                                	<label><b>Rhesus</b></label>
                                	<input name="rhesus1" placeholder="Ketikkan Rhesus..."
                                		   class="common-input mb-30 form-control" value="{{ old('rhesus1') }}" type="text" required>

                                   @if ($errors->has('tanggalLahir1'))
                                	 <small style="color:red">* {{$errors->first('tanggalLahir1')}}</small>
                                   @endif
                                   <label><b>Tanggal Lahir</b></label>
                                   <input name="tanggalLahir1" placeholder="YYYY-MM-DD"
                                		  class="common-input mb-30 form-control datepicker1" value="{{ old('tanggalLahir1') }}" type="text" required>

                                   @if ($errors->has('kodePos1'))
                                	  <small style="color:red">* {{$errors->first('kodePos1')}}</small>
                                   @endif
                                   <label><b>Kode Pos</b></label>
                                   <input name="kodePos1" placeholder="Ketikkan Kode Pos..." maxlength="5"
                                		   class="common-input mb-30 form-control" value="{{ old('kodePos1') }}" type="number" required>

                                   @if ($errors->has('nomorSim1'))
                                	 <small style="color:red">* {{$errors->first('nomorSim1')}}</small>
                                   @endif
                                   <label><b>No SIM</b></label>
                                   <input name="nomorSim1" placeholder="Ketikkan No SIM..."
                                		  class="common-input mb-30 form-control" value="{{ old('nomorSim1') }}" type="text" required>
                                  {{-- END Data Input Driver Kolom 2 --}}
                                  </div>
                                </div>

                                <hr style="background-color:#E358BA;color:white">
                                <h3><b>DATA PENGALAMAN EVENT'S</b></h3>
                                <hr style="background-color:#E358BA;color:white">
                                <label class="btn btn-primary" onclick="addPengalaman1('tblPengalaman1')">Tambah</label>
                                  &nbsp;<label class="btn btn-danger" onclick="delPengalaman1('tblPengalaman1')">Hapus</label>

                                <table class="table" id="tblPengalaman1">
                                  <tbody>
                                	<tr>
                                	  <th></th>
                                	  <th>Nama Event's</th>
                                	  <th>Tahun</th>
                                	</tr>
                                	<tr>
                                	  <td><input type="checkbox" name="chk1"/></td>
                                	  <td>
                                		<input name="dataPengalaman1[0][namaEvent1]" placeholder = "Ketikkan Nama Events..." required
                                			 class="form-control" value="" type="text" required>
                                	  </td>
                                	  <td>
                                		<input name="dataPengalaman1[0][tahunEvent1]" placeholder="Ketikkan Tahun..." required
                                					 class="form-control" value="" type="number" required>
                                	  </td>
                                	</tr>
                                  </tbody>
                                </table>
                                <hr style="background-color:#E358BA;color:white">
                                <a href="#drivercotab" data-toggle="tab" id="btnkecodriver">
                                  <label class="btn btn-warning" style="color:white">Selanjutnya</label>
                                </a>
                              </div>
                              {{-- END Data Driver --}}


                              {{-- START Data CO Driver --}}
                              <div class="tab-pane container fade" id="drivercotab">
                                <hr style="background-color:#E358BA;color:white">
                                <h3><b>CO - DRIVER</b></h3>
                                <hr style="background-color:#E358BA;color:white">
                                <div class="row">
                                  {{-- START Data Input CO Driver Kolom 1 --}}
                                  <div class="col-lg-6 form-group">
                                	@if ($errors->has('email2'))
                                	  <small style="color:red">* {{$errors->first('email2')}}</small>
                                	@endif
                                	<label><b>Email</b></label>
                                	<input name="email2" placeholder="Ketikkan Email..."
                                		   class="common-input mb-30 form-control" value="{{ old('email2') }}" type="email" required>

                                	@if ($errors->has('namaLengkap2'))
                                	  <small style="color:red">* {{$errors->first('namaLengkap2')}}</small>
                                	@endif
                                	<label><b>Nama Lengkap</b></label>
                                	<input name="namaLengkap2" placeholder="Ketikkan Nama Lengkap..."
                                		  class="common-input mb-30 form-control" value="{{ old('namaLengkap2') }}" type="text" required>

                                	@if ($errors->has('nama2'))
                                	  <small style="color:red">* {{$errors->first('nama2')}}</small>
                                	@endif
                                	<label><b>Nama Panggilan</b></label>
                                	<input name="nama2" placeholder="Ketikkan Nama Panggilan..."
                                		   class="common-input mb-30 form-control" value="{{ old('nama2') }}" type="text" required>

                                	 @if ($errors->has('golonganDarah2'))
                                	   <small style="color:red">* {{$errors->first('golonganDarah2')}}</small>
                                	 @endif
                                	 <label><b>Golongan Darah</b></label>
                                   <select style="height:50px;border-radius: 0" name="golonganDarah2" class="common-input mb-30 form-control" required>
                                   		<option value="" >-- Pilih --</option>
                                      <option value="" >-- Pilih --</option>
                                   		<option value="A">A</option>
                                      <option value="A-">A-</option>
                                      <option value="A+">A+</option>
                                   		<option value="B">B</option>
                                      <option value="B-">B-</option>
                                      <option value="B+">B+</option>
                                   		<option value="O">O</option>
                                   		<option value="O-">O-</option>
                                   		<option value="O+">O+</option>
                                   		<option value="AB">AB</option>
                                      <option value="AB-">AB-</option>
                                      <option value="AB+">AB+</option>
                                   	</select>

                                	  @if ($errors->has('tempatLahir2'))
                                		<small style="color:red">* {{$errors->first('tempatLahir2')}}</small>
                                	  @endif
                                	  <label><b>Tempat Lahir</b></label>
                                	  <input name="tempatLahir2" placeholder="Ketikkan Tempat Lahir..."
                                			 class="common-input mb-30 form-control" value="{{ old('tempatLahir2') }}" type="text" required>

                                	 @if ($errors->has('noTelp2'))
                                	   <small style="color:red">* {{$errors->first('noTelp2')}}</small>
                                	 @endif
                                	 <label><b>No Telepone</b></label>
                                	 <input name="noTelp2" placeholder="Ketikkan No Telepone..." maxlength="13"
                                			class="common-input mb-30 form-control" value="{{ old('noTelp2') }}" type="number" required>

                                	  @if ($errors->has('alamat2'))
                                		<small style="color:red">* {{$errors->first('alamat2')}}</small>
                                	  @endif
                                	  <label><b>Alamat</b></label>
                                	  <textarea rows="4" class="common-input mb-30 form-control"
                                		placeholder="Ketikkan Alamat..." name="alamat2" required>{{ old('alamat2') }}</textarea>
                                  </div>
                                  {{-- END Data Input CO Driver Kolom 1 --}}


                                  {{-- START Data Input CO Driver Kolom 2 --}}
                                  <div class="col-lg-6 form-group">

                                	@if ($errors->has('ukuranKemeja2'))
                                	  <small style="color:red">* {{$errors->first('ukuranKemeja2')}}</small>
                                	@endif
                                	<label><b>Ukuran Baju</b></label>
                                	<select style="height:50px;border-radius: 0" name="ukuranKemeja2" class="common-input mb-30 form-control" required>
                                		<option value="" >-- Pilih --</option>
                                		<option value="XS">XS</option>
                                		<option value="S">S</option>
                                		<option value="M">M</option>
                                		<option value="L">L</option>
                                		<option value="XL">XL</option>
                                		<option value="XXL">XXL</option>
                                		<option value="XXXL">XXXL</option>
                                	</select>

                                	@if ($errors->has('kota2'))
                                	  <small style="color:red">* {{$errors->first('kota2')}}</small>
                                	@endif
                                	<label><b>Kota</b></label>
                                	<input name="kota2" placeholder="Ketikkan Kota..."
                                		 class="common-input mb-30 form-control" value="{{ old('kota2') }}" type="text" required>

                                	@if ($errors->has('noAnggotaIof2'))
                                	  <small style="color:red">* {{$errors->first('noAnggotaIof2')}}</small>
                                	@endif
                                	<label><b>No Anggota IOF</b></label>
                                	<input name="noAnggotaIof2" placeholder="Ketikkan No Anggota IOF..."
                                		  class="common-input mb-30 form-control" value="{{ old('noAnggotaIof2') }}" type="text" required>

                                	@if ($errors->has('rhesus2'))
                                	  <small style="color:red">* {{$errors->first('rhesus2')}}</small>
                                	@endif
                                	<label><b>Rhesus</b></label>
                                	<input name="rhesus2" placeholder="Ketikkan Rhesus..."
                                		   class="common-input mb-30 form-control" value="{{ old('rhesus2') }}" type="text" required>

                                   @if ($errors->has('tanggalLahir2'))
                                	 <small style="color:red">* {{$errors->first('tanggalLahir2')}}</small>
                                   @endif
                                   <label><b>Tanggal Lahir</b></label>
                                   <input name="tanggalLahir2" placeholder="YYYY-MM-DD"
                                		  class="common-input mb-30 form-control datepicker1" value="{{ old('tanggalLahir2') }}" type="text" required>

                                   @if ($errors->has('kodePos2'))
                                	  <small style="color:red">* {{$errors->first('kodePos2')}}</small>
                                   @endif
                                   <label><b>Kode Pos</b></label>
                                   <input name="kodePos2" placeholder="Ketikkan Kode Pos..." maxlength="5"
                                		   class="common-input mb-30 form-control" value="{{ old('kodePos2') }}" type="number" required>

                                   @if ($errors->has('nomorSim2'))
                                	 <small style="color:red">* {{$errors->first('nomorSim2')}}</small>
                                   @endif
                                   <label><b>No SIM</b></label>
                                   <input name="nomorSim2" placeholder="Ketikkan No SIM..."
                                		  class="common-input mb-30 form-control" value="{{ old('nomorSim2') }}" type="text" required>
                                  {{-- END Data Input Driver Kolom 2 --}}
                                  </div>
                                </div>
                                <hr style="background-color:#E358BA;color:white">
                                <h3><b>DATA PENGALAMAN EVENT'S</b></h3>
                                <hr style="background-color:#E358BA;color:white">
                                <label class="btn btn-primary" onclick="addPengalaman2('tblPengalaman2')">Tambah</label>
                                  &nbsp;<label class="btn btn-danger" onclick="delPengalaman2('tblPengalaman2')">Hapus</label>

                                <table class="table" id="tblPengalaman2">
                                  <tbody>
                                	<tr>
                                	  <th></th>
                                	  <th>Nama Event's</th>
                                	  <th>Tahun</th>
                                	</tr>
                                	<tr>
                                	  <td><input type="checkbox" name="chk2"/></td>
                                	  <td>
                                		<input name="dataPengalaman2[0][namaEvent2]" placeholder = "Ketikkan Nama Events..." required
                                			 class="form-control" value="" type="text" required>
                                	  </td>
                                	  <td>
                                		<input name="dataPengalaman2[0][tahunEvent2]" placeholder="Ketikkan Tahun..." required
                                					 class="form-control" value="" type="number" required>
                                	  </td>
                                	</tr>
                                  </tbody>
                                </table>
                                <hr style="background-color:#E358BA;color:white">
                                <a href="#drivertab" data-toggle="tab" id="btndaridriver">
                                  <label class="btn btn-warning" style="color:white">Sebelumnya</label>
                                </a>
                                <a href="#mekanik1tab" data-toggle="tab" id="btnkemekanik1">
                                  <label class="btn btn-warning" style="color:white">Selanjutnya</label>
                                </a>
                              </div>
                              {{-- END Data CO Driver --}}


                              {{-- START Data Menanik1 --}}
                              <div class="tab-pane container fade" id="mekanik1tab">
                                <hr style="background-color:#E358BA;color:white">
                                <h3><b>MEKANIK 1</b></h3>
                                <hr style="background-color:#E358BA;color:white">
                                <div class="row">
                                  {{-- START Data Input Menanik1 Kolom 1 --}}
                                  <div class="col-lg-6 form-group">
                                	@if ($errors->has('email3'))
                                	  <small style="color:red">* {{$errors->first('email3')}}</small>
                                	@endif
                                	<label><b>Email</b></label>
                                	<input name="email3" placeholder="Ketikkan Email..."
                                		   class="common-input mb-30 form-control" value="{{ old('email3') }}" type="email" required>

                                	@if ($errors->has('namaLengkap3'))
                                	  <small style="color:red">* {{$errors->first('namaLengkap3')}}</small>
                                	@endif
                                	<label><b>Nama Lengkap</b></label>
                                	<input name="namaLengkap3" placeholder="Ketikkan Nama Lengkap..."
                                		  class="common-input mb-30 form-control" value="{{ old('namaLengkap3') }}" type="text" required>

                                	@if ($errors->has('nama3'))
                                	  <small style="color:red">* {{$errors->first('nama3')}}</small>
                                	@endif
                                	<label><b>Nama Panggilan</b></label>
                                	<input name="nama3" placeholder="Ketikkan Nama Panggilan..."
                                		   class="common-input mb-30 form-control" value="{{ old('nama3') }}" type="text" required>

                                	 @if ($errors->has('golonganDarah3'))
                                	   <small style="color:red">* {{$errors->first('golonganDarah3')}}</small>
                                	 @endif
                                	 <label><b>Golongan Darah</b></label>
                                   <select style="height:50px;border-radius: 0" name="golonganDarah3" class="common-input mb-30 form-control" required>
                                   		<option value="" >-- Pilih --</option>
                                      <option value="" >-- Pilih --</option>
                                   		<option value="A">A</option>
                                      <option value="A-">A-</option>
                                      <option value="A+">A+</option>
                                   		<option value="B">B</option>
                                      <option value="B-">B-</option>
                                      <option value="B+">B+</option>
                                   		<option value="O">O</option>
                                   		<option value="O-">O-</option>
                                   		<option value="O+">O+</option>
                                   		<option value="AB">AB</option>
                                      <option value="AB-">AB-</option>
                                      <option value="AB+">AB+</option>
                                   	</select>

                                	  @if ($errors->has('tempatLahir3'))
                                		<small style="color:red">* {{$errors->first('tempatLahir3')}}</small>
                                	  @endif
                                	  <label><b>Tempat Lahir</b></label>
                                	  <input name="tempatLahir3" placeholder="Ketikkan Tempat Lahir..."
                                			 class="common-input mb-30 form-control" value="{{ old('tempatLahir3') }}" type="text" required>

                                	 @if ($errors->has('noTelp3'))
                                	   <small style="color:red">* {{$errors->first('noTelp3')}}</small>
                                	 @endif
                                	 <label><b>No Telepone</b></label>
                                	 <input name="noTelp3" placeholder="Ketikkan No Telepone..." maxlength="13"
                                			class="common-input mb-30 form-control" value="{{ old('noTelp3') }}" type="number" required>

                                	  @if ($errors->has('alamat3'))
                                		<small style="color:red">* {{$errors->first('alamat3')}}</small>
                                	  @endif
                                	  <label><b>Alamat</b></label>
                                	  <textarea rows="4" class="common-input mb-30 form-control"
                                		placeholder="Ketikkan Alamat..." name="alamat3" required>{{ old('alamat3') }}</textarea>
                                  </div>
                                  {{-- END Data Input Menanik1 Kolom 1 --}}


                                  {{-- START Data Input Menanik1 Kolom 2 --}}
                                  <div class="col-lg-6 form-group">

                                	@if ($errors->has('ukuranKemeja3'))
                                	  <small style="color:red">* {{$errors->first('ukuranKemeja3')}}</small>
                                	@endif
                                	<label><b>Ukuran Baju</b></label>
                                	<select style="height:50px;border-radius: 0" name="ukuranKemeja3" class="common-input mb-30 form-control" required>
                                		<option value="" >-- Pilih --</option>
                                		<option value="XS">XS</option>
                                		<option value="S">S</option>
                                		<option value="M">M</option>
                                		<option value="L">L</option>
                                		<option value="XL">XL</option>
                                		<option value="XXL">XXL</option>
                                		<option value="XXXL">XXXL</option>
                                	</select>

                                	@if ($errors->has('kota3'))
                                	  <small style="color:red">* {{$errors->first('kota3')}}</small>
                                	@endif
                                	<label><b>Kota</b></label>
                                	<input name="kota3" placeholder="Ketikkan Kota..."
                                		 class="common-input mb-30 form-control" value="{{ old('kota3') }}" type="text" required>

                                	@if ($errors->has('noAnggotaIof3'))
                                	  <small style="color:red">* {{$errors->first('noAnggotaIof3')}}</small>
                                	@endif
                                	<label><b>No Anggota IOF</b></label>
                                	<input name="noAnggotaIof3" placeholder="Ketikkan No Anggota IOF..."
                                		  class="common-input mb-30 form-control" value="{{ old('noAnggotaIof3') }}" type="text" required>

                                	@if ($errors->has('rhesus3'))
                                	  <small style="color:red">* {{$errors->first('rhesus3')}}</small>
                                	@endif
                                	<label><b>Rhesus</b></label>
                                	<input name="rhesus3" placeholder="Ketikkan Rhesus..."
                                		   class="common-input mb-30 form-control" value="{{ old('rhesus3') }}" type="text" required>

                                   @if ($errors->has('tanggalLahir3'))
                                	 <small style="color:red">* {{$errors->first('tanggalLahir3')}}</small>
                                   @endif
                                   <label><b>Tanggal Lahir</b></label>
                                   <input name="tanggalLahir3" placeholder="YYYY-MM-DD"
                                		  class="common-input mb-30 form-control datepicker1" value="{{ old('tanggalLahir3') }}" type="text" required>

                                   @if ($errors->has('kodePos3'))
                                	  <small style="color:red">* {{$errors->first('kodePos3')}}</small>
                                   @endif
                                   <label><b>Kode Pos</b></label>
                                   <input name="kodePos3" placeholder="Ketikkan Kode Pos..." maxlength="5"
                                		   class="common-input mb-30 form-control" value="{{ old('kodePos3') }}" type="number" required>

                                   @if ($errors->has('nomorSim3'))
                                	 <small style="color:red">* {{$errors->first('nomorSim3')}}</small>
                                   @endif
                                   <label><b>No SIM</b></label>
                                   <input name="nomorSim3" placeholder="Ketikkan No SIM..."
                                		  class="common-input mb-30 form-control" value="{{ old('nomorSim3') }}" type="text" required>
                                  {{-- END Data Input Menanik1 Kolom 2 --}}
                                  </div>
                                </div>
                                <hr style="background-color:#E358BA;color:white">
                                <h3><b>DATA PENGALAMAN EVENT'S</b></h3>
                                <hr style="background-color:#E358BA;color:white">
                                <label class="btn btn-primary" onclick="addPengalaman3('tblPengalaman3')">Tambah</label>
                                  &nbsp;<label class="btn btn-danger" onclick="delPengalaman3('tblPengalaman3')">Hapus</label>

                                <table class="table" id="tblPengalaman3">
                                  <tbody>
                                	<tr>
                                	  <th></th>
                                	  <th>Nama Event's</th>
                                	  <th>Tahun</th>
                                	</tr>
                                	<tr>
                                	  <td><input type="checkbox" name="chk3"/></td>
                                	  <td>
                                		<input name="dataPengalaman3[0][namaEvent3]" placeholder = "Ketikkan Nama Events..." required
                                			 class="form-control" value="" type="text" required>
                                	  </td>
                                	  <td>
                                		<input name="dataPengalaman3[0][tahunEvent3]" placeholder="Ketikkan Tahun..." required
                                					 class="form-control" value="" type="number" required>
                                	  </td>
                                	</tr>
                                  </tbody>
                                </table>
                                <hr style="background-color:#E358BA;color:white">
                                <a href="#drivercotab" data-toggle="tab" id="btndaricodriver">
                                  <label class="btn btn-warning" style="color:white">Sebelumnya</label>
                                </a>
                                <a href="#mekanik2tab" data-toggle="tab" id="btnkemekanik2">
                                  <label class="btn btn-warning" style="color:white">Selanjutnya</label>
                                </a>
                              </div>
                              {{-- END Data Menanik1 --}}


                              {{-- START Data Menanik2 --}}
                              <div class="tab-pane container fade" id="mekanik2tab">
                                <hr style="background-color:#E358BA;color:white">
                                <h3><b>MEKANIK 2</b></h3>
                                <hr style="background-color:#E358BA;color:white">
                                <div class="row">
                                  {{-- START Data Input Menanik2 Kolom 1 --}}
                                  <div class="col-lg-6 form-group">
                                	@if ($errors->has('email4'))
                                	  <small style="color:red">* {{$errors->first('email4')}}</small>
                                	@endif
                                	<label><b>Email</b></label>
                                	<input name="email4" placeholder="Ketikkan Email..."
                                		   class="common-input mb-30 form-control" value="{{ old('email4') }}" type="email" required>

                                	@if ($errors->has('namaLengkap4'))
                                	  <small style="color:red">* {{$errors->first('namaLengkap4')}}</small>
                                	@endif
                                	<label><b>Nama Lengkap</b></label>
                                	<input name="namaLengkap4" placeholder="Ketikkan Nama Lengkap..."
                                		  class="common-input mb-30 form-control" value="{{ old('namaLengkap4') }}" type="text" required>

                                	@if ($errors->has('nama4'))
                                	  <small style="color:red">* {{$errors->first('nama4')}}</small>
                                	@endif
                                	<label><b>Nama Panggilan</b></label>
                                	<input name="nama4" placeholder="Ketikkan Nama Panggilan..."
                                		   class="common-input mb-30 form-control" value="{{ old('nama4') }}" type="text" required>

                                	 @if ($errors->has('golonganDarah4'))
                                	   <small style="color:red">* {{$errors->first('golonganDarah4')}}</small>
                                	 @endif
                                	 <label><b>Golongan Darah</b></label>
                                   <select style="height:50px;border-radius: 0" name="golonganDarah4" class="common-input mb-30 form-control" required>
                                   		<option value="" >-- Pilih --</option>
                                      <option value="" >-- Pilih --</option>
                                   		<option value="A">A</option>
                                      <option value="A-">A-</option>
                                      <option value="A+">A+</option>
                                   		<option value="B">B</option>
                                      <option value="B-">B-</option>
                                      <option value="B+">B+</option>
                                   		<option value="O">O</option>
                                   		<option value="O-">O-</option>
                                   		<option value="O+">O+</option>
                                   		<option value="AB">AB</option>
                                      <option value="AB-">AB-</option>
                                      <option value="AB+">AB+</option>
                                   	</select>

                                	  @if ($errors->has('tempatLahir4'))
                                		<small style="color:red">* {{$errors->first('tempatLahir4')}}</small>
                                	  @endif
                                	  <label><b>Tempat Lahir</b></label>
                                	  <input name="tempatLahir4" placeholder="Ketikkan Tempat Lahir..."
                                			 class="common-input mb-30 form-control" value="{{ old('tempatLahir4') }}" type="text" required>

                                	 @if ($errors->has('noTelp4'))
                                	   <small style="color:red">* {{$errors->first('noTelp4')}}</small>
                                	 @endif
                                	 <label><b>No Telepone</b></label>
                                	 <input name="noTelp4" placeholder="Ketikkan No Telepone..." maxlength="13"
                                			class="common-input mb-30 form-control" value="{{ old('noTelp4') }}" type="number" required>

                                	  @if ($errors->has('alamat4'))
                                		<small style="color:red">* {{$errors->first('alamat4')}}</small>
                                	  @endif
                                	  <label><b>Alamat</b></label>
                                	  <textarea rows="4" class="common-input mb-30 form-control"
                                		placeholder="Ketikkan Alamat..." name="alamat4" required>{{ old('alamat4') }}</textarea>
                                  </div>
                                  {{-- END Data Input Menanik2 Kolom 1 --}}


                                  {{-- START Data Input Menanik2 Kolom 2 --}}
                                  <div class="col-lg-6 form-group">

                                	@if ($errors->has('ukuranKemeja4'))
                                	  <small style="color:red">* {{$errors->first('ukuranKemeja4')}}</small>
                                	@endif
                                	<label><b>Ukuran Baju</b></label>
                                	<select style="height:50px;border-radius: 0" name="ukuranKemeja4" class="common-input mb-30 form-control" required>
                                		<option value="" >-- Pilih --</option>
                                		<option value="XS">XS</option>
                                		<option value="S">S</option>
                                		<option value="M">M</option>
                                		<option value="L">L</option>
                                		<option value="XL">XL</option>
                                		<option value="XXL">XXL</option>
                                		<option value="XXXL">XXXL</option>
                                	</select>

                                	@if ($errors->has('kota4'))
                                	  <small style="color:red">* {{$errors->first('kota4')}}</small>
                                	@endif
                                	<label><b>Kota</b></label>
                                	<input name="kota4" placeholder="Ketikkan Kota..."
                                		 class="common-input mb-30 form-control" value="{{ old('kota4') }}" type="text" required>

                                	@if ($errors->has('noAnggotaIof4'))
                                	  <small style="color:red">* {{$errors->first('noAnggotaIof4')}}</small>
                                	@endif
                                	<label><b>No Anggota IOF</b></label>
                                	<input name="noAnggotaIof4" placeholder="Ketikkan No Anggota IOF..."
                                		  class="common-input mb-30 form-control" value="{{ old('noAnggotaIof4') }}" type="text" required>

                                	@if ($errors->has('rhesus4'))
                                	  <small style="color:red">* {{$errors->first('rhesus4')}}</small>
                                	@endif
                                	<label><b>Rhesus</b></label>
                                	<input name="rhesus4" placeholder="Ketikkan Rhesus..."
                                		   class="common-input mb-30 form-control" value="{{ old('rhesus4') }}" type="text" required>

                                   @if ($errors->has('tanggalLahir4'))
                                	 <small style="color:red">* {{$errors->first('tanggalLahir4')}}</small>
                                   @endif
                                   <label><b>Tanggal Lahir</b></label>
                                   <input name="tanggalLahir4" placeholder="YYYY-MM-DD"
                                		  class="common-input mb-30 form-control datepicker1" value="{{ old('tanggalLahir4') }}" type="text" required>

                                   @if ($errors->has('kodePos4'))
                                	  <small style="color:red">* {{$errors->first('kodePos4')}}</small>
                                   @endif
                                   <label><b>Kode Pos</b></label>
                                   <input name="kodePos4" placeholder="Ketikkan Kode Pos..." maxlength="5"
                                		   class="common-input mb-30 form-control" value="{{ old('kodePos4') }}" type="number" required>

                                   @if ($errors->has('nomorSim4'))
                                	 <small style="color:red">* {{$errors->first('nomorSim4')}}</small>
                                   @endif
                                   <label><b>No SIM</b></label>
                                   <input name="nomorSim4" placeholder="Ketikkan No SIM..."
                                		  class="common-input mb-30 form-control" value="{{ old('nomorSim4') }}" type="text" required>
                                  {{-- END Data Input Menanik2 Kolom 2 --}}
                                  </div>
                                </div>
                                <hr style="background-color:#E358BA;color:white">
                                <h3><b>DATA PENGALAMAN EVENT'S</b></h3>
                                <hr style="background-color:#E358BA;color:white">
                                <label class="btn btn-primary" onclick="addPengalaman4('tblPengalaman4')">Tambah</label>
                                  &nbsp;<label class="btn btn-danger" onclick="delPengalaman4('tblPengalaman4')">Hapus</label>

                                <table class="table" id="tblPengalaman4">
                                  <tbody>
                                	<tr>
                                	  <th></th>
                                	  <th>Nama Event's</th>
                                	  <th>Tahun</th>
                                	</tr>
                                	<tr>
                                	  <td><input type="checkbox" name="chk4"/></td>
                                	  <td>
                                		<input name="dataPengalaman4[0][namaEvent4]" placeholder = "Ketikkan Nama Events..." required
                                			 class="form-control" value="" type="text" required>
                                	  </td>
                                	  <td>
                                		<input name="dataPengalaman4[0][tahunEvent4]" placeholder="Ketikkan Tahun..." required
                                					 class="form-control" value="" type="number" required>
                                	  </td>
                                	</tr>
                                  </tbody>
                                </table>
                                <hr style="background-color:#E358BA;color:white">
                                <a href="#mekanik1tab" data-toggle="tab" id="btndarimekanik1">
                                  <label class="btn btn-warning" style="color:white">Sebelumnya</label>
                                </a>
                                <a href="#kendaraantab" data-toggle="tab" id="btnkekendaraan">
                                  <label class="btn btn-warning" style="color:white">Selanjutnya</label>
                                </a>
                              </div>
                              {{-- END Data Menanik2 --}}

                              {{-- START Data Kendaraan --}}
                              <div class="tab-pane container fade" id="kendaraantab">
                                <hr style="background-color:#E358BA;color:white">
                                <h3><b>KENDARAAN</b></h3>
                                <hr style="background-color:#E358BA;color:white">
                                <div class="row">
                                  {{-- START Data Input Kendaraan Kolom 1 --}}
                                  <div class="col-lg-6 form-group">
                                	@if ($errors->has('merek'))
                                	  <small style="color:red">* {{$errors->first('merek')}}</small>
                                	@endif
                                	<label><b>Merek</b></label>
                                	<input name="merek" placeholder="Ketikkan Merek..."
                                		   class="common-input mb-30 form-control" value="{{ old('merek') }}" type="text" required>

                                	@if ($errors->has('noPolisi'))
                                	  <small style="color:red">* {{$errors->first('noPolisi')}}</small>
                                	@endif
                                	<label><b>No Polisi</b></label>
                                	<input name="noPolisi" placeholder="Ketikkan No Polisi..."
                                		  class="common-input mb-30 form-control" value="{{ old('noPolisi') }}" type="text" required>

                                	@if ($errors->has('typeMesin'))
                                	  <small style="color:red">* {{$errors->first('typeMesin')}}</small>
                                	@endif
                                	<label><b>Type Mesin</b></label>
                                	<input name="typeMesin" placeholder="Ketikkan Type Mesin..."
                                		   class="common-input mb-30 form-control" value="{{ old('typeMesin') }}" type="text" required>

                                	 @if ($errors->has('cc'))
                                	   <small style="color:red">* {{$errors->first('cc')}}</small>
                                	 @endif
                                	 <label><b>CC</b></label>
                                	 <input name="cc" placeholder="Ketikkan CC..."
                                			class="common-input mb-30 form-control" value="{{ old('cc') }}" type="text" required>

                                	  @if ($errors->has('merekBan'))
                                		<small style="color:red">* {{$errors->first('merekBan')}}</small>
                                	  @endif
                                	  <label><b>Merek Ban</b></label>
                                	  <input name="merekBan" placeholder="Ketikkan Merek Ban..."
                                			 class="common-input mb-30 form-control" value="{{ old('merekBan') }}" type="text" required>

                                	 @if ($errors->has('ukuranBan'))
                                	   <small style="color:red">* {{$errors->first('ukuranBan')}}</small>
                                	 @endif
                                	 <label><b>Ukuran Ban</b></label>
                                	 <input name="ukuranBan" placeholder="Ketikkan Ukuran Ban..."
                                			class="common-input mb-30 form-control" value="{{ old('ukuranBan') }}" type="text" required>

                                	  @if ($errors->has('rollbar'))
                                		<small style="color:red">* {{$errors->first('rollbar')}}</small>
                                	  @endif
                                	  <label><b>Rollbar</b></label>
                                    <input name="rollbar" placeholder="Ketikkan Rollbar..."
                                 			class="common-input mb-30 form-control" value="{{ old('rollbar') }}" type="text" required>

                                    @if ($errors->has('cargoBarrier'))
                                  	  <small style="color:red">* {{$errors->first('cargoBarrier')}}</small>
                                  	@endif
                                  	<label><b>Cargo Barrier</b></label>
                                  	<input name="cargoBarrier" placeholder="Ketikkan Cargo Barrier..."
                                  		 class="common-input mb-30 form-control" value="{{ old('cargoBarrier') }}" type="text" required>

                                  	@if ($errors->has('sideBar'))
                                  	  <small style="color:red">* {{$errors->first('sideBar')}}</small>
                                  	@endif
                                  	<label><b>Side Bar</b></label>
                                  	<input name="sideBar" placeholder="Ketikkan Side Bar..."
                                  		  class="common-input mb-30 form-control" value="{{ old('sideBar') }}" type="text" required>

                                  	@if ($errors->has('safetyBelt'))
                                  	  <small style="color:red">* {{$errors->first('safetyBelt')}}</small>
                                  	@endif
                                  	<label><b>Safety Belt</b></label>
                                  	<input name="safetyBelt" placeholder="Ketikkan Safety Belt..."
                                  		   class="common-input mb-30 form-control" value="{{ old('safetyBelt') }}" type="text" required>

                                     @if ($errors->has('type'))
                                  	 <small style="color:red">* {{$errors->first('type')}}</small>
                                     @endif
                                     <label><b>Type</b></label>
                                     <input name="type" placeholder="Ketikkan Type..."
                                  		  class="common-input mb-30 form-control" value="{{ old('type') }}" type="text" required>

                                     @if ($errors->has('tahun'))
                                  	  <small style="color:red">* {{$errors->first('tahun')}}</small>
                                     @endif
                                     <label><b>Tahun</b></label>
                                     <input name="tahun" placeholder="Ketikkan Tahun..." maxlength="5"
                                  		   class="common-input mb-30 form-control" value="{{ old('tahun') }}" type="text" required>

                                     @if ($errors->has('warna'))
                                  	 <small style="color:red">* {{$errors->first('warna')}}</small>
                                     @endif
                                     <label><b>Warna</b></label>
                                     <input name="warna" placeholder="Ketikkan Warna..."
                                  		  class="common-input mb-30 form-control" value="{{ old('warna') }}" type="text" required>
                                  </div>
                                  {{-- END Data Input Kendaraan Kolom 1 --}}


                                  {{-- START Data Input Kendaraan Kolom 2 --}}
                                  <div class="col-lg-6 form-group">

                                   @if ($errors->has('snorkel'))
                                	 <small style="color:red">* {{$errors->first('snorkel')}}</small>
                                   @endif
                                   <label><b>Snorkel</b></label>
                                   <input name="Snorkel" placeholder="Ketikkan Snorkel..."
                                		  class="common-input mb-30 form-control" value="{{ old('snorkel') }}" type="text" required>

                                   @if ($errors->has('engineCutOff'))
                                 	 <small style="color:red">* {{$errors->first('engineCutOff')}}</small>
                                   @endif
                                   <label><b>Engine Cut Off</b></label>
                                   <input name="engineCutOff" placeholder="Ketikkan Engine Cut Off..."
                                 		  class="common-input mb-30 form-control" value="{{ old('engineCutOff') }}" type="text" required>

                                  @if ($errors->has('gps'))
                               	  <small style="color:red">* {{$errors->first('gps')}}</small>
                                  @endif
                                  <label><b>GPS</b></label>
                                  <input name="gps" placeholder="Ketikkan GPS..."
                               		  class="common-input mb-30 form-control" value="{{ old('gps') }}" type="text" required>

                                  @if ($errors->has('radioKomunikasi'))
                                	 <small style="color:red">* {{$errors->first('radioKomunikasi')}}</small>
                                  @endif
                                  <label><b>Radio Komunikasi</b></label>
                                  <input name="radioKomunikasi" placeholder="Ketikkan Radio Komunikasi..."
                                		  class="common-input mb-30 form-control" value="{{ old('radioKomunikasi') }}" type="text" required>

                                  @if ($errors->has('winchDepanMerek'))
                               	  <small style="color:red">* {{$errors->first('winchDepanMerek')}}</small>
                                  @endif
                                  <label><b>Winch Depan Merek</b></label>
                                  <input name="winchDepanMerek" placeholder="Ketikkan Winch Depan Merek..."
                               		  class="common-input mb-30 form-control" value="{{ old('winchDepanMerek') }}" type="text" required>

                                  @if ($errors->has('winchDepanType'))
                                	 <small style="color:red">* {{$errors->first('winchDepanType')}}</small>
                                  @endif
                                  <label><b>Winch Depan Type</b></label>
                                  <input name="winchDepanType" placeholder="Ketikkan Winch Depan Type..."
                                		  class="common-input mb-30 form-control" value="{{ old('winchDepanType') }}" type="text" required>

                                 @if ($errors->has('winchBelakangMerek'))
                              	 <small style="color:red">* {{$errors->first('winchBelakangMerek')}}</small>
                                 @endif
                                 <label><b>Winch Belakang Merek</b></label>
                                 <input name="winchBelakangMerek" placeholder="Ketikkan Winch Belakang Merek..."
                              		  class="common-input mb-30 form-control" value="{{ old('winchBelakangMerek') }}" type="text" required>

                                 @if ($errors->has('winchBelakangType'))
                               	 <small style="color:red">* {{$errors->first('winchBelakangType')}}</small>
                                 @endif
                                 <label><b>Winch Belakang Type</b></label>
                                 <input name="winchBelakangType" placeholder="Ketikkan Winch Belakang Type..."
                               		  class="common-input mb-30 form-control" value="{{ old('winchBelakangType') }}" type="text" required>

                                @if ($errors->has('snatchBlock'))
                                <small style="color:red">* {{$errors->first('snatchBlock')}}</small>
                                @endif
                                <label><b>Snatch Block</b></label>
                                <input name="snatchBlock" placeholder="Ketikkan Snatch Block..."
                                   class="common-input mb-30 form-control" value="{{ old('snatchBlock') }}" type="text" required>

                                @if ($errors->has('shackle'))
                                <small style="color:red">* {{$errors->first('shackle')}}</small>
                                @endif
                                <label><b>Shackle</b></label>
                                <input name="shackle" placeholder="Ketikkan Shackle..."
                                   class="common-input mb-30 form-control" value="{{ old('shackle') }}" type="text" required>

                               @if ($errors->has('glove'))
                               <small style="color:red">* {{$errors->first('glove')}}</small>
                               @endif
                               <label><b>Glove</b></label>
                               <input name="glove" placeholder="Ketikkan Glove..."
                                 class="common-input mb-30 form-control" value="{{ old('glove') }}" type="text" required>

                               @if ($errors->has('sling'))
                                <small style="color:red">* {{$errors->first('sling')}}</small>
                               @endif
                               <label><b>Sling</b></label>
                               <input name="" placeholder="Ketikkan Sling..."
                                   class="common-input mb-30 form-control" value="{{ old('sling') }}" type="text" required>
                                  {{-- END Data Input Kendaraan Kolom 2 --}}
                                  </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-5">
                                      <hr style="background-color:#E358BA;color:white">
                                      <h3><b>DATA SPEC UP KENDARAAN</b></h3>
                                      <hr style="background-color:#E358BA;color:white">
                                      <label class="btn btn-primary" onclick="addSpecUpKendaraan('tblSpecUpKendaraan')">Tambah</label>
                                        &nbsp;<label class="btn btn-danger" onclick="delSpecUpKendaraan('tblSpecUpKendaraan')">Hapus</label>

                                      <table class="table" id="tblSpecUpKendaraan">
                                        <tbody>
                                      	<tr>
                                      	  <th></th>
                                      	  <th>Nama</th>
                                      	</tr>
                                      	<tr>
                                      	  <td><input type="checkbox" name="chk5"/></td>
                                      	  <td>
                                      		<input name="dataSpecUpKendaraan[0][namaSpecUpKendaraan]" placeholder = "Ketikkan Nama Spec Up Kendaraan..." required
                                      			 class="form-control" value="" type="text" required>
                                      	  </td>
                                      	</tr>
                                        </tbody>
                                      </table>
                                    </div>

                                    <div class="col-lg-7">
                                      <hr style="background-color:#E358BA;color:white">
                                      <h3><b>DATA STRAP</b></h3>
                                      <hr style="background-color:#E358BA;color:white">
                                      <label class="btn btn-primary" onclick="addStrap('tblStrap')">Tambah</label>
                                        &nbsp;<label class="btn btn-danger" onclick="delStrap('tblStrap')">Hapus</label>

                                      <table class="table" id="tblStrap">
                                        <tbody>
                                      	<tr>
                                      	  <th></th>
                                      	  <th>Merek</th>
                                          <th>Panjang</th>
                                      	</tr>
                                      	<tr>
                                      	  <td><input type="checkbox" name="chk6"/></td>
                                      	  <td>
                                      		<input name="dataStrap[0][merekStrap]" placeholder = "Ketikkan Merek..." required
                                      			 class="form-control" value="" type="text" required>
                                      	  </td>
                                          <td>
                                      		<input name="dataStrap[0][merekPanjang]" placeholder = "Ketikkan Panjang..." required
                                      			 class="form-control" value="" type="text" required>
                                      	  </td>
                                      	</tr>
                                        </tbody>
                                      </table>
                                    </div>
                                </div>
                                <hr style="background-color:#E358BA;color:white">
                                <a href="#mekanik2tab" data-toggle="tab" id="btndarimekanik2">
                                  <label class="btn btn-warning" style="color:white">Sebelumnya</label>
                                </a>
                                <a href="#contacttab" data-toggle="tab" id="btnkecontact">
                                  <label class="btn btn-warning" style="color:white">Selanjutnya</label>
                                </a>
                              </div>
                              {{-- END Data Kendaraan --}}

                              {{-- START Data Contact --}}
                              <div class="tab-pane container fade" id="contacttab">
                                <hr style="background-color:#E358BA;color:white">
                                <h3><b>DATA EMERGENCY CONTACT</b></h3>
                                <hr style="background-color:#E358BA;color:white">

                                  <label class="btn btn-primary" style="color:white" onclick="addKeluarga('tblKeluarga')">Tambah</label>
                                    &nbsp;<label class="btn btn-danger" onclick="delKeluarga('tblKeluarga')">Hapus</label>

                                <table class="table" id="tblKeluarga">
                                  <tbody>
                                    <tr>
                                      <th></th>
                                      <th>Email</th>
                                      <th>Nama Lengkap</th>
                                      <th>Nama Panggilan</th>
                                      <th>Hubungan</th>
                                      <th>No Telepone</th>
                                      <th>No Handphone</th>
                                    </tr>
                                    <tr>
                                      <td><input type="checkbox" name="chk7"/></td>
                                      <td>
                                        <input name="dataKeluarga[0][emailKeluarga]" placeholder = "Ketikkan Email..."
                                             class="form-control" value="" type="email" required>
                                      </td>
                                      <td>
                                        <input name="dataKeluarga[0][namaLengkapKeluarga]" placeholder = "Ketikkan Nama Lengkap..."
                                             class="form-control" value="" type="text" required>
                                      </td>
                                      <td>
                                        <input name="dataKeluarga[0][namaKeluarga]" placeholder = "Ketikkan Nama Panggilan..."
                                             class="form-control" value="" type="text" required>
                                      </td>
                                      <td>
                                          <select name="dataKeluarga[0][hubunganKeluarga]" class="form-control" >
                                              <option value="" >-- Pilih --</option>
                                              <option value="AYAH">AYAH</option>
                                              <option value="IBU">IBU</option>
                                              <option value="SUAMI">SUAMI</option>
                                              <option value="ISTRI">ISTRI</option>
                                              <option value="KAKAK">KAKAK</option>
                                              <option value="ADIK">ADIK</option>
                                              <option value="ANAK">ANAK</option>
                                              <option value="LAINNYA">LAINNYA</option>
                                          </select>
                                      </td>
                                      <td>
                                        <input name="dataKeluarga[0][noTelpKeluarga]" placeholder="Ketikkan No Telp..." maxlength="13"
                                                     class="form-control" value="" type="number" required>
                                      </td>

                                      <td>
                                        <input name="dataKeluarga[0][noHpKeluarga]" placeholder="Ketikkan No Hp..." maxlength="13"
                                                     class="form-control" value="" type="number" required>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>

                                <hr style="background-color:#E358BA;color:white">
                                <a href="#kendaraantab" data-toggle="tab" id="btndarikendaraan">
                                  <label class="btn btn-warning" style="color:white">Sebelumnya</label>
                                </a>
                                <button class="btn btn-success" style="float: right;" type="submit">Register</button>
                                <br><br>
                                Keterangan yang tertulis diatas adalah yang sebenar-benarnya.<br>
                                Apabila ditemukan keterangan yang tidak sesuai, maka saya bersedia menerima sanksi diskualifikasi.
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>

                                Jakarta,                                   <?php echo date('Y'); ?>

                                Hormat saya,



                                Rp. 6.000,-


                                (………………………………………)</b>
                              </div>
                              {{-- END Data Contact --}}
                            </div>

                				</form>
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

<script type="text/javascript">
$('.datepicker1').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd',
  todayHighlight: true,
  orientation: "top"
});
</script>

<script language="javascript">

  //START TAB 1 -----------------------------------------------------------------------------------------------
  var numA=1;
  function addPengalaman1(tableID) {
    numA++;
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    var cell1 = row.insertCell(0);
    cell1.innerHTML = '<input type="checkbox" name="chk1[]"/>';
    var cell2 = row.insertCell(1);
    cell2.innerHTML = '<input type="text" name="dataPengalaman1['+numA+'][namaEvent1]" class="form-control" placeholder="Ketikkan Nama Events..." required>';
    var cell3 = row.insertCell(2);
    cell3.innerHTML = '<input type="number" name=dataPengalaman1['+numA+'][tahunEvent1]" class="form-control" value="" placeholder="Ketikkan Tahun..." required>';
  }

  function delPengalaman1(tableID) {
      try {
      var table = document.getElementById(tableID);
      var rowCount = table.rows.length;

      for(var i=0; i<rowCount; i++) {
          var row = table.rows[i];
          var chkbox = row.cells[0].childNodes[0];
          if(null != chkbox && true == chkbox.checked) {
              table.deleteRow(i);
              rowCount--;
              i--;
              numA--;
          }
      }
      }catch(e) {
          alert(e);
      }
   }
   //END TAB 1 -----------------------------------------------------------------------------------------------


   //START TAB 2 -----------------------------------------------------------------------------------------------
   var numB=1;
   function addPengalaman2(tableID) {
     numB++;
     var table = document.getElementById(tableID);
     var rowCount = table.rows.length;
     var row = table.insertRow(rowCount);
     var cell1 = row.insertCell(0);
     cell1.innerHTML = '<input type="checkbox" name="chk2[]"/>';
     var cell2 = row.insertCell(1);
     cell2.innerHTML = '<input type="text" name="dataPengalaman2['+numB+'][namaEvent2]" class="form-control" placeholder="Ketikkan Nama Events..." required>';
     var cell3 = row.insertCell(2);
     cell3.innerHTML = '<input type="number" name=dataPengalaman2['+numB+'][tahunEvent2]" class="form-control" value="" placeholder="Ketikkan Tahun..." required>';
   }

   function delPengalaman2(tableID) {
       try {
       var table = document.getElementById(tableID);
       var rowCount = table.rows.length;

       for(var i=0; i<rowCount; i++) {
           var row = table.rows[i];
           var chkbox = row.cells[0].childNodes[0];
           if(null != chkbox && true == chkbox.checked) {
               table.deleteRow(i);
               rowCount--;
               i--;
               numB--;
           }
       }
       }catch(e) {
           alert(e);
       }
    }
    //END TAB 2 -----------------------------------------------------------------------------------------------


    //START TAB 3 -----------------------------------------------------------------------------------------------
    var numC=1;
    function addPengalaman3(tableID) {
      numC++;
      var table = document.getElementById(tableID);
      var rowCount = table.rows.length;
      var row = table.insertRow(rowCount);
      var cell1 = row.insertCell(0);
      cell1.innerHTML = '<input type="checkbox" name="chk3[]"/>';
      var cell2 = row.insertCell(1);
      cell2.innerHTML = '<input type="text" name="dataPengalaman3['+numC+'][namaEvent3]" class="form-control" placeholder="Ketikkan Nama Events..." required>';
      var cell3 = row.insertCell(2);
      cell3.innerHTML = '<input type="number" name=dataPengalaman3['+numC+'][tahunEvent3]" class="form-control" value="" placeholder="Ketikkan Tahun..." required>';
    }

    function delPengalaman3(tableID) {
        try {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;

        for(var i=0; i<rowCount; i++) {
            var row = table.rows[i];
            var chkbox = row.cells[0].childNodes[0];
            if(null != chkbox && true == chkbox.checked) {
                table.deleteRow(i);
                rowCount--;
                i--;
                numC--;
            }
        }
        }catch(e) {
            alert(e);
        }
     }
     //END TAB 3 -----------------------------------------------------------------------------------------------


     //START TAB 4 -----------------------------------------------------------------------------------------------
     var numD=1;
     function addPengalaman4(tableID) {
       numD++;
       var table = document.getElementById(tableID);
       var rowCount = table.rows.length;
       var row = table.insertRow(rowCount);
       var cell1 = row.insertCell(0);
       cell1.innerHTML = '<input type="checkbox" name="chk4[]"/>';
       var cell2 = row.insertCell(1);
       cell2.innerHTML = '<input type="text" name="dataPengalaman4['+numD+'][namaEvent4]" class="form-control" placeholder="Ketikkan Nama Events..." required>';
       var cell3 = row.insertCell(2);
       cell3.innerHTML = '<input type="number" name=dataPengalaman4['+numD+'][tahunEvent4]" class="form-control" value="" placeholder="Ketikkan Tahun..." required>';
     }

     function delPengalaman4(tableID) {
         try {
         var table = document.getElementById(tableID);
         var rowCount = table.rows.length;

         for(var i=0; i<rowCount; i++) {
             var row = table.rows[i];
             var chkbox = row.cells[0].childNodes[0];
             if(null != chkbox && true == chkbox.checked) {
                 table.deleteRow(i);
                 rowCount--;
                 i--;
                 numD--;
             }
         }
         }catch(e) {
             alert(e);
         }
      }
      //END TAB 4 -----------------------------------------------------------------------------------------------


      //START TAB 5 -----------------------------------------------------------------------------------------------
      var numE=1;
      function addSpecUpKendaraan(tableID) {
        numE++;
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);
        var cell1 = row.insertCell(0);
        cell1.innerHTML = '<input type="checkbox" name="chk5[]"/>';
        var cell2 = row.insertCell(1);
        cell2.innerHTML = '<input type="text" name="dataSpecUpKendaraan['+numE+'][namaSpecUpKendaraan]" class="form-control" placeholder="Ketikkan Nama Spec Up Kendaraan..." required>';
      }

      function delSpecUpKendaraan(tableID) {
          try {
          var table = document.getElementById(tableID);
          var rowCount = table.rows.length;

          for(var i=0; i<rowCount; i++) {
              var row = table.rows[i];
              var chkbox = row.cells[0].childNodes[0];
              if(null != chkbox && true == chkbox.checked) {
                  table.deleteRow(i);
                  rowCount--;
                  i--;
                  numE--;
              }
          }
          }catch(e) {
              alert(e);
          }
       }


       var numF=1;
       function addStrap(tableID) {
         numF++;
         var table = document.getElementById(tableID);
         var rowCount = table.rows.length;
         var row = table.insertRow(rowCount);
         var cell1 = row.insertCell(0);
         cell1.innerHTML = '<input type="checkbox" name="chk6[]"/>';
         var cell2 = row.insertCell(1);
         cell2.innerHTML = '<input type="text" name="dataStrap['+numF+'][merekStrap]" class="form-control" placeholder="Ketikkan Merek..." required>';
         var cell3 = row.insertCell(2);
         cell3.innerHTML = '<input type="text" name="dataStrap['+numF+'][merekPanjang]" class="form-control" placeholder="Ketikkan Panjang..." required>';
       }

       function delStrap(tableID) {
           try {
           var table = document.getElementById(tableID);
           var rowCount = table.rows.length;

           for(var i=0; i<rowCount; i++) {
               var row = table.rows[i];
               var chkbox = row.cells[0].childNodes[0];
               if(null != chkbox && true == chkbox.checked) {
                   table.deleteRow(i);
                   rowCount--;
                   i--;
                   numF--;
               }
           }
           }catch(e) {
               alert(e);
           }
        }
       //END TAB 5 -----------------------------------------------------------------------------------------------


      //START TAB 6 -----------------------------------------------------------------------------------------------
      var numG=1;
        function addKeluarga(tableID) {
          numA++;
          var table = document.getElementById(tableID);
          var rowCount = table.rows.length;
          var row = table.insertRow(rowCount);
          var cell1 = row.insertCell(0);
          cell1.innerHTML = '<input type="checkbox" name="chk7[]"/>';
          var cell2 = row.insertCell(1);
          cell2.innerHTML = '<input type="email" name="dataKeluarga['+numG+'][emailKeluarga]" class="form-control" placeholder="Ketikkan Email...">';
          var cell3 = row.insertCell(2);
          cell3.innerHTML = '<input type="text" name="dataKeluarga['+numG+'][namaLengkapKeluarga]" class="form-control" placeholder="Ketikkan Nama Lengkap...">';
          var cell4 = row.insertCell(3);
          cell4.innerHTML = '<input type="text" name="dataKeluarga['+numG+'][namaKeluarga]" class="form-control" placeholder="Ketikkan Nama Panggilan...">';
          var cell5 = row.insertCell(4);
          cell5.innerHTML = '<select style="height:50px;border-radius: 0" name=dataKeluarga['+numG+'][hubunganKeluarga]" class="form-control"><option value="" >-- Pilih --</option><option value="AYAH">AYAH</option><option value="IBU">IBU</option><option value="SUAMI">SUAMI</option><option value="ISTRI">ISTRI</option><option value="KAKAK">KAKAK</option><option value="ADIK">ADIK</option><option value="ANAK">ANAK</option><option value="LAINNYA">LAINNYA</option></select>';
          var cell6 = row.insertCell(5);
          cell6.innerHTML = '<input type="number" name=dataKeluarga['+numG+'][noTelpKeluarga]" maxlength="13" class="form-control" value="" placeholder="Ketikkan No Telp...">';
          var cell7 = row.insertCell(6);
          cell7.innerHTML = '<input type="number" name=dataKeluarga['+numG+'][noHpKeluarga]"  maxlength="13" class="form-control" value="" placeholder="Ketikkan No Hp...">';
        }

        function delKeluarga(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;

            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                    numG--;
                }
            }
            }catch(e) {
                alert(e);
            }
        }
        //END TAB 6 -----------------------------------------------------------------------------------------------


</script>

<script language="javascript">
    // START ONCLICK BUTTON KE TAB SELANJUTNYA
    $('#btnkecodriver').click(function(){
      $('a#tab_codriver').attr('class','nav-link active');
      $('a#tab_driver').attr('class','nav-link');
      $('div#drivercotab').attr('class','tab-pane container active');
      $('div#drivertab').attr('class','tab-pane container fade');
    });

    $('#btnkemekanik1').click(function(){
      $('a#tab_mekanik1').attr('class','nav-link active');
      $('a#tab_codriver').attr('class','nav-link');
      $('div#mekanik1tab').attr('class','tab-pane container active');
      $('div#drivercotab').attr('class','tab-pane container fade');
    });

    $('#btnkemekanik2').click(function(){
      $('a#tab_mekanik2').attr('class','nav-link active');
      $('a#tab_mekanik1').attr('class','nav-link');
      $('div#mekanik2tab').attr('class','tab-pane container active');
      $('div#mekanik1tab').attr('class','tab-pane container fade');
    });

    $('#btnkekendaraan').click(function(){
      $('a#tab_kendaraan').attr('class','nav-link active');
      $('a#tab_mekanik2').attr('class','nav-link');
      $('div#kendaraantab').attr('class','tab-pane container active');
      $('div#mekanik2tab').attr('class','tab-pane container fade');
    });

    $('#btnkecontact').click(function(){
      $('a#tab_contact').attr('class','nav-link active');
      $('a#tab_kendaraan').attr('class','nav-link');
      $('div#contacttab').attr('class','tab-pane container active');
      $('div#kendaraantab').attr('class','tab-pane container fade');
    });
    // END ONCLICK BUTTON KE TAB SELANJUTNYA


    // START ONCLICK BUTTON KE TAB SEBELUMNYA
    $('#btndaridriver').click(function(){
      $('a#tab_codriver').attr('class','nav-link');
      $('a#tab_driver').attr('class','nav-link active');
      $('div#drivercotab').attr('class','tab-pane container fade');
      $('div#drivertab').attr('class','tab-pane container active');
    });

    $('#btndaricodriver').click(function(){
      $('a#tab_mekanik1').attr('class','nav-link');
      $('a#tab_codriver').attr('class','nav-link active');
      $('div#mekanik1tab').attr('class','tab-pane container fade');
      $('div#drivercotab').attr('class','tab-pane container active');
    });

    $('#btndarimekanik1').click(function(){
      $('a#tab_mekanik2').attr('class','nav-link');
      $('a#tab_mekanik1').attr('class','nav-link active');
      $('div#mekanik2tab').attr('class','tab-pane container fade');
      $('div#mekanik1tab').attr('class','tab-pane container active');
    });

    $('#btndarimekanik2').click(function(){
      $('a#tab_kendaraan').attr('class','nav-link');
      $('a#tab_mekanik2').attr('class','nav-link active');
      $('div#kendaraantab').attr('class','tab-pane container fade');
      $('div#mekanik2tab').attr('class','tab-pane container active');
    });

    $('#btndarikendaraan').click(function(){
      $('a#tab_contact').attr('class','nav-link');
      $('a#tab_kendaraan').attr('class','nav-link active');
      $('div#contacttab').attr('class','tab-pane container fade');
      $('div#kendaraantab').attr('class','tab-pane container active');
    });
    // END ONCLICK BUTTON KE TAB SEBELUMNYA
</script>


@endsection
