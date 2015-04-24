<div class="actions">
  <ul>
    <li>
      <?php echo $this->Html->link(__('Page Entities', true), array('controller' => 'page_entities')); ?>
    </li>
    <li>
      <?php echo $this->Html->link(__('List All Minging Results', true), ['controller' => 'storage_page_entities', 'action' => 'index']); ?>
    </li>
    <li>
      <?php echo $this->Html->link(__('Extract Fields', true), array('controller' => 'page_entity_fields')); ?>
    </li>
    <li>
      <?php echo $this->Html->link(__('Extract Features', true), array('controller' => 'extract_features')); ?>
    </li>
  </ul>
</div>
