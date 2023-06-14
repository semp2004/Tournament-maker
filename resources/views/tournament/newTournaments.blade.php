<style>
    .selectable-bubble {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin-right: 10px;
    }

    .bubble {
        display: inline-block;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #f2f2f2;
        color: #333;
        text-align: center;
        line-height: 40px;
        transition: background-color 0.3s;
    }

    .selectable-bubble input[type="radio"]:checked + .bubble {
        background-color: #5a67d8;
        color: #fff;
    }
</style>
@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-6 text-3xl">Create new single elimination tournament</h1>
    <div class="max-w-md mx-auto bg-gray-800 text-white p-8 mt-8 rounded shadow">

        <form action="{{ route('tournament.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-300 font-semibold mb-2">Name</label>
                <input type="text" id="name" name="name"
                       class="w-full bg-gray-700 border-gray-600 rounded py-2 px-3 focus:outline-none focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-300 font-semibold mb-2">Description</label>
                <textarea id="description" name="description"
                          class="w-full bg-gray-700 border-gray-600 rounded py-2 px-3 focus:outline-none focus:border-indigo-500"></textarea>
            </div>


            <div class="mb-4">
                <label for="description" class="block text-gray-300 font-semibold mb-2">Team size</label>
                <div class="flex items-center space-x-4">
                    <label for="amount-10" class="selectable-bubble">
                        <input type="radio" id="amount-10" name="amount" value="4" class="hidden">
                        <span class="bubble bg-gray-300 text-gray-700">4</span>
                    </label>
                    <label for="amount-20" class="selectable-bubble">
                        <input type="radio" id="amount-20" name="amount" value="8" class="hidden">
                        <span class="bubble bg-gray-300 text-gray-700 mr-2.5">8</span>
                    </label>
                    <label for="amount-30" class="selectable-bubble">
                        <input type="radio" id="amount-30" name="amount" value="16" class="hidden">
                        <span class="bubble bg-gray-300 text-gray-700">16</span>
                    </label>
                </div>
            </div>

            <div class="mb-4">
                <label for="match_id" class="block text-gray-300 font-semibold mb-2">Team select</label>
                <div>
                    <select name="teams[]" size="5" multiple
                            class="bg-gray-700 border-gray-600 rounded py-2 px-3 focus:outline-none focus:border-indigo-500">
                        @foreach($teams as $team)
                            <option value="{{$team->id}}">{{$team->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label for="match_id" class="block text-gray-300 font-semibold mb-2">Referee select</label>

                <div>
                    <select name="referee" size="1"
                            class="bg-gray-700 border-gray-600 rounded py-2 px-3 focus:outline-none focus:border-indigo-500">
                        @foreach($referees as $referee)
                            <option value="" hidden="true">--Please choose an option--</option>
                            @if ($referee->role == "Referee")
                                <option value="{{$referee->id}}">
                                    {{$referee->name}}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit"
                        class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded"
                        id="create-tournament-btn" disabled>
                    Create Tournament
                </button>
            </div>

            <script>
                window.onmousedown = function (e) {
                    var el = e.target;
                    if (el.tagName.toLowerCase() == 'option' && el.parentNode.hasAttribute('multiple')) {
                        e.preventDefault();

                        // toggle selection
                        if (el.hasAttribute('selected')) {
                            el.removeAttribute('selected');
                        } else {
                            var selectedTeams = document.querySelectorAll('select[name="teams[]"] option:checked');
                            var teamSize = document.querySelector('input[name="amount"]:checked').value;

                            if (selectedTeams.length >= teamSize) {
                                alert("Error: Maximum team selection reached.");
                                return;
                            }

                            el.setAttribute('selected', '');
                        }

                        // hack to correct buggy behavior
                        var select = el.parentNode.cloneNode(true);
                        el.parentNode.parentNode.replaceChild(select, el.parentNode);
                    }
                }

                var teamSizeRadios = document.querySelectorAll('input[name="amount"]');
                teamSizeRadios.forEach(function (radio) {
                    radio.addEventListener('change', function () {
                        var selectedTeams = document.querySelectorAll('select[name="teams[]"] option:checked');
                        selectedTeams.forEach(function (team) {
                            team.removeAttribute('selected');
                        });
                    });
                });

                document.querySelector('button[type="submit"]').addEventListener('click', function (e) {
                    var selectedTeams = document.querySelectorAll('select[name="teams[]"] option:checked');
                    var teamSize = document.querySelector('input[name="amount"]:checked').value;

                    if (selectedTeams.length != teamSize) {
                        e.preventDefault();
                        alert("Error: Please select the correct number of teams[].");
                    }
                });

                // Check if all required fields are filled in
                function checkFormValidity() {
                    var nameField = document.getElementById('name');
                    var descriptionField = document.getElementById('description');
                    var refereeField = document.querySelector('select[name="referee"]');
                    var selectedTeams = document.querySelectorAll('select[name="teams[]"] option:checked');
                    var teamSize = document.querySelector('input[name="amount"]:checked');

                    var createTournamentBtn = document.getElementById('create-tournament-btn');

                    if (nameField.value.trim() !== '' && descriptionField.value.trim() !== '' && refereeField.value.trim() !== ''
                        && selectedTeams.length === parseInt(teamSize.value)) {
                        createTournamentBtn.removeAttribute('disabled');
                        createTournamentBtn.classList.remove('bg-gray-500', 'cursor-not-allowed');
                    } else {
                        createTournamentBtn.setAttribute('disabled', true);
                        createTournamentBtn.classList.add('bg-gray-500', 'cursor-not-allowed');
                    }
                }

                // Add event listeners to required fields
                document.getElementById('name').addEventListener('input', checkFormValidity);
                document.getElementById('description').addEventListener('input', checkFormValidity);
                document.querySelector('select[name="referee"]').addEventListener('change', checkFormValidity);
                document.querySelector('input[name="amount"]').addEventListener('change', checkFormValidity);
                document.querySelectorAll('select[name="teams[]"] option').forEach(function (option) {
                    option.addEventListener('click', checkFormValidity);
                });

                // Initial check on page load
                checkFormValidity();
            </script>

@endsection
