<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Active Questionnaires
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-10 text-gray-900 max-w-2xl divide-y">
                    @php
                        $i = 1;
                    @endphp
                    @forelse ($questionnaires as $questionnaire)
                        <div class="py-6">
                            <div class="flex gap-6 justify-between">
                                <div>
                                    <p class="text-2xl font-bold text-purple-700">{{ $i . ') ' . $questionnaire->title }}
                                    </p>
                                    <br>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="text-sm"><b>Expiry Date:</b> {{ $questionnaire->expiry_date }}</p>
                                    <br>
                                    <a href="{{ url('/dashboard/question/' . $questionnaire->id) }}"
                                        class="font-bold text-blue-600 md:text-purple-800 text-xxl underline underline-offset-1 ">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                        @php
                            $i++;
                        @endphp
                    @empty
                        <div>
                            <p>You don't have any active questionnaire</p>
                            <a class="inline-block mt-6 underline text-sm" href="{{ route('question.create') }}">
                                Create questionnaire
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
