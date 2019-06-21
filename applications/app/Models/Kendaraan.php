<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    //
    protected $table = 'kendaraan';

    protected $fillable = [
        'id_registrasi'
      , 'merek'
      , 'no_polisi'
      , 'type_mesin'
      , 'cc'
      , 'merek_ban'
      , 'ukuran_ban'
      , 'rollbar'
      , 'cargo_barrier'
      , 'side_bar'
      , 'safety_belt'
      , 'spec_up_kendaraan'
      , 'type'
      , 'tahun'
      , 'warna'
      , 'snorkel'
      , 'engine_cut_off'
      , 'gps'
      , 'radio_komunikasi'
      , 'winch_depan_merek'
      , 'winch_depan_type'
      , 'strap'
      , 'winch_belakang_merek'
      , 'winch_belakang_type'
      , 'snatch_block'
      , 'shackle'
      , 'glove'
      , 'sling'
      , 'created_by'
      , 'updated_by'
    ];

}
