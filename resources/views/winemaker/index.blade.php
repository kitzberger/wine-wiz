<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="mt-4">
        <div>
            @if($winemakers->count() === 0)
                <div class="alert alert-warning" role="alert">
                    {{ __('app.winemaker-list.no-results') }}
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    {{ trans_choice('app.winemaker-list.x-results', $winemakers->count()) }}
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('app.winemaker.name') }}</th>
                                <th>{{ __('app.winemaker.info') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($winemakers as $winemaker)
                            <tr>
                                <td>{{ $winemaker->name }}</td>
                                <td>{{ $winemaker->info }}</td>
                                <td>
                                    <a href="{{ route('winemaker.show', ['winemaker' => $winemaker->id ]) }}" class="dark:text-white">
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
    </div>
</x-app-layout>
