## DOCUMENTACION

📌1-Instrucciones de instalación y configuración <br>
📌2-Explicación de la estructura del código <br>
📌3-Breve manual de uso <br>
📌4-Información sobre el servidor web y entornos usados

Proyecto desarrollado en Laravel 10 con Bootstrap 4 y AdminLTE 3, utilizando AJAX para gestión de usuarios y proyectos, FullCalendar para tareas y DomPDF para generación de informes.

## 📌 Requisitos

- PHP 8 o superior
- Composer
- MySQL / MariaDB
- Node.js y NPM

## 1-Instrucciones de instalación y configuración

1. Clonar el repositorio:<br>
   ```git clone https://github.com/tu-usuario/prueba-simj.git``` <br>
   ```cd prueba-simj```
2. Instalar dependencias:<br>
	```composer install``` <br>
	```npm install```
3. Configurar entorno:<br>
	```cp .env.example .env```
4. Generar clave y ejecutar migraciones:<br>
	```php artisan key:generate``` <br>
	```php artisan migrate```
5. Compilar assets:<br>
	```npm run dev```
6. Iniciar el servidor:<br>
	```php artisan serve```

## 2-Explicación de la estructura del código

- app/Http/Controllers → Controladores de usuarios, proyectos, tareas y informes.
- app/Models → Modelos de base de datos.
- database/migrations → Migraciones de la base de datos.
- resources/views → Vistas Blade con AdminLTE.
- public/ → Archivos estáticos de AdminLTE y FullCalendar.

## 3-Breve manual de uso

- Registrarse en el sistema.
- Autenticarse en el sistema.
- Crear proyectos y asignarles tareas arrastrándolos al calendario.
- Generar informes en PDF desde la sección de reportes.

## 4-Información sobre el servidor web y entornos usados

- Servidor Web: Apache con Laravel en XAMPP..
- Base de Datos: MySQL.
- Framework: Laravel 12.
- Frontend: Bootstrap, AdminLTE, FullCalendar.

