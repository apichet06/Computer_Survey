$('#form_login').on('submit', function(e) {
  e.preventDefault();
  var login = "login";

  $.ajax({
    url: "login/manages.php",
    type:"POST",
    dataType: "json",
    data : $(this).serialize()+"&login="+login,
    success:function(data){
      console.log(data.number);
      if(data.number == '1'){
        window.location = data.url;
      }else{
       setTimeout(function(){
         $("#myAlert").show('fade');
       },1000);
     }
   }

 });
});
 