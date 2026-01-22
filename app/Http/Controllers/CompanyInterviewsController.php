<?php

namespace App\Http\Controllers;

use App\Models\CompanyInterview;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyInterviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Interview/Interview", [
            "interviews" => CompanyInterview::with("user")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //show form create

        return Inertia::render("Interview/CreateInterview");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate input form and update to database

        $request->validate([
            'company_name' => 'required|string|max:255|unique:company_interviews,company_name',
            'date_interview' => 'required|date',
        ]);

        CompanyInterview::create([
            'user_id' => auth()->id(),
            'company_name'  => $request->company_name,
            'date_interview' => $request->date_interview
        ]);

        return redirect()->route('company-interviews.index')
            ->with('success', 'Company Interview created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //show details

        return Inertia::render("Interview/ShowInterview", [
            "interview" => CompanyInterview::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //show form edit company interview
        $interview = CompanyInterview::findOrFail($id);

        return Inertia::render('Interview/EditInterview', [
            'interview' => $interview,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form update to database

        $interview = CompanyInterview::findOrFail($id);

        $request->validate([
            'company_name' => 'required|string|max:255|unique:company_interviews,company_name',
            'date_interview' => 'required|date',
        ]);


        $interview->company_name = $request->company_name;
        $interview->date_interview = $request->date_interview;
        $interview->save();

        return redirect()->route('company-interviews.index')
            ->with('success', 'Company Interview updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete specific record

        CompanyInterview::destroy($id);
        return to_route("company-interviews.index");
    }
}
