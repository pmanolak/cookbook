<?php /* SVN FILE: $Id: collections.ctp 600 2008-08-07 17:55:23Z AD7six $ */ ?>
<div id="main_nav">
<ul class="navigation">
<?php
$collections = cache('views/collection_' . $this->params['lang']);
if ($collections) {
	$collections = unserialize($collections);
} else {
	$collections = $this->requestAction('/nodes/collections/' . $this->params['lang']);
}
$currentCollection = isset($currentPath[1])?$currentPath[1]:array('Node' => array('id' => false));
foreach ($collections as $row) {
	extract($row);
	if ($currentCollection['Node']['id'] == $Node['id']) {
		$options = array('class' => 'active');
	} else {
		$options = array();
	}
	$links[] = $html->link($Revision['title'],
		array('prefix' => null, 'plugin' => null, 'controller' => 'nodes', 'action' => 'view', $Node['id'], $Revision['slug']),
		$options
	);
}
echo '<li>' . implode($links, '</li><li>') . '</li>';
?>
</ul>
</div>