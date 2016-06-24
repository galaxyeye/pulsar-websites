<?php 

/**
 * Securimage-Driven Captcha Component
 * @author debuggeddesigns.com
 * @license MIT
 * @version 0.1
 */
 
//cakephp's version of a require_once() call
// vendor('securimage'.DS.'securimage'); //use this with the 1.1 core
App::import('Vendor','Securimage' ,array('file'=>'securimage'.DS.'securimage.php')); //use this with the 1.2 core

//the local directory of the vendor used to retrieve files
define('CAPTCHA_VENDOR_DIR', APP_SRC . 'vendor' . DS . 'securimage/');

class CaptchaComponent extends Object {

    var $controller;

    //size configuration
    var $_image_height = 75; //the height of the captcha image
    var $_image_width = 350; //the width of the captcha image

    //background configuration
    var $_draw_lines = false; //whether to draw horizontal and vertical lines on the image
    var $_draw_lines_over_text = false; //whether to draw the lines over the text
    var $_draw_angled_lines = false; //whether to draw angled lines on the image

    var $_image_bg_color = '#ffffff'; //the background color for the image
    var $_line_color = '#cccccc'; //the color of the lines drawn on the image
    var $_line_distance = 15; //how far apart to space the lines from eachother in pixels
    var $_line_thickness = 1; //how thick to draw the lines in pixels
    var $_arc_line_colors = '#999999,#cccccc'; //the colors of arced lines

    //text configuration
    var $_use_gd_font = false; //whether to use a gd font instead of a ttf font
    var $_use_multi_text = true; //whether to use multiple colors for each character
    var $_use_transparent_text = true; //whether to make characters appear transparent
    var $_use_word_list = false; //whether to use a word list file instead of random code

    var $_charset = 'ABCDEFGHKLMNPRSTUVWYZ23456789'; //the character set used in image
    var $_code_length = 5; //the length of the code to generate
    var $_font_size = 45; //the font size
    var $_gd_font_size = 50; //the approxiate size of the font in pixels
    var $_text_color = '#000000'; //the color of the text - ignored if $_multi_text_color set
    var $_multi_text_color = '#ff0000,#0066ff,#660000'; //the colors of the text
    var $_text_transparency_percentage = 0; //the percentage of transparency, 0 to 100
    var $_text_angle_maximum = 21; //maximum angle of text in degrees
    var $_text_angle_minimum = -21; //minimum angle of text in degrees
    var $_text_maximum_distance = 70; //maximum distance for spacing between letters in pixels
    var $_text_minimum_distance = 68; //minimum distance for spacing between letters in pixels
    var $_text_x_start = 10; //the x-position on the image where letter drawing will begin

    //filename and/or directory configuration
    var $_audio_path = 'audio/'; //the full path to wav files used
    var $_gd_font_file = 'gdfonts/bubblebath.gdf'; //the gd font to use
    var $_ttf_file = 'elephant.ttf'; //the path to the ttf font file to load
    var $_wordlist_file = 'words/words.txt'; //the wordlist to use

    function startup( &$controller ) {

        //add local directory name to paths
        $this->_ttf_file = CAPTCHA_VENDOR_DIR.$this->_ttf_file; 
		$this->_gd_font_file = CAPTCHA_VENDOR_DIR.$this->_gd_font_file;
    	$this->_audio_path = CAPTCHA_VENDOR_DIR.$this->_audio_path;
    	$this->_wordlist_file = CAPTCHA_VENDOR_DIR.$this->_wordlist_file; 
		//CaptchaComponent instance of controller is replaced by a securimage instance
		$controller->captcha =& new securimage();
		$controller->captcha->arc_line_colors = $this->_arc_line_colors;
		$controller->captcha->audio_path = $this->_audio_path;
		$controller->captcha->charset = $this->_charset;
		$controller->captcha->code_length = $this->_code_length;
		$controller->captcha->draw_angled_lines = $this->_draw_angled_lines;
		$controller->captcha->draw_lines = $this->_draw_lines;
		$controller->captcha->draw_lines_over_text = $this->_draw_lines_over_text;
		$controller->captcha->font_size = $this->_font_size;
		$controller->captcha->gd_font_file = $this->_gd_font_file;
		$controller->captcha->gd_font_size = $this->_gd_font_size;
		$controller->captcha->image_bg_color = $this->_image_bg_color;
		$controller->captcha->image_height = $this->_image_height;
		$controller->captcha->image_width = $this->_image_width;
		$controller->captcha->line_color = $this->_line_color;
		$controller->captcha->line_distance = $this->_line_distance;
		$controller->captcha->line_thickness = $this->_line_thickness;
		$controller->captcha->multi_text_color = $this->_multi_text_color;
		$controller->captcha->text_angle_maximum = $this->_text_angle_maximum;
		$controller->captcha->text_angle_minimum = $this->_text_angle_minimum;
		$controller->captcha->text_color = $this->_text_color;
		$controller->captcha->text_maximum_distance = $this->_text_maximum_distance;
		$controller->captcha->text_minimum_distance = $this->_text_minimum_distance;
		$controller->captcha->text_transparency_percentage = $this->_text_transparency_percentage;
		$controller->captcha->text_x_start = $this->_text_x_start;
		$controller->captcha->ttf_file = $this->_ttf_file;
		$controller->captcha->use_gd_font = $this->_use_gd_font;
		$controller->captcha->use_multi_text = $this->_use_multi_text;
		$controller->captcha->use_transparent_text = $this->_use_transparent_text;
		$controller->captcha->use_word_list = $this->_use_word_list;
		$controller->captcha->wordlist_file = $this->_wordlist_file;
		$controller->set('captcha',$controller->captcha);
    }
}

?>
