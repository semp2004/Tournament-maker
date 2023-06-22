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
                        <br>
                        <form method="get" action="{{route('tournament.view', ['tournament' => $tournament])}}">
                            <x-primary-button>View</x-primary-button>
                        </form>
                        <form method="get" action="{{route('tournament.edit', ['tournament' => $tournament])}}">
                            <x-secondary-button>Edit</x-secondary-button>
                        </form>

                        <div>
                            <x-danger-button type="submit"
                                             class="!bg-gray-800 !border-1 !border-red-500 !text-red-300"
                                             x-data=""
                                             x-on:click.prevent="$dispatch('open-modal', 'confirm-team-deletion-{{ $tournament->id }}')">
                                Delete
                            </x-danger-button>
                        </div>
                        <x-modal name="confirm-team-deletion-{{ $tournament->id }}" focusable>
                            <h2 class="mt-2 text-lg font-medium text-gray-900 dark:text-gray-100 pl-5">
                                Are you sure you want to delete this tournament: <b>{{ $tournament->name }}</b>?
                            </h2>
                            <input type="hidden" name="id" value="{{ $tournament->id }}">
                            <div class="flex justify-center align-content-center">
                                <x-secondary-button class="my-6" x-on:click="$dispatch('close')">
                                    Cancel
                                </x-secondary-button>

                                <form method="get"
                                      action="{{route('tournament.destroy', ['tournament' => $tournament])}}">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button type="submit"
                                                     class="ml-5 my-6 !bg-gray-800 !border-1 !border-red-500 !text-red-300">
                                        Delete
                                    </x-danger-button>
                                </form>
                            </div>
                        </x-modal>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
