<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class WeeklyWorklogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("WeeklyWorkLog/WeeklyWorkLog");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /**
         * show create form
         */
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /**
         * validate in form
         */
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //show view details
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //show edit form
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate and update
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //destroy weekly worklog
    }
}
