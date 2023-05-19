<html>
<style>
    td{
        color: chocolate;
    }
</style>
<body>
<head><h1 style="color: aqua">PHP Database işlemleri</h1></head>

<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $db = new PDO("mysql:host=$servername;dbname=students", $username, $password);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<br>

<?php
if($_REQUEST['islem']=="ekle"){
    $fullname=$_REQUEST['fullname'];
    $email=$_REQUEST['email'];
    $gender=$_REQUEST["gender"];
    $sql= "INSERT INTO ogrenci(fullname,email,gender) VALUES('$fullname','$email','$gender')";
    $db->exec($sql);
    echo "Ekleme Yapıldı";
    header("Location: ?islem=eklendi");
}

if($_REQUEST['islem']=="sil")
{
    $id=$_REQUEST['id'];
    $sql= "DELETE FROM ogrenci WHERE Id=$id";
    $db->exec($sql);
    echo "Silindi";
    header("Location: ?islem=silindi");
}


?>

******************ÖĞRENCİ LİSTESİ******************<BR>
<table border="1" width="600" bgcolor="aqua">
    <tr>
        <td>Adı Soyadı: </td>
        <td>Email Adresi: </td>
        <td>Cinsiyet: </td>
    </tr>
    <?php
    $sql="SELECT *FROM ogrenci";
    foreach ($db->query($sql) as $veri){
        ?>
        <tr>
            <td> <?=$veri['fullname']?></td>
            <td> <?=$veri['email']?></td>
            <td> <?=$veri['gender']?></td>
            <td><a href="?islem=sil&id=<?=$veri['Id']?>">SİL</a></td>
        </tr>
        <?php
    }
    ?>
</table>

<form action="?islem=ekle" method="post">
    İsim: <input type="text" name="fullname" required><br>
    Email adresiniz: <input type="email" name="email" required><br>
    Cinsiyetiniz: <input type="radio" value="Erkek" name="gender" required> Erkek
    <input type="radio" value="Kadın" name="gender" required> Kadın
    <input type="submit">
</form>

</body>
</html>

