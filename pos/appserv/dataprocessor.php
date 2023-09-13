<?php

require_once 'fview.php';
require_once 'fcontroller.php';

if(isset($_POST['addproduct'])){
    
    
    
    $fcompanyid = new controller();
    $companyid = $fcompanyid->getcompanyid();

    $terminalid = '0001';
    $zcounter = '0';
    $recno = new controller();
    $frecno = $recno->getlastrecno() + 1;
    $productid = $_POST['addproduct'];
    $quantity = 1;
    $discount = 0;
    $tax = 0;
    $created_by = 'admin';
    $created_date = date('Ymd');
    

    $execute = new controller();
    $execute->addprodtotrx($companyid, $terminalid, $zcounter, $frecno, $productid, $quantity, $discount, $tax, $created_by, $created_date);



}

if(isset($_POST['removeproduct'])){
    
    $productid = $_POST['removeproduct'];

    $execute = new controller();
    $execute->removefromlist($productid);

}

if(isset($_POST['fetchsummary'])){

    $summary= new controller();
    $execute = $summary->getsummary();

    $data1 = $execute[0]['Discount'];
    $data2 = $execute[0]['Subtotal'];
    $data3 = $execute[0]['Tax'];
    $data4 = $execute[0]['Total'];
    
    $response = [
        'data1' => $data1,
        'data2' => $data2,
        'data3' => $data3,
        'data4' => $data4
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}

if(isset($_POST['quantity'])){

    $quanty = $_POST['quantity'];
    $productid = $_POST['productid'];

    $execute = new controller();
    $execute->modifyquantity($quanty, $productid);


    
    

}

if(isset($_POST['voidtrx'])){

    $voidthis = new controller();
    $voidthis->voidtrx();
    
    echo 'Success!';

}

if(isset($_POST['settle'])){



    $test = new controller();
    $data = $test->getproductnqty();
}

if(isset($_POST['zread'])){
    
    
    $execute = new controller();
    $execute->getsummaryreading();

}

if(isset($_POST['companyname'])){
    $company = new controller();
    $company->getcompanyname2();
}

if(isset($_POST['poslogin'])){

    $defaultusername = "admin";
    $defaultpassword = "admin";

    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username === $defaultusername && $password === $defaultpassword){
        session_start();
        $_SESSION['user'] = $username;

        echo '1';
    }
    else{
        echo '0';
    }


}

if(isset($_POST['logout'])){

    session_start();
    unset($_SESSION['user']);

    echo '1';
}
    
    
