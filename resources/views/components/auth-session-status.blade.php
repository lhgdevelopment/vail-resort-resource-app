@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600 dark:text-green-400']) }}>
        {{ $status }}
    </div>
@endif

@if(session('message'))
    <div class="alert alert-success text-white">
        {{ session('message') }}
    </div>
@endif

