<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'managements';

    /**
     * The primary key for this model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The date fields.
     *
     * @var array
     */
    protected $dates = ['tanggal_mulai', 'tanggal_selesai'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama', 'nim_ketua', 'tanggal_mulai', 'tanggal_selesai'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at'];

    public static $multiValued = [];
    public static $singleValued = ['nama', 'nim_ketua', 'tanggal_mulai', 'tanggal_selesai'];
    public static $composite = [];
    public static $alwaysPublic = ['nama', 'nim_ketua', 'tanggal_mulai', 'tanggal_selesai'];

    /**
     * The respective leader belonging to this management
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function leader()
    {
        return $this->belongsTo('\App\Profile', 'nim_ketua', 'nim');
    }

    /**
     * The respective division the management has
     */
    public function divisions()
    {
        return $this->hasMany('\App\Division', 'id_kepengurusan');
    }

}
