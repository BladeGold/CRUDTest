## Pasos para poner en funcionamiento

1) Clonar el Repositorio `git clone https://github.com/BladeGold/CRUDTest.git`

2) Crear en archivo `.env` segun el `.env.example`

3) Instalar las dependencias `composer install`

4) Generar Key `php artisan key:generate`

5) Ejecutar las migraciones y los seed `php artisan migrate --seed`

6) Poner en funcionanmiento el servidor `php artisan serve`
