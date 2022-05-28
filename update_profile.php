<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];


if(isset($_POST['update_profile'])){
    $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);


    mysqli_query($conn, "UPDATE `user_form` SET kullanici_adi = '$update_name', email = '$update_email' WHERE id = '$user_id'") or die('query failed');

    $old_pass_hidden = $_POST['old_pass_hidden'];
    $old_pass = mysqli_real_escape_string($conn, $_POST['old_pass']);
    $new_pass = mysqli_real_escape_string($conn, $_POST['new_pass']);
    $confirm_pass = mysqli_real_escape_string($conn, $_POST['new_pass_c']);

    if(!empty($old_pas) || !empty($new_pass) || !empty($confirm_pass)){
        if($old_pass_hidden != $old_pass){
            $message[] = 'Şuanki şifrenizle eşleşme sağlanamadı!';
        }elseif($new_pass != $confirm_pass){
            $message[] = 'Yeni Şifreyi yanlış girdiniz!';
        }else{
            mysqli_query($conn, "UPDATE `user_form` SET parola = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
            $message[] = 'Şifreniz başarıyla değiştirildi!';
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
    <title>Profil Güncelleme</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="update-profile">
        <?php
            $select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE id='$user_id' ") or die("query failed");
            if(mysqli_num_rows($select)>0){
                $fetch = mysqli_fetch_assoc($select);}

        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="inputbox">
                <?php
                if(isset($message))
                    foreach($message as $message){
                        echo '<div class="message">'.$message.'</div>';
                    }
                    ?>

                <span>Kullanıcı Adı : </span>
                <input 
                    type="text"
                    name="update_name"
                    value="<?php echo $fetch['kullanici_adi']?>"
                    class="box">
                <span>E-Mailiniz : </span>
                <input 
                    type="email"
                    name="update_email"
                    value="<?php echo $fetch['email']?>"
                    class="box">

            </div>
            
            <div class="inputbox">
                <input 
                    type="hidden"
                    name="old_pass_hidden"
                    value="<?php echo $fetch['parola'] ?>"
                    class="box">
                <span>Eski Şifreniz : </span>
                <input 
                    type="password"
                    name="old_pass"
                    class="box">

                <span>Yeni Şifreniz : </span>
                <input 
                    type="password"
                    name="new_pass"
                    class="box">
                
                <span>Yeni Şifreniz (Tekrar) : </span>
                <input 
                    type="password"
                    name="new_pass_c"
                    class="box">
            </div>

            <input type="submit" value="Profilimi Güncelle" name="update_profile">
            <a href="home_page.php">Ana Sayfaya Dön</a>
        </form>

    </div>
    
</body>
</html>