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

    <!--### Chart JS Plugin / API ###-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation"></script>
    <link rel="icon" type="image/png" href="img/syspos-small.png">

    <!-- ############ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/jquery-table2excel@1.1.1/dist/jquery.table2excel.min.js"></script>

    <!--https://fontawesome.com/v4/icons/-->

    <title>User Manager</title>
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

        <div class="modal_section2" id="open_usermodal">
            <?php
            require 'modals/cmodal-add-users.php';
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
                                <h3>Account Master</h3>
                            </div>
                            <div class="header-param">
                                <div class="param">
                                    <p></p>
                                </div>
                                <div class="search-bar">
                                    <?php
                                    if (isset($_GET['search'])) {
                                        $value = $_GET['search'];
                                    } else {
                                        $value = "";
                                    }
                                    ?>
                                    <div class="search-box">
                                        <form action="manage_users.php" class="search-form">
                                            <input type="text" value="<?= $value ?>" placeholder="Search..."
                                                name="search" ;>
                                            <input type="text" hidden name="page" value="1">
                                            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-section">
                                <div class="delete-add">
                                    <button id="add_users" class="btn-success"><i class="fa fa-plus"
                                            aria-hidden="true"></i>
                                        Add</button>
                                    <button class="btn-success" id="create_excel" name="create_excel"><i
                                            class="fa fa-table" aria-hidden="true"></i>
                                        Excel</button>
                                    <button class="btn-danger" id="deleteuser"><i class="fa fa-trash"
                                            aria-hidden="true"></i>
                                        Delete</button>
                                </div>
                                <div class="filter-by">

                                    <form action="">
                                        <label>Add filter</label>
                                        <select name="filterby" id="#";>
                                            <option value="any">Any</option>
                                            <option value="seller">sellers</option>
                                            <option value="admin">Admins</option>
                                            <option value="supervisor">Supervisors</option>
                                            <option value="manager">Managers</option>
                                            <option value="owner">Owner/s</option>
                                        </select>
                                        <button type="submit">Apply</button>
                                    </form>

                                </div>
                            </div>

                        </div>

                        <div class="main_content">
                            <!DOCTYPE html>
                            <html lang="en">

                            <head>
                                <meta charset="UTF-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <title>Data Table</title>
                            </head>

                            <body>
                                <table class="standard_table" id="userTable">
                                    <tr>
                                        <th>
                                            <span><input type="checkbox" id="masterCheckbox"></span>
                                        </th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Added by</th>
                                        <th>Updated date</th>
                                        <th>Edit</th>
                                    </tr>
                                    <tr>
                                        <?php
                                        //require "appserv/classes/view.class.php";
                                        
                                        if (isset($_GET['search'])) {
                                            require_once "datacenter.php";
                                        } else {
                                            require_once "getData.php";
                                        }
                                        if (isset($_GET['filterby'])) {
                                            require_once "datacenter.php";
                                        } else {
                                            require_once "getData.php";
                                        }
                                        
                                        ?>

                                    </tr>
                                </table>

                            </body>

                            </html>

                        </div>

                        <div class="content_footer">
                            <!-- Pagination and number of rows shown -->
                            <div class="footer-container">
                                <div class="no_rows">
                                    <?php //echo $pagination->createLinks();
                                    //echo $pagelink;
                                    $table = 'mst_account';
                                    $perpage = 10;
                                    $ini = new view($perpage);
                                    $ini->displayinfo($table);
                                    ?>

                                </div>
                                <div class="pagination_container" id="Pagination">
                                    <?php
                                    if (isset($_GET['search'])) {
                                        $search = $_GET['search'];
                                        ?>
                                        <form action="manage_users.php">
                                            <input name="search" type="text" hidden value="<?= $search ?>">
                                            <ul>
                                                <?php //echo $pagination->createLinks();
                                                    //echo $pagelink;
                                                    $table = 'mst_account';
                                                    $url = 'manage_users';
                                                    $perpage = 10;
                                                    $ini = new view($perpage);
                                                    $ini->createpagi_link($table, $url);
                                                    ?>
                                            </ul>
                                        </form>
                                        <?php
                                    } elseif (isset($_GET['filterby'])) {
                                        $filterby = $_GET['filterby'];
                                        ?>
                                        <form action="manage_users.php">
                                            <input name="filterby" type="text" hidden value="<?= $filterby ?>">
                                            <ul>
                                                <?php //echo $pagination->createLinks();
                                                    //echo $pagelink;
                                                    $perpage = 10;
                                                    $url = 'manage_users';
                                                    $table = 'mst_account';
                                                    $ini = new view($perpage);
                                                    $ini->createpagi_link($table, $url);
                                                    ?>
                                            </ul>
                                        </form>
                                        <?php
                                    } else {
                                        ?>
                                        <form action="manage_users.php">
                                            <ul>
                                                <?php //echo $pagination->createLinks();
                                                    //echo $pagelink;
                                                    $table = 'mst_account';
                                                    $perpage = 10;
                                                    $url = 'manage_users';
                                                    $ini = new view($perpage);
                                                    $ini->createpagi_link($table, $url);
                                                    ?>
                                            </ul>
                                        </form>
                                        <?php
                                    }

                                    ?>

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