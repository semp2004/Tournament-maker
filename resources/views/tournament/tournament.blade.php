@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-6 text-3xl">Tournament Bracket</h1>
    <br>
    <div class="tournament-bracket">
        @foreach ($tournament->matches->team_1_id as $matches)
            <h2 class="text-center mt-4 text-2xl">Round {{ $tournament->matches }}</h2>
            <div class="bg grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                    <div class="p-4 bg-gray-500 rounded-md">
                        <div class="text-center">
                            <span class="font-bold">{{ $tournament->matches->team_1_id}}</span>
                            <span>vs</span>
                            <span class="font-bold bg-gray-500">{{ $tournament->matches}}
                            </span>
                        </div>
                    </div>
            </div>
        @endforeach
    </div>
@endsection
