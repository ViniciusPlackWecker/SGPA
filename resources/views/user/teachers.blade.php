<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-400 dark:text-gray-400 leading-tight">
            {{ __('Lista de professores cadastrados no sistema:') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
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
                                    Ações
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($teachers as $teacher)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100 border border-gray-200 dark:border-gray-700">
                                        {{ $teacher->first_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 border border-gray-200 dark:border-gray-700"">
                                        {{ $teacher->last_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 border border-gray-200 dark:border-gray-700"">
                                        {{ $teacher->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100 border border-gray-200 dark:border-gray-700">
                                    @if(Auth::user()->role === 'teacher')
                                        <form method="post" action="{{ route('profile.updateRole', $teacher->id) }}" class="mt-6 space-y-6">
                                            @csrf
                                            @method('patch')
                                            <div class="flex space-x-4 ">
                                                <select name="role_select" id="role_select" class="mt-1 p-2 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-950 dark:text-gray-950">
                                                    <option value="teacher" selected>Professor</option>
                                                    <option value="student">Aluno</option>
                                                </select>
                                                <button type="submit" class="border border-green-600 rounded-lg inline-flex items-center px-4 py-2 text-white bg-green-600 hover:bg-green-700">
                                                    Alterar
                                                </button>
                                            </div>
                                        </form>                                                            
                                        @endif
                                        <div class="mt-4">
                                            <a href="{{ route('messages.createWithReceiver', $teacher->id) }}" class="border border-green-600 rounded-lg inline-flex items-center px-4 py-2 text-white bg-green-600 hover:bg-green-700 ml-2">
                                                Entrar em contato
                                            </a>
                                        </div>  
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
