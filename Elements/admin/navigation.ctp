<!-- sidebar menu: : style can be found in sidebar.less -->
<?php
$cacheKey = 'adminnav_' . $this->Layout->getRoleId() . '_' . $this->request->url . '_' . md5(serialize($this->request->query));
$navItems = false;
if ($navItems === false) {
	$navItems = $this->Custom->adminMenus(CroogoNav::items(), array(
		'htmlAttributes' => array(
			'class' => 'sidebar-menu',
		),
		'type' => ' l'
	));
	//Cache::write($cacheKey, $navItems, 'croogo_menus');
}
echo $navItems;
