<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    protected $fillable = [
        'user_test_id',
        'question_id',
        'answer'
    ];

    public function assignments(): BelongsTo
    {
        return $this->belongsTo(UserTest::class);
    }


    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
