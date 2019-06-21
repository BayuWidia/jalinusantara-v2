@extends('backend.master.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>FORM KELOLA REGISTRASI</h2>
    </div>
    <div class="row clearfix">
        <div class="col-md-12">
          @if(Session::has('messagefail'))
          <div class="alert bg-pink alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4><i class="icon fa fa-ban"></i> Oops, terjadi kesalahan!</h4>
              <p>{{ Session::get('messagefail') }}</p>
            </div>
          @endif
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-orange">
                  <h2>
                      Edit Registrasi Events Jalinusantara
                  </h2>
                </div>
                <div class="body">
                  <form action="{{route('registrasi.update')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="media">
                                <div class="media-body">
                                    <h4 class="media-heading">Nama Events : {{$dataEvents[0]->judul_event}}</h4>
                                    <hr>
                                    <div class="row">
                                      <div class="col-sm-12">
                                        <h4 class="media-heading">Nomor Registrasi : {{$editRegistrasi->no_registrasi}} -
                                          @if($editRegistrasi->flag_approve == 1)
                                            <span class="badge bg-green">
                                              Sudah Diapprove
                                            </span>
                                          @else
                                            <span class="badge bg-red">
                                              Belum Diapprove
                                            </span>
                                          @endif
                                        </h4>
                                        <hr>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <p><b><h5>DRIVER</h5></b></p>
                                        <hr>
                                        <p>Email : <b>{{$editRegistrasi->email}}</b></p>
                                        <p>Nama Lengkap : <b>{{$editRegistrasi->nama_lengkap_driver}}</b></p>
                                        <p>Nama Panggilan : <b>{{$editRegistrasi->nama_driver}}</b></p>
                                        <p>Golongan Darah : <b>{{$editRegistrasi->golongan_darah_driver}}</b></p>
                                        <p>TTL : <b>{{$editRegistrasi->tmp_lahir_driver}}</b></p>
                                        <p>Ukuran Kemeja : <b>{{$editRegistrasi->ukuran_kemeja_driver}}</b></p>
                                        <p>Alamat : <b>{{$editRegistrasi->alamat_driver}}</b></p>
                                        <p>Kota : <b>{{$editRegistrasi->kota_driver}}</b></p>
                                        <p>No Anggota IOF : <b>{{$editRegistrasi->no_anggota_iof}}</b></p>
                                        <p>Rhesus : <b>{{$editRegistrasi->rhesus}}</b></p>
                                        <p>Tgl Lahir : <b>{{$editRegistrasi->tgl_lhr_driver}}</b></p>
                                        <p>Kode Pos : <b>{{$editRegistrasi->kode_pos}}</b></p>
                                        <p>No SIM : <b>{{$editRegistrasi->no_sim_driver}}</b></p>
                                        <p>Pengalaman Event's : <b>{{$editRegistrasi->pengalaman_event_driver}}</b></p>
                                        <p>No Telp : <b>{{$editRegistrasi->no_telp_driver}}</b></p>
                                      </div>
                                      <div class="col-sm-6">
                                        <p><b><h5>CO DRIVER</h5></b></p>
                                        <hr>
                                        <p>Email : <b>{{$editRegistrasi->email_co}}</b></p>
                                        <p>Nama Lengkap : <b>{{$editRegistrasi->nama_lengkap_co_driver}}</b></p>
                                        <p>Nama Panggilan : <b>{{$editRegistrasi->nama_co_driver}}</b></p>
                                        <p>Golongan Darah : <b>{{$editRegistrasi->golongan_darah_co_driver}}</b></p>
                                        <p>TTL : <b>{{$editRegistrasi->tmp_lahir_co_driver}}</b></p>
                                        <p>Ukuran Kemeja : <b>{{$editRegistrasi->ukuran_kemeja_co_driver}}</b></p>
                                        <p>Alamat : <b>{{$editRegistrasi->alamat_co_driver}}</b></p>
                                        <p>Kota : <b>{{$editRegistrasi->kota_co_driver}}</b></p>
                                        <p>No Anggota IOF : <b>{{$editRegistrasi->no_anggota_iof_co}}</b></p>
                                        <p>Rhesus : <b>{{$editRegistrasi->rhesus_co}}</b></p>
                                        <p>Tgl Lahir : <b>{{$editRegistrasi->tgl_lhr_co_driver}}</b></p>
                                        <p>Kode Pos : <b>{{$editRegistrasi->kode_pos_co}}</b></p>
                                        <p>No SIM : <b>{{$editRegistrasi->no_sim_co_driver}}</b></p>
                                        <p>Pengalaman Event's : <b>{{$editRegistrasi->pengalaman_event_co_driver}}</b></p>
                                        <p>No Telp : <b>{{$editRegistrasi->no_telp_co_driver}}</b></p>
                                      </div>
                                    </div>
                                    <hr>
                                    @if(count($getDataMekanik) != 0)
                                    <div class="row">
                                      <div class="col-sm-6">
                                    	<p><b><h5>MEKANIK 1</h5></b></p>
                                        <hr>
                                    	<p>Email : <b>{{$getDataMekanik[0]->email}}</b></p>
                                    	<p>Nama Lengkap : <b>{{$getDataMekanik[0]->nama_lengkap_mekanik}}</b></p>
                                    	<p>Nama Panggilan : <b>{{$getDataMekanik[0]->nama_mekanik}}</b></p>
                                    	<p>Golongan Darah : <b>{{$getDataMekanik[0]->golongan_darah_mekanik}}</b></p>
                                    	<p>TTL : <b>{{$getDataMekanik[0]->tmp_lahir_mekanik}}</b></p>
                                    	<p>Ukuran Kemeja : <b>{{$getDataMekanik[0]->ukuran_kemeja_mekanik}}</b></p>
                                    	<p>Alamat : <b>{{$getDataMekanik[0]->alamat_mekanik}}</b></p>
                                    	<p>Kota : <b>{{$getDataMekanik[0]->kota_mekanik}}</b></p>
                                    	<p>No Anggota IOF : <b>{{$getDataMekanik[0]->no_anggota_iof}}</b></p>
                                    	<p>Rhesus : <b>{{$getDataMekanik[0]->rhesus}}</b></p>
                                    	<p>Tgl Lahir : <b>{{$getDataMekanik[0]->tgl_lhr_mekanik}}</b></p>
                                    	<p>Kode Pos : <b>{{$getDataMekanik[0]->kode_pos}}</b></p>
                                    	<p>No SIM : <b>{{$getDataMekanik[0]->no_sim_mekanik}}</b></p>
                                    	<p>Pengalaman Event's : <b>{{$getDataMekanik[0]->pengalaman_event_mekanik}}</b></p>
                                    	<p>No Telp : <b>{{$getDataMekanik[0]->no_telp_mekanik}}</b></p>
                                      </div>
                                      <div class="col-sm-6">
                                    	<p><b><h5>MEKANIK 2</h5></b></p>
                                        <hr>
                                    	<p>Email : <b>{{$getDataMekanik[1]->email}}</b></p>
                                    	<p>Nama Lengkap : <b>{{$getDataMekanik[1]->nama_lengkap_mekanik}}</b></p>
                                    	<p>Nama Panggilan : <b>{{$getDataMekanik[1]->nama_mekanik}}</b></p>
                                    	<p>Golongan Darah : <b>{{$getDataMekanik[1]->golongan_darah_mekanik}}</b></p>
                                    	<p>TTL : <b>{{$getDataMekanik[1]->tmp_lahir_mekanik}}</b></p>
                                    	<p>Ukuran Kemeja : <b>{{$getDataMekanik[1]->ukuran_kemeja_mekanik}}</b></p>
                                    	<p>Alamat : <b>{{$getDataMekanik[1]->alamat_mekanik}}</b></p>
                                    	<p>Kota : <b>{{$getDataMekanik[1]->kota_mekanik}}</b></p>
                                    	<p>No Anggota IOF : <b>{{$getDataMekanik[1]->no_anggota_iof}}</b></p>
                                    	<p>Rhesus : <b>{{$getDataMekanik[1]->rhesus}}</b></p>
                                    	<p>Tgl Lahir : <b>{{$getDataMekanik[1]->tgl_lhr_mekanik}}</b></p>
                                    	<p>Kode Pos : <b>{{$getDataMekanik[1]->kode_pos}}</b></p>
                                    	<p>No SIM : <b>{{$getDataMekanik[1]->no_sim_mekanik}}</b></p>
                                    	<p>Pengalaman Event's : <b>{{$getDataMekanik[1]->pengalaman_event_mekanik}}</b></p>
                                    	<p>No Telp : <b>{{$getDataMekanik[1]->no_telp_mekanik}}</b></p>
                                      </div>
                                    </div>
                                    @endif
                                    @if(count($getDataKendaraan) != 0)
                                    <hr>
                                    <p><b><h5>DATA KENDARAAN</h5></b></p>
                                    <hr>
                                    <div class="row">
                                      <div class="col-sm-6">
                                    	<p>Merek : <b>{{$getDataKendaraan[0]->merek}}</b></p>
                                    	<p>No Polisi : <b>{{$getDataKendaraan[0]->no_polisi}}</b></p>
                                    	<p>Type Mesin : <b>{{$getDataKendaraan[0]->type_mesin}}</b></p>
                                    	<p>CC : <b>{{$getDataKendaraan[0]->cc}}</b></p>
                                    	<p>Merek Ban : <b>{{$getDataKendaraan[0]->merek_ban}}</b></p>
                                    	<p>Ukuran Ban : <b>{{$getDataKendaraan[0]->ukuran_ban}}</b></p>
                                    	<p>Rollban : <b>{{$getDataKendaraan[0]->rollbar}}</b></p>
                                    	<p>Cargo Barrier : <b>{{$getDataKendaraan[0]->cargo_barrier}}</b></p>
                                    	<p>Side Bar : <b>{{$getDataKendaraan[0]->side_bar}}</b></p>
                                    	<p>Safety Belt : <b>{{$getDataKendaraan[0]->safety_belt}}</b></p>
                                    	<p>Spec Up Kendaraan : <b>{{$getDataKendaraan[0]->spec_up_kendaraan}}</b></p>
                                    	<p>Type : <b>{{$getDataKendaraan[0]->type}}</b></p>
                                    	<p>Tahun : <b>{{$getDataKendaraan[0]->tahun}}</b></p>
                                    	<p>Warna : <b>{{$getDataKendaraan[0]->warna}}</b></p>
                                      </div>
                                      <div class="col-sm-6">
                                    	<p>Snorkel : <b>{{$getDataKendaraan[0]->snorkel}}</b></p>
                                    	<p>Engine Cut Off : <b>{{$getDataKendaraan[0]->engine_cut_off}}</b></p>
                                    	<p>GPS : <b>{{$getDataKendaraan[0]->gps}}</b></p>
                                    	<p>Radio Komunikasi : <b>{{$getDataKendaraan[0]->radio_komunikasi}}</b></p>
                                    	<p>Winch Depan Merek : <b>{{$getDataKendaraan[0]->winch_depan_merek}}</b></p>
                                    	<p>Winch Depan Type : <b>{{$getDataKendaraan[0]->winch_depan_type}}</b></p>
                                    	<p>Strap : <b>{{$getDataKendaraan[0]->strap}}</b></p>
                                    	<p>Winch Belakang Merek : <b>{{$getDataKendaraan[0]->winch_belakang_merek}}</b></p>
                                    	<p>Winch Belakang type : <b>{{$getDataKendaraan[0]->winch_belakang_type}}</b></p>
                                    	<p>Snatch Block : <b>{{$getDataKendaraan[0]->snatch_block}}</b></p>
                                    	<p>Shackle : <b>{{$getDataKendaraan[0]->shackle}}</b></p>
                                    	<p>Glove : <b>{{$getDataKendaraan[0]->glove}}</b></p>
                                    	<p>Sling : <b>{{$getDataKendaraan[0]->sling}}</b></p>
                                      </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Nomor Pintu</label>
                                    @if ($errors->has('nomorPintu'))
                                      <small style="color:red">* {{$errors->first('nomorPintu')}}</small>
                                    @endif
                                    <input type="hidden" class="form-control" value="{{$editRegistrasi->id}}" name="id" id="id"/>
                                    <input type="text" class="form-control" value="{{$editRegistrasi->nomor_pintu}}" placeholder="Ketikkan Nomor Pintu..." name="nomorPintu" id="nomorPintu"/>
                                </div>
                            </div>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Email</th>
                                        <th>Nama Lengkap</th>
                                        <th>Nama Panggilan</th>
                                        <th>Hubungan</th>
                                        <th>No Telp</th>
                                        <th>No Hp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @php $i=1; @endphp
                                  @foreach($getDataKeluarga as $key)
                                    <tr>
                                      <td>{{$i++}}</td>
                                      <td>{{$key->email}}</td>
                                      <td>{{$key->nama_lengkap_keluarga}}</td>
                                      <td>{{$key->nama_keluarga}}</td>
                                      <td>{{$key->hubungan_keluarga}}</td>
                                      <td>{{$key->no_telp_keluarga}}</td>
                                      <td>{{$key->no_hp_keluarga}}</td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn pull-right btn-primary">Simpan Perubahan</button>
                            <a href="{{ URL::previous() }}" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Tidak</a>
                        </div>
                    </div>
                  </form>
                </div>
            </div>
          </div>
    </div>
    <!-- #END# Input -->

</div>
@endsection

@section('footscript')
<script src="{{asset('theme/js/pages/forms/basic-form-elements.js')}}"></script>

<!-- Ckeditor -->
<script src="{{asset('theme/plugins/ckeditor/ckeditor.js')}}"></script>

<!-- TinyMCE -->
<script src="{{asset('theme/plugins/tinymce/tinymce.js')}}"></script>

<script src="{{asset('theme/js/pages/forms/editors.js')}}"></script>

<script>
  $(document).ready(function() {

  });
</script>

<script>
    $(function(){
        $('#tagsinput').tagsinput();
    })
</script>
@endsection
