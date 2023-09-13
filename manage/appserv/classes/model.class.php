<?php

if (!defined('BASE')) define('BASE', dirname(__FILE__) ."/../");

//require './db-logic/CdbConnection.php';
//require_once BASE.'/db-logic/CdbConnection.php';




//Only model will be extended to the database

class model extends Dbh{
    
    public function __construct(){

    }
    
    protected function getUser(){
        //Use this function to return all rows
        $query = "SELECT * FROM mst_account";
        $stmt = $this->connect()->query($query);
        
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
    
    public function updatesingle($query, $values){
        
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$values]);

        return $stmt;
    }

    public function execuser($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14, $f15, $f16, $f17, $f18, $f19, $f20, $f21, $f22, $f23, $f24, $f25, $f26, $f27, $f28){
        
        $sql = "INSERT INTO `mst_account` (
            `fcompanyid`,
            `faccountid`,
            `factive_flag`,
            `fname`,
            `flname`,
            `ffname`,
            `fmname`,
            `faddress`,
            `fphone`,
            `fofficeid`,
            `faccesslvl`,
            `fmemo`,
            `flogon_flag`,
            `fuserid`,
            `fpassword`,
            `fpassword_update`,
            `flast_logon`,
            `fsecurity_question`,
            `fsecurity_answer`,
            `femail`,
            `fbirthdate`,
            `fsex`,
            `fcivil_status`,
            `fcreated_by`,
            `fcreated_date`,
            `fupdated_by`,
            `fupdated_date`,
            `fbirth_place`
        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
 
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14, $f15, $f16, $f17, $f18, $f19, $f20, $f21, $f22, $f23, $f24, $f25, $f26, $f27, $f28]);

        return $stmt;

    }

    public function execproduct($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14, $f15, $f16, $f17, $f18, $f19, $f20, $f21){
        $sql = "INSERT INTO `mst_product` (
            `fcompanyid`,
            `fproductid`,
            `fname`,
            `fdescription`,
            `factive_flag`,
            `fsale_flag`,
            `fmemo`,
            `ftag`,
            `fstnd_cost`,
            `fprev_cost`,
            `ftax_type`,
            `fuom`,
            `fstock`,
            `fstatus`,
            `fexpiry_alert`,
            `fcategory_id`,
            `fwarranty_duration`,
            `fcreated_by`,
            `fcreated_date`,
            `fupdated_by`,
            `fupdated_date`
        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14, $f15, $f16, $f17, $f18, $f19, $f20, $f21]);
        
        return $stmt;
    }

    public function execupdateproduct($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f13, $f14, $params){
        $sql = "UPDATE mst_product SET fname=?, fdescription=?, fexpiry_alert=?, fstnd_cost=?, ftax_type=?, fuom=?, fcategory_id=?, ftag=?, fmemo=?, factive_flag=?, fsale_flag=?, fupdated_by=?, fupdated_date=? WHERE fproductid=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f13, $f14, $params]);

        return $stmt;       

    }

    public function execaddstock($f1, $params){
        $sql = "UPDATE mst_product SET fstock=fstock+? WHERE fproductid=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$f1, $params]);

        return $stmt;
    }

    public function update($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14, $f15, $f16, $f17, $f18, $f19, $f20, $f21, $f22, $f23, $f26, $f27, $f28, $params){
        
        $sql = "UPDATE `mst_account` SET fcompanyid=? ,faccountid=?,
            factive_flag=?,fname=?, ffname=?, flname=?, fmname=?, faddress=?,  fphone=? ,fofficeid=?, faccesslvl=?, fmemo=?, flogon_flag=?, fuserid=?, fpassword=?, fpassword_update=?, flast_logon=?, fsecurity_question=?, fsecurity_answer=?, femail=?, fbirthdate=?, fsex=?, fcivil_status=?, fupdated_by=?, fupdated_date=?, fbirth_place=? WHERE faccountid=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14, $f15, $f16, $f17, $f18, $f19, $f20, $f21, $f22, $f23, $f26, $f27, $f28, $params]);

        return $sql;
            
    }

    public function execategory($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10){
        
        $sql = "INSERT INTO `mst_product_category` (
            `fcompanyid`,
            `fcategoryid`,
            `fcategory_name`,
            `fcategory_description`,
            `fcategory_tag`,
            `fcategory_img`,
            `fcreated_by`,
            `fcreated_date`,
            `fupdated_by`,
            `fupdated_date`
        ) VALUES(?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10]);

        return $stmt;
    }

    public function updatecompany($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $params){
        
        if(empty($f8)){
            $sql = "UPDATE sm_company SET fcompanyemail=?, ftelno=?, ffax=?, faddress=?, fowner=?, fyest=?, fmemo=?, fupdated_by=?, fupdated_date=? WHERE fcompanyid=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$f1, $f2, $f3, $f4, $f5, $f6, $f7, $f9, $f10, $params]);
            return $stmt;
        }
        else{
            $sql = "UPDATE sm_company SET fcompanyemail=?, ftelno=?, ffax=?, faddress=?, fowner=?, fyest=?, fmemo=?, fcompanyimg=?, fupdated_by=?, fupdated_date=? WHERE fcompanyid=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $params]);
            return $stmt;

            
        }

    }

    public function totalrow($table, $params, $value){
        $total_query = "SELECT COUNT(*) as total_count FROM $table WHERE $params"; 
        $total_result = $this->connect()->prepare($total_query);
        $total_result->execute([$value]);
    
        // Fetch the result using fetch() method
        $result = $total_result->fetch(PDO::FETCH_ASSOC);
    
        // Access the 'total_count' column from the fetched result
        $total_count = $result['total_count'];
    
        if($total_count > 0){
            return true;
        } else {
            return false;
            
        }
        
    }
    

    public function paginationctrl($limit) {

        $query = "SELECT * FROM mst_account ORDER BY faccountid DESC LIMIT :limit";
    
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
    
    public function queryselect($query){
        
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
        
    }
    public function getproductimg($f1){
        $sql = "SELECT fcategory_img FROM mst_product_category WHERE fcategoryid=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$f1]);

        return $stmt;
    }

    public function preselect($table, $params, $value){
        $query = "SELECT * FROM $table WHERE $params";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$value]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function deletemultiple($table, $params){
        $query = "DELETE FROM $table WHERE $params";

        $delete = $this->connect()->exec($query);

        if($delete){
            return 'true';
        }
        else{
            return 'false';
        }
    }

    public function getmonthlygross($params){
        $query = "
        SELECT months.month AS month, COALESCE(SUM(pr.fgross), 0) AS total_gross
        FROM (
          SELECT 1 AS month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION
          SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12
        ) AS months
        LEFT JOIN pos_reading AS pr ON months.month = MONTH(pr.fsale_date) AND pr.fcompanyid = ?
        GROUP BY months.month
        ORDER BY months.month;
        
        ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$params]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $res;
        
    }
    
    public function gettopproducts($params){
        $query = "
        SELECT p.fname, SUM(sp.fqty) AS product_count
        FROM pos_sale_product AS sp
        JOIN mst_product AS p ON sp.fproductid = p.fproductid
        WHERE sp.fcompanyid = ?
        GROUP BY sp.fproductid
        ORDER BY product_count DESC
        LIMIT 5;
              
        ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$params]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $res;
    }

    public function getcurrentmonthsales($params){
        $query = "
        SELECT SUM(fgross) AS total_sales
        FROM pos_reading
        WHERE fcompanyid = ? AND YEAR(fsale_date) = YEAR(CURDATE()) AND MONTH(fsale_date) = MONTH(CURDATE());
        ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$params]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $res;
    }

    public function getpresentnrgt($params){
        $query = "
        SELECT SUM(fgross) AS presentnrgt
        FROM pos_reading
        WHERE fsale_date >= (SELECT MIN(fsale_date) FROM pos_reading)
        AND fcompanyid = ?
        ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$params]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $res;
    }


    public function getavegrosspermonth($params){
        $query = "
        SELECT
        YEAR(fsale_date) AS year,
        MONTH(fsale_date) AS month,
        AVG(fgross) AS average_gross
        FROM pos_reading WHERE
        fcompanyid = ?
        ORDER BY YEAR(fsale_date), MONTH(fsale_date);
        ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$params]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $res;
    }

    public function getversion(){
        $query = "
        SELECT * FROM sm_version ORDER BY fversion_released_date DESC LIMIT 1
        ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $res;
    }

    public function insertcompany($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14, $f15, $f16, $f17, $f18, $f19){
        $sql = "INSERT INTO `sm_company` (
            `fcompanyid`,
            `fname`,
            `factive_flag`,
            `faddress`,
            `fcompanylicense`,
            `fcompanykey`,
            `ftelno`,
            `fmemo`,
            `fexpiry`,
            `fcompanyemail`,
            `ffax`,
            `fowner`,
            `fyest`,
            `fverified`,
            `fcompanyimg`,
            `fcreated_by`,
            `fcreated_date`,
            `fupdated_by`,
            `fupdated_date`
        ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14, $f15, $f16, $f17, $f18, $f19]);

        return $stmt;
    }

    public function disablecompany(){
        $sql = "
        UPDATE sm_company SET factive_flag='0' WHERE factive_flag='1';
        ";
        $stmt = $this->connect()->exec($sql);

        return $stmt;
    }

    public function validatecreds($compid, $compkey){
        $query = "SELECT * FROM sm_company WHERE fcompanyid=? AND fcompanykey=? AND factive_flag='1'";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$compid, $compkey]);
    
        // Count the number of returned rows
        $rowCount = $stmt->rowCount();
    
        return $rowCount;
    }
    




}
