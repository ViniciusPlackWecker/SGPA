<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-400 leading-tight">
            {{ __('Enviar Arquivo') }}
        </h2>
        <br>
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
            @if (Auth::user()->role === 'teacher')
                <x-nav-link :href="route('project.advisor', ['userId' => Auth::id()])" :active="request()->routeIs('project.advisor')">
                    {{ __('Meus projetos orientados') }}
                </x-nav-link>
            @endif
            <x-nav-link :href="route('project.show', ['userId' => Auth::id()])" :active="request()->routeIs('project.show')">
                {{ __('Meus Projetos') }}
            </x-nav-link>
            
            <x-nav-link :href="route('project.create')" :active="request()->routeIs('project.create')">
                {{ __('Enviar novo projeto') }}
            </x-nav-link>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <form action="{{ route('project.update', ['id' => $file->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="mb-4">
                            <label for="advisor_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Defina seu orientador:</label>
                            <select name="advisor_id" id="advisor_id" class="js-example-basic-single mt-1 p-2 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach($advisors as $advisor)
                                    <option value="{{ $advisor->id }}" {{ $file->advisor_id == $advisor->id ? 'selected' : '' }}>{{ $advisor->first_name . ' ' . $advisor->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="tags" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Escolha as tags relacionadas ao projeto:</label>
                            <select class="js-example-basic-multiple mt-1 p-2 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="tags[]" multiple="multiple">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ in_array($tag->id, $file->tags->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="owner_id" value="{{ Auth::id() }}">
                        <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Escolha seu arquivo a ser enviado:</label>
                        <div class="mb-4 flex items-center justify-between mt-1">
                            <div>
                                <input type="file" name="file" id="file" class="border border-green-600 rounded-lg inline-flex items-center px-4 py-2 text-white bg-green-600 hover:bg-green-700" accept=".pdf">
                                @error('file')
                                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex-shrink-0">
                                <button type="submit" class="border border-green-600 rounded-lg inline-flex items-center px-4 py-2 text-white bg-green-600 hover:bg-green-700">Enviar Arquivo</button>
                            </div>
                            
                        </div>
                        <p class="text-white mb-4">Nome do arquivo sendo editado: {{$file->old_name}}</p>
                    </form>
                    <a href="{{ route('project.destroy', ['id' => $file->id]) }}" class="border bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Excluir Projeto') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Select2 js-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
            $('.js-example-basic-single').select2();
        });
    </script>
</x-app-layout>