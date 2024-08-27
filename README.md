# Projeto Teste - (Cadastro de Livros)

Este projeto foi desenvolvido a fim de demonstrar meus conhecimentos técnicos para concorrer a uma oportunidade de emprego como desenvolvedor Sênior/Master.


## 🛠 Tecnologias utilizadas

- **Angular v13.2.0** - Framework frontend
- **Laravel v8.83.27** - Framework backend
- **Docker** - Gerenciamento de containers, 
- **PHP v8.1.29** - Linguagem de programação backend, 
- **PHP-Unit** - Para TDD (Test Driven Development / Desenvolvimento Orientado a Testes), 
- **Swagger** - Design, modelagem e documentação de API, 
- **Nginx v1.23** - Servidor web e proxy reverso, 
- **MySql v8.0.39** - Servidor de banco de dados, 
- **PhpMyAdmin** - Administrador de banco de dados, 
- **Redis v7.0** - Armazenamento de dados em memória baseado em chave e valor utilizada para cache de aplicação
- **NodeJs v18.19** - Ambiente de execução Javascript server-side

## ⚙️ Instalação

Baixe o repositório do projeto no github:

Em seguida acesse o diretório raiz do projeto
```bash
  cd cadastro-livros
```

Instale o laravel com Composer, caso o diretório backend não exista no projeto

```bash
  composer create-project laravel/laravel backend
```

Levante todos os containers da aplicação com Docker

```bash
  docker-compose up -d --build
```

Execute o comando para verificar se todos os serviços já estão em execução no Docker

```bash
  docker container ls
```

Execute o comando para limpar o cache do Laravel

```bash
  docker exec setup-php php artisan config:cache
```

Execute o comando para certificar que o composer foi instalado com sucesso e instalar as dependências

```bash
  docker exec setup-php composer install
```

Execute o comando para criar o banco de dados e as tabelas no MySql

```bash
  docker exec setup-php php artisan migrate
```

Execute o comando para criar estrutura de documentação Swagger

```bash
  docker exec setup-php php artisan l5-swagger:generate
```

Caso queira acessar o console interativo do Laravel, execute o comando

```bash
  docker exec -it setup-php php artisan tinker
```

Em sequida execute o comando para conferir as configurações do Mysql

```bash
  DB::connection()->getPdo();
```

Em sequida execute o comando para conferir as migrations que foram executadas recentemente

```bash
  DB::table('migrations')->get();
```

Rode o comando para efetuar os testes TDD (phpunit)

```bash
  docker exec setup-php ./vendor/bin/phpunit
```

## 🔗 Acessos


Para acessar o Frontend (Angular)
```bash
http://localhost:4200
```

Para acessar o Backend (Laravel)
```bash
http://localhost:8080
```

Para acessar o Swagger (documentação da API)
```bash
http://localhost:8080/api/documentation
```

Para acessar o PhpMyadmin
```bash
http://localhost:8888

Usuário: user
Senha: password
```

## 🔗 Meus contatos:

[![Linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white&style=flat)](https://www.linkedin.com/in/nydson-rodriguez)
[![Gmail](https://img.shields.io/badge/Gmail-D14836?style=for-the-badge&logo=gmail&logoColor=white&style=flat)](mailto=nydson@gmail.com)
[![WhatsApp](https://img.shields.io/badge/WhatsApp-25D366?logo=whatsapp&logoColor=fff&style=flat)](https://wa.me/+5561999477279?text=)
[![Instagram](https://img.shields.io/badge/Instagram-E4405F?style=for-the-badge&logo=instagram&logoColor=white&style=flat)](https://www.instagram.com/nydson.rodriguez)
[![Devto](https://img.shields.io/badge/dev.to-0A0A0A?style=for-the-badge&logo=devdotto&logoColor=white&style=flat)](https://dev.to/nydson-rodriguez)
