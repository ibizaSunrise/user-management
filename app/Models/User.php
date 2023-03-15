<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Transform the resource into an array.
 *
 * @OA\Property(format="string", title="name", default="Demo", description="Name", property="name"),
 * @OA\Property(format="string", title="surname", default="demo", description="Surname", property="username"),
 * @OA\Property(format="string", title="email", default="demo", description="Email", property="email"),
 * @OA\Property(format="string", title="path", default="https://via.placeholder.com/640x480.png/0000bb?text=avatar", description="Avatar Path", property="path")
 * @param  \Illuminate\Http\Request  $request
 * @return array
 */
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
        'email',
        'password',
        'path'
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
}
