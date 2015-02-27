<?php
class AppError extends ErrorHandler {

	function cannotWriteFile($params = null) {
		$this->controller->set('currentUser', $this->controller->currentUser);
		$this->controller->set('currentEnterprise', $this->controller->currentEnterprise);

		$this->controller->set('file', $params['file']);
		$this->_outputMessage('cannot_write_file');
	}

	function resourceNotFound($params = null) {
		$this->controller->set('currentUser', $this->controller->currentUser);
		$this->controller->set('currentEnterprise', $this->controller->currentEnterprise);
		
		$this->_outputMessage('resource_not_found');
	}

	function invalidArgument($params = null) {
		$this->controller->set('currentUser', $this->controller->currentUser);
		$this->controller->set('currentEnterprise', $this->controller->currentEnterprise);
		
		$this->_outputMessage('invalid_argument');
	}

	function invalidData($params = null) {
		$this->controller->set('currentUser', $this->controller->currentUser);
		$this->controller->set('currentEnterprise', $this->controller->currentEnterprise);
		
		$this->_outputMessage('invalid_data');
	}

	function accessDeny($params = null) {
		$this->controller->set('currentUser', $this->controller->currentUser);
		$this->controller->set('currentEnterprise', $this->controller->currentEnterprise);
		
		$this->_outputMessage('access_deny');
	}

	function databaseError($params = null){
		$this->controller->set('currentUser', $this->controller->currentUser);
		$this->controller->set('currentEnterprise', $this->controller->currentEnterprise);
		
		$this->_outputMessage('database_error');
	}

	function saveFailure($params = null) {
		$this->controller->set('currentUser', $this->controller->currentUser);
		$this->controller->set('currentEnterprise', $this->controller->currentEnterprise);
		
		$this->_outputMessage('save_failure');
	}

	function deleteFailure($params = null) {
		$this->controller->set('currentUser', $this->controller->currentUser);
		$this->controller->set('currentEnterprise', $this->controller->currentEnterprise);
		
		$this->_outputMessage('delete_failure');
	}

	function error404($params = null){
		$this->controller->set('currentUser', $this->controller->currentUser);
		$this->controller->set('currentEnterprise', $this->controller->currentEnterprise);
		
		$this->_outputMessage('error404');
	}
	
	function cannotVisitOthers($params = null) {
		$this->controller->set('currentUser', $this->controller->currentUser);
		$this->controller->set('currentEnterprise', $this->controller->currentEnterprise);
		
		$this->_outputMessage('cannot_visit_others');
	}
}
?>
