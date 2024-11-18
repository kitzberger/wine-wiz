<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">
            <a href="{{ route('root') }}">{{ __('Wine Wiz') }}</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl">{{ __("Welcome to the Wine Wiz!") }}</h3>
                    <p class="mt-2 mb-2">
                        {{ __('Who are you?') }}
                    </p>
                    <ul class="list-inside list-disc">
                        <li><a class="text-orange-700 hover:text-orange-500" href="{{ route('wine.wizard') }}">{{ __('Amateur') }}</a></li>
                        <li><a class="text-orange-700 hover:text-orange-500" href="{{ route('wine.wizard') }}">{{ __('Advanced') }}</a></li>
                        <li><a class="text-orange-700 hover:text-orange-500" href="{{ route('wine.index') }}">{{ __('Expert') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
