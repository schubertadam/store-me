<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $group
 * @property string $name
 * @property Role[] $roles
 * @property User[] $users
 */
class Permission extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'group',
        'name',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
