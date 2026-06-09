<?php

use App\Models\StackItem;
use App\Models\Technology;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Flux\Flux;

new #[Title('Tech Stack')] class extends Component {
    use WithPagination;

    public int $profileId;

    // form fields
    public ?int $technology_id = null;
    public int $proficiency_level = 3;
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
        $item = StackItem::with('technology')->findOrFail($id);

        $this->editingId = $item->id;
        $this->technology_id = $item->technology_id;
        $this->proficiency_level = $item->proficiency_level;
        $this->sort_order = $item->sort_order;

        $this->showForm = true;
    }

    public function save(): void
    {
//        dd($this->technology_id);
        $this->validate([
            'technology_id'      => 'required|exists:technologies,id',
            'proficiency_level'  => 'required|integer|min:1|max:5',
            'sort_order'         => 'required|integer|min:0',
        ]);

        $data = [
            'profile_id'        => $this->profileId,
            'technology_id'     => $this->technology_id,
            'proficiency_level' => $this->proficiency_level,
            'sort_order'        => $this->sort_order,
        ];


        if ($this->editingId) {
            StackItem::findOrFail($this->editingId)->update($data);

            Flux::toast(
                variant: 'success',
                text: __('Tech stack updated successfully.')
            );
        } else {
            StackItem::create($data);

            Flux::toast(
                variant: 'success',
                text: __('Technology added to stack.')
            );
        }

        $this->resetForm();
        $this->showForm = false;
    }

    public function delete(int $id): void
    {
        StackItem::findOrFail($id)->delete();

        Flux::toast(
            variant: 'danger',
            text: __('Removed from tech stack.')
        );
    }

    public function cancel(): void
    {
        $this->resetForm();
        $this->showForm = false;
    }

    private function resetForm(): void
    {
        $this->technology_id = null;
        $this->proficiency_level = 3;
        $this->sort_order = 1;
        $this->editingId = null;
    }

    #[Computed]
    public function stackItems()
    {
        return StackItem::with('technology')
            ->where('profile_id', $this->profileId)
            ->orderBy('sort_order')
            ->paginate(10);
    }

    #[Computed]
    public function technologies()
    {
        // only show technologies NOT already in stack (important UX improvement)
        return Technology::whereNotIn('id', function ($query) {
            $query->select('technology_id')
                ->from('stack_items')
                ->where('profile_id', $this->profileId);
        })
            ->orderBy('name')
            ->get();
    }
};
?>
<section class="w-full">

    <x-layouts::admin.section
            :heading="__('Tech Stack')"
            :subheading="__('Manage technologies linked to your profile')"
    >

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <flux:heading size="lg">
                {{ __('My Tech Stack') }}
            </flux:heading>

            @if(!$showForm)
                <flux:button wire:click="create" variant="primary" icon="plus">
                    {{ __('Add Technology') }}
                </flux:button>
            @endif
        </div>

        {{-- FORM --}}
        @if($showForm)
            <div class="mb-8 rounded-xl border p-6 bg-zinc-50 dark:bg-zinc-900">

                <flux:heading size="lg" class="mb-4">
                    {{ $editingId ? __('Edit Stack Item') : __('Add to Stack') }}
                </flux:heading>

                <form wire:submit="save" class="space-y-5">

                    {{-- Technology --}}
                    <flux:select
                            wire:model="technology_id"
                            :label="__('Technology')"
                    >
                        <flux:select.option value="">
                            Select Technology
                        </flux:select.option>
                        @foreach($this->technologies as $tech)
                            <flux:select.option value="{{ $tech->id }}">
                                {{ $tech->name }}
                            </flux:select.option>
                        @endforeach
                    </flux:select>

                    {{-- Proficiency --}}
                    <flux:select
                            wire:model="proficiency_level"
                            :label="__('Proficiency (1–5)')"
                    >
                        @for($i = 1; $i <= 5; $i++)
                            <flux:select.option value="{{ $i }}">
                                {{ $i }}
                            </flux:select.option>
                        @endfor
                    </flux:select>

                    {{-- Sort Order --}}
                    <flux:input
                            type="number"
                            wire:model="sort_order"
                            :label="__('Sort Order')"
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

        {{-- TABLE --}}
        <div class="rounded-xl border">

            <table class="w-full text-sm">
                <thead class="bg-zinc-50 dark:bg-zinc-900 border-b">
                <tr>
                    <th class="px-4 py-3 text-left">{{ __('Technology') }}</th>
                    <th class="px-4 py-3 text-left">{{ __('Category') }}</th>
                    <th class="px-4 py-3 text-left">{{ __('Proficiency') }}</th>
                    <th class="px-4 py-3 text-left">{{ __('Order') }}</th>
                    <th class="px-4 py-3 text-right">{{ __('Actions') }}</th>
                </tr>
                </thead>

                <tbody class="divide-y">
                @forelse($this->stackItems as $item)
                    <tr>
                        <td class="px-4 py-3 font-medium">
                            {{ $item->technology->name }}
                        </td>

                        <td class="px-4 py-3 text-zinc-500">
                            {{ ucfirst($item->technology->category ?? '—') }}
                        </td>

                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded bg-zinc-100 dark:bg-zinc-800">
                                {{ $item->proficiency_level }}/5
                            </span>
                        </td>

                        <td class="px-4 py-3">
                            {{ $item->sort_order }}
                        </td>

                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">

                                <flux:button
                                        size="sm"
                                        icon="pencil"
                                        variant="ghost"
                                        wire:click="edit({{ $item->id }})"
                                />

                                <flux:button
                                        size="sm"
                                        icon="trash"
                                        variant="danger"
                                        wire:click="delete({{ $item->id }})"
                                        wire:confirm="Are you sure?"
                                />

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-8 text-zinc-400">
                            {{ __('No tech stack items yet.') }}
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            @if($this->stackItems->hasPages())
                <div class="p-3 border-t">
                    {{ $this->stackItems->links() }}
                </div>
            @endif

        </div>

    </x-layouts::admin.section>

</section>
