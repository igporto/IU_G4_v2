Proxecto IU Grupo 4 versión 2
======
Repositorio para a volver a facer a ET1 e facer a ET2

Usuarios de proba
======

**Username:** admin

**Password:** admin

**Permissions:** all


Guia de implementación ET2
======

###Mostrar a funcionalidade no menú e INSERTS:


1. Crear o controlador: **Controladores->Engadir**
	    O nome debe coincidir co da entidade e os arquivos (ex.: _'USER'=>'USER_model.php'_).

2. Crear os permisos asociados ó controlador en **Permisos->Engadir**
        Unha vez engadidos ADD, VIEW, SHOW, DELETE, EDIT o *admin* xa debería ter a nova entidade no menú, como a seguinte: 
        
    ![Menu exemplo][guia1]

[guia1]:https://github.com/igporto/IU_G4_v2/blob/master/media/guia/guia1.PNG?raw=true "Menu exemplo"

3. Facer os correspondentes INSERT na DB e pasar un Script a calquera dos Sublíderes/Líderes para que o incluan no install.php
(isto pode facerse unha vez estea funcional a parte de cada un)

***

###Modelos:

######Crear os modelos na carpeta [/model](https://github.com/igporto/IU_G4_v2/tree/master/model)
  - O da entidade: _EXAMPLE.php_
     + Debe ter os atributos necesarios para definir o obxeto **Example**, constructor, getters, setters...
     + Se necesitades comparar obxetos, debedes facer un *toString()* que devolva o campo polo que queredes comparalos como string
  - O Mapper: _EXAMPLE_model.php_
    + Declarades un obxeto **ExampleMapper**, que define todos os métodos necesarios para traballar co obxeto **Example**, por exemplo:
    
      ```php
      function add(Example $example){
      
        //Funcionalidade que inserta $example na taboa ´example´ da base de datos
        
      }
      ```
      
***      
      
###Controladores

######Crear os controladores na carpeta [/controller](https://github.com/igporto/IU_G4_v2/tree/master/controller)
- Todos os controladores herdan de **BaseController**, que define a *$view*, instancia do **ViewManager** que se encarga de almacenar variables, flashes(para notificacións, explicado no seu apartado) e de facer ```render()``` das vistas.

- O ```ìndex.php```, ante unha query pasada por *$_GET*(barra de navegación) tal que ```index.php?controller=example1&action=example2 ``` crea automáticamente un obxeto ```Èxample1``` e executa o método de *action* ```Example1->example2()```, de modo que para executar calquera método dun Controller, soamente hai que mandar a un enlace do tipo  ```index.php?controller=example1&action=example2 ```.

- Hai un controlador por entidade, e cada arquivo controlador *EXAMPLE_controller.php* define un obxeto **ExampleController**, 
  que ten un método por cada acción que o usuario pode facer sobre esa entidade na app, por exemplo:
  + ```php
      
      function add(){
      
        //toda a lóxica para 'pegar' a vista co modelo, e devolver todas as variables necesarias
        //~~~~~~~~~~
        
        //settea o código da string que sairá na notificación
        $this->view->setFlash('cod_string');
        
        //renderiza a vista `example1_view.php` da carpeta `example2`
        $this->view->render('example2','example1');
      }```
  
  ***
  
  ###Vistas
  1. Para cada entidade, teremos as suas vistas na carpeta  [/view](https://github.com/igporto/IU_G4_v2/tree/master/view)/'controlador'/, sendo 'controlador' o nome da entidade.
  2. Na dita carpeta debe haber cando menos 6 arquivos, sendo:
  	- ADD_view.php (engadir)
	- DELETE_view.php (borrar)
	- EDIT_view.php (editar)
	- SEARCH_view.php (buscar)
	- SHOW_view.php (listar)
	- VIEW_view.php (ver en detalle)
	
	Ademáis de calquera outra vista necesaria, como no caso de *User*, que ten a vista [/view/user/LOGIN_view.php](https://github.com/igporto/IU_G4_v2/blob/master/view/user/LOGIN_view.php). Pode utilizarse calquera das outras vistas como modelo, e deben seguir todas a mesma arquitectura visual (apartado puntuable).
  
  ######Renderización
  
	+ Para renderizar unha vista concreta é necesario instanciar o ViewManager: ```php $view = ViewManager::getInstance()```, dado que é unha clase singleton. Isto faise por defecto no BaseController, polo que todos os controladores teñen acceso á variable **$view**.
	
	+ Tendo acceso á instancia do ViewManager, podemos chamar ó método ```php render('controller','action')```, e este mostrará a vista ```/view/'controller'/'view'_view.php```. 
  
  ***
  
   ###Notificacións
   
   O layout [navbar.php](https://github.com/igporto/IU_G4_v2/blob/master/view/layouts/navbar.php#L182) incorpora un mecanismo de renderización de notificacións [AmaranJS](http://www.amaranjs.com/) que depende do código string que reciva como variable flash da **$view**.
   
  
  ######Lanzar unha notificación:
  
  No **Controlador**, despois de facer as comprobacións necesarias, e antes de chamar a ```php $this->view->render()```, podemos facer un ```php $this->view->setFlash('cod_notificacion')```, sendo 'cod_notificacion' o código da string que queremos que mostre a notificación.
  
  ######Tipos de notificación dependendo do código da string (4 primeiros caractéres):
  
  - **Éxito:** String "succ_*algo*".
  
      ![succ_notif][succ_notif]
  
  - **Fallo controlado:** String  "fail_*algo*".
  
  	![fail_notif][fail_notif]
  
  - **Erro de bd, arquivo, etc...**: String "erro_*algo*".
  
  	![erro_notif][erro_notif]
  
  - **Información xenérica**: String "info_*algo*".
  
  	![info_notif][info_notif]
  
  
  [succ_notif]:https://github.com/igporto/IU_G4_v2/blob/master/media/guia/succ_notif.PNG?raw=true "succ_notif"
  [fail_notif]:https://github.com/igporto/IU_G4_v2/blob/master/media/guia/fail_notif.PNG?raw=true "fail_notif"
  [erro_notif]:https://github.com/igporto/IU_G4_v2/blob/master/media/guia/erro_notif.PNG?raw=true "erro_notif"
  [info_notif]:https://github.com/igporto/IU_G4_v2/blob/master/media/guia/info_notif.PNG?raw=true "info_notif"
  
  ***
