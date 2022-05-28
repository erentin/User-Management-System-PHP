<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['choose_id'])){
    $c_id = $_POST['choose_id'] ?? null ;
    $_SESSION['member_id'] = $c_id;
    $select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE id='$c_id' ") or die("query failed");
        if(mysqli_num_rows($select)>0){
            $fetch = mysqli_fetch_assoc($select);
            header("location:update_member.php");
        }

}
$message[] = 'Bu ID Numarasında Bir Kullanıcı Sistemde Kayıtlı Değildir';
if($_SESSION["sayac"]==0){ 
    header("location:home_page.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Güncelleme</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="update-profile">
        <form action="" method="post" enctype="multipart/form-data">
                <div class="inputbox">
                    <?php
                    if(isset($_POST['choose_id'])){
                        $c_id = $_POST['choose_id'] ?? null ;
                        $_SESSION['member_id'] = $c_id;
                        $select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE id='$c_id' ") or die("query failed");
                        if(mysqli_num_rows($select)>0){
                            $fetch = mysqli_fetch_assoc($select);
                        }else{
                            foreach($message as $message){
                                echo '<div class="message">'.$message.'</div>';
                            }
                        }
                    }
                    ?>
                <span>Bilgilerinizi güncelliyeceğiniz kullanıcının ID no : </span>
                <input 
                    type="text"
                    name="choose_id"
                    class="box">
            </div>

            <input type="submit" value="Kullanıcıyı Seç" name="choose_member">
            <a id="membertable12" href="members_table.php">Üyeler Tablosunu Gör</a>
            <a id="membertable23" href="register_member.php">Üye Oluştur</a>
            <a href="home_page.php">Ana Sayfaya Dön</a>
        </form>
        


    </div>
    
</body>
</html>