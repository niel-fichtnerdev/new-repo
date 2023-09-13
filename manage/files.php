<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--### Chart JS Plugin / API ###-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation"></script>

    <!-- ############ -->

    <link rel="stylesheet" href="../css/loader_style.css">
    <link rel="stylesheet" href="../css/user_manager.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap');
    </style>
    <link rel="stylesheet" href="../css/modal_styler.css">
    
    <!--https://fontawesome.com/v4/icons/-->

    <title>Company Files</title>
</head>
<body>
<section>
        <div class="loader_section">
            <?php
                require '../loader.php';
            ?>
        </div>
</section>
<section>
    <?php
        require '../header.php';
    ?>
</section>

<section>
        <div class="modal_section" id="open_notification">
            <?php
                require '../modal_class.php';
            ?>
            <script type="text/javascript" src="../js/modal_handler.js"></script>
        </div>
</section>
<section>
    <!-- ### MAIN SECTION ###-->

    <div class="main-container">
            <div class="main_wrapper2">
                <div class="main2">
                    <div class="content">
                        <div class="content_header">
                            <h3>Header Goes here!</h3>
                            <p>Lorem ipsum dolor sit amet.</p>
                        </div>
                        <div class="main_content">
                            <p>Company Files Goes Here!</p>
                        </div>
                        <div class="content_footer">
                            <p>Footer Goes here!</p>
                        </div>
                    </div>
                </div>
                <div class="sidenav_container">
                <div class="sidenav_contents">
                <a href="../index.php" class="sidenav_link" >
        <div class="sidenav_icons" data-title="Dashboard">
            <i class="fa fa-line-chart" aria-hidden="true"></i>
        </div>
    </a>

    <a href="income_summary.php" class="sidenav_link">
        <div class="sidenav_icons" data-title="Income Summary">
            <i class="fa fa-university" aria-hidden="true"></i>
        </div>
    </a>

    <a href="inventory.php" class="sidenav_link">
        <div class="sidenav_icons" data-title="Inventory">
            <i class="fa fa-archive" aria-hidden="true"></i>
        </div>
    </a>

    <a href="manage_users.php" class="sidenav_link">
        <div class="sidenav_icons" data-title="User Manager">
            <i class="fa fa-user-circle" aria-hidden="true"></i>
        </div>
    </a>

    <a href="company_setup.php" class="sidenav_link">
        <div class="sidenav_icons" data-title="Company Setup">
            <i class="fa fa-tasks" aria-hidden="true"></i>
        </div>
    </a>

    <a href="files.php" class="sidenav_link">
        <div class="sidenav_icons" data-title="Company Files">
            <i class="fa fa-folder" aria-hidden="true"></i>
        </div>
    </a>
</div>
                </div>                
            </div>

            <div class="main_wrapper">
                Section 2
            </div>

        </div>

</section>

<section>
        <?php
            //Footer section
            require '../footer.php';
        ?>
</section>

<script type="text/javascript" src="../js/sidenav_handler.js"></script>
</body>
</html>