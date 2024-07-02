<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-400 leading-tight">
            {{ __('Nova Mensagem') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-dark border-b border-gray-200 dark:border-gray-700">
                    <form action="{{ route('messages.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="topic" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tópico:</label>
                            <input type="text" name="topic" id="topic" class="mt-1 p-2 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descrição:</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 p-2 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="receiver_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Enviar para:</label>
                            <input type="text" id="receiver_email" value="{{ $receiver_email }}" class="mt-1 p-2 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" readonly>
                        </div>
                        <input type="hidden" name="receiver_id" value="{{ $receiver_id }}">
                        <div class="flex justify-end">
                            <button type="submit" class="border border-green-600 rounded-lg inline-flex items-center px-4 py-2 text-white bg-green-600 hover:bg-green-700 ml-2 disabled">Enviar Mensagem</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
