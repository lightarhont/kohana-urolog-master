<tr>
 <td><?PHP echo $id; ?></td>
 <td><input class="itemcheck" type="checkbox" name="itemid-<?PHP echo $id; ?>" /></td>
 <td><a href="<?PHP echo $uripath; ?>edituser/itemid-<?PHP echo $id; ?>.html"><?PHP echo $username; ?></a></td>
 <td><?PHP echo $fullname; ?></td>
 <td><?PHP echo $email; ?></td>
 <td><?PHP echo $userroles; ?></td>
 <td><input class="text w_4" type="text" name="order-<?PHP echo $id; ?>" value="<?PHP echo $order; ?>" /></td>
</tr>