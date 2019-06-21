<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterComment extends Model
{
    //
    protected $table = 'master_comment';

    protected $fillable = [
      'id_informasi', 'email', 'nama', 'subject', 'message', 'flag_comment','flag_tanggapan',
      'activated', 'created_by', 'updated_by',
    ];
}
