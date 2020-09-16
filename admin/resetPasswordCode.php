<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require './core_functions.php';
checkSession();


$request = $_SERVER['REQUEST_METHOD'];
if ($request == 'POST'):
    $userEmail = mysqli_real_escape_string($conn, $_POST['user_email']);
    include './phpConnection.php';
    $findUserQry = "CALL checkEmail('$userEmail')";
    $exUserQry = mysqli_query($conn, $findUserQry);
    if ($exUserQry->num_rows > 0):
        $getUser = mysqli_fetch_assoc($exUserQry);
        if ($getUser['user_type'] == 'ADMIN'):
            $uniqeNumber = rand(100000, 500000);
            include './phpConnection.php';
            $userKeyQry = "CALL updateUserResetPasswordKey('$getUser[id]',$uniqeNumber)";
            $exUserKeyQry = mysqli_query($conn, $userKeyQry);
            if ($exUserKeyQry):
                $messagebody = '<html>
                        <body>
                            <div style="background:#f2f2f2;margin:0 auto;max-width:640px;padding:20px 20px">
                                <table align="center" border="0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>                                                
                                            <div style="text-align: center;background-color: #2196F3;color: #Fff;font-family:"Open Sans", sans-serif;font-size:13px; padding: 1px;margin-top: 10px;border-radius:10px 10px 0 0;">
                                                <h2>Sentiprism Admin Panel Password Reset</h2>
                                            </div>
                                            <div style="background:#fff;color:#5b5b5b;font-family:"Open Sans", sans-serif;font-size:13px;padding:10px 20px;margin:20px auto;line-height:17px;   border:1px #ddd solid;border-top:0;clear:both;margin-top: 0;border-radius: 0 0 10px 10px;">
                                                
                                                <p>Dear Admin,</p>                                                    
                                                <p>Please use the following Link To Your Sentiprism Admin Panel Account Password Reset</p>
                                                <p><strong><h2 style="text-align:center;">' . $uniqeNumber . '</h2></strong></p>                                                   
                                            </div>
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tbody> 
                                                <tr>
                                                    <td>
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                            <tr>
                                                                <td style="font-family:"Open Sans",Arial,sans-serif;font-size:12px;padding-bottom: 10px;text-align: center;"> Please this link is valid up to 30min.</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </body>
                    </html>';
                require './assets/PHPMailer/PHPMailerAutoload.php';
                $mail = new PHPMailer;

                $mail->isSMTP();
                $mail->Host = EMAIL_HOST;
                $mail->SMTPAuth = true;
                $mail->Username = EMAIL_USERNAME;
                $mail->Password = EMAIL_PASSWORD;
                $mail->SMTPSecure = EMAIL_SMTP_SECURE;
                $mail->Port = EMAIL_PORT;

                $mail->From = 'info@sentiprism.com';
                $mail->FromName = 'Sentiprism';
                $mail->addAddress($getUser['email']);
                $mail->isHTML(true);
                $mail->Subject = 'Reset Password Instruction';
                $mail->Body = $messagebody;
                $mail->smtpConnect(
                        array(
                            "ssl" => array(
                                "verify_peer" => false,
                                "verify_peer_name" => false,
                                "allow_self_signed" => true
                            )
                        )
                );
                if ($mail->Send()):
                    $_SESSION['MAIL_CODE_PAGE'] = 'ON';
                    $_SESSION['RESET_PASSWORD_USER'] = $getUser['id'];
                    messageSuccess('We send confirmation code on your register email address.');
                    header('Location:code_reset_password.php');
                else:
                    messageError('confirmation code sending issue.');
                    header('Location:index.php');
                    $_SESSION['MAIL_CODE_PAGE'] = 'OFF';
                    $_SESSION['RESET_PASSWORD_USER'] = '';
                endif;
            else:
                messageError('Currently issus in reset password.');
                header('Location:index.php');
            endif;
        else:
            messageError('You are not authorized user.');
            header('Location:index.php');
        endif;
    else:
        messageError('You are not Authorize user.');
        header('Location:index.php');
    endif;
else:
    messageError('Invalid Mathod.');
    header('Location:index.php');
endif;
