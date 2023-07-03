# Ocorrências - Sistema de Gestão de Ocorrências (DEPS) 

## [https://ocorrencias.alerj.rj.gov.br/](https://ocorrencias.alerj.rj.gov.br/)

## Tecnologias utilizadas

- [Git](https://git-scm.com/docs/user-manual.html)
- [PHP 8.0](http://php.net/)
- [PostgreSQL 14.7](https://www.postgresql.org/)
- [Composer](https://getcomposer.org/)
- [Laravel 9](https://laravel.com/docs/9.x)
- [Bootstrap 5](https://getbootstrap.com/docs/5.0/getting-started/introduction/)
- [Swiper JS](https://swiperjs.com/)
- [Livewire](https://laravel-livewire.com/)

## Histórico
Origem: Protocolo nº 3574/2022

O sistema teve início a partir de um protocolo emitido pelo departamento de segurança, através do servidor Nelson Moreno.

Inicialmente, pensou-se numa solução específica para a cautela de armas, já que o controle em papel dificultava a manutenção do histórico dos visitantes.

A ferramenta evoluiu para uma aplicação mais robusta, onde ocorrências, materiais, visitantes e cautelas, agora podem ser registradas e acessadas de forma ágil e segura.   

## Documentação

### Início do Projeto
- [Termo de abertura](https://alerj.sharepoint.com/:w:/s/arquivos/ET_KbA0R6ZFJhjQGnG_TFt8Br4qaORM89VIa6F743MhUBQ?e=rKxy3h)

### Diagramas
- [Diagrama de classe (atual)](https://alerj.sharepoint.com/:b:/s/arquivos/ERBxip1lKVdMkJTKtkT9TWQBUOQPRTizWCuwd5gb0IsWVg?e=hvUQuZ)
- [Diagrama de classe (original)](https://alerj.sharepoint.com/:b:/s/arquivos/EXy8Vp7yhqlKryVgW_59ltMBFoh88wK8quEYAyieUrOj3A?e=Vj2bY9)

### Atas de Reuniões
- [07/04/2022](https://alerj.sharepoint.com/:w:/s/arquivos/ESw5td6F4AtBjnMWhxL76qoBAaIxpltbp5TtZHRSFM54MQ?e=x2afYM)
- [03/05/2022](https://alerj.sharepoint.com/:w:/s/arquivos/EWEkYHjL9jFKu6mcvway5AEBm9Lq6O2K5w8OJbmaUSWm8Q?e=02cccI)
- [05/10/2022](https://alerj.sharepoint.com/:w:/s/arquivos/EbEHMUds1hFKuL7Q3YtIwoEBDv54yb0ufrKg5AvQDHFd8g?e=76AfAx)
- [14/12/2022](https://alerj.sharepoint.com/:w:/s/arquivos/EbEHMUds1hFKuL7Q3YtIwoEBDv54yb0ufrKg5AvQDHFd8g?e=76AfAx)
- [08/02/2023](https://alerj.sharepoint.com/:w:/s/arquivos/ERF8WHTIH2NHq7mSkU0JxgcBIeZY10rO16g6Tpsmrjwb0A?e=naAURp)
- [03/05/2023](https://alerj.sharepoint.com/:w:/s/arquivos/Eeq1VSIwDr1DiVRLwTXZiqYB2rRHJCUpZxLpjNs45lRTQg?e=4FJCiP)
- [09/05/2023](https://alerj.sharepoint.com/:w:/s/arquivos/ETZkc03iso5NvQGewDx5bOoBxXea4cEFxCZsQJU426z9ug?e=g6TdUO)

## Implantação

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
- Executar o comando `composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev` para instalar todas as dependências da aplicação.
    - Caso estiver no ambiente de desenvolvimento, executar `composer install`
- Executar o comando `php artisan migrate` para criar/atualizar a estrutura de Banco de dados
- Linkar a pasta storage, executando o comando `php artisan storage:link`
- Criar uma chave para a aplicação, executando o comando `php artisan key:generate`

### Acesso ao Sistema

Utilizar o [SGUS](http://intranet/sgus/) para definir os perfis e usuários.

### Atualização

```
Executar, para o Ocorrencias de produção, os itens (1), (2) e (3), sendo executado pelo usuário www-data. Caso seja executado por outro usuário, favor colocar "sudo -u www-data" antes de todos os comandos.

------------------------------------

(1) Executar o comando a partir da pasta de produção do Ocorrencias para entrar em modo de manutenção

php artisan down

------------------------------------

(2) Atualizar a versão de produção do Ocorrencias. Executar os comandos

Após o 'git pull', rodar os comandos:
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
php artisan migrate --force
php artisan horizon:terminate
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

Reiniciar o Horizon

Dar permissionamento de owner para a pasta e todos os arquivos internos (Exemplo: sudo chown -R www-data:www-data ocorrencias/)

------------------------------------

(3) Executar o comando a partir da pasta de produção do Ocorrencias para sair do modo de manutenção

php artisan up
```
