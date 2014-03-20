<tr class="table_content">
 <td><?PHP echo $id; ?></td>
 <td><input class="itemcheck" type="checkbox" name="itemid-<?PHP echo $id; ?>" /></td>
 <td><a href="<?PHP echo $uripath; ?>editfoto/itemid-<?PHP echo $id; ?>.html"><?PHP echo $title; ?></a></td>
 <td><?PHP echo $catname; ?></td>
 <td><img src="public/usr/root/foto/icons/<?PHP echo $icon; ?>" /></td>
 <td><input class="text w_4" type="text" name="order-<?PHP echo $id; ?>" value="<?PHP echo $order; ?>" /></td>
</tr>