@props(['stadiums'])
@extends('layouts.app')

@section('content')
    @if(count($stadiums) !== 0)
        <div class="mx-[33%] mt-10 bg-slate-800 rounded-lg py-4 pl-4">
            @foreach($stadiums as $stadium)
                <div class="grid grid-cols-2 mt-4">
                    <section class="pl-8">
                        <h1 class="text-2xl">{{ $stadium->name }}</h1>
                        <h1 class="text-xl mt-3">{{ $stadium->location }}</h1>
                    </section>
                    <img class="max-h-52 max-w-[80%]" src="{{ Storage::url($stadium->image_path) }}" alt="no image">
                </div>
                <hr class="mr-4 mt-6" />
            @endforeach
        </div>
    @else
        <section class="mt-10 text-center text-2xl">
            <h1>There are no stadiums yet :(</h1>
            <h1>Come back later!</h1>
        </section>
    @endif
@endsection
