<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-400 leading-tight">
            {{ __('Enviar Arquivo') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="advisor_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Defina seu orientador:</label>
                            <select name="advisor_id" id="advisor_id" class="mt-1 p-2 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="" disabled selected>Selecione um professor</option>
                                @foreach($advisors as $advisor)
                                    <option value="{{ $advisor->id }}">{{ $advisor->first_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="tags" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Escolha as tags relacionadas ao projeto:</label>
                            <select class="js-example-basic-multiple mt-1 p-2 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="tags[]" multiple="multiple">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="owner_id" value="{{ Auth::id() }}">
                        <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Escolha seu arquivo a ser enviado:</label>
                        <div class="mb-4 flex items-center justify-between mt-1">
                            <div>
                                <input type="file" name="file" id="file" class="border border-green-600 rounded-lg inline-flex items-center px-4 py-2 text-white bg-green-600 hover:bg-green-700" required accept=".pdf,.doc,.docx">
                                @error('file')
                                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex-shrink-0">
                                <button type="submit" class="border border-green-600 rounded-lg inline-flex items-center px-4 py-2 text-white bg-green-600 hover:bg-green-700">Enviar Arquivo</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Select2 js-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
</x-app-layout>