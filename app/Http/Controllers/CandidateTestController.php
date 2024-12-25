<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class CandidateTestController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Tests/Candidate/Index');
    }
}
