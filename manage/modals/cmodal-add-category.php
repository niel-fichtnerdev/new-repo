<!-- Add Category -->

<script>
    
    $(document).ready(function () {
        $("#categadd").submit(function (event) {
            event.preventDefault();

            // Get the form data as an object
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "datacenter.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    alert(response);
                    location.reload();

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
                        <h2>Add Category</h2>
                    </div>
                    <div class="cmain">      
                        <!-- CONTENT HERE -->
                        <form action="" id="categadd" class="modal-form" enctype="multipart/form-data">
                            <div class="input-text">
                                <label>Category ID <span style="color:red;">*</span> :</label>
                                <input type="text" name="addcategorry" value="1" hidden>
                                <input type="text" name="fcategoryid" class="input-id" placeholder="Enter / Generate ID">
                                <button class="input-btn" type="button">Generate</button>
                            </div>

                            <div class="input-text">
                                <label>Category Thumbnail :</label>
                                <input type="text" name="addcategorry" value="1" hidden>
                                <input type="file" name="categoryimage">
                            </div>

                            <div class="input-text">
                                <label>Category Name <span style="color:red;">*</span> :</label>
                                <input type="text" name="fcategoryname" placeholder="Enter Category Name">
                            </div>

                            <div class="input-textarea">
                                <label>Category Description :</label>
                                <textarea name="fcategorydesc" cols="30" rows="10" placeholder="Enter Category Description"></textarea>
                            </div>

                            <div class="input-text">
                                <label>Category Tag <span style="color:red;">*</span> :</label>
                                <input type="text" name="fcategorytag" placeholder="Enter Tag Name">
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


























