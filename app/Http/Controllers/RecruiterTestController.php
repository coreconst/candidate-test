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
        return Inertia::render('Tests/Recruiter/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable',
        ]);

        auth()->user()->recruiterTests()->create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect(route('recruiter-tests.index'));
    }
}
