# Ocorrências - Sistema de Gestão de Ocorrências (DEPS) 

## [https://ocorrencias.alerj.rj.gov.br/](https://ocorrencias.alerj.rj.gov.br/)

## Regulamentos (regras de negócio)

- Levantamento de informações junto ao gestor Nelson Moreno a partir de protocolo nº 3574/2022.   

## Características da aplicação

- [Git](https://git-scm.com/docs/user-manual.html)
- [PHP 8.1 ou superior](http://php.net/)
- [Composer](https://getcomposer.org/)
- [PostgreSQL](https://www.postgresql.org/)
- [Pusher](https://pusher.com/)

### Instalação

- Clonar o repositório (branch: staging [homologação] or production [produção])
- Configurar servidor web para apontar para a **`<pasta-aonde-o-site-foi-instalado>`/public**
- Instalar certificado SSL (precisamos que a página seja acessível **via https apenas**)
- Criar o banco do dados.
- Entrar na `<pasta-aonde-o-site-foi-instalado>`
- Configurar o arquivo `.env`
    - Copiar o arquivo `.env.example` para `.env`
    - Configurar todos dados do sistema
    - Alterar a variável `APP_ENV` para o ambiente correto (local, testing, staging, production)
    - Configurar banco de dados
    - Configurar o Pusher (criar uma conta, se necessário)
    - Configurar o serviço de e-mail (Outlook, Mailtrap, ou MAIL_DRIVER=log)
- Executar o comando `composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev` para instalar todas as dependências da aplicação.
    - Caso estiver no ambiente de desenvolvimento, executar `composer install`
- Executar o comando `php artisan migrate` para criar/atualizar a estrutura de Banco de dados
- Linkar a pasta storage, executando o comando `php artisan storage:link`
- Criar uma chave para a aplicação, executando o comando `php artisan key:generate`
- Criar o primeiro usuário administrador
```
php artisan ocorrencias:users:create admin@alerj.rj.gov.br Admin
php artisan ocorrencias:sync:roles
php artisan ocorrencias:role:assign administrator admin@alerj.rj.gov.br
```
- Resetar a senha para o usuário administrador criado
- Criar os usuários restantes e dar suas respectivas permissões através da sessão do usuário administrador

### Documentação

- Termo de abertura (https://alerj.sharepoint.com/:w:/s/arquivos/ET_KbA0R6ZFJhjQGnG_TFt8Br4qaORM89VIa6F743MhUBQ?e=rKxy3h)
- Ata de reunião 07/04/2022 (https://alerj.sharepoint.com/:w:/s/arquivos/ESw5td6F4AtBjnMWhxL76qoBAaIxpltbp5TtZHRSFM54MQ?e=x2afYM)
- Ata de reunião 03/05/2022 (https://alerj.sharepoint.com/:w:/s/arquivos/EWEkYHjL9jFKu6mcvway5AEBm9Lq6O2K5w8OJbmaUSWm8Q?e=02cccI)
- Diagrama de classe Laravel (https://alerj.sharepoint.com/:b:/s/arquivos/ERBxip1lKVdMkJTKtkT9TWQBUOQPRTizWCuwd5gb0IsWVg?e=hvUQuZ)
- Diagrama de classe Português (https://alerj.sharepoint.com/:b:/s/arquivos/EXy8Vp7yhqlKryVgW_59ltMBFoh88wK8quEYAyieUrOj3A?e=Vj2bY9)
