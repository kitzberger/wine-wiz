<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="mt-4">
        <p class="mb-4">
            @if (request()->headers->get('referer'))
                <a href="javascript:history.back()" class="text-black dark:text-gray-300">
                    <i class="las la-arrow-left"></i> {{ __('app.back') }}
                </a>
            @else
                <a href="{{ route('winemaker.index') }}" class="text-black dark:text-gray-300">
                    <i class="las la-arrow-left"></i> {{ __('app.back-to-list') }}
                </a>
            @endif
        </p>
        @if($winemaker)
            <div class="card">
                @if($winemaker->image)
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ url($winemaker->image) }}" class="img-fluid rounded-start" alt="{{ $winemaker->name }}">
                        </div>
                        <div class="col-md-8">
                @endif
                            <div class="card-body">
                                <h1 class="card-title">{{ $winemaker->name }}</h1>
                                <p class="card-text">
                                    {{ $winemaker->info }}
                                </p>
                            </div>
                @if($winemaker->image)
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
</x-app-layout>
