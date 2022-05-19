window.addEventListener('scroll', function() {
    var sc = document.documentElement.scrollHeight;
    var sc_r = window.innerHeight;
   if(pageYOffset > sc - sc_r - 50){
   load();
   }
   
  });
reload();
function reload(){
    var sc = document.documentElement.scrollHeight;
    var sc_r = window.innerHeight;
    if(sc == sc_r){
        load();
        setTimeout(reload, 10);
    }  
}
  function load(){
    $.ajax({
        method: "GET",
        url: "ajax/load.php",
        dataType: "text",
        data: {stage: stage},
        success: function(data){  
            var html = $('#map').html();
            $('#map').html(html + data);
            console.log("load");
         stage += 10;
      }
  }); 
  }