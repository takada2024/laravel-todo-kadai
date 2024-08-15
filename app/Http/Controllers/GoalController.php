<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    /**
     *  index
     */
    public function index()
    {
        $goals = Auth::user()->goals;
        $tags = Auth::user()->tags;

        return view('goals.index', compact('goals', 'tags'));
    }

    /**
     *  store
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $goal = new Goal();
        $goal->title = $request->input('title');
        $goal->user_id = Auth::id();
        $goal->save();

        return redirect()->route('goals.index');
    }

    /**
     *  update
     */
    public function update(Request $request, Goal $goal)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $goal->title = $request->input('title');
        $goal->user_id = Auth::id();
        $goal->update();

        return redirect()->route('goals.index');
    }

    /**
     *  destroy
     */
    public function destroy(Goal $goal)
    {
        $goal->delete();

        return redirect()->route('goals.index');
    }
}

