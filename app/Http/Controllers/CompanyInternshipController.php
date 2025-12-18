<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyInternshipController extends Controller
{
    public function index () {
        return Inertia::render("Internship/Index");
    }
}
