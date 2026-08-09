<?php
session_start();
include_once("lib/include.php");
global $db;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if (!isset($_GET['token']) AND !isset($_GET['submit'])) {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        tokenDbCleanUp($db, $email);
        
        $sql = "SELECT email FROM `cms-reset_pass`";
        $con = $db->prepare($sql);
        $con->execute();
        $data = $con->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $key => $value) {
            foreach ($value as $key => $value) {
                echo $value;
                if ($value == $email) {
                    header('Location: ' . url('/cantLogIn?emailAlredySent'));                    exit;
                }
            }

        }



        if (duplicateVerify($db, $email) !== "OK") {
            #email uz existuje muzem na nej poslat link
            $token = tokenGenerator();
            saveTokenToDb($db, $email, $token);
            $link = linkGenerator($token, $email);

            $linkMessage = "Hi $email,

                                We received a request to reset the password for your vavrama25 login account. No changes have been made to your account yet.

                                You can reset your password by clicking the button below:

                                $link

                                Note: This link will expire in 2 hours for security purposes.

                                If you did not request a password reset, you can safely ignore this email. Your password will remain the same, and your account stays secure.

                                Best regards,

                                The Martin Vávra your IT assistant ---
                ";
        }
        
        elseif (!emailVerify($email)) {
            header("Location: " . url("CMS/cantLogIn?emailInvalid"));
        }

        elseif (duplicateVerify($db, $email) == "OK") {
            #email sent akorat ze vubec protoze nemame tento email v db
            header("Location: ". url("CMS/login.php?emailSent"));
        } 
         

            require 'PHPMailer/src/Exception.php';
            require 'PHPMailer/src/PHPMailer.php';
            require 'PHPMailer/src/SMTP.php';

            $mail = new PHPMailer(true);

            try {
                // --- Google SMTP Server Settings ---
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';                        // Gmail SMTP server
                $mail->SMTPAuth   = true;                                    // Enable SMTP authentication
                $mail->Username   = 'martin.letsencrypt@gmail.com';           // Your Gmail address
                $mail->Password   = 'ivhwxehtzfqktiet';                      // Your 16-character App Password (NO SPACES)
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          // Required encryption
                $mail->Port       = 587;                                     // Port for TLS

                // --- Recipients ---
                $mail->setFrom('martin.letsencrypt@gmail.com', 'Martin Vavra');
                $mail->addAddress($email);                  // Destination email

                // --- Content ---
                $mail->isHTML(true);
                $mail->Subject = 'Password reset request for vavrama25 login';
                if (isset($linkMessage)) {
                    $mail->Body = $linkMessage;
                }


                $mail->send();
                echo 'Message has been sent successfully via Gmail!';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }else{
            echo "invalid email";
        }

  
} elseif (isset($_GET['token'])){
# token je set musime mu resetnout heslo
    if (isset($_GET['email'])) {
        $email = $_GET['email'];

        $_SESSION['token'] = $_GET['token'];
        $_SESSION['user'] = $email;

        header("Location: " . url("/passwordReset"));
    } else {
        header("Location: ../index.php");
    }

} elseif (isset($_GET['submit'])) {
    if (isset($_POST['password'], $_POST['password-confirmation'])) {

        $password = $_POST['password'];
        $password_confirm = $_POST['password-confirmation'];
        
        $email = $_SESSION['user'];


        if ($password !== $password_confirm){
            header('Location: ' . url('CMS/passwordReset?PasswordsDoNotMatch'));
            exit;
        } else {
            if (passVerify($password) !== "OK") {
                header('Location: ' . url('CMS/passwordReset?PasswordTooWeak'));
                exit;        
            } 
        }
        $hash = customHash($password, $email);
        echo  $email;
        updateToDb($db, $hash, $email);
        header("Location: " . url("CMS/login?passResetSuccess"));
        
    }
}
