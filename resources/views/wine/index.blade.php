<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Wine list
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
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
                        <td class="py-3 px-4 text-gray-700">{{ $wine->winemaker }}</td>
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
