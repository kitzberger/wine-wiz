@props([
    'name',
    'options' => [],
    'value',
    'backlink',
])

@php
    $question ??= $options['question'] ?? '???';
    $answer ??= $options['options'][$value]['title'] ?? '???';
@endphp

<div class="row">
    <div class="col col-md-12">
        <p class="alert alert-default">
            <i class="las la-exclamation-circle"></i>
            {{ $question }}
            @if($backlink ?? false)
                <a href="{{ $backlink }}">
                    <b>{{ $answer }}</b>
                </a>
            @else
                <b>{{ $answer }}</b>
            @endif
            <input type="hidden" name="{{ $name }}" value="{{ $value }}" />
        </p>
    </div>
</div>
