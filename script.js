
$(function() {
    $( "#slider-range" ).slider({
        range: true,
        min: min,
        max: max,
        values: [ 0, 900 ],
        slide: function( event, ui ) {
            $( "#amount" ).val(  + ui.values[ 0 ] + "   -   " + ui.values[ 1 ] );
            max = ui.values[ 1 ];
            min = ui.values[ 0 ];  
        }
    });
              
    $( "#amount" ).val(  + $( "#slider-range" ).slider( "values", 0 ) +
              "   -   " + $( "#slider-range" ).slider( "values", 1 ) );
});
  
var hex = {'new':false, 'veg':false, 'akc':false, 'hit':false, 'ostr':false};
  
$('input[type=checkbox]')[0].checked = false; // сброс флага
$('input[type=checkbox]')[1].checked = false; // сброс флага
$('input[type=checkbox]')[2].checked = false; // сброс флага
$('input[type=checkbox]')[3].checked = false; // сброс флага
$('input[type=checkbox]')[4].checked = false; // сброс флага
  
$('input[type=checkbox]').click(function(){ 
  
    var flag = $(this).prop('checked');
    var name = $(this).val();
  
    switch(name){
        
        case 'new': 
            hex['new']=flag; 
            break;
        case 'veg': 
            hex['veg']=flag; 
            break;
        case 'akc': 
            hex['akc']=flag; 
            break;
        case 'hit': 
            hex['hit']=flag; 
            break;
        case 'ostr': 
            hex['ostr']=flag; 
            break;
        
   }
    
});
  
$('#radio9').click();
var cat ='all';

$('[type=radio]').click(function(){   
    cat = $(this).val();         
});
      
var id=0,count=1;
var rs=".res";

var bottom = $("body").height();
var START_BOTTOM = bottom;

$(window).scroll(function() {   
    
    if($(window).scrollTop() >= bottom){ 
        bottom = $(window).height();
        rs = ".res"+count+""; 
        get();  
    }
    
});
  

$(".button").click(function(){ 
  
    bottom = START_BOTTOM; 
    count = 1;
    rs = ".res"+count+"";
    id = 0; 
    get();
  
}); 

function get(){ 
  
    count = count+1; 
    $(rs).animate({ opacity:0 }, 50 );
    $(rs).animate({ opacity:1 }, 1000 );
  
    $.ajax({
        type:"post",
        url:"filter.php",
        data:{"str": +max+" "+min,"category":cat, "arr_check":hex, "id":id, "coun":count },
        success:function(html){
            $(rs).html(html);
        }
   }); 
}

  
  
    