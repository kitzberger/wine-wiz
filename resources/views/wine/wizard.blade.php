<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="mt-4">

        @php
            $stillGotQuestionsToAnswer = true;
            if (count($wines) <= 5) {
                // We've narrowed it down to 5 wines? That's enough questions answered.
                $stillGotQuestionsToAnswer = false;
            }
        @endphp

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
                    @if($stillGotQuestionsToAnswer)
                        <x-question name="occasion" :options="$options" />
                    @endif
                @else
                    <x-decision name="occasion" :options="$options['occasion']" :value="$filter['occasion']" :backlink="route('wine.wizard', ['level' => $filter['level']])" />
                @endif
            @endif

            {{-- Question 3a (only when wine should accompany eating --}}
            @if($filter['occasion'] === 'while')
                @if(empty($filter['course']))
                    @if($stillGotQuestionsToAnswer)
                        <x-question name="course" :options="$options" />
                    @endif
                @else
                    <x-decision name="course" :options="$options['course']" :value="$filter['course']" :backlink="route('wine.wizard', ['level' => $filter['level'], 'occasion' => 'while'])" />
                @endif
            @endif

            {{-- Question 3b (only when wine should accompany eating and an actual food --}}
            @if(in_array($filter['course'], ['starter', 'maincourse', 'dessert', 'all']))
                @if(empty($filter['food']))
                    @if($stillGotQuestionsToAnswer)
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
                    @endif
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
                        @if($stillGotQuestionsToAnswer)
                            <x-question name="color" :options="$options" />
                        @endif
                    @else
                        <x-decision name="color"
                                    :options="$options['color']"
                                    :value="$filter['color']"
                                    :backlink="route('wine.wizard', ['level' => $filter['level'], 'occasion' => $filter['occasion'], 'course' => $filter['course'], 'food' => $filter['food']])" />
                        @php
                            $stillGotQuestionsToAnswer = false;
                        @endphp
                    @endif
                @else
                    @if(empty($filter['strength']))
                        @if($stillGotQuestionsToAnswer)
                            <x-question name="strength" :options="$options" />
                        @endif
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
                    @if($stillGotQuestionsToAnswer)
                        <x-question-range name="acidity" :options="$options" />
                    @endif
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
                    @if($stillGotQuestionsToAnswer)
                        <x-question-range name="tannin" :options="$options" />
                    @endif
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
                    @if($stillGotQuestionsToAnswer)
                        <x-question name="maturation" :options="$options" />
                    @endif
                @else
                    <x-decision name="maturation"
                                :options="$options['maturation']"
                                :value="$filter['maturation']"
                                :backlink="route('wine.wizard', ['level' => $filter['level'], 'occasion' => $filter['occasion'], 'course' => $filter['course'], 'food' => $filter['food'], 'strength' => $filter['strength'], 'acidity' => $filter['acidity'], 'tannin' => $filter['tannin']])"/>
                    @php
                        $stillGotQuestionsToAnswer = false;
                    @endphp
                @endif
            @endif
        </form>

        @if($wineQuerySQL)
            @if(config('app.debugWizard'))
                <div class="alert alert-danger">
                    {{ $wineQuerySQL }}
                </div>
            @endif
        @endif

        @if(empty($filter['level']))
            <div class="alert alert-warning" role="alert">
                {{ trans('app.wine-wizard.please-start') }}
            </div>
        @else
            @if($wines->count() === 0)
                <div class="alert alert-warning" role="alert">
                    {{ trans('app.wine-list.no-results') }}
                </div>
            @else
                @if($stillGotQuestionsToAnswer)
                    <div class="alert alert-warning" role="alert">
                        {{ trans_choice('app.wine-list.x-results', $wines->count()) }}
                        {{ trans('app.wine-wizard.go-on') }}
                    </div>
                @else
                    <div class="alert alert-info" role="alert">
                        {{ trans_choice('app.wine-list.x-results', $wines->count()) }}
                    </div>
                    @include('wine.includes.wine-table')
                @endif
            @endif
        @endif
    </div>
</x-app-layout>
