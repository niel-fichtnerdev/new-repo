<!-- Add Users -->

<script>
    $(document).ready(function () {
        $("#adduserform").submit(function (event) {
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
                <h2>Add User</h2>
            </div>
            <div class="cmain">
                <!-- CONTENT HERE -->
                <form action="datacenter.php" class="modal-form" method="POST" id="adduserform">
                    <div class="input-text">
                        <label>User ID <span style="color:red;">*</span> :</label>
                        <input type="text" name="adduser" value="1" hidden>
                        <input type="text" name="faccountid" class="input-id" placeholder="Enter ID / Generate"
                            required>
                        <button class="input-btn-account" type="button">Generate</button>
                    </div>

                    <div class="input-text">
                        <label>First Name <span style="color:red;">*</span> :</label>
                        <input type="text" name="ffname" placeholder="Enter First Name" required>
                    </div>

                    <div class="input-text">
                        <label>Last Name <span style="color:red;">*</span> :</label>
                        <input type="text" name="flname" placeholder="Enter Last Name" required>
                    </div>

                    <div class="input-text">
                        <label>Middle Name :</label>
                        <input type="text" name="fmname" placeholder="Enter Middle Name">
                    </div>

                    <div class="input-text">
                        <label>Sex <span style="color:red;">*</span> :</label>
                        <select name="fsex" required>
                            <option value="0">~Select~</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="no">Prefer not say</option>
                        </select>
                    </div>

                    <div class="input-text">
                        <label>Civil Status :</label>
                        <select name="fcivil_status">
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="divorced">Divorced</option>
                            <option value="widow">Widowed</option>
                        </select>
                    </div>



                    <div class="input-text">
                        <label>Address :</label>
                        <input type="text" name="faddress" placeholder="Enter Permanent Address">
                    </div>

                    <div class="input-text">
                        <label>Email <span style="color:red;">*</span> :</label>
                        <input type="email" name="femail" placeholder="Enter Email Address" required>
                    </div>

                    <div class="input-text">
                        <label>Phone <span style="color:red;">*</span> :</label>
                        <input type="number" name="fphone" placeholder="Enter Contact Number" required>
                    </div>

                    <div class="input-text">
                        <label>Username <span style="color:red;">*</span> :</label>
                        <input type="text" name="fusername" placeholder="Enter Username" required>
                    </div>

                    <div class="input-text">
                        <label>Temporary Password <span style="color:red;">*</span> :</label>
                        <input type="text" name="ftemppassword" class="input-password"
                            placeholder="Generate Temporary Password" required>
                        <button class="input-btn-password" type="button">Generate</button>
                    </div>

                    <div class="input-text">
                        <label>Birth Date <span style="color:red;">*</span> :</label>
                        <input type="date" name="fbirthdate" required>
                    </div>

                    <div class="input-text">
                        <label>Birth Place :</label>
                        <input type="text" name="fbirth_place" placeholder="Enter Birth Place">
                    </div>

                    <div class="input-text">
                        <label>Memo :</label>
                        <input type="text" name="fmemo" placeholder="Enter Memo">
                    </div>

                    <div class="input-text">
                        <label>Access level: </label>
                        <select name="faccesslvl">
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
                        <select name="fofficeid">
                            <option value="main">Main</option>

                        </select>
                    </div>



            </div>
            <div class="cfooter">
                <button name="add-submit" type="submit" class="submit-button" id="modal_close"><i class="fa fa-check"
                        aria-hidden="true"></i>

                    Add </button>
                </form>
                <button type="button" class="cbutton" id="clear-input"><i class="fa fa-times" aria-hidden="true"></i>
                    Cancel</button>

            </div>

        </div>
    </div>

</div>