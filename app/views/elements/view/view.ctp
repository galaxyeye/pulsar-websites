<div class="<?php echo $pluralVar;?> view">
<h2><?php printf(__("View %s", true), $singularHumanName); ?></h2>
	<dl>
<?php
$i = 0;
foreach ($scaffoldFields as $_field) {
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	$isKey = false;
	if (!empty($associations['belongsTo'])) {
		foreach ($associations['belongsTo'] as $_alias => $_details) {
			if ($_field === $_details['foreignKey']) {
				$isKey = true;
				echo "\t\t<dt{$class}>" . Inflector::humanize($_alias) . "</dt>\n";
				echo "\t\t<dd{$class}>\n\t\t\t" . $this->Html->link(${$singularVar}[$_alias][$_details['displayField']], array('controller' => $_details['controller'], 'action' => 'view', ${$singularVar}[$_alias][$_details['primaryKey']])) . "\n\t\t&nbsp;</dd>\n";
				break;
			}
		}
	}

	if ($isKey !== true) {
		echo "\t\t<dt{$class}>" . Inflector::humanize($_field) . "</dt>\n";
		echo "\t\t<dd{$class}>\n\t\t\t{${$singularVar}[$modelClass][$_field]}\n&nbsp;\t\t</dd>\n";
	}
}
?>
	</dl>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
<?php
	echo "\t\t<li>" .$this->Html->link(sprintf(__('Edit %s', true), $singularHumanName),   array('action' => 'edit', ${$singularVar}[$modelClass][$primaryKey])). " </li>\n";
	echo "\t\t<li>" .$this->Html->link(sprintf(__('Delete %s', true), $singularHumanName), array('action' => 'delete', ${$singularVar}[$modelClass][$primaryKey]), null, __('Are you sure you want to delete', true).' #' . ${$singularVar}[$modelClass][$primaryKey] . '?'). " </li>\n";
	echo "\t\t<li>" .$this->Html->link(sprintf(__('List %s', true), $pluralHumanName), array('action' => 'index')). " </li>\n";
	echo "\t\t<li>" .$this->Html->link(sprintf(__('New %s', true), $singularHumanName), array('action' => 'add')). " </li>\n";

	$done = array();
	foreach ($associations as $_type => $_data) {
		foreach ($_data as $_alias => $_details) {
			if ($_details['controller'] != $this->name && !in_array($_details['controller'], $done)) {
				echo "\t\t<li>" . $this->Html->link(sprintf(__('List %s', true), Inflector::humanize($_details['controller'])), array('controller' => $_details['controller'], 'action' => 'index')) . "</li>\n";
				echo "\t\t<li>" . $this->Html->link(sprintf(__('New %s', true), Inflector::humanize(Inflector::underscore($_alias))), array('controller' => $_details['controller'], 'action' => 'add')) . "</li>\n";
				$done[] = $_details['controller'];
			}
		}
	}
?>
	</ul>
</div>
