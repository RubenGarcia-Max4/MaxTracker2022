<?php
/* @package Joomla
 * @copyright Copyright (C) Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @extension Phoca Extension
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die();
jimport( 'joomla.application.component.view');
jimport( 'joomla.itemsystem.folder' ); 
jimport( 'joomla.itemsystem.file' );

class PhocaPhotoViewCategory extends JViewLegacy
{
	protected $category;
	protected $subcategories;
	protected $items;
	protected $t;
	
	function display($tpl = null) {		
		
		$app					= JFactory::getApplication();
		$this->t['p'] 			= $app->getParams();
		$uri 					= JFactory::getURI();
		$model					= $this->getModel();
		$document				= JFactory::getDocument();
		$this->t['categoryid']	= $app->input->get( 'id', 0, 'int' );
		$limitStart				= $app->input->get( 'limitstart', 0, 'int' );
		
		$this->category			= $model->getCategory($this->t['categoryid']);
		$this->subcategories	= $model->getSubcategories($this->t['categoryid']);
		$this->items			= $model->getItemList($this->t['categoryid']);
		$this->t['pagination']	= $model->getPagination($this->t['categoryid']);
		
		$this->t['photopathrel']	= JURI::base().'phocaphoto/';
		$this->t['photopathabs']	= JPATH_ROOT .'/phocaphoto/';
		$this->t['action']		= $uri->toString();
		
		
		if ($limitStart > 0 ) {
			$this->t['limitstarturl'] =  '&start='.$limitStart;
		} else {
			$this->t['limitstarturl'] = '';
		}
		
		$this->t['photo_metakey'] 			= $this->t['p']->get( 'photo_metakey', '' );
		$this->t['photo_metadesc'] 			= $this->t['p']->get( 'photo_metadesc', '' );
		//$this->t['description']				= $this->t['p']->get( 'description', '' );
		$this->t['load_bootstrap']			= $this->t['p']->get( 'load_bootstrap', 0 );
		$this->t['equal_height']			= $this->t['p']->get( 'equal_height', 0 );
		$this->t['image_width']				= $this->t['p']->get( 'image_width', '' );
		$this->t['image_height']			= $this->t['p']->get( 'image_height', '' );
		$this->t['image_link']				= $this->t['p']->get( 'image_link', 0 );
		$this->t['columns_cat']				= $this->t['p']->get( 'columns_cat', 3 );
		$this->t['enable_social']			= $this->t['p']->get( 'enable_social', 0 );
		$this->t['display_subcat_cat_view']	= $this->t['p']->get( 'display_subcat_cat_view', 5 );
		$this->t['display_back']			= $this->t['p']->get( 'display_back', 3 );
		$this->t['display_cat_name_title'] 	= $this->t['p']->get('display_cat_name_title', 0);
		
		JHTML::stylesheet('media/com_phocaphoto/css/style.css' );
		if ($this->t['load_bootstrap'] == 1) {
			JHTML::stylesheet('media/com_phocaphoto/bootstrap/css/bootstrap.min.css' );
			$document->addScript(JURI::root(true).'/media/com_phocaphoto/bootstrap/js/bootstrap.min.js');
		}
		JHtml::_('jquery.framework', false);
		if ($this->t['equal_height'] == 1) {
			
			$document->addScript(JURI::root(true).'/media/com_phocaphoto/js/jquery.equalheights.min.js');
		
			$document->addScriptDeclaration(
			'jQuery(document).ready(function(){
				jQuery(\'.ph-thumbnail\').equalHeights();
			});');
		}
		
		JHTML::stylesheet( 'media/com_phocaphoto/js/prettyphoto/css/prettyPhoto.css' );
		$document->addScript(JURI::root(true).'/media/com_phocaphoto/js/prettyphoto/js/jquery.prettyPhoto.js');
		
		$js = "\n". 'jQuery(document).ready(function(){
			jQuery("a[rel^=\'prettyPhoto\']").prettyPhoto({'."\n";
		if ($this->t['enable_social'] == 0) {
			$js .= '  social_tools: '.(int)$this->t['enable_social'].''."\n";
		}		
		$js .= '  });
		});'."\n";

		$document->addScriptDeclaration($js);

		if (isset($this->category[0]) && is_object($this->category[0])){
			$this->_prepareDocument($this->category[0]);
		}
		
		$this->t['path'] = PhocaPhotoHelper::getPath();

		parent::display($tpl);
		
	}
	
	protected function _prepareDocument($category) {
		
		$app		= JFactory::getApplication();
		$menus		= $app->getMenu();
		$pathway 	= $app->getPathway();
		//$this->t['p']		= &$app->getParams();
		$title 		= null;
		
		$this->t['photo_metakey'] 		= $this->t['p']->get( 'photo_metakey', '' );
		$this->t['photo_metadesc'] 		= $this->t['p']->get( 'photo_metadesc', '' );
		

		$menu = $menus->getActive();
		if ($menu) {
			$this->t['p']->def('page_heading', $this->t['p']->get('page_title', $menu->title));
		} else {
			$this->t['p']->def('page_heading', JText::_('JGLOBAL_ARTICLES'));
		}

		/*
		$title = $this->t['p']->get('page_title', '');
		
		if (empty($title) || (isset($title) && $title == '')) {
			$title = $this->item->title;
		}
		
		if (empty($title) || (isset($title) && $title == '')) {
			$title = htmlspecialchars_decode($app->getCfg('sitename'));
		} else if ($app->getCfg('sitename_pagetitles', 0)) {
			$title = JText::sprintf('JPAGETITLE', htmlspecialchars_decode($app->getCfg('sitename')), $title);
		}
		//$this->document->setTitle($title);

		
		$this->document->setTitle($title);*/
		
		  // get page title
          $title = $this->t['p']->get('page_title', '');
          // if no page title is set take the category title only
          if (empty($title)) {
             $title = $category->title;
          }
          // else append the category title
          else {
              $title .= " - " . $category->title;
          }
          // if still is no title is set take the sitename only
          if (empty($title)) {
             $title = $app->getCfg('sitename');
          }
          // else add the title before or after the sitename
          elseif ($app->getCfg('sitename_pagetitles', 0) == 1) {
             $title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
          }
          elseif ($app->getCfg('sitename_pagetitles', 0) == 2) {
             $title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
          }
          $this->document->setTitle($title);

		
		if ($category->metadesc != '') {
			$this->document->setDescription($category->metadesc);
		} else if ($this->t['photo_metadesc'] != '') {
			$this->document->setDescription($this->t['photo_metadesc']);
		} else if ($this->t['p']->get('menu-meta_description', '')) {
			$this->document->setDescription($this->t['p']->get('menu-meta_description', ''));
		} 

		if ($category->metakey != '') {
			$this->document->setMetadata('keywords', $category->metakey);
		} else if ($this->t['photo_metakey'] != '') {
			$this->document->setMetadata('keywords', $this->t['photo_metakey']);
		} else if ($this->t['p']->get('menu-meta_keywords', '')) {
			$this->document->setMetadata('keywords', $this->t['p']->get('menu-meta_keywords', ''));
		}

		if ($app->getCfg('MetaTitle') == '1' && $this->t['p']->get('menupage_title', '')) {
			$this->document->setMetaData('title', $this->t['p']->get('page_title', ''));
		}
		
		// Breadcrumbs TODO (Add the whole tree)
		/*$pathway 		= $app->getPathway();
		if (isset($this->category[0]->parentid)) {
			if ($this->category[0]->parentid == 0) {
				// $pathway->addItem( JText::_('COM_PHOCAPHOTO_CATEGORIES'), JRoute::_(PhocaPhotoRoute::getCategoriesRoute()));
			} else if ($this->category[0]->parentid > 0) {
				$pathway->addItem($this->category[0]->parenttitle, JRoute::_(PhocaPhotoRoute::getCategoryRoute($this->category[0]->parentid, $this->category[0]->parentalias)));
			}
		}

		if (!empty($this->category[0]->title)) {
			$pathway->addItem($this->category[0]->title);
		}*/
		
		// Breadcrumbs TODO (Add the whole tree)
		$pathway 		= $app->getPathway();
		if (isset($this->category[0]->parentid)) {
			if ($this->category[0]->parentid == 0) {
				// $pathway->addItem( JText::_('COM_PHOCAPHOTO_CATEGORIES'), JRoute::_(PhocaPhotoRoute::getCategoriesRoute()));
			} else if ($this->category[0]->parentid > 0) {
				$curpath = $pathway->getPathwayNames();
				if($this->category[0]->parenttitle != $curpath[count($curpath)-1]){
				 	$pathway->addItem($this->category[0]->parenttitle, JRoute::_(PhocaPhotoRoute::getCategoryRoute($this->category[0]->parentid, $this->category[0]->parentalias)));
				}
			}
		}

		if (!empty($this->category[0]->title)) {
			$curpath = $pathway->getPathwayNames();
			if($this->category[0]->title != $curpath[count($curpath)-1]){
				$pathway->addItem($this->category[0]->title);
			}
		}

	}
}
?>