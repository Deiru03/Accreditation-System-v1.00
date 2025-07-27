<?php

namespace App\Http\Controllers\IqaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function iqaDashboard()
    {
        return view('iqa-views.iqa-dashboard');
    }
}
