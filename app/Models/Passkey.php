<?php

namespace App\Models;

use Database\Factories\PasskeyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Passkey extends Model
{
    /** @use HasFactory<PasskeyFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'data' => 'json',
        ];
    }

    public function user() : belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
