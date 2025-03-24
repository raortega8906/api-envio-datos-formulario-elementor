<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## API Test - Formularios Elementor

Esta API permite probar formularios enviados desde Elementor, proporcionando endpoints para recibir, validar y almacenar los datos de los formularios enviados desde un sitio web construido con WordPress y Elementor. La API es sencilla solo para el uso de pruebas.

## Características

- Recepción de formularios en formato JSON
- Validación y sanitización de datos
- Almacenamiento en base de datos
- Integración con Laravel para facilitar la gestión
- Respuesta en formato JSON con estado y mensaje

## Endpoints

- Listar formularios

`GET /api/forms`

Retorna una lista de todos los formularios almacenados.

- Enviar formulario

`POST /api/receive-form`

Recibe los datos del formulario en formato JSON y los almacena en la base de datos.

## Instalación

1. Clonar el repositorio
2. Instalar dependencias con `composer install`
3. Crear la base de datos y migraciones con `php artisan migrate`
4. Ejecutar el servidor de desarrollo con `php artisan serve`
5. Acceder a la API en `http://localhost:8000/api`