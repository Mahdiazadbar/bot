<?php
require_once '../Spout/Autoloader/autoload.php';

use Box\Spout\Common\Type;
use Box\Spout\Reader\ReaderFactory;

include '../simplexlsx.class.php';
include '../database.php';
include '../Classes/PHPExcel/IOFactory.php';


error_reporting(0);
@ini_set('display_errors', 0);
$inputFileType = 'Excel2007';

$myfunc = new func();

if (isset($_FILES['filepath'])) {
    $errors = array();
    $file_name = $_FILES['filepath']['name'];
    $file_size = $_FILES['filepath']['size'];
    $file_tmp = $_FILES['filepath']['tmp_name'];
    $file_type = $_FILES['filepath']['type'];
    $file_ext = strtolower(end(explode('.', $_FILES['filepath']['name'])));

    try {
        move_uploaded_file($file_tmp, "files/" . $file_name);
        $adress = "files/" . $file_name;

        $reader = ReaderFactory::create(Type::XLSX);;

        $reader->open($adress);
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }


    $count=0;
    foreach ($reader->getSheetIterator() as $sheet) {
        if ($sheet->getIndex() == 0) {
            foreach ($sheet->getRowIterator() as $row) {

                if ($count>0) {
                    $ref_num = "";
                    if (isset($row[0]))
                        $ref_num = $row[0];

                    $startserial = "";
                    if (isset($row[1]))
                        $startserial = $row[1];

                    $endserial = "";
                    if (isset($row[2]))
                        $endserial = $row[2];

                    $product_qty = 0;
                    if (isset($row[3]))
                        $product_qty = preg_replace("/[^0-9,.]/", "", $row[3]);

                    $total_use_qty = '';
                    if (isset($row[4]))
                        $total_use_qty = $row[4];

                    $oprator = "";
                    if (isset($row[5]))
                        $oprator = $row[5];

                    $customer = "";
                    if (isset($row[6]))
                        $customer = $row[6];

                    $dateT = "";
                    if (isset($row[7])) {
                        $dateT = $row[7];
                        $dateT=date_format($dateT, 'Y-m-d');
                    }

                    $roll_number = 0;
					try{
                    if (isset($row[8]))
                        $roll_number = preg_replace("/[^0-9,.]/", "", $row[8]);
					}catch (Exception $e) {
                        echo 'Caught exception: ', $e->getMessage(), "\n";
                    }

                    $fault_number = 0;
					try{
                    if (isset($row[9]))
                        $fault_number = preg_replace("/[^0-9,.]/", "", $row[9]);
					} catch (Exception $e) {
                        echo 'Caught exception: ', $e->getMessage(), "\n";
                    }

                    $l = "";
					try{
                    if (isset($row[10]))
                        $l = $row[10];
					} catch (Exception $e) {
                        echo 'Caught exception: ', $e->getMessage(), "\n";
                    }
					
					
                    $m = "";
					try{
                    if (isset($row[11]))
                        $m = $row[11];
					} catch (Exception $e) {
                        echo "";
                    }
					
					
                    $n = "";
					try{
                    if (isset($row[12]))
                        $n = $row[12];
					} catch (Exception $e) {
                        echo "";
                    }
					
					
					
                    $o = "";
					try{
                    if (isset($row[13]))
                        $o = $row[13];
					} catch (Exception $e) {
                        echo "";
                    }
					
					
					
                    $p = "";
					try{
                    if (isset($row[14]))
                        $p = $row[14];
					} catch (Exception $e) {
                        echo "";
                    }
					
					
					
                    $q = "";
					try{
                    if (isset($row[15]))
                        $q = $row[15];
					} catch (Exception $e) {
                        echo "";
                    }
					
					
					
                    $r = "";
					try{
                    if (isset($row[16]))
                        $r = $row[16];
					} catch (Exception $e) {
                        echo "";
                    }
					
					
					
                    $s = "";
					try{
                    if (isset($row[17]))
                        $s = $row[17];
					} catch (Exception $e) {
                        echo "";
                    }
					
					
					
                    $t = "";
					try{
                    if (isset($row[18]))
                        $t = $row[18];
					} catch (Exception $e) {
                        echo "";
                    }
					
					
					


                    try {
                        if ($product_qty > 0) {

                            $query = "INSERT INTO";
                            $query=$query. " seriallist (ref_num,startserial,endserial,product_qty,total_use_qty,oprator,customer,dateT,roll_number,fault_number,l,m,n,o,p,q,r,s,t,y)";
	                        $query=$query. " VALUES";
                            $query=$query." ('$ref_num','";
                            $query=$query."$startserial','";
                            $query=$query."$endserial','";
                            $query=$query."$product_qty','";
                            $query=$query."$total_use_qty','";
                            $query=$query."$oprator','";
                            $query=$query."$customer','";
                            $query=$query."$dateT','";
                            $query=$query."$roll_number','";
                            $query=$query."$fault_number','";
                            $query=$query."$l','";
                            $query=$query."$m','";
                            $query=$query."$n','";
                            $query=$query."$o','";
                            $query=$query."$p','";
                            $query=$query."$q','";
                            $query=$query."$r','";
                            $query=$query."$s','";
                            $query=$query."$t','')";

                            $a = $myfunc->database_helper($query);
                            if ($a == 0) {
                                echo $x . " " . $a . "\n";
                            }

                        }

                    } catch (Exception $e) {
                        echo 'Caught exception: ', $e->getMessage(), "\n";
                    }
                }
                $count++;
               
                echo  $count;
            }
        }
    }

    $reader->close();


    echo "با موفقیت داده های جدید جایگزین شد. تعداد ستون های درج شده " . $number;


} else {
    echo '<p class=""error>' . $error . '</p>';
}


?>
<div class="header">
    <p class="tit">
        فایل اکسل مورد نظر را انتخاب کنید
    </p>
</div>
<div class="area">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="up">
            <input type="file" name="filepath"/>
        </div>
        <p></p>
        <div class="key">
            <button type="submit">ایمپورت کن!</button>
        </div>
    </form>
</div>


<style>
    .area {
        background: wheat;
        border-style: solid;
        border-radius: 40px;
    }

    .tit {
        font-size: 25px;
        font-family: tahoma;
        margin-left: 20%;
    }

    form {
        margin-left: 30%;
        margin-top: 20px;
    }

    .ok {
        margin-left: 30%;
        color: #21e421;
        font-family: tahoma;
        font-size: 20px;
    }
</style>