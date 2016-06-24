<?php $this->layout = 'admin_article' ?>

  <div class='panel wp1024'>
  	<div id='stage' class='article'>
      <h2>查看文章</h2>
  	  <div class='cl'>
        <div class="menu z">
          <?php echo $this->element('article_menu') ?>
        </div>
      
        <div class="content y">
          <h2><?php echo $article['Article']['title']; ?></h2>
          <p><?php echo $article['Article']['content']; ?></p>
        </div>
  	  </div> <!-- cl -->
    </div>
  </div> <!-- panel -->
  

  <div class="actions">
  	<h3><?php __('Actions'); ?></h3>
  	<ul>
  
   		<li><?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $article['Article']['id'])); ?> </li>
  		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Article.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Article.id'))); ?></li>
  		<li><?php echo $this->Html->link(__('List Articles', true), array('action' => 'index'));?></li>
  	</ul>
  </div>
