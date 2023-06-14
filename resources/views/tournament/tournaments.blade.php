@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-6 text-3xl">Tournaments</h1>
    <br>
    <div class="text-center">
        <a href="{{ route('tournament.add') }}"
           class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">New Tournament</a>
    </div>
    <br>
    <div class="dark:bg-gray-800 dark:text-gray-200 text-gray-800 bg-gray-200 rounded pt-6 pb-8 mb-4 ml-20 mr-20">
        <table class="text-center w-full">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Referee</th>
                <th>Actions</th>
            </tr>

            @foreach($tournaments as $tournament)
                <tr>
                    <td>{{$tournament->name}}</td>
                    <td>{{$tournament->description}}</td>
                    <td>{{$tournament->referee->name}}</td>

                    <td>
                        <form method="get" action="{{route('tournament.view', ['tournament' => $tournament])}}">
                            <x-primary-button>View</x-primary-button>
                        </form>
                        <form method="get" action="{{route('tournament.edit', ['tournament' => $tournament])}}">
                            <x-secondary-button>Edit</x-secondary-button>
                        </form>
                        <form method="get" action="{{route('tournament.destroy', ['tournament' => $tournament])}}">
                            <x-danger-button href="#">Delete</x-danger-button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
