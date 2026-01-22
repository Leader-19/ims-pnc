<?php

namespace App\Http\Controllers;

use App\Models\CompanyInternship;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyInternshipController extends Controller
{
    public function index()
    {
        return Inertia::render("Internship/Index", [

            "internships" => CompanyInternship::with('user')->get()

        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //show form create

        return Inertia::render("Internship/CreateInternship");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate input form and update to database

        $request->validate([
            'company_name' => 'required|string|max:255|unique:company_internships,company_name',
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after_or_equal:start_date',
            'allowance'    => 'required|numeric|min:0',

        ]);

        CompanyInternship::create([
            'user_id' => auth()->id(),
            'company_name'  => $request->company_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'allowance' => $request->allowance,
        ]);

        return redirect()->route('internships.index')
            ->with('success', 'Internship created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //show details

        return Inertia::render("Internship/ShowInternship", [
            "internship" => CompanyInternship::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //show form edit company interview
        $internship = CompanyInternship::findOrFail($id);

        return Inertia::render('Internship/EditInternship', [
            'internship' => $internship,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form update to database

        $internship = CompanyInternship::findOrFail($id);

        $request->validate([
            'company_name' => 'required|string|max:255|unique:company_internships,company_name,' . $internship->id,
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after_or_equal:start_date',
            'allowance'    => 'required|numeric|min:0',
        ]);

        $internship->company_name = $request->company_name;
        $internship->start_date = $request->start_date;
        $internship->end_date = $request->end_date;
        $internship->allowance = $request->allowance;
        $internship->save();

        return redirect()->route('internships.index')
            ->with('success', 'Internship updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete specific record

        CompanyInternship::destroy($id);
        return to_route("internships.index");
    }
}
