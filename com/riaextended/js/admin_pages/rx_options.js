jQuery(document).ready(function(){    
    RxOptionPage();
});


function RxOptionPage(){

    initColors();
    function initColors(){  
        /*   
        jQuery('#overlayBackCol, #overlayTitleCol, #overlayExcerptCol, #overlayButtonCol, #overlayButtonBackground').ColorPicker({
            onSubmit: function(hsb, hex, rgb, el) {
                jQuery(el).val(hex);
                jQuery(el).ColorPickerHide();
            },
            onBeforeShow: function () {
                jQuery(this).ColorPickerSetColor(this.value);
            }            
        }).bind('keyup', function(){
            jQuery(this).ColorPickerSetColor(this.value);
        }); 
*/

        jQuery("#overlayBackCol").colpick({
            layout:'hex',
            submit:0,
            colorScheme:'dark',
            color: jQuery("#overlayBackCol").val(),
            onChange:function(hsb,hex,rgb,el,bySetColor) {
                jQuery(el).css('border-color','#'+hex);
                // Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
                if(!bySetColor) jQuery(el).val(hex);
            }
        }).keyup(function(){
            jQuery(this).colpickSetColor(this.value);
        });

        jQuery("#overlayTitleCol").colpick({
            layout:'hex',
            submit:0,
            colorScheme:'dark',
            color: jQuery("#overlayTitleCol").val(),
            onChange:function(hsb,hex,rgb,el,bySetColor) {
                jQuery(el).css('border-color','#'+hex);
                // Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
                if(!bySetColor) jQuery(el).val(hex);
            }
        }).keyup(function(){
            jQuery(this).colpickSetColor(this.value);
        });

        jQuery("#overlayExcerptCol").colpick({
            layout:'hex',
            submit:0,
            colorScheme:'dark',
            color: jQuery("#overlayExcerptCol").val(),
            onChange:function(hsb,hex,rgb,el,bySetColor) {
                jQuery(el).css('border-color','#'+hex);
                // Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
                if(!bySetColor) jQuery(el).val(hex);
            }
        }).keyup(function(){
            jQuery(this).colpickSetColor(this.value);
        });

        jQuery("#overlayButtonCol").colpick({
            layout:'hex',
            submit:0,
            colorScheme:'dark',
            color: jQuery("#overlayButtonCol").val(),
            onChange:function(hsb,hex,rgb,el,bySetColor) {
                jQuery(el).css('border-color','#'+hex);
                // Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
                if(!bySetColor) jQuery(el).val(hex);
            }
        }).keyup(function(){
            jQuery(this).colpickSetColor(this.value);
        });

        jQuery("#overlayButtonBackground").colpick({
            layout:'hex',
            submit:0,
            colorScheme:'dark',
            color: jQuery("#overlayButtonBackground").val(),
            onChange:function(hsb,hex,rgb,el,bySetColor) {
                jQuery(el).css('border-color','#'+hex);
                // Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
                if(!bySetColor) jQuery(el).val(hex);
            }
        }).keyup(function(){
            jQuery(this).colpickSetColor(this.value);
        });                                


        jQuery('#resetRxColorsBTN').click(function(e){
            e.preventDefault();
            jQuery('#overlayBackCol').val('283d53');
            jQuery('#overlayTitleCol').val('F2F2F2');
            jQuery('#overlayExcerptCol').val('d43f5d');
            jQuery('#overlayButtonCol').val('F2F2F2');
            jQuery('#overlayButtonBackground').val('df4564');            
        });        
    }


    
}
