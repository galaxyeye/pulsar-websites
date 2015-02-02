<div class="top-header">
	<div class='wp'>
	  <a href="<?php echo URL_BASE?>/properties/index/city_id:1" title="Shanghai" class='<?php mark_current_city(1, $currentCity) ?> city'>Shanghai</a>
	  <span>|</span>
	  <a href="<?php echo URL_BEIJING_BASE?>/properties/index/city_id:2" title="Beijing" class='<?php mark_current_city(2, $currentCity) ?> city'>Beijing</a>
	  <span>|</span>
	  <a href="<?php echo URL_GUANGZHOU_BASE?>/properties/index/city_id:3" title="Guangzhou" class='<?php mark_current_city(3, $currentCity) ?> city'>Guangzhou</a>
	  <span>|</span>
	  <a href="/enquiries/add" title="Online Enquiry">Online Enquiry</a>
	  <span>|</span>
	  <a href="/landlords/add" class="last" title="Landload">Landload / 业主委托</a>
  </div>
</div>

<div class='wp'>
  <div class='cl'>
    <div class='service-tel'>
      <span class='tel'>Tel: +86 181 4978 6973</span>
      <span class='hidden'><img src="/img/sinorelo/tel-icon.jpg" alt='tel' /></span>
    </div>
  </div>
</div>

<div class='wp'>
  <div class='header cl'>

      <h2><a href='/'><img src="/img/logo.gif" style="cursor:pointer;" alt="" width="226" height="60" /></a></h2>
      <div class="nav <?php mark_active_menu($controller) ?> z">
          <ul>
            <li class="properties" ><a href="/properties/index/city_id:<?php echo $currentCity ?>" title="Properties">Properties</a></li>
            <li class="compounds"><a href="/compounds" title="Compounds">Compounds</a></li>
            <li class="schools"><a href="/schools" title="Schools">Homes Near Schools</a></li>
            <li class="our-services"><a href="/pages/service" title="our-services">Our Services</a></li>
          </ul>
      </div>

	  <div class="mobile-logo"><?php echo $html->link(' ', array('controller' => 'articles', 'action' => 'view', 11), array('target' => '_blank')) ?></div>
  </div> <!-- cl -->
</div> <!-- wp -->

<div class='color-padder-container'>
  <div class='cl'>
		<div class="color-padder cl">&nbsp;</div>
	</div>
</div>
