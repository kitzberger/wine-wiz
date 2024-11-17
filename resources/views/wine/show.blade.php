<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">
            {{ $wine?->name ?? '???' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p class="mb-4">
                <a href="{{ route('wine.index') }}" class="text-black dark:text-gray-300">
                    <i class="las la-arrow-left"></i> Back to list
                </a>
            </p>
            @if($wine)
            <table class="min-w-full bg-white dark:bg-gray-800 dark:text-gray-800 border border-gray-200 dark:border-gray-900">
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">id</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->id }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">name</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->name }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">info</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->info }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">winemaker</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->winemaker?->name }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">location</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">
                        {{ $wine->city?->name ?? '???' }}, {{ $wine->region?->name ?? '???' }}, {{ $wine->country?->name ?? '???'}}
                    </td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">category</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->category?->name }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">grapes</th>
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
                    <th class="py-3 px-4 text-gray-700 dark:text-white">selling_price</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->selling_price }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">purchase_price</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->purchase_price }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">vintage</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->vintage }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">plu</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->plu }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">bottle_size</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->bottle_size }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">alcohol</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->alcohol }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">acidity</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->acidity }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">sugar</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->sugar }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">sweetness</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->sweetness }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">quality</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->quality }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">tannin</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->tannin }}</td>
                </tr>
                <tr class="bg-white even:bg-gray-100 dark:bg-gray-700 dark:even:bg-gray-500">
                    <th class="py-3 px-4 text-gray-700 dark:text-white">maturation</th>
                    <td class="py-3 px-4 text-gray-700 dark:text-white">{{ $wine->maturation }}</td>
                </tr>
            </table>
            @endif
        </div>
    </div>
</x-app-layout>
