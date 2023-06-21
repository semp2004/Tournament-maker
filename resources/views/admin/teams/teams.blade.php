@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-6 text-3xl">Teams</h1>
    <div class="ml-96 mr-96 mt-8 bg-gray-800 py-2 rounded-lg">
        <form method="get" action="{{ route('team.add') }}" class="flex flex-col items-center pt-2">
            <x-secondary-button type="submit" class="px-12">Add team</x-secondary-button>
        </form>
        @unless($teams->count() === 0)
            <table class="text-center w-full">
                <thead>
                <tr>
                    <th class="w-1/2">Team name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($teams as $team)
                    <tr>
                        <td class>{{ $team->name }}</td>
                        <td class="grid grid-cols-2">
                            <form method="get" action="{{ route('team.edit', ['team' => $team]) }}">
                                <x-secondary-button type="submit"><i class="fa-solid fa-pen-to-square"></i> Edit
                                </x-secondary-button>
                            </form>

                            <div>
                                <x-danger-button type="submit"
                                                 class="!bg-gray-800 !border-1 !border-red-500 !text-red-300"
                                                 x-data=""
                                                 x-on:click.prevent="$dispatch('open-modal', 'confirm-team-deletion-{{ $team->id }}')">
                                    Delete
                                </x-danger-button>
                            </div>

                            <x-modal name="confirm-team-deletion-{{ $team->id }}" focusable>
                                <h2 class="mt-2 text-lg font-medium text-gray-900 dark:text-gray-100 pl-5">
                                    Are you sure you want to delete this team: <b>{{ $team->name }}</b>?
                                </h2>
                                <input type="hidden" name="id" value="{{ $team->id }}">
                                <div class="flex justify-center align-content-center">
                                    <x-secondary-button class="my-6" x-on:click="$dispatch('close')">
                                        Cancel
                                    </x-secondary-button>

                                    <form method="post" action="{{ route('team.destroy') }}">
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
                </tbody>
            </table>
        @endunless
    </div>
@endsection
