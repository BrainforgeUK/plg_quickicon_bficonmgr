<?php
/**
 * @package   Plugin for managing icons displayed by mod_quickicon.
 * @version   0.0.1
 * @author    https://www.brainforge.co.uk
 * @copyright Copyright (C) 2020 Jonathan Brain. All rights reserved.
 * @license   GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Language\Text;
use \Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Router\Route;

defined('_JEXEC') or die;

/**
 */
class plgQuickiconBficonmgr extends CMSPlugin
{
    public function onGetIcons($context)
    {
		$links = $this->params->get('links');
		if (empty($links)) return null;

		$icons = [];

		foreach($links as $id=>$link)
		{
			$module = &ModuleHelper::getModuleById($link->module_id);
			if (!is_object($module->params))
			{
				$module->params = json_decode($module->params);
			}

			if ($module->params->context != $context) continue;

			$icons[] = array(
				'link'      => Route::_($link->url),
				'image'     => 'picture fas ' . $link->icon,
				'text'      => Text::_($link->title),
				'id'        => 'plg_quickicon_bficonmgr_' . $id,
			);
		}

	    return $icons;
    }
}
