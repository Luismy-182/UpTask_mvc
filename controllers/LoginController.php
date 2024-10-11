<?php 
namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;

class LoginController{
    public static function login(Router $router){
        $alertas=[];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $usuario=new Usuario($_POST);
            $alertas=$usuario->validarLogin();

            if(empty($alertas)){
                //verifica que el usuario exista
                $usuario=Usuario::where('email', $usuario->email);
                
                if(!$usuario || !$usuario->confirmado){
                    Usuario::setAlerta('error', 'EL usuario no existe o no esta confirmado');
                }else{
                    //El usuario existe
                    if (password_verify($_POST['password'], $usuario->password) ){
                        //habilitamos las sessiones
                        session_start();
                        $_SESSION['id']=$usuario->id;
                        $_SESSION['nombre']=$usuario->nombre;
                        $_SESSION['email']=$usuario->email;
                        $_SESSION['login']=true;
                        

                        //redireccionar al panel

                        header('Location: /dashboard');
                    }else{
                        Usuario::setAlerta('error', 'Password Incorrecto');
                    }
                }
            }
        }
        $alertas = Usuario::getAlertas();
        //render a la vista 
        $router->render('auth/login',[
            //variables
            'titulo'=>'Iniciar sessión',
            'alertas'=>$alertas
        ]);
    }

    public static function logout(){
       session_start();
       $_SESSION=[];
       header('Location: /');
    }


    public static function crear(Router $router){

        //INSTANCIAMOS EL OBJETO COMO VACIO
        $alertas=[]; //Ojo hay que poner el arreglo como vacio antes del post o te dara un error cuando cargues por primera vez el post
        $usuario= new Usuario;
        if($_SERVER['REQUEST_METHOD']==='POST'){
            
                $usuario->sincronizar($_POST);
                $alertas = $usuario->validarNuevaCuenta();
                

                if(empty($alertas)){
                    //verifica que exista el usuario, si no, crea el usuario
                    $existeUsuario=Usuario::where('email', $usuario->email);
                    //si tu colocabas de nuevo a Usuario, vamos a rescribir ese objeto, por lo tanto eso esta mal
                    //debemos usar el metodo where que va a buscar con la espera de 2 valores, el campo de la bd y el campo de informacion
                    //que trael el post y los compara


                    if($existeUsuario){
                        //si encontro informacion:
                        Usuario::setAlerta('error', 'El usuario ya existe');
                        $alertas = Usuario::getAlertas();
                    }else{
                        //vamos a crear el usuario

                        //hashear password
                        $usuario->hashPassword();
                        
                        //eliminar password2 
                        unset($usuario->password2);
                        
                        //generar el token 
                        $usuario->CrearToken();

                        
                        //crear nuevo usuario
                       $resultado=$usuario->guardar();


                       //manda email

                       $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    
                       $email->enviarConfirmacion();
                        
                        if ($resultado){
                            header('Location: /mensaje');
                        }

                    }

                }
        }

         //render a la vista 
         $router->render('auth/crear',[
            //variables
            'titulo'=>'Crea tu cuenta en Uptask', //titulo pagina
            'usuario'=>$usuario, //mandamos la variable a la vista para usar sus variables
            'alertas'=>$alertas //mandamos la variable alerta a la vista para usar las alertas y mostrarlas en un foreach
        ]);
    }
    public static function olvide(Router $router){
        $alertas=[];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();
            if(empty($alertas)){

                //busca el usuario
            $usuario=Usuario::where('email', $usuario->email);

            if($usuario && $usuario->confirmado ==="1"){
              
                //lo encontre:

                //generar nuevo token
                $usuario->crearToken();
                
                unset($usuario->password2);
                //actualizar el usuario
                $usuario->guardar();
                //enviar el email

                $email= new Email($usuario->email, $usuario->nombre, $usuario->token);
                $email->enviarInstrucciones();

                //imprimir la alerta
                Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');
            }else{
                Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado');
                
            }
            $alertas = Usuario::getAlertas();
        }
    }

         //render a la vista 
         $router->render('auth/olvide',[
            //variables
            'titulo'=>'Olvide mi password',
            'alertas'=>$alertas
        ]);
    }
    public static function reestablecer(Router $router){
        
        $token = s($_GET['token']);
        $mostrar=true;
        //si no existe el token lo manda a loguin
        if(!$token) header('Location: /');

        //identificar el usuario con este token
        $usuario=Usuario::where('token', $token);

        if(empty($usuario)){
            Usuario::setAlerta('error', 'Token no valido');
            $mostrar=false;
        }


        if($_SERVER['REQUEST_METHOD']==='POST'){
            //añadimos el nuevo password

            $usuario->sincronizar($_POST);

            //validamos el password
            $alertas=$usuario->validarPassword();

            if(empty($alertas)){
                //hashear nuevo password
                $usuario->hashPassword();

                //elimina password2
                unset($usuario->password2);

                //eliminar token
                $usuario->token =null;

                //guardar usuario

               $resultado=$usuario->guardar();


                //redireccionar

                if($resultado){
                    header('Location: /');
                }
            }
        }

        $alertas= Usuario::getAlertas();
        //render a la vista
        $router->render('auth/reestablecer',[
            'titulo'=>'Reestablece tu password',
            'alertas'=>$alertas,
            'mostrar'=>$mostrar
        ]);

    }
    public static function mensaje(Router $router){
        $router->render('auth/mensaje',[
            'titulo'=>'Envio de instrucciones'
        ]);

        }
    
    public static function confirmar(Router $router){
        $alertas=[]; //inicializamos para que no nos de error
        $token=s($_GET['token']); //espera un token por el metodo get
        if(!$token) header('Location: /'); //si no hay token redirecciona a login
        
        //encuentra el usuario con este token
        $usuario=Usuario::where('token', $token);

        

        if(empty($usuario)){
            Usuario::setAlerta('error', 'Token No Valido');
        }else{
            //confirmar la cuenta
            //setteamos
            $usuario->confirmado=1;
            $usuario->token=null;
            //eliminamos
            unset($usuario->password2);

            //guardamos todos los ajustes en la BD
            $usuario->guardar();

            Usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente');
        }
        $alertas=Usuario::getAlertas();

        $router->render('auth/confirmar',[
            'titulo'=>'Confirma tu cuenta en UpTask',
            'alertas'=>$alertas
        ]);

        }

}
?>
