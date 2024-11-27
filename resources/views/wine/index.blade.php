<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="mt-4">
        <form>
            <div class="row">
                <div class="col col-md-3">
                    <label for="country" class="block dark:text-gray-300">{{ count($countries) }} {{ trans_choice('app.countries', count($countries)) }}</label>
                    <div class="mb-2">
                        <select class="form-select" name="country" id="country" class="block" onchange="document.getElementById('region').value = '';document.getElementById('city').value = '';document.getElementById('winemaker').value = '';this.form.submit()">
                            <option></option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ $filter['country']==$country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col col-md-3">
                    <label for="region" class="block dark:text-gray-300">{{ count($regions) }} {{ trans_choice('app.regions', count($regions)) }}</label>
                    <div class="mb-2">
                        <select class="form-select" name="region" id="region" class="block" onchange="document.getElementById('city').value = '';document.getElementById('winemaker').value = '';this.form.submit()" {{ count($regions) < 2 ? 'disabled' : '' }}>
                            <x-null-option :count="$regions->count()" />
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}" {{ $filter['region']==$region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col col-md-3">
                    <label for="city" class="block dark:text-gray-300">{{ count($cities) }} {{ trans_choice('app.cities', count($cities)) }}</label>
                    <div class="mb-2">
                        <select class="form-select" name="city" id="city" class="block" onchange="document.getElementById('winemaker').value = '';this.form.submit()" {{ count($cities) < 2 ? 'disabled' : '' }}>
                            <x-null-option :count="$cities->count()" />
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ $filter['city']==$city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col col-md-3">
                    <label for="winemaker" class="block dark:text-gray-300">{{ count($winemakers) }} {{ trans_choice('app.winemakers', count($winemakers)) }}</label>
                    <div class="mb-2">
                        <select class="form-select" name="winemaker" id="winemaker" class="block" onchange="this.form.submit()" {{ count($winemakers) < 2 ? 'disabled' : '' }}>
                            <x-null-option :count="$winemakers->count()" />
                            @foreach ($winemakers as $winemaker)
                                <option value="{{ $winemaker->id }}" {{ $filter['winemaker']==$winemaker->id ? 'selected' : '' }}>{{ $winemaker->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col col-md-3">
                    <label for="category" class="block dark:text-gray-300">{{ count($categories) }} {{ trans_choice('app.categories', count($categories)) }}</label>
                    <div class="mb-2">
                        <select class="form-select" name="category" id="category" class="block" onchange="this.form.submit()" {{ count($categories) < 2 ? 'disabled' : '' }}>
                            <x-null-option :count="$categories->count()" />
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $filter['category']==$category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col col-md-3">
                    <label for="style" class="block dark:text-gray-300">{{ count($styles) }} {{ trans_choice('app.styles', count($styles)) }}</label>
                    <div class="mb-2">
                        <select class="form-select" name="style" id="style" class="block" onchange="this.form.submit()" {{ count($styles) < 2 ? 'disabled' : '' }}>
                            <x-null-option :count="$styles->count()" />
                            @foreach ($styles as $style)
                                <option value="{{ $style }}" {{ $filter['style']==$style ? 'selected' : '' }}>{{ __('app.wine.style.' . $style) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col col-md-3">
                    <label for="grape" class="block dark:text-gray-300">{{ count($grapes) }} {{ trans_choice('app.grapes', count($grapes)) }}</label>
                    <div class="mb-2">
                        <select class="form-select" name="grape" id="grape" class="block" onchange="this.form.submit()" {{ count($grapes) < 2 ? 'disabled' : '' }}>
                            <x-null-option :count="$grapes->count()" />
                            @foreach ($grapes as $grape)
                                <option value="{{ $grape->id }}" {{ $filter['grape']==$grape->id ? 'selected' : '' }}>{{ $grape->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </form>

        <div>
            @if($wines->count() === 0)
                <div class="alert alert-warning" role="alert">
                    {{ __('app.list.no-results') }}
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    {{ trans_choice('app.list.x-results', $wines->count()) }}
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                @foreach (['category', 'wine', 'winemaker', 'city', 'region', 'country', 'vintage'] as $property)
                                    <th>
                                        <a href="{{ route('wine.index', ['sortBy' => $property, 'sortByOrder' => $sortByOrder==='DESC'?'ASC':'DESC']) }}">
                                            {{ __('app.wine.' . $property) }}
                                            @if($sortBy===$property)<i class="las la-sort-alpha-{{ $sortByOrder==='ASC' ? 'down' : 'up' }}"></i>@endif
                                        </a>
                                    </th>
                                @endforeach
                                @foreach (['grapes'] as $property)
                                    <th>
                                        {{ __('app.wine.' . $property) }}
                                    </th>
                                @endforeach
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wines as $wine)
                            <tr>
                                <td>{{ $wine->category->name }}</td>
                                <td>{{ $wine->name }}</td>
                                <td>{{ $wine->winemaker?->name }}</td>
                                <td>{{ $wine->city?->name }}</td>
                                <td>{{ $wine->region?->name }}</td>
                                <td>{{ $wine->country?->name }}</td>
                                <td>{{ $wine->vintage }}</td>
                                <td>
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
