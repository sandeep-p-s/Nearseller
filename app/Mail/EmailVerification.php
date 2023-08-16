<?php
namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $verificationToken;
    public $userName;
    public $userEmail;
    public $mailContent;
    public $checkval;
    public $otpMessage;

    public function __construct($verificationToken, $userName, $userEmail,$checkval,$otpMessage)
    {
        $this->verificationToken = $verificationToken;
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->checkval = $checkval;
        $this->otpMessage = $otpMessage;
    }


    public function build()
    {

        if($this->checkval==1)
        {
            $subject = 'Email ID Verification';
            return $this->from('itsuportshyzventures@gmail.com', 'NEAR SELLERS')->subject($subject)->view('emails.email_verification');
        }
        else if($this->checkval==2)
        {
            $subject = 'One Time Password';
            return $this->from('itsuportshyzventures@gmail.com', 'NEAR SELLERS')->subject($subject)->view('emails.otp_verification');
        }
        else if($this->checkval==3)
        {
            $subject = 'Reset Password';
            return $this->from('itsuportshyzventures@gmail.com', 'NEAR SELLERS')->subject($subject)->view('emails.resetpasswd_verification');
        }



    }




}
