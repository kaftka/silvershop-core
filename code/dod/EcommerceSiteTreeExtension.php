<?php


class EcommerceSiteTreeExtension extends DataObjectDecorator {

	function MenuTitleEcommerce() {
		$v = $this->owner->MenuTitle;
		if($this->owner instance CheckoutPage) {
			$count = 0;
			$cart = ShoppingCart::current_order();
			if($cart) {
				if($cart = $this->Cart()) {
					if($items = $cart->Items()) {
						$count = $items->count();
					}
				}
			}
			if($count) {
				$v .= " (".$count.")";
			}
		}
		return $v;
	}

}

class EcommerceSiteTreeExtension_Controller extends Extension {


	function addAjaxCart() {
		Requirements::themedCSS("EcommerceCart");
		Requirements::javascript(THIRDPARTY_DIR."/jquery/jquery.js");
		Requirements::javascript("ecommerce_xtras/javascript/AjaxCart.js");
	}

	function SimpleCartLinkAjax() {
		return ShoppingCart::get_url_segment()."/showcart/";
	}

	public function NumItemsInCart() {
		$cart = ShoppingCart::current_order();
		if($cart) {
			if($cart = $this->Cart()) {
				if($items = $cart->Items()) {
					return $items->count();
				}
			}
		return 0;
	}

	public function MoreThanOneItemInCart() {
		return $this->NumItemsInCart() > 1;
	}

	public function SubTotalCartValue() {
		$order = ShoppingCart::current_order();
		return $order->SubTotal;
	}

	public function AccountPageLink() {
		return AccountPage::find_link();
	}

	public function CheckoutLink() {
		return CheckoutPage::find_link();
	}

}