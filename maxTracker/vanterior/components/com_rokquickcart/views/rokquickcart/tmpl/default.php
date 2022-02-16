<?php
/**
 * @version   $Id: default.php 19349 2014-03-01 01:38:52Z djamil $
 * @author    RocketTheme, LLC http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
?>
<div class="cart_quickcart cart_columns_<?php echo $this->cols; ?>" data-rqc-columns="<?php echo $this->cols; ?>">
	<?php if ($this->checkout_mode == 'sandbox'):?><div class="alert alert-warning"><?php echo JText::_('ROKQUICKCART_WARN_SANDBOX_MODE')?></div><?php endif;?>

	<div class="cart_cartstatus">
		<a href="<?php echo $this->current_url . '#rokquickcart';?>"><?php echo JText::_('ROKQUICKCART_YOUR_CART');?>: <span class="simpleCart_quantity"></span> <?php echo JText::_('ROKQUICKCART_ITEMS');?></a>
	</div>

	<h2><?php echo $this->page_title;?></h2>

	<div class="cart_products<?php echo $this->same_height ? ' cart_same_height': ''; ?>">
		<?php foreach ($this->items as $item): ?>
			<div class="simpleCart_shelfItem">
				<div class="cart_product_content">
					<h2 class="item_name"><?php echo $item->name;?></h2>
					<div class="cart_product_l">
						<?php if($this->use_rokbox):?>
						<a data-rokbox href="<?php echo $item->fullImage;?>"><?php endif; ?>
						<img src="<?php echo $item->shelfImage;?>" alt="<?php echo $item->name;?>" title="<?php echo $item->name;?>" class="item_image"/>
						<?php if($this->use_rokbox):?></a><?php endif; ?>
						<span class="item_price"><span class="cart_currency_symbol"><?php echo $this->currency_symbol;?></span><span class="cart_price"><?php echo $item->price;?></span></span>
					</div>
					<div class="cart_product_r">

						<p class="product_Description">
							<?php echo $item->description;?>
						</p>

						<?php if ($item->custom_fields): ?>
							<?php foreach($item->custom_fields as $field_type => $field_html): ?>
								<div class="cart_item-field">
									<span><?php echo $field_type; ?></span>
									<?php echo $field_html; ?>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>

						<?php if($this->shipping_per_item):?>
						<input class="item_shipping" value="<?php echo $item->shipping;?>" type="hidden">
						<?php endif;?>
						<input type="hidden" value="1" class="item_Quantity" />

						<div class="cart_product_add">
							<a href="<?php echo $this->current_url . '#rokquickcart';?>" class="item_add btn button btn-primary"><?php echo JText::_('ROKQUICKCART_ADD_TO_CART');?><span></span></a>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="clr"></div>
	<a id="rokquickcart"></a>

	<h2><?php echo JText::_('ROKQUICKCART_YOUR_CART');?>:
		(<span class="simpleCart_quantity"></span> <?php echo JText::_('ROKQUICKCART_ITEMS');?>)</h2>

	<div class="cart_yourcart">
		<div class="cart_yourcart_items">
			<div class="simpleCart_items">
			</div>
			<div class="cart_totals">
				<div class="cart_summary"><span class="cart_checkout_label"><?php echo JText::_('ROKQUICKCART_SUB_TOTAL');?>:</span> <span class="simpleCart_total"></span></div>
				<?php if($this->tax):?>
				<div class="cart_summary"><span class="cart_checkout_label"><?php echo JText::_('ROKQUICKCART_TAX');?>:</span> <span class="simpleCart_tax"></span>
				</div><?php endif;?>
				<?php if($this->shipping):?>
				<div class="cart_summary"><span class="cart_checkout_label"><?php echo JText::_('ROKQUICKCART_SHIPPING');?>:</span> <span class="simpleCart_shipping"></span>
				</div><?php endif;?>
				<div class="cart_summary cart_summary_total"><span class="cart_checkout_label"><?php echo JText::_('ROKQUICKCART_TOTAL');?>:</span> <span class="simpleCart_grandTotal"></span></div>
			</div>

			<div class="cart_buttons">
				<a href="javascript:;" class="simpleCart_empty btn button"><i class="icon-trash"></i> <?php echo JText::_('ROKQUICKCART_EMPTY_CART');?><span></span></a>
				<a href="javascript:;" class="simpleCart_checkout btn button btn-danger"><i class="icon-cart"></i> <?php echo JText::_('ROKQUICKCART_CHECKOUT');?><span></span></a>
			</div>
		</div>
	</div>
	<div class="clr"></div>
</div>
<?php if ($this->pagination->get('pages.total') > 1) : ?>
	<div class="pagination pagination_rokquickcart">
		<p class="counter">
			<?php echo $this->pagination->getPagesCounter(); ?>
		</p>
		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
<?php endif; ?>
