@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-6 text-3xl">Tournament Bracket</h1>
    <br>
    <div class="tournament-bracket">
        @foreach ($tournament->matches as $match)
            <div class="pl-60 pr-60 text-center">
                <h2 class="mt-4 text-2xl">Round {{$match->round}}</h2>
                <div class="p-4 bg-gray-800 rounded-md">
                    <div class="flex items-center justify-between">
                        <div class="mr-2">
                            @if($match->team_1_score == "0")
                                <form method="get">
                                    @csrf
                                    <input type="number" id="score_team_1" name="score_team_1" min="1"
                                           class="p-2 border rounded-md bg-gray-800">
                                    <button type="submit" formaction="{{ route('tournament.score1', [
        'tournament' => $match,
        'match_id' => $match->id,
        'team_id' => $match->team_1_score ?? $match->team1->id,
    ]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Submit
                                    </button>
                                </form>
                            @else
{{--                                @dd($match->team_1_score, $match->team1->id, $match->team_1_id)--}}

                                <span class="font-bold text-2xl">{{ $match->team_1_score }}</span>
                            @endif
                        </div>
                        <div class="flex text-center">
                            <span class="font-bold text-2xl">{{ $match->team1?->name ?? 'not defined' }}</span>
                            <span class="text-xl text-red-600 mx-2">vs</span>
                            <span class="font-bold text-2xl">{{ $match->team2?->name ?? 'not defined' }}</span>
                        </div>
                        <div class="flex items-center">
                            <div>
                                @if($match->team_2_score == "0")
                                    <form method="get">
                                        @csrf
                                        <input type="number" id="score_team_2" name="score_team_2" min="1"
                                               class="p-2 border rounded-md bg-gray-800">
                                        <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Submit
                                        </button>
                                    </form>
                                @else
                                    <span class="font-bold text-2xl">{{ $match->team_2_score }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
        <div class="border-t border-gray-300"></div>
    </div>
@endsection
