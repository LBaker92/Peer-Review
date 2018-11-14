<?php

if (isset($_SESSION["logged_in"])) {
    if ($_SESSION["permissions"] == "admin") {
?>
    <header>
        <nav class="container-fluid py-3" id="nav">
            <div class="row">
                <div class="col-md-4 pl-4 pb-3">
                    <a href="https://www.kent.edu/"><img src="../images/ksu_logo.png" alt="" width="185px" class="ml-2"></a>
                </div>
                    <div class="col-md-4 my-auto text-center">
                        <a href="#" class="nav-title">ADMIN PAGE</a>
                    </div>
                <div class="col-md-4 my-auto text-right">
                    <a href="../logout.php"><button class="btn" id="logout-btn">LOGOUT</button></a>
                </div>
            </div>
        </nav>
    </header>
<?php
    }
    else if ($_SESSION["permissions"] == "student") {
?>
    <header>
        <nav class="container-fluid py-3" id="nav">
            <div class="row">
                <div class="col-md-4 pl-4 pb-3">
                    <a href="https://www.kent.edu/"><img src="../images/ksu_logo.png" alt="" width="185px" class="ml-2"></a>
                </div>
                    <div class="col-md-4 my-auto text-center">
                        <a href="#top" class="nav-title">STUDENT PAGE</a>
                    </div>
                <div class="col-md-4 my-auto text-right">
                    <a href="../logout.php"><button class="btn" id="logout-btn">LOGOUT</button></a>
                </div>
            </div>
        </nav>
    </header>    

<?php
    }
}
else {
?>
    <header>
        <nav class="container-fluid py-3" id="nav">
            <div class="row">
                <div class="col-md-4 pl-4 pb-3">
                    <a href="https://www.kent.edu/"><img src="images/ksu_logo.png" alt="" width="185px" class="ml-2"></a>
                </div>
                    <div class="col-md-4 my-auto text-center">
                        <a href="#" class="nav-title">LOGIN PAGE</a>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </nav>
    </header>

<?php
}



?>