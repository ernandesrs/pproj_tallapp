<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class VerificationToken extends Model
{
    const TO_REGISTER_VERIFICATION = 'register_verification';

    const TO_PASSWORD_RESET = 'password_reset';

    const ALLOWS_TO = [
        self::TO_REGISTER_VERIFICATION,
        self::TO_PASSWORD_RESET
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'token',
        'to',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'token'
    ];

    /**
     * User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
