@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-6 text-3xl">Tournament Bracket</h1>
    <br>
    <div class="tournament-bracket">
        @foreach ($tournament->matches as $match)
            <div class="pl-96 pr-96 text-center">
                <h2 class="mt-4 text-2xl">Round</h2>
                <div class="p-4 bg-gray-800 rounded-md">
                    <div>
                        <span class="font-bold text-2xl">{{ $match->team1?->name ?? 'not defined' }}</span>
                        <span class="text-xl text-red-600">vs</span>
                        <span class="font-bold text-2xl">{{ $match->team2?->name ?? 'not defined' }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
