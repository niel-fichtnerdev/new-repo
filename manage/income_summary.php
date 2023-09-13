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

    <link rel="stylesheet" href="../css/loader_style.css">
    <link rel="stylesheet" href="../css/user_manager.css">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery-table2excel@1.1.1/dist/jquery.table2excel.min.js"></script>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap');
    </style>
    <link rel="stylesheet" href="../css/modal_styler.css">
    
    <!--https://fontawesome.com/v4/icons/-->

    <title>Income Summary</title>
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

        <!-- ## Income MODAL ## -->
        <div class="modal_section2" id="income_modal">
            <?php
            require 'modals/cmodal-income.php';
            ?>
        </div>

        <div class="modal_section2" id="transaction_modal">
            <?php
            require 'modals/cmodal-transactions.php';
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
                                <h3>Sales Summary</h3>
                            </div>
                            <div class="header-param">
                                <div class="param">
                                    <p></p>
                                </div>
                                <div class="search-bar">
                                    <div class="search-box">
                                        <form action="" class="search-form">
                                            <input type="date" placeholder="Search..." name="ftrxdate" id="ftrxdate">
                                            <input type="text" hidden name="page" value="1">
                                            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search
</button>
                                        </form> 
                                    </div>
                                </div>
                            </div>
                            <div class="filter-section">
                                <div class="delete-add">
                                    <!-- #### ADD BUTTONS HERE ####-->
                                    <button class="btn-success" id="sales_pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
 PDF</button>
                                    <button class="btn-success" id="sales_excel"><i class="fa fa-table" aria-hidden="true"></i>
 Excel</button>
 <button id="open_transactions" class="btn-success"><i class="fa fa-list" aria-hidden="true"></i>
 Todays Transactions</button>
                                </div>
                                <div class="filter-by">
                                    <form action="">
                                        <label>Add filter</label>
                                        <select name="ffilterby" id="#">
                                            <option value="any">Any</option>
                                            <option value="weekly">Weekly</option>
                                            <option value="monthly">Monthly</option>
                                            <option value="yearly">Yearly</option>
                                        </select>
                                        <select name="fterminal">
                                            <option value="0001">0001 - Main</option>
                                        </select>
                                        <button type="submit">Apply</button>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="main_content">
                            <table class="standard_table" id="salestable">
                                <tr>
                                    <th>
                                        <span><input type="checkbox" id="masterCheckbox"></span>
                                    </th>
                                    <th>Z-Counters</th>
                                    <th>TM#</th>
                                    <th>Date</th>
                                    <th>Total Trx</th>
                                    <th>Total Sales</th>
                                    <th>Taxable Sales</th>
                                    <th>Present NRGT</th>
                                    <th>Previous NRGT</th>
                                    <th>View</th>
                                </tr>
                                <tr>
                                    <?php
                                    //require "appserv/classes/view.class.php";
                                    
                                    if (isset($_GET['ftrxdate']) && isset($_GET['page'])) {
                                        require_once "datacenter.php";
                                    } else {
                                        require_once "getincome.php";
                                    }

                                    if (isset($_GET['ffilterby']) && isset($_GET['fterminal'])) {
                                        require_once "datacenter.php";
                                    } else {
                                        require_once "getincome.php";
                                    }

                                    ?>
                                </tr>

                            </table>
                        </div>
                        
                        <div class="content_footer">
                            <!-- Pagination and number of rows shown -->
                            <div class="footer-container">
                                <div class="no_rows">
                                <?php
                                    $table = 'pos_reading as a JOIN sm_company as b ON a.fcompanyid = b.fcompanyid WHERE b.factive_flag="1"';
                                    $perpage = 10;
                                    $ini = new view($perpage);
                                    $ini->displayinfo($table);
                                ?>
                                </div>
                                
                                <div class="pagination_container" id="Pagination_income">
                                <?php
                                    if (isset($_GET['ftrxdate'])) {
                                        $search = $_GET['ftrxdate'];
                                        ?>
                                        <form action="income_summary">
                                            <input name="ftrxdate" type="text" hidden value="<?= $search ?>">
                                            <ul>
                                                <?php //echo $pagination->createLinks();
                                                    //echo $pagelink;
                                                    $table = 'pos_reading as a JOIN sm_company as b ON a.fcompanyid = b.fcompanyid';
                                                    $url = 'income_summary';
                                                    $perpage = 10;
                                                    $ini = new view($perpage);
                                                    $ini->createpagi_link($table, $url);
                                                    ?>
                                            </ul>
                                        </form>
                                        <?php
                                    } elseif (isset($_GET['ffilterby']) && isset($_GET['fterminal'])) {
                                        $filterby = $_GET['ffilterby'];
                                        $category = $_GET['fterminal'];
                                        ?>
                                        <form action="income_summary">
                                            <input name="ffilterby" type="text" hidden value="<?= $filterby ?>">
                                            <input name="fterminal" type="text" hidden value="<?= $category ?>">
                                            <ul>
                                                <?php //echo $pagination->createLinks();
                                                    //echo $pagelink;
                                                    $perpage = 10;
                                                    $url = 'income_summary';
                                                    $table = 'pos_reading as a JOIN sm_company as b ON a.fcompanyid = b.fcompanyid';
                                                    $ini = new view($perpage);
                                                    $ini->createpagi_link($table, $url);
                                                    ?>
                                            </ul>
                                        </form>
                                        <?php
                                    } else {
                                        ?>
                                        <form action="income_summary">
                                            <ul>
                                                <?php //echo $pagination->createLinks();
                                                    //echo $pagelink;
                                                    $table = 'pos_reading as a JOIN sm_company as b ON a.fcompanyid = b.fcompanyid WHERE b.factive_flag="1"';
                                                    $url = 'income_summary';
                                                    $perpage = 10;
                                                    $ini = new view($perpage);
                                                    $ini->createpagi_link($table,$url);
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
    <a href="../" class="sidenav_link" >
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