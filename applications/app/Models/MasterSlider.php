<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterSlider extends Model
{
    //
    protected $table = 'master_slider';

    protected $fillable = [
      'judul', 'url_slider', 'keterangan_slider', 'flag_slider',
      'activated', 'created_by', 'updated_by',
    ];
}
