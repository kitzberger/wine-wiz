<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">
            <a href="{{ route('root') }}">{{ __('Wine Wiz') }}</a>: Wizard
        </h2>
    </x-slot>

    <div class="mt-4">

        <form>
            @if(empty($filter['level']))
                <x-question name="level" :options="$options" />
            @else
                <x-decision name="level" :options="$options" :option="$filter['level']" :backlink="route('wine.wizard')" />
                @if(empty($filter['occasion']))
                    <x-question name="occasion" :options="$options" />
                @else
                    <x-decision name="occasion" :options="$options" :option="$filter['occasion']" :backlink="route('wine.wizard', ['level' => $filter['level']])" />
                    @if(empty($filter['color']))
                        <x-question name="color" :options="$options" />
                    @else
                        <x-decision name="color" :options="$options" :option="$filter['color']" :backlink="route('wine.wizard', ['level' => $filter['level'], 'occasion' => $filter['occasion']])" />
                        @if(empty($filter['acidity']))
                            <x-question name="acidity" :options="$options" />
                        @else
                            <x-decision name="acidity" :options="$options" :option="$filter['acidity']" :backlink="route('wine.wizard', ['level' => $filter['level'], 'occasion' => $filter['occasion'], 'color' => $filter['color']])" />
                            @if(empty($filter['maturation']))
                                <x-question name="maturation" :options="$options" />
                            @else
                                <x-decision name="maturation" :options="$options" :option="$filter['maturation']" :backlink="route('wine.wizard', ['level' => $filter['level'], 'occasion' => $filter['occasion'], 'color' => $filter['color'], 'acidity' => $filter['acidity']])"/>
                            @endif
                        @endif
                    @endif
                @endif
            @endif
        </form>

        @if(count($wines))
            <div class="alert alert-info" role="alert">
                {{ trans_choice('app.wine-list.x-results', $wines->count()) }}
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            @foreach (['category', 'wine', 'winemaker', 'city', 'region', 'country', 'vintage', 'grapes'] as $property)
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
</x-app-layout>
