<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">
            <a href="{{ route('root') }}">{{ __('Wine Wiz') }}</a>: {{ $wine?->name ?? '???' }}
        </h2>
    </x-slot>

    <div class="mt-4">
        <p class="mb-4">
            <a href="{{ route('wine.index') }}" class="text-black dark:text-gray-300">
                <i class="las la-arrow-left"></i> {{ __('Back to list') }}
            </a>
        </p>
        @if($wine)
        <table class="table table-striped">
            <tr class="">
                <th class="">{{ __('app.wine.id') }}</th>
                <td class="">{{ $wine->id }}</td>
            </tr>
            <tr class="">
                <th class="">{{ __('app.wine.name') }}</th>
                <td class="">{{ $wine->name }}</td>
            </tr>
            <tr class="">
                <th class="">{{ __('app.wine.info') }}</th>
                <td class="">{{ $wine->info }}</td>
            </tr>
            <tr class="">
                <th class="">{{ __('app.wine.winemaker') }}</th>
                <td class="">{{ $wine->winemaker?->name }}</td>
            </tr>
            <tr class="">
                <th class="">{{ __('app.wine.location') }}</th>
                <td class="">
                    {{ $wine->city?->name ?? '???' }}, {{ $wine->region?->name ?? '???' }}, {{ $wine->country?->name ?? '???'}}
                </td>
            </tr>
            <tr class="">
                <th class="">{{ __('app.wine.category') }}</th>
                <td class="">{{ $wine->category?->name }}</td>
            </tr>
            <tr class="">
                <th class="">{{ __('app.wine.style') }}</th>
                <td class="">{{ $wine->style ? __('app.wine.style.' . $wine->style) : '-' }}</td>
            </tr>
            <tr class="">
                <th class="">{{ __('app.wine.grapes') }}</th>
                <td class="">
                    @foreach ($wine->grapes as $grape)
                        <span style="white-space: nowrap;">
                            {{ $grape->pivot->percentage ? $grape->pivot->percentage . '%' : '' }}
                            {{ $grape->name }}
                        </span><br>
                    @endforeach
                </td>
            </tr>
            <tr class="">
                <th class="">{{ __('app.wine.vintage') }}</th>
                <td class="">{{ $wine->vintage }}</td>
            </tr>
            <tr class="">
                <th class="">{{ __('app.wine.plu') }}</th>
                <td class="">{{ $wine->plu }}</td>
            </tr>
            <tr class="">
                <th class="">{{ __('app.wine.bottle_size' ) }}</th>
                <td class="">{{ $wine->bottle_size }}</td>
            </tr>
            <tr class="">
                <th class="">{{ __('app.wine.alcohol') }}</th>
                <td class="">{{ $wine->alcohol }}</td>
            </tr>
            <tr class="">
                <th class="">{{ __('app.wine.acidity') }}</th>
                <td class="">{{ $wine->acidity }}</td>
            </tr>
            <tr class="">
                <th class="">{{ __('app.wine.sugar') }}</th>
                <td class="">{{ $wine->sugar }}</td>
            </tr>
            <tr class="">
                <th class="">{{ __('app.wine.sweetness') }}</th>
                <td class="">{{ $wine->sweetness }}</td>
            </tr>
            <tr class="">
                <th class="">{{ __('app.wine.quality') }}</th>
                <td class="">{{ $wine->quality }}</td>
            </tr>
            <tr class="">
                <th class="">{{ __('app.wine.tannin') }}</th>
                <td class="">{{ $wine->tannin }}</td>
            </tr>
            <tr class="">
                <th class="">{{ __('app.wine.maturation') }}</th>
                <td class="">{{ $wine->maturation }}</td>
            </tr>
        </table>
        @endif
    </div>
</x-app-layout>
