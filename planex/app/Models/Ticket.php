<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    protected $fillable = [
        'token',
        'numero',
        'email',
        'question_1',
        'question_2',
        'statut',
        'closed_at',
        'delete_at',
        'no_char_limit_next',
    ];

    protected $casts = [
        'closed_at'          => 'datetime',
        'delete_at'          => 'datetime',
        'no_char_limit_next' => 'boolean',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(TicketMessage::class);
    }

    public function isExpired(): bool
    {
        return $this->delete_at !== null && $this->delete_at->isPast();
    }
}
