
<?php
session_start();

if(isset($_SESSION['user'])){
    // Your authenticated content here
} else {
    header("location: login");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" type="image/png" href="img/syspos-small.png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap');
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!--https://fontawesome.com/v4/icons/-->
    <title>SYSPOS</title>
</head>
<body>
    <div class="main-container">
        <div class="header-container">
            <div class="wrapper fcenter fbetween">
                <div class="left fleft">
                    <!-- LEFT CONTENT -->
                    <div class="company-info">
                        <h3 id="companyname">XAMAL GROUP INC.</h3>
                    </div>
                </div>
                <div class="right fright">
                    <!-- RIGHT CONTENT -->
                    <div class="userinfo">
                        <p><b>Admin</b> </p>
                        <div class="profile-pic">
                            <img src="../manage/img/placeholder_img.jpg">
                        </div>
                        <nav class="dropdown">
                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                            <ul class="dropdown-content">
                                <li><a href="" id="profile">Profile <i class="fa fa-user" style="color:black;" aria-hidden="true"></i>
</a></li>
                                <li><a href="../" id="management">Management <i class="fa fa-list-alt" style="color:black;" aria-hidden="true"></i>
</a></li>
                                <li><a href="" id="zreading">z-reading <i class="fa fa-check-square" style="color:black;" aria-hidden="true"></i></a></li>
                                
                                <li><a href="" id="logout">Logout <i class="fa fa-sign-out" style="color:black;" aria-hidden="true"></i></a></li>
                                
                            </ul>
                        </nav>
                    </div>
                    <div class="menu">
                        
                    </div>

                </div>
            </div>
        </div>

        <div class=".modal_section2">
            <?php
                require_once 'modaldialogs.php';
            ?>
        </div>

        <div class="body-container">
            <div class="wrapper fbetween">
                <div class="left">
                    <!-- LEFT CONTENT FOR PRODUCTS DISLAY-->
                    <div class="product-browser">
                        <div class="product-header fbetween">
                            
                            <div class="hcontent-left">
                                <!-- LEFT SIDE-->
                                
                            </div>

                            <div class="hcontent-right">
                                <div class="psearch-container">
                                    <form>
           
                                    <input type="text" placeholder="Search Product" name="search">
                                    <button type="submit">Search</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="browser-tab">
                            <div class="gallery-links"> <!-- FETCH CONTENT INSIDE HERE-->
                            
                            <?php
                                require_once '../getproducts.php';
                            ?>

                            
                            </div>


                        </div>
                        
                    </div>
                    <div class="category">
                        <div class="category-container">
                            <div class="category-content">
                                <?php
                                require_once '../getcategories.php';
                                ?>
                            
                            </div>

                        </div>
                    </div>
                </div>
                <div class="right">
                    <!-- RIGHT CONTENT FOR INFOSEC DISLAY-->
                    <div class="right-header">
                        <h4>Checkout</h4>
                    </div>
                    <table class="table-header">
                            <tr>
                                <th>Name&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th>|&nbsp;&nbsp;</th>
                                <th>Quantity&nbsp;&nbsp;</th>
                                <th>|&nbsp;&nbsp;&nbsp;</th>
                                <th>Price&nbsp;&nbsp;&nbsp;&nbsp;</th>

                            </tr>  
                    </table>
                    <div class="table-container">

                        <table class="table-data">
                            <tr>
                                <form action="#">
                                    <?php 
                                    require_once '../getcurrenttrx.php';
                                    ?>
                                </form>
                                    
                            </tr>
                            
                        </table>

                    </div>

                    <div class="payment-info">
                        <div class="discount">
                            <div class="label">Discount</div>
                            <div class="value" id="fdiscount">0.00</div>
                        </div>

                        <div class="subtotal">
                            <div class="label">Subtotal</div>
                            <div class="value" id="fsubtotal">0.00</div>
                        </div>

                        <div class="tax">
                            <div class="label">Tax</div>
                            <div class="value" id="ftax">0.00</div>
                        </div>

                        <div class="total">
                            <div class="label">Total</div>
                            <div class="value" id="ftotal">0.00</div>
                        </div>
                    
                    </div>
                    <div class="settle">
                        <button class="true-btn" id="settle"> Settle <span id="totalcost">(P130.00)</span></button>

                        <button class="cancel-btn" id="void"> Void </button>
                    </div>

                </div>
            </div>
        </div>
        

        <div class="footer-container">
            <div class="wrapper fcenter">
                <div class="center-div fcenter ">
                <p>Copyright © <?php echo date('Y');?>, Jtolentin Development. All Rights Reserved</p>
                </div>
            </div>       
        </div>
    </div>    
    

<script type="text/javascript">
    const galleryItems = document.getElementsByClassName("gallery-img");

    for (let i = 0; i < galleryItems.length; i++) {
        galleryItems[i].addEventListener("click", function() {
            // Remove "clicked" class from all elements
            
            for (let j = 0; j < galleryItems.length; j++) {
                
                galleryItems[j].classList.remove("clicked");
            }
            
            // Add "clicked" class to the clicked element
            galleryItems[i].classList.add("clicked");
        });
    }
</script>

<script type="text/javascript">
    const categoryItems = document.getElementsByClassName("category-label");


    for (let i = 0; i < categoryItems.length; i++) {
        categoryItems[i].addEventListener("click", function() {
            // Remove "clicked" class from all elements
            for (let j = 0; j < categoryItems.length; j++) {
                categoryItems[j].classList.remove("clicked2");
            }
            
            // Add "clicked" class to the clicked element
            categoryItems[i].classList.add("clicked2");
        });
    }
</script>


<script type="text/javascript" src="js/request.js"></script>

</body>
</html>