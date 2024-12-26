<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RecruiterTestController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Tests/Recruiter/Index', [
            'tests' => auth()->user()->recruiterTests()->get()->toArray()
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Tests/Recruiter/Test');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable',
            'questions' => 'required'
        ]);

        /** @var \App\Models\Test $test */
         $test = auth()->user()->recruiterTests()->create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        foreach (json_decode($request->questions, true) as $question){
            if(!empty($question)){
                $test->questions()->create([
                    'label' => $question['label']
                ]);
            }
        }

        return redirect(route('recruiter-tests.index'));
    }

    public function edit(string $testId): Response
    {
        /** @var \App\Models\Test $test */
        $test = auth()->user()->recruiterTests()?->find($testId);
        if(!$test) abort(404);

        /** @var array $questions */
        $questions = $test->questions()->pluck('label', 'id')->all();

        return Inertia::render('Tests/Recruiter/Test', [
            'test' => array_merge($test->only('title', 'description', 'id'), ['questions' => $questions])
        ]);
    }

    public function update(Request $request, string $testId): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable',
            'questions' => 'required'
        ]);

        /** @var \App\Models\Test $test */
        $test = auth()->user()->recruiterTests()->find($testId);

        $test->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        $questions = json_decode($request->questions, true);

        $deleteQuestions = $test->questions()
            ->pluck('id')
            ->diff(collect($questions)->pluck('id'))
            ->toArray();

        foreach ($deleteQuestions as $deleteId){
            $test->questions()->find($deleteId)->delete();
        }

        foreach ($questions as $question){
            if(!empty($question)){

                $questionData = [
                    'label' => $question['label']
                ];

                if(!empty($question['id'])){
                    $test->questions()->find($question['id'])->update($questionData);
                } else {
                    $test->questions()->create($questionData);
                }
            }
        }

        return redirect(route('recruiter-tests.index'));
    }

    public function delete(string $testId): RedirectResponse
    {
        /** @var \App\Models\Test $test */
        $test = auth()->user()->recruiterTests()->find($testId);
        $test->delete();

        return redirect(route('recruiter-tests.index'));
    }
}
