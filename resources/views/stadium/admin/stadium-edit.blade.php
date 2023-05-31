@props(['stadium'])

@extends('layouts.app')

@section('content')
    <div class="ml-[25%] mr-[25%] mt-10 bg-gray-800 py-8 rounded-lg">
        <h1 class="text-3xl text-center">Edit stadium</h1>
        <form method="POST" class="px-7" enctype="multipart/form-data">
            @csrf
            <div class="mt-4 flex flex-col items-center">
                <section>
                    <x-input-label for="name">Stadium name</x-input-label>
                    <x-text-input class="block mt-1 py-1" type="text" id="name" name="name" required autofocus
                                  placeholder="Name" value="{{ $stadium->name }}" />
                    <br/>
                    <x-input-label for="location">Stadium location</x-input-label>
                    <x-text-input class="block mt-1 py-1" type="text" id="location" name="location" required placeholder="City/Village Address" value="{{ $stadium->location }}" />
                    <br/>
                    <x-input-label for="image">Image</x-input-label>
                    <input class="block w-full text-sm border rounded-lg cursor-pointer focus:outline-none bg-gray-900" id="image" name="image" type="file">
                    <p class="mt-1 text-sm">PNG, JPG or JPEG.</p>
                    @error('image')
                    <p>{{ $message }}</p>
                    @enderror
                    <input type="hidden" name="id" value="{{ $stadium->id }}" />
                </section>

                <x-secondary-button type="submit" class="mt-6 px-20">Edit</x-secondary-button>
            </div>
        </form>
        @if(isset($stadium->image_path))
            <form method="POST" class="px-7 mt-2 flex flex-col items-center">
                @method('DELETE')
                @csrf
                <x-danger-button type="submit">Delete image</x-danger-button>
            </form>
        @endif
    </div>
@endsection
