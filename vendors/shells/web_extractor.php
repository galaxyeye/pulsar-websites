<?php 

class WebExtractorShell extends Shell {

	/**
	 * Main Model
	 *
	 * @var array
	 */
	public $uses = array(
			'MaxCompoundIndexPage',
			'MaxCompoundViewPage',
			'MaxCompoundImage',
			'MaxPropertyIndexPage',
			'MaxPropertyViewPage',
			'MaxPropertyImage',
	);

	public $webpageDir = null;

	/**
	 * Startup method for the shell
	 *
	 * Lets set some default params for the EmailTask
	 *
	 */
    function startup() {
    	$this->webpageDir = '/home/vincent/Downloads/maxview';

	    $this->out("work with directory {$this->webpageDir}");
    }

    /**
     * Override main() for help message hook
     *
     * @access public
     */
    function main() {
    	$out  = "extract html data into structured data\n";
    	$out .= "\t - extract_compound_index_pages\n";
    	$out .= "\t - extract_compound_view_pages\n";
    	$out .= "\t - extract_property_index_pages\n";
    	$out .= "\t - extract_property_view_pages\n";
    	$out .= "\t - extract_compound_images\n";
    	$out .= "\t - extract_property_images\n";
    	$this->out($out);
    }

    function extract_compound_index_pages() {
		$webdataSchema = array(
			'model' => array(
				'path' => "/html/body/div[5]/div/div[@class='liebiaoyangshi']",
				'fields' => array(
					'name' => 'dl dd h3 a',
					'image_url' => array('path' => 'dl dt a img', 'attribute' => 'src', 'textonly' => false),
					'rent_range' => 'dl dd h4',
					'property_type' => 'dl dd h4',
					'area' => 'dl dd h4',
					'layout' => 'dl dd p strong'
				)
			)
		);

		$options = array(
			'fullPathPattern' => '/(\bcompounds)+.*\.(html|htm)$/i',
			'fileContentTransformer' => array('pattern' => '/\(confirm.*\)\)/i', 'replacement' => '(false)'),
			'fileContentPattern' => array(
				'patterns' => array(
					array('path' => '/html/body/div[5]/div/h1', 'expect' => '/Compounds List/i', 'score' => 1),
				),
				'passScore' => 1,
				'maxProcessFile' => 1
			)
		);

		$this->MaxCompoundIndexPage->extractWebDataInDir($this->webpageDir, $webdataSchema, $options);
    }

    function extract_compound_view_pages() {
    	$webdataSchema = array(
   			'model' => array(
   					'path' => "",
   					'fields' => array(
						'name' => '/html/body/div[5]/div/table/tr/td/h1',
						'image_info' => array('path' => '//*[@id="slideshow"]', 'textonly' => false),
						'property_type' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[1]/td[2]',
						'completion_date' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[2]/td[2]',
						'district' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[3]/td[2]',
						'neighborhood' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[4]/td[2]',
						'ownership' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[5]/td[2]',
						'featured_description' => '/html/body/div[5]/div/div[4]/p',
						'features' => '/html/body/div[5]/div/div[6]/div',
						'location' => '/html/body/div[5]/div/div[8]/p',
						'facility' => '/html/body/div[5]/div/div[10]/div',
						'main_layout' => array('path' => '/html/body/div[5]/div/div[13]/table', 'textonly' => false)
				)
   			)
    	);

    	$options = array(
    			'fullPathPattern' => '/(\bcompound|\bvillage)+.*\.(html|htm)$/i',
    			'fileContentTransformer' => array('pattern' => '/\(confirm.*\)\)/i', 'replacement' => '(false)'),
    			'fileContentPattern' => array(
    					'patterns' => array(
    							array('path' => '/html/body/div[5]/div/div[12]/h3', 'expect' => '/\bMain Layout/i', 'score' => 1),
    							array('path' => '/html/body/div[5]/div/div[13]/h3', 'expect' => '/\bMain Layout/i', 'score' => 1),
    							array('path' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tbody/tr[2]/td', 'expect' => '/\bCompletion date:/i', 'score' => 1),
    					),
    					'passScore' => 1
    			)
    	);

    	$this->MaxCompoundViewPage->extractWebDataInDir($this->webpageDir, $webdataSchema, $options);
    }

    function extract_property_index_pages() {
		$webdataSchema = array (
			'model' => array (
				'path' => "/html/body/div[6]/div/div[@class='liebiaoyangshi']",
				'fields' => array(
					'name' => 'dl dd h3 a',
					'image_url' => array('path' => 'dl dt a img', 'attribute' => 'src'),
					'rent' => 'dl dd h4',
					'property_id' => 'dl dd h4',
					'property_type' => 'dl dd h4',
					'area' => 'dl dd h4',
					'bedrooms' => 'dl dd p strong',
					'size' => 'dl dd p strong'
				)
			)
		);

		$options = array(
			'fullPathPattern' => '/(\bproperties)+.*\.(html|htm)$/i',
			'fileContentTransformer' => array('pattern' => '/\(confirm.*\)\)/i', 'replacement' => '(false)'),
			'fileContentPattern' => array(
				'patterns' => array(
					array('path' => '/html/body/div[6]/div/div[4]/div/div', 
							'expect' => '/Properties found/i', 
							'score' => 1),
				),
				'passScore' => 1
			),
			'maxProcessFile' => 2
		);

		$this->MaxPropertyIndexPage->extractWebDataInDir($this->webpageDir, $webdataSchema, $options);
    }

    function extract_property_view_pages() {
		$webdataSchema = array(
			'model' => array(
				'path' => '',
				'fields' => array(
					'name' => '/html/body/div[5]/div/table/tr/td/h1',
					'image_info' => array('path' => '//*[@id="slideshow"]', 'textonly' => false),
					'property_id' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[1]/td[2]',
					'size' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[2]/td[2]',
					'layout' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[3]/td[2]',
					'ownership' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[4]/td[2]',
					'neighborhood' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[5]/td[2]',
					'district' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[6]/td[2]',
					'rent' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[7]/td[2]',
					'property_type' => '/html/body/div[5]/div/div/a[2]',
					'featured_description' => '/html/body/div[5]/div/div[4]/div/div',
					'location' => '/html/body/div[5]/div/div[4]/div[3]/p',
				)
			)
		);

		$options = array(
			'fullPathPattern' => '/(\bapartment|\bvilla|\boldhouse|\bservice-apartment)+.*\.(html|htm)$/i',
			'fileContentTransformer' => array('pattern' => '/\(confirm.*\)\)/i', 'replacement' => '(false)'),
			'fileContentPattern' => array(
				'patterns' => array(
					array('path' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[7]/td', 
							'expect' => '/\bMonthly Rental:/i', 
							'score' => 1),
				),
				'passScore' => 1
			)
		);

		$this->MaxPropertyViewPage->extractWebDataInDir($this->webpageDir, $webdataSchema, $options);
    }

    function extract_compound_images() {
    	
    }

    function extract_property_images() {
		$webdataSchema = array(
			'model' => array(
				'path' => '//*[@id="slideshow"]',
				'fields' => array(
					'url' => array('path' => 'img', 'attribute' => 'src'),
				)
			)
		);

		$options = array(
			'fullPathPattern' => '/(\bapartment|\bvilla|\boldhouse|\bservice-apartment)+.*\.(html|htm)$/i',
			'fileContentTransformer' => array('pattern' => '/\(confirm.*\)\)/i', 'replacement' => '(false)'),
			'fileContentPattern' => array(
				'patterns' => array(
					array('path' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[7]/td', 
							'expect' => '/\bMonthly Rental:/i', 
							'score' => 1),
				),
				'passScore' => 1
			),
			'maxProcessFile' => 2000
		);

		$this->MaxPropertyImage->extractWebDataInDir($this->webpageDir, $webdataSchema, $options);
    }
}
