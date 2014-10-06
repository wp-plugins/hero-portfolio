jQuery(document).ready(function(){    
    var rx_hero = new RxHero();
});

function RxHero(){
    
    hero_thumbs_roll();
    function hero_thumbs_roll(){        
        jQuery('.hero_thumb_ui').each(function(indx){
            var speed = .3;
            
            jQuery(this).find('.rx_hero_hoverui').css('opacity', 0);
            jQuery(this).find('.rx_hero_hoverui').css('display', 'block');
            TweenMax.to(jQuery(this).find('.rx_hero_hoverui'), 0, {rotationY:-90, transformOrigin:"left top"});
            
            jQuery(this).find('.rx_hero_hoverui_one_col').css('opacity', 0);
            jQuery(this).find('.rx_hero_hoverui_one_col').css('display', 'block');
            TweenMax.to(jQuery(this).find('.rx_hero_hoverui_one_col'), 0, {rotationY:-90, transformOrigin:"left top"});            
            
            jQuery(this).hover(function(e){
                TweenMax.to(jQuery(this).find('.hero_thumb_image_link'), speed, {css:{left: '25%', delay: .2}, ease:Power3.EaseIn});                
                TweenMax.to(jQuery(this).find('.rx_hero_hoverui'), speed, {rotationY:0, transformOrigin:"left top"});                                
                TweenMax.to(jQuery(this).find('.rx_hero_hoverui_one_col'), speed, {rotationY:0, transformOrigin:"left top"});                
                
                jQuery(this).find('.rx_hero_hoverui').css('opacity', 1);
                jQuery(this).find('.rx_hero_hoverui_one_col').css('opacity', 1);                
            }, function(e){
                TweenMax.to(jQuery(this).find('.hero_thumb_image_link'), .25, {css:{left: 0}, ease:Power3.EaseIn});                
                TweenMax.to(jQuery(this).find('.rx_hero_hoverui'), speed, {rotationY:-90, transformOrigin:"left top"});                                
                TweenMax.to(jQuery(this).find('.rx_hero_hoverui_one_col'), speed, {rotationY:-90, transformOrigin:"left top"});                                               
            });
        });      
    }    
 
    
}
