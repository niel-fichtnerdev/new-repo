<?php

session_start();

if (isset($_SESSION['companyid'])) {
    
} else {
    header("location: welcome");
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/syspos-small.png">

    <!--### Chart JS Plugin / API ###-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation"></script>

    <!-- ############ -->
    
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/loader_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap');
    </style>
    <link rel="stylesheet" href="css/modal_styler.css">
    
    <!--https://fontawesome.com/v4/icons/-->
    


<title id="dashboard" data-id="dashboard">Dashboard</title>


</head>
<body>
<section>
        <div class="loader_section">
            <?php
                require 'loader.php';
            ?>
        </div>
</section>
<section>
    <div class="modal_section" id="open_notification">
        <?php
            require 'modal_class.php';
        ?>
    </div>
</section>

    <section>
    <div class="header_section">
        <?php
            require 'header2.php';
        ?>
    </div>
    </section>

    <section>
        <!--Main section -> Section 1-->
    <?php
        require 'main.php';
    ?>
    </section>
    <section>
        <!--Main section -> Section 2-->
        <div class="main-container">
            <div class="main_wrapper">
                <div class="main">
                    <div class="main_content">
                        
                    </div>
                </div>
               
            </div>
            <!--
            <div class="main_wrapper">
                Section 2
            </div>
            !-->
        </div>
    </section>
    
    <section>
        <?php
            //Footer section
            require 'footer.php';
        ?>
    </section>



    <script type="text/javascript" src="js/sidenav_handler.js"></script>
    <script type="text/javascript" src="js/table_contr.js"></script>
    <script type="text/javascript" src="js/modal_handler.js"></script>


</body>
</html>
