
<html>
  <meta charset="utf8">
  <title>FILTER</title>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css" /> 
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    <?php

        require_once 'db_login.php';

        mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWORD);
        mysql_select_db(DB_NAME); 
        $x=mysql_query("SELECT * FROM ".DB_TABL_NAME."  "); 

        $math_max=0; 
        $math_min=1000000; 

        while($xb= mysql_fetch_array($x)){  
      
            $math = $xb[cena];
            if($math_max<$math )
            {$math_max = $math;} 
 
            if($math_min>$math )
            {$math_min = $math;}

      
        }

    ?>
    
    <script>
      var min=<?php echo $math_min; ?>;
      var max=<?php echo $math_max; ?>;        
   </script>  
   <script src='script.js'></script>

 </head>
  
 <body>
   
   <div class='conteiner'>      
     <div class='wrapper' >   
       <div class='block1' >
         <div class='block'>
           <input type="radio" id="radio" name="radio" value='roll'/>
           <label for="radio">РОЛЛЫ</label>
         </div>
         
         <div class='block'>
           <input type="radio" id="radio1" name="radio" value='sushi' />
           <label for="radio1">СУШИ</label>
         </div>
         
         <div class='block'>
           <input type="radio" id="radio2" name="radio" value='seti' />
           <label for="radio2">СЕТЫ</label>
         </div>
         
         <div class='block'>
           <input type="radio" id="radio3" name="radio" value='bar' />
           <label for="radio3">БАР</label>
         </div>
         <div class='block'>
           <input type="radio" id="radio4" name="radio" value='pizza' />
           <label for="radio4">ПИЦЦА</label>
         </div>
       </div>
        
       <div class='block2'>
  
         <div class='block'>
           <input type="radio" id="radio5" name="radio" value='salati' />
           <label for="radio5">САЛАТЫ</label>
         </div>
         
         <div class='block'>
           <input type="radio" id="radio6" name="radio" value='supi' />
           <label for="radio6">СУПЫ</label>
         </div>
         
        <div class='block'>
          <input type="radio" id="radio7" name="radio" value='gorachee' />
          <label for="radio7">ГОРЯЧЕЕ</label>
        </div>
         
        <div class='block'>
          <input type="radio" id="radio8" name="radio" value='desert' />
          <label for="radio8">ДЕСЕРТЫ</label>
        </div>
         
        <div class='block'>
          <input type="radio" id="radio9" name="radio" checked="checked" value='all' />
          <label for="radio9">ВСЕ</label>
        </div> 
  
      </div>
     
      <p class = 'p'>
        <label for="amount"><b>Цена:</b></label>
        <input type="text" id="amount" readonly >
      </p>
 
      <div class='slide_block' > 
        <div id="slider-range" ></div> 
      </div>
       
     <div class="block1">
       
       <div class="block" >
         <input type="checkbox" id="check" name="check" value="new" >
         <label for="check">НОВИНКА</label>
       </div>
       
       <div class="block">
         <input type="checkbox" id="check1" name="check1" value="veg">
         <label for="check1">ВЕГЕТАРИАНСКИЕ</label>
       </div>
       
       <div class="block">
         <input type="checkbox" id="check2" name="check2" value="akc">
         <label for="check2">АКЦИЯ</label>
       </div>
       
       <div class="block">
         <input type="checkbox" id="check3" name="check3" value="hit">
         <label for="check3">ХИТ ПРОДАЖ</label>
       </div>
       
       <div class="block">
         <input type="checkbox" id="check4" name="check4" value="ostr">
         <label for="check4">ОСТРОЕ</label>
       </div>
       
      </div>
       
        <button class='button'><b>НАЙТИ</b></button>
         
      </div>
     
      <div class="block_cart">   
        <div  class='res1'></div>
      </div>
   
   
    </div>
  <script src='script.js'></script>
  </body>
</html>

