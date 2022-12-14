{* Title *}
{$meta_title = $menu->name scope=global}
<div class="row">
    <div class="col-lg-7 col-md-7">
        <div class="wrap_heading">
            <div class="box_heading heading_page">
                {$btr->metadata_pages_title|escape}
            </div>
            <div class="box_btn_heading">
                <a class="btn btn_small btn-info" href="{url controller="SimplaMarket.MetadataPages.MetadataPageAdmin"}">
                    {include file='svg_icon.tpl' svgId='plus'}
                    <span>{$btr->pages_add|escape}</span>
                </a>
            </div>
        </div>
    </div>
</div>


<div class="boxed fn_toggle_wrap">
    {if $metadata_pages}
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <form id="list_form" method="post" class="fn_form_list">
                    <input type="hidden" name="session_id" value="{$smarty.session.id}">

                    <div class="pages_wrap okay_list">
                        <div class="okay_list_head">
                            <div class="okay_list_heading okay_list_check">
                                <input class="hidden_check fn_check_all" type="checkbox" id="check_all_1" name="" value="" />
                                <label class="okay_ckeckbox" for="check_all_1"></label>
                            </div>
                            <div class="okay_list_heading okay_list_brands_name">{$btr->pages_name|escape}</div>
                            <div class="okay_list_heading okay_list_page_name"></div>
                            <div class="okay_list_heading okay_list_status"></div>
                            <div class="okay_list_heading okay_list_setting">{$btr->general_activities|escape}</div>
                            <div class="okay_list_heading okay_list_close"></div>
                        </div>

                        <div id="sortable" class="okay_list_body sortable">
                            {foreach $metadata_pages as $page}
                                <div class="fn_row okay_list_body_item">
                                    <div class="okay_list_row">
                                        <input type="hidden" name="positions[{$page->id}]" value="{$page->position}">

                                        <div class="okay_list_boding okay_list_check">
                                            <input class="hidden_check" type="checkbox" id="id_{$page->id}" name="check[]" value="{$page->id}"/>
                                            <label class="okay_ckeckbox" for="id_{$page->id}"></label>
                                        </div>

                                        <div class="okay_list_boding okay_list_brands_name">
                                            <a href="{url controller="SimplaMarket.MetadataPages.MetadataPageAdmin" id=$page->id return=$smarty.server.REQUEST_URI}">
                                                {$page->name|escape} ({$page->url|escape})
                                            </a>
                                        </div>

                                        <div class="okay_list_boding okay_list_page_name"></div>

                                        <div class="okay_list_setting okay_list_status"></div>

                                        <div class="okay_list_setting okay_list_pages_setting">
                                            {*open*}
                                            <a href="../{$lang_link}{$page->url|escape}" target="_blank" data-hint="?????????????????????? ???? ??????????" class="setting_icon setting_icon_open hint-bottom-middle-t-info-s-small-mobile  hint-anim">
                                                {include file='svg_icon.tpl' svgId='icon_desktop'}
                                            </a>
                                        </div>

                                        <div class="okay_list_boding okay_list_close">
                                            {*delete*}
                                            <button data-hint="{$btr->pages_delete|escape}" type="button" class="btn_close fn_remove hint-bottom-right-t-info-s-small-mobile  hint-anim" data-toggle="modal" data-target="#fn_action_modal" onclick="success_action($(this));">
                                                {include file='svg_icon.tpl' svgId='delete'}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            {/foreach}
                        </div>

                        <div class="okay_list_footer fn_action_block">
                            <div class="okay_list_foot_left">
                                <div class="okay_list_heading okay_list_check">
                                    <input class="hidden_check fn_check_all" type="checkbox" id="check_all_2" name="" value=""/>
                                    <label class="okay_ckeckbox" for="check_all_2"></label>
                                </div>
                                <div class="okay_list_option">
                                    <select name="action" class="selectpicker">
                                        <option value="delete">{$btr->general_delete|escape}</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn_small btn_blue">
                                {include file='svg_icon.tpl' svgId='checked'}
                                <span>{$btr->general_apply|escape}</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    {else}
        <div class="heading_box mt-1">
            <div class="text_grey">{$btr->pages_no|escape}</div>
        </div>
    {/if}
</div>