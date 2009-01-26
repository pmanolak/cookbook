<?php
/* SVN FILE: $Id: routes.php 703 2008-11-19 12:13:40Z AD7six $ */
/**
 * Short description for file.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright (c)	2006, Cake Software Foundation, Inc.
 *			1785 E. Sahara Avenue, Suite 490-204
 *			Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright (c) 2006, Cake Software Foundation, Inc.
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP v 0.2.9
 * @version       $Revision: 703 $
 * @modifiedby    $LastChangedBy: AD7six $
 * @lastmodified  $Date: 2008-11-19 13:13:40 +0100 (Wed, 19 Nov 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
if (!empty($fromUrl)) {
       	if (strpos($fromUrl, 'admin') === 0) {
		Router::connectNamed(true);
	} else {
		Router::connectNamed(array('node', 'user', 'language', 'status'), array('default' => true));
	}
}
Router::parseExtensions('rss', 'xml');
// Legacy
Router::connect('/chapter/*', array('controller' => 'redirect', 'action' => 'process', 'chapter'));
Router::connect('/appendix/*', array('controller' => 'redirect', 'action' => 'process', 'appendix'));
// missing images
Router::connect('/img/*', array('controller' => 'attachments', 'action' => 'view'), array('lang' => 'en'));

$routes = array(
	array('/', array('controller' => 'nodes', 'action' => 'index'), array()),
	array('/comments/:id/*', array('controller' => 'comments', 'action' => 'index'), array('id' => '[0-9]+')),
	array('/comments/:action/*', array('controller' => 'comments', 'action' => 'index'), array()),
	/* array('/:action/*', array('controller' => 'nodes'), array('action' => 'add|compare|complete|edit|history|stats|toc|todo|view')), */
	array('/add/*', array('controller' => 'nodes', 'action' => 'add'), array()),
	array('/compare/*', array('controller' => 'nodes', 'action' => 'compare'), array()),
	array('/complete/*', array('controller' => 'nodes', 'action' => 'complete'), array()),
	array('/edit/*', array('controller' => 'nodes', 'action' => 'edit'), array()),
	array('/history/*', array('controller' => 'nodes', 'action' => 'history'), array()),
	array('/stats/*', array('controller' => 'nodes', 'action' => 'stats'), array()),
	array('/toc/*', array('controller' => 'nodes', 'action' => 'toc'), array()),
	array('/todo/*', array('controller' => 'nodes', 'action' => 'todo'), array()),
	array('/view/*', array('controller' => 'nodes', 'action' => 'view'), array()),
	/* array('/:action/*', array('controller' => 'revisions'), array('action' => 'search|results')), */
	array('/search/*', array('controller' => 'revisions', 'action' => 'search'), array()),
	array('/results/*', array('controller' => 'revisions', 'action' => 'results'), array()),
	array('/changes/:action/*', array('controller' => 'changes', 'action' => 'index'), array()),
	array('/nodes/:action/*', array('controller' => 'nodes', 'action' => 'index'), array()),
	array('/revisions/:action/*', array('controller' => 'revisions', 'action' => 'index'), array()),
	array('/users/:action/*', array('plugin' => 'users', 'controller' => 'users', 'action' => 'index'), array()),
	array('/admin/users/:action/*', array('prefix' => 'admin', 'plugin' => 'users', 'controller' => 'users', 'action' => 'index', 'admin' => true), array()),

);
foreach ($routes as $route) {
	$route[1]['lang'] = 'en'; // default language
	$route[1]['theme'] = 'mobile';
	Router::connect('/m' . $route[0], $route[1], $route[2]);
	Router::connect('/m/:lang' . $route[0], $route[1], $route[2]);

	$route[1]['theme'] = 'default'; // default layout

	$route[2]['lang'] = '(?!en)[a-z]{2}';
	Router::connect($route[0], $route[1], $route[2]);
	Router::connect('/:lang' . $route[0], $route[1], $route[2]);
}
Router::connect('/admin/:controller/:action/*', array('lang' => 'en', 'theme' => 'default', 'controller' => 'revisions', 'action' => 'pending', 'admin' => true), array());
Router::connect('/m/:controller/:action/*', array('lang' => 'en', 'theme' => 'mobile', 'controller' => 'nodes', 'action' => 'index'), array());
Router::connect('/:controller/:action/*', array('lang' => 'en', 'theme' => 'default', 'controller' => 'nodes', 'action' => 'index'), array());
?>