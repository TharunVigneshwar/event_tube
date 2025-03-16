<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\RolesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles,SoftDeletes;

    // Faculty email contains alphabets only
    protected static $faculty_email = '/^[a-zA-Z_.-]+@bitsathy\.ac\.in/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
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
        'password' => 'hashed',
    ];

    /**
     * Method to check valid domain.
     *
     * @return bool
     */
    public static function isValidDomain($user_email)
    {
        $domain = env('GOOGLE_LOGIN_DOMAIN', null);

        return Str::endsWith($user_email, $domain);
    }

    public static function isFaculty($user_email)
    {
        return preg_match(self::$faculty_email, $user_email);
    }

    public static function attachRole($user)
    {
        $role_name = RolesEnum::STUDENT; // default role
        if ($user->isFaculty($user->email)) {
            $role_name = RolesEnum::FACULTY;
        }

        $role = Role::where('name', '=', $role_name)->firstOrFail();

        // attach role if not already present
        if (! $user->hasRole($role->name)) {
            $user->roles()->attach($role->id);
        }
    }
}
