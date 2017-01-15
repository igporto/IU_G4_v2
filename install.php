<form action="index.php" method="POST">
    User: root
    Password: iu
    <p>Mysql Root User: <input type="text" name="user" /></p>
    <p>Mysql Root Password:  <input type="password" name="password" /></p>
    <p><input type="submit" name="submit" value="submit" /></p>
</form>

<?php
if (isset($_POST["submit"])){

    $mysqlUserName = $_POST["user"];
    $mysqlPasswd = $_POST["password"];
    $dbFile = "IU_G4_v2/moovett.sql";
    $command='mysql -u' .$mysqlUserName .' -p' .$mysqlPasswd . ' < ' .$dbFile;
    exec($command,$output=array(),$worked);
    switch($worked){
        case 0:
            echo 'Import file <b>' .$dbFile .'</b> successfully imported to database<br />';
            echo 'Usuario da BD creado: adminMoovett con contrasinal moovett<br />';
            echo 'Usuario para probas con todos os permisos: admin con contrasinal admin<br />';
            echo '<a href="IU_G4_v2/index.php">Ir á WEB</a><br />';
            break;
        case 1:
            echo 'There was an error during import: User already Exists or You insert bad credentials<br /><br />';
            echo 'Database user created: moovett with password moovett<br /><br />';
            echo 'Website user admin created: admin with password admin<br /><br />';
            echo '<a href="IU_G4_v2/index.php">Check if credentials are ok and Proceed to Website</a>';
            break;
    }
}
?>
