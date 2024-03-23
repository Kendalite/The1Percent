<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Enums\UserRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    // ROLES
    const ROLE_ADMIN = 'admin';
    const ROLE_HOST = 'host';
    const ROLE_MODERATOR = 'referee';
    const ROLE_WRITER = 'writer';
    const ROLE_CUSTOMER = 'player';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'role',
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
        'role' => UserRoles::class,
    ];

    /**
     * Verify if client has one of the expected roles to a route. An admin always has access
     * @return bool
     */
    public function hasAnyRole(array $paRoles): bool
    {
        return $this->getAttribute('role')->value === UserRoles::Admin || in_array($this->getAttribute('role')->value, $paRoles);
    }

    public function manyAnswers(): HasMany {
        return $this->hasMany(Answer::class, 'game_id');
    }
}
