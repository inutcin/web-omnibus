<?php include("inc/header.inc.tmpl.php");?>

<? if($arResult['ACT']=='list'):?>
    <? include("inc/projects.list.inc.php")?>
<? elseif($arResult['ACT']=='add'):?>
    <? include("inc/projects.add.inc.php")?>
<? elseif($arResult['ACT']=='edit'):?>
    <? include("inc/projects.edit.inc.php")?>
<? endif ?>

<?php include("inc/footer.inc.tmpl.php");?>
