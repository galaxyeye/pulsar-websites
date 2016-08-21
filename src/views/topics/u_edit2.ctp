<?= $this->element('css', ['css' => 'condition_editor/ise.treeintable']); ?>

<?= $html->script("condition_editor/jquery.ise.datastore", ['inline' => false]) ?>
<?= $html->script("condition_editor/jquery.ise.treeintable", ['inline' => false]) ?>
<?= $html->script("condition_editor/jquery.ise.conditioneditor", ['inline' => false]) ?>
<?= $html->script("condition_editor/esprima", ['inline' => false]) ?>
<?= $html->script("condition_editor/jquery.ise.versatilecombobox", ['inline' => false]) ?>
<?= $html->script("condition_editor/jquery.ise.equationeditor", ['inline' => false]) ?>

<div id="datastore3" class="datastore"></div>
<div id="treeintable3" class="treeintable">Condition Editor (Drag-and-Drop, Meta-Data driven)</div>
<br/>
<p>
    Write you search criteria below and click "Parse Expression To Condition Tree" button.
</p>
<textarea rows="20" cols="50" id="textarea">(sourceIp=="10.1.2.49")||(priority >= 1 )&& (device !="linksys")</textarea>
<br/><br/>
<input class="buttonclass" type="button" id="load" value="Parse Expression To Condition Tree" style="width ="/>
<br /><br />
<input class="buttonclass" type="button" id="math" value="Get Boolean Expression From Condition Tree"/>
<br /><br />
<input class="buttonclass" type="button" id="json" value="Get JSON From Condition Tree"/>
<br />

<p>
    This widget enables user to configure data search criteria. <br>
    User can write down search criteria and let the widget parse the string expression to Condition-Editor-Tree.<br>
    It supports drag and drop to arrange conditions. <br>
    Validation and configuration are driven by meta-data. Service provider controls which fields/functions are
    accessible to users.
</p>
