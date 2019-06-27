<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{

    protected $table = 'events';

    protected $fillable = [
      'id_kategori', 'judul_event', 'tanggal_mulai', 'tanggal_akhir', 'url_foto',
      'url_register', 'url_scrut', 'url_rules',
      'entrance_fee', 'payment', 'tags', 'shirt_sizes',
      'isi_event', 'maps', 'fasilitator', 'jumlah_peserta', 'lokasi', 'alamat', 'flag_headline',
      'flag_publish', 'view_counter',
      'activated', 'created_by', 'updated_by',
    ];

    public function kategori()
    {
      return $this->belongsTo('App\Models\MasterKategori', 'id_kategori');
    }
}
