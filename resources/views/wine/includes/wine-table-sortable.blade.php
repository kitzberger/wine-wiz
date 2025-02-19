<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                @foreach (['category', 'wine', 'winemaker', 'city', 'region', 'country', 'vintage'] as $property)
                    <th>
                        <a href="{{ route('wine.index', ['sortBy' => $property, 'sortByOrder' => $sortByOrder==='DESC'?'ASC':'DESC']) }}">
                            {{ __('app.wine.' . $property) }}
                            @if($sortBy===$property)<i class="las la-sort-alpha-{{ $sortByOrder==='ASC' ? 'down' : 'up' }}"></i>@endif
                        </a>
                    </th>
                @endforeach
                @foreach (['grapes'] as $property)
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
                <td>
                    @if($wine->winemaker)
                        <a href="{{ route('winemaker.show', ['winemaker' => $wine->winemaker->id ]) }}">
                            {{ $wine->winemaker->name }}
                        </a>
                    @endif
                </td>
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
