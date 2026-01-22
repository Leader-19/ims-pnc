<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\WeeklyWorklog;
use Illuminate\Http\Request;
use Inertia\Inertia;


class WeeklyWorklogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $weeklyWorklogs = WeeklyWorklog::with(['user', 'score'])
            ->get()
            ->sortByDesc(fn($w) => $w->score?->weekly_worklog_score ?? 0);

        return Inertia::render('WeeklyWorkLog/WeeklyWorkLog', [
            'weeklyWorklogs' => $weeklyWorklogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /**
         * show create form
         */

        return Inertia::render('WeeklyWorkLog/CreateWorklog');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /**
         * validate in form
         */


        $request->validate([
            'worklog_name' => 'required|string|max:255',
            'worklog_upload' => 'required|file|max:100000',
            'discription' => 'nullable|string|max:500',

        ]);

        // Store file and get path
        $path = $request->file('worklog_upload')->store('weekly-worklogs', 'public');

        // Create DB record
        WeeklyWorklog::create([
            'user_id' => auth()->id(),
            'worklog_name' => $request->worklog_name,
            'worklog_upload' => $path,
            'discription' => $request->discription,
        ]);

        return redirect()->route('weekly-worklogs.index')
            ->with('success', 'Weekly Worklog created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //show view details

        return Inertia::render("WeeklyWorkLog/ShowWorklog", [
            "worklog" => WeeklyWorklog::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //show edit form

        $worklog = WeeklyWorklog::with('score')->findOrFail($id);

        return Inertia::render('WeeklyWorkLog/EditWorklog', [
            'worklog' => $worklog,
            'score' => $worklog->score ?? null, // make sure score is passed
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $worklog = WeeklyWorklog::findOrFail($id);

        $request->validate([
            'worklog_name' => 'required|string|max:255',
            'discription' => 'nullable|string|max:500',
            'worklog_upload' => 'nullable|file|max:100000',
        ]);

        if ($request->hasFile('worklog_upload')) {
            $path = $request->file('worklog_upload')->store('weekly-worklogs', 'public');
            $worklog->worklog_upload = $path;
        }

        $worklog->worklog_name = $request->worklog_name;
        $worklog->discription = $request->discription;
        $worklog->save();

        // Update or create score
        if ($request->filled('weekly_worklog_score')) {
            Score::updateOrCreate(
                ['weekly_worklog_id' => $worklog->id],
                ['weekly_worklog_score' => $request->weekly_worklog_score]
            );
        }

        return redirect()->route('weekly-worklogs.index')
            ->with('success', 'Weekly Worklog updated successfully!');
    }

    public function evaluate($id)
    {
        return Inertia::render('WeeklyWorkLog/EvaluateScore', [
            'worklog' => WeeklyWorklog::with('user', 'score')->findOrFail($id)
        ]);
    }

    /**
     * 
     * Evaluate score in worklog
     */

    public function evaluateScoreWeekly(Request $request, $id)
    {
        $request->validate([
            'weekly_worklog_score' => 'required|integer|min:0|max:100',
        ]);

        $worklog = WeeklyWorklog::findOrFail($id);

        // Correctly link score to worklog
        Score::updateOrCreate(
            ['weekly_worklog_id' => $worklog->id],
            ['weekly_worklog_score' => $request->weekly_worklog_score]
        );

        return redirect()
            ->route('weekly-worklogs.index')
            ->with('success', 'Weekly worklog score evaluated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //destroy weekly worklog

        WeeklyWorklog::destroy($id);

        return to_route("weekly-worklogs.index");
    }
}
