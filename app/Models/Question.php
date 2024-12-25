<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    protected $fillable = [
        'label',
        'test_id',
    ];

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }
}
