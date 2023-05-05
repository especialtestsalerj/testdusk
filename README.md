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

### Atualização

```
Executar, para o Ocorrências de produção, os itens (1), (2) e (3), sendo executado pelo usuário www-data. Caso seja executado por outro usuário, favor colocar "sudo -u www-data" antes de todos os comandos.

------------------------------------

(1) Executar o comando a partir da pasta de produção do DOCIGP para entrar em modo de manutenção

php artisan down

------------------------------------

(2) Atualizar a versão de produção do DOCIGP. Executar os comandos

Após o 'git pull', rodar os comandos:
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
php artisan migrate --force
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

Dar permissionamento de owner para a pasta e todos os arquivos internos (Exemplo: sudo chown -R www-data:www-data docigp/)

------------------------------------

(3) Executar o comando a partir da pasta de produção do DOCIGP para sair do modo de manutenção

php artisan up
```

### Documentação

- Termo de abertura (https://alerj.sharepoint.com/:w:/s/arquivos/ET_KbA0R6ZFJhjQGnG_TFt8Br4qaORM89VIa6F743MhUBQ?e=rKxy3h)
- Ata de reunião 07/04/2022 (https://alerj.sharepoint.com/:w:/s/arquivos/ESw5td6F4AtBjnMWhxL76qoBAaIxpltbp5TtZHRSFM54MQ?e=x2afYM)
- Ata de reunião 03/05/2022 (https://alerj.sharepoint.com/:w:/s/arquivos/EWEkYHjL9jFKu6mcvway5AEBm9Lq6O2K5w8OJbmaUSWm8Q?e=02cccI)
- Ata de reunião 05/10/2022 (https://alerj.sharepoint.com/:w:/s/arquivos/EbEHMUds1hFKuL7Q3YtIwoEBDv54yb0ufrKg5AvQDHFd8g?e=76AfAx)
- Ata de reunião 14/12/2022 (https://alerj.sharepoint.com/:w:/s/arquivos/EbEHMUds1hFKuL7Q3YtIwoEBDv54yb0ufrKg5AvQDHFd8g?e=76AfAx)
- Ata de reunião 08/02/2023 (https://alerj.sharepoint.com/:w:/s/arquivos/ERF8WHTIH2NHq7mSkU0JxgcBIeZY10rO16g6Tpsmrjwb0A?e=naAURp)
- Ata de reunião 03/05/2023 (https://alerj.sharepoint.com/:w:/s/arquivos/Eeq1VSIwDr1DiVRLwTXZiqYB2rRHJCUpZxLpjNs45lRTQg?e=4FJCiP)
- Diagrama de classe Laravel (https://alerj.sharepoint.com/:b:/s/arquivos/ERBxip1lKVdMkJTKtkT9TWQBUOQPRTizWCuwd5gb0IsWVg?e=hvUQuZ)
- Diagrama de classe Português (https://alerj.sharepoint.com/:b:/s/arquivos/EXy8Vp7yhqlKryVgW_59ltMBFoh88wK8quEYAyieUrOj3A?e=Vj2bY9)
