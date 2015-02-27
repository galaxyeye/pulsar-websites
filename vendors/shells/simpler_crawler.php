<?php 

class SimplerCrawlerShell extends Shell {

/**
 * Startup method for the shell
 *
 * Lets set some default params for the EmailTask
 *
 */
    function startup() {
	    $this->out("Start up");
    }

    function main() {
    	$this->out('property view crawler');

    	$this->property_view_crawler();
    }

    public function property_view_crawler() {
		$localDir = '/home/vincent/Downloads/maxview';

		// $property_types = array('apartment', 'villa', 'oldhouse', 'service-apartment');
		$property_types = array('service-apartment');

		foreach ($property_types as $property_type) {
			$this->out("load property type : {$property_type}");

			for ($property_id = 1; $property_id < 1000; ++$property_id) {
				$url = "http://www.maxviewrealty.com/{$property_type}/{$property_id}.html";

				$contents = file_get_contents($url);

				if ($contents === false) {
					// $this->out('failed to load '.$url);
					continue;
				}

				$contents_length = strlen($contents);
				$this->out('contents length : '.$contents_length);

				if ($contents_length < 2000) continue;

				$filename = "{$localDir}/properties/{$property_type}-{$property_id}.htm";
				$handle = fopen($filename, 'w');
				fwrite($handle, $contents);
				fclose($handle);
			}
		}
    }

    public function compound_view_crawler() {
    	$localDir = '/home/vincent/Downloads/maxview';

   		for ($compound_id = 1; $compound_id < 1000; ++$compound_id) {
   			$url = "http://www.maxviewrealty.com/village/{$compound_id}.html";

   			$contents = file_get_contents($url);

   			if ($contents === false) {
   				// $this->out('failed to load '.$url);
   				continue;
   			}

   			$contents_length = strlen($contents);
   			$this->out('contents length : '.$contents_length);

   			if ($contents_length < 2000) continue;
  
   			$filename = "{$localDir}/properties/{$property_type}-{$compound_id}.htm";
   			$handle = fopen($filename, 'w');
   			fwrite($handle, $contents);
   			fclose($handle);
   		}
	}

}
