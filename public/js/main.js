/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var url = "http://localhost/proyectobase/public";

window.addEventListener("load", function(){
    
    $('.like').css('cursor', 'pointer');
    $('.dislike').css('cursor', 'pointer');
    
    function like(){
         $('.like').unbind('click').click(function (){ 
             $(this).addClass('dislike').removeClass('like'); 
             $.ajax({ 
                 url: url+'/like/'+$(this).data('id'), 
                 type:'GET',
                 success: function (response){
                     if(response.like){
                         console.log(response);    
                     }else{
                         console.log(response);    
                     }
                 }
             });
             dislike(); 
         });
    }
   like ();
   
    function dislike(){
        $('.dislike').unbind('click').click(function (){ $(this).addClass('like').removeClass('dislike'); 
            $.ajax({ 
                 url: url+'/dislike/'+$(this).data('id'), 
                 type:'GET',
                 success: function (response){
                     if(response.like){
                         console.log(response);       
                     }else{
                         console.log(response);    
                     }
                 }
             });
            
            like(); 
        
        }); 
    }
    dislike();
    
   //buscador
   
   $('#frmsearch').submit(function(e){
       //e.preventDefault();
      $(this).attr('action',url+'/listUser/'+$('#frmsearch #insearch').val());
      //$(this).submit();
   });
   
});



