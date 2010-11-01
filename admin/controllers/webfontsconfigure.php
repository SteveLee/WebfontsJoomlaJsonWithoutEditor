<?php
/**
 * Copyright 2010 Monotype Imaging Inc.  
 * This program is distributed under the terms of the GNU General Public License
 */
 
/**
 * Hello Controller for Hello World Component
 * 
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class WebfontsBaseControllerWebfontsConfigure extends WebfontsBaseController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();

	}
	/*
	*project home page
	*/
	function project_list(){
		$this->setRedirect('index.php?option=com_webfonts&controller=webfontsproject');
	}
	
	/*
	*project home page
	*/
	function login_page(){
		$this->setRedirect('index.php?option=com_webfonts&controller=webfontslogin');
	}
	/**
	 * display the edit form configure
	 * @return void
	 */
	function edit()
	{
		JRequest::setVar( 'view', 'webfontsconfigure' );
		parent::display();
	}
	
	function edit_domain()
	{
		JRequest::setVar( 'view', 'webfontsconfigure' );
		JRequest::setVar('layout', 'edit_domain');
		parent::display();
	}
	
	function edit_stylesheet()
	{
		JRequest::setVar( 'view', 'webfontsconfigure' );
		JRequest::setVar('layout', 'edit_stylesheet');
		$model = $this->getModel('webfontsconfigure');
		$data= $model->getData();
		$key = $data->project_key;
		$document =& JFactory::getDocument();
		$js = FFJSAPIURI.$key.".js";
		$document->addScript($js);
		parent::display();
	}
	
	function edit_domain_form()
	{
		JRequest::setVar( 'view', 'webfontsconfigure' );
		JRequest::setVar('layout', 'edit_domain_form');
		parent::display();
	}
	
	/**
	 * save a record (and redirect to main page)
	 * @return void
	 */
	function save_configure()
	{
		$project_id = JRequest::getvar( 'project_id' );
		$model = $this->getModel('webfontsconfigure');
		$link = 'index.php?option=com_webfonts&controller=webfontsconfigure&task=edit&cid[]='.$project_id;
		if ($model->store_configure($post)) {
			$msg = JText::_( 'Configuration Saved Succesfully!' );
			$this->setRedirect($link, $msg);
		} else {
			$msg = JText::_( 'Error Saving Configuration' );
			$this->setRedirect($link, $msg, 'error');
		}
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		
		$this->setRedirect( 'index.php?option=com_webfonts&controller=webfontsproject');
	}
	
	/*
	* Fonts listing record(s) from ajax 
	* @return fonts list
	*/
	function fonts_list_ajax(){
		$model_project = $this->getModel('webfontsproject');
		$project_data = $model_project->getProjectProfile($_GET['pid'],'project_key');
		$model = $this->getModel('webfontsconfigure');
		$fonts_lists = $model->wfs_font_list_pagination($project_data[0]->wfs_configure_id );
		$json = new Services_JSON();
		$result = $json->encode($fonts_lists);
		echo $result;
		exit;
	}
	
	/*
	* Fonts listing record(s) from ajax 
	* @return fonts list
	*/
	function selector_list_ajax(){
		$model = $this->getModel('webfontsconfigure');
		$data = $model->getSelectorsList($_GET['pid']);
		$selector_list = array('data' => $data[0],'pagination'=>$data[1]);
		$json = new Services_JSON();
		$result = $json->encode($selector_list);
		echo $result;
		exit;
	}
	/*
	*Selector adding function
	*@return void
	*/
	function selector_add_ajax(){
		$model = $this->getModel('webfontsconfigure');
		$data = $model->add_selector();
		$selector_list = array('data' => $data[0],'pagination'=>$data[1]);
		$json = new Services_JSON();
		$result = $json->encode($selector_list);
		echo $result;
		exit;
	}
	/*
	*Selector saving function
	*@return void
	*/
	function save_selector(){
		$model = $this->getModel('webfontsconfigure');
		$link = 'index.php?option=com_webfonts&controller=webfontsconfigure&task=edit_stylesheet&cid[]='.$_POST['project_id'];
		if ($model->save_selector($post)) {
			$msg = JText::_( 'Selector Saved Succesfully!' );
			$this->setRedirect($link, $msg);
		} else {
			$msg = JText::_( 'Error Saving Selector' );
			$this->setRedirect($link, $msg, 'error');
		}
	}
	
	/*
	*Selector removings function
	*@return void
	*/
	function remove_selector(){
		$model = $this->getModel('webfontsconfigure');
		$link = 'index.php?option=com_webfonts&controller=webfontsconfigure&task=edit_stylesheet&cid[]='.$_POST['project_id'];
		if ($model->remove_selector($post)) {
			$msg = JText::_( 'Selector Delete Succesfully!' );
			$this->setRedirect($link, $msg);
		} else {
			$msg = JText::_( 'Error Deleting Selector' );
			$this->setRedirect($link, $msg, 'error');
		}
	}
	
	
		/*
	* Domnains listing record(s) from ajax 
	* @return fonts list
	*/
	function domain_list_ajax(){
		$model = $this->getModel('webfontsconfigure');
		$data = $model->getDomains($_GET['pid']);
		$domain_list = array('data' => $data[0],'pagination'=>$data[1]);
		$json = new Services_JSON();
		$result = $json->encode($domain_list);
		echo $result;
		exit;
	}
	
	function addDomain(){
		$model = $this->getModel('webfontsconfigure');
		$data = $model->addDomain();
		$domain_list = array('data' => $data[0],'pagination'=>$data[1]);
		$json = new Services_JSON();
		$result = $json->encode($domain_list);
		echo $result;
		exit;
	}
	
	/*
	*Domain removings function
	*@return void
	*/
	function remove_domain(){
		$model = $this->getModel('webfontsconfigure');
		$link = 'index.php?option=com_webfonts&controller=webfontsconfigure&task=edit_domain&cid[]='.$_POST['project_id'];
		if ($model->removeDomain($post)) {
			$msg = JText::_( 'Domain Delete Succesfully!' );
			$this->setRedirect($link, $msg);
		} else {
			$msg = JText::_( 'Error Deleting Domain' );
			$this->setRedirect($link, $msg, 'error');
		}
	}
	
	function editDomain(){
		$model = $this->getModel('webfontsconfigure');
		$link = 'index.php?option=com_webfonts&controller=webfontsconfigure&task=edit_domain&cid[]='.$_POST['project_id'];
		if ($model->editDomain($post)) {
			$msg = JText::_( 'Domain Edited Succesfully!' );
			$this->setRedirect($link, $msg);
		} else {
			$msg = JText::_( 'Error Editing Domain' );
			$this->setRedirect($link, $msg,'error');
		}
	}
	

}