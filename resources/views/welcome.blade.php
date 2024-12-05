<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            <a href="{{ route('root') }}">{{ __('Wine Wiz') }}</a>
        </h2>
    </x-slot>

    <div class="mt-4">
        <h3 class="font-semibold text-xl">{{ __("Welcome to the Wine Wiz!") }}</h3>
        <p class="mt-2 mb-2">
            {{ __('Who are you?') }}
        </p>
        <div class="row">
            <div class="col col-md-4">
                <div class="card text-bg-default mb-3">
                    <div class="card-header">{{ __('Amateur') }}</div>
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a class="btn btn-primary" href="{{ route('wine.wizard', ['level' => 'amateur']) }}">{{ __('Amateur') }}</a>
                    </div>
                </div>
            </div>
            <div class="col col-md-4">
                <div class="card text-bg-default mb-3">
                    <div class="card-header">{{ __('Advanced') }}</div>
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a class="btn btn-secondary" href="{{ route('wine.wizard', ['level' => 'advanced']) }}">{{ __('Advanced') }}</a>
                    </div>
                </div>
            </div>
            <div class="col col-md-4">
                <div class="card text-bg-default mb-3">
                    <div class="card-header">{{ __('Expert') }}</div>
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a class="btn btn-danger" href="{{ route('wine.index') }}">{{ __('Expert') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
