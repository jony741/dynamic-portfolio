<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProfileController::class, 'index'])->name('home');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::livewire('dashboard', 'admin.profiles.profile-form')->name('dashboard');
});

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::livewire('profiles', 'admin.profiles.profile-form')
            ->name('profiles.index');
        Route::livewire('technologies', 'admin.technologies.technology-manager')
            ->name('technologies.index');
        Route::livewire('stack-items', 'admin.technologies.stack-items')
            ->name('stack-items.index');
        Route::livewire('experiences', 'admin.experiences.experience-manager')
            ->name('experiences.index');
        Route::livewire('projects', 'admin.projects.project-manager')
            ->name('projects.index');
        Route::livewire('contact-info', 'admin.contact-info.contact-manager')
            ->name('contact-info.index');
    });

require __DIR__.'/settings.php';
