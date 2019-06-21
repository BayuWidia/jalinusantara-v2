<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterProduct extends Model
{
    //
    protected $table = 'master_product';

    protected $fillable = [
      'nama_product', 'link_product', 'url_product', 'keterangan_product', 'flag_product',
      'activated', 'created_by', 'updated_by',
    ];
}
