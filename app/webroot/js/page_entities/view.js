$(document).ready(function() {

  // add/view/edit in a new layer
  $('#stage a').filter(function(index) {
    return this.href.length > 1 && this.href.indexOf('delete') == -1 
    	&& this.target == "layer";
  }).on("click", function(event) {
	var params = {};
	if (this.href.indexOf('crawl_filter') !== -1) {
		params.title = "Move Me ";
		params.move = ".xubox_title";
	}
    openUrlInLayer(this.href, params);

    return false;
  });
});
