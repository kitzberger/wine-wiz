@props([
    'name',
    'options' => [],
])

<div class="row">
    <div class="col col-md-12">
        <p class="alert alert-info">
            <i class="las la-question-circle"></i>
            <b>{{ $options['question'] }}</b>
        </p>
        <table class="table">
            @foreach($options['options'] ?? [] as $value => $option)
                <tr>
                    <td>
                        {{ $option['title'] ?? '???' }}<br>
                        {{ $option['description'] ?? '' }}
                    </td>
                    <td>
                        <button type="submit"
                                class="btn btn-sm btn-primary"
                                name="{{ $name }}"
                                value="{{ $value }}">{{ __('Choose this food') }}</button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
