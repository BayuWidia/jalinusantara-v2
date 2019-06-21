<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterTestimonial extends Model
{
    //
    protected $table = 'master_testimonial';

    protected $fillable = [
      'nama', 'isi', 'flag_testimonial',
      'activated', 'created_by', 'updated_by',
    ];
}
