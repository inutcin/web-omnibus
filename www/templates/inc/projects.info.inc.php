<h1 class="glyphicon glyphicon-book"> <?= CMessage::UI('Project')?> &laquo;<?= 
    isset($arResult["INFO"]["project"]["name"])
    ?
    $arResult["INFO"]["project"]["name"]
    :
    CMessage::UI('Unknown project');
?>&raquo;</h1>
<h2><?= 
    CMessage::UI('Locations')
?></h2>
<form class="form-inline" method="POST" action="/projects.php?act=info&id=<?= 
    $arResult["INFO"]["project"]["id"]
?>">
    <input type="text" class="input-small form-control" placeholder="<?=
    CMessage::UI('Location name')
    ?>" name="add_location_name" value="<?= htmlspecialchars(
        isset($_POST["add_location_name"])?$_POST["add_location_name"]:""
    )?>">
    <select class="form-control" name="add_location_type">
    <? foreach($arResult["INFO"]["location_types"] as $arLocationType):?>
        <option value="<?= $arLocationType["id"]?>" <? 
            if(
                isset($_POST["add_location_type"])
                &&
                $arLocationType["id"]==$_POST["add_location_type"]
            )echo " selected";
        ?>>
            <?= CMessage::UI($arLocationType["name"])?>
        </option>
    <? endforeach ?>
    </select>
    <button type="submit" class="btn btn-primary"><?= 
        CMessage::UI('Add location') 
    ?></button>
</form>
<br>
<table class="table  table-striped table-hover">
    <tr>
        <th>
            <?= CMessage::UI('Name')?>
        </th>
        <th>
            <?= CMessage::UI('Type')?>
        </th>
        <th style="width: 200px;">
            <?= CMEssage::UI('Actions')?>
        </th>
    </tr>
    <? foreach($arResult["INFO"]["locations"] as $arLocation):?>
    <tr>
        <td>
            <a class="glyphicon glyphicon-home" 
                href="/locations.php?act=info&id=<?= $arLocation["id"]?>">
            <?= $arLocation["name"]?>
            </a>
        </td>
        <td>
            <?= $arLocation["type_name"]?>
        </td>
        <td>
            <a href="/locations.php?act=edit&id=<?= 
            $arLocation["id"]?>"><i class="glyphicon glyphicon-pencil"><?= 
                CMessage::UI('Edit')
            ?></i></a>
            <a onclick="return confirm('<?= CMessage::UI('Are you sure?')?>');" 
            href="/locations.php?act=delete&id=<?= 
            $arLocation["id"]?>"><i class="glyphicon glyphicon-remove"><?= 
                CMessage::UI('Delete')
            ?></i></a>
        </td>
    </tr>
    <? endforeach ?>
</table>
