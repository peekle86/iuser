<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Requests\StoreRegister;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'age',
        'email',
        'password',
        'description'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function uploadAvatar(StoreRegister $request, $oldAvatar = null)
    {
        if ($request->hasFile('avatar')) {
            if ($oldAvatar) {
                Storage::delete($oldAvatar);
            }
            return $request->file('avatar')->store("avatars");
        }
        return null;
    }

    public function getAvatar()
    {
        if(!$this->getAvatar) {
            return asset('uploads/default.png');
        }
        return asset('uploads/' . $this->avatar);
    }

}
