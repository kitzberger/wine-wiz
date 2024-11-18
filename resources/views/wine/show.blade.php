<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">
            <a href="{{ route('root') }}">{{ __('Wine Wiz') }}</a>: {{ $wine?->name ?? '???' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p class="mb-4">
                <a href="{{ route('wine.index') }}" class="text-black dark:text-gray-300">
                    <i class="las la-arrow-left"></i> {{ __('Back to list') }}
                </a>
            </p>
            @if($wine)
            <table class="min-w-full bg-white dark:bg-gray-800 dark:text-gray-800 border border-gray-200 dark:border-gray-900">
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">{{ __('app.wine.id') }}</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->id }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">{{ __('app.wine.name') }}</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->name }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">{{ __('app.wine.info') }}</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->info }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">{{ __('app.wine.winemaker') }}</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->winemaker?->name }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">{{ __('app.wine.location') }}</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">
                        {{ $wine->city?->name ?? '???' }}, {{ $wine->region?->name ?? '???' }}, {{ $wine->country?->name ?? '???'}}
                    </td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">{{ __('app.wine.category') }}</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->category?->name }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">{{ __('app.wine.grapes') }}</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">
                        @foreach ($wine->grapes as $grape)
                            <span style="white-space: nowrap;">
                                {{ $grape->pivot->percentage ? $grape->pivot->percentage . '%' : '' }}
                                {{ $grape->name }}
                            </span><br>
                        @endforeach
                    </td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">{{ __('app.wine.vintage') }}</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->vintage }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">{{ __('app.wine.plu') }}</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->plu }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">{{ __('app.wine.bottle_size' ) }}</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->bottle_size }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">{{ __('app.wine.alcohol') }}</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->alcohol }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">{{ __('app.wine.acidity') }}</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->acidity }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">{{ __('app.wine.sugar') }}</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->sugar }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">{{ __('app.wine.sweetness') }}</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->sweetness }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">{{ __('app.wine.quality') }}</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->quality }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">{{ __('app.wine.tannin') }}</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->tannin }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">{{ __('app.wine.maturation') }}</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->maturation }}</td>
                </tr>
            </table>
            @endif
        </div>
    </div>
</x-app-layout>
