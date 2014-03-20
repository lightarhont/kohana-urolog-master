<?php
/*
	First Previous 1 2 3 ... 22 23 24 25 26 [27] 28 29 30 31 32 ... 48 49 50 Next Last
*/

// Number of page links in the begin and end of whole range
$count_out = ( ! empty($config['count_out'])) ? (int) $config['count_out'] : 3;
// Number of page links on each side of current page
$count_in = ( ! empty($config['count_in'])) ? (int) $config['count_in'] : 5;

// Beginning group of pages: $n1...$n2
$n1 = 1;
$n2 = min($count_out, $total_pages);

// Ending group of pages: $n7...$n8
$n7 = max(1, $total_pages - $count_out + 1);
$n8 = $total_pages;

// Middle group of pages: $n4...$n5
$n4 = max($n2 + 1, $current_page - $count_in);
$n5 = min($n7 - 1, $current_page + $count_in);
$use_middle = ($n5 >= $n4);

// Point $n3 between $n2 and $n4
$n3 = (int) (($n2 + $n4) / 2);
$use_n3 = ($use_middle && (($n4 - $n2) > 1));

// Point $n6 between $n5 and $n7
$n6 = (int) (($n5 + $n7) / 2);
$use_n6 = ($use_middle && (($n7 - $n5) > 1));

// Links to display as array(page => content)
$links = array();

// Generate links data in accordance with calculated numbers
for ($i = $n1; $i <= $n2; $i++)
{
	$links[$i] = $i;
}
if ($use_n3)
{
	$links[$n3] = '&hellip;';
}
for ($i = $n4; $i <= $n5; $i++)
{
	$links[$i] = $i;
}
if ($use_n6)
{
	$links[$n6] = '&hellip;';
}
for ($i = $n7; $i <= $n8; $i++)
{
	$links[$i] = $i;
}

?>

	<?php if ($first_page !== FALSE): ?>
		<a href="<?php echo 'questions/page-'.$first_page.'.html'; ?>" rel="first"><?php echo __('Начало') ?></a>
	<?php else: ?>
		<div class="unactive"><?php echo __('Начало') ?></div>
	<?php endif ?>

	<?php if ($previous_page !== FALSE): ?>
		<a href="<?php echo 'questions/page-'.$previous_page.'.html'; ?>" rel="prev"><?php echo __('Предыдущая страница') ?></a>
	<?php else: ?>
		<div class="unactive"><?php echo __('Предыдущая страница') ?></div>
	<?php endif ?>

	<?php foreach ($links as $number => $content): ?>

		<?php if ($number === $current_page): ?>
			<div class="active"><?php echo $content ?></div>
		<?php else: ?>
			<a href="<?php echo 'questions/page-'.$number.'.html'; ?>"><?php echo $content ?></a>
		<?php endif ?>

	<?php endforeach ?>

	<?php if ($next_page !== FALSE): ?>
		<a href="<?php echo 'questions/page-'.$next_page.'.html'; ?>" rel="next"><?php echo __('Следующая страница') ?></a>
	<?php else: ?>
		<div class="unactive"><?php echo __('Следующая страница') ?></div>
	<?php endif ?>

	<?php if ($last_page !== FALSE): ?>
		<a href="<?php echo 'questions/page-'.$last_page.'.html'; ?>" rel="last"><?php echo __('Конец') ?></a>
	<?php else: ?>
		<div class="unactive"><?php echo __('Конец') ?></div>
	<?php endif ?>

<!-- .pagination -->