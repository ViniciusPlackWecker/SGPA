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
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mostra arquivos com status 'Aprovado' -->
            @if (count($approvedFiles) > 0)
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-200 mb-4">Projetos Aprovados</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($approvedFiles as $file)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-2">{{ $file->old_name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Data de Envio: {{ $file->created_at->format('d/m/Y H:i:s') }}</p>
                                <div class="flex justify-end">
                                    <a href="{{ route('project.download', ['id' => $file->id]) }}" class="border bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        {{ __('Baixar') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Mostra arquivos com status 'Pendente' -->
            @if (count($pendingFiles) > 0)
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-200 mb-4 mt-8">Projetos Pendentes</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($pendingFiles as $file)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-2">{{ $file->old_name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Data de Envio: {{ $file->created_at->format('d/m/Y H:i:s') }}</p>
                                <div class="flex justify-end">
                                    <a href="{{ route('project.download', ['id' => $file->id]) }}" class="border bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        {{ __('Baixar') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Mostra arquivos com status 'Recusado' -->
            @if (count($refusedFiles) > 0)
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-200 mb-4 mt-8">Projetos Recusados</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($refusedFiles as $file)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-2">{{ $file->old_name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Data de Envio: {{ $file->created_at->format('d/m/Y H:i:s') }}</p>
                                <div class="flex justify-end">
                                    <a href="{{ route('project.download', ['id' => $file->id]) }}" class="border bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        {{ __('Baixar') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Caso não haja arquivos em nenhum dos status -->
            @if (count($approvedFiles) == 0 && count($pendingFiles) == 0 && count($refusedFiles) == 0)
                <p class="text-gray-500 dark:text-gray-400 text-center mt-8">Nenhum projeto encontrado.</p>
            @endif
        </div>
    </div>
</x-app-layout>
