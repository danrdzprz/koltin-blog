<h1 align="center"> Koltin blog </h1>

## :hammer: Librerías usadas

- `laravel/pint`: PHP code style fixer
- `darkaonline/l5-swagger`: Documentación de la api
- `phpstan`: Análisi estatico
- `laravel/sail`: Uso de contenedores
- `laravel/Purifier`: Limpia los campos para los comentarios y los posts
- `bootstrap`: Para las vistas

## Comandos

./vendor/bin/sail up -d

./vendor/bin/sail artisan test

./vendor/bin/sail artisan config:cache

./vendor/bin/sail composer phpstan 

./vendor/bin/sail composer pint

## Requisitos

- `docker`

## Instalación

* clonar repositorio
* en directorio raiz ejecutar: ./vendor/bin/sail up -d


## Notas
En esta prueba me decidí por el patrón repositorio para la reutilización de código. 
Me hubiera gustado usar la architectura hexagonal pero por tiempo he decidido no usarla.
Me resulto dificil usar phpstan y sobre todo swagger
Creo que estoy mas acostumbrado a usar postman para la documentacion de la apí.
