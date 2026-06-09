<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\StackItem;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::getActive();

        if (! $profile) {
            // Fallback data if no profile exists
            $profile = (object) [
                'full_name' => 'Khurshid Alam',
                'designation' => 'Full Stack AI Developer',
                'short_description' => 'Full Stack AI Developer with 10+ years of expertise in building innovative software solutions.',
                'experience_summary' => 'Experienced developer specializing in AI integration and enterprise solutions.',
                'avatar_url' => 'assets/default-avatar.jpg',
                'portfolio_github_folder_link' => '#',
                'linked_link' => 'https://www.linkedin.com/in/khurshid-alam-43b4131aa/',
                'twitter_link' => 'https://twitter.com/khurshidalam', // Add your Twitter handle
                'email' => 'khurshidalam741@gmail.com',
            ];
        } else {
            // Get experiences for the active profile, ordered by start_date (newest first)
            $experiences = Experience::where('profile_id', $profile->id)
                ->orderBy('sort_order', 'asc')
                ->orderBy('start_date', 'desc')
                ->get();

            // Get projects for the active profile with their technologies
            $projects = Project::where('profile_id', $profile->id)
                ->with('technologies') // Eager load technologies
                ->orderBy('is_featured', 'desc') // Featured first
                ->orderBy('sort_order', 'asc')
                ->orderBy('created_at', 'desc')
                ->get();

            // Get stack items for the active profile with technologies
            $stackItems = StackItem::where('profile_id', $profile->id)
                ->with('technology')
                ->orderBy('sort_order', 'asc')
                ->orderBy('proficiency_level', 'desc')
                ->get();

        }

        return view('home', compact('profile', 'experiences', 'projects', 'stackItems'));
    }
}
