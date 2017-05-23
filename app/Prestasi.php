<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    //

    protected $fillable = ['tanggal', 'title', 'deskripsi', 'tingkat'];

    protected $dates = ['tanggal'];


}
