<?php

namespace App\Http\Controllers\IqaControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class ViewController extends Controller
{
    public function iDashboard()
    {
        return view('iqa-views.iDashboard');
    }

    public function iUsers()
    {
        $users = User::paginate(50);
        return view('iqa-views.iUsers', compact('users'));
    }
}