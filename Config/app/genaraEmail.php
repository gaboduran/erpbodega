<?php
	
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


	require '../teus/Helpers/PHPMailer/Exception.php';
    require '../teus/Helpers/PHPMailer/PHPMailer.php';
    require '../teus/Helpers/PHPMailer/SMTP.php'; 

	Class genaraEmail extends DB {

	        public static function enviarEmail($email, $link){
	        $data = [];
	        $mail = new PHPMailer(true);
	        $html = '<!doctype html>
			<html lang="en-US">
			
			<head>
				<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
				<title>Reset Password Email Template</title>
				<meta name="description" content="Reset Password Email Template.">
				<style type="text/css">
					a:hover {text-decoration: underline !important;}
				</style>
			</head>
			
			<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
				<!--100% body table-->
				<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
					style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif;">
					<tr>
						<td>
							<table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
								align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td style="height:80px;">&nbsp;</td>
								</tr>
								<tr>
									<td style="text-align:center;">
									  <a href="https://rakeshmandal.com" title="logo" target="_blank">
										<img width="160" src="../../Teus/Image/App/look.png" title="logo" alt="logo">
									  </a>
									</td>
								</tr>
								<tr>
									<td style="height:20px;">&nbsp;</td>
								</tr>
								<tr>
									<td>
										<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
											style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
											<tr>
												<td style="height:40px;">&nbsp;</td>
											</tr>
											<tr>
												<td style="padding:0 35px;">
													<h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:"Rubik",sans-serif;">Ha solicitado restablecer su contraseña</h1>
													<span
														style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
													<p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
													No podemos simplemente enviarle su antigua contraseña. Se ha generado para usted un enlace único para restablecer su contraseña. Para restablecer su contraseña, haga clic en el siguiente enlace y siga las instrucciones.
													</p>
													</br>
													<a href="javascript:void(0);">'.$link.'</a>
												</td>
											</tr>
											<tr>
												<td style="height:40px;">&nbsp;</td>
											</tr>
										</table>
									</td>
								<tr>
									<td style="height:20px;">&nbsp;</td>
								</tr>
								<tr>
									<td style="text-align:center;">
										<p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>www.softwareteus.com</strong></p>
									</td>
								</tr>
								<tr>
									<td style="height:80px;">&nbsp;</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<!--/100% body table-->
			</body>
			
			</html>';
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
	                $mail->Subject = 'pRUEBA';
	                
	             //   $mail->AddAttachment('../Teus/Image/App/look.png', 'Logo');
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