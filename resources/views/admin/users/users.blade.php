@extends('layouts.app')
@props(['users' => $users])


@section('header')
    <h2>
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Gebruikers aanpassen</h1>
    </h2>
@endsection



@section('content')
    <div class="dark:bg-gray-800 dark:text-gray-200 text-gray-800 bg-gray-200 rounded pt-6 pb-8 mb-4 ml-20 mr-20">
        <table class="text-center w-full">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Function</th>
                <th>Actions</th>
            </tr>

            @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role}}</td>

                    <td class="grid grid-cols-2">
                        <form method="get" action="{{route('user.edit', ['user' => $user])}}">
                            <x-secondary-button type="submit"><i class="fa-solid fa-pen-to-square"></i> Change
                            </x-secondary-button>
                        </form>

                        <form method="get" action="{{route('DeleteUser', ['user' => $user])}}">
                            <x-secondary-button type="submit"><i class="fa-solid fa-eraser"></i> Delete
                            </x-secondary-button>
                        </form>

                    </td>
                </tr>
            @endforeach

        </table>
    </div>
@endsection
