$(document).ready(function() {
    $('#phoneInput').on('input', function() {
        var input = $(this).val().replace(/\D/g, ''); // Remove todos os caracteres não numéricos
        var formatted = '';

        // Adiciona parênteses e traço conforme o número é digitado
        if (input.length > 0) {
            formatted = '(' + input.substring(0, 2);
        }
        if (input.length > 2) {
            formatted += ') ' + input.substring(2, 7);
        }
        if (input.length > 7) {
            formatted += '-' + input.substring(7, 11);
        }

        $(this).val(formatted);
    });

    // Validação para aceitar apenas números
    $('#phoneInput').on('keydown', function(event) {
        // Permite apenas números e teclas de navegação
        if (event.key.match(/[^0-9]/) && !['Backspace', 'ArrowLeft', 'ArrowRight', 'Delete', 'Tab'].includes(event.key)) {
            event.preventDefault();
        }
    });
});