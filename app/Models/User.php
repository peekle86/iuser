<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Requests\StoreRegister;
use Illuminate\Support\Facades\Storage;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_ADMIN = 1;
    const ROLE_USER = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'avatar',
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

    /**
     * Зберігає аватарку
     * 
     * Повертає шлях до файлу, або null, якщо аватарка не завантажена.
     * При обновленні аватара, видаляє старий (вказати шлях до старого другим параметром)
     * 
     * @return string|null
     */
    public static function uploadAvatar($request, $oldAvatar = null)
    {
        if ($request->hasFile('avatar')) {
            if ($oldAvatar) {
                Storage::delete($oldAvatar);
            }
            return $request->file('avatar')->store("avatars");
        }
        return null;
    }

    /**
     * Повертає посилання на аватар користувача, або заглушку
     * 
     * @return string
     */
    public function getAvatar()
    {
        if(!$this->avatar) {
            return asset('uploads/default.png');
        }
        return asset('uploads/' . $this->avatar);
    }

    /**
     * Повертає дату створення профіля в зручному форматі
     * 
     * @return string
     */
    public function getCreatedDate()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d.m.Y');
    }

    /**
     * Повертає дату обновлення профіля в зручному форматі
     * 
     * @return string
     */
    public function getUpdatedDate()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->format('d.m.Y');
    }

    /**
     * Перевіряє чи являється користувач адміном
     * 
     * @return bool
     */
    public function isAdmin()
    {
        if($this->is_admin === 1) {
            return true;
        } else {
            return false;
        }
    }

}
