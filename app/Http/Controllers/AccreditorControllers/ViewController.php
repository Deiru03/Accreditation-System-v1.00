<?php

namespace App\Http\Controllers\AccreditorControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    //
    public function aDashboard()
    {
        return view('accreditor-views.aDashboard');
    }
}
