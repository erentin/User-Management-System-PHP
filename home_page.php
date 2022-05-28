<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}

if(isset($_GET['logout'])){
    unset($user_id);
    session_destroy();
    header('location:login.php');
}

$select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE id='$user_id' ") or die("query failed");
            if(mysqli_num_rows($select)>0){
                $fetch = mysqli_fetch_assoc($select);}

$_SESSION["sayac"]=0;
if($fetch['rol']){
    $_SESSION["sayac"]=1;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
    <div class="container">

        <div class="profile">
            <?php

            $select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE id='$user_id' ") or die("query failed");
            if(mysqli_num_rows($select)>0){
                $fetch = mysqli_fetch_assoc($select);}
            ?>
            <h3>Hoşgeldiniz, <?php echo $fetch['kullanici_adi'] ?>.</h3> <br>

            <?php

            $select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE id='$user_id' ") or die("query failed");
            if(mysqli_num_rows($select)>0){
                $fetch = mysqli_fetch_assoc($select);}

            if ($fetch['rol']==1)
            {
                echo "<a href='panel.php' class='btnadmin'>Admin Paneli<br><span class='admin'>(Sadece Adminlerde Gözükür)</span></a>";
            }
            

            ?>
            <a href="update_profile.php" class="btnhome">Profilini güncelle.</a>
            <a href="home_page.php?logout=<?php echo $user_id; ?>" class="btnhome2">Çıkış Yap</a>
            <p>İstiyorsan yeniden <a href="login.php">Giriş yap</a> yada <a href="register.php">Kaydol!</a></p>
        </div>

    </div>

</body>
</html>