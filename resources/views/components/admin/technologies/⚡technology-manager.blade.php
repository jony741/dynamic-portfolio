<?php
use App\Models\Technology;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Flux\Flux;
use Livewire\Attributes\Computed;

new #[Title('Technologies')] class extends Component {
    use WithPagination;

    // form fields
    public string $name = '';
    public string $icon_slug = '';
    public string $category = '';
    public string $color_hex = '#000000';

    // state
    public bool $showForm = false;
    public ?int $editingId = null;

    // available categories
    public array $categories = [
        'Backend',
        'Frontend',
        'Database',
        'Devops',
        'Mobile',
        'AI & Tools',
        'other'
    ];

    /**
     * Open form for creating new technology.
     */
    public function create(): void
    {
        $this->resetForm();
        $this->showForm = true;
        $this->editingId = null;
    }

    /**
     * Open form for editing existing technology.
     */
    public function edit(int $id): void
    {
        $technology = Technology::findOrFail($id);

        $this->editingId  = $technology->id;
        $this->name       = $technology->name;
        $this->icon_slug  = $technology->icon_slug ?? '';
        $this->category   = $technology->category ?? '';
        $this->color_hex  = $technology->color_hex ?? '#000000';
        $this->showForm   = true;
    }

    /**
     * Save or update the technology.
     */
    public function save(): void
    {
        $this->validate([
            'name'       => 'required|string|max:255',
            'icon_slug'  => 'nullable|string|max:255',
            'category'   => 'nullable|string|max:255',
            'color_hex'  => 'nullable|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        $data = [
            'name'      => $this->name,
            'icon_slug' => $this->icon_slug,
            'category'  => $this->category,
            'color_hex' => $this->color_hex,
        ];

        if ($this->editingId) {
            Technology::findOrFail($this->editingId)->update($data);
            Flux::toast(variant: 'success', text: __('Technology updated successfully.'));
        } else {
            Technology::create($data);
            Flux::toast(variant: 'success', text: __('Technology created successfully.'));
        }

        $this->resetForm();
        $this->showForm = false;
    }

    /**
     * Delete a technology.
     */
    public function delete(int $id): void
    {
        Technology::findOrFail($id)->delete();
        Flux::toast(variant: 'danger', text: __('Technology deleted.'));
    }

    /**
     * Cancel and close the form.
     */
    public function cancel(): void
    {
        $this->resetForm();
        $this->showForm = false;
    }

    /**
     * Reset all form fields.
     */
    private function resetForm(): void
    {
        $this->name      = '';
        $this->icon_slug = '';
        $this->category  = '';
        $this->color_hex = '#000000';
        $this->editingId = null;
    }

    #[Computed]
    public function technologies()
    {
        return Technology::orderBy('category')
            ->orderBy('name')
            ->paginate(10);
    }

};
?>

<section class="w-full">
    <x-layouts::admin.section
            :heading="__('Technologies')"
            :subheading="__('Manage technologies used in your projects and tech stack')"
    >

        {{-- Header Row --}}
        <div class="flex items-center justify-between mb-6">
            <flux:heading size="lg">{{ __('All Technologies') }}</flux:heading>
            @if(!$showForm)
                <flux:button variant="primary" wire:click="create" icon="plus">
                    {{ __('Add Technology') }}
                </flux:button>
            @endif
        </div>

        {{-- Create / Edit Form --}}
        @if($showForm)
            <div class="mb-8 rounded-xl border border-zinc-200 bg-zinc-50 p-6 dark:border-zinc-700 dark:bg-zinc-900">

                <flux:heading size="lg" class="mb-6">
                    {{ $editingId ? __('Edit Technology') : __('Add Technology') }}
                </flux:heading>

                <form wire:submit="save" class="space-y-5">

                    {{-- Name --}}
                    <flux:input
                            wire:model="name"
                            :label="__('Name')"
                            type="text"
                            required
                            autofocus
                            placeholder="e.g. Laravel"
                    />

                    {{-- Category --}}
                    <flux:select
                            wire:model="category"
                            :label="__('Category')"
                            placeholder="{{ __('Select a category') }}"
                    >
                        @foreach($categories as $cat)
                            <flux:select.option value="{{ $cat }}">
                                {{ ucfirst($cat) }}
                            </flux:select.option>
                        @endforeach
                    </flux:select>

                    {{-- Icon Slug --}}
                    <flux:input
                            wire:model="icon_slug"
                            :label="__('Icon Slug')"
                            type="text"
                            placeholder="e.g. laravel, vuejs, mysql"
                    />
                    <flux:description>
                        {{ __('Use devicon slug names. Browse at') }}
                        <a href="https://devicon.dev" target="_blank" class="underline">devicon.dev</a>
                    </flux:description>

                    {{-- Color --}}
                    <div>
                        <flux:label>{{ __('Brand Color') }}</flux:label>
                        <div class="mt-2 flex items-center gap-3">
                            <input
                                    type="color"
                                    wire:model="color_hex"
                                    class="size-10 cursor-pointer rounded border border-zinc-300 dark:border-zinc-600"
                            />
                            <flux:input
                                    wire:model="color_hex"
                                    type="text"
                                    placeholder="#FF2D20"
                                    class="w-32"
                            />
                        </div>
                        @error('color_hex')
                        <flux:error>{{ $message }}</flux:error>
                        @enderror
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-3 pt-2">
                        <flux:button variant="primary" type="submit">
                            {{ $editingId ? __('Update') : __('Save') }}
                        </flux:button>
                        <flux:button variant="ghost" wire:click="cancel" type="button">
                            {{ __('Cancel') }}
                        </flux:button>
                    </div>

                </form>
            </div>
        @endif

        {{-- Technologies Table --}}
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-700">
            <table class="w-full text-sm">
                <thead class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-zinc-600 dark:text-zinc-400">
                        {{ __('Name') }}
                    </th>
                    <th class="px-4 py-3 text-left font-medium text-zinc-600 dark:text-zinc-400">
                        {{ __('Category') }}
                    </th>
                    <th class="px-4 py-3 text-left font-medium text-zinc-600 dark:text-zinc-400">
                        {{ __('Icon Slug') }}
                    </th>
                    <th class="px-4 py-3 text-left font-medium text-zinc-600 dark:text-zinc-400">
                        {{ __('Color') }}
                    </th>
                    <th class="px-4 py-3 text-right font-medium text-zinc-600 dark:text-zinc-400">
                        {{ __('Actions') }}
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                @forelse($this->technologies as $technology)
                    <tr class="bg-white dark:bg-zinc-800">
                        <td class="px-4 py-3 font-medium text-zinc-900 dark:text-white">
                            {{ $technology->name }}
                        </td>
                        <td class="px-4 py-3 text-zinc-600 dark:text-zinc-400">
                            @if($technology->category)
                                <span class="inline-flex items-center rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium dark:bg-zinc-700">
                                        {{ ucfirst($technology->category) }}
                                    </span>
                            @else
                                <span class="text-zinc-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-zinc-600 dark:text-zinc-400">
                            {{ $technology->icon_slug ?? '—' }}
                        </td>
                        <td class="px-4 py-3">
                            @if($technology->color_hex)
                                <div class="flex items-center gap-2">
                                    <div
                                            class="size-5 rounded border border-zinc-200 dark:border-zinc-600"
                                            style="background-color: {{ $technology->color_hex }}"
                                    ></div>
                                    <span class="text-zinc-600 dark:text-zinc-400 text-xs">
                                            {{ $technology->color_hex }}
                                        </span>
                                </div>
                            @else
                                <span class="text-zinc-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <flux:button
                                        size="sm"
                                        variant="ghost"
                                        icon="pencil"
                                        wire:click="edit({{ $technology->id }})"
                                />
                                <flux:button
                                        size="sm"
                                        variant="danger"
                                        icon="trash"
                                        wire:click="delete({{ $technology->id }})"
                                        wire:confirm="{{ __('Are you sure you want to delete this technology?') }}"
                                />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-zinc-400">
                            {{ __('No technologies found. Add your first one!') }}
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            @if($this->technologies->hasPages())
                <div class="border-t border-zinc-200 px-4 py-3 dark:border-zinc-700">
                    {{ $this->technologies->links() }}
                </div>
            @endif
        </div>

    </x-layouts::admin.section>
</section>