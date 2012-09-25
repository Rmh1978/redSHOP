<?php
/**
 * @package     redSHOP
 * @subpackage  Views
 *
 * @copyright   Copyright (C) 2008 - 2012 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die('Restricted access');

class producttags_detailVIEWproducttags_detail extends JViewLegacy
{
    public function display($tpl = null)
    {
        JToolBarHelper::title(JText::_('COM_REDSHOP_TAGS_MANAGEMENT_DETAIL'), 'redshop_textlibrary48');

        $uri = JFactory::getURI();

        $this->setLayout('default');

        $lists = array();

        $detail = $this->get('data');

        $isNew = ($detail->tags_id < 1);

        $text = $isNew ? JText::_('COM_REDSHOP_NEW') : JText::_('COM_REDSHOP_EDIT');

        JToolBarHelper::title(JText::_('COM_REDSHOP_TAGS') . ': <small><small>[ ' . $text . ' ]</small></small>', 'redshop_textlibrary48');

        JToolBarHelper::save();

        if ($isNew)
        {
            JToolBarHelper::cancel();
        }
        else
        {

            JToolBarHelper::cancel('cancel', 'Close');
        }

        $lists['published'] = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $detail->published);

        $this->assignRef('lists', $lists);
        $this->assignRef('detail', $detail);
        $this->request_url = $uri->toString();

        parent::display($tpl);
    }
}
