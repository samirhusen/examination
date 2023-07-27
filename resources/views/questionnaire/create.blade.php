<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create a new questionnaire
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-10 text-gray-900">
                    <form method="POST" action="{{ route('question.store') }}" class="max-w-lg">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label class="text-sm">Title</label>
                                <input name="title" placeholder="Enter the title of questionnaire"
                                    class="block mt-2 w-full border-gray-300 focus:ring-0 focus:border-gray-500"
                                    required>
                            </div>
                            <div class="flex-1">
                                <label class="text-sm">Expiry Date</label>
                                <input type="date" name="expiry_date"
                                    class="block mt-2 w-full border-gray-300 focus:ring-0 focus:border-gray-500"
                                    min="{{ date('Y-m-d', strtotime('tomorrow')) }}" required>
                            </div>
                            <div>
                                <x-primary-button
                                    onclick="return confirm('Are you sure you want to create the questionnaire?')">
                                    Generate</x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
