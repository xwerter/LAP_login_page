<?php
require("includes/header.php");
?>

<body>
    <div class="container text-center">
        <div class="row">
            <div class="col-2">
            
            </div>

            <div class="col-8">
                <?php
                    echo "<h1>";
                    echo logedin() ? "Hertzlich wilkommen, ". get_loged_nickname(). "!" : "Wilkommen!";
                    echo "</h1>";
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