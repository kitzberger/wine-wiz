<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="mt-4">

        <form>
            {{-- Ask question 1 when level not set yet! --}}
            @if(empty($filter['level']))
                <x-question name="level" :options="$options" />
            @else
                <x-decision name="level" :options="$options['level']" :value="$filter['level']" :backlink="route('wine.wizard')" />
            @endif

            {{-- Ask question 2 after level has been set! --}}
            @if(!empty($filter['level']))
                @if(empty($filter['occasion']))
                    <x-question name="occasion" :options="$options" />
                @else
                    <x-decision name="occasion" :options="$options['occasion']" :value="$filter['occasion']" :backlink="route('wine.wizard', ['level' => $filter['level']])" />
                @endif
            @endif

            {{-- Question 3a (only when wine should accompany eating --}}
            @if($filter['occasion'] === 'while')
                @if(empty($filter['course']))
                    <x-question name="course" :options="$options" />
                @else
                    <x-decision name="course" :options="$options['course']" :value="$filter['course']" :backlink="route('wine.wizard', ['level' => $filter['level'], 'occasion' => 'while'])" />
                @endif
            @endif

            {{-- Question 3b (only when wine should accompany eating and an actual food --}}
            @if(in_array($filter['course'], ['starter', 'maincourse', 'dessert', 'all']))
                @if(empty($filter['food']))
                    @switch($filter['course'])
                        @case('starter')
                            <x-question-list name="food" :options="$options['food_starter']" />
                            @break;
                        @case('dessert')
                            <x-question-list name="food" :options="$options['food_dessert']" />
                            @break;
                        @default
                            <x-question-list name="food" :options="$options['food_maincourse']" />
                    @endswitch
                @else
                    @switch($filter['course'])
                        @case('starter')
                            <x-decision name="food"
                                        :options="$options['food_starter']"
                                        :value="$filter['food']"
                                        :backlink="route('wine.wizard', ['level' => $filter['level'], 'occasion' => 'while', 'course' => $filter['course']])" />
                            @break
                        @case('dessert')
                            <x-decision name="food"
                                        :options="$options['food_dessert']"
                                        :value="$filter['food']"
                                        :backlink="route('wine.wizard', ['level' => $filter['level'], 'occasion' => 'while', 'course' => $filter['course']])" />
                            @break
                        @default
                            <x-decision name="food"
                                        :options="$options['food_maincourse']"
                                        :value="$filter['food']"
                                        :backlink="route('wine.wizard', ['level' => $filter['level'], 'occasion' => 'while', 'course' => $filter['course']])" />
                    @endswitch
                @endif
            @endif

            {{-- Question 4 --}}
            @if($filter['food'] || in_array($filter['occasion'], ['before', 'after']) || $filter['course'] === 'independent')
                @if($filter['level'] === 'amateur')
                    @if(empty($filter['color']))
                        <x-question name="color" :options="$options" />
                    @else
                        <x-decision name="color"
                                    :options="$options['color']"
                                    :value="$filter['color']"
                                    :backlink="route('wine.wizard', ['level' => $filter['level'], 'occasion' => $filter['occasion'], 'course' => $filter['course'], 'food' => $filter['food']])" />
                    @endif
                @else
                    @if(empty($filter['strength']))
                        <x-question name="strength" :options="$options" />
                    @else
                        <x-decision name="strength"
                                    :options="$options['strength']"
                                    :value="$filter['strength']"
                                    :backlink="route('wine.wizard', ['level' => $filter['level'], 'occasion' => $filter['occasion'], 'course' => $filter['course'], 'food' => $filter['food']])" />
                    @endif
                @endif
            @endif

            {{-- Question 5 (advanced only!) --}}
            @if($filter['level'] === 'advanced' && !empty($filter['strength']))
                @if(empty($filter['acidity']))
                    <x-question-range name="acidity" :options="$options" />
                @else
                    <x-decision name="acidity"
                                :options="$options['acidity']"
                                :value="$filter['acidity']"
                                :backlink="route('wine.wizard', ['level' => $filter['level'], 'occasion' => $filter['occasion'], 'course' => $filter['course'], 'food' => $filter['food'], 'strength' => $filter['strength']])" />
                @endif
            @endif

            {{-- Question 6 (advanced only!) --}}
            @if($filter['level'] === 'advanced' && !empty($filter['acidity']))
                @if(empty($filter['tannin']))
                    <x-question-range name="tannin" :options="$options" />
                @else
                    <x-decision name="tannin"
                                :options="$options['tannin']"
                                :value="$filter['tannin']"
                                :backlink="route('wine.wizard', ['level' => $filter['level'], 'occasion' => $filter['occasion'], 'course' => $filter['course'], 'food' => $filter['food'], 'strength' => $filter['strength'], 'acidity' => $filter['acidity']])"/>
                @endif
            @endif

            {{-- Question 7 (advanced only!) --}}
            @if($filter['level'] === 'advanced' && !empty($filter['tannin']))
                @if(empty($filter['maturation']))
                    <x-question name="maturation" :options="$options" />
                @else
                    <x-decision name="maturation"
                                :options="$options['maturation']"
                                :value="$filter['maturation']"
                                :backlink="route('wine.wizard', ['level' => $filter['level'], 'occasion' => $filter['occasion'], 'course' => $filter['course'], 'food' => $filter['food'], 'strength' => $filter['strength'], 'acidity' => $filter['acidity'], 'tannin' => $filter['tannin']])"/>
                @endif
            @endif
        </form>

        @if($wineQuery)
            @if(config('app.debugWizard'))
                <div class="alert alert-danger">
                    {{ \Str::replaceArray('?', $wineQuery->getBindings(), $wineQuery->toSql()) }}
                </div>
            @endif
            @php
                $wines = $wineQuery->get() ?? []
            @endphp
        @endif

        @if(count($wines ?? []))
            <div class="alert alert-info" role="alert">
                {{ trans_choice('app.wine-list.x-results', $wines->count()) }}
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            @foreach (['category', 'wine', 'winemaker', 'country', 'vintage', 'grapes'] as $property)
                                <th>
                                    {{ __('app.wine.' . $property) }}
                                </th>
                            @endforeach
                            @if(config('app.debugWizard'))
                                @foreach (['selling_price', 'alcohol', 'level_sweetness', 'level_acidity', 'level_tannin', 'maturation', 'style'] as $property)
                                <th class="table-danger">
                                    {{ __('app.wine.' . $property) }}
                                </th>
                                @endforeach
                            @endif
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wines as $wine)
                        <tr>
                            <td>{{ $wine->category->name }}</td>
                            <td>{{ $wine->name }}</td>
                            <td>{{ $wine->winemaker?->name }}</td>
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
                            @if(config('app.debugWizard'))
                                <td class="table-danger">{{ number_format($wine->selling_price, 2, ',') }} €</td>
                                <td class="table-danger">{{ number_format($wine->alcohol * 100, 1, ',') }} %</td>
                                <td class="table-danger">{{ $wine->level_sweetness }}</td>
                                <td class="table-danger">{{ $wine->level_acidity }}</td>
                                <td class="table-danger">{{ $wine->level_tannin }}</td>
                                <td class="table-danger">{{ $wine->maturation }}</td>
                                <td class="table-danger">{{ $wine->style_id }}</td>
                            @endif
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
