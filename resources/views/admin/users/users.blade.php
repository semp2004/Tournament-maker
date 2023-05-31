@extends('layouts.app')
@props(['users' => $users])

@section('content')
    <h1 class="text-center mt-6 text-3xl">Users</h1>
    <br>
    <div class="dark:bg-gray-800 dark:text-gray-200 text-gray-800 bg-gray-200 rounded pt-6 pb-8 mb-4 ml-20 mr-20">
        <table class="text-center w-full">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Team</th>
                <th>Function</th>
                <th>Actions</th>
            </tr>

            @foreach($users as $user)
                <tr>

                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>

                    @if(! $user->teams()->exists())
                        <td>No team</td>
                    @elseif($user->teams()->exists())
                        @foreach($user->teams as $team)
                            <td>{{$team->name}}</td>
                        @endforeach
                    @endif

                    <td>{{$user->role}}</td>

                    <td class="grid grid-cols-2">
                        <form method="get" action="{{route('user.edit', ['user' => $user])}}">
                            <x-secondary-button type="submit"><i class="fa-solid fa-pen-to-square"></i> Edit
                            </x-secondary-button>
                        </form>

                        <form method="get" action="{{route('DeleteUser', ['user' => $user])}}">
                            <x-secondary-button type="submit" class="!bg-gray-800 !border-1 !border-red-500 !text-red-300"><i class="fa-solid fa-eraser"></i> Delete
                            </x-secondary-button>
                        </form>

                    </td>
                </tr>
            @endforeach

        </table>
    </div>
@endsection
