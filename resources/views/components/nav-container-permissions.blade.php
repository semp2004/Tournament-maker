@props(['permission'])

@if (isset(Auth::user()->role) && Auth::user()->role == $permission)
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        {{ $slot }}
    </div>
@endif
