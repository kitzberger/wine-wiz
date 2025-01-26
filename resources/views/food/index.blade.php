<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="mt-4">
        <form>
            <div class="row">
                <div class="col col-6 col-md-3">
                    <label for="type" class="form-label">{{ count($types) }} {{ trans_choice('app.food.types', count($types)) }}</label>
                    <select class="form-select mb-3" name="type" id="type" class="block" onchange="this.form.submit()" {{ count($types) < 2 ? 'disabled' : '' }}>
                        <x-null-option :count="$types->count()" />
                        @foreach ($types as $type)
                            <option value="{{ $type }}" {{ $filter['type']==$type ? 'selected' : '' }}>{{ __('app.food.types.' . $type) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-6 col-md-3">
                    <label for="style" class="form-label">{{ count($styles) }} {{ trans_choice('app.styles', count($styles)) }}</label>
                    <select class="form-select mb-3" name="style" id="style" class="block" onchange="this.form.submit()" {{ count($styles) < 2 ? 'disabled' : '' }}>
                        <x-null-option :count="$styles->count()" />
                        @foreach ($styles as $style)
                            <option value="{{ $style->id }}" {{ $filter['style']==$style->id ? 'selected' : '' }}>{{ $style->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        <div>
            @if($foods->count() === 0)
                <div class="alert alert-warning" role="alert">
                    {{ __('app.food-list.no-results') }}
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    {{ trans_choice('app.food-list.x-results', $foods->count()) }}
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('app.food.name') }}</th>
                                <th>{{ __('app.food.type') }}</th>
                                <th>{{ __('app.food.styles') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($foods as $food)
                            <tr>
                                <td>{{ $food->name }}</td>
                                <td>{{ trans('app.food.types.' . $food->type) }}</td>
                                <td>
                                    {!! $food->styles->pluck('name')->join('<br>') !!}
                                </td>
                                <td>
                                    <a href="{{ route('food.show', ['food' => $food->id ]) }}" class="dark:text-white">
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
