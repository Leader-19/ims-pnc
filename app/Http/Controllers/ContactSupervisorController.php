<?php

namespace App\Http\Controllers;

use App\Models\Supervisor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactSupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Contact/Contact", [
            "contacts" => Supervisor::with('user')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //show form create supervisor contact

        return Inertia::render("Contact/CreateContact");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate form create

        $request->validate([
            'supervisor_name' => 'required|string|max:255',
            'email_supervisor' => 'required|string|max:255',
            'supervisor_phone_number' => 'required|string|max:255',
        ]);

        Supervisor::create([
            'user_id' => auth()->id(),
            'supervisor_name' => $request->supervisor_name,
            'email_supervisor' => $request->email_supervisor,
            'supervisor_phone_number' => $request->supervisor_phone_number
        ]);

        return redirect()->route('contact-supervisors.index')
            ->with('success', 'Contact Supervisor created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //show contact details

         return Inertia::render("Contact/ShowContact", [
            "contact" => Supervisor::findOrFail($id)
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //show form edit contact supervisor

        $contact = Supervisor::findOrFail($id);

        return Inertia::render('Contact/EditContact', [
            'contact' => $contact,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate and update form

        $contact = Supervisor::findOrFail($id);

        $request->validate([
            'supervisor_name' => 'required|string|max:255',
            'email_supervisor' => 'required|string|max:255',
            'supervisor_phone_number' => 'required|string|max:255',
        ]);


        $contact->supervisor_name = $request->supervisor_name;
        $contact->email_supervisor = $request->email_supervisor;
        $contact->supervisor_phone_number = $request->supervisor_phone_number;
        $contact->save();

        return redirect()->route('contact-supervisors.index')
            ->with('success', 'Contact Supervisor updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete specific record

        Supervisor::destroy($id);
        return to_route("contact-supervisors.index");
    }
}
