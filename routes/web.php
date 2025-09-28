<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//Controllers
use App\Http\Controllers\IqaControllers\ViewController as IVC;
use App\Http\Controllers\ValidatorControllers\ViewControllers as VVC;
use App\Http\Controllers\AccreditorControllers\ViewController as AVC;

//IQA Controllers
use App\Http\Controllers\IqaControllers\UserController as IUC;


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
    Route::get('/i-users', [IUC::class, 'index'])->name('iqa.users');

        // Users Management
        Route::get('/i-users', [IUC::class, 'index'])->name('iqa.users.index');
        Route::get('/i-users/create', [IUC::class, 'create'])->name('iqa.users.create');
        Route::post('/i-users', [IUC::class, 'store'])->name('iqa.users.store');
        Route::get('/i-users/{user}', [IUC::class, 'show'])->name('iqa.users.show');
        Route::get('/i-users/{user}/edit', [IUC::class, 'edit'])->name('iqa.users.edit');
        Route::patch('/i-users/{user}', [IUC::class, 'update'])->name('iqa.users.update');
        Route::delete('/i-users/{user}', [IUC::class, 'destroy'])->name('iqa.users.destroy');

    // Alternative: Use resource route (cleaner)
    // Route::resource('i-users', IUC::class)->names([
    //     'index' => 'iqa.users.index',
    //     'create' => 'iqa.users.create',
    //     'store' => 'iqa.users.store',
    //     'show' => 'iqa.users.show',
    //     'edit' => 'iqa.users.edit',
    //     'update' => 'iqa.users.update',
    //     'destroy' => 'iqa.users.destroy',
    // ]);
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