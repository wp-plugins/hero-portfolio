jQuery(document).ready(function(){    
    var rx_hero_page = new RxHeroPage();
});

function RxHeroPage(){
     //init carousels     
     function initCarousels(){
         var featured_ui = jQuery('.rx_featured_ui');
         if(featured_ui!=null && rx_featured_ui!=undefined){
             var carousel = rx_featured_ui.find('.carousel');
             carousel.carousel({interval: 5000});
         }      
     }
     
     initRelatedProjects();
     function initRelatedProjects(){
         jQuery('.rx_related_project').each(function(indx){             
             jQuery(this).hover(function(e){                 
                 if(jQuery(this).find('.rx_related_overlay').css('display')=='none'){
                     jQuery(this).find('.rx_related_overlay').css('opacity', 0);
                     jQuery(this).find('.rx_related_overlay').css('display', 'block');
                 }
                 TweenMax.to(jQuery(this).find('.rx_related_overlay'), .2, {css:{opacity: 1}, ease:Power3.EaseIn});
             }, function(e){
                 TweenMax.to(jQuery(this).find('.rx_related_overlay'), .3, {css:{opacity: 0}, ease:Power3.EaseIn});
             });
             
             jQuery(this).find('.rx_related_overlay').click(function(e){
                 e.preventDefault();
                 var url = jQuery(this).attr('data-url');
                 try{
                     window.location = url;
                 }catch(e){}
             });
         });
     }     
    
}
