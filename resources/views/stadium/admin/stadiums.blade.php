@props(['stadiums'])
@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-6 text-3xl">Stadiums</h1>
    <div class="ml-96 mr-96 mt-8 bg-gray-800 py-2 rounded-lg">
        <form method="get" action="{{ route('stadium.add') }}" class="flex flex-col items-center pt-2">
            <x-secondary-button type="submit" class="px-12">Add stadium</x-secondary-button>
        </form>
        @unless($stadiums->count() === 0)
            <table class="mt-6 text-center w-full">
                <thead>
                <tr>
                    <th class="w-1/4">Image</th>
                    <th class="w-1/4">Stadium name</th>
                    <th class="w-1/4">Stadium location</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($stadiums as $stadium)
                    <tr>
                        <td class="flex items-center justify-center"><img class="max-h-20"
                                                                          src="{{Storage::url($stadium->image_path)}}"
                                                                          alt="no image"></td>
                        <td>{{ $stadium->name }}</td>
                        <td>{{ $stadium->location }}</td>
                        <td>
                            <div class="grid grid-cols-2">
                                <form method="get" action="{{ route('stadium.edit', ['stadium' => $stadium]) }}">
                                    <x-secondary-button type="submit"><i class="fa-solid fa-pen-to-square"></i> Edit
                                    </x-secondary-button>
                                </form>
                                <div class="flex items-center">
                                    <x-danger-button type="submit"
                                                     class="!bg-gray-800 !border-1 !border-red-500 !text-red-300"
                                                     x-data=""
                                                     x-on:click.prevent="$dispatch('open-modal', 'confirm-stadium-deletion-{{ $stadium->id }}')">
                                        Delete
                                    </x-danger-button>
                                </div>

                                <x-modal name="confirm-stadium-deletion-{{ $stadium->id }}" focusable>
                                    <form method="post" action="{{ route('stadium.destroy') }}">
                                        @csrf
                                        @method('DELETE')
                                        <h2 class="mt-2 text-lg font-medium text-gray-900 dark:text-gray-100 pl-5">
                                            Are you sure you want to delete this stadium: <b>{{ $stadium->name }}</b>?
                                        </h2>
                                        <input type="hidden" name="id" value="{{ $stadium->id }}">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            Cancel
                                        </x-secondary-button>
                                        <x-danger-button type="submit"
                                                         class="ml-5 my-6 !bg-gray-800 !border-1 !border-red-500 !text-red-300">
                                            Delete
                                        </x-danger-button>
                                    </form>
                                </x-modal>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endunless
    </div>
@endsection
