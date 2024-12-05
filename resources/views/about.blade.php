<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            <a href="{{ route('root') }}">{{ __('Wine Wiz') }}</a>
        </h2>
    </x-slot>

    <div class="mt-4">
        <h3 class="font-semibold text-xl">{{ __('app.marketing_headline') }}</h3>
        <p class="mt-2 mb-2">
            {{ __('app.marketing') }}
        </p>
    </div>
</x-app-layout>
