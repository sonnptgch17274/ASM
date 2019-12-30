<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php 
echo "Sucess!";

?>

<?php     

    require_once '../database.php';
    $connect = mysqli_connect($hostname, $username, $password, $dbname);

    $idcat1 = $_SESSION["idcourse"];
    echo $idcat1;
  
?>

</body>
</html>

