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
