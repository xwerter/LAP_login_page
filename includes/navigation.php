<nav class="navbar bg-body-tertiary">
  <form class="container-fluid justify-content-start">
    <a href="index.php" class="btn btn-sm btn-outline-secondary">Home</a>
    <a href="add_user.php" class="btn btn-sm btn-outline-secondary">Create new Accound</a>
    <a href="show_user.php" class="btn btn-sm btn-outline-secondary">List all Accounds</a>
    <a href="login.php" class="btn btn-sm btn-outline-secondary float-end">Login</a>
    <a href="logout.php" class="btn btn-sm btn-outline-secondary float-end">LOGOUT</a>
    <?php
      if (logedin())
      {
        $user = get_loged_nickname();
        echo "<span class='navbar-brand mb-0 h1'>Hallo $user</span>";
      }
      
    ?>
  </form>
</nav>