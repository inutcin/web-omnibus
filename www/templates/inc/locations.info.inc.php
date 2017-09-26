<a href="/projects.php?act=info&id=<?= $arResult["INFO"]["project"]["id"]?>">
<h1 class="glyphicon glyphicon-book"> <?= CMessage::UI('Project')?> &laquo;<?= 
    isset($arResult["INFO"]["project"]["name"])
    ?
    $arResult["INFO"]["project"]["name"]
    :
    CMessage::UI('Unknown project');
?>&raquo;</h1></a>
<br>
<h2 class="glyphicon glyphicon-home"> <?= CMessage::UI('Location') ?> &laquo;<?= 
    isset($arResult["INFO"]["location"]["name"])
    ?
    $arResult["INFO"]["location"]["name"]
    :
    CMessage::UI('Unknown location');
?>&raquo;</h2>
<form class="form-inline" method="POST" action="/locations.php?act=info&id=<?= 
    $arResult["INFO"]["location"]["id"]
?>">
    <input type="text" class="input-small form-control" placeholder="<?=
    CMessage::UI('Access name')
    ?>" name="add_access_name" value="<?= htmlspecialchars(
        isset($_POST["add_access_name"])?$_POST["add_access_name"]:""
    )?>">
    <select class="form-control" name="add_access_type">
    <? foreach($arResult["INFO"]["access_types"] as $arAccessType):?>
        <option value="<?= $arAccessType["id"]?>" <? 
            if(
                isset($_POST["add_access_type"])
                &&
                $arAccessType["id"]==$_POST["add_access_type"]
            )echo " selected";
        ?>>
            <?= CMessage::UI($arAccessType["name"])?>
        </option>
    <? endforeach ?>
    </select>
    <button type="submit" class="btn btn-primary"><?= 
        CMessage::UI('Add access') 
    ?></button>
</form>
<br>
<h3 class="glyphicon glyphicon-road"> <?= 
    CMessage::UI('Accesses') 
?></h3>
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
    <? foreach($arResult["INFO"]["accesses"] as $arLocation):?>
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

<h3 class="glyphicon glyphicon-calendar"> <?= 
    CMessage::UI('Tasks');
?></h3>
<br/>
<h3 class="glyphicon glyphicon-tasks"> <?= 
    CMessage::UI('Task logs');
?> </h3>
