<?php

/**
 * plugin options
 */
class PluginOptions {
	
	private $options;
	function __construct() {
		$this->options = get_option(RX_PORTFOLIO_OPTION_GROUP);		
	}
	
	private static $instance;
	public static function getInstance(){
		if(!self::$instance){
			self::$instance = new PluginOptions();
		}
		return self::$instance;		
	}
	
	public function getRelatedSettings(){
		$showRelated = (isset($this->options['showRelated']))?$this->options['showRelated']:'';
		$showRelated = ($showRelated=="ON")?true:false;
		$relatedProjectsMaxNo = (isset($this->options['relatedProjectsMaxNo']))?$this->options['relatedProjectsMaxNo']:'3';
		return array('showRelated'=>$showRelated, 'relatedProjectsMaxNo'=>$relatedProjectsMaxNo);		
	}	
	
	public function getLabels(){		
		$readMoreLB = (isset($this->options['readMoreLB']))?$this->options['readMoreLB']:'Read more';
		$nextLB = (isset($this->options['nextLB']))?$this->options['nextLB']:'Next';
		$prevLB = (isset($this->options['prevLB']))?$this->options['prevLB']:'Previous';
		$relatedLB = (isset($this->options['relatedLB']))?$this->options['relatedLB']:'Related projects';				
		return array('readMoreLB'=>$readMoreLB, 'nextLB'=>$nextLB, 'prevLB'=>$prevLB, 'relatedLB'=>$relatedLB);
	}
	
	public function getColors(){
		$overlayBackCol = (isset($this->options['overlayBackCol']))?$this->options['overlayBackCol']:'283d53';						
		$overlayTitleCol = (isset($this->options['overlayTitleCol']))?$this->options['overlayTitleCol']:'F2F2F2';
		$overlayExcerptCol = (isset($this->options['overlayExcerptCol']))?$this->options['overlayExcerptCol']:'d43f5d';
		$overlayButtonCol = (isset($this->options['overlayButtonCol']))?$this->options['overlayButtonCol']:'F2F2F2';
		$overlayButtonBackground = (isset($this->options['overlayButtonBackground']))?$this->options['overlayButtonBackground']:'df4564';
		
		$related_overlay_rgb = $this->html2rgb($overlayBackCol);
		$underline_rgb = $this->html2rgb($overlayTitleCol);
		$button_background_light = $this->adjustBrightness($overlayButtonBackground, 30);
		
		return array('overlayBackCol'=>$overlayBackCol, 'overlayTitleCol'=>$overlayTitleCol, 'overlayExcerptCol'=>$overlayExcerptCol, 
		'overlayButtonCol'=>$overlayButtonCol, 'overlayButtonBackground'=>$overlayButtonBackground, 'related_overlay_rgb'=>$related_overlay_rgb, 'button_background_light'=>$button_background_light, 
		'underline_rgb'=>$underline_rgb);		
	}

	public function getCustomCSS(){
		$colors = $this->getColors();
		$custom_css = '';
		$custom_css .= '
		.rx_hero_hoverui, .rx_hero_hoverui_one_col{
			background-color: #'.$colors['overlayBackCol'].';
		}
		h3.rx_hero_thumb_title, h2.rx_hero_thumb_title_one_col{
			color: #'.$colors['overlayTitleCol'].' !important;
		}
		.rx_hero_thumb_underline{
			background-color: #'.$colors['overlayTitleCol'].';
			background: rgba('.$colors['underline_rgb'][0].', '.$colors['underline_rgb'][1].', '.$colors['underline_rgb'][2].', .5);			
		}
		p.rx_hero_excerpt{
			color: #'.$colors['overlayExcerptCol'].';	
		}
		a.rx_hero_read_more{
			color: #'.$colors['overlayButtonCol'].' !important;
			background-color: #'.$colors['overlayButtonBackground'].';
		}
		a.rx_hero_read_more:hover{
			color: #'.$colors['overlayButtonCol'].' !important;
			background-color: '.$colors['button_background_light'].' !important;
		}
		.rx_related_overlay{
			background-color: #'.$colors['overlayBackCol'].';
			background: rgba('.$colors['related_overlay_rgb'][0].', '.$colors['related_overlay_rgb'][1].', '.$colors['related_overlay_rgb'][2].', .8);			
		}
		h3.rx_related_title{
			color: #'.$colors['overlayTitleCol'].' !important;
		}
		';
		return $custom_css;		
	}
	
	
	public function adjustBrightness($hex, $steps) {
	    // Steps should be between -255 and 255. Negative = darker, positive = lighter
	    $steps = max(-255, min(255, $steps));
	
	    // Format the hex color string
	    $hex = str_replace('#', '', $hex);
	    if (strlen($hex) == 3) {
	        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
	    }
	
	    // Get decimal values
	    $r = hexdec(substr($hex,0,2));
	    $g = hexdec(substr($hex,2,2));
	    $b = hexdec(substr($hex,4,2));
	
	    // Adjust number of steps and keep it inside 0 to 255
	    $r = max(0,min(255,$r + $steps));
	    $g = max(0,min(255,$g + $steps));  
	    $b = max(0,min(255,$b + $steps));
	
	    $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
	    $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
	    $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
	
	    return '#'.$r_hex.$g_hex.$b_hex;
	}
	
	
	//utils - convert hex to rgb	
	public function html2rgb($color)
	{
	    if ($color[0] == '#')
	        $color = substr($color, 1);
	    if (strlen($color) == 6)
	        list($r, $g, $b) = array($color[0].$color[1],
	                                 $color[2].$color[3],
	                                 $color[4].$color[5]);
	    elseif (strlen($color) == 3)
	        list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
	    else
	        return false;
	    $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);
	    return array($r, $g, $b);
	}	
	
	
	
}


?>