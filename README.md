# Editor Odds

## Getting started

Clona el proyecto una vez clonado, entramos en la carpeta desde el terminal y lanzamos el siguiente comando
```docker compose -f "docker-compose.yml" up -d --build ```
una vez lanzado y creados los contenedores de docker lanzamos
```composer install ```
para instalar las dependencias del vendor y autoload

## Collaborate with your team

- [ ] [Crear new branch para trabajar sobre ella]
- [ ] [No subir grandes cambios sin antes avisar]
- [ ] [Avisar una vez realizado el pull para mergear la rama si no tiene conflictos]
- [ ] [Revisar los pipeline]

## Description

- [Editor Odds](http://devodds.besoccer.com/)

**Editor de relación de partidos entre fuentes externas y BD Besoccer** para el estudio probabilístico de apuestas a través del tiempo.

## Fuentes actuales

- [Football Data Files](https://football-data.co.uk/downloadm.php)
- [Goalserve API](https://www.goalserve.com)
- [Enetpulse API](https://enetpulse.com/)

## Funcionalidades

- [ ] Relación de equipos y partidos con las fuentes externas
- [ ] Inserción de las apuestas recogidas en esas fuentes a los partidos relacionados en BD ELO

## Usage
Creaciones de mvc de manera fácil:

**1º -** Necesitamos **crear una ruta**, esta la añadiremos en **```routes.php ```** en **```availableRoutes```**. Y el archivo relacionado en la carpeta routes, con el mismo nombre que hemos utilizado en availableRoutes. Todo esto Se encuentra en la carpeta **```Config```** y su estructura es la siguente. Desde la ruta que se va a acceder:
```
    '/' => array(
        'controller' => DashboardController::class, // nombre del controlador que va a utilizar
        'function' => 'renderHtml', // funcion del controlador 
        'subRole' => 0, // roles de usuario a los que se le va a mostrar
    ),
```
Despues de poner la ruta en el config, si necesitamos **ponerla en el menu lateral** lo hacemos de la siguiente manera. Nos vamos a **```app/helpers/leftSidebarHelper.php```**
la function **```getSidebar```** son las secciones o apartados principales su estructura es la siguiente.
```
    0 => array(
        'icon' => 'fa fa-cog', //icono si tiene subSection no saldrá
        'name' => 'Tools', // nombre que saldrá 
        'url' => '/tools', // ruta a la que accederemos si no tiene subsections
        'subsections' => Self::getToolsSubsection() // puede ternerlo o no, en caso de que 
                                                    //sí se crea una funcion y dentro de un array 
                                                    //se crean las subrutas con la misma estructura quitando este campo
    ),
```

**2º -** **Creamos o reutilizamos un controlador**. Estos se encuentran en **```app/controllers```**.
Ahí podremos crear nuestros propios filtros de la route. 
Es **importante** recalcar que **los controladores son meramente para pasar información de un lado a otro**. Con esto quiero decir que al controlador debe ser el que 
manda información y recibe información, en él se debe **intentar no hacer consultas directas a la base de datos** (<em>hacerlo en</em>```Models```), y **tampoco utilizarlos para dar formato,
procesar información etc**, (<em>para ello estan los</em>```helpers```). Si necesitamos crear helpers o models para el controlador los métodos a los que se llamará desde el controlador deben ser
public static function, si desde el propio helper o model debemos de acceder a otras funciones propias del archivos las pondremos como private function o protected function

**3º -** Una vez llegada la información que necesitamos la enviamos siempre con la misma varisble ```$dataItem``` el cual es un array que lo pasarémos a la vista, de la siguiente manera.
```
    $this->doHtml('dashboard/dashboard',$dataItem);
```
Función de la class controller al la que se le pasa la ruta de la vista desde carpeta ```views```, y el array.

## Cron Football Data
Dentro del proyecto en public -> media folder.

## Support
Tell people where they can go to for help. It can be any combination of an issue tracker, a chat room, an email address, etc.

## Roadmap
If you have ideas for releases in the future, it is a good idea to list them in the README.

## Authors and acknowledgment
Departamento Deepsarrollo

## License
Proyecto privado

## Project status
En desarrollo