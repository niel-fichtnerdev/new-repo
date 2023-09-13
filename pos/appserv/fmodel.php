<?php

class Dbh{
    private $host = "sql109.infinityfree.com";
    private $user = "if0_34899882";
    private $pwd = "mDPT7uGvO6ZVd";
    private $dbName = "if0_34899882_demo_syspos";

    protected function connect(){
        // Add the colon (:) and equal sign (=) in the DSN string
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
        $pdo = new PDO($dsn, $this->user, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}


class model extends Dbh{
    
    public function fetchproducts(){
        $query = "
         SELECT a.fproductid, a.fname, a.fdescription, a.fexpiry_alert, a.fprev_cost, a.fstnd_cost, a.ftax_type, a.fuom, a.fcategory_id, a.ftag, a.fmemo, a.factive_flag, a.fsale_flag, a.fcreated_by, a.fstatus, a.fstock, a.fupdated_by, a.fupdated_date, b.fcategory_img FROM mst_product AS a JOIN mst_product_category AS b ON a.fcategory_id=b.fcategoryid ORDER BY fupdated_date
        ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $res;
    }

    
    public function queryselect($query){
        
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
        
    }

    public function addproducttrx($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10){
        $query = "
        INSERT INTO pos_sale_current (fcompanyid, ftermid, fzcounter, frecno, fproductid, fqty, fdiscount, ftax, fcreated_by, fcreated_date) VALUES (?,?,?,?,?,?,?,?,?,?)
        ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10]);
        
        return $stmt;
    }

    public function updateproducttrx($params){
        $query = "
        UPDATE pos_sale_current SET fqty=fqty+1 WHERE fproductid=?
        ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$params]);
        
        return $stmt;
    }
    public function validateifexist($f1) {
        $query = "SELECT fproductid FROM pos_sale_current WHERE fproductid=?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$f1]);
        
        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            // Product exists
            return true;
        } else {
            // Product doesn't exist
            return false;
        }
    }

    public function removeproduct($params){
        $query ="DELETE FROM pos_sale_current WHERE fproductid=?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$params]);

        return $stmt;
    }

    public function gettotalsummary(){
        $query = "
        SELECT
        SUM(ps.fdiscount) AS Discount,
        SUM(ps.fqty * mp.fstnd_cost) AS Subtotal,
        SUM(ps.ftax) AS Tax,
        SUM(ps.fqty) AS Qty,
        SUM(ps.fqty * ps.ftax) AS TotalTax,
        SUM(ps.fqty * (mp.fstnd_cost + ps.ftax - ps.fdiscount)) AS Total
        FROM
        pos_sale_current ps
        JOIN
        mst_product mp ON ps.fproductid = mp.fproductid;
       ";
       $stmt = $this->connect()->prepare($query);
       $stmt->execute();
       $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
       return $res;
    }

    public function incrementquantity($f1, $f2){
        $query ="
        UPDATE pos_sale_current SET fqty=? WHERE fproductid=?
        ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$f1, $f2]);
        
        return $stmt;
    }

    public function getlastzreading(){
        
        $query = "
        SELECT max(fzcounter) as fzcounter FROM pos_reading 
        ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $fzcounter = $res[0]['fzcounter'];
       
       return $fzcounter;
    }

    public function voidcurrenttrx(){
        $query = "
        DELETE FROM pos_sale_current
       ";
       $stmt = $this->connect()->prepare($query);
       $stmt->execute();
       $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
       return $res;
    }

    public function checktrx(){
        $query = "
        SELECT * FROM pos_sale_current
        ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
       
        if ($stmt->rowCount() > 0) {
            $result = 1; // Rows were found
            return $result;
        } else {
            $result = 0; // No rows were found
            return $result;
        }
    }

    public function settletransaction($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14, $f15, $f16, $f17, $f18, $f19, $f20, $f21, $f22, $f23, $f24, $f25){
        $query = "
        INSERT INTO pos_sale (frecno, fcompanyid, fzcounter, fsale_date, fsale_time, fcashierid, ftermid, ftrx_no, fdocument_no, fofficeid, fvoid_flag, frcash, fchange, fcash, fdiscount, fgross, ftax, ftotal_cost, ftotal_qty, fcreated_by, fcreated_date, fupdated_by, fupdated_date, fterm_updated_by, fterm_updated_date) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
        ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14, $f15, $f16, $f17, $f18, $f19, $f20, $f21, $f22, $f23, $f24, $f25]);
        
        return $stmt;

    }
    public function insertproduct($dataArray){
        $query = "
        INSERT INTO pos_sale_product (frecno, fseqno, fcompanyid, ftermid, fsale_date, fproductid, fqty, fuom, funitprice, ftax, fexpiry, fstatus_flag, fcreated_by, fcreated_date, fupdated_by, fupdated_date) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
        ";
        $stmt = $this->connect()->prepare($query);
        
        for ($i = 0; $i < count($dataArray); $i++) {
            $insertParams = $dataArray[$i]; // Get the associative array for the current row
        
            $stmt->execute(array_values($insertParams)); // Use array_values to get indexed array for execute
        }

        $cleartrx = $this->voidcurrenttrx();
        
        if($cleartrx){
            return true;
        }
        else{
            return false;
        }
    }

    public function updatestock($decrement, $fproductid){
        $query = "
        UPDATE mst_product set fstock=fstock-$decrement WHERE fproductid='$fproductid'
        ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
       return $res;
    }

    public function zreading(){
        
        $zcounter = $this->getlastzreading();

        $query = "
        UPDATE pos_sale set fzcounter='$zcounter' WHERE fzcounter='0'
        ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
       return $res;
    }

    public function posreading($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14, $f15, $f16){
        $query = "
        INSERT INTO pos_reading (fcompanyid, ftermid, fzcounter, fpzcounter, fsale_date, ffdocument_no, ftdocument_no, ftotal_transaction, fgross, ftax, fpgross, fgross2, fcreated_by, fcreated_date, fupdated_by, fupdated_date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
        ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14, $f15, $f16]);

        return $stmt;
    }
    

}
