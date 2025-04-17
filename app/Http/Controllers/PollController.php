<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('polls', [
            'polls' => auth()->user()->admin ? Poll::all() : Poll::all()->where('status', '!=', 'draft') // Fetch all users and pass them to the Vue component
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Poll $poll)
    {
        return Inertia::render('poll', [
            'poll' => $poll,
            'user' => auth()->user(),
            'isAdmin' => auth()->user()->admin,
            'isVoted' => $poll->votes->contains('user_id', auth()->user()->id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Poll $poll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Poll $poll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poll $poll)
    {
        //
    }
}
