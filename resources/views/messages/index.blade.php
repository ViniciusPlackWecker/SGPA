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
                            <li class="py-2">
                                <a href="{{ route('messages.show', ['topic' => $conversation->topic, 'userId' => $userId]) }}" class="text-blue-600 hover:text-blue-900">{{ $conversation->topic }}</a>
                            </li>
                        @empty
                            <li class="py-2 text-gray-500 dark:text-gray-400">Nenhuma conversa encontrada.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
