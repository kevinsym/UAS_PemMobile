file:///c%3A/xampp/htdocs/uas_pmob/dosen_action.php {"mtime":1658127999239,"ctime":1658127999239,"size":0,"etag":"393h9e8cs0","orphaned":false,"typeId":""}
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uas_pmob";
$table = "dosen";


$action = $_POST["action"];

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Koneksi Gagal: " . $conn->connect_error);
    return;
}

//Buat table
if("CREATE_TABLE" == $action){
    $sql = "CREATE TABLE IF NOT EXISTS $table ( 
        id_dosen INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nidn_dosen VARCHAR(10) NOT NULL,
        nama_dosen VARCHAR(30) NOT NULL)";

    if($conn->query($sql) === TRUE){
        echo "berhasil";
    }else{
        echo "error";
    }
    
    $conn->close();
    return;
}

//Ambil data
if("GET_ALL" == $action){
    $db_data = array();
    $sql = "SELECT id_dosen, nidn_dosen, nama_dosen from $table ORDER BY id_dosen DESC";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result -> fetch_assoc()){
            $db_data[] = $row;
        }

        echo json_encode($db_data);
    }else{
        echo "error";
    }

    $conn->close();
    return;
}

//Tambah data
if("ADD_DOSEN" == $action){
    $nidn_dosen = $_POST["nidn_dosen"];
    $nama_dosen = $_POST["nama_dosen"];
    $sql = "INSERT INTO $table (nidn_dosen, nama_dosen) VALUES ('$nidn_dosen', '$nama_dosen')";
    $result = $conn->query($sql);
    echo "berhasil";
    $conn->close();
    return;
}

//Update data
if("UPDATE_DOSEN" == $action){
    $id_dosen = $_POST['$id_dosen'];
    $nidn_dosen = $_POST["nidn_dosen"];
    $nama_dosen = $_POST["nama_dosen"];
    $sql = "UPDATE $table SET nidn_dosen = '$nidn_dosen', nama_dosen = '$nama_dosen' WHERE id = $id_dosen";

    if($conn->query($sql) === TRUE){
        echo "berhasil";
    }else{
        echo "error";
    }
    $conn->close();
    return;
}

//Delete data
if("DELETE_DOSEN" == $action){
    $id_dosen = $_POST['$id_dosen'];
    $sql = "DELETE FROM $table WHERE id = $id_dosen";

    if($conn->query($sql) === TRUE){
        echo "berhasil";
    }else{
        echo "error";
    }
    $conn->close();
    return;
}



?>