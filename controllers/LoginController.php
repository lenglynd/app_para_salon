<?php
namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{

    public static function login(Router $router) {
      $alertas=[];
      $_GET['regreso']=null;
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $auth=new Usuario($_POST);
            $auth->sincronizar($_POST);
            $alertas=$auth->validarLogin();
            if(empty($alertas)){
                $usuario=Usuario::where('email',$auth->email);
                if($usuario){
                    if($usuario->checkPassAndVeri($auth->password)){
                        session_start();
                        $_SESSION['id']=$usuario->id;
                        $_SESSION['nombre']=$usuario->nombre." ".$usuario->apellido;
                        $_SESSION['email']=$usuario->email;
                        $_SESSION['login']=true;
                         
                        if($usuario->admin==='1'){
                            $_SESSION['admin']=$usuario->admin ?? null;
                            header('Location:/admin');
                        }else{
                            header('Location:/cita');
                        }
                    }
                }else{
                    Usuario::setAlerta('error','usuario no encontrado');
                }
            }

        }
   
        if(s($_GET['regreso'])==='1'){
        Usuario::setAlerta('exito','Clave reestablecida correctamente');
        $alertas=Usuario::getAlertas();
        }
        $router->render('auth/login',[
            'alertas'=>$alertas
        ]);
    } 
    public static function logout() {
        session_start();
        $_SESSION=[];
        header('Location:/');


    } 
    public static function olvide(Router $router) {
        $alertas=[];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $auth=new Usuario($_POST);
            $auth->sincronizar($_POST);
            $alertas=$auth->checkEmail();
            
            if(empty($alertas)){
                $usuario=Usuario::where('email',$auth->email);
                
                if($usuario && $usuario->confirmado==='1'){
                    $usuario->crearToken();
                    $usuario->guardar();
                    $mail=new Email($usuario->email,$usuario->nombre ,$usuario->token);
                    $mail->enviarInstrucciones();
                    Usuario::setAlerta('exito','Revisa tu email');
                }else{
                    Usuario::setAlerta('error','El usuario no existe o no esta confirmado');
                    $alertas=Usuario::getAlertas();
                }
            }
        }
        $alertas=Usuario::getAlertas();
        $router->render('auth/olvide-password',[
            'alertas'=>$alertas
        ]);

    } 
    public static function recuperar(Router $router) {
        $alertas=[];
        $error=false;
        $token=s($_GET['token']);
        $usuario=Usuario::where('token',$token);
        if(empty($usuario)){
            Usuario::setAlerta('error','El token no es válido');  
            $error=true;
        }
        if($_SERVER['REQUEST_METHOD']==='POST'){
             $password=new Usuario($_POST);
             $password->sincronizar($_POST);
             $password->checkPass();
             if(empty($alertas)){
                $usuario->password=null;
                $usuario->password=$password->password;
                $usuario->hashPassword();
                $usuario->token=null;
                $resultado=$usuario->guardar();
                
                if($resultado){
                    
                    header('Location:/?regreso=1');
                }
             }
        }
        $alertas=Usuario::getAlertas();
        $router->render('auth/recuperar-password',[
            'alertas'=>$alertas,
            'error'=>$error
        ]);
    } 
    public static function crear(Router $router) {
        $usuario=new Usuario;
        $alertas=[];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $usuario->sincronizar($_POST);
            $alertas=$usuario->validarNuevaCuenta();
            if(empty($alertas)){
               $resultado=$usuario->existeUsuario();
               if($resultado->num_rows){
                $alertas=Usuario::getAlertas();
            }else{
                $usuario->hashPassword();
                $usuario->crearToken();
                $email= new Email(
                    $usuario->email,
                    $usuario->nombre,
                    $usuario->token
                );
                $email->enviarConfirmacion();
                
                $resultado=$usuario->guardar();

                if($resultado){
                   header('Location:/mensaje') ;
                }
            } 

            }
        }
        $router->render('auth/crear-cuenta',[
            'usuario'=>$usuario,
            'alertas'=>$alertas
        ]);

    } 
    public static function mensaje(Router $router) {

        $router->render('auth/mensaje');
        
    }
    
    public static function confirmar(Router $router) {
        $alertas=[];
        $token=s($_GET['token']);
        $usuario=Usuario::where('token',$token);
        
        if(empty($usuario)){
             Usuario::setAlerta('error','Token no válido');
        }else{
            $usuario->confirmado="1";
            $usuario->token=null;
            $usuario->guardar();
            Usuario::setAlerta('exito','Cuenta confirmada correctamente'); 
        }
        $alertas=Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta',[
            'alertas'=>$alertas
        ]);
    }
    
}


?>