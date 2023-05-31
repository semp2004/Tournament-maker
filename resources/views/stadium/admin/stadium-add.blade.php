@extends('layouts.app')

@section('content')
    <div class="ml-[25%] mr-[25%] mt-10 bg-gray-800 py-8 rounded-lg">
        <h1 class="text-3xl text-center">Add stadium</h1>
        <form method="POST" class="px-7" enctype="multipart/form-data">
            @csrf
            <div class="mt-4 flex flex-col items-center">
                <section>
                    <x-input-label for="name">Stadium name</x-input-label>
                    <x-text-input class="block mt-1 py-1" type="text" id="name" name="name" required autofocus
                                  placeholder="Name" />
                    <br/>
                    <x-input-label for="location">Stadium location</x-input-label>
                    <x-text-input class="block mt-1 py-1" type="text" id="location" name="location" required placeholder="City/Village Address"></x-text-input>
                    <br/>
                    <x-input-label for="image">Image</x-input-label>
                    <input class="block w-full text-sm border rounded-lg cursor-pointer focus:outline-none bg-gray-900" id="image" name="image" type="file">
                    <p class="mt-1 text-sm">PNG, JPG or JPEG.</p>
                    @error('image')
                    <p>{{ $message }}</p>
                    @enderror

                </section>

                <x-secondary-button type="submit" class="mt-6 px-20">Add</x-secondary-button>
            </div>
        </form>
    </div>
@endsection
