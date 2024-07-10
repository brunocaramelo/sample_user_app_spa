# SIMPLES APLICACAO DE USUARIO


## Especificações Técnicas

Esta aplicação conta com as seguintes especificações abaixo: 

| Ferramenta | Versão |
| --- | --- |
| Docker | 1.13.1 |
| Docker Compose | 1.22.0 |
| Nginx | 1.15.2 |
| PHP | 8.3.9 |
| Mariabd | 10.3.8 |
| Redis | 5.0.0 |
| Sqlite | 3.16.2 |
| Laravel Framework | 11.0.* |

A aplicação é separada pelos seguintes conteineres

| Service | Image |
| --- | --- |
| mysql | mariadb:latest |
| redis | redis:alpine |
| php | laravel:php-fpm |
| web (nginx) | nginx:alpine |

## Requisitos
    - Docker
    - Docker Daemon (Service)
    - Docker Compose

## Procedimentos de Instalação
    Procedimentos de Instação da aplicação para uso local

1- Baixar repositório 
    - git clone https://github.com/brunocaramelo/library_api.git
        - renomear .env.docker-compose para .env

2 - Verificar se as portas 443, 8000 e 3306 estão ocupadas.

3 - Entrar no diretório base da aplicação e executar os comandos abaixo:
    
    1 - sudo docker-compose up -d; (LER OBSERVACAO)

    2 - sudo docker exec -t php-sample php /app/artisan migrate;

    3 - sudo docker exec -t php-sample php /app/artisan db:seed;

    4 - sudo docker exec -t php-sample ./vendor/bin/phpunit;

    
### Descrição dos Passos

    1 -  para que as imagens sejam armazenandas e executadas e subir as instancias
        
        (OBSERVACAO) - devido a demora do composer em trazer as dependências, existem 3 alternativas,
        
            1 - EXECUTAR sudo docker-compose up; sem ser daemon a primeira vez, para que seja possivel verificar o andamento da instalação de dependências.
            
            2 - Aguardar uns 20 minutos ou pouco mais para que o comando seja efetivado. afim de evitar de autoload por exemplo.
            
            3 - Caso tenha algum problema de Depencias, executar o comando abaixo para garantir as mesmas.
                sudo docker exec -t php-sample composer install;
    
    2 -  para que o framework gere e aplique o mapeamento para a base de dados (SQL) podendo ser Mysql, PostGres , Oracle , SQL Serve ou SQLITE por exemplo
    
    3 -  para que o framework  aplique mudanças nos dados da base, no caso inserção de um primeiro usuário.
    
    4 -  geração de hash key para uso do sistema como chave de validação.
    
    5 - para que o framework execute a suite de testes.
        - testes de API  
        - testes de unidade
     
### Resolução de possíveis problemas:

#### Problemas com dependências/autoload (Passo 1)
    devido a demora do composer em trazer as dependências, existem 3 alternativas,
        
            1 - EXECUTAR sudo docker-compose up; sem ser daemon a primeira vez, para que seja possivel verificar o andamento da instalação de dependências.
            
            2 - Aguardar uns 20 minutos ou pouco mais para que o comando seja efetivado. afim de evitar erros de autoload por exemplo.
            
            3 - Caso tenha algum problema de Depencias, executar o comando abaixo para garantir as mesmas.
                sudo docker exec -t php-sample composer install;

#### Problemas com permissão do Webserver ao volume exposto (Passo 6)
    - O mesmo pode ter problemas de permissão do Webserver ao volume /var/www/html (ou subdiretórios)
      Mesmo não sendo indicado, mas por ser um ambiente local, pode ser feita a execução forçada de permissões com:
       - sudo docker-compose exec web chmod 777 -R /var/www/html    

## Pós Instalação

Após instalar o endereço de acesso é:

- https://localhost/

