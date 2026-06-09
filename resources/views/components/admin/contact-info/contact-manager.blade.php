<?php
// resources/views/livewire/admin/contact-info/contact-manager.blade.php

use App\Models\ContactInfo;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Flux\Flux;

new #[Title('Contact Info')] class extends Component {
    use WithPagination;

    public int $profileId;

    // form fields
    public string $type = '';
    public string $label = '';
    public string $value = '';
    public string $icon_slug = '';
    public bool $is_visible = true;
    public int $sort_order = 0;

    // state
    public bool $showForm = false;
    public ?int $editingId = null;

    public array $types = [
        'email', 'phone', 'github', 'linkedin', 'twitter', 'website', 'other'
    ];

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
        $item = ContactInfo::findOrFail($id);

        $this->editingId  = $item->id;
        $this->type       = $item->type;
        $this->label      = $item->label;
        $this->value      = $item->value;
        $this->icon_slug  = $item->icon_slug ?? '';
        $this->is_visible = $item->is_visible;
        $this->sort_order = $item->sort_order;
        $this->showForm   = true;
    }

    public function save(): void
    {
        $this->validate([
            'type'       => 'required|string|max:255',
            'label'      => 'required|string|max:255',
            'value'      => 'required|string|max:255',
            'icon_slug'  => 'nullable|string|max:255',
            'is_visible' => 'boolean',
            'sort_order' => 'required|integer|min:0',
        ]);

        $data = [
            'profile_id'  => $this->profileId,
            'type'        => $this->type,
            'label'       => $this->label,
            'value'       => $this->value,
            'icon_slug'   => $this->icon_slug,
            'is_visible'  => $this->is_visible,
            'sort_order'  => $this->sort_order,
        ];

        if ($this->editingId) {
            ContactInfo::findOrFail($this->editingId)->update($data);
            Flux::toast(variant: 'success', text: __('Contact info updated successfully.'));
        } else {
            ContactInfo::create($data);
            Flux::toast(variant: 'success', text: __('Contact info added successfully.'));
        }

        unset($this->contactItems);
        $this->resetForm();
        $this->showForm = false;
    }

    public function delete(int $id): void
    {
        ContactInfo::findOrFail($id)->delete();
        unset($this->contactItems);
        Flux::toast(variant: 'danger', text: __('Contact info deleted.'));
    }

    public function cancel(): void
    {
        $this->resetForm();
        $this->showForm = false;
    }

    private function resetForm(): void
    {
        $this->type       = '';
        $this->label      = '';
        $this->value      = '';
        $this->icon_slug  = '';
        $this->is_visible = true;
        $this->sort_order = 0;
        $this->editingId  = null;
    }

    #[Computed]
    public function contactItems()
    {
        return ContactInfo::where('profile_id', $this->profileId)
            ->orderBy('sort_order')
            ->paginate(10);
    }
}; ?>

<section class="w-full">
    <x-layouts::admin.section
            :heading="__('Contact Info')"
            :subheading="__('Manage your contact details and social links')"
    >

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <flux:heading size="lg">{{ __('Contact Details') }}</flux:heading>
            @if(!$showForm)
                <flux:button wire:click="create" variant="primary" icon="plus">
                    {{ __('Add Contact') }}
                </flux:button>
            @endif
        </div>

        {{-- Form --}}
        @if($showForm)
            <div class="mb-8 rounded-xl border p-6 bg-zinc-50 dark:bg-zinc-900">
                <flux:heading size="lg" class="mb-4">
                    {{ $editingId ? __('Edit Contact') : __('Add Contact') }}
                </flux:heading>

                <form wire:submit="save" class="space-y-5">

                    {{-- Type --}}
                    <flux:select wire:model="type" :label="__('Type')">
                        <flux:select.option value="">{{ __('Select type') }}</flux:select.option>
                        @foreach($types as $t)
                            <flux:select.option value="{{ $t }}">{{ ucfirst($t) }}</flux:select.option>
                        @endforeach
                    </flux:select>

                    {{-- Label --}}
                    <flux:input
                            wire:model="label"
                            :label="__('Label')"
                            type="text"
                            required
                            placeholder="e.g. Work Email"
                    />

                    {{-- Value --}}
                    <flux:input
                            wire:model="value"
                            :label="__('Value')"
                            type="text"
                            required
                            placeholder="e.g. khurshid@example.com or https://github.com/khurshid"
                    />

                    {{-- Icon Slug --}}
                    <flux:input
                            wire:model="icon_slug"
                            :label="__('Icon Slug')"
                            type="text"
                            placeholder="e.g. github, linkedin, envelope"
                    />

                    {{-- Sort Order --}}
                    <flux:input
                            wire:model="sort_order"
                            :label="__('Sort Order')"
                            type="number"
                    />

                    {{-- Is Visible --}}
                    <div>
                        <div class="flex items-center gap-3">
                            <flux:switch wire:model="is_visible" />
                            <flux:label>{{ __('Visible on portfolio') }}</flux:label>
                        </div>
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
                    <th class="px-4 py-3 text-left">{{ __('Type') }}</th>
                    <th class="px-4 py-3 text-left">{{ __('Label') }}</th>
                    <th class="px-4 py-3 text-left">{{ __('Value') }}</th>
                    <th class="px-4 py-3 text-left">{{ __('Visible') }}</th>
                    <th class="px-4 py-3 text-left">{{ __('Order') }}</th>
                    <th class="px-4 py-3 text-right">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody class="divide-y">
                @forelse($this->contactItems as $item)
                    <tr>
                        <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded bg-zinc-100 dark:bg-zinc-800">
                                    {{ ucfirst($item->type) }}
                                </span>
                        </td>
                        <td class="px-4 py-3 font-medium">{{ $item->label }}</td>
                        <td class="px-4 py-3 text-zinc-500 max-w-xs truncate">{{ $item->value }}</td>
                        <td class="px-4 py-3">
                            @if($item->is_visible)
                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300">
                                        {{ __('Yes') }}
                                    </span>
                            @else
                                <span class="px-2 py-1 text-xs rounded bg-zinc-100 text-zinc-500 dark:bg-zinc-800">
                                        {{ __('No') }}
                                    </span>
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
                            {{ __('No contact info yet.') }}
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            @if($this->contactItems->hasPages())
                <div class="p-3 border-t">{{ $this->contactItems->links() }}</div>
            @endif
        </div>

    </x-layouts::admin.section>
</section>