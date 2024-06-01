<?php
require("includes/header.php");

if(logedin()){
    header("location: index.php");
    exit;
}

$conn = db_connect();
$err = "";

if (!empty($_POST)) {
    $nickname = $_POST["nickname"];
    $password = $_POST["password"];
    

    $sql = "SELECT u.iduser, u.nickname, u.password, r.bezeichnung AS rolle
            FROM tbl_user AS u
            INNER JOIN tbl_rolle AS r ON u.fidrolle = r.idrolle
            WHERE '$nickname' = u.nickname";
    $user = $conn->query($sql) OR die("Fehler: ". $conn->error);

    if ($user->num_rows > 0) {
        while ($row = $user->fetch_assoc()) {
            if ($password != $row["password"]) {
                $err = "Password ist falsch";
                break;
            }
            session_start();

            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $row["iduser"];
            $_SESSION["nickname"] = $row["nickname"];
            $_SESSION["rolle"] = $row["rolle"]; 
            
            header("location: index.php");
            exit;  
        }
    }
    else {
        $err = "Keine Nutzer mit dem '$nickname' Namen gefunden";
    }
}

db_close($conn);
?>

<body>
    
    
    <div class="container text-center">
    <div class="row">
        <div class="col-2">
        </div>

        <div class="col-8 text-start">
            <form method="POST" class="row g-3">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="nickname" required>
                    <label for="floatingInput">Nickname</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Login</button>
                    <b class="text-danger"><?= $err?></b>
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