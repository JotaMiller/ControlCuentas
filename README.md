Control de Cuentas
========================

Sistema de Control de Cuentas Personales


Pre-requisitos
--------------
Composer [Descarga](https://getcomposer.org/download/)

Git [Descarga](http://git-scm.com/downloads)


Instalación
---------------

1. [Bajar la última version](https://github.com/HenuXmail/ControlCuentas/archive/master.zip) de Control de Cuentas ( Dejarla en el servidor o localhost dentro de www)

2. Asumiento que [Composer](https://getcomposer.org/) se encuentra instalado, ingresar a la consola de **git bash** e ir a la carpeta del proyecto:

3. Ejecutar el siguiente comando para actualizar los _vendors_ que se utilizan dentro de la aplicación:
~~~
composer update
~~~
   
>Tener paciencia ya que se demora al cargar TODAS las dependencias del sistema... y estar atentos a los mensajes que nos indica la consola, ya que al final, nos pedira una serie de datos, como la información de la base de datos.
   
>PD: no es importante que la Base de datos _exista_ ya que Symfony2 la puede crear por ti :)

4) una vez terminado el proceso, se procede a Crear la base de datos (en caso que no exista)
~~~
php app/console doctrine:database:create
~~~
>esto nos creara la base de datos con el nombre que ingresamos en el paso anterior

5) Crear el schema _tablas_
~~~
php app/console doctrine:schema:update --force
~~~ 
5) Cargar los datos de prueba _Data Fixtures_
~~~
php app/console doctrine:fixtures:load
~~~ 
> Nos creara un usuario Administrador que tiene acceso al sistema:

> __Usuario__: admin / __contraseña__: password

6) Listo!

Ahora pueden ingresar desde el navegador

__Producción__: localhost/control/web/app.php/app   
__Desarrollo__: localhost/control/web/app_dev.php/app



PD: la app como "tal" esta siendo desarrollada como un Bundle de Symfony, y bajo el directorio "app".
   