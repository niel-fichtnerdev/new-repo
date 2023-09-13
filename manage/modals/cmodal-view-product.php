<!-- View Products -->

<script>
    $(document).ready(function () {
        $("#modifyproduct").submit(function (event) {

            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "datacenter.php",
                data: formData,
                success: function (response) {
                    alert(response);
                    location.reload();
                },
            });
        });
    });
</script>


<div class="cmodal_wrapper" id="edit-product">
    <div class="cmodal_container">
        
              <!-- Modal content -->
                <div class="ccontent">
                    <div class="close_bar">
                        <span class="c-close">&times;</span>
                    </div>
                    
                    <div class="ctitle">
                        <h2>Product</h2>
                    </div>
                    <div class="cmain">      
                        <!-- CONTENT HERE -->
                        <div class="cmain-content">
                            <div class="left-content">
                                <form action="#" class="modal-form" id="modifyproduct">
                                    <div class="input-text">
                                    <input type="text" name="modifyproduct" value="1" hidden>
                                        <label>Product ID :</label>
                                        <input type="text" id="fproductid" class="input-id" disabled>
                                        <input type="text" name="fproductid" id="fproductidclass" hidden>
                                    </div>

                                    <div class="input-text">
                                        <label>Product Name <span style="color:red;">*</span> :</label>
                                        <input type="text" name="fproductname" id="fproductname">
                                    </div>

                                    <div class="input-textarea">
                                        <label>Product Description :</label>
                                        <textarea name="fproductdesc" id="fpdescription" cols="30" rows="10"></textarea>
                                    </div>

                                    <div class="input-text">
                                        <label>Product Expiry :</label>
                                        <input type="date" id="fpexpiry" name="fproductexpiry">
                                    </div>

                                    <div class="input-text">
                                        <label>Previous Price :</label>
                                        <input type="number" id="fprev" name="fproductprev" disabled>
                                    </div>

                                    <div class="input-text">
                                        <label>Standard Price <span style="color:red;">*</span> :</label>
                                        <input type="number" id="fcost" min="0" max="1000" step="0.001" name="fproductprice">
                                    </div>

                                    <div class="input-text">
                                        <label>Tax type <span style="color:red;">*</span> :</label>
                                        <select id="ftaxtype" name="fproducttaxtype">
                                            <option value="A">Inclusive</option>
                                            <option value="B">Exclusive</option>
                                            <option value="C">No Tax</option>
                                        </select>
                                    </div>

                                    
                                    <div class="input-text">
                                        <label>Product UOM <span style="color:red;">*</span> :</label>
                                        <select id="fpuom" name="fproductuom">
                                            <option value="pieces">Pieces</option>
                                            <option value="box">box</option>
                                            <option value="pack">pack</option>
                                        </select>
                                    </div>



                                    <div class="input-text">
                                        <label>Product Category: </label>
                                        <select name="fproductcategory" id="selectcategory" onchange="fetch_select(this.value);">
                                        </select>
                                    </div>
                                    

                                    <div class="input-text">
                                        <label>Product Tag: </label>
                                        <input type="text" id="fptag" name="fproducttag">
                                    </div>

                                    <div class="input-textarea">
                                        <label>Memo :</label>
                                        <textarea name="fproductmemo" id="fpmemo" cols="30" rows="10"></textarea>
                                    </div>

                                    <div class="input-text">
                                        <label>Product Active: </label>
                                        <select id="fpactive" name="fproductactive">
                                            <option value="Y">Active</option>
                                            <option value="N">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="input-text">
                                        <label>Sale this product: </label>
                                        <select id="fpsale" name="fsaleproduct">
                                            <option value="Y">Yes</option>
                                            <option value="N">No</option>
                                        </select>
                                    </div>

                                    <div class="input-text">
                                        <label>Created by: </label>
                                        <input type="text" id="fpcreatedby" name="fprodcreatedby" disabled>
                                    </div>

                            </div>
                            <div class="right-content">

                                    <div class="input-text2">
                                        <h3>Status: <input type="text" id="fpstatus" disabled></h3>
                                    </div>

                                    <div class="input-text2">
                                        <label>Stock left:  </label>
                                        <input type="text" id="fpstock" name="fproductstock" disabled>
                                    </div>

                                    <div class="input-text2">
                                        <label>Add Stock:  </label>
                                        <input type="text" id="fpaddstock" name="faddstock" >
                                    </div>

                                    <div class="input-text2">
                                        <label>Updated by:  </label>
                                        <input type="text" id="fpupdatedby" name="fstockupdatedby" disabled>
                                    </div>

                                    <div class="input-text2">
                                        <label>Updated Date:  </label>
                                        <input type="text" id="fpupdateddate" name="fstockupdateddate" disabled>
                                    </div>

                            </div>
                        </div>
                    </div>
                    <div class="cfooter">
                        <button type="submit" class="submit-button" id="modal_close"><i class="fa fa-check" aria-hidden="true"></i>

Add </button>
            </form>
                        <button type="button" class="cbutton"><i class="fa fa-times" aria-hidden="true"></i>
Cancel</button>
                
                    </div>
                    
                </div>
        </div>
    
</div>
