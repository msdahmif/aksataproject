<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'divisions';

    /**
     * The primary key for this model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama', 'nim_ketua', 'id_kepengurusan', 'id_super'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at'];

    /**
     * The respective leader belonging to this division
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function leader()
    {
        return $this->belongsTo('\App\Profile', 'nim_ketua', 'nim');
    }

    /**
     * The respective management belonging to this division
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function management()
    {
        return $this->belongsTo('\App\Management', 'id_kepengurusan');
    }

    /**
     * The division could have other division
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function divisions()
    {
        return $this->hasMany('\App\Division', 'id_super');
    }


}