<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Profile extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profiles';


    /**
     * The date fields.
     *
     * @var array
     */
    protected $dates = ['tanggal_lahir'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['telepon', 'email', 'media_sosial', 'nama_lengkap', 'nama_panggilan', 'foto_url',
        'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat_asal', 'alamat_bandung', 'nim_tpb', 'hak_lihat'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['hak_lihat', 'created_at'];

    public static $multiValued = ['telepon', 'email', 'media_sosial'];
    public static $singleValued = ['user_id', 'nama_lengkap', 'nama_panggilan', 'foto_url', 'jenis_kelamin', 'tempat_lahir',
        'tanggal_lahir', 'alamat_asal', 'alamat_bandung', 'nim_tpb'];
    public static $composite = ['alamat_asal', 'alamat_bandung'];
    public static $alwaysPublic = ['user_id', 'nama_lengkap', 'nama_panggilan', 'foto_url'];

    /**
     * The respective user belonging to this profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('\App\User', 'user_nim', 'nim');
    }

    /**
     * Filter current user based on the access right
     */
    public function filter()
    {
        // decode the json
        foreach (Profile::$multiValued as $key) {
            $this[$key] = json_decode($this[$key]);
        }
        $this->hak_lihat = json_decode($this->hak_lihat);
        foreach (Profile::$composite as $key) {
            $this[$key] = json_decode($this[$key]);
        }

        $role = $this->getViewerRole();

        // alter the profile. unset each attribute that cannot be accessed
        // single-valued attributes
        foreach (Profile::$singleValued as $key) {
            if (in_array($key, Profile::$alwaysPublic)) continue;

            $value = $this->hak_lihat->$key;

            if (($role == 'public' && $value != 'public') || ($role == 'user' && $value == 'private')) {
                $this->$key = null;
            }
        }
        // multi-valued attributes
        foreach (Profile::$multiValued as $key) {
            if (in_array($key, Profile::$alwaysPublic)) continue;

            if (!is_array($this->hak_lihat->$key)) {
                $this->hak_lihat->$key = json_decode($this->hak_lihat->$key);
            }
            $value = $this->hak_lihat->$key;

            foreach ($value as $innerKey => $innerValue) {
                if (($role == 'public' && $innerValue != 'public') || ($role == 'user' && $innerValue == 'private')) {
                    $temp = $this->$key;
                    $temp[$innerKey] = null;
                    $this->$key = $temp;
                }
            }
        }
    }

    /**
     * Get the role of the currently authenticated user.
     * Returns public if no one is signed in.
     *
     * @return string
     */
    public function getViewerRole()
    {
        // determine the role of the viewer
        $role = 'public';
        if (Auth::check()) {
            if (Auth::user()->nim == $this->user_nim) {
                $role = 'admin';
            } else {
                $role = Auth::user()->role;
            }
        }
        return $role;
    }
}
