<!-- Cart informer (given by Ajax) -->
{* If you want to display the total price- uncomment the code*}
{if $cart->isEmpty === false}
    <a href="{url_generator route='cart'}" class="header_informers__link d-flex align-items-center">
        {include file="svg.tpl" svgId="cart_icon"}
        <span class="cart_counter">{$cart->total_products}</span>
        {*<span class="cart_title" data-language="index_cart">{$lang->index_cart}</span>
         <span class="cart_total">{($cart->total_price)|convert} {$currency->sign|escape}</span>*}
    </a>
{else}
    <div class="header_informers__link d-flex align-items-center">
        {include file="svg.tpl" svgId="cart_icon"}
        <span class="cart_counter">{$cart->total_products}</span>
        {*<span class="cart_total">{($cart->total_price)|convert} {$currency->sign|escape}</span>*}
    </div>
{/if}
