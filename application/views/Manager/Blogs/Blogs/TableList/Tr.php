<tr>
 <td><?PHP echo $id; ?></td>
 <td><input class="itemcheck" type="checkbox" name="itemid-<?PHP echo $id; ?>" /></td>
 <td><a href="<?PHP echo $uripath; ?>editblog/itemid-<?PHP echo $id; ?>.html"><?PHP echo $title; ?></a></td>
 <td><a target="_blank" href="blogview/<?PHP echo $url; ?>.html"><?PHP echo $url; ?></a></td>
 <td><?PHP echo $tags; ?></td>
 <td><?PHP echo $comments; ?></td>
 <td><input class="text w_4" type="text" name="order-<?PHP echo $id; ?>" value="<?PHP echo $order; ?>" /></td>
</tr>