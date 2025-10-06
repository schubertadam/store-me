<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    const int ONE_DAY_IN_SECONDS = 60 * 60 * 24;
    public const null UPDATED_AT = null;
    public $incrementing = false;

    protected $fillable = [
        'reason',
        'email',
        'token',
    ];

    /**
     * Is the token older than 1 day or not
     * @return bool
     */
    public function isOverdue(): bool
    {
        return $this->created_at->diffInSeconds(Carbon::now()) > self::ONE_DAY_IN_SECONDS;
    }
}
