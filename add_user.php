<?php
require("includes/header.php");

$conn = db_connect();

$sql = "SELECT IDRolle, Bezeichnung
        FROM tbl_rolle
        ORDER BY Bezeichnung ASC";

$rollen = $conn->query($sql) or die("FEHLER bei sql statment: ". $conn->error);

if (!empty($_POST))
{
    $nickname = $_POST["nickname"];

    if (check_nickname($conn, $nickname))
    {
        echo "Nickname Existiert bereits!!";
        
    }
    else
    {
        $vorname = $_POST["vorname"];
        $nachname = $_POST["nachname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $rolle = $_POST["rolle"];

        $create_date = date('Y-m-d H:i:s');
        
        $sql = "INSERT INTO tbl_user (nickname, vorname, nachname, email, password, eintritsdatum, fidrolle)
                VALUES ('$nickname', '$vorname', '$nachname', '$email', '$password', '$create_date', '$rolle')";

        if ($conn->query($sql) === TRUE) {
            echo "New user addet successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }    
}

db_close($conn);
?>

<body>
    <div class="container text-center">
    <div class="row">
        <div class="col-2">
        
        </div>

        <div class="col-8">
            <form class="row g-3" method="POST">
            <div class="col-12">
                <label class="form-label">Nickname</label>
                <input type="text" class="form-control" name="nickname" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Vorname</label>
                <input type="text" class="form-control" name="vorname" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nachname</label>
                <input type="text" class="form-control" name="nachname" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Rolle</label>
                <select class="form-select" aria-label="Default select example" name="rolle" required>
                    <?php 
                        if ($rollen->num_rows > 0) {
                            // output data of each row
                            while($rolle = $rollen->fetch_assoc()) {
                                echo "<option value='". $rolle["IDRolle"]. "'>". $rolle["Bezeichnung"]. "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
        </form>
        </div>

        <div class="col-2">
        
        </div>
    </div>
    </div>
    
</body>

<?php
require("includes/footer.php");
?>