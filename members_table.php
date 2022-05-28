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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="memberstable">
   
        <div class=table>
        <H1>ÜYELER TABLOSU</H1>
            <table class="orjtable">
                <tr>
                    <th>ID</th>
                    <th>KULLANICI ADI</th>
                    <th>E-MAİL</th>
                </tr>
                
            <?php
                $query= mysqli_query($conn,"SELECT * FROM `user_form`");   
                $count= mysqli_num_rows($query);
                $select=mysqli_query($conn, "SELECT * FROM `user_form`") or die("query failed");
                $fetch = mysqli_fetch_assoc($select);
                $newid=$fetch['id'];
                for($i=0;$i<=$count;$i++){ 
                    $select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE id='$newid'") or die("query failed");
                    if(mysqli_num_rows($select)>0){
                        $fetch = mysqli_fetch_assoc($select);
                        echo "<tr>";
                        echo "<td>".$fetch['id']."</td>";
                        echo "<td>".$fetch['kullanici_adi']."</td>";
                        echo "<td>".$fetch['email']."</td>";
                        echo "</tr>";
                        echo "<br>";
                        $newid++;
                    }else{
                        $newid++; 
                    }
    
                }
                

            ?>
            </table>
            <a href="panel.php" class="btnhome2">Admin Paneline Geri Dön</a>
            
        
        </div>
        
        </form>
        


    </div>
    
</body>
</html>