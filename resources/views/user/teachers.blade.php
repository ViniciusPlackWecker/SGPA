<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-400 dark:text-gray-400 leading-tight">
            {{ __('Lista de professores cadastrados no sistema:') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-center">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Nome
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Sobrenome
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Instituição
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Contato
                                </th>
                                @if(Auth::user()->role === 'teacher')
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Nível
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($teachers as $teacher)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100 border border-gray-200 dark:border-gray-700">
                                        {{ $teacher->first_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 border border-gray-200 dark:border-gray-700">
                                        {{ $teacher->last_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 border border-gray-200 dark:border-gray-700">
                                        {{ $teacher->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 border border-gray-200 dark:border-gray-700">
                                        {{ $teacher->institution }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100 border border-gray-200 dark:border-gray-700">
                                        <div class="flex justify-between">    
                                            <a href="{{ route('messages.createWithReceiver', $teacher->id) }}" class="border bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                Enviar Mensagem
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100 border border-gray-200 dark:border-gray-700">
                                        @if(Auth::user()->role === 'teacher')
                                            <form method="post" action="{{ route('profile.updateRole', $teacher->id) }}" class="flex items-center">
                                                @csrf
                                                @method('patch')
                                                    <select name="role_select" id="role_select" class="border w-full bg-gray-200 text-gray-900 font-bold py-2 px-4 rounded custom-select">
                                                        <option value="student">Aluno</option>
                                                        <option value="teacher" selected>Professor</option>
                                                    </select>
                                                <button type="submit" class="ml-2 border bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    Alterar
                                                </button>
                                            </form>                                                         
                                         @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
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
