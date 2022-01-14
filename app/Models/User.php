<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'code',
        'name',
        'email',
        'password',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    //event
    public function events(){
        return $this->hasMany(Event::class);
    }
    public function sinhvien(){
        return $this->belongsTo(Sinhvien::class,"code","MASV");
    }
    public function giangvien(){
        return $this->belongsTo(Giangvien::class,"code","TENDANGNHAP");
    }

   //phân quyền model user
   public function checkPermissionAccess($permissionCheck){
    //b1 check quyền user đang login
    //b2 check giá trị đưa vào của router xem có phù hợp với quyền của user hay ko
    $roles = auth()->user()->giangvien->roles_gv;
    // Var_dump($roles);
    foreach($roles as $role){
        
        $permissions = $role->quyen;
       if($permissions->contains('MA_QUYEN',$permissionCheck)){
           return true;
       }
    }
    return  false;
}
}
