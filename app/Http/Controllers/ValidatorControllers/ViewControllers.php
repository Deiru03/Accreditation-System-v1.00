<?php

namespace App\Http\Controllers\ValidatorControllers;

use App\Http\Controllers\Controller;
use App\Models\optional;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ViewControllers extends Controller
{
    public function vDashboard(): View
    {
        return view('validator-views.dashboard');
    }
}
