<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Laravel 11.x, Vue 3.x, Docker
### Proyecto creado con Laravel 11.x, Vue 3.x, Vite, Bootstrap.

## Descripción

Contiene las configuraciones iniciales para que puedas empezar tu aplicación dejando todo listo en minutos.

Estas instrucciones están realizadas para ser seguidas desde windows, no se ha probado desde Linux ni Mac.

## Requisitos

- Sistema operativo Windows
- Tener Instalado PHP <a href="https://www.youtube.com/watch?v=3tnb9FuWfpU&ab_channel=Stian"> Video como instalar PHP acá</a>
- Tener Instalado Docker Desktop
- Tener Instalado WSL
- Tener Instalado Node  <a href="https://www.youtube.com/watch?v=29mihvA_zEA&t=1s&ab_channel=CarlosMasterWeb">Video como instalar Node acá</a>
- Tener Instalado Composer  <a href="https://www.youtube.com/watch?v=0mcC0kMCJkQ&ab_channel=CarlosMasterWeb">Video como instalar Composer acá</a>
- Tener Instalado MySQL Workbench <a href="https://www.youtube.com/watch?v=_K2nOYwOq1E&t=103s&ab_channel=ElRinc%C3%B3ndelHacker">Video como instalar MySQL Workbench acá</a>
- Tener instalado Git

Clonar proyecto

    git clone https://github.com/apf-developer/mantenedor-usuarios.git

Ingresa a la carpeta mantenedor-usuarios

    cd mantenedor-usuarios
    code .

Ingresa a la carpeta api-backend

    cd api-backend

Copia archivo .env

    cp .env.example .env

Reemplaza en el .env recien creado estas variables

    DB_DATABASE=api_db
    DB_USERNAME=root
    DB_PASSWORD=

Instala dependencias con Composer

    composer install
    
Crea llave de la aplicación

    php artisan key:generate

Ejecuta ejecuta Docker

    docker-compose up

En otra terminal entra al contenedor api

    docker ps
    docker exec -it <ID contenedor> bash

Ejecuta las migraciones y la semilla

    php artisan migrate
    php artisan db:seed --class=UserSeeder
    exit

Finalmente <a href="http://localhost" >Abre localhost</a>
