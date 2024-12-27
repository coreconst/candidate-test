<?php

namespace App\Http\Controllers;

use App\Enums\TestStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        /** @var \App\Models\User $user  */
        $user = auth()->user();

        /** @var \App\Models\Test $test */
        $test = $user->assignedTests()->find($testId);

        /** @var \App\Models\UserTest $candidateAssignment  */
        $candidateAssignment = $user->userTests()->firstWhere('test_id', $testId);

        $answers = $candidateAssignment->answers()->pluck('answer', 'question_id')->toArray();

        $questions = $test->questions()->pluck('label', 'id')->toArray();

        return Inertia::render('Tests/Candidate/Test',[
            'test' => [
                'id' => $test->id,
                'title' => $test->title,
                'description' => $test->description,
                'questions' => $questions,
                'answers' => $answers
            ]
        ]);
    }

    public function store(Request $request, string $testId): RedirectResponse
    {
        /** @var \App\Models\User $user  */
        $user = auth()->user();

        /** @var \App\Models\UserTest $candidateAssignment  */
        $candidateAssignment = $user->userTests()->firstWhere('test_id', $testId);

        foreach ($request['answers'] as $questionId => $answer){
            if(!empty($answer)){
                $candidateAssignment->answers()->updateOrCreate(
                    ['question_id' => $questionId],
                    ['answer' => $answer]
                );
            }
        }

        $candidateAssignment->update([
            'status' => TestStatus::Completed->value
        ]);


        return redirect(route('candidate-tests.index'));
    }
}
