<?php

namespace App\Http\Controllers;

use App\Models\FinalReport;
use App\Models\Score;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FinalReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $finalReports = FinalReport::with(['user', 'score'])
            ->get()
            ->sortByDesc(fn($r) => $r->score?->final_report_score ?? 0);

        return Inertia::render('FinalReport/FinalReport', [
            'reports' => $finalReports,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /**
         * show form create final reports
         */

        return Inertia::render("FinalReport/CreateReport");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validate form and store data in database

        $request->validate([
            'report_name' => 'required|string|max:255',
            'final_upload' => 'required|file|max:100000',
            'description' => 'nullable|string|max:500',
        ]);

        $path = $request->file('final_upload')
            ->store('final-reports', 'public');

        // Create DB record
        FinalReport::create([
            'user_id' => auth()->id(),
            'report_name' => $request->report_name,
            'final_upload' => $path,
            'description' => $request->description,
        ]);

        return redirect()->route('final-reports.index')
            ->with('success', 'Final Reports created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //show data details

        return Inertia::render("FinalReport/ShowReport", [
            "report" => FinalReport::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $report = FinalReport::findOrFail($id);
        return Inertia::render(
            "FinalReport/EditReport",
            [
                'report' => $report,
                'score' => $report->score ?? null,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update final reports

        $report = FinalReport::findOrFail($id);

        $request->validate([
            'report_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'final_upload' => 'nullable|file|max:100000',
        ]);

        if ($request->hasFile('final_upload')) {
            $path = $request->file('final_upload')->store('final-reports', 'public');
            $report->final_upload = $path;
        }

        $report->report_name = $request->report_name;
        $report->description = $request->description;
        $report->save();

        // Update or create score
        if ($request->filled('final_report_score')) {
            Score::updateOrCreate(
                ['final_report_id' => $report->id],
                ['final_report_score' => $request->final_report_score]
            );
        }

        return redirect()->route('final-reports.index')
            ->with('success', 'Final Report updated successfully!');
    }


    public function evaluate($id)
    {
        return Inertia::render('FinalReport/EvaluateFinalReport', [
            'report' => FinalReport::with('user', 'score')->findOrFail($id)
        ]);
    }


    public function evaluateScoreFinalReports(Request $request, $id)
    {
        $request->validate([
            'final_report_score' => 'required|integer|min:0|max:100',
        ]);

        $report = FinalReport::findOrFail($id);

        // Correctly link score to worklog
        Score::updateOrCreate(
            ['final_report_id' => $report->id],
            ['final_report_score' => $request->final_report_score]
        );

        return redirect()
            ->route('final-reports.index')
            ->with('success', 'Final Report score evaluated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete final reports

        FinalReport::destroy($id);

        return to_route("final-reports.index");
    }
}
