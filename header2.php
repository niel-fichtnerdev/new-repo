
<header>
<div class="wrapper">
    <?php
        $system_environment = 'demo'; // 'live' for production
        $version = 'V1.0.0.30';
        $version_type = 'Alpha.1 (Initial Release)';

        if($system_environment === 'dev'){
           echo "<div class='system'>";
           $system_mode = 3;
           if($system_mode === 1){
               echo '<p>Development Environment '.$version.' -' .$version_type.'</p>';
           }
           elseif($system_mode === 2){
               echo '<p>Staging Environment '.$version.' -' .$version_type.'</p>';
           }
           elseif($system_mode === 3){
               echo '<p>Test Environment '.$version.' -' .$version_type;
           }
           elseif($system_mode === 4){
               echo '<p>UAT Environment '.$version.' -' .$version_type.'p>';
           }
           elseif($system_mode === 5){
               echo '<p><b>Production Replica</b> '.$version.' -' .$version_type.'</p>';
           }
           echo "</div>";
        }
        elseif($system_environment === 'demo'){
            echo "<div class='system'>";
            echo '<p id="falias2"></p>'.'<p id="fversion2"> </p>'.'&nbsp;<p style="color:red" id="timeleft2"></p>';
            echo "</div>";
        }
        else{
            echo "";
        }
    ?>

    <div class="header">
        <div class="row">
            <div class="left">
                <div class="fcompany">
                    <h4 id="companyheader2"></h4>
                </div>
                <div class="time-container">
                    <p id="currentTime"></p>
                </div>        
            </div>
            <div class="right">
                <div class="profile">
                    <button class="btn_notif">
                        <div class="notification_pane">
                            <i class="fa fa-inbox" aria-hidden="true"> </i>
                                <p><span style="color: #ff3300"><!-- Number of notifications Goes here-->3</span> Notifications</p>
                        </div>  
                    </button>
                    <div class="profile_name">
                        <p>Admin</p>
                    </div>
                    <div class="profile_main">
                        <div class="profile_img">
                            <img src="img/placeholder_img.jpg">
                        </div>
                        
                        <div class="dropdown">
                            <button class="dropbtn">&nbsp</button>
                            <div class="dropdown-content">
                                <a id="open-profile"><i class="fa fa-user" aria-hidden="true"></i>
 Profile</a>
                                <a id="open-settings" href="#Settings"><i class="fa fa-cogs" aria-hidden="true"></i> Settings</a>
                                <a id="open-logout" href="#Logout"><i class="fa fa-sign-out" aria-hidden="true"></i>
 Logout</a>
                            </div>                            
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</header>

<script type= text/javascript>
    function toggleDropdown() {
    var dropdownMenu = document.getElementById('dropdownMenu');
    dropdownMenu.classList.toggle('show');
}
</script>