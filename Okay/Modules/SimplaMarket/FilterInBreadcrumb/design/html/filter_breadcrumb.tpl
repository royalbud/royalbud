{foreach from=$category->path item=cat}
    {if !$cat@last || $filter_breadcrumb}
        {if $cat->visible}
            <li itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem" class="d-inline-flex align-items-center breadcrumbs__item">
                <a itemprop="item" href="{url_generator route='category' url=$cat->url}">
                    <span itemprop="name">{$cat->name|escape}</span>
                </a>
                <meta itemprop="position" content="{$level_filter++}" />
            </li>
        {/if}
    {else}
        <li itemprop="itemListElement" itemscope
            itemtype="https://schema.org/ListItem" class="d-inline-flex align-items-center breadcrumbs__item">
            <span itemprop="name">{$cat->name|escape}</span>
            <meta itemprop="position" content="{$level_filter++}" />
        </li>
    {/if}
{/foreach}
{if $filter_breadcrumb}
    {foreach $filter_breadcrumb as $crumb}
        {if !$crumb@last}
            {$furl = {furl params=[$crumb->params, page=>null, absolute=>1]}}
            <li itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem" class="d-inline-flex align-items-center breadcrumbs__item">
                <a itemprop="item" href="{$furl}">
                    <span itemprop="name">{$crumb->name|escape}</span>
                </a>
                <meta itemprop="position" content="{$level_filter++}" />
            </li>
        {else}
            <li itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem" class="d-inline-flex align-items-center breadcrumbs__item">
                <span itemprop="name">{$crumb->name|escape}</span>
                <meta itemprop="position" content="{$level_filter++}" />
            </li>
        {/if}
    {/foreach}
{/if}