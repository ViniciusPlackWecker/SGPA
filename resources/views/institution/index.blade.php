<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-400 leading-tight">
            {{ __('Instituições') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    @if(session('success'))
                        <div class="bg-green-500 text-white p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($institutions->isEmpty())
                        <p class="text-gray-500 dark:text-gray-300">Nenhuma instituição cadastrada.</p>
                    @else
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700 mb-4">
                            @foreach($institutions as $institution)
                                <li class="py-4 flex justify-between items-center">
                                    <form action="{{ route('institution.update', $institution->id) }}" method="POST" class="flex items-center w-full">
                                        @csrf
                                        @method('patch')
                                        <input type="text" name="name" value="{{ $institution->name }}" class="border p-2 w-full rounded mr-2 dark:bg-gray-700 dark:text-gray-300">
                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                                            {{ __('Salvar') }}
                                        </button>
                                    </form>
                                    <a href="{{ route('institution.destroy', ['id' => $institution->id]) }}" class="border bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        {{ __('Excluir') }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    @error('name')
                        <p class="text-white text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <form action="{{ route('institution.store') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="flex items-center">
                            <input type="text" name="name" placeholder="Nova instituição" class="border p-2 w-full rounded mr-2 dark:bg-gray-700 dark:text-gray-300" required>
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Criar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
