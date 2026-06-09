<?php

use App\Models\Profile;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Flux\Flux;

new #[Title('Portfolio Profile')] class extends Component {
    use WithFileUploads;

    public string $full_name = '';
    public string $designation = '';
    public string $short_description = '';
    public string $experience_summary = '';
    public string $avatar_url = '';
    public string $portfolio_github_folder_link = '';
    public string $linked_link = '';
    public bool $is_active = true;
    public $newAvatar = null;
    public ?Profile $profile = null;

    public function mount(): void
    {
        $this->profile = Profile::first();

        if ($this->profile) {
            $this->full_name          = $this->profile->full_name;
            $this->designation        = $this->profile->designation;
            $this->short_description  = $this->profile->short_description ?? '';
            $this->experience_summary = $this->profile->experience_summary ?? '';
            $this->avatar_url         = $this->profile->avatar_url ?? '';
            $this->portfolio_github_folder_link         = $this->profile->portfolio_github_folder_link ?? '';
            $this->linked_link         = $this->profile->linked_link ?? '';
            $this->is_active          = $this->profile->is_active;
        }
    }

    public function saveProfile(): void
    {
        $this->validate([
            'full_name'          => 'required|string|max:255',
            'designation'        => 'required|string|max:255',
            'short_description'  => 'nullable|string',
            'experience_summary' => 'nullable|string',
            'is_active'          => 'boolean',
            'newAvatar'          => 'nullable|image|max:2048',
        ]);

        $avatarPath = $this->avatar_url;

        if ($this->newAvatar) {
            $avatarPath = $this->newAvatar->store('avatars', 'public');
        }

        $data = [
            'full_name'          => $this->full_name,
            'designation'        => $this->designation,
            'short_description'  => $this->short_description,
            'experience_summary' => $this->experience_summary,
            'avatar_url'         => $avatarPath,
            'portfolio_github_folder_link'         => $this->portfolio_github_folder_link,
            'linked_link'         => $this->linked_link,
            'is_active'          => $this->is_active,
        ];

        if ($this->profile) {
            $this->profile->update($data);
        } else {
            $this->profile = Profile::create($data);
        }

        Flux::toast(variant: 'success', text: __('Profile saved successfully.'));
    }
}; ?>

<section class="w-full">

    {{-- ✅ use your new generic layout instead of x-pages::settings.layout --}}
    <x-layouts::admin.section
            :heading="__('Portfolio Profile')"
            :subheading="__('Update your portfolio profile information')"
    >
        <form wire:submit="saveProfile" class="w-full space-y-6">

            {{-- Avatar --}}
            <div>
                <flux:label>{{ __('Avatar') }}</flux:label>
                <div class="mt-2 flex items-center gap-4">
                    @if($avatar_url)
                        <img
                                src="{{ asset('storage/' . $avatar_url) }}"
                                alt="Avatar"
                                class="size-14 rounded-full object-cover"
                        />
                    @else
                        <div class="flex size-14 items-center justify-center rounded-full bg-zinc-200 dark:bg-zinc-700">
                            <flux:icon name="user" class="size-7 text-zinc-400" />
                        </div>
                    @endif

                    <flux:input
                            type="file"
                            wire:model="newAvatar"
                            accept="image/*"
                    />
                </div>
                @error('newAvatar')
                <flux:error>{{ $message }}</flux:error>
                @enderror
            </div>

            {{-- Full Name --}}
            <flux:input
                    wire:model="full_name"
                    :label="__('Full Name')"
                    type="text"
                    required
                    autofocus
                    placeholder="e.g. Khurshid Alam"
            />

            {{-- Designation --}}
            <flux:input
                    wire:model="designation"
                    :label="__('Designation')"
                    type="text"
                    required
                    placeholder="e.g. Senior Laravel Developer"
            />

            {{-- Short Description --}}
            <flux:textarea
                    wire:model="short_description"
                    :label="__('Short Description')"
                    placeholder="Brief introduction shown on your portfolio homepage..."
                    rows="3"
            />

            {{-- Experience Summary --}}
            <flux:textarea
                    wire:model="experience_summary"
                    :label="__('Experience Summary')"
                    placeholder="Overall summary of your professional experience..."
                    rows="5"
            />

            {{-- Github Folder link --}}
            <flux:input
                    wire:model="portfolio_github_folder_link"
                    :label="__('Portfolio Github Repo')"
                    type="text"
                    required
                    placeholder="e.g. Portfolio github repo"
            />

            {{-- Github Folder link --}}
            <flux:input
                    wire:model="linked_link"
                    :label="__('Linked In Link')"
                    type="text"
                    required
                    placeholder="e.g. Linked In Link"
            />

            {{-- Is Active --}}
            <div>
                <div class="flex items-center gap-3">
                    <flux:switch wire:model="is_active" />
                    <flux:label>{{ __('Active Profile') }}</flux:label>
                </div>
                <flux:description class="mt-1">
                    {{ __('When enabled, this profile is publicly visible on your portfolio.') }}
                </flux:description>
            </div>

            {{-- Submit --}}
            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit">
                    {{ $profile ? __('Update Profile') : __('Create Profile') }}
                </flux:button>
            </div>

        </form>
    </x-layouts::admin.section>

</section>