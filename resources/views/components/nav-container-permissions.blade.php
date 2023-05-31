@props(['permission'])

@php
    $perm = ($permission ?? false)
@endphp

@if (Auth::user()->role ?? 'N/A' == $perm)
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        {{ $slot }}
    </div>
@endif
