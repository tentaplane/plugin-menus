@extends('tentapress-admin::layouts.shell')

@section('title', 'Add Menu')

@section('content')
    <div class="tp-page-header">
        <div>
            <h1 class="tp-page-title">Add Menu</h1>
            <p class="tp-description">Create a new navigation menu.</p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('tp.menus.index') }}" class="tp-button-secondary">Back</a>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-5 lg:grid-cols-4">
        <div class="space-y-5 lg:col-span-3">
            <div class="tp-metabox">
                <div class="tp-metabox__body">
                    <form method="POST" action="{{ route('tp.menus.store') }}" class="space-y-4" id="menu-form">
                        @csrf

                        <div class="tp-field">
                            <label class="tp-label">Name</label>
                            <input name="name" class="tp-input" value="{{ old('name', $menu->name) }}" required />
                        </div>

                        <div class="tp-field">
                            <label class="tp-label">Slug</label>
                            <input
                                name="slug"
                                class="tp-input"
                                value="{{ old('slug', $menu->slug) }}"
                                placeholder="auto-generated"
                                pattern="[a-z0-9-]+" />
                            <div class="tp-help">Lowercase letters, numbers, and dashes only.</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="space-y-5 lg:sticky lg:top-6 lg:self-start">
            <div class="tp-metabox">
                <div class="tp-metabox__title">Actions</div>
                <div class="tp-metabox__body space-y-3 text-sm">
                    <button type="submit" form="menu-form" class="tp-button-primary">Create Menu</button>
                </div>
            </div>

            @if (!empty($tpMenuLocations))
                <div class="tp-metabox">
                    <div class="tp-metabox__title">Theme locations</div>
                    <div class="tp-metabox__body space-y-2 text-sm">
                        @foreach ($tpMenuLocations as $loc)
                            @php
                                $label = (string) ($loc['label'] ?? $loc['key'] ?? 'Location');
                                $key = (string) ($loc['key'] ?? '');
                            @endphp

                            @if ($key !== '')
                                <div class="flex items-center justify-between gap-3">
                                    <div class="font-semibold">{{ $label }}</div>
                                    <div class="tp-code text-[11px]">{{ $key }}</div>
                                </div>
                            @endif
                        @endforeach

                        <div class="tp-muted pt-2 text-xs">Assign menus to these locations after creation.</div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
