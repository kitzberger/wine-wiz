<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Wine list
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form>
                <div class="grid grid-cols-4 gap-x-6 gap-y-8">
                    <div>
                        <label for="country" class="block">{{ count($countries) }} countries</label>
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
                        <label for="region" class="block">{{ count($regions) }} regions</label>
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
                        <label for="city" class="block">{{ count($cities) }} cities</label>
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
                        <label for="winemaker" class="block">{{ count($winemakers) }} winemakers</label>
                        <div class="mb-2">
                            <select name="winemaker" id="winemaker" class="block" onchange="this.form.submit()" {{ count($winemakers) < 2 ? 'disabled' : '' }}>
                                <x-null-option :count="$winemakers->count()" />
                                @foreach ($winemakers as $winemaker)
                                    <option value="{{ $winemaker->id }}" {{ $filter['winemaker']==$winemaker->id ? 'selected' : '' }}>{{ $winemaker->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <p>{{ $wines->count() }} wines found.</p>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        @foreach (['category', 'wine', 'winemaker', 'city', 'region', 'country', 'vintage'] as $property)
                            <th class="py-3 px-4 bg-gray-200 font-semibold text-gray-700 text-left uppercase text-sm">
                                <a href="{{ route('wine.index', ['sortBy' => $property, 'sortByOrder' => $sortByOrder==='DESC'?'ASC':'DESC']) }}">
                                    {{ $property }}
                                    @if($sortBy===$property)<i class="las la-sort-alpha-{{ $sortByOrder==='ASC' ? 'down' : 'up' }}"></i>@endif
                                </a>
                            </th>
                        @endforeach
          {{--               @foreach (['bottle_size', 'alcohol', 'sugar', 'acidity', 'quality',
                                   'tannin', 'maturation', 'flavours'] as $property)
                            <th class="py-3 px-4 bg-gray-200 font-semibold text-gray-700 text-left uppercase text-sm">
                                {{ $property }}
                            </th>
                        @endforeach --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($wines as $wine)
                    <tr class="bg-white even:bg-gray-100">
                        <td class="py-3 px-4 text-gray-700">{{ $wine->category->name }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $wine->name }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $wine->winemaker?->name }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $wine->city?->name }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $wine->region?->name }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $wine->country?->name }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $wine->vintage }}</td>
{{--                         <td class="py-3 px-4 text-gray-700">{{ $wine->bottle_size }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $wine->alcohol }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $wine->sugar }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $wine->acidity }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $wine->quality }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $wine->tannin }}</td>
                        <td class="py-3 px-4 text-gray-700">{{ $wine->maturation }}</td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
