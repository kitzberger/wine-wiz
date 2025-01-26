<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="mt-4">
        <p class="mb-4">
            <a href="{{ route('food.index') }}" class="text-black dark:text-gray-300">
                <i class="las la-arrow-left"></i> {{ __('app.back-to-list') }}
            </a>
        </p>
        @if($food)
            <h1>{{ $food->name }}</h1>
            <table class="table table-striped">
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
