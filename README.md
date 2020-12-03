# mini-ecommerce
mini-ecommerce test HHISELECTION

## Install
Copie la carpeta del proyecto en el document root de su server y ejecute el comando `composer install` 

Configure el virtual host para que la ruta apunte directamente a la carpeta public del proyecto:

Ejemplo de vhost:
```
<VirtualHost *:80>
    ServerName miniecommerce.local
    DocumentRoot /srv/www/htdocs/mini_ecommerce/public/
    <Directory "/srv/www/htdocs/mini_ecommerce/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        <IfModule mod_rewrite.c>
                RewriteEngine On
                RewriteCond %{REQUEST_FILENAME} !-d
                RewriteCond %{REQUEST_FILENAME} !-f
                RewriteRule ^(.+)$ index.php/$1
        </IfModule>
    </Directory>
</VirtualHost>
```

Ejemplo de etc/hosts
```
127.0.0.1       miniecommerce.local
```

debe crear una base de datos y configurar el nombre en el archivo `.env` con todos los datos de conexión a la base de datos así:

```
DATABASE_HOST=localhost
DATABASE_DBNAME=mini_ecommerce
DATABASE_USER=johnk
DATABASE_PASSWORD=
DATABASE_PORT=3306
```

Luego debe ejecutar las migraciones 

## Migrations
Para la creación de nuevos objetos de base de datos (DDL) y migraciones se debe crear en la carpeta `database/migrations` y para hacer cambios en la data se deben crear seeds en la carpeta `database/seeds` adicionalmente es importante tener en cuenta el orden de ejecución de los archivos de acuerdo al nombre del archivo.

Un ejemplo de migration `1-cities.sql` :
```sql
create table cities (
	id integer not null auto_increment  primary key,
	name varchar(50) not null,
	unique(name)
)
ENGINE=InnoDB;
```


Cada vez que se ejecute una migración correctamente la versión de la base de datos será actualizada en el archivo `database/versions.txt` 

Para correr las migraciones debe usar el comando de makefile 
```shell
make migrate-up
```

## Environments Vars
Las variables de entorno se registran en el archivo `.env`, puede encontrar un ejemplo en `dev.env`:

```
DATABASE_HOST=localhost
DATABASE_DBNAME=mini_ecommerce
```

Dentro del código se pueden llamar usando la variable global `$_ENV` así:
```php
<?php
$_ENV["DATABASE_DBNAME"];
```

## MVC
El core de la aplicación lo encuentra en la carpeta app pero el entrypoint de la app está en la carpeta public

### Structure
```
mini_ecommerce 
				-> app
					-> Controllers
						-> Controller.php
					-> Models
						-> Model.php
					-> Views
				-> public
					->index.php
```

#### Routing
El enrutamiento se realiza desde la url partiendo desde la url de la carpeta o la definida por un virtual host (ejemplo `http://miniecommerce.local/`) luego se indicará el controller y el action así:

```
http://miniecommerce.local/home/index/{... parámetros}
```

La parte de la url `home` realizará un llamado al archivo `app/Controllers/HomeController.php` y la parte `index` invocará el método `indexAction` del controlador indicado.

#### Controller y Action
Todos los nuevos controllers deben ir en la carpeta `app/Controller` y deben llevar el sufijo Controller, adicionalmente deben extender de la clase `Controller`.

```php
<?php

namespace Controller;

class HomeController extends Controller{
	public function indexAction($params = []){
		return $this->renderHtml("home/index", $params);
	}
}
``` 

#### Models
Todos los nuevos Models deben ir en la carpeta `app/Models` y extender de la clase `Model`, se recomienda agregar el sufijo Model aunque no es obligatorio. Los models funcionan con PDO por lo que se deben usar los métodos `query` y `exec`

```php
<?php 

namespace Model;

class CityModel extends Model{

	const TABLE = "cities";

	public function all(){
		$sql = 'SELECT * FROM '.self::TABLE.' ORDER BY id';
		foreach ($this->db->query($sql) as $row) {
		    yield $row;
		}
	}

}
```

#### Views
Las vistas se almacenan en la carpeta `app/Views`, son archivos php simples y pueden ni deben ser clases, estas vistas serán renderizadas por el método `renderHtml` de los controllers adicionalmente se puede implementar un retorno en formato JSON llamando el método `renderJson` del controller.

Todas las vistas renderizadas con `renderHtml` icluiran el header y el footer de la carpeta `app/Views/layout`, se recomienda crear una carpeta de views para cada controller


## Public

Es el entrypoint de la app y en esa carpeta se deben almacenar todos los archivos estáticos que requiera (assets, imagenes, js, css, etc)