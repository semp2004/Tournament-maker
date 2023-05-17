@extends('layouts.app')

@section('content')
    <div class="ml-[36rem] mr-[36rem] mt-10 bg-gray-800 py-8 rounded-lg">
        <h1 class="text-3xl text-center">Edit team</h1>
        <h2 class="text-xl text-center">{{ Session::get('success') }}</h2>
        <h2 class="text-xl text-center text-red-500">{{ $errors->first() }}</h2>

        <form method="POST" action="{{ route('team.update') }}" class="px-7">
            @csrf
            <div class="mt-4 flex flex-col items-center">
                <x-input-label class="pr-44" for="name">Team name</x-input-label>
                <x-text-input class="block mt-1 py-1" type="text" id="name" name="name" required autofocus
                              placeholder="Teamnaam" value="{{ $team->name }}"/>
                <input type="hidden" name="id" value="{{ $team->id }}">

                <x-secondary-button type="submit" class="mt-6 px-20">Save</x-secondary-button>
            </div>
        </form>
    </div>
@endsection
