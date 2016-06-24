<?php $this->layout = 'admin_article' ?>

  <div class='panel wp1024'>
  	<div id='stage' class='article'>
      <h2>编辑文章</h2>
  	  <div class='cl'>
        <div class="menu z">
          <?php echo $this->element('article_menu') ?>
        </div>

        <div class="content y">
          <?php echo $this->Form->create('Article');?>
          	<?php
          		echo $this->Form->input('id');
          		echo $this->Form->input('title');
          		echo $fck->fckeditor(array('Article', 'content'), $html->base, $this->Form->value('content'));
          		
          		echo $this->Form->input('meta_title');
          		echo $this->Form->input('meta_keywords');
          		echo $this->Form->input('meta_description');
          	?>
          <?php echo $this->Form->end(__('Submit', true));?>
        </div>
  	  </div> <!-- cl -->
    </div>
  </div> <!-- panel -->

  <div class="actions">
  	<h3><?php __('Actions'); ?></h3>
  	<ul>
  
   		<li><?php echo $this->Html->link(__('View Article', true), array('action' => 'view', $this->Form->value('Article.id'))); ?> </li>
  		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Article.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Article.id'))); ?></li>
  		<li><?php echo $this->Html->link(__('List Articles', true), array('action' => 'index'));?></li>
  	</ul>
  </div>
