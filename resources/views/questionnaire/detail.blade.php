<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Questionnaire: {{ $questionnaire->title }}
                    </h2>
                    <br>
                    <p class="text-sm">Expiry Date: {{ $questionnaire->expiry_date }}</p>
                    <br>
                    <hr>
                    <form>
                        <div class="mt-6 space-y-2">
                            @foreach ($questionnaire->questions as $question)
                                <div>
                                    <p class="font-bold">{{ $loop->iteration }}. {{ $question->question }}</p>
                                    <br>
                                    <label>
                                        <input disabled type="radio" name="question_{{ $question->id }}" value="true"
                                            {{ $question->answer ? 'checked' : '' }}>
                                        True
                                    </label>

                                    <label class="ml-4">
                                        <input disabled type="radio" name="question_{{ $question->id }}"
                                            value="false" {{ $question->answer ? '' : 'checked' }}>
                                        False
                                    </label>
                                </div>
                                <br>
                            @endforeach
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
