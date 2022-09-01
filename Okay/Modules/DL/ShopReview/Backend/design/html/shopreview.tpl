{if $ShopReview->id}
    {$meta_title = $ShopReview->name scope=global}
{else}
    {$meta_title = $btr->page_new scope=global}
{/if}

{*Название страницы*}
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="wrap_heading">
            <div class="box_heading heading_page">
                {if !$ShopReview->id}
                    {$btr->ShopReview_add|escape}
                {else}
                    {$ShopReview->name|escape}
                {/if}
            </div>
            
        </div>
    </div>
    <div class="col-md-12 col-lg-12 col-sm-12 float-xs-right"></div>
</div>

{*Вывод успешных сообщений*}
{if $message_success}
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="boxed boxed_success">
                <div class="heading_box">
                    {if $message_success == 'added'}
                        {$btr->ShopReview_added|escape}
                    {elseif $message_success == 'updated'}
                        {$btr->ShopReview_updated|escape}
                    {/if}
                    {if $smarty.get.return}
                        <a class="btn btn_return float-xs-right" href="{$smarty.get.return}">
                            {include file='svg_icon.tpl' svgId='return'}
                            <span>{$btr->general_back|escape}</span>
                        </a>
                    {/if}
                </div>
            </div>
        </div>
    </div>
{/if}

{*Главная форма страницы*}
<form method="post" enctype="multipart/form-data">
    <input type=hidden name="session_id" value="{$smarty.session.id}">
    <input type="hidden" name="lang_id" value="{$lang_id}" />

    <div class="row">
        <div class="col-xs-12 ">
            <div class="boxed match_matchHeight_true">
                {*Название элемента сайта*}
                <div class="row d_flex">
                    <div class="col-lg-10 col-md-9 col-sm-12">
                        <div class="heading_label">
                            {$btr->general_name|escape}
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="name" type="text" value="{$ShopReview->name|escape}"/>
                            <input name="id" type="hidden" value="{$ShopReview->id|escape}"/>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-12">
                        <div class="activity_of_switch">
                            <div class="activity_of_switch_item"> {* row block *}
                                <div class="okay_switch clearfix">
                                    <label class="switch_label">{$btr->general_enable|escape}</label>
                                    <label class="switch switch-default">
                                        <input class="switch-input" name="visible" value='1' type="checkbox" id="visible_checkbox" {if $ShopReview->visible}checked=""{/if}/>
                                        <span class="switch-label"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 ">
            <div class="boxed match_matchHeight_true">
                
                <div class="row d_flex">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="heading_label">
                            Рейтинг
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="rating" type="text" value="{$ShopReview->rating|escape}"/>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="heading_label">
                            Дата
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="date" type="text" value="{$ShopReview->date|escape}"/>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="heading_label">
                            Ссылка на отзыв (если есть)
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="link" type="text" value="{$ShopReview->link|escape}"/>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="heading_label">
                            Текст ссылки
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="from" type="text" value="{$ShopReview->from|escape}"/>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="boxed match fn_toggle_wrap tabs">
                <div class="heading_tabs">
                    <div class="tab_navigation">
                        <a href="#tab1" class="heading_box tab_navigation_link">{$btr->ShopReview_content|escape}</a>
                    </div>
                    <div class="toggle_arrow_wrap fn_toggle_card text-primary">
                        <a class="btn-minimize" href="javascript:;" ><i class="icon-arrow-down"></i></a>
                    </div>
                </div>
                <div class="toggle_body_wrap on fn_card">
                    <div class="tab_container">
                        <div id="tab1" class="tab">
                            <textarea name="content" id="fn_editor" class="editor_small">{$ShopReview->content|escape}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 mt-1">
                        <button type="submit" class="btn btn_small btn_blue float-md-right">
                            {include file='svg_icon.tpl' svgId='checked'}
                            <span>{$btr->general_apply|escape}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
{* Подключаем Tiny MCE *}
{include file='tinymce_init.tpl'}
