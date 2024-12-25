<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class RecruiterTestController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Tests/Recruiter/Index');
    }
}
