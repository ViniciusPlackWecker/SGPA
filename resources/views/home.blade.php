<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-400 text-gray-400 leading-tight">
            {{ __('Bem-vindo(a) ao Sistema de Gestão de Projetos Acadêmicos, :name', ['name' => Auth::user()->first_name]) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Olá, :name! Este é o seu sistema personalizado de gestão de projetos acadêmicos. Aqui você pode visualizar, enviar e gerenciar seus projetos de forma eficiente.', ['name' => Auth::user()->first_name]) }}
                    <p>Estamos aqui para ajudar você a organizar suas atividades acadêmicas de maneira simples e eficaz. Explore as funcionalidades disponíveis e aproveite ao máximo sua experiência!</p>
                    <p>Se precisar de ajuda ou tiver alguma dúvida, não hesite em entrar em contato conosco.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
