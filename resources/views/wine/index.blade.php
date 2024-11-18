<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">
            <a href="{{ route('root') }}">{{ __('Wine Wiz') }}</a>: List
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form>
                <div class="grid grid-cols-4 gap-x-6 gap-y-8">
                    <div>
                        <label for="country" class="block dark:text-gray-300">{{ count($countries) }} {{ trans_choice('app.countries', count($countries)) }}</label>
                        <div class="mb-2">
                            <select name="country" id="country" class="block" onchange="document.getElementById('region').value = '';document.getElementById('city').value = '';document.getElementById('winemaker').value = '';this.form.submit()">
                                <option></option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" {{ $filter['country']==$country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="region" class="block dark:text-gray-300">{{ count($regions) }} {{ trans_choice('app.regions', count($regions)) }}</label>
                        <div class="mb-2">
                            <select name="region" id="region" class="block" onchange="document.getElementById('city').value = '';document.getElementById('winemaker').value = '';this.form.submit()" {{ count($regions) < 2 ? 'disabled' : '' }}>
                                <x-null-option :count="$regions->count()" />
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}" {{ $filter['region']==$region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="city" class="block dark:text-gray-300">{{ count($cities) }} {{ trans_choice('app.cities', count($cities)) }}</label>
                        <div class="mb-2">
                            <select name="city" id="city" class="block" onchange="document.getElementById('winemaker').value = '';this.form.submit()" {{ count($cities) < 2 ? 'disabled' : '' }}>
                                <x-null-option :count="$cities->count()" />
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ $filter['city']==$city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="winemaker" class="block dark:text-gray-300">{{ count($winemakers) }} {{ trans_choice('app.winemakers', count($winemakers)) }}</label>
                        <div class="mb-2">
                            <select name="winemaker" id="winemaker" class="block" onchange="this.form.submit()" {{ count($winemakers) < 2 ? 'disabled' : '' }}>
                                <x-null-option :count="$winemakers->count()" />
                                @foreach ($winemakers as $winemaker)
                                    <option value="{{ $winemaker->id }}" {{ $filter['winemaker']==$winemaker->id ? 'selected' : '' }}>{{ $winemaker->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="category" class="block dark:text-gray-300">{{ count($categories) }} {{ trans_choice('app.categories', count($categories)) }}</label>
                        <div class="mb-2">
                            <select name="category" id="category" class="block" onchange="this.form.submit()" {{ count($categories) < 2 ? 'disabled' : '' }}>
                                <x-null-option :count="$categories->count()" />
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $filter['category']==$category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="grape" class="block dark:text-gray-300">{{ count($grapes) }} {{ trans_choice('app.grapes', count($grapes)) }}</label>
                        <div class="mb-2">
                            <select name="grape" id="grape" class="block" onchange="this.form.submit()" {{ count($grapes) < 2 ? 'disabled' : '' }}>
                                <x-null-option :count="$grapes->count()" />
                                @foreach ($grapes as $grape)
                                    <option value="{{ $grape->id }}" {{ $filter['grape']==$grape->id ? 'selected' : '' }}>{{ $grape->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if($wines->count() === 0)
                <div class="p-4 mt-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                    {{ __('app.list.no-results') }}
                </div>
            @else
                <div class="p-4 mt-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    {{ trans_choice('app.list.x-results', $wines->count()) }}
                </div>
            @endif
            <table class="min-w-full bg-white dark:bg-gray-800 dark:text-gray-800 border border-gray-200 dark:border-gray-900">
                <thead>
                    <tr>
                        @foreach (['category', 'wine', 'winemaker', 'city', 'region', 'country', 'vintage'] as $property)
                            <th class="py-3 px-4 bg-gray-200 dark:bg-gray-900 font-semibold text-gray-700 dark:text-gray-200 text-left uppercase text-sm">
                                <a href="{{ route('wine.index', ['sortBy' => $property, 'sortByOrder' => $sortByOrder==='DESC'?'ASC':'DESC']) }}">
                                    {{ __('app.wine.' . $property) }}
                                    @if($sortBy===$property)<i class="las la-sort-alpha-{{ $sortByOrder==='ASC' ? 'down' : 'up' }}"></i>@endif
                                </a>
                            </th>
                        @endforeach
                        @foreach (['grapes'] as $property)
                            <th class="py-3 px-4 bg-gray-200 dark:bg-gray-900 font-semibold text-gray-700 dark:text-gray-200 text-left uppercase text-sm">
                                {{ __('app.wine.' . $property) }}
                            </th>
                        @endforeach
                        <th class="py-3 px-4 bg-gray-200 dark:bg-gray-900 font-semibold text-gray-700 dark:text-gray-200 text-left uppercase text-sm"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($wines as $wine)
                    <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                        <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->category->name }}</td>
                        <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->name }}</td>
                        <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->winemaker?->name }}</td>
                        <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->city?->name }}</td>
                        <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->region?->name }}</td>
                        <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->country?->name }}</td>
                        <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->vintage }}</td>
                        <td class="py-3 px-4 text-gray-700 dark:text-white">
                            @foreach ($wine->grapes as $grape)
                                <span style="white-space: nowrap;">
                                    {{ $grape->pivot->percentage ? $grape->pivot->percentage . '%' : '' }}
                                    {{ $grape->name }}
                                </span><br>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('wine.show', ['wine' => $wine->id ]) }}" class="dark:text-white">
                                <i class="las la-eye"></i>
                            </a>
                        </td>
{{--                         <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->bottle_size }}</td>
                        <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->alcohol }}</td>
                        <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->sugar }}</td>
                        <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->acidity }}</td>
                        <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->quality }}</td>
                        <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->tannin }}</td>
                        <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->maturation }}</td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
