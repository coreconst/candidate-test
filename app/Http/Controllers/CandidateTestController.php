<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class CandidateTestController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Tests/Candidate/Index', [
            'tests' => auth()->user()->assignedTests()->get()
        ]);
    }

    public function execute(string $testId): Response
    {
        /** @var \App\Models\Test $test */
        $test = auth()->user()->assignedTests()->find($testId);

        $questions = $test->questions()->pluck('label', 'id')->toArray();

        return Inertia::render('Tests/Candidate/Test',[
            'test' => [
                'title' => $test->title,
                'description' => $test->description,
                'questions' => $questions
            ]
        ]);
    }
}
