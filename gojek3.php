<?php

error_reporting(0);
include ("func.php");
echo "\e            GOJEK VERSION 1.3.2              \n";
echo "\e SCRIPT GOJEK AUTO REGISTER + AUTO CLAIM VOUCHER\n";
echo "\n";
nope:
echo "\e[?] Masukkan Nomor HP Anda (1) : ";
$nope = trim(fgets(STDIN));
$cek = cekno($nope);
if ($cek == false)
    {
    echo "\e[x] Nomor Telah Terdaftar\n";
			goto nope;
    }
  else
    {
echo "\e[!] Siapkan OTPmu\n";
sleep(5);
$register = register('1'.$nope);
if ($register == false)
    {
    echo "\e[x] Failed Get OTP!\n";
    }
  else
    {
    otp:
    echo "\e[!] Masukkan Kode Verifikasi (OTP) : ";
    $otp = trim(fgets(STDIN));
    $verif = verif($otp, $register);
    if ($verif == false)
        {
        echo "\e[x] Kode Verifikasi Salah\n";
        goto otp;
        }
      else
        {
	    $claims = food($verif);
		echo "\e[!] Trying to redeem Voucher : ".$claims." !\n";
		$h=fopen("".$claims.".txt","a");
		fwrite($h,json_encode(array('token' => $verif, 'voc' => $claims))."\n");
		fclose($h); 
        sleep(3);
        $claim = claims($verif,$claims);
        if ($claim == false){
            echo "\e[!] Failed to Claim Voucher, Try to Claim Manually\n";
			      sleep(3);
            echo "\e[!] Trying to redeem Voucher : COBAINGOJEK !\n";
			      goto ride;
            }else{
                echo "\e[+] ".$claim."\n";
				    sleep(3);
                echo "\e[!] Trying to redeem Voucher : COBAINGOJEK !\n";
                sleep(3);
                goto ride;
            }
            ride:
            $claim = ride($verif);
            if ($claim == false){
            echo "\e[!] Failed to Claim Voucher, Try to Claim Manually\n";
			      sleep(3);
            echo "\e[!] Trying to redeem Voucher : AYOCOBAGOJEK !\n";
            sleep(3);
            }else{
                echo "\e[+] ".$claim."\n";
				    sleep(3);
                echo "\e[!] Trying to redeem Voucher : AYOCOBAGOJEK !\n";
                sleep(3);
                goto pengen;
            }
            pengen:
            $claim = cekvocer($verif);
            if ($claim == false ) {
            echo "\e[!] Failed to Claim Voucher, Try to Claim Manually\n";
            }
            else{
                echo "\e[+] ".$claim."\n";
                
        }
    }
    }
    }


?>
