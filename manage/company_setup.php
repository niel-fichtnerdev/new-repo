<?php

session_start();

if (isset($_SESSION['companyid'])) {
    
} else {
    header("location: ../welcome");
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

    <link rel="stylesheet" href="../css/csetup.css">
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

    <title>Company Setup</title>
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
        <!-- ## NOTIFICATION MODAL ## -->

        <div class="modal_section" id="open_notification">
            <?php
            require '../modal_class.php';
            ?>

        </div>

        <!-- ## USER MODAL ## -->
        <div class="modal_section2" id="open_user">
            <?php
            require 'cmodal.php';
            ?>
        </div>

        <div class="modal_section2" id="view_terminals">
            <?php
            require 'modals/cmodal-terminal-master.php';
            ?>
        </div>

        <div class="modal_section2" id="add_terminal_modal">
            <?php
            require 'modals/cmodal-add-terminal.php';
            ?>
        </div>


    </section>
    <section>
        <!-- ### MAIN SECTION ###-->

        <div class="main-container">
            <div class="main_wrapper2">
                <div class="main2">
                    <div class="content">
                        <div class="content_header">
                            <div class="header-title">
                                <h3 id="companyname"></h3> 
                            </div>
                            <div class="header-param">
                                <div class="param">
                                    <p></p>
                                </div>
                                <div class="search-bar">
                                    <div class="search-box">
                                        <form action="" class="search-form">
                                            <p>&nbsp;</p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-section">
                                <div class="delete-add">
                                    <!-- #### ADD BUTTONS HERE ####-->
                                    <button id="open_terminal" class="btn-success">
                                        Terminal Master</button>
                                    <button id="add_terminals" class="btn-success"><i class="fa fa-plus"
                                            aria-hidden="true"></i>
                                        Add Terminal</button>


                                </div>
                                <div class="filter-by">
                                    <form action="">
                                        <p></p>
                                    </form>
                                </div>
                            </div>

                        </div>

                        <div class="main_content">
                            <div class="csetup_container">
                                <?php
                                    //require "appserv/classes/view.class.php";
                                    require_once 'getcompany.php';
                                ?>
                            </div>

                        </div>

                        <div class="content_footer">
                            <!-- Pagination and number of rows shown -->
                            <div class="footer-container">
                                <div class="no_rows">
                                <p class="p-success" id="licenseto"></p>

                                </div>
                                <div class="pagination_container">
                                    -<button class="btn2"><b>EULA</b></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidenav_container">
                    <div class="sidenav_contents">
                        <a href="../" class="sidenav_link">
                            <div class="sidenav_icons" data-title="Dashboard">
                                <i class="fa fa-line-chart" aria-hidden="true"></i>
                            </div>
                        </a>

                        <a href="income_summary" class="sidenav_link">
                            <div class="sidenav_icons" data-title="Income Summary">
                                <i class="fa fa-university" aria-hidden="true"></i>
                            </div>
                        </a>

                        <a href="inventory" class="sidenav_link">
                            <div class="sidenav_icons" data-title="Inventory">
                                <i class="fa fa-archive" aria-hidden="true"></i>
                            </div>
                        </a>

                        <a href="manage_users" class="sidenav_link">
                            <div class="sidenav_icons" data-title="User Manager">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                            </div>
                        </a>

                        <a href="company_setup" class="sidenav_link">
                            <div class="sidenav_icons" data-title="Company Setup">
                                <i class="fa fa-tasks" aria-hidden="true"></i>
                            </div>
                        </a>

                            <!--
                        <a href="files.php" class="sidenav_link">
                            <div class="sidenav_icons" data-title="Company Files">
                                <i class="fa fa-folder" aria-hidden="true"></i>
                            </div>
                        </a>
                            -->
                    </div>
                </div>
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
    <script type="text/javascript" src="../js/table_contr.js"></script>
    <script type="text/javascript" src="../js/modal_handler.js"></script>
</body>

</html>