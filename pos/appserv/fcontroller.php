<?php

require_once 'fmodel.php';

class controller extends model{

    public function checkstock($productid){
        $sql = "SELECT fstock FROM mst_product WHERE fproductid='$productid'";
        $res = $this->queryselect($sql);

        

        return $res;
    }

    public function getcompanyid(){
        $sql = "SELECT * FROM sm_company WHERE factive_flag='1'";
        $res = $this->queryselect($sql);

        $companyid = $res[0]['fcompanyid'];
        return $companyid;
    }

    public function addprodtotrx($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10){
        $validatexist = $this->validateexist($f5);
        
        if($validatexist === 'true'){
            $update = $this->updatetrx($f5);
            return $update;

        }
        elseif($validatexist === 'false'){
            $exec = $this->addproducttrx($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10);
            return $exec;
        }

        
    }

    public function updatetrx($params){
        $exec = $this->updateproducttrx($params);

        return $exec;
    }

    public function getlastrecno(){
        
        $validate = $this->checktrx();

        if($validate === 0){
            $sql = "
            SELECT max(frecno) as frecno FROM pos_sale
            ";
            $res = $this->queryselect($sql);
    
            $frecno = $res[0]['frecno'];
    
            return $frecno;
        }
        else{
            $sql = "
            SELECT max(frecno) as frecno FROM pos_sale_current
            ";
            $res = $this->queryselect($sql);
    
            $frecno = $res[0]['frecno'];
    
            return $frecno;
        }



    }

    public function checktransaction(){
        return $this->checktrx();
    }

    public function getrecno(){
        $sql = "
        SELECT max(frecno) as frecno FROM pos_sale
        ";
        $res = $this->queryselect($sql);

        $recno = $res[0]['frecno'];

        return $recno;
    }

    public function getlasttrxnumber(){
        $sql = "
        SELECT max(fdocument_no) as fdocument_no FROM pos_sale
        ";
        $res = $this->queryselect($sql);

        $trx = $res[0]['fdocument_no'];

        return $trx;
    }

    public function getproductnqty(){

        $checktrx = $this->checktrx();
        
        if($checktrx === 0){
            echo 0;
        }
        else{
 //$summarize = $this->gettotalsummary();
        //$total = $summarize[0]['Total'];


        $recno = $this->getrecno() + 1;
        
        
        $sql = "
        SELECT ftermid, fzcounter, frecno, fproductid, fqty, fdiscount, ftax, fcreated_by, fcreated_date FROM pos_sale_current
        ";
        $res = $this->queryselect($sql);
        

            $productid = $res[0]['fproductid'];

            $getcostquery = "SELECT fstnd_cost FROM mst_product WHERE fproductid='$productid'"; 
            $getcost = $this->queryselect($getcostquery);
            $cost = $getcost[0]['fstnd_cost'];
            
            $summarize = $this->gettotalsummary();
            
            $total = $summarize[0]['Total'];
            $tax = $summarize[0]['Tax'];
            $discount = $summarize[0]['Discount'];
            $subtotal = $summarize[0]['Subtotal'];
            $qty = $summarize[0]['Qty'];

                //'productid' => $row['fproductid'],

                //'recno' => $recno,
                $companyid = $this->getcompanyid();
                $zcounter = $res[0]['fzcounter'];
                $sale_date = date('Ymd');
                $sale_time = date('His');
                $cashierid = $res[0]['fcreated_by'];
                $terminal = $res[0]['ftermid'];
                
                $trxno = $recno;
                $docnum = $recno;
                $office = '0001';
                $voidflag = 0;

                $frcash = 0; //based on pos_sale_payment module
                $change = 0; //based on pos_sale_payment module
                $cash = 0;  //based on pos_sale_payment module
                //$discount = $res[0]['fdiscount']; //based on pos_sale_payment module
                
                $gross = $subtotal;
                
                //$tax = $res[0]['fstnd_cost'];
                //$total = $total;
                //$qty = $res[0]['fqty'];
                $createdby = $res[0]['fcreated_by'];
                $createddate = $res[0]['fcreated_date'];
                $updatedby = $res[0]['fcreated_by'];
                $updateddate = date('Ymd');
                $termby = '0001';
                $termdate = date('Ymd');



        $this->settletransaction($recno, $companyid, $zcounter, $sale_date, $sale_time, $cashierid, $terminal, $trxno, $docnum, $office, $voidflag, $frcash, $change, $cash, $discount, $gross, $tax, $total, $qty, $createdby, $createddate, $updatedby, $updateddate, $termby,$termdate );

        
        $query = "
        SELECT ftermid, fzcounter, frecno, fproductid, fqty, fdiscount, ftax, fcreated_by, fcreated_date FROM pos_sale_current
        ";
        $preproduct = $this->queryselect($query);
        
        $dataArray = array();
        $sequence = 1;

        foreach ($preproduct as $row) {
            $productid = $row['fproductid'];

            //###########

            $getcostquery = "SELECT fstnd_cost FROM mst_product WHERE fproductid='$productid'";
                
            $getcost = $this->queryselect($getcostquery);
            $cost = $getcost[0]['fstnd_cost'];

            //###########
            $getcostquery = "SELECT fuom, fexpiry_alert, factive_flag FROM mst_product WHERE fproductid='$productid'";     
            $getcost = $this->queryselect($getcostquery);
            
            $fuom = $getcost[0]['fuom'];
            $expire = $getcost[0]['fexpiry_alert'];
            $status = $getcost[0]['factive_flag'];


            $rowData = array(


                'recno' => $recno,
                'fsec' => $sequence,
                'companyid' => $this->getcompanyid(),
                'terminal' => $row['ftermid'],
                'sale_date' => date('Ymd'),
                'productid' => $row['fproductid'],
                'qty' => $row['fqty'],
                'fuom' => $fuom,
                'cost' => $cost,
                'tax' => $row['ftax'],
                'expire' => $expire,
                'status' => $status,
                'createdby' => $row['fcreated_by'],
                'createddate' => $row['fcreated_date'],
                'updatedby' => $row['fcreated_by'],
                'updateddate' => date('Ymd'),


            );
            $qnty = $row['fqty'];
            
            $updatestock = $this->updatestock($qnty, $productid);
        
            $dataArray[] = $rowData;
            $sequence++;
        }



        $execute2 = $this->insertproduct($dataArray);

        

        return var_dump($execute2);
        }


       

    }

    public function getquantity($params){
        $sql = "SELECT fqty FROM pos_sale_current WHERE fproductid='$params'";
        $res = $this->queryselect($sql);
        $quantity = $res[0]['fqty'];
        return $quantity;
    }

    public function validateexist($f1){
        $exec = $this->validateifexist($f1);

        if($exec === true){
            return 'true';
        }
        else{
            return 'false';
            
        }
    }

    public function removefromlist($params){
        $exec = $this->removeproduct($params);

        return $exec;
    }

    public function getsummary(){
        
        $summarize = $this->gettotalsummary();
        
        return $summarize;
    }

    public function modifyquantity($f1, $f2){

        $checkquantity = $this->checkstock($f2);
        $stock = $checkquantity[0]['fstock'];
        $validate = $stock - $f1;
        
        if ($validate < 0) { 
            echo '1';
        } else {
            $execute = $this->incrementquantity($f1, $f2);
            return $execute;
        }
    
        
    }

    public function voidtrx(){
        $exec = $this->voidcurrenttrx();

        return $exec;
    }

    public function getlastprevnrgt(){
        $sql = "
        SELECT max(fgross2) as fpgross FROM pos_reading
        ";
        $res = $this->queryselect($sql);
        $prevnrgt = $res[0]['fpgross'];
        
        return $prevnrgt;

    }

    public function getsummaryreading(){

        $sql = "
        SELECT DISTINCT fcompanyid, ftermid, fsale_date, MIN(fdocument_no) as fmin, MAX(fdocument_no) as fmax, count(fdocument_no) as ftotaltrx, sum(fgross) as fgross, sum(ftax) as ftax, fcreated_by, fcreated_date, fupdated_by, fupdated_date FROM pos_sale WHERE fzcounter='0'
        ";
        $res = $this->queryselect($sql);

        $fcompanyid = $res[0]['fcompanyid'];
        $ftermid = $res[0]['ftermid'];

        $prevzcounter = $this->getlastzreading();
        $fzcounter = $prevzcounter + 1;

        $fsale_date = $res[0]['fsale_date'];
        $fmin = $res[0]['fmin'];
        $fmax = $res[0]['fmax'];
        $ftotaltrx = $res[0]['ftotaltrx'];
        $fgross = $res[0]['fgross'];
        $ftax = $res[0]['ftax'];

        $getprevnrgt = $this->getlastprevnrgt();
        $presentngrgt = $getprevnrgt + $fgross;

        $fcreated_by = $res[0]['fcreated_by'];
        $fcreated_date = $res[0]['fcreated_date'];
        $fupdated_by = $res[0]['fupdated_by'];
        $fupdated_date = $res[0]['fupdated_date'];

        $execute = $this->posreading($fcompanyid, $ftermid, $fzcounter, $prevzcounter, $fsale_date, $fmin, $fmax, $ftotaltrx, $fgross, $ftax, $getprevnrgt, $presentngrgt, $fcreated_by, $fcreated_date, $fupdated_by, $fupdated_date); 

        $exec = $this->zreading();

        
        return var_dump($fcompanyid);
    }

    public function zreadexec(){
        
        $exec = $this->zreading();


        return $exec;
    }

    public function getcompanyname2(){
        $sql = "
        SELECT fname FROM sm_company WHERE factive_flag='1'
        ";
        $res = $this->queryselect($sql);
        $companyname = $res[0]['fname'];
        echo strtoupper($companyname);
        return $companyname;
    }   

}