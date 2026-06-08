<?php

use App\Http\Controllers\ContactInfoController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StackItemController;
use App\Http\Controllers\TechnologyController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::livewire('profiles', 'admin.profiles.profile-form')
            ->name('profiles.index');
        Route::resource('experiences', ExperienceController::class);
        Route::resource('projects', ProjectController::class);
        Route::resource('technologies', TechnologyController::class);
        Route::resource('stack-items', StackItemController::class);
        Route::resource('contact-info', ContactInfoController::class);
    });

require __DIR__.'/settings.php';
