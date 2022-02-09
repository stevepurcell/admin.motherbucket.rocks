<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaintController extends Controller
{
    public function index()
    {
        return view('maintenance.index');
    }
}
