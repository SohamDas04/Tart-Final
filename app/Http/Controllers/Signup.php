<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use App\Models\post;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Hash;
use App\Models\Information;


class Signup extends Controller
{
    //
    public function signupage(){
        return view('signupage');
    }
    public function register(Request $req){
        $user=new User;
        // $post= new Post;
        $data=stripslashes(file_get_contents("php://input"));
        $mydata=json_decode($data,true);
        $name=$mydata['name'];
        $uname=$mydata['uname'];
        $password=$mydata['p'];
        $email=$mydata['email'];
        $user->name=$name;
        $user->email=$email;
        $user->username=$uname;
        $user->password= Hash::make($password);
        $user->save();
        $info= new Information;
        $info->name=$name;
        $info->userid=$user->id;
        // $post->userid=$user->id;
        
        $info->save();
        // $post->save();
        // $num_str = sprintf("%06d", mt_rand(1, 999999));
        // $otp=$num_str;
        // require __DIR__.'/../../../vendor/autoload.php';
        // $mail = new PHPMailer(true);
        // try{
        // $mail->SMTPDebug = 2;                   // Enable verbose debug output
        // $mail->isSMTP();                        // Set mailer to use SMTP
        // $mail->Host       = getenv('MAIL_HOST');    // Specify main SMTP server
        // $mail->SMTPAuth   = true;               // Enable SMTP authentication
        // $mail->Username   = getenv("MAIL_FROM_ADDRESS");     // SMTP username
        // $mail->Password   = getenv('MAIL_PASSWORD');         // SMTP password
        // $mail->SMTPSecure = 'TLS';              // Enable TLS encryption, 'ssl' also accepted
        // $mail->Port       = 587;                // TCP port to connect to
        // $mail->setFrom(getenv("MAIL_FROM_ADDRESS"), 'supernova');           // Set sender of the mail
        // $mail->addAddress($email);           // Add a recipient
        // $mail->Subject = 'Subject';
        // $mail->Body    = $otp;
        // $mail->send();
        // }
        // catch (Exception $e) {
        //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        // }
        // return $otp;
    }
}
