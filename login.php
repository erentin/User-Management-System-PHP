<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

    $kullaniciAdi = mysqli_real_escape_string($conn, $_POST['kAdKayit']);
    $sifre = mysqli_real_escape_string($conn, $_POST['kSifreKayit']);

    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE kullanici_adi='$kullaniciAdi' and parola = '$sifre'") or die ("query failed");

    if(mysqli_num_rows($select)>0){
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id']=$row['id'];
        header('location:home_page.php');
    }else{
        $message[] = "Yanlış kullanıcı adı veya şifre!";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="form-container">

        <form action="" method="post" enctype="multipart/form-data" >
            <h1>Şimdi Giriş Yap!</h1>
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
                placeholder="Kullanıcı adınızı giriniz." 
                class="box"
                required>
            
            <input 
                type="password"
                name="kSifreKayit" 
                placeholder="Sifrenizi giriniz." 
                class="box"
                required>
            
            <input 
                type="submit"
                name="submit"
                value="Giriş Yap" 
                class="btn"
                required>
            
            <h6>Hesabınız yok mu? <a href="register.php">Kaydol!</a> </h6>
            


        </form>

    </div>
    
</body>
</html>