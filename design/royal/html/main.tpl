{* The main page template *}
{* The canonical address of the page *}
{$canonical="{url_generator route="main" absolute=1}" scope=global}


<div class="main-about container">
    <h1 class="main-h1">{$h1}</h1>
    <div class="about-description">{$description}</div>

    <div class="main-benefits row">
        <div class="item col-lg-3">
            <img src="{$rootUrl}/design/royal/images/delivery.jpg" alt="">
            <span data-language="main_benefit_1">{$lang->main_benefit_1}</span>
        </div>
        <div class="item col-lg-3">
            <img src="{$rootUrl}/design/royal/images/visitor.jpg" alt="">
            <span data-language="main_benefit_2">{$lang->main_benefit_2}</span>
        </div>
        <div class="item col-lg-3">
            <img src="{$rootUrl}/design/royal/images/calculator.jpg" alt="">
            <span data-language="main_benefit_3">{$lang->main_benefit_3}</span>
        </div>
        <div class="item col-lg-3">
            <img src="{$rootUrl}/design/royal/images/delivery-truck.jpg" alt="">
            <span data-language="main_benefit_4">{$lang->main_benefit_4}</span>
        </div>
    </div>
</div>

{* Discount products *}
{get_discounted_products var=discounted_products limit=5}
{if $discounted_products}
    <div class="main-products main-products__new container">
        <div class="block block--boxed main-block">
            <div class="block__header block__header--promo">
                <div class="block__title main-title" data-language="main_discount_products">{$lang->main_discount_products}
                </div>
                
            </div>
            <div class="block__body">
                <div class="fn_products_slide products_list row no_gutters owl-carousel">
                    {foreach $discounted_products as $product}
                        <div class="product_item no_hover">{include "product_list.tpl"}</div>
                    {/foreach}
                </div>
            </div>
        </div>
    </div>
{/if}

{* Featured products *}
{get_featured_products var=featured_products limit=5}
{if $featured_products}
    <div class="main-products main-products__featured container">
        <div class="block block--boxed main-block">
            <div class="block__header block__header--promo">
                <div class="block__title main-title" data-language="main_recommended_products">{$lang->main_recommended_products}
                </div>
                
            </div>
            <div class="block__body">
                <div class="fn_products_slide products_list row no_gutters owl-carousel">
                    {foreach $featured_products as $product}
                        <div class="item product_item no_hover">{include "product_list.tpl"}</div>
                    {/foreach}
                </div>
            </div>
        </div>
    </div>
{/if}

{* New products *}
{get_new_products var=new_products limit=5}
{if $new_products}
    <div class="main-products main-products__new container">
        <div class="block block--boxed main-block">
            <div class="block__header">
                <div class="block__title main-title" data-language="main_new_products">{$lang->main_new_products}</div>
            </div>
            <div class="block__body">
                <div class="fn_products_slide products_list row no_gutters owl-carousel">
                    {foreach $new_products as $product}
                        <div class="product_item no_hover">{include "product_list.tpl"}</div>
                    {/foreach}
                </div>
            </div>
         </div>
    </div>
{/if}

{* Last_posts *}
{get_posts var=last_posts limit=4 type_post="blog"}
{if $last_posts}


<div class="main-blog container-fluid">

    <div class="row">
        <div class="col-lg-6">
            <div class="main-blog--images-slider banner_group owl-carousel">
                {foreach $last_posts as $post}
                    {if $post->image}
                        <div class="main-blog--images-slider--item">
                            <img class="lazy" data-src="{$post->image|resize:960:575:false:$config->resized_blog_dir:center:center}" alt="{$post->name|escape}" title="{$post->name|escape}"/>
                        </div>
                        
                    {/if}
                {/foreach}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="main-blog--content-slider banner_group owl-carousel">

                {foreach $last_posts as $post}
                    <div class="main-blog--content-slider-item">
                        <div class="main-blog--content-slider--title">{$post->name|escape}</div>
                        <div class="main-blog--content-slider--content">{$post->annotation}</div>
                        <a href="{url_generator route='post' url=$post->url}" class="main-blog--content-slider--readmore">{$lang->main_article_read}</a>
                    </div>
                {/foreach}
            </div>
        </div>
    </div> 

</div>

<script>

    document.addEventListener('DOMContentLoaded', function(){

        var sync1 = $(".main-blog--images-slider");
        var sync2 = $(".main-blog--content-slider");
        var syncedSecondary = true;


        sync1.owlCarousel({
            items: 1,
            slideSpeed: 5400,
            nav: true,
            autoplay: true, 
            dots: false,
            loop: true,
            mouseDrag : 0,
            touchDrag : 0
        }).on('changed.owl.carousel', syncPosition);

        sync2
            .on('initialized.owl.carousel', function() {
                sync2.find(".owl-item").eq(0).addClass("current");
            })
            .owlCarousel({
                items: 1,
                dots: true,
                nav: false,
                smartSpeed: 200,
                slideSpeed: 500,
                mouseDrag : 0,
                touchDrag : 0
            }).on('changed.owl.carousel', syncPosition2);

        $('.owl-dot, .owl-prev, .owl-next').on('click', function(e) {
            $(".main-blog--images-slider").trigger('stop.owl.autoplay');
        });

        function syncPosition(el) {
            //if you set loop to false, you have to restore this next line
            //var current = el.item.index;

            //if you disable loop you have to comment this block
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - (el.item.count / 2) - .5);

            if (current < 0) {
                current = count;
            }
            if (current > count) {
                current = 0;
            }

            //end block

            sync2
                .find(".owl-item")
                .removeClass("current")
                .eq(current)
                .addClass("current");
            var onscreen = sync2.find('.owl-item.active').length - 1;
            var start = sync2.find('.owl-item.active').first().index();
            var end = sync2.find('.owl-item.active').last().index();

            if (current > end) {
                sync2.data('owl.carousel').to(current, 100, true);
            }
            if (current < start) {
                sync2.data('owl.carousel').to(current - onscreen, 100, true);
            }
        }

        function syncPosition2(el) {
            if (syncedSecondary) {
                var number = el.item.index;
                sync1.data('owl.carousel').to(number, 100, true);
            }
        }

        sync2.on("click", ".owl-item", function(e) {
            // e.preventDefault();
            var number = $(this).index();
            sync1.data('owl.carousel').to(number, 300, true);
        });
        
    });

</script>

{/if}


{get_brands var=all_brands visible_brand=1 limit=40}
{if $all_brands}
    <div class="container section_brands block--boxed">

        <div class="block__header block__header--promo">
            <div class="block__title main-title" data-language="main_brands">{$lang->main_brands}</div>
        </div>
            <div class="f_row main_brands owl-carousel">
                {foreach $all_brands as $b}
                    <a class="d-flex align-items-center justify-content-center main_brands__link" aria-label="{$b->name|escape}" href="{url_generator route='brand' url=$b->url}" data-brand="{$b->id}">
                        {if $b->image}
                            <div class="d-flex align-items-center justify-content-center main_brands__image">
                                <img class="main_brands_img lazy" data-src="{$b->image|resize:150:100:false:$config->resized_brands_dir}" alt="{$b->name|escape}" title="{$b->name|escape}">
                            </div>
                        {else}
                            <div class="d-flex align-items-center justify-content-center main_brands__name">
                                <span>{$b->name|escape}</span>
                            </div>
                        {/if}
                    </a>
                {/foreach}
            </div>

            <script>

                document.addEventListener('DOMContentLoaded', function(){
                    $('.main_brands').owlCarousel({
                        loop:true,
                        margin:10,
                        nav:true,
                        responsive:{
                            0:{
                                items:1
                            },
                            600:{
                                items:3
                            },
                            1000:{
                                items:5
                            }
                        }
                    })
                });
            </script>

    </div>
{/if}


<div class="main-reviews container block--boxed">

    <div class="block__header block__header--promo">
        <div class="block__title main-title" data-language="main_reviews">{$lang->main_reviews}</div>
    </div>

    <div class="main-reviews-row row">

        <div class="review-item">
            <div class="review-item--header">
                <div class="review-item--header--name" data-language="main_reviews_1_name">{$lang->main_reviews_1_name}</div>
                <div class="review-item--header--rating">
                    <span class="rating_starOff">
                        <span class="rating_starOn" style="width:90px;"></span>{*$product->rating*90/5|string_format:'%.0f'*}
                    </span>
                </div>
                <div class="review-item--header--date" data-language="main_reviews_1_date">{$lang->main_reviews_1_date}</div>
            </div>
            <div class="review-item--content" data-language="main_reviews_1_text">{$lang->main_reviews_1_text}</div>
        </div>

        <div class="review-item">
            <div class="review-item--header">
                <div class="review-item--header--name" data-language="main_reviews_2_name">{$lang->main_reviews_2_name}</div>
                <div class="review-item--header--rating">
                    <span class="rating_starOff">
                        <span class="rating_starOn" style="width:90px;"></span>{*$product->rating*90/5|string_format:'%.0f'*}
                    </span>
                </div>
                <div class="review-item--header--date" data-language="main_reviews_2_date">{$lang->main_reviews_2_date}</div>
            </div>
            <div class="review-item--content" data-language="main_reviews_2_text">{$lang->main_reviews_2_text}</div>
        </div>

        <div class="review-item">
            <div class="review-item--header">
                <div class="review-item--header--name" data-language="main_reviews_3_name">{$lang->main_reviews_3_name}</div>
                <div class="review-item--header--rating">
                    <span class="rating_starOff">
                        <span class="rating_starOn" style="width:90px;"></span>{*$product->rating*90/5|string_format:'%.0f'*}
                    </span>
                </div>
                <div class="review-item--header--date" data-language="main_reviews_3_date">{$lang->main_reviews_3_date}</div>
            </div>
            <div class="review-item--content" data-language="main_reviews_3_text">{$lang->main_reviews_3_text}</div>
        </div>

        <div class="review-item">
            <div class="review-item--header">
                <div class="review-item--header--name" data-language="main_reviews_4_name">{$lang->main_reviews_4_name}</div>
                <div class="review-item--header--rating">
                    <span class="rating_starOff">
                        <span class="rating_starOn" style="width:90px;"></span>{*$product->rating*90/5|string_format:'%.0f'*}
                    </span>
                </div>
                <div class="review-item--header--date" data-language="main_reviews_4_date">{$lang->main_reviews_4_date}</div>
            </div>
            <div class="review-item--content" data-language="main_reviews_4_text">{$lang->main_reviews_4_text}</div>
        </div>

        <div class="review-item">
            <div class="review-item--header">
                <div class="review-item--header--name" data-language="main_reviews_5_name">{$lang->main_reviews_5_name}</div>
                <div class="review-item--header--rating">
                    <span class="rating_starOff">
                        <span class="rating_starOn" style="width:90px;"></span>{*$product->rating*90/5|string_format:'%.0f'*}
                    </span>
                </div>
                <div class="review-item--header--date" data-language="main_reviews_5_date">{$lang->main_reviews_5_date}</div>
            </div>
            <div class="review-item--content" data-language="main_reviews_5_text">{$lang->main_reviews_5_text}</div>
        </div>

        <div class="review-item">
            <div class="review-item--header">
                <div class="review-item--header--name" data-language="main_reviews_6_name">{$lang->main_reviews_6_name}</div>
                <div class="review-item--header--rating">
                    <span class="rating_starOff">
                        <span class="rating_starOn" style="width:90px;"></span>{*$product->rating*90/5|string_format:'%.0f'*}
                    </span>
                </div>
                <div class="review-item--header--date" data-language="main_reviews_6_date">{$lang->main_reviews_6_date}</div>
            </div>
            <div class="review-item--content" data-language="main_reviews_6_text">{$lang->main_reviews_6_text}</div>
        </div>
        
    </div>
</div>

