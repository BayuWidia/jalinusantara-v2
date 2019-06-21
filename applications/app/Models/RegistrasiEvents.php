<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class RegistrasiEvents extends Model
{
    //
    protected $table = 'registrasi_events';

    protected $fillable = [
        'id_events'
      , 'no_registrasi'
      , 'email'
      , 'email_co'
      , 'nama_lengkap_driver'
      , 'nama_lengkap_co_driver'
      , 'nama_driver'
      , 'nama_co_driver'
      , 'golongan_darah_driver'
      , 'golongan_darah_co_driver'
      , 'tmp_lahir_driver'
      , 'tmp_lahir_co_driver'
      , 'ukuran_kemeja_driver'
      , 'ukuran_kemeja_co_driver'
      , 'alamat_driver'
      , 'alamat_co_driver'
      , 'kota_driver'
      , 'kota_co_driver'
      , 'no_anggota_iof'
      , 'no_anggota_iof_co'
      , 'rhesus'
      , 'rhesus_co'
      , 'tgl_lhr_driver'
      , 'tgl_lhr_co_driver'
      , 'kode_pos'
      , 'kode_pos_co'
      , 'no_sim_driver'
      , 'no_sim_co_driver'
      , 'pengalaman_event_driver'
      , 'pengalaman_event_co_driver'
      , 'no_telp_driver'
      , 'no_telp_co_driver'
      , 'nomor_pintu'
      , 'flag_approve'
      , 'file_name'
      , 'status_register'
      , 'activated'
      , 'created_by'
      , 'updated_by'
    ];

    public function events()
    {
      return $this->belongsTo('App\Models\Events', 'id_events');
    }

    public static function getMaxRegistrasiCode($params){
       $getMaxRegistrasiCode = DB::select('SELECT max(no_registrasi) no_registrasi_code FROM registrasi_events
                       where id_events=:id_events', ['id_events' => $params]);
       return $getMaxRegistrasiCode;
    }
}
