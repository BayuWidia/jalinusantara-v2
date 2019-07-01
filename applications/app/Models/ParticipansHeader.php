<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipansHeader extends Model
{

    protected $table = 'participans_header';

    protected $fillable = [
      'id_event', 'flag_publish', 'url_file', 'nomor_pintu', 'activated', 'created_by', 'updated_by',
    ];
}
