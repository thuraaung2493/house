<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'verified' , 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $with = ['profile', 'roles'];


    public function verificationToken()
    {
        return $this->hasOne(VerificationToken::class);
    }

    public function house()
    {
        return $this->hasMany(House::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function contactMessages()
    {
        return $this->hasMany(ContactMessage::class);
    }

    public function guestMessages()
    {
        return $this->hasMany(GuestMessage::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function hasVerifiedEmail()
    {
        return $this->verified;
    }

    public static function byEmail($email)
    {
        return static::where('email', $email);
    }

    /**
     * Checks if User has access to $permissions.
     */
    public function hasAccess(array $permissions) : bool
    {
        // check if the permission is available in any role
        foreach ($this->roles as $role) {
            if ($role->hasAccess($permissions)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks if the user belongs to role.
     */
    public function inRole(string $roleSlug)
    {
        return $this->roles()->where('slug', $roleSlug)->count() == 1;
    }

    public function adminOrHost()
    {
        return auth()->user()->inRole('host') || auth()->user()->inRole('admin') || auth()->user()->inRole('superadmin');
    }

    public function type()
    {
        return $this->roles()->first()->slug;
    }

    public function changeRole($roleName)
    {
        $newRole = Role::where('slug', $roleName)->first();
        $oldRole = $this->roles()->first();
        $this->roles()->detach($oldRole);
        $this->roles()->attach($newRole);
    }

    public function showImage($path)
    {
        $image_name = $this->profile->image_name . '.' .
                        $this->profile->extension;

        if (File::exists(storage_path('app/public/photos/profiles/') . $image_name)) {
            return $path . '/profiles/' . $image_name;
        }

        return  asset("img/default-user.png");
    }
}
