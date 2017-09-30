<a href="/projects.php?act=info&id=<?= $arResult["INFO"]["project"]["id"]?>">
<h1 class="glyphicon glyphicon-book"> <?= CMessage::UI('Project')?> &laquo;<?= 
    isset($arResult["INFO"]["project"]["name"])
    ?
    $arResult["INFO"]["project"]["name"]
    :
    CMessage::UI('Unknown project');
?>&raquo;</h1></a>
<br>
<h2 class="glyphicon glyphicon-home"> <?= 
	CMessage::UI('Edit location');
?> &laquo;<?= 
        isset($arResult["INFO"]["location"]["name"])
        ?
        $arResult["INFO"]["location"]["name"]
        :
        CMessage::UI('Unknown location') 
?>&raquo;</h2>

<form class="form-horizontal" role="form" method="POST">
    <div class="form-group">
        <label class="col-sm-2 control-label"><?= 
            CMessage::UI('Location name')
        ?></label>
        <div class="col-sm-10">
            <input name="name" type="text" class="form-control" 
                id="project-name" placeholder="<?= 
                CMessage::UI('Location name') ?>" value="<?= 
                isset($arResult["INFO"]["location"]["name"])
                ?
                $arResult["INFO"]["location"]["name"]
                :
                ''
            ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label"><?= 
            CMessage::UI('Location type'); 
        ?></label>
        <div class="col-sm-10">
            <select name="type_id" class="form-control">
            <? foreach($arResult["TYPES"] as $arType):?>
                <option value="<?= $arType["id"]?>" <? 
                    if($arType['id']==$arResult["INFO"]['location']['type_id']):
                ?> selected<? endif ?>>
                <?= $arType['name']?>
                </option>
            <? endforeach ?>
            </select>
        </div>
    </div>

    <div class=form-group"">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default"><?= 
            CMessage::UI('Save')
          ?></button>
        </div>
    </div>

</form>

