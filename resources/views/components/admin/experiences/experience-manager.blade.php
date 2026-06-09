<?php
// resources/views/livewire/admin/experiences/experience-manager.blade.php

use App\Models\Experience;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Flux\Flux;

new #[Title('Experience')] class extends Component {
    use WithPagination;

    public int $profileId;

    // form fields
    public string $company_name = '';
    public string $position = '';
    public string $location = '';
    public string $start_date = '';
    public string $end_date = '';
    public bool $is_current = false;
    public string $responsibility = '';
    public int $sort_order = 0;

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
        $item = Experience::findOrFail($id);

        $this->editingId      = $item->id;
        $this->company_name   = $item->company_name;
        $this->position       = $item->position;
        $this->location       = $item->location ?? '';
        $this->start_date     = $item->start_date->format('Y-m-d');
        $this->end_date       = $item->end_date ? $item->end_date->format('Y-m-d') : '';
        $this->is_current     = $item->is_current;
        $this->responsibility = $item->responsibility;
        $this->sort_order     = $item->sort_order;
        $this->showForm       = true;
    }

    public function save(): void
    {
        $this->validate([
            'company_name'   => 'required|string|max:255',
            'position'       => 'required|string|max:255',
            'location'       => 'nullable|string|max:255',
            'start_date'     => 'required|date',
            'end_date'       => 'nullable|date|after_or_equal:start_date',
            'is_current'     => 'boolean',
            'responsibility' => 'required|string',
            'sort_order'     => 'required|integer|min:0',
        ]);

        $data = [
            'profile_id'     => $this->profileId,
            'company_name'   => $this->company_name,
            'position'       => $this->position,
            'location'       => $this->location,
            'start_date'     => $this->start_date,
            'end_date'       => $this->is_current ? null : $this->end_date,
            'is_current'     => $this->is_current,
            'responsibility' => $this->responsibility,
            'sort_order'     => $this->sort_order,
        ];

        if ($this->editingId) {
            Experience::findOrFail($this->editingId)->update($data);
            Flux::toast(variant: 'success', text: __('Experience updated successfully.'));
        } else {
            Experience::create($data);
            Flux::toast(variant: 'success', text: __('Experience added successfully.'));
        }

        unset($this->experiences);
        $this->resetForm();
        $this->showForm = false;
    }

    public function delete(int $id): void
    {
        Experience::findOrFail($id)->delete();
        unset($this->experiences);
        Flux::toast(variant: 'danger', text: __('Experience deleted.'));
    }

    public function cancel(): void
    {
        $this->resetForm();
        $this->showForm = false;
    }

    private function resetForm(): void
    {
        $this->company_name   = '';
        $this->position       = '';
        $this->location       = '';
        $this->start_date     = '';
        $this->end_date       = '';
        $this->is_current     = false;
        $this->responsibility = '';
        $this->sort_order     = 0;
        $this->editingId      = null;
    }

    #[Computed]
    public function experiences()
    {
        return Experience::where('profile_id', $this->profileId)
            ->orderBy('sort_order')
            ->paginate(10);
    }
}; ?>

<section class="w-full">
    <x-layouts::admin.section
            :heading="__('Experience')"
            :subheading="__('Manage your work experience history')"
    >

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <flux:heading size="lg">{{ __('Work Experience') }}</flux:heading>
            @if(!$showForm)
                <flux:button wire:click="create" variant="primary" icon="plus">
                    {{ __('Add Experience') }}
                </flux:button>
            @endif
        </div>

        {{-- Form --}}
        @if($showForm)
            <div class="mb-8 rounded-xl border p-6 bg-zinc-50 dark:bg-zinc-900">
                <flux:heading size="lg" class="mb-4">
                    {{ $editingId ? __('Edit Experience') : __('Add Experience') }}
                </flux:heading>

                <form wire:submit="save" class="space-y-5">

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        {{-- Company Name --}}
                        <flux:input
                                wire:model="company_name"
                                :label="__('Company Name')"
                                type="text"
                                required
                                placeholder="e.g. Acme Corporation"
                        />

                        {{-- Position --}}
                        <flux:input
                                wire:model="position"
                                :label="__('Position')"
                                type="text"
                                required
                                placeholder="e.g. Senior Laravel Developer"
                        />

                        {{-- Location --}}
                        <flux:input
                                wire:model="location"
                                :label="__('Location')"
                                type="text"
                                placeholder="e.g. Dhaka, Bangladesh"
                        />

                        {{-- Sort Order --}}
                        <flux:input
                                wire:model="sort_order"
                                :label="__('Sort Order')"
                                type="number"
                        />

                        {{-- Start Date --}}
                        <flux:input
                                wire:model="start_date"
                                :label="__('Start Date')"
                                type="date"
                                required
                        />

                        {{-- End Date --}}
                        <flux:input
                                wire:model="end_date"
                                :label="__('End Date')"
                                type="date"
                                :disabled="$is_current"
                        />

                    </div>

                    {{-- Is Current --}}
                    <div>
                        <div class="flex items-center gap-3">
                            <flux:switch wire:model.live="is_current" />
                            <flux:label>{{ __('Currently working here') }}</flux:label>
                        </div>
                    </div>

                    {{-- Responsibility --}}
                    <flux:textarea
                            wire:model="responsibility"
                            :label="__('Responsibilities')"
                            placeholder="Describe your key responsibilities and achievements..."
                            rows="4"
                            required
                    />

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
                    <th class="px-4 py-3 text-left">{{ __('Company') }}</th>
                    <th class="px-4 py-3 text-left">{{ __('Position') }}</th>
                    <th class="px-4 py-3 text-left">{{ __('Location') }}</th>
                    <th class="px-4 py-3 text-left">{{ __('Period') }}</th>
                    <th class="px-4 py-3 text-left">{{ __('Order') }}</th>
                    <th class="px-4 py-3 text-right">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody class="divide-y">
                @forelse($this->experiences as $item)
                    <tr>
                        <td class="px-4 py-3 font-medium">{{ $item->company_name }}</td>
                        <td class="px-4 py-3 text-zinc-500">{{ $item->position }}</td>
                        <td class="px-4 py-3 text-zinc-500">{{ $item->location ?? '—' }}</td>
                        <td class="px-4 py-3 text-zinc-500">
                            {{ $item->start_date->format('M Y') }} —
                            @if($item->is_current)
                                <span class="text-green-600 dark:text-green-400 font-medium">
                                        {{ __('Present') }}
                                    </span>
                            @else
                                {{ $item->end_date ? $item->end_date->format('M Y') : '—' }}
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
                        <td colspan="6" class="text-center p-8 text-zinc-400">
                            {{ __('No experience added yet.') }}
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            @if($this->experiences->hasPages())
                <div class="p-3 border-t">{{ $this->experiences->links() }}</div>
            @endif
        </div>

    </x-layouts::admin.section>
</section>