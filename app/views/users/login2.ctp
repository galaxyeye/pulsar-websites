<?php 
	// $this->viewVars['css_for_layout'] = $html->css('jquery/ui-smoothness/jquery-ui.css');
?>

<div id="dialog-form" title="Create new user">
	<p class="validateTips">All form fields are required.</p>
	<form>
		<fieldset>
			<label for="name">Name</label> <input type="text" name="name"
				id="name" value="Jane Smith"
				class="text ui-widget-content ui-corner-all"> <label for="email">Email</label>
			<input type="text" name="email" id="email" value="jane@smith.com"
				class="text ui-widget-content ui-corner-all"> <label for="password">Password</label>
			<input type="password" name="password" id="password" value="xxxxxxx"
				class="text ui-widget-content ui-corner-all">
			<!-- Allow form submission with keyboard without duplicating the dialog button -->
			<input type="submit" tabindex="-1"
				style="position: absolute; top: -1000px">
		</fieldset>
	</form>
</div>

<div id="users-contain" class="ui-widget">
	<h1>Existing Users:</h1>
	<table id="users" class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>Name</th>
				<th>Email</th>
				<th>Password</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>John Doe</td>
				<td>john.doe@example.com</td>
				<td>johndoe1</td>
			</tr>
		</tbody>
	</table>
</div>
<button id="create-user">Create new user</button>
