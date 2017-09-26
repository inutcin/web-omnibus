<h1><?= 
	CMessage::UI('Edit project');
?></h1>

<form class="form-horizontal" role="form" method="POST">
  <div class="form-group">
    <label class="col-sm-2 control-label"><?= 
        CMessage::UI('Project name')
    ?></label>
    <div class="col-sm-10">
      <input name="name" type="text" class="form-control" id="project-name" 
      placeholder="<?= CMessage::UI('Project name') ?>" value="<?= 
        isset($arResult["PROJECT"]["name"])
        ?
        $arResult["PROJECT"]["name"]
        :
        ''
      ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default"><?= 
        CMessage::UI('Save')
      ?></button>
    </div>
  </div>
</form>

