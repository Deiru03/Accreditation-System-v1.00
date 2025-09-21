<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//Controllers
use App\Http\Controllers\IqaControllers\ViewController as IVC;
use App\Http\Controllers\ValidatorControllers\ViewControllers as VVC;
use App\Http\Controllers\AccreditorControllers\ViewController as AVC;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//////////////////////  IQA Routes //////////////////////
Route::middleware(['auth', 'iqa'])->group(function () {
    // Add any routes that require the 'iqa' middleware here

    //Views
    Route::get('/i-dashboard', [IVC::class, 'iDashboard'])->name('iqa.dashboard');
    Route::get('/i-users', [IVC::class, 'iUsers'])->name('iqa.users');

});

/////////////////////   Uploader Routes ////////////////////

/////////////////////  Validator Routes ////////////////////

Route::middleware(['auth', 'val'])->group(function () {
    // Add any routes that require the 'validator' middleware here

    //Views
    Route::get('/v-dashboard', [VVC::class, 'vDashboard'])->name('validator.dashboard');

});

/////////////////////  Accredator Routes ////////////////////

Route::middleware(['auth', 'accre'])->group(function () {
    // Add any routes that require the 'accreditor' middleware here

    //Views
    Route::get('/a-dashboard', [AVC::class, 'aDashboard'])->name('accreditor.dashboard');

});


require __DIR__.'/auth.php';