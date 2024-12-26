<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RecruiterAssignmentController extends Controller
{
    public function index(): Response
    {
        $assignments = auth()->user()->assignments()->with(['user:id,email', 'test:id,title'])->get();
        $filteredAssignments = $assignments->map(fn ($assignment) => [
                'id' => $assignment->id,
                'user_email' => $assignment->user->email,
                'test_title' => $assignment->test->title,
                'status' => $assignment->status === TestStatus::InProgress->value
                    ? TestStatus::InProgress->label()
                    : TestStatus::Completed->label()
            ]
        );

        return Inertia::render('Tests/Recruiter/Assignments', [
            'assignments' => $filteredAssignments,
        ]);
    }

    public function assign(string $testId): Response
    {
        $users = User::where('role', UserRole::Candidate->value)->get();

        /** @var \App\Models\Test $test */
        $test = auth()->user()->ownTests()->find($testId);

        return Inertia::render('Tests/Recruiter/Assignment', [
            'users' => $users,
            'test' => [
                'title' => $test->title,
                'id' => $test->id
            ]
        ]);
    }

    public function store(Request $request, string $testId): RedirectResponse
    {
        $userId = $request->toArray()['userId'] ?? null;
        if($userId){

            /** @var \App\Models\Test $test */
            $test = auth()->user()->ownTests()->find($testId);

            /** @var \App\Models\User $user */
            $user = User::find($userId);
            $user->assignTest($test->id);
        }

        return redirect(route('recruiter-tests.index'));
    }
}
