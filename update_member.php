<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
$c_id = $_SESSION['member_id'];


$select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE id='$c_id' ") or die("query failed");
    if(mysqli_num_rows($select)>0){
        $fetch = mysqli_fetch_assoc($select);
    }

if(isset($_POST['choose_member'])){
    $update_name = mysqli_real_escape_string($conn, $_POST['kad']);
    $update_email = mysqli_real_escape_string($conn, $_POST['kemail']);
    $update_rol =   mysqli_real_escape_string($conn, $_POST['rol']);
    $update_member = mysqli_real_escape_string($conn, $_POST['memberpa']);

    // mysqli_query($conn, "UPDATE `user_form` SET kullanici_adi = '$update_name', email = '$update_email' WHERE id = '$c_id'") or die('query failed');

    if($_POST['kad']!=""){
        mysqli_query($conn, "UPDATE `user_form` SET kullanici_adi = '$update_name' WHERE id = '$c_id'") or die('query failed');
    }
    if($_POST['kemail']!=""){
        mysqli_query($conn, "UPDATE `user_form` SET email = '$update_name' WHERE id = '$c_id'") or die('query failed');
    }
    if($_POST['rol']==1){
        mysqli_query($conn, "UPDATE `user_form` SET rol = '$update_rol' WHERE id = '$c_id'") or die('query failed');
    }
    if($_POST['memberpa']==1){
        mysqli_query($conn, "DELETE FROM `user_form` WHERE id = '$c_id'") or die('query failed');
    }


}

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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="update-profile">

        <form action="" method="post" enctype="multipart/form-data">
            <div class="inputbox">
                <?php

                    $select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE id='$c_id' ") or die("query failed");
                    if(mysqli_num_rows($select)>0){
                        $fetch = mysqli_fetch_assoc($select);
                    }else{
                        header("location:home_page.php");
                    }

                ?>
                <span>Bilgilerinizi güncelliyeceğiniz kullanıcının ID no : </span>
                <input 
                    type="text"
                    value="<?php echo $fetch['id']?>"
                    class="box"
                    disabled>
                <span>Kullanıcı Adı : </span>
                <input 
                    type="text"
                    name="kad"
                    class="box">
                <span>Email Adresi : </span>
                <input 
                    type="text"
                    name="kemail"
                    class="box">
                <span>Rolü (Üye=0, Admin=1) : </span>
                <select name="rol">
                    <option value=0>0</option>
                    <option value=1>1</option>
                </select>
                <span>Hesabı Sil : </span>
                <select name="memberpa">
                    <option value=0>Hayır</option>
                    <option value=1>Evet</option>
                </select>
            </div>

            <input type="submit" value="Kullanıcı Ayarlarını Güncelle" name="choose_member">
            <a href="home_page.php">Ana Sayfaya Dön</a>
        </form>

    </div>
    
</body>
</html>