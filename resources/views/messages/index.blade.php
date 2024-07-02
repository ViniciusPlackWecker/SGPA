<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-400 dark:text-gray-400 leading-tight">
            {{ __('Suas Mensagens') }}
        </h2>
    </x-slot>

    @php
        $previousTopic = null;
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-dark border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4 flex justify-center">Conversas:</h3>
                    <div class="p-6 bg-dark border-b border-gray-200 dark:border-gray-700 flex justify-center"> 
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="px-4 py-2 text-left text-sm font-bold text-gray-800 dark:text-gray-200">Assunto</th>
                                    <th class="px-4 py-2 text-left text-sm font-bold text-gray-800 dark:text-gray-200">Destinatário</th>
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y my-4 p-4 bg-gray-100 rounded-md mb-4">
                                @forelse ($conversations as $conversation)
                                    @if ($conversation->topic != $previousTopic)
                                        <tr>
                                            <td class="px-4 py-2 whitespace-nowrap">
                                                <span class="text-dark">{{ $conversation->cleanTopic }}</span>
                                            </td>
                                            <td class="px-4 py-2 whitespace-nowrap">
                                                <span class="text-dark">{{ $conversation->receiver->email }}</span>
                                            </td>
                                            <td class="px-4 py-2 whitespace-nowrap">
                                                <a href="{{ route('messages.show', ['topic' => $conversation->topic]) }}" class="border border-gray-700 rounded-lg inline-flex items-center px-4 py-2 text-white dark:bg-gray-700 ml-2">
                                                    {{ __('visualizar mensagens') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                    @php
                                        $previousTopic = $conversation->topic;
                                    @endphp
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-2 text-gray-500 dark:text-gray-400 text-center">Nenhuma conversa encontrada.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
