<?php
/**
 * Copyright 2010 Monotype Imaging Inc.  
 * This program is distributed under the terms of the GNU General Public License
 */
 
function com_uninstall(){
	jimport('joomla.filesystem.folder');
	jimport('joomla.filesystem.file');
	jimport('joomla.installer.installer');
	$installer = & JInstaller::getInstance();

	$source  = $installer->getPath('source');
	//uninstall the module
	if (JFolder::exists(dirname($installer->getPath('extension_site')).DS.'..'.DS.'modules'))
	{
		if(JFolder::delete(dirname($installer->getPath('extension_site')).DS.'..'.DS.'modules'.DS.'mod_webfonts'))
		{
			$module_result   = JText::_('Success');
		}else{
			$module_result = JText::_('Error');
		}
	}
	$module_result   = JText::_('Success');
	
	
	$response = 'Module: ' . $module_result;
	return $response;
	
}