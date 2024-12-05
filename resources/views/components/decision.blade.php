@props([
    'name',
    'options' => [],
    'option',
])

<div class="row">
    <div class="col col-md-12">
        <p class="alert alert-default">
            <i class="las la-exclamation-circle"></i>
            {{ $options[$name]['question'] }} <b>{{ __(sprintf('wizard.%s.options.%s.title', $name, $option)) }}</b>
            <input type="hidden" name="{{ $name }}" value="{{ $option }}" />
        </p>
    </div>
</div>
