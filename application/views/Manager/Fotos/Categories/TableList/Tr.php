<tr class="table_content">
 <td><?PHP echo $id; ?></td>
 <td><input class="itemcheck" type="checkbox" name="itemid-<?PHP echo $id; ?>" /></td>
 <td><a href="<?PHP echo $uripath; ?>editcategory/itemid-<?PHP echo $id; ?>.html"><?PHP echo $title; ?></a></td>
 <td><?PHP echo $description; ?></td>
 <td><img src="public/usr/root/foto/icons/<?PHP echo $icon; ?>" /></td>
 <td><?PHP echo $default; ?></td>
 <td><input class="text w_4" type="text" name="order-<?PHP echo $id; ?>" value="<?PHP echo $order; ?>" /></td>
</tr>