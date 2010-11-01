<?php
/**
 * Copyright 2010 Monotype Imaging Inc.  
 * This program is distributed under the terms of the GNU General Public License
 */
 
defined('_JEXEC') or die ('Restricted access');
function com_install(){
	jimport('joomla.filesystem.folder');
	jimport('joomla.filesystem.file');
	jimport('joomla.installer.installer');
	$installer = & JInstaller::getInstance();

	$source  = $installer->getPath('source');
	$packages   = $source.DS.'packages';
	// Get wfsmodule package
	if(is_dir($packages)) {
		$wfsmodule   = JFolder::files($packages, 'mod_webfonts.zip', false, true);
	}
	if (! empty($wfsmodule)) {
		if (is_file($wfsmodule[0])) {
			$config = & JFactory::getConfig();
			$tmp = $config->getValue('config.tmp_path').DS.uniqid('install_').DS.basename($wfsmodule[0], '.zip');

			if (!JArchive::extract($wfsmodule[0], $tmp)) {
				$mainframe->enqueueMessage(JText::_('MODULE EXTRACT ERROR'), 'error');
			}else{
				$installer = & JInstaller::getInstance();
				$c_manifest   = & $installer->getManifest();
				$c_root     = & $c_manifest->document;
				$version    = & $c_root->getElementByPath('version');
				if(JFolder::copy($tmp,dirname($installer->getPath('extension_site')).DS.'..'.DS.'modules','',true))
				{
					//JFolder::delete($installer->getPath('extension_site'));
					if (wfsmoduleDBInstall())
					{
						$wfsmodule_result   = JText::_('Success');
					} else {
						$wfsmodule_result = JText::_('Error');
					}
				}else{
					 $wfsmodule_result = JText::_('Error');
				}
			}
		}
	}
  if (is_dir($tmp)) {
     @JFolder::delete($tmp);
  }
   	$response = 'Module:' . $wfsmodule_result;
	return response;
}

function wfsmoduleDBInstall()
{
	// Get a database object
	$db =& JFactory::getDBO();
	// This must work, while only one element with this name must exist!!!
	$query = "SELECT `id`, `params` FROM #__modules WHERE `module` = '	mod_webfonts';";
	$db->setQuery($query);
	$row = $db->loadObject();
	// if empty options, set defaults
	if (empty($row)) 
	{
		$query = "INSERT INTO #__modules VALUES ( ".
				 "NULL, 'Fonts.com web fonts', '', '0', 'debug','0', '0000-00-00 00:00:00','1', 'mod_webfonts','0','0','1','','0','0','');"; 
	} else {
		$query = "UPDATE #__modules ".
				 "`title` = 'Fonts.com web fonts', ".
				 "`module` = 'mod_webfonts', ".
				 "`showtitle` = '1', ".
				 "`access` = 0, ".
				 "`published` = 1, ".
				 "`iscore` = 0, ".
				 "`client_id` = 0, ".
				 "`params = '".$row->params."' ) WHERE `id` = ".$row->id.";"; 
	}
	$db->setQuery($query);
	return $db->query();
}




