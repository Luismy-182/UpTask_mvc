<?php 

namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Model\Proyecto;

class DashboardController{
    public static function index(Router $router){

        session_start();
        //verificamos que este logueado con el siguiente metodo,
        isAuth();
        $id=$_SESSION['id'];
        $proyectos=Proyecto::belongsTo('propietarioId', $id);
        
        $router->render('dashboard/index', [
            'titulo'=>'Proyectos',
            'proyectos'=>$proyectos
            
        ]);
    }

    public static function proyecto(Router $router){
        session_start();
        isAuth();
        $token=$_GET['id'];
        //primera medida de seg, si no tiene un token la url lo manda al index de proyectos
        if(!$token) header('Location:/dashbord');
        //Revisar que la persona que visita el proyecto es quien lo creo
        //con un sql find, busca que la url se igual a la que esta en la bd, si la encuentra trae todos los datos del usuario a la memoria
        $proyecto=Proyecto::where('url', $token);
        //segunda medoda de seguridad
        //si el proyecto en el campo id 'foraneo del USuario id' es diferente al id del usuario actual entonces lo saca de la url
        #y lo manda al index de proyectos
        if($proyecto->propietarioId !== $_SESSION['id']){
            header('Location: /dashboard');
        }

        $router->render('dashboard/proyecto', [
            'titulo'=>$proyecto->proyecto

        ]);

    }

    public static function crear_proyecto(Router $router){

        session_start();
        $alertas=[];
        
        if($_SERVER['REQUEST_METHOD']==='POST'){
        $proyecto= new Proyecto($_POST);
        $alertas=$proyecto->validarProyecto();


        if(empty($alertas)){
            //completar los campos que flatan y guardar info
            //generar una url unica
            $hash=md5(uniqid());
            $proyecto->url=$hash;

            //almacenar el creador del proyecto //propietarioId foraneo
            $proyecto->propietarioId=$_SESSION['id'];


            //guardar
            $proyecto->guardar();
            

            //redireccionar
            //Ojo si no redirecciona bien a pesar de tener el Router correctamente, entoces el header
            //estara mandando a una direccion que quisa nada que ver con el index de router

            header('Location:/proyecto?id='.$proyecto->url);
        }
        
        }




        //verificamos que este logueado con el siguiente metodo,
        isAuth();
        $router->render('dashboard/crear-proyecto', [
            'titulo'=>'Crear proyecto',
            'alertas'=>$alertas
            
        ]);
    }



    public static function perfil(Router $router){

        session_start();
        $usuario= Usuario::find($_SESSION['id']);

        //verificamos que este logueado con el siguiente metodo,
        isAuth();
        $alertas=[];
        
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validar_perfil();

            if(empty ($alertas)){

                $existeUsuario = Usuario::where('email', $usuario->email);

                if ($existeUsuario && $existeUsuario->id !== $usuario->id) {
                    Usuario::setAlerta('error', 'Email no valido, ya se encuentra asociado a otro usuario');
                    $alertas = $usuario->getAlertas();
                }else{

                     //guardando al usuario
                $usuario->guardar();
                Usuario::setAlerta('exito', 'Gurdado Correctamente');
                $alertas = $usuario->getAlertas();
                $_SESSION['nombre'] = $usuario->nombre;
                }
               

                
            }
        }
        
        $router->render('dashboard/perfil', [
            'titulo'=>'Perfil',
            'usuario'=>$usuario,
            'alertas'=>$alertas
            
        ]);
    }

    public static function cambiar_password(Router $router){
        session_start();
        isAuth();
        $alertas=[];

        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $usuario=Usuario::find($_SESSION['id']);

            //sincronizar con los datos del usuario

            $usuario->sincronizar($_POST);
            $alertas=$usuario->nuevo_password();

            if (empty($alertas)) {
                $resultado = $usuario->comprobar_password();
                
            
                if ($resultado) {
                    # code... asignamos el passoword nuevo
                    $usuario->password = $usuario->password_nuevo;

                    //eliminar propiedades no necesarias
                    unset($usuario->password_actual);
                    unset($usuario->password_nuevo);

                    //hashear el nuevo password
                    $usuario->hashPassword();

                    //guardadndo al password
                    $resultado=$usuario->guardar();

                    if($resultado){
                        Usuario::setAlerta('exito', 'Password Actualizado correctamente');
                    $alertas = $usuario->getAlertas();
                    }

                }else{
                    Usuario::setAlerta('error', 'Password Incorrecto');
                    $alertas = $usuario->getAlertas();
                }
            }
        }

        $router->render('dashboard/cambiar-password', [
            'titulo'=>'Cambiar password',
            'alertas'=>$alertas
        ]);
    }


}
?>