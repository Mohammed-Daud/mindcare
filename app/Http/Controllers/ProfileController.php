<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->id;
        return view('profile', compact('id'));
    }

    public function professionals(Request $request)
    {
        $id = $request->id;
        return view('professionals', compact('id'));
    }
}
