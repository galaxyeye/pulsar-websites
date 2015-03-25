<?php
if (!empty($associations['hasOne'])) :
foreach ($associations['hasOne'] as $_alias => $_details): ?>
<div class="related">
	<h3><?php printf(__("Related %s", true), Inflector::humanize($_details['controller'])); ?></h3>
<?php if (!empty(${$singularVar}[$_alias])):?>
	<dl>
<?php
		$i = 0;
		$otherFields = array_keys(${$singularVar}[$_alias]);
		foreach ($otherFields as $_field) {
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			echo "\t\t<dt{$class}>" . Inflector::humanize($_field) . "</dt>\n";
			echo "\t\t<dd{$class}>\n\t" . ${$singularVar}[$_alias][$_field] . "\n&nbsp;</dd>\n";
		}
?>
	</dl>
<?php endif; ?>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(sprintf(__('Edit %s', true), Inflector::humanize(Inflector::underscore($_alias))), array('controller' => $_details['controller'], 'action' => 'edit', ${$singularVar}[$_alias][$_details['primaryKey']]))."</li>\n";?>
		</ul>
	</div>
</div>
<?php
endforeach;
endif;
