<!-- Add Users -->

<script>
    $(document).ready(function () {
        $("#modifyuser").submit(function (event) {
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
                    alert(response);
                    location.reload();


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
                <h2>Modify Account</h2>
            </div>
            <div class="cmain">
                <!-- CONTENT HERE -->
                <form action="datacenter.php" class="modal-form" method="POST" id="modifyuser">

                    <div class="input-text">
                        <input type="text" name="modifyaccount" value="1" hidden>
                    </div>

                    <div class="input-text">
                        <label>User ID <span style="color:red;">*</span> :</label>
                        <input type="text" name="faccountid" class="input-id" id="fuserid" disabled>
                        <input type="text" name="faccountid" id="fuserid2" hidden>
                    </div>

                    <div class="input-text">
                        <label>First Name <span style="color:red;">*</span> :</label>
                        <input type="text" name="ffname" id="fuserfname">
                    </div>

                    <div class="input-text">
                        <label>Last Name <span style="color:red;">*</span> :</label>
                        <input type="text" name="flname" id="fuserlname">
                    </div>

                    <div class="input-text">
                        <label>Middle Name :</label>
                        <input type="text" name="fmname" placeholder="Enter Middle Name" id="fusermname">
                    </div>

                    <div class="input-text">
                        <label>Sex <span style="color:red;">*</span> :</label>
                        <select name="fsex" id="fusersex" disabled>
                            <option value="0">~Select~</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="no">Prefer not say</option>
                        </select>

                        <select name="fsex" id="fusersex2" hidden>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="no">Prefer not say</option>
                        </select>
                    </div>

                    <div class="input-text">
                        <label>Civil Status :</label>
                        <select name="fcivil_status" id="fusercivil">
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="divorced">Divorced</option>
                            <option value="widow">Widowed</option>
                        </select>
                    </div>



                    <div class="input-text">
                        <label>Address</Address> <span style="color:red;">*</span> :</label>
                        <input type="text" name="faddress" id="fuseraddress">
                    </div>

                    <div class="input-text">
                        <label>Email <span style="color:red;">*</span> :</label>
                        <input type="email" name="femail" id="fuseremail">
                    </div>

                    <div class="input-text">
                        <label>Phone <span style="color:red;">*</span> :</label>
                        <input type="text" name="fphone" id="fuserphone">
                    </div>

                    <div class="input-text">
                        <label>Username <span style="color:red;">*</span> :</label>
                        <input type="text" name="fusername" id="fusername">
                    </div>

                    <div class="input-text">
                        <label>Password :</label>
                        <input type="password" name="ftemppassword" class="input-password" id="fuserpassword" disabled>
                        <input type="password" name="foldpassword" class="input-password" id="fuserpassword2" hidden>
                    </div>

                    <div class="input-text">
                        <label>New Password :</label>
                        <input type="password" name="fnewpassword" class="input-password" id="fusernewpassword">
                    </div>

                    <div class="input-text">
                        <label>Birth Date :</label>
                        <input type="date" name="fbirthdate" id="fuserbirth">
                    </div>

                    <div class="input-text">
                        <label>Birth Place <span style="color:red;">*</span> :</label>
                        <input type="text" name="fbirth_place" id="fuserbirthplace">
                    </div>

                    <div class="input-text">
                        <label>Memo :</label>
                        <input type="text" name="fmemo" placeholder="Enter Memo" id="fusermemo">
                    </div>

                    <div class="input-text">
                        <label>Security Question :</label>
                        <input type="text" name="fsecurityquestion" id="fuserquestion" disabled>
                    </div>

                    <div class="input-text">
                        <label>Security Answer :</label>
                        <input type="password" name="fsecurityanswer" id="fuseranswer" disabled>
                    </div>

                    <div class="input-text">
                        <label>Status: </label>
                        <select name="fstatus" id="fuserstatus">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                            <option value="01">Suspend</option>

                        </select>
                    </div>

                    <div class="input-text">
                        <label>Access level: </label>
                        <select name="faccesslvl" id="fuseraccess">
                            <option value="0">~No access~</option>
                            <option value="cashier">cashier</option>
                            <option value="seller">Seller</option>
                            <option value="supervisor">Supervisor</option>
                            <option value="manager">Manager</option>
                            <option value="owner">Owner</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>

                    <div class="input-text">
                        <label>office: </label>
                        <select name="fofficeid" id="fuseroffice">
                            <option value="main">Main</option>
                        </select>
                    </div>

                    <div class="input-text">
                        <label>Added By :</label>
                        <input type="text" name="faddedby" id="fuseraddedby" disabled>
                    </div>

                    <div class="input-text">
                        <label>Added Date :</label>
                        <input type="text" name="faddedby" id="fuseraddeddate" disabled>
                    </div>

                    <div class="input-text">
                        <label>Last logon :</label>
                        <input type="text" name="faddedby" id="fuserlast" disabled>
                    </div>




            </div>
            <div class="cfooter">
                <button type="submit" class="submit-button" id="modal_close"><i class="fa fa-check"
                        aria-hidden="true"></i>

                    Update </button>
                </form>
                <button type="button" class="cbutton" id="clear-input"><i class="fa fa-times" aria-hidden="true"></i>
                    Cancel</button>

            </div>

        </div>
    </div>

</div>