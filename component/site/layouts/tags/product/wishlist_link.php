<?php
/**
 * @package     RedSHOP.Frontend
 * @subpackage  Template
 *
 * @copyright   Copyright (C) 2008 - 2016 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

/**
 * $displayData extract
 *
 * @param   int     $link       Link
 * @param   int     $productId  Product id
 * @param   string  $formId     Form id
 */
extract($displayData);

$user = JFactory::getUser();
?>
<?php if (!$user->guest) :?>
	<a class="redshop-wishlist-link" href="<?php echo $link ?>" data-productid="<?php echo $productId ?>" data-formid="<?php echo $formId ?>">
		<?php echo JText::_("COM_REDSHOP_ADD_TO_WISHLIST") ?>
	</a>
<?php else : ?>
	<?php if (Redshop::getConfig()->get('WISHLIST_LOGIN_REQUIRED') != 0) :?>
		<a class="redshop-wishlist-link-login" href="<?php echo $link ?>">
			<?php echo JText::_("COM_REDSHOP_ADD_TO_WISHLIST") ?>
		</a>
	<?php else : ?>
		<form method="post" action="" id="form_wishlist_<?php echo $productId ?>_link" name="form_wishlist_<?php echo $productId ?>_link">
				<input type='hidden' name='task' value='addtowishlist' />
				<input type='hidden' name='product_id' value='<?php echo $productId ?>' />
				<input type='hidden' name='view' value='product' />
				<input type='hidden' name='attribute_id' value='' />
				<input type='hidden' name='property_id' value='' />
				<input type='hidden' name='subattribute_id' value='' />
				<input type='hidden' name='rurl' value='<?php echo base64_encode(JUri::getInstance()->toString()) ?>' />
				<a href="javascript:void(0);" data-productid="<?php echo $productId ?>" data-formid="<?php echo $formId ?>"
					class="redshop-wishlist-form-link" data-target="form_wishlist_<?php echo $productId ?>_link">
					<?php echo JText::_("COM_REDSHOP_ADD_TO_WISHLIST") ?>
				</a>
		</form>
	<?php endif; ?>
<?php endif; ?>