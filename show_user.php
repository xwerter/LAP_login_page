<?php

?><?php
require("includes/header.php");

$conn = db_connect();

$sql = "SELECT u.iduser, u.nickname, u.vorname, u.nachname, u.email, u.eintritsdatum, r.bezeichnung AS rolle
        FROM tbl_user AS u
        INNER JOIN tbl_rolle as r ON u.fidrolle = r.idrolle
        ORDER BY u.nickname ASC";
$users = $conn->query($sql) OR die("Fehler: ". $conn->error);



db_close($conn);

?>

<body>
     <div class="container text-center">
        <div class="row">
            <div class="col-2">
            
            </div>

            <div class="col-8">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nickname</th>
                        <th scope="col">Vorname</th>
                        <th scope="col">Nachname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Eintritsdatum</th>
                        <th scope="col">Rolle</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                                if ($users->num_rows > 0) {
                                    while ($user = $users->fetch_assoc()) {
                                        echo   "<tr>
                                                <th scope='row'>". $user["iduser"] ."</th>
                                                <td>". $user["nickname"] ."</td>
                                                <td>". $user["vorname"] ."</td>
                                                <td>". $user["nachname"] ."</td>
                                                <td>". $user["email"] ."</td>
                                                <td>". $user["eintritsdatum"] ."</td>
                                                <td>". $user["rolle"] ."</td>";
                                        echo logedin_as_admin() ? "<td><a href=dell.php?id=". $user["iduser"]."&nickname=". $user["nickname"]." class='btn btn-danger'>Löschen</a></td>": "";
                                        echo    "</tr>";
                                    }
                                }
                            ?>
                            
                        
                    </tbody>
                </table>
            </div>

            <div class="col-2">
            
            </div>
        </div>
    </div>
</body>

<?php
require("includes/footer.php");
?>