<?php

namespace App\Http\Controllers;

use App\Models\FinalSlide;
use App\Models\Score;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FinalSlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $finalSlide = FinalSlide::with(['user', 'score'])
            ->get()
            ->sortByDesc(fn($r) => $r->score?->final_report_score ?? 0);


        return Inertia::render("FinalSlide/FinalSlide", [
            'slides' => $finalSlide
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //show form create final slide 

        return Inertia::render("FinalSlide/CreateSlide");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate form

        $request->validate([
            'slide_name' => 'required|string|max:255',
            'slide_upload' => 'required|file|max:100000',
            'description' => 'nullable|string|max:500',
        ]);

        $path = $request->file('slide_upload')
            ->store('final-slides', 'public');

        // Create DB record
        FinalSlide::create([
            'user_id' => auth()->id(),
            'slide_name' => $request->slide_name,
            'slide_upload' => $path,
            'description' => $request->description,
        ]);

        return redirect()->route('final-slides.index')
            ->with('success', 'Final slide created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //show details

        return Inertia::render("FinalSlide/ShowSlide", [
            "slide" => FinalSlide::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //show form edit

        $slide = FinalSlide::findOrFail($id);
        return Inertia::render(
            "FinalSlide/EditSlide",
            [
                'slide' => $slide,
                'score' => $slide->score ?? null,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update data in database

        $slide = FinalSlide::findOrFail($id);

        $request->validate([
            'slide_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'slide_upload' => 'nullable|file|max:100000',
        ]);

        if ($request->hasFile('slide_upload')) {
            $path = $request->file('slide_upload')->store('final-slides', 'public');
            $slide->slide_upload = $path;
        }

        $slide->slide_name = $request->slide_name;
        $slide->description = $request->description;
        $slide->save();

        // Update or create score
        if ($request->filled('final_slide_score')) {
            Score::updateOrCreate(
                ['final_slide_id' => $slide->id],
                ['final_slide_score' => $request->final_slide_score]
            );
        }

        return redirect()->route('final-slides.index')
            ->with('success', 'Final Report updated successfully!');
    }


    public function evaluate($id)
    {
        return Inertia::render('FinalSlide/EvaluateFinalSlide', [
            'slide' => FinalSlide::with('user', 'score')->findOrFail($id)
        ]);
    }


    public function evaluateScoreFinalSlide(Request $request, $id)
    {
        $request->validate([
            'final_slide_score' => 'required|integer|min:0|max:100',
        ]);

        $slide = FinalSlide::findOrFail($id);

        // Correctly link score to worklog
        Score::updateOrCreate(
            ['final_slide_id' => $slide->id],
            ['final_slide_score' => $request->final_slide_score]
        );

        return redirect()
            ->route('final-slides.index')
            ->with('success', 'Final Slide score evaluated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete data from database

        FinalSlide::destroy($id);

        return to_route("final-slides.index");
    }
}
