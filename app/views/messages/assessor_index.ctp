<div class="actions">
  <ul>
    <li><?php echo $this->Html->link('发短信', array('action' => 'add')); ?> </li>
  </ul>
</div>

<div class="info">
  <h2>管理员 - 短信清单</h2>
</div><!--info-->

<?php echo $this->Session->flash() ?>

<div class="group">
  <div class="orders index">
  <table cellpadding="0" cellspacing="0">
  <tr>
      <th></th>
      <th>姓名</th>
      <th>电话</th>
      <th>内容</th>
      <th>时间</th>
  </tr>
  <?php 
    $i = 0;
    foreach ($messages as $message) :
      $class = null;
      if ($i++ % 2 == 0) {
        $class = ' class="altrow"';
      }
  ?>
  <tr<?php echo $class;?>>
    <td><?php echo $i; ?></td>
    <td><?php echo $message['Message']['name'] ?></td>
    <td><?php echo $message['Message']['mobile'] ?></td>
    <td><?php echo $message['Message']['content'] ?></td>
    <td><?php echo $message['Message']['created'] ?></td>
  </tr>
  <?php endforeach; ?>
  </table>
   <p><?php echo $this->Paginator->counter(array('format' => '第%page%页 / 共%pages%页')) ?></p>

  <div class="paging">
    <?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
    | <?php echo $this->Paginator->numbers();?>
    | <?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
  </div>
  </div>
</div>

