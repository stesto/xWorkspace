<?php
	include_once('_helpers.php');
?>

<nav class="navbar navbar-expand-md sticky-top bg-dark navbar-dark">
    <div class="container-md">
        <a class="navbar-brand" href="#">
            <img src="media/xWorkspace Banner.svg" alt="" width="200" class="d-inline-block align-text-top">

        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menubar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="menubar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="bueroreservierung.php" class="nav-link active">Büroreservierung</a>
                </li>
                <?php 
                    if (isAdmin()) {
                        echo 
                        '<li class="nav-item">
                            <a href="admin.php" class="nav-link active">Admin Page</a>
                        </li>';
                    }
                ?>
                </li>
            </ul>
            <div class="navbar-nav dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" style="display: flex; align-items: center;">
                    <span class="material-symbols-outlined">person</span>
                    <span id="username" class="mx-1"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="dropdown-item" style="user-select: none; cursor: pointer;" onclick="logout()">Abmelden</li>
                    <!-- <li class="dropdown-item-admin" style="user-select: none; cursor: pointer; background: linear-gradient(135deg, #71b7e6, #9b59b6);"> <a href="admin.php" class="nav-link active">Admin-Page</a> -->
                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
    function logout() {
        Cookies.remove('user_id');
        Cookies.remove('username');
        location.href = 'login.php';
    }

    window.onload = (event) => {
        document.getElementById("username").innerHTML = Cookies.get('username');;
    }

</script>