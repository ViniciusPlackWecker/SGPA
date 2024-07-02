<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Suas Mensagens') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4">Conversas:</h3>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($conversations as $conversation)
                            <div class="my-4 p-4 bg-gray-100 rounded-md mb-4">
                                <li class="py-2 flex justify-between items-center">
                                    <div>
                                        <strong>Assunto:</strong>
                                        <span class="text-dark">{{ $conversation->cleanTopic }}</span>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="{{ route('messages.show', ['topic' => $conversation->topic]) }}" class="border bg-blue-600 hover:bg-blue-700 text-dark font-bold py-2 px-4 rounded">
                                            {{ __('visualizar mensagens') }}
                                        </a>
                                    </div>
                                </li>
                            </div>
                        @empty
                            <li class="py-2 text-gray-500 dark:text-gray-400">Nenhuma conversa encontrada.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
