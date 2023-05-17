@extends('layouts.app')

@section('content')
    <div class="ml-[36rem] mr-[36rem] mt-10 bg-gray-800 py-8 rounded-lg">
        <h1 class="text-3xl text-center">Add team</h1>
        <form method="POST" class="px-7">
            @csrf
            <div class="mt-4 flex flex-col items-center">
                <x-input-label class="pr-44" for="name">Team name</x-input-label>
                <x-text-input class="block mt-1 py-1" type="text" id="name" name="name" required autofocus
                              placeholder="Teamnaam" />

                <x-secondary-button type="submit" class="mt-6 px-20">Add</x-secondary-button>
            </div>
        </form>
    </div>
@endsection
