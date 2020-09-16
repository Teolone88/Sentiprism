<?php
include "config.php";  

    $success = array();  
    $Email = $_REQUEST['email']; 
    $Hase_Key = rand(100000,999999);          
    $Hase_Key = md5($Hase_Key);
    $date = date("Y-m-d H:i:s");
    //print_r($date);
    $selcheck = $connection->prepare("SELECT * FROM `cuffed_admin` WHERE Admin_Email = '$Email'");
    $selcheck->execute();
    if($selcheck->RowCount() > 0)
    {  
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
                                                <h2>Cuffed Admin Panel Password Reset</h2>
                                            </div>
                                            <div style="background:#fff;color:#5b5b5b;font-family:"Open Sans", sans-serif;font-size:13px;padding:10px 20px;margin:20px auto;line-height:17px;   border:1px #ddd solid;border-top:0;clear:both;margin-top: 0;border-radius: 0 0 10px 10px;">
                                                
                                                <p>Dear Admin,</p>                                                    
                                                <p>Please use the following Link To Your Cuffed Admin Panel Account Password Reset</p>
                                                <p>Link: <strong><a href="http://localhost/cuffed/admin/reset-password.php?email='.$Email.'&has='.$Hase_Key.'">http://sensussoftcom/cuffed/admin/reset-password.php/'.$Hase_Key.'</a></strong></p>                                                   
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
          require("PHPMailer/PHPMailerAutoload.php");
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'dharmesh.sensussoft@gmail.com';
            $mail->Password = 'sensus@angel';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->From = 'Cuffed@info.com';
            $mail->FromName = 'Cuffed';
            $mail->addAddress($Email);

            $mail->isHTML(true);

            $mail->Subject = 'Cuffed Admin Password Reset Link';
            $mail->Body    = $messagebody;
            $mail->smtpConnect(
                            array(
                                "ssl" => array(
                                    "verify_peer" => false,
                                    "verify_peer_name" => false,
                                    "allow_self_signed" => true
                                )
                            )
                        );
            if($mail->Send()) {
                $fetcheck = $selcheck->fetch();
                $uphase = $connection->prepare("UPDATE `cuffed_admin` SET Admin_Hase = '$Hase_Key',Admin_HaseTime = '$date' WHERE Admin_Id = '".$fetcheck['Admin_Id']."'");
                $uphase->execute();
                $success['success'] = 'success';
            }
            else
            {
                $success['success'] = 'fail';
                 echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
            }
    }
    else
    {
        $success["success"] = 'fail'; 
    }

echo json_encode($success);
?>