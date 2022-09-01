{$meta_title = $btr->sm__filter_in_breadcrumb__title|escape scope=global}

{*Название страницы*}
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="wrap_heading">
            <div class="box_heading heading_page">
                {$btr->sm__filter_in_breadcrumb__title|escape}
            </div>
        </div>
    </div>
</div>

<div class="alert alert--icon">
    <div class="alert__content">
        <div class="alert__title">{$btr->general_module_description}</div>
        <p>{$btr->sm__filter_in_breadcrumb__description_1}</p>
        <p>{$btr->sm__filter_in_breadcrumb__description_2}</p>
    </div>
</div>

<div class="row">
    <div class="col-xs-8">
        <div class="alert alert--icon alert--info">
            <div class="alert__content">
                <div class="alert__title">{$btr->general_module_instruction}</div>
                <p>{$btr->sm__filter_in_breadcrumb__description_install}</p>
                <div style="margin: 10px 0;">
                    <a style="display: inline-block;vertical-align: middle;margin: 0 10px 10px 0;" href="{$rootUrl}/Okay/Modules/SimplaMarket/FilterInBreadcrumb/Backend/design/images/breadcrumbs.png">
                        <img style="max-height: 120px" src="{$rootUrl}/Okay/Modules/SimplaMarket/FilterInBreadcrumb/Backend/design/images/breadcrumbs.png">
                    </a>
                    <a style="display: inline-block;vertical-align: middle;margin: 0 10px 10px 0;" href="{$rootUrl}/Okay/Modules/SimplaMarket/FilterInBreadcrumb/Backend/design/images/breadcrumbs_front.png">
                        <img style="max-height: 120px" src="{$rootUrl}/Okay/Modules/SimplaMarket/FilterInBreadcrumb/Backend/design/images/breadcrumbs_front.png">
                    </a>
                </div>
                <h3>{$btr->general_module_code|escape}:  <a href="" class="fn_clipboard hint-bottom-middle-t-info-s-small-mobile" data-hint="Click to copy" data-hint-copied="✔ Copied to clipboard">{literal}{filter_breadcrumb category=$category level=$level}{/literal}</a>
                </h3>
            </div>
        </div>
    </div>
    <div class="col-xs-4">
        <div class="alert alert--icon alert--warning">
            <div class="alert__content">
                <div class="alert__title">{$btr->general_module_notice}</div>
                <p>{$btr->sm__filter_in_breadcrumb__description_notice}</p>
            </div>
        </div>
    </div>
</div>


<script>
    sclipboard();
</script>