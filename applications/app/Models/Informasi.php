<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{

    protected $table = 'informasi';

    protected $fillable = [
      'id_kategori', 'judul_informasi', 'tanggal_publish', 'url_foto', 'tags', 'isi_informasi',
      'flag_headline', 'flag_publish', 'flag_status', 'view_counter',
      'activated', 'created_by', 'updated_by',
    ];

    public function kategori()
    {
      return $this->belongsTo('App\Models\MasterKategori', 'id_kategori');
    }
}
