1 - Docker
É preciso ter o docker e o git instaldo.

Clonar os projetos do repositorios.

Executar o comando docker-compose up -d --build dentro da pasta carteira_financeira.

Executar o comando
docker exec -it laravel-carteirafinanceira bash,
composer install

no terminal do container laravel-carteirafinanceira
php artisan migrate 


2 - Local
Ter o php (qualuqer versão 8, o docker usa o 8.4, wamp ou xamp ), laravel, composer, node e o mariadb instalado na maquina
Clonar os projetos do repositorios.
Entrar no projeto carteira_financeira e executar o composer install, php artisan key:generate, php artisan migrate, 
Entrar no projeto carteira_financeira_front e executar o npm install



