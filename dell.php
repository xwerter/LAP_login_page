<?php
require("includes/header.php");

function dell_user( $user_id ) {
    $conn = db_connect();

    $sql = "DELETE FROM tbl_user WHERE $user_id = iduser";
    $result = $conn->query( $sql ) or die("Fehler: ". $conn->error);
    
    db_close($conn);
    
    return true;
}

?>

<body>
    <div class="container text-center">
        <div class="row">
            <div class="col-2">
            
            </div>

            <div class="col-8">
                <?php
                    $id = $_GET["id"];
                    $nickname = $_GET["nickname"];
                    dell_user($id);
                    echo "<h2>Nutzer '$nickname' wurde gelöscht!</h2>";
                    header("refresh: 1; url=show_user.php");
                ?>
            </div>

            <div class="col-2">
            
            </div>
        </div>
    </div>
    

</body>

<?php
require("includes/footer.php");
?>