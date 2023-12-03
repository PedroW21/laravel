<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SupportController extends Controller
{
    public function index(Support $support) // elegant way, using dependency injection. Create a new instance of Support model and pass it to the index method
    {

        //$support = new Support(); # not elegant
        $supports = $support::all();
        // dd($supports); // var_dump and die

        return Inertia::render('Admin/Supports/Supports', compact('supports'));
    }

    public function create() 
    {
        return Inertia::render('Admin/Supports/Create');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
