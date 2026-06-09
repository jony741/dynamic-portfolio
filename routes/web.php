<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome')->name('home');
// Route::get('/', \App\Pages\Home::class)->name('home');
Route::get('/', [ProfileController::class, 'index']);

// Route::get('/', function () {
//    $profile     = \App\Models\Profile::where('is_active', true)->first();
//    $experiences = \App\Models\Experience::where('profile_id', $profile?->id)->orderBy('sort_order')->get();
//    $allProjects    = \App\Models\Project::where('profile_id', $profile?->id)->with('technologies')->orderBy('sort_order')->get();
//    $stackItems  = \App\Models\StackItem::where('profile_id', $profile?->id)->with('technology')->orderBy('sort_order')->get()->groupBy('technology.category');
//    $contactInfo = \App\Models\ContactInfo::where('profile_id', $profile?->id)->where('is_visible', true)->orderBy('sort_order')->get();
//
// //    dd($profile->full_name);
//
//    return view('home', compact('profile', 'experiences', 'allProjects', 'stackItems', 'contactInfo'));
// })->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
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
