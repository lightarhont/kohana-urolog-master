<tr<?PHP if($colorrow == '0') { echo ' style="background-color: #f2f2f2;"'; } ?>>
 <td class="col1"><?PHP echo $id; ?></td><td class="col2">
 <?PHP if($nolink == '1') { echo $title; } else { ?>
 <a href="catalogview/<?PHP echo $url; ?>.html"><?PHP echo $title; ?></a><?PHP } ?></td><td class="col3"><a href="#">Скачать</a></td>
</tr>