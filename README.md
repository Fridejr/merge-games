<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</a></p>

## Merge Games

Videojuego creado como trabajo de fin de grado por Antonio Toro Romero.


## Instalación

1. **Clona el Repositorio:**
    ```bash
    git clone https://github.com/Fridejr/tfg.git

2. **Instala Dependencias:**
    ```bash
    composer install
    npm install

3. **Configura el Entorno:**
    - Copia el archivo `.env.example` y renómbralo a `.env`.
    - Configura la base de datos y otros detalles en el archivo `.env`.

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