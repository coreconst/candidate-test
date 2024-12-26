<?php

namespace App\Enums;

enum TestStatus: string
{
    case InProgress = 'in_progress';
    case Completed = 'completed';
}
