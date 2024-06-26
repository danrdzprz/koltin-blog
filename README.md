<h1 align="center"> Koltin blog </h1>

## :hammer: Librerías usadas

- `laravel/pint`: PHP code style fixer
- `darkaonline/l5-swagger`: Documentación de la api
- `phpstan`: Análisi estatico
- `laravel/sail`: Uso de contenedores
- `laravel/Purifier`: Limpia los campos para los comentarios y los posts
- `bootstrap`: Para las vistas
- `laravel-google-sheets`: Para exportar a google sheets

## Comandos

```bash
# ejecutar phpstan
$ ./vendor/bin/sail composer phpstan 

# exportar comentarios
$ ./vendor/bin/sail artisan export:comments

# levantar contenedores
$ ./vendor/bin/sail up -d

# bajar contenedores
$ ./vendor/bin/sail down
```

## Requisitos

- `Docker`

## Instalación

* Clonar repositorio
* Copiar .env.example como .env
* Modificar variables de entorno
* Para el atributo GOOGLE_SERVICE_ACCOUNT_JSON_LOCATION= debemos configurar Google Service Account
* Para configurar Google Service Account seguí este tutorial => https://stackoverflow.com/questions/70938696/google-sheet-to-laravel-8-integration
* instalar dependencias => docker run --rm -v $(pwd):/opt -w /opt laravelsail/php81-composer:latest composer install
* En directorio raiz ejecutar => ./vendor/bin/sail up -d
* Correr migraciones => ./vendor/bin/sail artisan migrate
* Generar Appplication key => ./vendor/bin/sail artisan key:generate
* Entrar al contenedor con ./vendor/bin/sail root-shell
* dentro del contenedor ejecutar el comando => npm install y después npm run build

## URL de swagger
* http://localhost/api/documentation

## URL de temporal del proyecto
http://test.devone.tech/

## Notas
En esta prueba me decidí por el patrón repositorio para la reutilización de código.
Ya que tenemos una parte de api, un comando y la parte visual. Para esta última decidí usar bootstrap y blade. Me hubiera gustado usar vue o ajax para que fuera más dinámica la página.
He tenido problemas usando usar phpstan y sobre todo swagger.
Creo que estoy más acostumbrado a usar postman para la documentación de la api.
Por tiempo tampoco pude hacer muchas pruebas, pero he validado todo. Incluso el comando para exportar. Gracias por leerme.
