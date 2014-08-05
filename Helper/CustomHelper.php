<?php
/**
 * Custom Helper
 *
 */
class CustomHelper extends Helper {

/**
 * Other helpers used by this helper
 *
 * @var array
 * @access public
 */
	public $helpers = array(
		'Html' => array(
			'className' => 'Croogo.CroogoHtml',
		),
		'Form' => array(
			'className' => 'Croogo.CroogoHtml',
		),
		'Session',
		'Js',
		'Layout',
	);

	public function menu($menuAlias, $options = array()) {
		$_options = array(
			'tag' => 'ul',
			'tagAttributes' => array(),
			'selected' => 'active-trail active',
			'dropdown' => false,
			'dropdownClass' => 'dropdown',
			'dropdownMenuClass' => 'dropdown-menu',
			'toggle' => 'dropdown-toggle',
			'menuClass' => 'menu',
			'element' => 'menu',
		);
		$options = Hash::merge($_options, $options);

		if (!isset($this->_View->viewVars['menus_for_layout'][$menuAlias])) {
			return false;
		}
		$menu = $this->_View->viewVars['menus_for_layout'][$menuAlias];
		$output = $this->_View->element($options['element'], array(
			'menu' => $menu,
			'options' => $options,
				));
		return $output;
	}

	/** Generate Admin menus added by CroogoNav::add()
	 *
	 * @param array $menus
	 * @param array $options
	 * @return string menu html tags
	 */
	public function adminMenus($menus, $options = array(), $depth = 0) {
		$options = Hash::merge(array(
			'type' => 'sidebar',
			'children' => true,
			'htmlAttributes' => array(
				'class' => 'nav nav-stacked',
			),
		), $options);

		$aclPlugin = Configure::read('Site.acl_plugin');
		$userId = AuthComponent::user('id');
		if (empty($userId)) {
			return '';
		}

		$sidebar = $options['type'] === 'sidebar';
		$htmlAttributes = $options['htmlAttributes'];
		$out = null;
		$sorted = Hash::sort($menus, '{s}.weight', 'ASC');
		if (empty($this->Role)) {
			$this->Role = ClassRegistry::init('Users.Role');
			$this->Role->Behaviors->attach('Croogo.Aliasable');
		}
		$currentRole = $this->Role->byId($this->Layout->getRoleId());

		foreach ($sorted as $menu) {
			if (isset($menu['separator'])) {
				$liOptions['class'] = 'divider';
				$out .= $this->Html->tag('li', null, $liOptions);
				continue;
			}
			if ($currentRole != 'admin' && !$this->{$aclPlugin}->linkIsAllowedByUserId($userId, $menu['url'])) {
				continue;
			}

			if (empty($menu['htmlAttributes']['class'])) {
				$menuClass = Inflector::slug(strtolower('menu-' . $menu['title']), '-');
				$menu['htmlAttributes'] = Hash::merge(array(
					'class' => $menuClass
				), $menu['htmlAttributes']);
			}
			$title = '';
			if ($menu['icon'] === false) {
			} elseif (empty($menu['icon'])) {
				$menu['htmlAttributes'] += array('icon' => 'white');
			} else {
				$menu['htmlAttributes'] += array('icon' => $menu['icon']);
			}

			if ($depth > 0) {
				$title = $menu['title'];
			} else {
				$title .= '<span>' . $menu['title'] . '</span>';
			}

			$children = '';
			if (!empty($menu['children'])) {
				$title .= '<i class="fa fa-angle-left pull-right"></i>';
				$menu['url'] = '#';

				$childClass = '';
				if ($sidebar) {
					$childClass = 'nav nav-stacked sub-nav ';
					$childClass .= ' submenu-' . Inflector::slug(strtolower($menu['title']), '-');
					if ($depth > 0) {
						$childClass .= ' dropdown-menu';
					}
				} else {
					if ($depth == 0) {
						$childClass = 'dropdown-menu';
					}
				}
				$children = $this->adminMenus($menu['children'], array(
					'type' => $options['type'],
					'children' => true,
					'htmlAttributes' => array('class' => $childClass),
				), $depth + 1);

				//$menu['htmlAttributes']['class'] .= ' hasChild dropdown-close';
			}
			//$menu['htmlAttributes']['class'] .= ' sidebar-item';

			$menuUrl = $this->url($menu['url']);
			if ($menuUrl == env('REQUEST_URI')) {
				if (isset($menu['htmlAttributes']['class'])) {
					$menu['htmlAttributes']['class'] .= ' current';
				} else {
					$menu['htmlAttributes']['class'] = 'current';
				}
			}

			/*if (!$sidebar && !empty($children)) {
				if ($depth == 0) {
					$title .= ' <b class="caret"></b>';
				}
				$menu['htmlAttributes']['class'] = 'dropdown-toggle';
				$menu['htmlAttributes']['data-toggle'] = 'dropdown';
			}*/

			if (isset($menu['before'])) {
				$title = $menu['before'] . $title;
			}

			if (isset($menu['after'])) {
				$title = $title . $menu['after'];
			}

			$link = $this->Html->link($title, $menu['url'], $menu['htmlAttributes']);
			$liOptions = array();
			if (!$sidebar && !empty($children)) {
				//if ($depth === 0) {
					$liOptions['class'] = 'treeview';
				//}
			}
			$out .= $this->Html->tag('li', $link . $children, $liOptions);
		}

		if (!$sidebar && $depth > 0) {
			$htmlAttributes['class'] = 'treeview-menu';
		}

		return $this->Html->tag('ul', $out, $htmlAttributes);
	}

	/** Generate Admin menus added by CroogoNav::add()
	 *
	 * @param array $menus
	 * @param array $options
	 * @return string menu html tags
	 */
	public function buttonMenu($menus, $options = array(), $depth = 0) {
		/*if (isset($menus['user'])) {
			$menus = $menus['user']['children'];
		}*/
		$options = Hash::merge(array(
			'type' => 'dropdown',
			'htmlAttributes' => array(
				'class' => 'btn-group'
			),
			'children' => true,
		), $options);

		$aclPlugin = Configure::read('Site.acl_plugin');
		$userId = AuthComponent::user('id');
		if (empty($userId)) {
			return '';
		}

		$sidebar = $options['type'] === 'sidebar';
		$htmlAttributes = $options['htmlAttributes'];
		$out = null;
		$sorted = Hash::sort($menus, '{s}.weight', 'ASC');
		if (empty($this->Role)) {
			$this->Role = ClassRegistry::init('Users.Role');
			$this->Role->Behaviors->attach('Croogo.Aliasable');
		}
		$currentRole = $this->Role->byId($this->Layout->getRoleId());

		foreach ($sorted as $menu) {
			if (isset($menu['separator'])) {
				$liOptions['class'] = 'divider';
				$out .= $this->Html->tag('li', null, $liOptions);
				continue;
			}
			if ($currentRole != 'admin' && !$this->{$aclPlugin}->linkIsAllowedByUserId($userId, $menu['url'])) {
				continue;
			}

			if (empty($menu['htmlAttributes']['class'])) {
				$menuClass = Inflector::slug(strtolower('menu-' . $menu['title']), '-');
				$menu['htmlAttributes'] = Hash::merge(array(
					'class' => $menuClass
				), $menu['htmlAttributes']);
			}
			$title = '';
			if ($menu['icon'] === false) {
			} elseif (empty($menu['icon'])) {
				$menu['htmlAttributes'] += array('icon' => 'white');
			} else {
				$menu['htmlAttributes'] += array('icon' => $menu['icon']);
			}

			if ($depth > 0) {
				$title = $menu['title'];
			} else {
//				$title .= '<span>' . $menu['title'] . '</span>';
				$title .= $menu['title'];
			}

			$children = '';
			if (!empty($menu['children'])) {
				$childClass = '';
				if ($sidebar) {
					$childClass = 'nav nav-stacked sub-nav ';
					$childClass .= ' submenu-' . Inflector::slug(strtolower($menu['title']), '-');
					if ($depth > 0) {
						$childClass .= ' dropdown-menu';
					}
				} else {
					if ($depth == 0) {
						$childClass = 'dropdown-menu';
					}
				}
				$children = $this->buttonMenu($menu['children'], array(
					'type' => $options['type'],
					'children' => true,
					'htmlAttributes' => array(
						'class' => $childClass,
						'role'  => 'menu'
					),
				), $depth + 1);

				//$menu['htmlAttributes']['class'] .= ' hasChild dropdown-close';
			}
			//$menu['htmlAttributes']['class'] .= ' sidebar-item';

			$menuUrl = $this->url($menu['url']);
			if ($menuUrl == env('REQUEST_URI')) {
				if (isset($menu['htmlAttributes']['class'])) {
					$menu['htmlAttributes']['class'] .= ' current';
				} else {
					$menu['htmlAttributes']['class'] = 'current';
				}
			}

			/*if (!$sidebar && !empty($children)) {
				if ($depth == 0) {
					$title .= ' <b class="caret"></b>';
				}
				$menu['htmlAttributes']['class'] = 'dropdown-toggle';
				$menu['htmlAttributes']['data-toggle'] = 'dropdown';
			}*/

			if (isset($menu['before'])) {
				$title = $menu['before'] . $title;
			}

			if (isset($menu['after'])) {
				$title = $title . $menu['after'];
			}

			if ($depth === 0) {
				$menu['htmlAttributes']['class'] .= ' btn btn-default btn-flat';
			}

			$link = $this->Html->link($title, $menu['url'], $menu['htmlAttributes']);
			$liOptions = array();
			if (!$sidebar && !empty($children)) {
				if ($depth === 0) {
					$liOptions['class'] = 'btn-group';
				}
			}
			if ($depth > 0) {
				$out .= $this->Html->tag('li', $link . $children, $liOptions);
			} else {
				if (!empty($menu['children'])) {
					$out .= $this->Html->tag('div', $link . '<button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>'. $children, array(
						'class' => 'btn-group'
					));
				} else {
					$out .= $link;
				}
			}
		}

		if ($depth === 0) {
			//return $out;
			return $this->Html->tag('div', $out, $htmlAttributes);
		} else {
			return $this->Html->tag('ul', $out, $htmlAttributes);
		}
	}


	/**
 * Nested Links
 *
 * @param array $links model output (threaded)
 * @param array $options (optional)
 * @param integer $depth depth level
 * @return string
 */
	public function nestedLinks($links, $options = array(), $depth = 1) {
		$_options = array('menuClass' => 'nav-dropdown');
		$options = array_merge($_options, $options);

		$output = '';
		$count = count($links);
		$index = 0;
		foreach ($links AS $link) {
			$linkAttr = array(
				'id' => 'link-' . $link['Link']['id'],
				'rel' => $link['Link']['rel'],
				'target' => $link['Link']['target'],
				'title' => $link['Link']['description'],
				'class' => $link['Link']['class'],
			);

			foreach ($linkAttr AS $attrKey => $attrValue) {
				if ($attrValue == null) {
					unset($linkAttr[$attrKey]);
				}
			}

			// if link is in the format: controller:contacts/action:view
			if (strstr($link['Link']['link'], 'controller:')) {
				$link['Link']['link'] = $this->Layout->linkStringToArray($link['Link']['link']);
			}

			// Remove locale part before comparing links
			if (!empty($this->params['locale'])) {
				$currentUrl = substr($this->_View->request->url, strlen($this->params['locale']));
			} else {
				$currentUrl = $this->_View->request->url;
			}

			if (Router::url($link['Link']['link']) == Router::url('/' . $currentUrl)) {
				if (!isset($linkAttr['class'])) {
					$linkAttr['class'] = '';
				}
				$linkAttr['class'] .= ' ' . $options['selected'];
			}

			if ($index == 0) {
				$linkAttr['class'] .= ' first';
			}
			if (($index + 1) == $count) {
				$linkAttr['class'] .= ' last';
			}

			$linkAttr['class'] .= ' leaf';

			$linkOutput = $this->Html->link($link['Link']['title'], $link['Link']['link']);
			if (isset($link['children']) && count($link['children']) > 0) {
				if (!isset($linkAttr['class'])) {
					$linkAttr['class'] = '';
				}
				$linkOutput = $this->Html->link($link['Link']['title'] . '<b class="caret"></b>', $link['Link']['link'], array('class' => $options['toggle'], 'data-toggle' => $options['dropdownClass'], 'escape' => false));
				$linkAttr['class'] .= ' ' . $options['dropdownClass'];
				$linkOutput .= $this->nestedLinks($link['children'], $options, $depth + 1);
			}
			$linkOutput = $this->Html->tag('li', $linkOutput, $linkAttr);
			$output .= $linkOutput;

			++$index;
		}
		if ($output != null) {
			$tagAttr = $options['tagAttributes'];
			if ($options['dropdown'] && $depth == 1) {
				$tagAttr['class'] = $options['menuClass'];
			}
			if ($depth > 1) {
				$tagAttr['class'] = $options['dropdownMenuClass'];
			}
			$output = $this->Html->tag($options['tag'], $output, $tagAttr);
		}

		return $output;
	}

}