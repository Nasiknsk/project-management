<?php
   
    // Connection Created Successfully
    $conn = mysqli_connect("localhost" , "root" , "" , "project_management") or die("Connection Failed");
    session_start();

    // Store All Errors
    $errors = [];

    // if forgot button will clicked
    if (isset($_POST['forgot_password'])) {
        $email = $_POST['email'];
        $_SESSION['email'] = $email;

        $emailCheckQuery = "SELECT * FROM admin WHERE email = '$email'";
        $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

        // if query run
        if ($emailCheckResult) {
            // if email matched
            if (mysqli_num_rows($emailCheckResult) > 0) {
                $code = rand(999999, 111111);
                $updateQuery = "UPDATE admin SET code = $code WHERE email = '$email'";
                $updateResult = mysqli_query($conn, $updateQuery);
                if ($updateResult) {
                    //$subject = 'Email Verification Code';
                   // $message = "our verification code is $code";
                    //$sender = 'From: ati.student.lms@gmail.com';

                    $sender = 'ati.student.lms@gmail.com';
 
                    $fromName = 'ATI-KANDY [Demo]'; 
                     
                    $subject = "Project Management System Varification Code (ATI-KANDY) [demo]"; 
                     
                    $message = ' 
                        <html> 
                        
                        <body> 
                        Dear User,<br>
                        Please use the following verification code to Reset Your Password in Project Management System (ATI-KANDY). 
                           <center> 
                                
                                <p> <h3><font size="4px" face="Arial">your verification code is :</font><br> <font color="Blue" size="5px" face="Arial"><b> ' .$code. ' </b></font> </h3></p>
                                 
                           </center>
                        </body> 
                        </html>'; 
                     
                    // Set content-type header for sending HTML email 
                    $headers = "MIME-Version: 1.0" . "\r\n"; 
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                     
                    // Additional headers 
                    $headers .= 'From: '.$fromName.'<'.$sender.'>' . "\r\n"; 

                     
                    if (mail($email, $subject, $message, $headers)) {
                        $message = "We've sent a verification code to your Email <br> $email";

                        $_SESSION['message'] = $message;
                        header('location: a_verifyEmail.php');
                    } else {
                        $errors['otp_errors'] = 'Failed while sending code!';
                    }
                } else {
                    $errors['db_errors'] = "Failed while inserting data into database!";
                }
            }else{
                $errors['invalidEmail'] = "Invalid Email Address";
            }
        }else {
            $errors['db_error'] = "Failed while checking email from database!";
        }
    }
if(isset($_POST['verifyEmail'])){
    $_SESSION['message'] = "";
    $OTPverify = mysqli_real_escape_string($conn, $_POST['OTPverify']);
    $verifyQuery = "SELECT * FROM admin WHERE code = $OTPverify";
    $runVerifyQuery = mysqli_query($conn, $verifyQuery);
    if($runVerifyQuery){
        if(mysqli_num_rows($runVerifyQuery) > 0){
            $newQuery = "UPDATE admin SET code = 0";
            $run = mysqli_query($conn,$newQuery);
            header("location: a_newPassword.php");
        }else{
            $errors['verification_error'] = "Invalid Verification Code";
        }
    }else{
        $errors['db_error'] = "Failed while checking Verification Code from database!";
    }
}

// change Password
if(isset($_POST['changePassword'])){
    $password = md5($_POST['password']);
    $confirmPassword = md5($_POST['confirmPassword']);
    
    if (strlen($_POST['password']) < 4) {
        $errors['password_error'] = 'Use 4 or more characters with a mix of letters, numbers & symbols';
    } else {
        // if password not matched so
        if ($_POST['password'] != $_POST['confirmPassword']) {
            $errors['password_error'] = 'Password not matched';
        } else {
            $email = $_SESSION['email'];
            $updatePassword = "UPDATE admin SET password = '$password' WHERE email = '$email'";
            $updatePass = mysqli_query($conn, $updatePassword) or die("Query Failed");
            session_unset($email);
            session_destroy();
            header('location: admin.html');
        }
    }
}