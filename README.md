# SIMPLES APLICACAO DE USUARIO


## Especificações Técnicas

Esta aplicação conta com as seguintes especificações abaixo: 

| Ferramenta | Versão |
| --- | --- |
| Docker | 24.0.7, |
| Docker Compose | 1.29.2 |
| Nginx | 1.19.10 |
| PHP | 8.3.9 |
| Mariabd | 10.11.3 |
| Redis | 5.0.0 |
| Sqlite (Testes de unidade) | 3.16.2 |
| Laravel Framework | 11.14.* |

A aplicação é separada pelos seguintes conteineres

| Service | Image |
| --- | --- |
| mysql | mariadb:latest |
| redis | redis:alpine |
| php | php-sample |
| php-worker | php-sample-worker-queue |
| web (nginx) | nginx:alpine |

## Requisitos
    - Docker
    - Docker Daemon (Service)
    - Docker Compose

## Procedimentos de Instalação
    Procedimentos de Instação da aplicação para uso local

1- Baixar repositório 
    - git clone https://github.com/brunocaramelo/sample_user_app_spa.git
       
        devemos copiar .env.docker-compose para .env com o comando abaixo:

        - cp .env.docker-compose .env

2 - Verificar se as portas:

    - 443 (nginx) 
    
    - 9000(php-fpm)

    - 3306(mysql) 

    - 6380(redis) 
     estão ocupadas.


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

- usuario criado no seed:
    - email: admin@test.com
    - senha: password


## Detalhes

    - Vue 3

    - Laravel 11

    - Sanctum

    - SOLID

    - Unit Tests

    - Docker e docker-compose
