
var openuser1 = $('#open_user');
var openuser2 = $('#open_user2');
var income_modal = $('#income_modal');
var add_product = $('#open_addproduct');
var add_category = $('#open_addcategory');
var request_stock = $('#open_requeststock');
var view_product = $('#open_viewproduct');
var terminal_master = $('#view_terminals');
var add_terminal = $('#add_terminal_modal');
var notification = $('#open_notification');
var transactions = $('#transaction_modal');
var add_user = $('#open_usermodal');


$('.open_usersz').click(function(){
        openuser1.slideDown();
        openuser2.slideDown();
})
$('.open_income').click(function(){
        income_modal.slideDown();

})
$('#add_product').click(function(){
        add_product.slideDown();

})
$('#add_category').click(function(){
        add_category.slideDown();

})
$('#request_stock').click(function(){
        request_stock.slideDown();

})
$('.open_product').click(function(){
        view_product.slideDown();
})

$('#open_terminal').click(function(){
        terminal_master.slideDown();
})
$('#add_terminals').click(function(){
        add_terminal.slideDown();
})
$('.btn_notif').click(function(){
        notification.slideDown();
})
$('#open_transactions').click(function(){
        transactions.slideDown();

        $.ajax({
                
                type: 'post',
                url: 'datacenter.php',
                data: 'currenttrx=0',
                success: function (response) {
                    document.getElementById("currenttrx").innerHTML = response;
                }
        });

})
$('#add_users').click(function(){
        add_user.slideDown();
})



$('.cbutton').click(function(){
        openuser1.slideUp();
        openuser2.slideUp();
        income_modal.slideUp();
        add_product.slideUp();
        view_product.slideUp();
        add_category.slideUp();
        request_stock.slideUp();
        terminal_master.slideUp();
        add_terminal.slideUp();
        transactions.slideUp();
        add_user.slideUp();
})

$('.c-close').click(function(){
        openuser1.slideUp();
        openuser2.slideUp();
        income_modal.slideUp();
        add_product.slideUp();
        view_product.slideUp();
        add_category.slideUp();
        request_stock.slideUp();
        terminal_master.slideUp();
        transactions.slideUp();
        add_user.slideUp();
})
$('#modal_save').click(function(){
        notification.slideUp();
        openuser1.slideUp();
        openuser2.slideUp();
        transactions.slideUp();
        add_user.slideUp();
})
$('#modal_cancel').click(function(){
        notification.slideUp();
        openuser1.slideUp();
        openuser2.slideUp();
        transactions.slideUp();
        add_user.slideUp();
})
$('#modal_close').click(function(){
        notification.slideUp();
        openuser1.slideUp();
        openuser2.slideUp();
        transactions.slideUp();
        add_user.slideUp();
})

$(document).ready(function() {
        $(".cbutton").click(function() {
          $(".modal-form :input").val('');
        });
      });
      



//Generate Random ID for product related items
$(document).ready(function() {
        $(".input-btn").click(function() {
          var randomNumber = generateRandomNumber(10);
          $(".input-id").val(randomNumber);
        });
      
        function generateRandomNumber(length) {
          var result = '';
          for (var i = 0; i < length; i++) {
            var randomDigit = Math.floor(Math.random() * 10);
            result += randomDigit;
          }
          return result;
        }
      });

//Generate Random ID for Accounts
$(document).ready(function() {
        $(".input-btn-account").click(function() {
          var randomNumber = generateRandomNumber(6);
          $(".input-id").val(randomNumber);
        });
      
        function generateRandomNumber(length) {
          var result = '';
          for (var i = 0; i < length; i++) {
            var randomDigit = Math.floor(Math.random() * 10);
            result += randomDigit;
          }
          return result;
        }
      });


 //Generate Random Temporary Password
$(document).ready(function() {
        $(".input-btn-password").click(function() {
                var temporaryPassword = generateTemporaryPassword(8);
                $(".input-password").val(temporaryPassword);
        });
      
        function generateTemporaryPassword(length) {
                var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                var password = "";
              
                for (var i = 0; i < length; i++) {
                  var randomIndex = Math.floor(Math.random() * charset.length);
                  password += charset.charAt(randomIndex);
                }
              
                return password;
              }
              
      });     

$(document).ready(function(){
       // jQuery AJAX request to fetch options from PHP script - For Add product
       var requestData = 'request';
       $.ajax({
        type: 'post',
        url: 'datacenter.php',
        data: requestData,
        success: function (response) {
         document.getElementById("new_select").innerHTML=response; 
        }
        });
})

$(document).ready(function(){
        // jQuery AJAX request to fetch options from PHP script - for editing product
        var requestData = 'request2';
        $.ajax({
         type: 'post',
         url: 'datacenter.php',
         data: requestData,
         success: function (response) {
          document.getElementById("selectcategory").innerHTML=response; 

        var selectElement = document.getElementById("selectcategory");
        var selectedValue = selectElement.options[selectElement.selectedIndex].value;

        // Loop through the options and find the one to select
        $("#selectcategory option").each(function() {
                        if ($(this).val() === selectedValue) {
                            $(this).prop("selected", true);
                            return false; // Exit the loop once the option is found
                        }
                    });
         
         
         }
         });
 })
 
 $(document).ready(function(){
        // jQuery AJAX request to fetch options from PHP script -> for Search filter
        var requestData = 'request3';
        $.ajax({
         type: 'post',
         url: 'datacenter.php',
         data: requestData,
         success: function (response) {
          document.getElementById("new_select3").
          innerHTML=response; 
         }
         });
 })
 

 


function editproduct(fpid, fpname, fpdesc, fpexp, fprv, fpcst, ftxtyp, fuom, fcateg, ftaged, fpmemor, fpact, fsale, fpctdby, fpsts, fpstk, fpupdtdby, fpupdtdate ){
       

        productid = document.getElementById('fproductid');
        productid2 = document.getElementById('fproductidclass');
        productname = document.getElementById('fproductname');
        productdesc = document.getElementById('fpdescription');
        productexpiry = document.getElementById('fpexpiry');
        productprev = document.getElementById('fprev');
        productcost = document.getElementById('fcost');
        producttype = document.getElementById('ftaxtype');
        productuom = document.getElementById('fpuom');
        productcateg = document.getElementById('selectcategory');
        producttag = document.getElementById('fptag');
        productmemo = document.getElementById('fpmemo');
        productactive = document.getElementById('fpactive');
        productsale = document.getElementById('fpsale');
        producttdby = document.getElementById('fpcreatedby');
        productsts = document.getElementById('fpstatus');
        productstk = document.getElementById('fpstock');
        productutdby = document.getElementById('fpupdatedby');
        productdate = document.getElementById('fpupdateddate');


        productid.value = fpid;
        productid2.value = fpid;
        productname.value = fpname;
        productdesc.value = fpdesc;
        productexpiry.value = fpexp;
        productprev.value = fprv;
        productcost.value = fpcst;
        producttype.value = ftxtyp;
        productuom.value = fuom;
        productcateg.value = fcateg;
        producttag.value = ftaged;
        productmemo.value = fpmemor;
        productactive.value = fpact;
        productsale.value = fsale;
        producttdby.value = fpctdby;
        productsts.value = fpsts;
        productstk.value = fpstk;
        productutdby.value = fpupdtdby;
        productdate.value = fpupdtdate;



        /*
        //List of input ID's to be repopulate
        fproductid -> fpid
        fproductname -> fpname
        fpdescription -> fpdesc
        fpexpiry -> fpexp
        fprev -> fprv
        fcost -> fpcst
        ftaxtype -> ftxtyp
        fpuom -> fuom
        fpcat -> fcateg
        fptag -> ftaged
        fpmemo -> fpmemor
        fpactive -> fpact
        fpsale -> fsale
        fpcreatedby -> fpctdby
        fpstatus -> fpsts
        fpstock -> fpstk
        //fpaddstock
        fpupdatedby -> fpupdtdby
        fpupdateddate -> fpupdtdate
        */


}


function editModal(faccountid, ffname, flname, fmname, fsex, fcivil, faddress, femail, fphone, fuserid, fpassword, fbirthdate, fbirthplace, fmemo, fquestion, fanswer, fstatus, faccesslvl, foffice, faddedby, faddeddate, flastlogon){
        modal = document.getElementById('edit-user');
        fuid = document.getElementById('fuserid');
        fuid2 = document.getElementById('fuserid2');
        fufname = document.getElementById('fuserfname');
        fulname = document.getElementById('fuserlname');
        fuaddress = document.getElementById('fuseraddress');
        fuemail = document.getElementById('fuseremail');
        fuphone = document.getElementById('fuserphone');
        fuusername = document.getElementById('fusername');
        fupassword = document.getElementById('fuserpassword');
        fupassword2 = document.getElementById('fuserpassword2');
        funewpassword = document.getElementById('fusernewpassword');
        fubirth = document.getElementById('fuserbirth');

        fumname = document.getElementById('fusermname');
        fusex = document.getElementById('fusersex');
        fusex2= document.getElementById('fusersex2');
        fucivil = document.getElementById('fusercivil');
        fubplace = document.getElementById('fuserbirthplace');
        fumemo = document.getElementById('fusermemo');
        fuquestion = document.getElementById('fuserquestion');
        fuanswer = document.getElementById('fuseranswer');
        fustatus = document.getElementById('fuserstatus');
        fuoffice = document.getElementById('fuseroffice');
        fuaccess = document.getElementById('fuseraccess');
        fuby = document.getElementById('fuseraddedby');
        fudate = document.getElementById('fuseraddeddate');
        fulast = document.getElementById('fuserlast');

        
        fupassword2.value = fpassword;
        fuid2.value = faccountid;
        fuid.value = faccountid;
        fufname.value = ffname;
        fulname.value = flname;
        fuaddress.value = faddress;
        fuemail.value = femail;
        fuphone.value = fphone;
        fuusername.value = fuserid;
        fupassword.value = fpassword;
        fubirth.value = fbirthdate;

        fumname.value = fmname;
        fusex.value = fsex;
        fusex2.value = fsex;
        fucivil.value = fcivil;
        fubplace.value = fbirthplace;
        fumemo.value = fmemo;
        fuquestion.value = fquestion;
        fuanswer.value = fanswer;
        fustatus.value = fstatus;
        fuoffice.value = foffice;
        fuaccess.value = faccesslvl;
        fuby.value = faddedby;
        fudate.value = faddeddate;
        fulast.value = flastlogon;

}

function viewincome(fzcounter){


        // jQuery AJAX request to fetch options from PHP script - For Add product
        var requestData = fzcounter;

        $.ajax({
            type: 'post',
            url: 'datacenter.php',
            data: 'fzcounter=' + requestData,
            success: function (response) {
                document.getElementById("salesdata").innerHTML = response;
            }
        });

        
        $.ajax({
                type: 'post',
                url: 'datacenter.php',
                data: 'trxdate=' + requestData,
                success: function (response) {
                    document.getElementById("sales_header").innerHTML = response;
                }
        });

        $.ajax({
                type: 'post',
                url: 'datacenter.php',
                data: 'trxsummary=' + requestData,
                success: function (response) {
                    document.getElementById("sales_headerright").innerHTML = response;
                }
            });

            
}







function displayCurrentTime() {
        var currentTimeElement = document.getElementById("currentTime");
        var currentTime = new Date();
        var daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        var dayOfWeek = daysOfWeek[currentTime.getDay()];
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();
        var seconds = currentTime.getSeconds();
        var meridiem = hours >= 12 ? "PM" : "AM";
      
        // Convert to 12-hour format
        hours = hours % 12 || 12;
      
        // Format the time with leading zeros if needed
        hours = (hours < 10 ? "0" : "") + hours;
        minutes = (minutes < 10 ? "0" : "") + minutes;
        seconds = (seconds < 10 ? "0" : "") + seconds;
      
        var formattedTime = dayOfWeek + " - " + hours + ":" + minutes + ":" + seconds + " " + meridiem;
        currentTimeElement.textContent = formattedTime;
      }
      
      // Update the time every second
      setInterval(displayCurrentTime, 1000);
      

/*
$(document).ready(function() {
        // When the button with class "open_usersz" is clicked
        $('.open_usersz').on('click', function() {
          // Get the row that contains the clicked button
          var row = $(this).closest('tr');
          // Iterate through each <td> element within the row
          row.find('td').each(function() {
            // Retrieve the text content of the <td> and display in an alert
            alert($(this).text());
          });
        });
});

*/
