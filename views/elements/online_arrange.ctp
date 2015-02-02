<script type="text/javascript">
  var arranged_properties = <?php echo get_property_js_array($arranged_properties) ?>
</script>

<script id="arrange-item-template" type="text/x-jsrender">
<li class='arrange-item arrange-item-{{:id:}}'>
  <div class='title bottom-dotted'><a href='/properties/view/{{:id:}}'><em>{{:name:}}</em></a></div>
  <div class='detail cl bottom-dotted'>
    <div class='thumb right-dotted z'><a href='/properties/view/{{:id:}}'><img src="/img/{{:image:}}" width="65" height="45" alt="" /></a></div>
    <div class='item-desc z'>
      <div class="bottom-dotted right-dotted">{{:layout:}} brs, {{:size:}} sqm</div>
      <div class="right-dotted">¥ {{:rent:}}</div>
    </div>
    <div class='z del-item'>
      <a class='del-item' href='javascript:;'></a>
      <input type='hidden' value="{{:id:}}" />
    </div>
  </div>
</li>
</script>

      <div class='online-enquiry'><a href="/enquiries/add" target='_blank'></a></div>

      <div class='download-app'><?php echo $html->link(' ', array('controller' => 'articles', 'action' => 'view', 11), array('target' => '_blank')) ?></div>

      <div class='view-list arrange-items'>
        <div class='enquiry-title z'><span></span></div>
        <ul>
          <li class='default-arrange-item'>No property choosed</li>
        </ul>
	      <div class='arrange'><a href="/enquiries/arrange" target='_blank'></a></div>
	    </div>
