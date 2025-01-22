<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">
            <a href="{{ route('root') }}">{{ __('Wine Wiz') }}</a>: {{ $food?->name ?? '???' }}
        </h2>
    </x-slot>

    <div class="mt-4">
        <p class="mb-4">
            <a href="{{ route('food.index') }}" class="text-black dark:text-gray-300">
                <i class="las la-arrow-left"></i> {{ __('Back to list') }}
            </a>
        </p>
        @if($food)
        <table class="table table-striped">
            <tr class="">
                <th class="">{{ __('app.food.id') }}</th>
                <td class="">{{ $food->id }}</td>
            </tr>
            <tr class="">
                <th class="">{{ __('app.food.name') }}</th>
                <td class="">{{ $food->name }}</td>
            </tr>
            <tr class="">
                <th class="">{{ __('app.food.type') }}</th>
                <td class="">{{ trans('app.food.types.' . $food->type) }}</td>
            </tr>
            <tr class="">
                <th class="">{{ __('app.food.styles') }}</th>
                <td class="">
                    {!! $food->styles->pluck('name')->join('<br>') !!}
                </td>
            </tr>
        </table>
        @endif
    </div>
</x-app-layout>
