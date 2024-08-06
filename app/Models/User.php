<?php

namespace App\Models;

use Carbon\Carbon;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'code',
        'expire',
        'phone_number',
        'job_title',
        'company',
        'id_number'
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
    public function generateCode()
    {
        $this->timestamps = false;
        $this->code = rand(100000, 999999);
        $this->expire = now()->addMinutes(15);
        $this->save();
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
    public function Role()
    {
        return $this->belongsTo(Role::class);
    }
    public function hasRole($roleName)
    {
        return  $this->Role()->whereName($roleName)->first() ? true : false;
    }

    public function block(User $user)
    {
        $this->blocks()->attach($user->id);
    }

    public function unblock(User $user)
    {
        $this->blocks()->detach($user->id);
    }

    public function blocks()
    {
        return $this->belongsToMany(User::class, 'user_blocks', 'user_id', 'blocked_user_id');
    }

    public function isBlockedBy(User $user)
    {
        return $this->blocks()->where('blocked_user_id', $user->id)->exists();
    }
}
