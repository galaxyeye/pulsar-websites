<?php 
 $article_id = $this->passedArgs[0];
?>

<div class="article-menu">
  <!--about xiaokuai-->
  <div>
    <h4>About Us</h4>
    <ul>
     <li> &gt; <?php echo $html->link('Overview', array('controller' => 'articles', 'action' => 'view', 2, 'Overview'), mark_active_article_menu($article_id, 2)) ?></li>
     <li> &gt; <?php echo $html->link('Why Sinorelo?', array('controller' => 'articles', 'action' => 'view', 3, 'Why Sinorelo?'), mark_active_article_menu($article_id, 3)) ?></li>
     <li> &gt; <?php echo $html->link('Career', array('controller' => 'articles', 'action' => 'view', 4, 'Career'), mark_active_article_menu($article_id, 4)) ?></li>
     <li class='no-border'> &gt; <?php echo $html->link('Contact Us', array('controller' => 'articles', 'action' => 'view', 5, 'Contact Us'), mark_active_article_menu($article_id, 5)) ?></li>
    </ul>
  </div>

  <div>
    <h4>Our Services</h4>
    <ul>
     <li> &gt; <?php echo $html->link('Immigration', array('controller' => 'articles', 'action' => 'view', 6, 'Immigration'), mark_active_article_menu($article_id, 6)) ?></li>
     <li> &gt; <?php echo $html->link('Relocation', array('controller' => 'articles', 'action' => 'view', 7, 'Relocation'), mark_active_article_menu($article_id, 7)) ?></li>
     <li> &gt; <?php echo $html->link('Payroll', array('controller' => 'articles', 'action' => 'view', 8, 'Payroll'), mark_active_article_menu($article_id, 8)) ?></li>
     <li> &gt; <?php echo $html->link('Incorporation', array('controller' => 'articles', 'action' => 'view', 10, 'Incorporation'), mark_active_article_menu($article_id, 10)) ?></li>
     <li> &gt; <?php echo $html->link('Home Search', array('controller' => 'articles', 'action' => 'view', 9, 'Home Search'), mark_active_article_menu($article_id, 9)) ?></li>
     <li> &gt; <?php echo $html->link('China Relo APP', array('controller' => 'articles', 'action' => 'view', 11, 'China Relo APP'), mark_active_article_menu($article_id, 11)) ?></li>
    </ul>
  </div>
</div>
