<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            <a href="{{ route('root') }}">{{ __('Wine Wiz') }}</a>
        </h2>
    </x-slot>

    <div class="mt-4">
        <h3 class="font-semibold text-xl">{{ __('app.welcome-to-wine-wiz') }}</h3>
        <p class="mt-4 mb-4">
            {{ __('app.who-are-you') }}
        </p>
        <div class="row">
            <div class="col col-md-4">
                <div class="card text-bg-default mb-3">
                    <div class="card-header">{{ __('wizard.level.options.amateur.title') }}</div>
                    <div class="card-body">
                        <p class="card-text">{{ __('wizard.level.options.amateur.description') }}</p>
                        <a class="btn btn-primary" href="{{ route('wine.wizard', ['level' => 'amateur']) }}">
                            {{ __('app.who-are-you.amateur') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="col col-md-4">
                <div class="card text-bg-default mb-3">
                    <div class="card-header">{{ __('wizard.level.options.advanced.title') }}</div>
                    <div class="card-body">
                        <p class="card-text">{{ __('wizard.level.options.advanced.description') }}</p>
                        <a class="btn btn-secondary" href="{{ route('wine.wizard', ['level' => 'advanced']) }}">
                            {{ __('app.who-are-you.advanced') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="col col-md-4">
                <div class="card text-bg-default mb-3">
                    <div class="card-header">{{ __('wizard.level.options.expert.title') }}</div>
                    <div class="card-body">
                        <p class="card-text">{{ __('wizard.level.options.expert.description') }}</p>
                        <a class="btn btn-danger" href="{{ route('wine.index') }}">
                            {{ __('app.who-are-you.expert') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
