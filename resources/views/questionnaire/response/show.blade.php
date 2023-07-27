<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen bg-gray-100">
        <main>
            <div class="py-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div>
                            @if ($existingResponse)
                                <h1 class="text-2xl font-bold text-green-600">You have already submitted the response
                                    for this
                                    questionnaire</h1>
                            @else
                                <h1 class="text-2xl font-bold text-black-100">{{ $questionnaireDetail->title }}</h1>
                                <br>
                                <p class=""> Expiry Date: {{ $questionnaireDetail->expiry_date }}</p>
                                <br>
                                <hr><br>
                                <form method="post"
                                    action="{{ route('questionnaire.response.submit', [
                                        'questionnaireId' => $questionnaireId,
                                        'studentId' => $studentId,
                                        'uniqueIdentifier' => $uniqueIdentifier
                                    ]) }}">
                                    @csrf
                                    @foreach ($questionnaireQuestions as $questionnaireQuestion)
                                        <div>
                                            <p class="font-bold">{{ $loop->iteration }}.
                                                {{ $questionnaireQuestion->question->question }}</p>
                                            <br>
                                            <label>
                                                <input type="radio" name="question[{{ $questionnaireQuestion->id }}]"
                                                    value="true" required>
                                                True
                                            </label>

                                            <label class="ml-4">
                                                <input type="radio" name="question[{{ $questionnaireQuestion->id }}]"
                                                    value="false" required>
                                                False
                                            </label>
                                        </div>
                                        <br>
                                    @endforeach

                                    <div>
                                        <x-primary-button
                                            onclick="return confirm('Are you sure you want to submit the questionnaire?')">
                                            Submit</x-primary-button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
