<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum TestStatus: string
{
    case InProgress = 'in_progress';
    case Completed = 'completed';

    public function label(): string
    {
        return Str::of($this->value)->replace('_', ' ')->title();
    }
}
