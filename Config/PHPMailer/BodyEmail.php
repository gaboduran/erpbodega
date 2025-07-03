<?php
	
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

	Class BodyEmail extends DB {
		public static function enviarEmail($email){
			$data = [];
			$mail = new PHPMailer(true);
			$html = '<!DOCTYPE html>
						<html lang="es">
						<head>
						<title> CY </title>
						</style>
						</head>
						<link rel="stylesheet" href="styles.css">
						<img src="cid:Logo_CY">
						<body>
						<h2>Solicitud de Registro Negada</h2>
						<p> 
							Te informamos que despues de revisar su Solicitud de Registro, esta ha sido negada por el siguiente motivo:  
						   </p>
						<p> 
										   </p>
						<p> 
							Te invitamos a que actualices tu solicitud en el siguiente Link: 
							<a href="">Actualizar Solicitud </a>
					   </p>
					   <p>
						Equipo CY Colombia.
						</p>
						<div>
						<p style="color: grey; font-size: 10px;">
						Este correo electrónico no puede recibir respuestas. 
						Para obtener más información, comunicate al (575) 645-5090
						</p>
						</div>
						<div>
						<p style="color: grey; font-size: 10px;">
						Edificio Twins Bay – Torre Bancolombia. Manga, Calle 25 #24a-16, Of 14-04 (Cartagena, Colombia)
						</p>
						</div>
						<script src="app.css"></script>
						</body>';
				try {
					//Server settings
					$mail->SMTPDebug  = 0;                                      //Enable verbose debug output
					$mail->isSMTP();                                            //Send using SMTP
					$mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
					$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
					$mail->Username   = 'softwareteus@gmail.com';       	    //SMTP username
					$mail->Password   = 'ztphmrjpzlysbiub';                     //SMTP password
					//$mail->Password   = 'Sistemas.2022*';                     //SMTP password old (Password con el cual se creo el correo)
					$mail->SMTPSecure = 'tls';                                  //Enable implicit TLS encryption
					$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
					//Recipients
					$mail->setFrom('softwareteus@gmail.com', 'Notificaciones TEUS');
					$mail->addAddress($email, 'gabriel nemesio');     //Add a recipient
					//Content
					$mail->isHTML(true);                                  //Set email format to HTML
					$mail->Subject = 'ResertPassword';
					
					$mail->AddAttachment('../Sapcov2/Image/App/Logo_CY.jpg', 'Logo_CY');
					$mail->Body     = $html;
					$mail->CharSet  = 'UTF-8';
					$mail->Encoding = 'base64';
					$mail->send();
					$data = ['statusMail'=> 'envio_ok'];
				} catch (Exception $e) {
					$data = ['statusMail'=> 'errorMail', 'msg' => $mail->ErrorInfo];
				}
		return $data;
		}
	}
?> 