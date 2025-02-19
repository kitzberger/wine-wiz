<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="mt-4">
        <form>
            <div class="row">
                <div class="col col-6 col-md-3">
                    <label for="country" class="form-label">{{ count($countries) }} {{ trans_choice('app.countries', count($countries)) }}</label>
                    <select class="form-select mb-3" name="country" id="country" class="block" onchange="document.getElementById('region').value = '';document.getElementById('city').value = '';document.getElementById('winemaker').value = '';this.form.submit()">
                        <option></option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" {{ $filter['country']==$country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-6 col-md-3">
                    <label for="region" class="form-label">{{ count($regions) }} {{ trans_choice('app.regions', count($regions)) }}</label>
                    <select class="form-select mb-3" name="region" id="region" class="block" onchange="document.getElementById('city').value = '';document.getElementById('winemaker').value = '';this.form.submit()" {{ count($regions) < 2 ? 'disabled' : '' }}>
                        <x-null-option :count="$regions->count()" />
                        @foreach ($regions as $region)
                            <option value="{{ $region->id }}" {{ $filter['region']==$region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-6 col-md-3">
                    <label for="city" class="form-label">{{ count($cities) }} {{ trans_choice('app.cities', count($cities)) }}</label>
                    <select class="form-select mb-3" name="city" id="city" class="block" onchange="document.getElementById('winemaker').value = '';this.form.submit()" {{ count($cities) < 2 ? 'disabled' : '' }}>
                        <x-null-option :count="$cities->count()" />
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" {{ $filter['city']==$city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-6 col-md-3">
                    <label for="winemaker" class="form-label">{{ count($winemakers) }} {{ trans_choice('app.winemakers', count($winemakers)) }}</label>
                    <select class="form-select mb-3" name="winemaker" id="winemaker" class="block" onchange="this.form.submit()" {{ count($winemakers) < 2 ? 'disabled' : '' }}>
                        <x-null-option :count="$winemakers->count()" />
                        @foreach ($winemakers as $winemaker)
                            <option value="{{ $winemaker->id }}" {{ $filter['winemaker']==$winemaker->id ? 'selected' : '' }}>{{ $winemaker->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-6 col-md-3">
                    <label for="category" class="form-label">{{ count($categories) }} {{ trans_choice('app.categories', count($categories)) }}</label>
                    <select class="form-select mb-3" name="category" id="category" class="block" onchange="this.form.submit()" {{ count($categories) < 2 ? 'disabled' : '' }}>
                        <x-null-option :count="$categories->count()" />
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $filter['category']==$category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-6 col-md-3">
                    <label for="style" class="form-label">{{ count($styles) }} {{ trans_choice('app.styles', count($styles)) }}</label>
                    <select class="form-select mb-3" name="style" id="style" class="block" onchange="this.form.submit()" {{ count($styles) < 2 ? 'disabled' : '' }}>
                        <x-null-option :count="$styles->count()" />
                        @foreach ($styles as $style)
                            <option value="{{ $style }}" {{ $filter['style']==$style ? 'selected' : '' }}>{{ __('app.wine.style.' . $style) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-6 col-md-3">
                    <label for="grape" class="form-label">{{ count($grapes) }} {{ trans_choice('app.grapes', count($grapes)) }}</label>
                    <select class="form-select mb-3" name="grape" id="grape" class="block" onchange="this.form.submit()" {{ count($grapes) < 2 ? 'disabled' : '' }}>
                        <x-null-option :count="$grapes->count()" />
                        @foreach ($grapes as $grape)
                            <option value="{{ $grape->id }}" {{ $filter['grape']==$grape->id ? 'selected' : '' }}>{{ $grape->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-6 col-md-3">
                    <label for="maturation" class="form-label">{{ count($maturations) }} {{ trans_choice('app.maturations', count($maturations)) }}</label>
                    <select class="form-select mb-3" name="maturation" id="maturation" class="block" onchange="this.form.submit()" {{ count($maturations) < 2 ? 'disabled' : '' }}>
                        <x-null-option :count="$maturations->count()" />
                        @foreach ($maturations as $maturation)
                            <option value="{{ $maturation }}" {{ $filter['maturation']==$maturation ? 'selected' : '' }}>{{ __('app.wine.maturation.' . $maturation) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        <div>
            @if($wines->count() === 0)
                <div class="alert alert-warning" role="alert">
                    {{ __('app.wine-list.no-results') }}
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    {{ trans_choice('app.wine-list.x-results', $wines->count()) }}
                </div>
                @include('wine.includes.wine-table-sortable')
            @endif
        </div>
    </div>
</x-app-layout>
