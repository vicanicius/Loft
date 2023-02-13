## Dependências

- Docker

### Execute os seguintes passos separadamente no seu terminal dentro da pasta do projeto:

Levante a aplicação com docker.

`docker-compose up --build -d`

O ambiente pode ser acessado no http://localhost:8000

Em seguidam, dentro do cotainer da aplicação:

`php artisan migrate`

`php artisan db:seed`

## Instrução de uso

Utilizar a collection de Postman na raiz do projeto com as rotas já configuradas.

Obs.: Caso dê problema com o Sqlite, rode o seguinte comando dentro do container:

`php artisan config:cache`

## Testes

Rode o seguinte comando dentro do container:

`php artisan test`