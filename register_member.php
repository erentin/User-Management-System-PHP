<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
    header('location:login.php');
}

if($_SESSION["sayac"]==0){ 
    header("location:home_page.php");
}


if(isset($_POST['submit'])){

    $kullaniciAdi = mysqli_real_escape_string($conn, $_POST['kAdKayit']);
    $email = mysqli_real_escape_string($conn, $_POST['kEmailKayit']);
    $sifre = mysqli_real_escape_string($conn, $_POST['kSifreKayit']);
    $sifreDogrulama = mysqli_real_escape_string($conn, $_POST['kSifreKayitDogrulama']);


    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE kullanici_adi='$kullaniciAdi' and parola = '$sifre'") or die ("query failed");

    if(mysqli_num_rows($select)>0){

        $message[]="Kullanıcı zaten bulunmaktadır.";

    }else{
        if($sifre != $sifreDogrulama){
            $message[] = 'Şifre doğrulama yanlış girilmiştir.';
        }else{
            $insert = mysqli_query($conn,"INSERT INTO `user_form`(kullanici_adi,email,parola) VALUES('$kullaniciAdi','$email','$sifre')") or die ('query failed');

            if($insert){
                $message[]="Kaydolma başarıyla tamamlandı!";
                header("location:panel.php");
            }else{
                $message[] = "Kaydolma başarısız!";
            }
        }
    }




}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="form-container">

        <form action="" method="post" enctype="multipart/form-data" >
            <h1>Admin Panel Yeni Üye!</h1>
            <?php

                if(isset($message)){
                    foreach($message as $message){
                        echo '<div class="message">'.$message.'</div>';
                    }

                }


            ?>
            <input 
                type="text"
                name="kAdKayit" 
                placeholder="Kullanıcı adını giriniz." 
                class="box"
                required>

            <input 
                type="email"
                name="kEmailKayit" 
                placeholder="E-mail adresini giriniz." 
                class="box"
                required>
            
            <input 
                type="password"
                name="kSifreKayit" 
                placeholder="Sifre giriniz." 
                class="box"
                required>
            
            <input 
                type="password"
                name="kSifreKayitDogrulama" 
                placeholder="Sifreyi tekrar giriniz." 
                class="box"
                required>
            
            <input 
                type="submit"
                name="submit"
                value="Kaydol" 
                class="btn"
                required>
            
            <h6>Panele Dönmek İstiyormusunuz? <a href="panel.php">Panele Dön</a> </h6>
            


        </form>

    </div>
    
</body>
</html>