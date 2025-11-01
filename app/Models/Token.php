<?php

namespace App\Models;

use App\Enums\TokenReasonEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $token
 * @property string $email
 * @property TokenReasonEnum $reason
 */
class Token extends Model
{
    const int ONE_DAY_IN_SECONDS = 60 * 60 * 24;
    public const null UPDATED_AT = null;
    public $incrementing = false;
    protected $primaryKey = 'token';
    protected $keyType = 'string';
    protected $fillable = [
        'token',
        'email',
        'reason',
    ];
    protected $casts = [
        'reason' => TokenReasonEnum::class,
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
