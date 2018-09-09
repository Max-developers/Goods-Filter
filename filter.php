
<?php

class db_authorization{
  
    public $HOST;
    public $LOGIN;
    public $PASSWORD;
    public $DB_NAME;
    public $TABL_NAME;
  
    public function db(){ 
        mysql_connect($this->HOST, $this->LOGIN, $this->PASSWORD);
        mysql_select_db($this->DB_NAME); 
        mysql_set_charset("utf8"); 
        $x = mysql_query("SELECT * FROM ".$this->TABL_NAME." "); 
        $line = mysql_query("SELECT COUNT(1) FROM ".$this->TABL_NAME." ");
        $arr_line= mysql_fetch_array($line);
        $count_line = $arr_line[0];
        new  cycle($x,$count_line);
    }

}
 

class cycle {
  
    private $count_product=0;

    public function __construct($x,$count_line){  
      $previous_id =  $_POST["id"];
      $count_cycle = 0;
      $NO_TOVAR = false;
         while($xb= mysql_fetch_array($x))
         { 
              $count_cycle++;
              $cena = $xb[cena];
              $category = $xb[category];
              $marker = $xb[marker];
              $name = $xb[name];
              $img = $xb[img]; 
              $id = $xb[id];
              if($previous_id == 0 or $id > $previous_id){
              $this->valbool=new filter_carts($cena,$name,$category,$marker,$img,$value);
              $test_val =  $this->valbool->value;
              if($test_val){ 
                  $count_product++;   
                  $cou_sim=strlen($cena);  
              }
     
              if($count_product>0){ $NO_TOVAR=true; }
             
              if($count_line == $count_cycle){ 
                  echo "<script> id=".$id."; </script>"; 
                  if($NO_TOVAR==false and $previous_id==0){
                      echo '<div class="no_tovar">Данного товара нет в наличии</div>';
                  } break; 
              } 
             
              if($count_product==9){ 
                  echo "<script> id=".$id."; </script>"; 
                  break; 
              }
           }
        } 
   }    

}

trait pattern{
    //Обработка radiobutton
    private  function radio($cat,$category,$pass){
        if($pass){
            if($cat != all){ 
                if($category == $cat) return true; 
                else return false;       
            }   else return true;  
        }
    }
  
    //Обработка slider
    private function slider($cena,$max,$min,$pass){ 
        if($pass){
            if($cena <= $max and $cena >= $min) return true; 
            else return false; 
        }     
    }
    
    //Обработка checkbox hc arr_check
    private function checkbox($arr_check,$marker,$pass){
        if($pass){ 
            foreach($arr_check as $key=>$vl){
                if($vl=='true'){ 
                    $check = true; 
                    if($key==$marker){ 
                        return true; 
                        break;
                    }
                }
             } 
          if($check == false) return true; // Если checkbox не используется то возвращается true
        }
     }
    
  
}


class filter_carts extends cycle{
  
    use pattern;
       
    public function __construct($cena,$name,$category,$marker,$img,$value){  
       
        $filter = $_POST["str"]; // Загрузка переменных с помощью AJAX - запроса
        $fill = explode(" ",$filter); // Загрузка переменных в массив
        $max = $fill[0]; //Максимальная цена
        $min = $fill[1]; //Минимальная цена
        $cat =  $_POST['category'];
        $arr_check = $_POST['arr_check'];  
      
        $pass = true;
        $pass = $this-> radio($cat,$category,$pass);       // Фильтр по radiobutton
        $pass = $this-> slider($cena,$max,$min,$pass);     // Фильтр по slider
        $pass = $this-> checkbox($arr_check,$marker,$pass);// Фильтр по checkbox
      
        $this->value=$pass; //count
        new display_carts($cena,$img,$name,$pass,$marker);

    }         
}  


class display_carts{
 
    public function __construct($cena,$img,$name,$pass,$marker){  
      if($pass) {
         
            if($marker != 'NO'){
                $d='<img src="icon/'.$marker.'.png" style="position:absolute; 
                margin:9px 105px;">';
            }
        echo   '<div class="cart"> 
                     '.$d.'
                      <div class="image">
                        <img width=100% height=161px src="Image/'.$img.'">
                      </div> 
                      
                      <div class="name">
                        <div class="namesp">'.$name.'</div>
                        <img src="icon/stars.png">
                      </div>
                      
                      <div class="cn">
                        <div class="cena">'.$cena.' р.</div>
                        <img src="icon/corzina.png">
                      </div>
                     
                    </div>';                          
       }   
   }
}




$reg = new db_authorization;
require_once 'db_login.php';

$reg-> HOST = DB_HOST;  
$reg-> LOGIN = DB_LOGIN;  
$reg-> PASSWORD = DB_PASSWORD; 
$reg-> DB_NAME = DB_NAME; 
$reg-> TABL_NAME = DB_TABL_NAME; 
$reg-> db();

$coun=$_POST["coun"]; 
echo "<div  class='res".$coun."'></div>";

 
