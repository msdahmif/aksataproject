<?php

namespace App;

use App\User;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    //

    protected $fillable = ['tanggal', 'title', 'deskripsi', 'tingkat'];

    protected $dates = ['tanggal'];

    /* Eloquent Relationships */
    public function user(){
        return $this->belongsTo(User::class, 'user_nim', 'nim');
    }
}
