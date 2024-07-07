<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-400 leading-tight">
            {{ __('Seus Projetos Enviados') }}
        </h2>
        <br>
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
            <x-nav-link :href="route('project.show', ['userId' => Auth::id()])" :active="request()->routeIs('project.show')">
                {{ __('Meus Projetos') }}
            </x-nav-link>
            <x-nav-link :href="route('project.create')" :active="request()->routeIs('project.create')">
                {{ __('Enviar novo projeto') }}
            </x-nav-link>
            @if (Auth::user()->role === 'teacher')
            <x-nav-link :href="route('project.advisor', ['userId' => Auth::id()])" :active="request()->routeIs('project.advisor')">
                {{ __('Meus projetos orientados') }}
            </x-nav-link>
            @endif
        </div>
    </x-slot>

    <div class="py-12 flex">
        <div class="w-1/4 p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4">Filtros</h3>
            
            <div class="mb-4">
                <h4 class="text-md font-semibold text-gray-700 dark:text-gray-300">Tags:</h4>
                <div class="flex flex-col">
                    @foreach ($tags as $tag)
                        <label class="inline-flex items-center mt-2">
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600 tag-checkbox" value="{{ $tag->id }}" id="tag-{{ $tag->id }}">
                            <span class="ml-2 text-gray-700 dark:text-gray-300">{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="w-3/4 px-6 lg:px-8 items-center">
            @if (count($advisedFiles) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 file-card">
                    @foreach ($advisedFiles as $file)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg file-item">
                            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4">{{ $file->old_name }}</h3>
                                <strong class="text-white">Orientando:</strong> <span class="text-white">{{ $file->owner->first_name . ' ' . $file->owner->last_name }}</span>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-4 mb-4">Data de Envio: {{ $file->created_at->format('d/m/Y H:i:s') }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Data de Atualização: {{ $file->updated_at->format('d/m/Y H:i:s') }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Tags:
                                    @foreach ($file->tags as $tag)
                                        <span class="bg-blue-500 text-white rounded px-2 py-1 file-tag" data-tag="{{ $tag->id }}">| {{ $tag->name }} |</span>
                                    @endforeach
                                </p>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status:</label>
                                <div class="flex justify-between">
                                    <form action="{{ route('project.statusUpdate', ['id' => $file->id]) }}" method="POST" class="flex items-center">
                                        @csrf
                                        @method('patch')
                                        <select name="status" class="border w-full bg-gray-200 text-gray-900 font-bold py-2 px-4 rounded custom-select">
                                            <option value="pending" {{ $file->status == 'pending' ? 'selected' : '' }}>Pendente</option>
                                            <option value="approved" {{ $file->status == 'approved' ? 'selected' : '' }}>Aprovado</option>
                                            <option value="refused" {{ $file->status == 'refused' ? 'selected' : '' }}>Recusado</option>
                                        </select>
                                        <button type="submit" class="ml-2 border bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            {{ __('Alterar') }}
                                        </button>
                                    </form>
                                    <a href="{{ route('project.download', ['id' => $file->id]) }}" class="border bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        {{ __('Baixar Projeto') }}
                                    </a>    
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 dark:text-gray-400 text-center mt-8">Nenhum projeto orientado encontrado.</p>
            @endif
        </div>
    </div>

    <script src="{{ asset('js/file-filter.js') }}"> </script>
    <style>
        .tag-checkbox:focus {
            outline: none;
            box-shadow: none;
        }
        .custom-select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: none;
            padding-right: 1rem; /* Ajustar conforme necessário */
        }
        .custom-select::-ms-expand {
            display: none;
        }
    </style>
</x-app-layout>
