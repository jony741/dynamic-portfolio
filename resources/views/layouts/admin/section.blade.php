{{-- resources/views/components/layouts/admin/section.blade.php --}}

@props([
    'heading'    => '',
    'subheading' => '',
])

<div class="w-full space-y-6">

    {{-- Page Header --}}
    @if($heading || $subheading)
        <div class="border-b border-zinc-200 pb-6 dark:border-zinc-700">
            @if($heading)
                <flux:heading size="xl">{{ $heading }}</flux:heading>
            @endif
            @if($subheading)
                <flux:subheading class="mt-1">{{ $subheading }}</flux:subheading>
            @endif
        </div>
    @endif

    {{-- Page Content --}}
    <div>
        {{ $slot }}
    </div>

</div>