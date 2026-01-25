<x-filament-panels::page.simple>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|playfair-display:700" rel="stylesheet" />

    <style>
        :root {
            --primary: #1B5E20;
            --primary-light: #2E7D32;
        }

        /* Minimalist Page Background */
        .fi-simple-page {
            border-radius: 12px !important;
            background-color: #f9fafb !important;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .dark .fi-simple-page {
            background-color: #09090b !important;
        }

        /* Login Card - Clean & Simple */
        .fi-simple-main {
            background: white !important;
            border-radius: 12px !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1) !important;
            border: 1px solid #e5e7eb !important;
            padding: 1.5rem !important;
        }

        .dark .fi-simple-main {
            background: #18181b !important;
            border-color: #27272a !important;
            box-shadow: none !important;
        }

        /* Header Typography */
        .fi-simple-header-heading {
            font-family: 'Playfair Display', serif;
            color: #1B5E20 !important;
            font-size: 2rem !important;
            font-weight: 700 !important;
            letter-spacing: -0.025em !important;
        }

        .dark .fi-simple-header-heading {
            color: #4CAF50 !important;
        }

        /* Inputs */
        .fi-input {
            border-radius: 8px !important;
            border-color: #e5e7eb !important;
            padding: 0.75rem 1rem !important;
        }

        .fi-input:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 2px rgba(27, 94, 32, 0.1) !important;
        }

        /* Primary Button */
        .fi-btn-primary {
            background-color: #1B5E20 !important;
            border-radius: 8px !important;
            font-weight: 500 !important;
            transition: all 0.2s ease !important;
        }

        .fi-btn-primary:hover {
            background-color: #14532d !important;
        }

        .dark .fi-btn-primary {
            background-color: #2E7D32 !important;
        }

        .dark .fi-btn-primary:hover {
            background-color: #1B5E20 !important;
        }

        /* Hide default brand logo/text to avoid duplication */
        .fi-simple-header>a,
        .fi-simple-header>.fi-logo {
            display: none !important;
        }
    </style>

    @if (filament()->hasLogin())
        <x-slot name="heading">
            YASAWI
        </x-slot>
    @endif

    <x-filament-panels::form wire:submit="authenticate">
        {{ $this->form }}

        <x-filament-panels::form.actions :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()" />
    </x-filament-panels::form>

</x-filament-panels::page.simple>