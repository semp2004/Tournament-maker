@extends('layouts.app')
@props(['user' => $user])


@section('header')
    <h2>
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Change user</h1>
    </h2>
@endsection


@section('content')
    <div class="bg-gray-800 text-gray-800 bg-gray-200 rounded pt-6 pb-8 mb-4 ml-80 mr-80">
        <form class="mx-48 w-3/4 text-xl" method="post">
            @csrf
            <div class=" mt-4 w-full">
                <x-input-label for="name" value="Name" class=""/>
                <x-text-input name="name" :value="$user->name" class="block mt-1 w-full"></x-text-input>

            </div>

            <div class="mt-4 w-full">
                <x-input-label for="email" value="Email"/>
                <x-text-input name="email" :value="$user->email" class="block mt-1 w-full "></x-text-input>

            </div>

            <div class=" mt-4 w-full">
                <x-input-label for="name" value="Function" class=""/>
                <select name="role" :value="$user->role"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'">
                    <option value="user">--Please choose an option--</option>
                    <option value="admin">Admin</option>
                    <option value="referee">referee</option>
                    <option value="user">User</option>
                </select>

            </div>

            <div class=" mt-4 w-full">
                <x-input-label for="name" value="Team selecter" class=""/>
                <select name="team"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'">
                    <option value="na">--Please choose an option--</option>
                    @foreach($teams as $team)
                        <option value="{{$team->id}}">{{$team->name}}</option>
                    @endforeach
                </select>

            </div>

            <br/>
            <x-secondary-button type="submit" class="w-full"><i class="fa-solid fa-pen-to-square fa-beat"></i> Save
            </x-secondary-button>

        </form>
    </div>
@endsection
