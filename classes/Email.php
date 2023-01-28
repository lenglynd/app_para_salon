<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

public $email;
public $nombre;
public $token;



    public function __construct($email, $nombre, $token){

        $this->email=$email;
        $this->nombre=$nombre;
        $this->token=$token;

    }

    public function enviarConfirmacion(){
        $mail=new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'dda8619865af28';
        $mail->Password = '040927446718dc';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com','AppSalon.com');
        $mail->Subject='Confirma tu cuenta';
        $mail->isHTML(true);
        $mail->CharSet="UTF-8";
        $contenido="<html>";
        $contenido.="<p><strong>Hola ".$this->nombre."</strong> Has creado tu cuenta en AppSalon, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido.="<p>Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token=".$this->token."'>Confirmar cuenta</a></p>";
        $contenido.="<p>Si tu no solicistaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido.="</html>";

        $mail->Body=$contenido;

        $mail->send();
    }
    
    public function enviarInstrucciones(){
        $mail=new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'dda8619865af28';
        $mail->Password = '040927446718dc';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com','AppSalon.com');
        $mail->Subject='Reestablecer password';
        $mail->isHTML(true);
        $mail->CharSet="UTF-8";
        $contenido="<html>";
        $contenido.="<p><strong>Hola ".$this->nombre."</strong> Has solicitado reestablecer tu clave de acceso, sigue el enlace para el cambio</p>";
        $contenido.="<p>Presiona aquí: <a href='http://localhost:3000/recuperar?token=".$this->token."'>Reestablecer clave</a></p>";
        $contenido.="<p>Si tu no solicistaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido.="</html>";

        $mail->Body=$contenido;

        $mail->send();
    }

    
}

?>
