@props([
    'name',
    'options' => [],
    'option',
    'backlink',
])

<div class="row">
    <div class="col col-md-12">
        <p class="alert alert-default">
            <i class="las la-exclamation-circle"></i>
            {{ $options[$name]['question'] }}
            @if($backlink ?? false)
                <a href="{{ $backlink }}">
                    <b>{{ __(sprintf('wizard.%s.options.%s.title', $name, $option)) }}</b>
                </a>
            @else
                <b>{{ __(sprintf('wizard.%s.options.%s.title', $name, $option)) }}</b>
            @endif
            <input type="hidden" name="{{ $name }}" value="{{ $option }}" />
        </p>
    </div>
</div>
