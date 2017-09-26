<h1><?= CMEssage::UI('Projects')?></h1>

<form class="form-inline" method="POST" action="/projects.php?act=list">
    <input type="text" class="input-small" placeholder="<?=
    CMessage::UI('Project name')
    ?>" name="name" value="<?= htmlspecialchars(
        isset($_POST["name"])?$_POST["name"]:""
    )?>">
    <input type="hidden" class="input-small" placeholder="Пароль">
    <button type="submit" class="btn btn-primary"><?= 
        CMessage::UI('Add project') 
    ?></button>
</form>
<br>
<table class="table table-striped table-hover">
    <tr>
        <th style="width: 100px;">
            Id
        </th>
        <th>
            <?= CMessage::UI('Project name')?>
        </th>
        <th style="width: 200px;">
            <?= CMEssage::UI('Actions')?>
        </th>
    </tr>
    <? if(isset($arResult["PROJECTS"]))
    foreach($arResult["PROJECTS"] as $arProject):?>
    <tr>
        <td>
            <?= $arProject['id']?>
        </td>
        <td>
            <?= $arProject['name']?>
        </td>
        <td>
            <a href="/projects.php?act=edit&id=<?= 
            $arProject["id"]?>"><i class="glyphicon glyphicon-pencil"><?= 
                CMessage::UI('Edit')
            ?></i></a>
            <a onclick="return confirm('<?= CMessage::UI('Are you sure?')?>');" 
            href="/projects.php?act=delete&id=<?= 
            $arProject["id"]?>"><i class="glyphicon glyphicon-remove"><?= 
                CMessage::UI('Delete')
            ?></i></a>
        </td>
    </tr>
    <? endforeach ?>
</table>


