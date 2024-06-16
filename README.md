<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</a></p>

## Merge Games

Videojuego creado como trabajo de fin de grado por Antonio Toro Romero.


## Requisitos pre-instalación

Yo he usado las siguientes herramientas y versiones
- PHP v8.2.4
- MySQL v8
- Apache 
- composer v2.7.2
- nodejs v20.10.0 (npm v9.8.1)

Es posible que para instalar composer se deba modificar el archivo C:\xampp\php\php.ini y descomentar las siguientes lineas: 
    extension=curl
    extension=fileinfo
    extension=gd
    extension=gettext
    extension=intl
    extension=mbstring
    extension=exif
    extension=mysqli
    extension=pdo_mysql
    extension=pdo_sqlite


## Instalación

1. **Clona el Repositorio:**
    ```bash
    git clone https://github.com/Fridejr/merge-games.git

2. **Instala Dependencias:**
    ```bash
    composer install
    npm install

3. **Configura el Entorno:**
    - Copia el archivo `.env.example` y renómbralo a `.env`.
    - Configura la base de datos y otros detalles en el archivo `.env`.

    Lineas a editar: 
        APP_URL=http://localhost:8000

        DB_CONNECTION=mysql {u otro que prefieras usar}
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE={nombre de la bbdd que desees}
        DB_USERNAME=root{nombre se usuario en caso que se desee}
        DB_PASSWORD=

4. **Genera Clave de Aplicación:**
    ```bash
    php artisan key:generate

5. **Ejecuta Migraciones y Seeders:**
    ```bash
    php artisan migrate --seed

6. **Inicia el Servidor de Desarrollo:**
    ```bash
    php artisan serve && npm run dev

8. **Accede a tu Aplicación:**
   Visita [http://localhost:8000](http://localhost:8000) en tu navegador.




## COMANDO PARA REINSTALACIÓN CON SEED EN LA BBDD
```bash
    php artisan migrate:refresh --seed