<?php
/**
 * @package     redSHOP
 * @subpackage  Views
 *
 * @copyright   Copyright (C) 2008 - 2012 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die('Restricted access');

require_once(JPATH_COMPONENT . DS . 'helpers' . DS . 'category.php');
class categoryViewcategory extends JViewLegacy
{
    public function display($tpl = null)
    {
        global $mainframe, $context;

        $context = 'category_id';
        // redshop template object
        $redTemplate = new Redtemplate();

        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_REDSHOP_CATEGORY'));
        jimport('joomla.html.pagination');

        JToolBarHelper::title(JText::_('COM_REDSHOP_CATEGORY_MANAGEMENT'), 'redshop_categories48');

        JToolBarHelper::addNewX();
        JToolBarHelper::editListX();
        JToolBarHelper::customX('copy', 'copy.png', 'copy_f2.png', 'Copy', true);
        JToolBarHelper::deleteList();
        JToolBarHelper::publishList();
        JToolBarHelper::unpublishList();

        $uri = JFactory::getURI();

        $filter_order     = $mainframe->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'c.ordering');
        $filter_order_Dir = $mainframe->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', '');

        $lists['order']     = $filter_order;
        $lists['order_Dir'] = $filter_order_Dir;

        $GLOBALS['catlist'] = array();
        $categories         = $this->get('Data');

        $pagination           = $this->get('Pagination');
        $category_main_filter = $mainframe->getUserStateFromRequest($context . 'category_main_filter', 'category_main_filter', '');
        $optionsection        = array();
        $optionsection[]      = JHTML::_('select.option', '0', JText::_('COM_REDSHOP_SELECT'));
        $category_id          = $mainframe->getUserStateFromRequest($context . 'category_id', 'category_id', '');

        $category          = new product_category();
        $categories_parent = $category->getParentCategories();

        $temps                   = array();
        $temps[0]                = new stdClass;
        $temps[0]->category_id   = "0";
        $temps[0]->category_name = JText::_('COM_REDSHOP_SELECT');
        $categories_parent       = @array_merge($temps, $categories_parent);

        $lists['category'] = JHTML::_('select.genericlist', $categories_parent, 'category_id', 'class="inputbox" onchange="document.adminForm.submit();"      ', 'category_id', 'category_name', $category_id);

        /*
          * assign template
          */
        $templates               = $redTemplate->getTemplate('category');
        $temps                   = array();
        $temps[0]                = new stdClass;
        $temps[0]->template_id   = "0";
        $temps[0]->template_name = JText::_('COM_REDSHOP_ASSIGN_TEMPLATE');
        $templates               = @array_merge($temps, $templates);

        $lists['category_template'] = JHTML::_('select.genericlist', $templates, 'category_template', 'class="inputbox" size="1"  onchange="return AssignTemplate()" ', 'template_id', 'template_name', 0);

        // End

        $this->assignRef('category_main_filter', $category_main_filter);
        $this->user = JFactory::getUser();
        $this->assignRef('lists', $lists);
        $this->assignRef('categories', $categories);
        $this->assignRef('pagination', $pagination);
        $this->request_url = $uri->toString();

        parent::display($tpl);
    }
}
