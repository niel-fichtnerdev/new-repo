<!-- Add Products -->

<script>
    $(document).ready(function () {
        $("#addproductform").submit(function (event) {
            // Prevent the default form submission
            event.preventDefault();

            // Get the form data as an object
            var formData = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "datacenter.php",
                data: formData,
                success: function (response) {
                    // Handle the response from datacenter.php
                    //('#adduserform').html(response);

                    if (response == "Please avoid using special characters in the form") {
                        alert(response);
                    }
                    else {
                        alert(response);
                        $("#adduserform :input").val('');
                        location.reload();
                    }


                },
                error: function (xhr, status, error) {
                    console.error("Error:", error);
                    // Handle the error if the AJAX request fails
                    alert("An error occurred while submitting the data. Please try again later.");
                }
            });
        });
    });
</script>

<div class="cmodal_wrapper" id="add-product">
    <div class="cmodal_container">
        
              <!-- Modal content -->
                <div class="ccontent">
                    <div class="close_bar">
                        <span class="c-close">&#128469;</span>
                    </div>
                    
                    <div class="ctitle">
                        <h2>Add Product</h2>
                    </div>
                    <div class="cmain">      
                        <!-- CONTENT HERE -->
                        <form action="" class="modal-form" id="addproductform">
                            <div class="input-text">
                                <label>Product ID <span style="color:red;">*</span> :</label>
                                <input type="text" name="addproduct" value="1" hidden>
                                <input type="text" name="fproductid" class="input-id" placeholder="Enter / Generate ID">
                                <button class="input-btn" type="button">Generate</button>
                            </div>

                            <div class="input-text">
                                <label>Product Name <span style="color:red;">*</span> :</label>
                                <input type="text" name="fproductname" placeholder="Enter Product Name">
                            </div>

                            <div class="input-textarea">
                                <label>Product Description :</label>

                                <textarea name="fproductdesc" cols="30" rows="10" placeholder="Enter Product Description"></textarea>
                            </div>

                            <div class="input-text">
                                <label>Product Price <span style="color:red;">*</span> :</label>
                                <input type="number" step="0.01" min="0" name="fproductprice" placeholder="P">
                            </div>

                            <div class="input-text">
                                <label>Product Expiry :</label>
                                <input type="date" name="fproductexpiry">
                            </div>

                            <div class="input-text">
                                <label>Product UOM :</label>
                                <select name="fproductuom">
                                    <option value="pieces">Pieces</option>
                                    <option value="box">box</option>
                                    <option value="pack">pack</option>
                                </select>
                            </div>

                            <div class="input-text">
                                <label>Product Warranty :</label>
                                <select name="fproductwarranty">
                                    <option value="no">No warannty</option>
                                    <option value="1">1 Months</option>
                                    <option value="3">3 Months</option>
                                    <option value="6">6 Months</option>
                                    <option value="12">1 Year</option>
                                </select>
                            </div>


                            <div class="input-text">

                                <label>Product Category: </label>
                                <select name="fproductcategory" id="new_select" onchange="fetch_select(this.value);">
                                </select>
                            </div>
                            

                            <div class="input-text">
                                <label>Product Tag: </label>
                                <input type="text" name="fproducttag">
                            </div>

                        
                    </div>
                    <div class="cfooter">
                        <button type="submit" class="submit-button" id="modal_close"><i class="fa fa-check" aria-hidden="true"></i>

Add </button>
            </form>
                        <button type="button" class="cbutton" id="clear-input"><i class="fa fa-times" aria-hidden="true"></i>
Cancel</button>
                
                    </div>
                    
                </div>
        </div>
    
</div>

