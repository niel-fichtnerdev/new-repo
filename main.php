<div class="main-container">
            <div class="main_wrapper">
                <div class="main">
                    <div class="main_content">
                        <div class="the_title">
                            <!-- Title Goes Here -->
                            <h3>Dashboard</h3>
                            <p>Sales Summary Report</p>
                        </div>
                        <div class="the_content">
                            <!-- Content Goes Here -->
                            <?php
                            require 'graphs_report.php';
                            ?>
                        </div>
                        <div class="the_footer">
                            <!-- footer Goes Here -->
                            <p>Sales Summary Dashboard as of <?php echo date('jS \of F Y');?></p>

                        </div>
                    </div>
                </div>
                <div class="sidenav_container">
            <div class="sidenav_contents">
    <a href="./" class="sidenav_link" >
        <div class="sidenav_icons" data-title="Dashboard">
            <i class="fa fa-line-chart" aria-hidden="true"></i>
        </div>
    </a>

    <a href="manage/income_summary" class="sidenav_link">
        <div class="sidenav_icons" data-title="Income Summary">
            <i class="fa fa-university" aria-hidden="true"></i>
        </div>
    </a>

    <a href="manage/inventory" class="sidenav_link">
        <div class="sidenav_icons" data-title="Inventory">
            <i class="fa fa-archive" aria-hidden="true"></i>
        </div>
    </a>

    <a href="manage/manage_users" class="sidenav_link">
        <div class="sidenav_icons" data-title="User Manager">
            <i class="fa fa-user-circle" aria-hidden="true"></i>
        </div>
    </a>

    <a href="manage/company_setup" class="sidenav_link">
        <div class="sidenav_icons" data-title="Company Setup">
            <i class="fa fa-tasks" aria-hidden="true"></i>
        </div>
    </a>

    <!--
    <a href="manage/files.php" class="sidenav_link">
        <div class="sidenav_icons" data-title="Company Files">
            <i class="fa fa-folder" aria-hidden="true"></i>
        </div>
    </a>
    -->
</div>
                </div>                
            </div>
            <!--
            <div class="main_wrapper">
                Section 2
            </div>
            !-->
        </div>