@props([
    'name',
    'options' => [],
])

<div class="row">
    <div class="col col-md-12">
        <p class="alert alert-info">
            <i class="las la-question-circle"></i>
            <b>{{ $options[$name]['question'] }}</b>
        </p>
    </div>

    @foreach($options[$name]['options'] ?? [] as $value => $option)
    <div class="col col-md-4">
        <div class="card text-bg-default mb-3 card-{{ $name }}-{{ $value }}">
            <div class="card-header">{{ $option['title'] ?? '???' }}</div>
            <div class="card-body">
                <p class="card-text">{{ $option['description'] ?? '???' }}</p>
                <button type="submit"
                        class="btn btn-primary"
                        name="{{ $name }}"
                        value="{{ $value }}">{{ $option['title'] ?? '???' }}</button>
            </div>
        </div>
    </div>
    @endforeach
</div>
