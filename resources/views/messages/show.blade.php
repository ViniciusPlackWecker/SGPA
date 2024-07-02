<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-400 leading-tight">
            {{ __('Mensagens no Tópico') }}: {{ $specificUserMessages[0]->cleanTopic }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 bg-dark border-b border-gray-200 dark:border-gray-700">
                    @if ($specificUserMessages->isEmpty())
                        <p class="text-white">Nenhuma mensagem encontrada neste tópico.</p>
                    @else
                        <ul>
                            {{-- Inicializa o assunto --}}
                            <li>
                                <strong class="text-white">Assunto:</strong> <span class="text-white">{{ $specificUserMessages[0]->cleanTopic }}</span>
                            </li>
                            {{-- Exibe cada mensagem com um espaçamento --}}
                            @foreach ($specificUserMessages as $specificUserMessage)
                                <div class="my-4 p-4 bg-gray-100 rounded-md mb-4">
                                        <strong>De:</strong> {{ $specificUserMessage->sender->email }}<br>
                                        <strong>para:</strong> {{ $specificUserMessage->receiver->email }}<br>
                                    <hr>
                                    <div class="my-4 p-4 bg-gray-100 rounded-md mb-4">
                                        <strong>Mensagem: </strong> {{ $specificUserMessage->description }}
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 bg-dark border-b border-gray-200 dark:border-gray-700">
                    <form action="{{ route('messages.storeInTopic') }}" method="POST">
                        @csrf
                        <input type="hidden" name="topic" id="topic" value="{{ $topic }}">
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descrição:</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 p-2 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="receiver_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Enviar para:</label>
                            <input type="text" id="receiver_email" value="{{ $otherUser->email }}" class="mt-1 p-2 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" readonly>
                        </div>
                        <input type="hidden" name="receiver_id" value="{{ $otherUser->id }}">
                        <div class="flex justify-end">
                            <button type="submit" class="border border-green-600 rounded-lg inline-flex items-center px-4 py-2 text-white bg-green-600 hover:bg-green-700 ml-2">Enviar Mensagem</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
