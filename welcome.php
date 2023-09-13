<?php

session_start();

if(isset($_SESSION['companyid'])){
  header("location: ./");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Welcome to SYSPOS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="img/syspos-small.png">
  <link rel="stylesheet" href="css/style-entry.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <p id="version" class="cversion"></p>
  <div class="container">

    <div class="flex-container" id="no-company">
      <header>SYSPOS DEMO</header>
      <h4 style="margin-top: 40px; color: green">Currently there is no Active Company</h4>
      <br>
      
      <p>Note: This is Demo only and will expire at <br><strong>12 Midnight</strong></p>
      <br>
      <br>
      <h4>Proceed to Create One</h4>
      <br>
      <br>
      <button id="create" class="createbtn">Create Company</button>

    </div>


    <div class="wrapper-register">
      <header>Demo Company</header>
      <p id="sysmsg" style="color: red"><strong>License for Demo <br>SYSDEMO-45112A</strong><br></p>
      <div class="progress-bar">
        <div class="step">
          <p>Step 1</p>
          <div class="bullet">
            <span>1</span>
          </div>
          <div class="check fas fa-check"></div>
        </div>
        <div class="step">
          <p>Step 2</p>
          <div class="bullet">
            <span>2</span>
          </div>
          <div class="check fas fa-check"></div>
        </div>
        <div class="step">
          <p>Step 3</p>
          <div class="bullet">
            <span>3</span>
          </div>
          <div class="check fas fa-check"></div>
        </div>
        <div class="step">
          <p>Submit</p>
          <div class="bullet">
            <span>4</span>
          </div>
          <div class="check fas fa-check"></div>
        </div>
      </div>
      <div class="form-outer">
        <form id="register-company" enctype="multipart/form-data">
          <div class="page slide-page">
            <div class="title">Basic Info:</div>
            <div class="field">
              <div class="label">Company Name</div>
              <input type="text" name="name" spellcheck="false" placeholder="Maximum 15 Characters">
            </div>
            <div class="field">
              <div class="label">Company License</div>
              <input type="text" name="license" spellcheck="false" placeholder="Enter Demo License">
            </div>
            <div class="field">
              <button class="firstNext next">Next</button>
            </div>
          </div>

          <div class="page">
            <div class="title">Company Info:</div>
            <div class="field">
              <div class="label">Address</div>
              <input type="text" name="address" spellcheck="false" placeholder="Enter Address">
            </div>
            <div class="field">
              <div class="label">Tel. No.</div>
              <input type="Number" name="telno" spellcheck="false" placeholder="Enter Tel. Number">
            </div>
            <div class="field btns">
              <button class="prev-1 prev">Previous</button>
              <button class="next-1 next">Next</button>
            </div>
          </div>

          <div class="page">
            <div class="title">Company Info:</div>
            <div class="field">
              <div class="label">Company Email</div>
              <input type="email" name="email" spellcheck="false" placeholder="Enter Company Email">
            </div>
            <div class="field">
              <div class="label">Company Type</div>
              <select name="type">
                <option value="btq">Boutique (Basic / Retail)</option>
                <option value="fb">F&B (Food and Beverages)</option>
                <option value="billing">Billing Kiosk</option>
              </select>
            </div>
            <div class="field btns">
              <button class="prev-2 prev">Previous</button>
              <button class="next-2 next">Next</button>
            </div>
          </div>

          <div class="page">
            <div class="title">Company Info:</div>
            <div class="field">
              <div class="label">Owner</div>
              <input type="text" name="owner" spellcheck="false">
            </div>
            <div class="field">
              <div class="label" required>Company logo / Icon</div>
              <input type="file" name="icon">
            </div>
            <div class="field btns">
              <button class="prev-3 prev">Previous</button>
              <button type="submit" class="submit">Submit</button>
            </div>
          </div>
        </form>
      </div>

    </div>



    <div class="wrapper-Login">
      <header>SYSPOS DEMO</header>
      <p id="sysmsg" class="sysmg" style="color: red"><strong>Currently there is one active Company</strong><br>(expire on 12:00 AM)</p>
  
      <br>
      <div class="form-outer" >
        <form id="loginform">
          <div class="page slide-page">
            <div class="field">
              <div class="label">Company ID</div>
              <input type="text" name="coid" spellcheck="false" placeholder="Enter Company ID">
            </div>
            <div class="field">
              <div class="label">Company Key</div>
              <input type="password" name="cokey" spellcheck="false" placeholder="Enter Company Key">
            </div>
            <div class="field">
              <button type="submit" class="submit">Login</button>
            </div>
          </div>

        </form>
      </div>

    </div>




    <div class="wrapper-info">
      <header>SYSPOS DEMO</header>
      <br>
      <br>
      <h4>Welcome to SYSPOS DEMO</h4>
      <br>
      <h4 id="compname"></h4>
      <h5>Company ID : <span id="compid">132512312</span></h5>
      <h5>Company Key : <span id="compkey">132512312</span></h5>
      <br>
      <p>please save this as login credentials</p>
      <br>
      <br>
      <p>For any feedbacks & Inquiries please do not hesitate to DM me: <a href="mailto:tolentin.joseniel@gmail.com?subject=Feedback%20and%20Inquiries&body=Your%20Message">tolentin.joseniel@gmail.com</a> </p>
      <br>
      <br>
      <button class="createbtn" id="enter-sync">Enter SYSPOS HQ</button>


    </div>

  </div>




  <script src="js/script.js"></script>

</body>

</html>