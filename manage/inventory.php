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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap');
    </style>
    <link rel="stylesheet" href="../css/modal_styler.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-table2excel@1.1.1/dist/jquery.table2excel.min.js"></script>

    
    
    
    

    <!--https://fontawesome.com/v4/icons/-->

    <title>Inventory</title>
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
        <div class="modal_section2" id="open_addproduct">
            <?php
            require 'modals/cmodal-add-product.php';
            ?>
        </div>

        <div class="modal_section2" id="open_addcategory">
            <?php
            require 'modals/cmodal-add-category.php';
            ?>
        </div>

        <div class="modal_section2" id="open_requeststock">
            <?php
            require 'modals/cmodal-request-stock.php';
            ?>
        </div>

        <div class="modal_section2" id="open_viewproduct">
            <?php
            require 'modals/cmodal-view-product.php';
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
                                <h3>Inventory Management</h3>
                            </div>
                            <div class="header-param">
                                <div class="param">
                                    <p></p>
                                </div>
                                <div class="search-bar">
                                <?php
                                    if (isset($_GET['sproduct'])) {
                                        $value = $_GET['sproduct'];
                                    } else {
                                        $value = "";
                                    }
                                    ?>
                                    <div class="search-box">
                                        <form action="inventory" class="search-form">
                                            <input type="text" value="<?= $value ?>" placeholder="Search..."
                                                name="sproduct" ;>
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
                                    <button id="add_product" class="btn-success"><i class="fa fa-plus"
                                            aria-hidden="true"></i>
                                        Add Product</button>
                                    <button id="add_category" class="btn-success"><i class="fa fa-plus"
                                            aria-hidden="true"></i>
                                        Add Category</button>
                                    <button class="btn-success" id="product_create_pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                        PDF</button>
                                    <button id="product_create_excel" class="btn-success"><i class="fa fa-table" aria-hidden="true"></i>
                                        Excel</button>
                                    <button id="request_stock" class="btn-success"><i class="fa fa-list-alt"
                                            aria-hidden="true"></i>
                                        Request stock</button>
                                        <button class="btn-danger" id="deleteproduct"><i class="fa fa-trash"
                                            aria-hidden="true"></i>
                                        Delete</button>

                                </div>
                                <div class="filter-by">
                                    <form action="inventory">
                                        <label>Add filter</label>
                                        <select name="sfilterby" id="#">
                                            <option value="any">Any</option>
                                            <option value="new">Newly Added</option>
                                            <option value="instock">In stock</option>
                                            <option value="low">Low</option>
                                            <option value="outstock">Out of stock</option>
                                        </select>

                                        <select name="szcategory" id="new_select3" onchange="fetch_select(this.value);">
                                            <option value="any">Category - Any</option>
                                            <option value="uncategorized">Uncategorized</option>
                                            <option value="CAT001">CATEGORY 1</option>
                                        </select>
                                        <button type="submit">Apply</button>
                                    </form>
                                </div>
                            </div>

                        </div>

                        <div class="main_content">
                            <table class="standard_table" id="productTable">
                                <tr>
                                    <th>
                                        <span><input type="checkbox" id="masterCheckbox"></span>
                                    </th>
                                    <th>Thumbnail</th>
                                    <th>Product ID</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Stock count</th>
                                    <th>Status</th>
                                    <th>updated date</th>
                                    <th>Modify</th>
                                </tr>
                                <tr>
                                    <?php
                                    //require "appserv/classes/view.class.php";
                                    
                                    if (isset($_GET['sproduct']) && isset($_GET['page'])) {
                                        require_once "datacenter.php";
                                    } else {
                                        require_once "getInventory.php";
                                    }

                                    if (isset($_GET['sfilterby']) && isset($_GET['szcategory'])) {
                                        require_once "datacenter.php";
                                    } else {
                                        require_once "getInventory.php";
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
                                    


                                    if(isset($_GET['sproduct'])){
                                        $table = 'mst_product AS p 
                                        JOIN 
                                            mst_product_category AS c 
                                            ON p.fcategory_id = c.fcategoryid 
                                        JOIN 
                                            sm_company AS comp 
                                            ON p.fcompanyid = comp.fcompanyid 
                                            AND c.fcompanyid = comp.fcompanyid';
                                    }
                                    
                                    elseif (isset($_GET['sfilterby']) && isset($_GET['szcategory'])){
                                        $table = 'mst_product AS p 
                                        JOIN 
                                            mst_product_category AS c 
                                            ON p.fcategory_id = c.fcategoryid 
                                        JOIN 
                                            sm_company AS comp 
                                            ON p.fcompanyid = comp.fcompanyid 
                                            AND c.fcompanyid = comp.fcompanyid';
                                    }
                                    else{
                                        $table = 'mst_product AS p 
                                        JOIN 
                                            mst_product_category AS c 
                                            ON p.fcategory_id = c.fcategoryid 
                                        JOIN 
                                            sm_company AS comp 
                                            ON p.fcompanyid = comp.fcompanyid 
                                            AND c.fcompanyid = comp.fcompanyid WHERE comp.factive_flag="1"';
                                    }    
                                    $perpage = 10;
                                    $ini = new view($perpage);
                                    $ini->displayinfo($table);
                                    ?>

                                </div>
                                <div class="pagination_container" id="Pagination_inventory">
                                <?php
                                    if (isset($_GET['sproduct'])) {
                                        $search = $_GET['sproduct'];
                                        ?>
                                        <form action="inventory.php">
                                            <input name="sproduct" type="text" hidden value="<?= $search ?>">
                                            <ul>
                                                <?php //echo $pagination->createLinks();
                                                    //echo $pagelink;
                                                    $table = 'mst_product AS p 
                                                    JOIN 
                                                        mst_product_category AS c 
                                                        ON p.fcategory_id = c.fcategoryid 
                                                    JOIN 
                                                        sm_company AS comp  
                                                        ON p.fcompanyid = comp.fcompanyid 
                                                        AND c.fcompanyid = comp.fcompanyid';
                                                    $url = 'inventory';
                                                    $perpage = 10;
                                                    $ini = new view($perpage);
                                                    $ini->createpagi_link($table, $url);
                                                    ?>
                                            </ul>
                                        </form>
                                        <?php
                                    } elseif (isset($_GET['sfilterby']) && isset($_GET['szcategory'])) {
                                        $filterby = $_GET['sfilterby'];
                                        $category = $_GET['szcategory'];
                                        ?>
                                        <form action="inventory.php">
                                            <input name="sfilterby" type="text" hidden value="<?= $filterby ?>">
                                            <input name="szcategory" type="text" hidden value="<?= $category ?>">
                                            <ul>
                                                <?php //echo $pagination->createLinks();
                                                    //echo $pagelink;
                                                    $perpage = 10;
                                                    $url = 'inventory';
                                                    $table = 'mst_product AS p 
                                        JOIN 
                                            mst_product_category AS c 
                                            ON p.fcategory_id = c.fcategoryid 
                                        JOIN 
                                            sm_company AS comp 
                                            ON p.fcompanyid = comp.fcompanyid 
                                            AND c.fcompanyid = comp.fcompanyid';
                                                    $url = 'inventory';
                                                    $ini = new view($perpage);
                                                    $ini->createpagi_link($table, $url);
                                                    ?>
                                            </ul>
                                        </form>
                                        <?php
                                    } else {
                                        ?>
                                        <form action="inventory.php">
                                            <ul>
                                                <?php //echo $pagination->createLinks();
                                                    //echo $pagelink;
                                                    $table = 'mst_product AS p 
                                                    JOIN 
                                                        mst_product_category AS c 
                                                        ON p.fcategory_id = c.fcategoryid 
                                                    JOIN 
                                                        sm_company AS comp 
                                                        ON p.fcompanyid = comp.fcompanyid 
                                                        AND c.fcompanyid = comp.fcompanyid WHERE comp.factive_flag="1"	';
                                                    $url = 'inventory';
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
    <script type="text/javascript" src="../js/pdf/jspdf.js"></script>
</body>

</html>