<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipansDetail extends Model
{

    protected $table = 'participans_detail';

    protected $fillable = [
      'id_header', 'nama', 'posisi',
      'pax', 'mobil', 'nomor_polisi',
      'telephone', 'ukuran_baju', 'bahan_bakar',
      'activated', 'created_by', 'updated_by',
    ];

}
