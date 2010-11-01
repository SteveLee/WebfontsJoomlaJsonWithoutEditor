<?php
/**
 * Copyright 2010 Monotype Imaging Inc.  
 * This program is distributed under the terms of the GNU General Public License
 */
 
/**
 * Webfonts template for fonts.com webfonts Component
 * 
 * @Components    Fonts.com Webfonts
 * components/com_webfonts/webfonts.php
 * @license    GPL
 */

// No direct access
defined('_JEXEC') or die('Restricted access'); ?>
<div id='wfs_message' style="display:none">
<dl id="system-message">
<dt class="message">Message</dt>
<dd class="message fade">
	<ul>
		<li id="wfsMsg">&nbsp;</li>
	</ul>
</dd>
</dl>
</div>
<div id="submenu-box">
			<div class="t">
				<div class="t">
					<div class="t"></div>
		 		</div>
	 		</div>
			<div class="m">
				<ul id="submenu" class="wfs_tabNav">
                    <li class="wfs_current">
                  		 <a href="javascript:;" id="main_tab">Configure</a>
                    </li>
                    <li>
                  		<a href="index.php?option=com_webfonts&controller=webfontsconfigure&task=edit_stylesheet&cid[]=<?php echo $this->wfs_projects->wfs_configure_id; ?>" id="main_tab">Work on stylesheet</a>
                    </li>
                    <li>
                  	 	<a href="index.php?option=com_webfonts&controller=webfontsconfigure&task=edit_domain&cid[]=<?php echo $this->wfs_projects->wfs_configure_id; ?>" id="main_tab">Domain</a>
                    </li>
                </ul>
				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
		 			<div class="b"></div>
				</div>
			</div>
		</div>
<form action="index.php?option=com_webfonts" method="post" name="adminForm">        
<div class="wfs_tabContainer">
 	<!-- COnfigure Tab -->
    <div class="wfs_tab  wfs_current">
   
       <?php startRoundDiv() ?>
             <!-- start of page display setting -->
            <?php startRoundDiv(); ?>
            <h3 class="wfs_row" style="margin-top:0;"><?php echo JText::_( 'Pages Display Setting' ); ?></h3>
            <div class="wfs_info_text wfs_day_row">
           	 <?php echo JText::_( 'You can select the pages to display web fonts, please make sure your Web Font Project has the fonts selected and has the corresponding Selectors.' ); ?>
            </div>
            <div class="wfs_row" >
            		<?php
					if (count( $this->wfs_lookup) == 0 &&  empty($this->wfs_lookup[0]->value)){
						$select_pages = 1;
						}
					else if (count( $this->wfs_lookup) == 1 &&  $this->wfs_lookup[0]->value == 0) {
							$select_pages = 1;
					} else {
						$select_pages = 0;
					}
					?>
                    <label for="every_page"><input type="radio" id="every_page" name="page_visiblity" <?php echo ($select_pages == 1)?'checked="checked"':''; ?> value="0" onclick="allselections();"/>&nbsp;&nbsp;Show on every page </label>
                    <label for="listed_page"><input type="radio" id="listed_page" name="page_visiblity" value="1"  <?php echo ($select_pages == 0)?'checked="checked"':''; ?> onclick="enableselections();" />&nbsp;&nbsp;Show on only listed pages</label>
            </div>
             
             <!--menu assignment-->
             <div class="wfs_panel" >
                <h3 id="wfs_hidediv"><span class="left"><?php echo JText::_( 'Page List' ); ?></span><span class="arrowhead" style="display:none"></span>
                    <div class="clear"></div></h3>
                    <div class="wfs_hiddendiv"  style="display:none">
                        <table class="admintable" cellspacing="1">
                        <tr>
                            <td valign="top" class="key">
							<?php echo JText::_( 'Menu Selection' ); ?>:
							</td>
                            <td>
                                <?php
								$selections	= JHTML::_('menu.linkoptions');
								$lists	= JHTML::_('select.genericlist',   $selections, 'selections[]', 'class="inputbox" size="15" multiple="multiple"', 'value', 'text', $this->wfs_lookup, 'selections' );
								echo $lists; ?>
                                <?php if ($select_pages == 1) { ?>
								<script type="text/javascript">allselections();</script>
                                <?php } ?>
                            </td>
                        </tr>
                    </table>
                    <div class="clear"></div>
                    <div class="wfs_info_text wfs_day_row">
           	 			<i><?php echo JText::_( 'This menu selection option will be common for all the projects.' ); ?></i>
            		</div>
                    </div>
                    
                </div>		
			 <!-- end menu assignment-->
             <div class="wfs_info_text wfs_day_row" style="margin-top:10px;">
           	 Display for day of week <input type="text" name="days" id="edit-days" size="3" value="<?php echo $this->wfs_projects->project_day ?>" /> 0 for Sunday, 1 for Monday...and 6 for Saturday, use - for day range {eg: 0-6 for displaying from Sunday to Saturday}, you can also use comma separate days{eg: 1,3,4 for displaying on Monday, Wednesday and Thursday}
            </div> 
               
            <div class="clr"></div>
            <?php endRoundDiv(); ?>
            <div class="wfs_row"></div>
            <!-- end of page display setting -->
            <?php if($this->wfs_user_type != 0) {?>
            <!-- start of source setting -->
             <div id="submenu-box">
                <div class="t">
                        <div class="t">
                            <div class="t"></div>
                        </div>
                    </div>
                <div class="m"><div>
               <h3 class="wfs_row" style="margin-top:0;"><?php echo JText::_( 'Publish Method' ); ?></h3>
              		<div class="wfs_row" >
                    <label for="javascript"><input type="radio" id="javascript" name="source_selection"  value="0" <?php echo ($this->wfs_projects->project_options == 0)?"checked":"";?>/>&nbsp;&nbsp;Javascript</label>
                    <label for="stylesheet"><input type="radio" id="stylesheet" name="source_selection" value="1" <?php echo ($this->wfs_projects->project_options == 1)?"checked":"";?>/>&nbsp;&nbsp;Stylesheet</label>
            		</div>
                </div>
                <div class="clear"></div></div>
                <div class="b"><div class="b">
                            <div class="b"></div>
                        </div>
                    </div>
                </div>
             <div class="wfs_row"></div>
            <!-- end of source setting -->
             <?php } ?>
             
        <input type="hidden" name="option" value="com_webfonts" />
        <input type="hidden" name="project_id" value="<?php echo $this->wfs_projects->wfs_configure_id; ?>" readonly="readonly" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="controller" value="webfontsconfigure" />
        <input  type="hidden"  id="project_key"  name="project_key"  value="<?php echo $this->wfs_projects->project_key;?>" readonly="readonly" />
        <div class="clear wfs_row" style="margin-top:10px;">
    	<div class="left">
        	<span class="b_outer"><span class="b_inner">
    		<input type="button" class="b_style" id="save" value="Save" onclick="javascript: submitbutton('save_configure')" />
    		</span></span>
         </div>
         
    </div>
     <?php endRoundDiv(); ?>
       
     
    </div>
   <!-- ENd of COnfigure Tab -->
    </div>
</form>     
        

