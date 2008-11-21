<?php /* SVN FILE: $Id: edit.ctp 673 2008-10-06 14:05:17Z AD7six $ */ ?>
<div class="nodes form">
<?php
$contents = '';
if (isset($this->data['Revision']['content'])) {
	$contents = $this->data['Revision']['content'];
	preg_match_all('@<pre[^>]*>([\\s\\S]*?)</pre>@i', $contents, $result, PREG_PATTERN_ORDER);
	if (!empty($result['0'])) {
		$count = count($result['0']);
		for($i = 0; $i < $count; $i++) {
			$replaced = str_replace('&lt;', '<',  $result['1'][$i]);
			$replaced = str_replace('&gt;', '>', $replaced);
			$contents = str_replace($result[1][$i], $replaced, $contents);
		}
	}
}
echo $this->element('attachments', array('path' => IMAGES . 'Node/' . $this->data['Revision']['node_id']));
if ($session->read('Auth.User.Level') == ADMIN && $this->action == 'edit') {
	$menu->addm('Admin Functions', array(
		array('title' => 'Edit Node Properties', 'url' => array('admin' => true, 'action' => 'edit', $this->data['Revision']['node_id'])),
		array('title' => 'TOC', 'url' => array('admin' => true, 'action' => 'toc', $this->data['Revision']['node_id'])),
		array('title' => 'Merge', 'url' => array('admin' => true, 'action' => 'merge', $this->data['Revision']['node_id'])),
		array('title' => 'Upload Image/File', 'url' => array('admin' => true, 'controller' => 'attachments', 'action' => 'add', 'Node', $this->data['Revision']['node_id'])),
	));
}
echo $html->link(__('Please review the guidelines for submitting to the Cookbook to ensure consistency.', true),
	array('controller' => 'nodes', 'action' => 'view', 482, 'contributing-to-the-cookbook'));
echo $this->element('preview');
echo $form->create(null, array('url' => '/' . $this->params['url']['url']));
$inputs = array (
	'Revision.node_id' => array('type' => 'hidden'),
	'Revision.preview' => array('type' => 'checkbox', 'label' => __('Show me a preview before submitting', true), 'error' => false),
	'Revision.title',
	'Revision.content' => array (
		'label' => __('Contents. Code in pre tags will be escaped. Submissions with no html formatting will be formatted automatically', true),
		'cols' => 100,
		'rows' => 30,
		'value' => $contents
	),
	'Revision.reason' => array('label' => __('What is the reason for the edit? (In English Please) :)', true)),
);
if ($session->read('Auth.User.Level') == ADMIN) {
	$inputs = am(array('Node.show_in_toc' => array('type' => 'checkbox')), $inputs);
}
echo $form->inputs($inputs);
echo $form->submit('save');
echo $form->end();
?>
</div>
<?php echo $this->element('markitup', array('process' => 'textarea')); ?>