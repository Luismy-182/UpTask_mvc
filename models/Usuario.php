<?php 
namespace Model;

use Model\ActiveRecord;


class Usuario extends ActiveRecord{

    protected static $tabla = 'usuarios';
    protected static $columnasDB=['id', 'nombre', 'email', 'password', 'token', 'confirmado'];

    public function __construct($args=[])
    {
        $this->id=$args['id'] ?? null;
        $this->nombre=$args['nombre'] ?? '';
        $this->email=$args['email'] ?? '';
        $this->password=$args['password'] ?? '';
        $this->password2=$args['password2'] ?? '';
        $this->password_nuevo=$args['password_nuevo'] ?? '';
        $this->password_actual=$args['password_actual'] ?? '';
        $this->token=$args['token'] ?? '';
        $this->confirmado=$args['confirmado'] ?? 0;
        
    }


    //valida el Login principal
    public function validarLogin(){
        if(!$this->email){
            self::$alertas['error'][]='El email del usuario es obligatorio';
        }

        if(!$this->password){
            self::$alertas['error'][]='El password del usuario no puede estar vacio';
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][]='Email no valido';
        }
        return self:: $alertas;

    }

    //validar cuentas nuevas, osea validaciones
    public function validarNuevaCuenta(){
        
        if(!$this->nombre){
            self::$alertas['error'][]='El nombre de usuario es obligatorio';
        }

        if(!$this->email){
            self::$alertas['error'][]='El email del usuario es obligatorio';
        }

        if(!$this->password){
            self::$alertas['error'][]='El password del usuario no puede estar vacio';
        }

        if(strlen($this->password)<6){
            self::$alertas['error'][]='El password del usuario debe tener al menos 6 caracteres';
        }

        if($this->password !== $this->password2){
            self::$alertas['error'][]='Los passwords no coinciden';
        }
        
        return self:: $alertas;

    }

    public function validarEmail(){
        if(!$this->email){
            self::$alertas['error'][]='El email es obligatorio';
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][]='Email no valido';
        }
        return self:: $alertas;

    }

    public function validarPassword(){

        if(!$this->password){
            self::$alertas['error'][]='El password del usuario no puede estar vacio';
        }

        if(strlen($this->password)<6){
            self::$alertas['error'][]='El password del usuario debe tener al menos 6 caracteres';
        }
        return self:: $alertas;
    }

    public function validar_perfil(){
        if(!$this->nombre){
            self::$alertas['error'][]='El nombre es obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][]='El email es obligatorio';
        }
        return self::$alertas;

    }

    public function nuevo_password(){
        if(!$this->password_actual){
            self::$alertas['error'][]='El password Actual no puede estar vacio';
        }

        if(!$this->password_nuevo){
            self::$alertas['error'][]='El password Nuevo no puede estar vacio';
        }

        if(strlen($this->password_nuevo)<6){
            self::$alertas['error'][]='El password del usuario debe tener al menos 6 caracteres';
        }
        return self:: $alertas;
    }

    public function comprobar_password(){
            return password_verify($this->password_actual, $this->password);
    }

    //hashear password
    public function hashPassword(){
        $this ->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    //generar un token 
    public function crearToken(){
        $this->token=uniqid();
    }


    
}

?>