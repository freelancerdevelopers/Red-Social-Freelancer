<p align="center"><img src="https://freelancerdevelopers.com/Recursos/imagen/FreelancerDevelopers.png"></p>

Creador: Luis Rogelio Batres Guarneros
Correo electronico: lbatres@freelancerdevelopers.com
Administrador: freelancerdevelopers.com
Fecha de creación:19-mayo-2020
Version php:  7.2.30
Version MySQL: 10.4.11-MariaDB
Framework: 5.7 <img src="https://camo.githubusercontent.com/5ceadc94fd40688144b193fd8ece2b805d79ca9b/68747470733a2f2f6c61726176656c2e636f6d2f6173736574732f696d672f636f6d706f6e656e74732f6c6f676f2d6c61726176656c2e737667">
Descripción: Red social cerrada de imagenes.
Licencia: SOFTWARE LIBRE ver descripcion licencia

Notas tecnicas:
** Antes de desplegar el proyecto
Deberas tener instalado Composer
Deberas tener instalado Laravel 5.7
Deberas dar permisos (777) storage



Notas de instalacion:
1.- Ejecutar el archivo (install-bd-base.sql)
2.- El script contiene un INSERT con los datos por defecto del administrador los cuales son (usuario: admin@mail.com, pass: 12121212Qw.)
3.- Modificar el parametro APP_URL (.env)
3.- Modificar el conector de base de datos (.env)
4.- Modificar el conector de smtp (.env)
5.- Modificar el parametro url (public/js/main.js)
6.- Montar el sitio en WWW
7.- Ejecutar desde CMD -> php artisan route:list para enlistar la routes del proyecto