## Iniciar projeto

1. Baixar XAMP - PHP e MySQL
2. Baixar Composer
3. Descomentar ZIP no config do Apache -> config -> php.ini -> extension=zip
4. Adicionar .env com modelo no arquivo .env.sample
5. npm i artisan

## Rodar projeto -> terminal

1. composer install ou composer update
2. php artisan migrate
2. rodar: php artisan serve 

## Rollback na migrate se der erro
1. php artisan migate:rollback
2. php artisan migate:rollback --step=2