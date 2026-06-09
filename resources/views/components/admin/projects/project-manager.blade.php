<?php
// resources/views/livewire/admin/projects/project-manager.blade.php

use App\Models\Project;
use App\Models\Technology;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;
use Flux\Flux;

new #[Title('Projects')] class extends Component {
    use WithPagination, WithFileUploads;

    public int $profileId;

    // form fields
    public string $name = '';
    public string $description = '';
    public string $live_url = '';
    public string $repo_url = '';
    public string $thumbnail_url = '';
    public bool $is_featured = false;
    public int $sort_order = 0;
    public $newThumbnail = null;

    // ✅ NEW — selected technology ids for the form
    public array $selectedTechnologies = [];

    // state
    public bool $showForm = false;
    public ?int $editingId = null;

    public function mount(): void
    {
        $profile = \App\Models\Profile::first();
        abort_if(!$profile, 404, 'No profile found.');
        $this->profileId = $profile->id;
    }

    public function create(): void
    {
        $this->resetForm();
        $this->showForm = true;
        $this->editingId = null;
    }

    public function edit(int $id): void
    {
        $item = Project::with('technologies')->findOrFail($id);

        $this->editingId      = $item->id;
        $this->name           = $item->name;
        $this->description    = $item->description;
        $this->live_url       = $item->live_url ?? '';
        $this->repo_url       = $item->repo_url ?? '';
        $this->thumbnail_url  = $item->thumbnail_url ?? '';
        $this->is_featured    = $item->is_featured;
        $this->sort_order     = $item->sort_order;

        // ✅ NEW — load existing technology ids for checkboxes
        $this->selectedTechnologies = $item->technologies
            ->pluck('id')
            ->map(fn($id) => (string) $id)
            ->toArray();

        $this->showForm = true;
    }

    public function save(): void
    {
        $this->validate([
            'name'                 => 'required|string|max:255',
            'description'          => 'required|string',
            'live_url'             => 'nullable|url|max:255',
            'repo_url'             => 'nullable|url|max:255',
            'is_featured'          => 'boolean',
            'sort_order'           => 'required|integer|min:0',
            'newThumbnail'         => 'nullable|image|max:2048',
            // ✅ NEW
            'selectedTechnologies'   => 'nullable|array',
            'selectedTechnologies.*' => 'exists:technologies,id',
        ]);

        $thumbnailPath = $this->thumbnail_url;

        if ($this->newThumbnail) {
            $thumbnailPath = $this->newThumbnail->store('thumbnails', 'public');
        }

        $data = [
            'profile_id'    => $this->profileId,
            'name'          => $this->name,
            'description'   => $this->description,
            'live_url'      => $this->live_url,
            'repo_url'      => $this->repo_url,
            'thumbnail_url' => $thumbnailPath,
            'is_featured'   => $this->is_featured,
            'sort_order'    => $this->sort_order,
        ];

        if ($this->editingId) {
            $project = Project::findOrFail($this->editingId);
            $project->update($data);
            Flux::toast(variant: 'success', text: __('Project updated successfully.'));
        } else {
            $project = Project::create($data);
            Flux::toast(variant: 'success', text: __('Project added successfully.'));
        }

        // ✅ NEW — sync technologies with sort_order
        $syncData = [];
        foreach ($this->selectedTechnologies as $index => $techId) {
            $syncData[$techId] = ['sort_order' => $index + 1];
        }
        $project->technologies()->sync($syncData);

        unset($this->projects);
        $this->resetForm();
        $this->showForm = false;
    }

    public function delete(int $id): void
    {
        // technologies detach automatically via cascadeOnDelete
        Project::findOrFail($id)->delete();
        unset($this->projects);
        Flux::toast(variant: 'danger', text: __('Project deleted.'));
    }

    public function cancel(): void
    {
        $this->resetForm();
        $this->showForm = false;
    }

    private function resetForm(): void
    {
        $this->name                 = '';
        $this->description          = '';
        $this->live_url             = '';
        $this->repo_url             = '';
        $this->thumbnail_url        = '';
        $this->is_featured          = false;
        $this->sort_order           = 0;
        $this->newThumbnail         = null;
        $this->selectedTechnologies = []; // ✅ NEW
        $this->editingId            = null;
    }

    #[Computed]
    public function projects()
    {
        return Project::with('technologies')
            ->where('profile_id', $this->profileId)
            ->orderBy('sort_order')
            ->paginate(10);
    }

    // ✅ NEW — all technologies for the checkbox list
    #[Computed]
    public function allTechnologies()
    {
        return Technology::orderBy('category')->orderBy('name')->get();
    }
}; ?>

<section class="w-full">
    <x-layouts::admin.section
            :heading="__('Projects')"
            :subheading="__('Manage your portfolio projects')"
    >

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <flux:heading size="lg">{{ __('All Projects') }}</flux:heading>
            @if(!$showForm)
                <flux:button wire:click="create" variant="primary" icon="plus">
                    {{ __('Add Project') }}
                </flux:button>
            @endif
        </div>

        {{-- Form --}}
        @if($showForm)
            <div class="mb-8 rounded-xl border p-6 bg-zinc-50 dark:bg-zinc-900">
                <flux:heading size="lg" class="mb-4">
                    {{ $editingId ? __('Edit Project') : __('Add Project') }}
                </flux:heading>

                <form wire:submit="save" class="space-y-5">

                    {{-- Name --}}
                    <flux:input
                            wire:model="name"
                            :label="__('Project Name')"
                            type="text"
                            required
                            autofocus
                            placeholder="e.g. Portfolio Website"
                    />

                    {{-- Description --}}
                    <flux:textarea
                            wire:model="description"
                            :label="__('Description')"
                            placeholder="Describe the project, tech used, your role..."
                            rows="4"
                            required
                    />

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        {{-- Live URL --}}
                        <flux:input
                                wire:model="live_url"
                                :label="__('Live URL')"
                                type="url"
                                placeholder="https://yourproject.com"
                        />

                        {{-- Repo URL --}}
                        <flux:input
                                wire:model="repo_url"
                                :label="__('Repository URL')"
                                type="url"
                                placeholder="https://github.com/you/project"
                        />

                        {{-- Sort Order --}}
                        <flux:input
                                wire:model="sort_order"
                                :label="__('Sort Order')"
                                type="number"
                        />

                    </div>

                    {{-- Thumbnail --}}
                    <div>
                        <flux:label>{{ __('Thumbnail') }}</flux:label>
                        <div class="mt-2 flex items-center gap-4">
                            @if($thumbnail_url)
                                <img
                                        src="{{ asset('storage/' . $thumbnail_url) }}"
                                        alt="Thumbnail"
                                        class="h-16 w-24 rounded object-cover border"
                                />
                            @endif
                            <flux:input
                                    type="file"
                                    wire:model="newThumbnail"
                                    accept="image/*"
                            />
                        </div>
                        @error('newThumbnail')
                        <flux:error>{{ $message }}</flux:error>
                        @enderror
                    </div>

                    {{-- ✅ NEW — Technologies Checkboxes grouped by category --}}
                    <div>
                        <flux:label>{{ __('Technologies Used') }}</flux:label>
                        <flux:description class="mb-3">
                            {{ __('Select all technologies used in this project') }}
                        </flux:description>

                        @php
                            $grouped = $this->allTechnologies->groupBy('category');
                        @endphp

                        <div class="space-y-4 rounded-lg border p-4 bg-white dark:bg-zinc-800">
                            @forelse($grouped as $category => $techs)
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wide text-zinc-400 mb-2">
                                        {{ $category ? ucfirst($category) : __('Other') }}
                                    </p>
                                    <div class="grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-4">
                                        @foreach($techs as $tech)
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input
                                                        type="checkbox"
                                                        wire:model="selectedTechnologies"
                                                        value="{{ $tech->id }}"
                                                        class="rounded border-zinc-300 dark:border-zinc-600"
                                                />
                                                <span class="text-sm text-zinc-700 dark:text-zinc-300">
                                                    {{ $tech->name }}
                                                </span>
                                                @if($tech->color_hex)
                                                    <span
                                                            class="inline-block size-2 rounded-full flex-shrink-0"
                                                            style="background-color: {{ $tech->color_hex }}"
                                                    ></span>
                                                @endif
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-zinc-400">
                                    {{ __('No technologies found. Add some in the Technologies section first.') }}
                                </p>
                            @endforelse
                        </div>

                        @error('selectedTechnologies')
                        <flux:error>{{ $message }}</flux:error>
                        @enderror
                    </div>

                    {{-- Is Featured --}}
                    <div>
                        <div class="flex items-center gap-3">
                            <flux:switch wire:model="is_featured" />
                            <flux:label>{{ __('Featured Project') }}</flux:label>
                        </div>
                        <flux:description class="mt-1">
                            {{ __('Featured projects are highlighted on your portfolio homepage.') }}
                        </flux:description>
                    </div>

                    {{-- Actions --}}
                    <div class="flex gap-3 pt-2">
                        <flux:button type="submit" variant="primary">
                            {{ $editingId ? __('Update') : __('Save') }}
                        </flux:button>
                        <flux:button type="button" variant="ghost" wire:click="cancel">
                            {{ __('Cancel') }}
                        </flux:button>
                    </div>

                </form>
            </div>
        @endif

        {{-- Table --}}
        <div class="rounded-xl border">
            <table class="w-full text-sm">
                <thead class="bg-zinc-50 dark:bg-zinc-900 border-b">
                <tr>
                    <th class="px-4 py-3 text-left">{{ __('Thumbnail') }}</th>
                    <th class="px-4 py-3 text-left">{{ __('Name') }}</th>
                    <th class="px-4 py-3 text-left">{{ __('Technologies') }}</th>
                    <th class="px-4 py-3 text-left">{{ __('Links') }}</th>
                    <th class="px-4 py-3 text-left">{{ __('Featured') }}</th>
                    <th class="px-4 py-3 text-left">{{ __('Order') }}</th>
                    <th class="px-4 py-3 text-right">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody class="divide-y">
                @forelse($this->projects as $item)
                    <tr>
                        <td class="px-4 py-3">
                            @if($item->thumbnail_url)
                                <img
                                        src="{{ asset('storage/' . $item->thumbnail_url) }}"
                                        alt="{{ $item->name }}"
                                        class="h-10 w-16 rounded object-cover border"
                                />
                            @else
                                <div class="h-10 w-16 rounded bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center">
                                    <flux:icon name="photo" class="size-4 text-zinc-400" />
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium">{{ $item->name }}</td>

                        {{-- ✅ NEW — show technology badges in table --}}
                        <td class="px-4 py-3">
                            @if($item->technologies->isNotEmpty())
                                <div class="flex flex-wrap gap-1">
                                    @foreach($item->technologies as $tech)
                                        <span
                                                class="px-2 py-0.5 text-xs rounded-full text-white"
                                                style="background-color: {{ $tech->color_hex ?? '#6b7280' }}"
                                        >
                                                {{ $tech->name }}
                                            </span>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-zinc-400">—</span>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                @if($item->live_url)
                                    <a href="{{ $item->live_url }}" target="_blank" class="text-xs text-blue-500 underline">
                                        {{ __('Live') }}
                                    </a>
                                @endif
                                @if($item->repo_url)
                                    <a href="{{ $item->repo_url }}" target="_blank" class="text-xs text-blue-500 underline">
                                        {{ __('Repo') }}
                                    </a>
                                @endif
                                @if(!$item->live_url && !$item->repo_url)
                                    <span class="text-zinc-400">—</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            @if($item->is_featured)
                                <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300">
                                        {{ __('Yes') }}
                                    </span>
                            @else
                                <span class="text-zinc-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $item->sort_order }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <flux:button size="sm" icon="pencil" variant="ghost" wire:click="edit({{ $item->id }})" />
                                <flux:button size="sm" icon="trash" variant="danger" wire:click="delete({{ $item->id }})" wire:confirm="Are you sure?" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center p-8 text-zinc-400">
                            {{ __('No projects added yet.') }}
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            @if($this->projects->hasPages())
                <div class="p-3 border-t">{{ $this->projects->links() }}</div>
            @endif
        </div>

    </x-layouts::admin.section>
</section>