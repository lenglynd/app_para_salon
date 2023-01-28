<?php
namespace Model;


class Usuario extends ActiveRecord{

    public static $tabla='usuarios';
    public static $columnasDB=['id','nombre','apellido','email','password','telefono','admin','confirmado','token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args=[])
    {
        $this->id=$agrs['id'] ?? null; 
        $this->nombre=$agrs['nombre'] ?? '';
        $this->apellido=$agrs['apellido'] ?? '';
        $this->email=$agrs['email'] ?? '';
        $this->password=$agrs['password'] ?? '';
        $this->telefono=$agrs['telefono'] ?? '';
        $this->admin=$agrs['admin'] ?? 0;
        $this->confirmado=$agrs['confirmado'] ?? 0;
        $this->token=$agrs['token'] ?? '';
    }

    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][]='El nombre es obligatorio';
        }
        if(!$this->apellido){
            self::$alertas['error'][]='El apellido es obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][]='El email es obligatorio';
        }
        if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',$this->email)){
            self::$alertas['error'][]="añade un correo como: ejemplo@ejemplo.com";
        }
        if(!$this->password){
            self::$alertas['error'][]='El password es obligatorio';
        }
        if(!preg_match('/[_a-z0-9-]{6,12}/',$this->password)){
            self::$alertas['error'][]="Añade una clave alfanumetica entre 6 a 12 caracteres";
        }
        if(!$this->telefono){
            self::$alertas['error'][]='El telefono es obligatorio';
        }
        if(!preg_match('/[0-9]{9}/',$this->telefono)){
            self::$alertas['error'][]="Añade telefono valido 612345678";
        }

        return self::$alertas;
    }
    public function validarLogin()
    {
        if(!$this->email){{
            self::$alertas['error'][]='El email es obligatorio';
        }}
        if(!$this->password){{
            self::$alertas['error'][]='El password es obligatorio';
        }}

        return self::$alertas;
    }
    public function existeUsuario(){
        $query = "SELECT * FROM ".self::$tabla." WHERE email = '".$this->email."' LIMIT 1";
        $resultado=self::$db->query($query);
        if($resultado->num_rows){
            self::$alertas['error'][]='El usuario ya esta registrado';
        }
        return $resultado;
    }
    public function hashPassword(){
        $this->password=password_hash($this->password,PASSWORD_BCRYPT);
    }
    public function crearToken(){
        $this->token=uniqid();
    }
    public function checkPassAndVeri($password){
        $resultado=password_verify($password,$this->password);
        if(!$resultado || !$this->confirmado){
            self::$alertas['error'][]='Password incorrecto o cuenta no confirmada';
        }else{
            return true;
        }   

    }
    public function checkEmail(){
        if(!$this->email){
            self::$alertas['error'][]='El email es obligatorio';
        } 
        return self::$alertas;
    }

    public function checkPass(){
        if(!$this->password){
            self::$alertas['error'][]='El password es obligatorio';
        }
        if(!preg_match('/[_a-z0-9-]{6,12}/',$this->password)){
            self::$alertas['error'][]="Añade una clave alfanumetica entre 6 a 12 caracteres";
        }
        return self::$alertas;

    }

    
}
 



?>