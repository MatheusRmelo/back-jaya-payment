# Jaya Desafio
Projeto para visualizar, confirmar, cancelar e solicitar pagamento.

## Tecnologias
Laravel (Framework)
PHP (Linguagem)
MySQL (Database)

## Docker
Configure o banco de dados criando um arquivo `.env` copie do `env.example` <br>
Configurações do banco <br>
````
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=payments
DB_USERNAME=root
DB_PASSWORD=123456
````
<br>

Depois configure para o frontend em React (SE QUISER RODAR EM CONJUNTO) está no mesmo nível do diretório do Laravel que contém o docker-compose e com o nome `front-jaya-payment` <br>
ou altere no docker-compose.yml o valor `client.build.context` para `o valor da pasta do React` <br>
por fim execute o comando para iniciar o build e os containers `docker compose up -d ` <br>
Após isso configure o APP_KEY executando `docker exec -it app php artisan key:generate` <br>
E por fim rode as migrations com o comando `docker exec -it app php artisan migrate` <br>
Caso queira rodar os testes faça `docker exec -it app php artisan test`

## Instalação manual

# Instalação dos pacotes
Após instalar o PHP e o composer <br>
instale as dependências `composer install` <br>

Configure o .env caso não exista copiando do .env.example<br>
Se APP_KEY do .env estiver vazio rode `php artisan key:generate` <br>
Coloque os dados do MySQL no .env<br>
````
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=NOME_DO_BANCO_CRIADO
DB_USERNAME=USUARIO_DO_SERVER_MYSQL
DB_PASSWORD=SENHA_DO_SERVER_MYSQL
````
para criar tabelas `php artisan migrate` <br>
rodar servidor ```php artisan serve```

# Tests
Os testes de integração rodam em um banco temporário SQLITE, então não precisa configuração extra. E os testes unitários não exigem banco de dados. <br>
Execute <br>
`php artisan test`

