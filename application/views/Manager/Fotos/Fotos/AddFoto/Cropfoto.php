<h1>МЕНЕДЖЕР ФОТО:СОЗДАНИЕ ИКОНКИ</h1>
<div><?PHP echo $error_message; ?></div>
<div><img src="<?PHP echo $uploaded_file; ?>" id="cropbox" /></div>
<div>
    <form action="" method="post" id="crop" onsubmit="return checkCoords();">
    <input type="hidden" id="x" name="x" />
    <input type="hidden" id="y" name="y" />
    <input type="hidden" id="w" name="w" />
    <input type="hidden" id="h" name="h" />
    <input type="hidden" name="image" value="<?PHP echo $uploaded_file; ?>" />
    <input type="hidden" name="saveicon" value="1" />
    </form>
</div>
