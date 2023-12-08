<!DOCTYPE html>
<html style="width: 100%; height: 100%;">
<head>
    <title><?php if (isset($navigationItem)) { echo 'SNS : '.$navigationItem; }else{ echo 'SNS'; }?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="<?php echo ROOT ?>css/jquery.fancybox.css" rel="stylesheet" />
    <script src="<?php echo ROOT ?>js/jquery.min.js"></script>
    <script src="<?php echo ROOT ?>js/jquery.fancybox.js"></script>
    <link href="<?php echo ROOT ?>css/kendo.common.min.css" rel="stylesheet" />
    <link href="<?php echo ROOT ?>css/kendo.default.min.css" rel="stylesheet" />
    <link href="<?php echo ROOT ?>css/styles.css" rel="stylesheet" />
    <script src="<?php echo ROOT ?>js/kendo.all.min.js"></script>
    <script src="<?php echo ROOT ?>js/fileuploader.js"></script>
    <script src="<?php echo ROOT ?>js/ru.js"></script>

</head>
<body>

    <div id="preloader">
    </div>

    <div style="width: 100%;z-index: 800;position: fixed;top: 0;background-color: #ffffff;">
    <ul id="menu">
        <li>
            <?php echo $Lang->open;?>
            <ul id="openMenu">
                <div id="dicMenu_first">
                    <a href="<?php echo ROOT ;?>open/bibliography"><li><?php echo $Lang->bibliography;?></li></a>
                    <a href="<?php echo ROOT ;?>open/man"><li><?php echo $Lang->face;?></li></a>
                    <a href="<?php echo ROOT ;?>open/external_signs"><li><?php echo $Lang->external_signs;?></li></a>
                    <a href="<?php echo ROOT ;?>open/phone"><li><?php echo $Lang->telephone;?></li></a>
                    <a href="<?php echo ROOT ;?>open/email"><li><?php echo $Lang->email;?></li></a>
                    <a href="<?php echo ROOT ;?>open/weapon"><li><?php echo $Lang->weapon;?></li></a>
                    <a href="<?php echo ROOT ;?>open/car"><li><?php echo $Lang->car;?></li></a>
                    <a href="<?php echo ROOT ;?>open/address"><li><?php echo $Lang->address;?></li></a>
                    <a href="<?php echo ROOT ;?>open/work_activity"><li><?php echo $Lang->work_activity;?></li></a>
                    <a href="<?php echo ROOT ;?>open/man_beann_country"><li><?php echo $Lang->man_bean_country;?></li></a>
                    <a href="<?php echo ROOT ;?>open/objects_relation"><li><?php echo $Lang->relationship_objects;?></li></a>
                    <a href="<?php echo ROOT ;?>open/action"><li><?php echo $Lang->action;?></li></a>
                    <a href="<?php echo ROOT ;?>open/event"><li><?php echo $Lang->event;?></li></a>
                    <a href="<?php echo ROOT ;?>open/signal"><li><?php echo $Lang->signal;?></li></a>
                    <a href="<?php echo ROOT ;?>open/organization"><li><?php echo $Lang->organization;?></li></a>
                    <a href="<?php echo ROOT ;?>open/keep_signal"><li><?php echo $Lang->keep_signal;?></li></a>
                    <a href="<?php echo ROOT ;?>open/criminal_case"><li><?php echo $Lang->criminal;?></li></a>
                    <a href="<?php echo ROOT ;?>open/control"><li><?php echo $Lang->control;?></li></a>
                    <a href="<?php echo ROOT ;?>open/mia_summary"><li><?php echo $Lang->mia_summary;?></li></a>
                </div>
            </ul>
        </li>
        <li>
            <?php echo $Lang->search;?>
            <ul>
                <li><a href="<?php echo ROOT ;?>simplesearch/simple_search"><?php echo $Lang->simple_search;?></a></li>
                <li><a href="<?php echo ROOT ;?>advancedsearch"><?php echo $Lang->complex_search;?></a></li>
                <li><a href="<?php echo ROOT; ?>templatesearch"><?php echo $Lang->template_search;?></a></li>
                <li><a href="<?php echo ROOT; ?>templatesearch/file_search"><?php echo $Lang->file_search;?></a></li>
                <li><a href="<?php echo ROOT; ?>templatesearch/report"><?php echo $Lang->report_search.' '.$Lang->sgq;?></a></li>
                <li><a href="<?php echo ROOT; ?>templatesearch/signal_report"><?php echo $Lang->report_search_signal;?></a></li>
            </ul>
        </li>
        <?php if($user_type != 3) { ?>
        <li>
            <?php echo $Lang->addTo;?>
            <ul id="addMenu">
                <li>
                    <a href="<?php echo ROOT ;?>bibliography/add"><?php echo $Lang->bibliography;?></a>
                </li>
                <!--li>
                    <a href="<?php echo ROOT ;?>add/man"><?php echo $Lang->face;?></a>
                </li>
                <li>
                    <a href="<?php echo ROOT ;?>add/external_signs"><?php echo $Lang->external_signs;?></a>
                </li>
                <li>
                    <a href="<?php echo ROOT ;?>add/phone"><?php echo $Lang->telephone;?></a>
                </li>
                <li>
                    <a href="<?php echo ROOT ;?>add/weapon"><?php echo $Lang->weapon;?></a>
                </li>
                <li>
                    <a href="<?php echo ROOT ;?>add/car"><?php echo $Lang->car;?></a>
                </li>
                <li>
                    <a href="<?php echo ROOT ;?>add/address"><?php echo $Lang->address;?></a>
                </li>
                <li>
                    <a href="<?php echo ROOT ;?>add/work_activity"><?php echo $Lang->work_activity;?></a>
                </li>
                <li>
                    <a href="<?php echo ROOT ;?>add/man_beann_country"><?php echo $Lang->man_bean_country;?></a>
                </li>
                <li>
                    <a href="<?php echo ROOT ;?>add/object"><?php echo $Lang->relationship_objects;?></a>
                </li>
                <li>
                    <a href="<?php echo ROOT ;?>add/action"><?php echo $Lang->action;?></a>
                </li>
                <li>
                    <a href="<?php echo ROOT ;?>add/event"><?php echo $Lang->event;?></a>
                </li>
                <li>
                    <a href="<?php echo ROOT ;?>add/signal"><?php echo $Lang->signal;?></a>
                </li>
                <li>
                    <a href="<?php echo ROOT ;?>add/organization"><?php echo $Lang->organization;?></a>
                </li>
                <li>
                    <a href="<?php echo ROOT ;?>add/keep_signal"><?php echo $Lang->keep_signal;?></a>
                </li>
                <li>
                    <a href="<?php echo ROOT ;?>add/criminal_case"><?php echo $Lang->criminal;?></a>
                </li>
                <li>
                    <a href="<?php echo ROOT ;?>add/control"><?php echo $Lang->control;?></a>
                </li>
                <li>
                    <a href="<?php echo ROOT ;?>add/essay"><?php echo $Lang->essay;?></a>
                </li>
                <li>
                    <a href="<?php echo ROOT ;?>add/mia_summary"><?php echo $Lang->mia_summary;?></a>
                </li-->
            </ul>
        </li>
        <?php } ?>
        <?php if($user_type == 1) { ?>
        <li><?php echo $Lang->dictionaries; ?>
                <ul>
                    <div id="dicMenu">
                        <a href="<?php echo ROOT;?>dictionary/agency"><li><?php echo $Lang->bodies_management;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/doc_category"><li><?php echo $Lang->document_category;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/access_level"><li><?php echo $Lang->access_level;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/gender"><li><?php echo $Lang->gender;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/nation"><li><?php echo $Lang->nationality;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/country"><li><?php echo $Lang->state_affiliation;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/country_ate"><li><?php echo $Lang->country_ate;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/language"><li><?php echo $Lang->languages;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/religion"><li><?php echo $Lang->worship;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/region"><li><?php echo $Lang->region_local;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/street"><li><?php echo $Lang->street_local;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/locality"><li><?php echo $Lang->locality_local;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/operation_category"><li><?php echo $Lang->operational_category;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/education"><li><?php echo $Lang->educat;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/party"><li><?php echo $Lang->party;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/relation_type"><li><?php echo $Lang->character_link;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/sign"><li><?php echo $Lang->signs;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/character"><li><?php echo $Lang->nature_character;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/car_category"><li><?php echo $Lang->car_category;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/car_mark"><li><?php echo $Lang->car_mark;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/goal"><li><?php echo $Lang->purpose_of_visit;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/action_goal"><li><?php echo $Lang->purpose_action;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/action_qualification"><li><?php echo $Lang->qualifications_fact;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/duration"><li><?php echo $Lang->duration_action;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/terms"><li><?php echo $Lang->terms_actions;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/aftermath"><li><?php echo $Lang->aftermath;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/event_qualification"><li><?php echo $Lang->qualification_event;?></li></a>
                        <!--a href="<?php echo ROOT;?>dictionary/worker"><li><?php echo $Lang->investigation_charged_worker;?></li></a-->
                        <a href="<?php echo ROOT;?>dictionary/worker_post"><li><?php echo $Lang->worker_post;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/organization_category"><li><?php echo $Lang->category_organization;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/signal_qualification"><li><?php echo $Lang->qualifications_signaling;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/resource"><li><?php echo $Lang->useful_capabilities;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/signal_result"><li><?php echo $Lang->test_results_signal;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/control_result"><li><?php echo $Lang->results_performance_control;?></li></a>
                        <a href="<?php echo ROOT;?>dictionary/taken_measure"><li><?php echo $Lang->measures_taken;?></li></a>
                    </div>
                </ul>
        </li>
        <li>
            <?php echo $Lang->type_admin;?>
            <ul>
                <li><a href="<?php echo ROOT ;?>admin/user_list"><?php echo $Lang->user_list;?></a></li>
                <li><a href="<?php echo ROOT ;?>admin/logging"><?php echo $Lang->logging;?></a></li>
                <li><a href="<?php echo ROOT ;?>admin/mysql_backup"><?php echo $Lang->mysql_backup;?></a></li>
                <li><a href="<?php echo ROOT ;?>admin/mysql_restore"><?php echo $Lang->mysql_import;?></a></li>
                <li><a href="<?php echo ROOT ;?>admin/optimization"><?php echo $Lang->optimization;?></a></li>
                <li><a href="<?php echo ROOT ;?>fusion/index"><?php echo $Lang->fusion;?></a></li>
            </ul>
        </li>
        <?php } ?>
        <li style="float:right;">
            <a href="<?php echo ROOT ?>sns/logout"><?php echo $Lang->exit;?></a>
        </li>

    </ul>


        <div id="navigation">
            <div style="float: right;">
                <a href="<?php echo ROOT;?>sns/change/arm" >
                   <img src="<?php echo ROOT;?>images/arm.png" width="30px" height="20px" style="float: right;margin: 10px 0; margin-right: 10px;" />
                </a>
                <a href="<?php echo ROOT;?>sns/change/rus">
                    <img src="<?php echo ROOT;?>images/rus.gif" width="30px" height="20px" style="float: right;margin: 10px 0; margin-right: 10px;" />
                </a>
                <span style="float: right;height: 40px;border-right: 1px solid #C5C5C5;margin-right: 10px;">
                    <?php echo $_SESSION['user_name']; ?>
                </span>
                <span style="float: right;width: 10px;height: 40px;border-right: 1px solid #C5C5C5;margin-right: 10px;">

                </span>
            </div>

            <ul>
                <?php if (isset($navigationItem)) { echo '<li>'.$navigationItem.'</li>'; } ?>
            </ul>
        </div>

    </div>

    <div id="content">
        <?php if (isset($navigationItem)) { ?>
            <div id="page1" class="otherDiv">
                <?php echo $_fd;?>
            </div>
        <?php } else { ?>
            <?php echo $_fd;?>
        <?php } ?>
    </div>

    <div class="openDataWindow"></div>

    <script type="text/javascript" >

        $('.k-button').hover(function(event) {
            window.lastElementClicked = event.target;
        });

        kendo.culture('ru-RU');
        var count = 0;
        var date_preg = /^(((((0[0-9])|(1\d)|(2[0-8]))-((0[0-9])|(1[0-2])))|((31-((0[13578])|(1[02])))|((29|30)-((0[1,3-9])|(1[0-2])))))-(([0-9][0-9][0-9][0-9]))|(29-02-20(([02468][048])|([13579][26]))))$/;

        <?php if (isset($navigationItem)) { ?>
            count = 1;
        <?php }  ?>

        $(document).ready(function() {

            check_session();

            $('.dotsToDash').live('paste', function () {
                var element = this;
                setTimeout(function () {
                    var text = $(element).val();
                    $(element).val(text.replace(/\./g,'-'));
                }, 100);
            });

//            $(".k-grid-pager").prependTo(".k-grid");

            $('.openData').live('click',function(e){
                e.preventDefault();
                var id = $(this).attr('data-id');
                var tb = $(this).attr('data-tb');
                var title = $(this).text();
                var aaa = $(".openDataWindow").kendoWindow({
                            title: " "+title+" ",
                            modal: false,
                            visible: false,
                            resizable: true,
                            actions: ["Minimize","Maximize", "Close"],
                            width: 600,
                            height: 450

                }).data("kendoWindow");
                $('.k-window-title').html(title);
                if( tb == 'phone'){
                    var other    = $(this).attr('data-from');
                    var other_id = $(this).attr('data-from_id');
                    if(typeof other != "undefined"){
                        aaa.refresh({ url: '<?php echo ROOT; ?>detail/'+tb+'/'+id+'&other='+other+'&other_id='+other_id });
                    }else{
                        aaa.refresh({ url: '<?php echo ROOT; ?>detail/'+tb+'/'+id });
                    }
                }else{
                    aaa.refresh({ url: '<?php echo ROOT; ?>detail/'+tb+'/'+id });
                }
                aaa.center().open();
            });

            $("#menu").kendoMenu({
                openOnClick: true
            });

            $('#content').css('margin-top',($('#menu').height()+60)+'px');

//            $('#addMenu li a').live('click',function(e){
//                while(count>0){
//                    $('#page'+count).remove();
//                    count--;
//                }
//                e.preventDefault();
//                var url = $(this).attr('href');
//                var text = $(this).text();
//                $.ajax({
//                    url: url,
//                    dataType: 'html',
//                    success: function(data){
//                        count++;
//                        $('#navigation ul').html('<li>'+text+'</li>');
//                        $('#content').html('<div id="page1" class="otherDiv"></div>');
//                        $('#page1').html(data);
//                    },
//                    faild: function(data){
//                        alert('<?php echo $Lang->err;?> ');
//                    }
//                });
//            });

            $('#dicMenu a').live('click',function(e){
                e.preventDefault();
                window.location = $(this).attr('href');
            });

            $('#dicMenu_first a').live('click',function(e){
                e.preventDefault();
                window.location = $(this).attr('href');
            });

            $('.closeButton').live('click',function(e){
                e.preventDefault();
                removeItem();
            });

            // for multi select in bibliography
            $('.newTable').live('click',function(e){
//            alert('aaaa');
                e.preventDefault();
//            $(this).removeClass('newTable');
                var dataId = $(this).attr('dataId');
                if(typeof dataId == 'undefined'){
                    dataId = 0;
                }
                $(this).addClass('activeTable');
                var url = $(this).attr('dataName');
                var text = $(this).text();
                $.ajax({
                    url: '<?php echo ROOT?>add/'+url+'/'+dataId,
                    dataType: 'html',
                    success: function(data){
                        addItem(data,text);
                    },
                    faild: function(data){
                        alert('<?php echo $Lang->err;?> ');
                    }
                });
            });

            $('.see_more_man').live('click',function(e){
                e.preventDefault();
                var counter = $(this).attr('counter');
                var tx = $(this).attr('act');
                if(tx == '+'){
                    $('.showAllMan'+counter).fadeIn();
                    $(this).attr('act','-');
                    $(this).html('<?php echo $Lang->hide; ?>');
                }else{
                    $('.hideAllMan'+counter).fadeOut();
                    $(this).attr('act','+');
                    $(this).html('<?php echo $Lang->show; ?>');
                }
            });

            $('.deleteMulti').live('click',function(e){
                e.preventDefault();
                var confirmRel = confirm('<?php echo $Lang->break_link; ?>');
                if(confirmRel){
                    var tbName = $(this).attr('dataName');
                    var data_id = $(this).prev().attr('dataid');
                    var tb = $(this).prev().attr('dataname');
                    var old_counter = $(this).attr('old_counter');
                    if( (tbName != 'man') && (tbName != 'organization') ){
                        $('#'+old_counter+tbName+'Option').show();
                    }
                    if(typeof data_id != 'undefined'){
                        $.ajax({
                            url: '<?php echo ROOT?>add/deleteJoins',
                            type: 'post',
                            data : { 'tb' : tb , 'other_id' :  data_id},
                            success: function(data){
                            },
                            faild: function(data){
                                alert('<?php echo $Lang->err;?> ');
                            }
                        });
                    }
                    $(this).parent().remove();
                }
            });

            $('.deleteFile').live('click',function(e){
                e.preventDefault();
                var tt = $(this);
                var confirmRel = confirm('<?php echo $Lang->are_you_sure.''.$Lang->file_delete;?>');
                if(confirmRel){
                    var id = $(this).attr('data-id');
                    $('#preloader').show();
                    $.ajax({
                        url: '<?php echo ROOT; ?>bibliography/deleteFile/'+id,
                        success:function(data){
                            $('#preloader').hide();
                            tt.parent().remove();
                        },
                        faild:function(data){
                            alert('error');
                        }
                    });
                }
            });

            $('.deleteFileMan').live('click',function(e){
                e.preventDefault();
                var tt = $(this);
                var confirmRel = confirm('<?php echo $Lang->are_you_sure;?>');
                if(confirmRel){
                    var id = $(this).attr('data-id');
                    $('#preloader').show();
                    $.ajax({
                        url: '<?php echo ROOT; ?>add/deleteFileMan/'+id,
                        success:function(data){
                            $('#preloader').hide();
                            tt.parent().remove();
                        },
                        faild:function(data){
                            alert('error');
                        }
                    });
                }
            });

            $('.forForm').live('focus',function(e){
                $(this).addClass('selectedDiv');
            });

            $('.forForm').live('focusout',function(e){
                $(this).removeClass('selectedDiv');
            });

            ////////////////////// edit keep signal from signal /////////////////////////////////////
            $('.kedit').live('click',function(e){
                e.preventDefault();
                var id = $(this).attr('data-id');
                $.ajax({
                    url: '<?php echo ROOT?>add/keep_signal/edit/'+id,
                    dataType: 'html',
                    success: function(data){
                        addItem(data,'<?php echo $Lang->keep_signal; ?>');
                    },
                    faild: function(data){
                        alert('<?php echo $Lang->err;?>');
                    }
                });
            });

            $('.editAll').live('click',function(e){
                e.preventDefault();
                var elem = $(this).prev();
                var text = elem.text();
                var id = elem.attr('data-id');
                var url = elem.attr('data-tb');
                var first = 'add';
                var tt = null;
                if(url == 'email' || url == 'work_activity' || url == 'object' ){
                    tt = 'edit';
                }
                if(url == 'address' || url == 'phone'){
                    tt = 'edit';
                    var other_tb = elem.attr('other_tb');
                    var other_id = elem.attr('other_id');
                    if (typeof other_tb != 'undefined'){
                        tt = other_tb;
                        id = id+'&other_id='+other_id;
                    }
                }
                if(url == 'bibliography'){
                    first = 'bibliography';
                    url = 'add';
                    tt = id;
                    id = 'null';
                }
                $.ajax({
                    url: '<?php echo ROOT?>'+first+'/'+url+'/'+tt+'/'+id,
                    dataType: 'html',
                    success: function(data){
                        addItem(data,text);
                    },
                    faild: function(data){
                        alert('<?php echo $Lang->err;?>');
                    }
                });
            });

            ////////////////////  save and change focus on keydown (on press enter) //////////////
            $('.oneInputSaveEnter').live('keydown',function(e){
                if( (e.keyCode == 13)&&( !($(this).hasClass('k-widget')) ) ){
                    e.preventDefault();
                    var current = $(this);
                    var pr = $(this).parent().next().find('input.oneInputSaveEnter');
                    var table = $(this).attr('dataTableName');
                    var val = $(this).val();
                    var attr_id = $(this).attr('id');
                    var reg = /^[0-9]*$/;
                    if( (typeof table != 'undefined')&&( reg.test(val) )&&( val.length!=0 ) ){
                        $.ajax({
                            url: '<?php echo ROOT?>add/checkDicId/'+val,
                            type:'POST',
                            data:{ 'table':table },
                            dataType:'json',
                            success: function(data){
                                if(data.status){
//                                    current.val(data.data.name);
                                    $('#'+current.attr('dataInputId')).val(data.data.id);
                                    var ts = $('#'+current.attr('id')).data("kendoAutoComplete");
                                    ts.value(data.data.name);
                                    pr = current.parent().parent().next().find('input.oneInputSaveEnter');
                                    var chPR = true;
                                    if(typeof (current.attr('address_counter')) != 'undefined' ){
                                        if(current.attr('name') == 'country_ate'){
                                            if( !( $('#'+current.attr('address_counter')+'disable_radio_1').is(':checked') ) ){
                                                $('#'+current.attr('address_counter')+'addressRegion').focus();
                                                chPR = false;
                                            }
                                        }
                                        if(current.attr('name') == 'street_local'){
                                            $('#'+current.attr('address_counter')+'addressTrack').focus();
                                            chPR = false;
                                        }
                                    }
                                    if(chPR){
                                        if(current.attr('lastItem') != 1){
                                            if(pr.attr('readonly') != 'readonly'){
                                                pr.focus();
                                            }else{
                                                pr.parent().next().find('input.oneInputSaveEnter').focus();
                                            }
                                        }else{
                                            current.trigger('focusout');
                                        }
                                    }
                                }else{
                                    $(this).val('');
                                    $('#'+attr_id+'Id').val('');
                                    alert('<?php echo $Lang->dictionary;?>'+val+' <?php echo $Lang->no_id;?>');
                                }
                            },
                            faild: function(data){
                                alert('<?php echo $Lang->err;?> ');
                            }
                        });
                    }else{
                        var chPR = true;
                        if(typeof (current.attr('address_counter')) != 'undefined' ){
                            if(current.attr('name') == 'country_ate'){
                                if( !( $('#'+current.attr('address_counter')+'disable_radio_1').is(':checked') ) ){
                                    $('#'+current.attr('address_counter')+'addressRegion').focus();
                                    chPR = false;
                                }
                            }
                            if(current.attr('name') == 'street_local'){
                                $('#'+current.attr('address_counter')+'addressTrack').focus();
                                chPR = false;
                            }
                        }
                        if(chPR){
                            if(typeof (pr.attr('type')) == 'undefined' ){
                                pr = current.parent().parent().next().find('input.oneInputSaveEnter');
                            };
                            if(typeof (pr.attr('type')) == 'undefined' ){
                                pr = current.parent().parent().parent().next().find('input.oneInputSaveEnter');
                            };
                            if(current.attr('lastItem') != 1){
                                if(pr.attr('readonly') != 'readonly'){
                                    pr.focus();
                                }else{
                                    if(pr.attr('readonly') != 'readonly'){
                                        pr.focus();
                                    }else{
                                        pr.parent().next().find('input.oneInputSaveEnter').focus();
                                    }
                                    pr.parent().next().find('input.oneInputSaveEnter').focus();
                                }
                            }else{
                                current.trigger('focusout')
                            }
                        }
                    }
                }else{
                    if(!($(this).hasClass('k-widget'))){
                        if( (e.keyCode == 40)&&( $(this).attr('aria-expanded') != 'true') ){
                            var pr = $(this).parent().next().find('input.oneInputSaveEnter');
                            var current = $(this);
                            var chPR = true;
                            if(typeof (current.attr('address_counter')) != 'undefined' ){
                                if(current.attr('name') == 'country_ate'){
                                    if( !( $('#'+current.attr('address_counter')+'disable_radio_1').is(':checked') ) ){
                                        $('#'+current.attr('address_counter')+'addressRegion').focus();
                                        chPR = false;
                                    }
                                }
                                if(current.attr('name') == 'street_local'){
                                    $('#'+current.attr('address_counter')+'addressTrack').focus();
                                    chPR = false;
                                }
                            }
                            if(chPR){
                                if(typeof (pr.attr('type')) == 'undefined' ){
                                    pr = current.parent().parent().next().find('input.oneInputSaveEnter');
                                };
                                if(typeof (pr.attr('type')) == 'undefined' ){
                                    pr = current.parent().parent().parent().next().find('input.oneInputSaveEnter');
                                };
                                if(current.attr('lastItem') != 1){
                                    if(pr.attr('readonly') != 'readonly'){
                                        pr.focus();
                                    }else{
                                        pr.parent().next().find('input.oneInputSaveEnter').focus();
                                    }
                                }else{
                                    current.trigger('focusout');
                                }
                            }
                        }
                        if( (e.keyCode == 38)&&( $(this).attr('aria-expanded') != 'true') ){
                            var pr = $(this).parent().prev().find('input.oneInputSaveEnter');
                            var current = $(this);
                            var chPR = true;
                            if(typeof (current.attr('address_counter')) != 'undefined' ){
                                if(current.attr('name') == 'track'){
                                    if($('#'+current.attr('address_counter')+'disable_radio_1').is(':checked') ){
                                        $('#'+current.attr('address_counter')+'addressStreetLocal').focus();
                                        chPR = false;
                                    }
                                }
                                if(current.attr('name') == 'region'){
                                    $('#'+current.attr('address_counter')+'addressCountry').focus();
                                    chPR = false;
                                }
                            }
                            if(chPR){
                                if(typeof (pr.attr('type')) == 'undefined' ){
                                    pr = current.parent().parent().prev().find('input.oneInputSaveEnter');
                                };
                                if(typeof (pr.attr('type')) == 'undefined' ){
                                    pr = current.parent().parent().parent().prev().find('input.oneInputSaveEnter');
                                };
                                if(current.attr('firstItem') != 1){
                                    if(pr.attr('readonly') != 'readonly'){
                                        pr.focus();
                                    }else{
                                        pr.parent().prev().find('input.oneInputSaveEnter').focus();
                                    }
                                }else{
                                    current.trigger('focusout');
                                }
                            }
                        }
                        var current = $(this);
                        if(typeof current.attr('autocomplete')!= 'undefined' && (e.keyCode != 38) && (e.keyCode != 40)
                                && (e.keyCode != 16) && (e.keyCode != 17) && (e.keyCode != 9)
                                && String.fromCharCode(e.which) != ';' && e.which != 220 && e.which != 55 && e.which != 35 && e.which != 36 && e.which != 37  && e.which != 39 ){
                            $('#'+current.attr('dataInputId')).val('');
                        }
//                        alert(e.keyCode);
                    }

                }
            });


            $('.downloadFile').live('click',function(e){
                e.preventDefault();
                var file_id = $(this).attr('data-id');
                window.open('<?php echo ROOT; ?>bibliography/downloadFile/'+file_id, '_blank' );
            });

//            $('.manAdditional').live('dblclick',function(e){
//                e.preventDefault();
//                var id = $(this).attr('data_id');
//                alert(id);
//            });

            $('.deleteMultiSearch').live('click',function(e){
                e.preventDefault();
                $(this).parent().parent().remove();
            });

//            $('.manAnswer').live('dblclick',function(e){
//                e.preventDefault();
//                var id = $(this).attr('data_id');
//                var session_counter = $(this).attr('session_counter');
//                $.fancybox({
//                    'type'  : 'iframe',
//                    'autoSize': false,
//                    'width'             : 800,
//                    'height'            : 600,
//                    'href'              : "<?php echo ROOT;?>autocomplete/text/manAnswer/"+id+"&old_counter="+session_counter
//                });
//            });

            $('.manAdditional span').live('click',function(e){
                e.preventDefault();
                var id = $(this).attr('data_id');
                var session_counter = $(this).attr('session_counter');
                $.fancybox({
                    'type'  : 'iframe',
                    'autoSize': false,
                    'width'             : 800,
                    'height'            : 600,
                    'href'              : "<?php echo ROOT;?>autocomplete/text/man/"+id+"&old_counter="+session_counter,
                    beforeClose: function () {
                        var textVal = $('iframe');
                        var iframe_id = textVal.attr('name');
                        var iframe = document.getElementById(iframe_id);
                        var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
                        var test = innerDoc.getElementById('text');
                        var val = test.value;
                        var confirmF = confirm('<?php echo $Lang->save;?> ?');
                        if(confirmF){
                            var functionName = "closeFancyTextMan"+session_counter;
                            window[functionName](val,id);
                        }
                    }
                });
            });

            $('.signalContent span').live('click',function(e){
                e.preventDefault();
                var id = $(this).attr('signal_id');
                var session_counter = $(this).attr('session_counter');
                $.fancybox({
                    'type'  : 'iframe',
                    'autoSize': false,
                    'width'             : 800,
                    'height'            : 600,
                    'href'              : "<?php echo ROOT;?>autocomplete/text/signalContent/"+id+"&old_counter="+session_counter,
                    beforeClose: function () {
                        var textVal = $('iframe');
                        var iframe_id = textVal.attr('name');
                        var iframe = document.getElementById(iframe_id);
                        var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
                        var test = innerDoc.getElementById('text');
                        var val = test.value;
                        var confirmF = confirm('<?php echo $Lang->save;?> ?');
                        if(confirmF){
                            var functionName = "closeFancySignalContent"+session_counter;
                            window[functionName](val,id);
                        }
                    }
                });
            });

            $('.signalStatus span').live('click',function(e){
                e.preventDefault();
                var id = $(this).attr('signal_id');
                var session_counter = $(this).attr('session_counter');
                $.fancybox({
                    'type'  : 'iframe',
                    'autoSize': false,
                    'width'             : 800,
                    'height'            : 600,
                    'href'              : "<?php echo ROOT;?>autocomplete/text/signalStatus/"+id+"&old_counter="+session_counter,
                    beforeClose: function () {
                        var textVal = $('iframe');
                        var iframe_id = textVal.attr('name');
                        var iframe = document.getElementById(iframe_id);
                        var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
                        var test = innerDoc.getElementById('text');
                        var val = test.value;
                        var confirmF = confirm('<?php echo $Lang->save;?> ?');
                        if(confirmF){
                            var functionName = "closeFancySignalStatus"+session_counter;
                            window[functionName](val,id);
                        }
                    }
                });
            });

            $('.actionContent span').live('click',function(e){
                e.preventDefault();
                var id = $(this).attr('data_id');
                var session_counter = $(this).attr('session_counter');
                $.fancybox({
                    'type'  : 'iframe',
                    'autoSize': false,
                    'width'             : 800,
                    'height'            : 600,
                    'href'              : "<?php echo ROOT;?>autocomplete/text/action/"+id+"&old_counter=<?php echo $_SESSION['counter']; ?>",
                    beforeClose: function () {
                        var textVal = $('iframe');
                        var iframe_id = textVal.attr('name');
                        var iframe = document.getElementById(iframe_id);
                        var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
                        var test = innerDoc.getElementById('text');
                        var val = test.value;
                        var confirmF = confirm('<?php echo $Lang->save;?> ?');
                        if(confirmF){
                            var functionName = "closeFancyTextAction"+session_counter;
                            window[functionName](val,id);
                        }
                    }
                });
            });

            $('.miaInf span').live('click',function(e){
                e.preventDefault();
                var id = $(this).attr('mia_id');
                var session_counter = $(this).attr('session_counter');
                $.fancybox({
                    'type'  : 'iframe',
                    'autoSize': false,
                    'width'             : 800,
                    'height'            : 600,
                    'href'              : "<?php echo ROOT;?>autocomplete/text/miaInf/"+id+"&old_counter="+session_counter,
                    beforeClose: function () {
                        var textVal = $('iframe');
                        var iframe_id = textVal.attr('name');
                        var iframe = document.getElementById(iframe_id);
                        var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
                        var test = innerDoc.getElementById('text');
                        var val = test.value;
                        var confirmF = confirm('<?php echo $Lang->save;?> ?');
                        if(confirmF){
                            var functionName = "closeFancyMiaInf"+session_counter;
                            window[functionName](val,id);
                        }
                    }
                });
            });

            $('.storedItem').live('hover',function(e){
                var cur = $(this);
                var tb = cur.attr('dataName').split('/');
                var title = cur.attr('title');
                if (tb[0] == 'man'){
                    $.ajax({
                        url: '<?php echo ROOT?>bibliography/getManName/'+cur.attr('dataId'),
                        dataType:'json',
                        success: function(data){
                            cur.attr('title', data.name );
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                }
            });


        });

        function addItem(data,text){
            count++;
            $('.otherDiv').hide();
            $('#content').append('<div class="otherDiv" id="page'+count+'"></div>');
            $('#page'+count).html(data);
            $('#navigation ul').append('<li>'+text+'</li>');
            $('title').html('SNS : '+text);
            $("html, body").animate({ scrollTop: 0 }, "fast");
        };

        function removeItem(){
            $('#page'+count).remove();
            $('#navigation ul li:last').remove();
            if (count != 1){
                $('#page'+(count-1)).show();
            }
            count--;
            var text = $('#navigation ul li:last').text();
            if(text.length == 0){
                $('title').html('SNS');
            }else{
                $('title').html('SNS : '+text);
            }
            $("html, body").animate({ scrollTop: 0 }, "fast");
        }

        function validateNumber(event,input,length){
//            alert(event.keyCode);
            ///////// checking  back , delete , tab , enter
            if( (event.keyCode == 8)||(event.keyCode == 46)||(event.keyCode == 9)||(event.keyCode == 13) ){
                return;
            }
            if( $('#'+input).val().length >= length ){
                event.preventDefault();
            }
            if( (event.keyCode >= 48)&&(event.keyCode <= 57) ){
                return;
            }
            if( (event.keyCode >= 96)&&(event.keyCode <= 105) ){
                return;
            }
            event.preventDefault();
        }

    function multiSelectMaker(inputName , url , dUrl ,current_id){
        $("#"+inputName).keypress(function(e) {
//            $(this).val($.trim( $(this).val() ));
            if( (e.charCode == 59) && ( $.trim($(this).val()).length !=0 ) ){
                e.preventDefault();
                var txtbox = $(this);
                $.ajax({
                    url: '<?php echo ROOT?>add/'+url+'/'+current_id,
                    type: 'POST',
                    data:{ 'value' : $.trim(txtbox.val()) },
                    dataType:'json',
                    success: function(data){
                        $('#'+inputName).before($('<li id="listItem'+inputName + data.id + '"><div class="item"><span>' + $.trim(txtbox.val()) + '</span><a href="javascript:removeMulti(\'' + data.id + '\' , \''+inputName+'\' , \''+dUrl+'\', \''+current_id+'\');">x</a></div></li>'));
                        txtbox.val('');
                    },
                    faild: function(data){
                        alert('<?php echo $Lang->err;?> ');
                    }
                });
            }else{
                if(e.charCode == 59){
                    e.preventDefault();
                }
            }
        });
        $('#'+inputName).focusout(function(e){
            if($.trim($(this).val().length) != 0 ){
                var ee = $.Event("keypress");
                ee.charCode = 59;
                $("#"+inputName).trigger(ee);
            }
        });
        $('ul#'+inputName+'Filter').click(function() {
            $('#'+inputName).focus();
        });
    }
    function removeMulti(id , inputName , dUrl ,current_id) {
        var removeManHasWeapon = confirm('<?php echo $Lang->are_you_sure;?>');
        if(removeManHasWeapon){
            $('#listItem'+ inputName + id).remove();
            $.ajax({
                url: '<?php echo ROOT?>add/'+dUrl+'/'+current_id+'/'+id,
                success: function(data){
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    };
    function multiSelectAutoCompleteMaker(inputName , url , dUrl , current_id ){
        $("#"+inputName).keypress(function(e) {
//            $(this).val($.trim( $(this).val() ));
            if( (e.charCode == 59) && ( $.trim($(this).val()).length !=0 ) ){
                e.preventDefault();
                var txtbox = $(this);
                var val_id = $('#'+inputName+'Id').val();
                var reg = /^[0-9]*$/;
                var val = txtbox.val();
                if(reg.test(txtbox.val()) ){
                    $.ajax({
                        url: '<?php echo ROOT?>add/checkDicId/'+txtbox.val(),
                        type:'POST',
                        data:{ 'table':txtbox.attr('dataTableName') },
                        dataType:'json',
                        success: function(data){
                            if(data.status){
                                txtbox.val(data.data.name);
                                val_id = data.data.id;
                                $.ajax({
                                    url: '<?php echo ROOT?>add/'+url+'/'+current_id,
                                    type: 'POST',
                                    data:{ 'value' : val_id },
                                    success: function(data){
                                        $('#'+inputName+'Filter').prepend($('<li id="listItem'+ inputName + val_id + '"><div class="item"><span>' + $.trim(txtbox.val()) + '</span><a href="javascript:removeMulti(\'' + val_id+ '\' , \''+inputName+'\' , \''+dUrl+'\', \''+current_id+'\');">x</a></div></li>'));
                                        txtbox.val('');
                                    },
                                    faild: function(data){
                                        alert('<?php echo $Lang->err;?> ');
                                        $('#'+inputName).val('');
                                        $('#'+inputName+'Id').val('');
                                    }
                                });
                            }else{
                                $('#'+inputName).val('');
                                $('#'+inputName+'Id').val('');
                                alert('<?php echo $Lang->dictionary;?>'+val+' <?php echo $Lang->no_id;?>');
                            }
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                }else{
                    if(val_id.length != 0 ){
                        $.ajax({
                            url: '<?php echo ROOT?>add/'+url+'/'+current_id,
                            type: 'POST',
                            data:{ 'value' : val_id },
                            dataType:'json',
                            success: function(data){
//                                console.log(data);
                                if(typeof data.success != 'undefined'){
                                    $('#'+inputName+'Filter').append($('<li id="listItem'+ inputName + val_id + '"><div class="item"><span>' + $.trim(txtbox.val()) + '</span><a href="javascript:removeMulti(\'' + val_id+ '\' , \''+inputName+'\' , \''+dUrl+'\', \''+current_id+'\');">x</a></div></li>'));
                                    txtbox.val('');
                                }
                            },
                            faild: function(data){
                                alert('<?php echo $Lang->err;?> ');
                                $('#'+inputName).val('');
                                $('#'+inputName+'Id').val('');
                            }
                        });
                    }else{
                        alert('<?php echo $Lang->enter_correct;?>');
                        $('#'+inputName).val('');
                        $('#'+inputName+'Id').val('');
                    }
                }
            }else{
                if(e.charCode == 59){
                    e.preventDefault();
                }
            }
        });
        $('#'+inputName).focusout(function(e){
            if($.trim($(this).val().length) != 0 ){
                var ee = $.Event("keypress");
                ee.charCode = 59;
                $("#"+inputName).trigger(ee);
            }
        });
        $('ul#'+inputName+'Filter').click(function() {
            $('#'+inputName).focus();
        });
    }

        function multiSelectMakerDate(inputName , url , dUrl ,current_id){
            $("#"+inputName).keypress(function(e) {
                $(this).val($.trim( $(this).val() ));
                if( (e.charCode == 59) && ( $.trim($(this).val()).length !=0 ) ){
                    var check = false;
                    e.preventDefault();
                    var val = $(this).val();
                    var field = $(this).attr('name');
                    var reg = /^(0[0-9]|[0-2][0-9]|3[0-1])-(0[0-9]|1[0-2])-[0-9]{4}$/;
                    if( (typeof $(this).attr('type') != 'undefined')&&(val.length != 0) ){
                        if( (val.length == 6)||(val.length == 8) ){
                            var day = val.slice(0,2);
                            var month = val.slice(2,4);
                            var year = val.slice(4,8);
                            if(year.length == 2){
                                year = '20'+year;
                            }
                            val = day+'-'+month+'-'+year;
                            if(reg.test(val)){
                                $(this).val(val);
                                check = true;
                            }else{
                                $(this).val('');
                                alert('<?php echo $Lang->enter_number;?>');
                            }
                        }else{
                            if(val.length != 10){
                                $(this).val('');
                                alert('<?php echo $Lang->enter_number;?>');
                            }else{
                                check = true;
                            }
                        }
                    }
                    if(check){
                        var txtbox = $(this);
                        $.ajax({
                            url: '<?php echo ROOT?>add/'+url+'/'+current_id,
                            type: 'POST',
                            data:{ 'value' : $.trim(txtbox.val()) },
                            dataType:'json',
                            success: function(data){
                                $('#'+inputName+'Filter').append($('<li id="listItem'+inputName + data.id + '"><div class="item"><span>' + $.trim(txtbox.val()) + '</span><a href="javascript:removeMulti(\'' + data.id + '\' , \''+inputName+'\' , \''+dUrl+'\', \''+current_id+'\');">x</a></div></li>'));
                                txtbox.val('');
                            },
                            faild: function(data){
                                alert('<?php echo $Lang->err;?> ');
                            }
                        });
                    }
                }else{
                    if(e.charCode == 59){
                        e.preventDefault();
                    }
                }
            });
            $('#'+inputName).focusout(function(e){
                if($.trim($(this).val().length) != 0 ){
                    var ee = $.Event("keypress");
                    ee.charCode = 59;
                    $("#"+inputName).trigger(ee);
                }
            });
            $('ul#'+inputName+'Filter').click(function() {
                $('#'+inputName).focus();
            });
        }

    function searchMultiSelectMaker( inputName , name ){
        $("#"+inputName).keypress(function(e) {
            var value = $.trim( $(this).val() );
            var op;
            if( value.length != 0 ){
                if( (e.charCode == 38) || (e.charCode == 124 ) ){
                    e.preventDefault();
                    $('#'+inputName+'Filter').append('<li id="listItem'+inputName+'"><div class="item"><span>' + value + '</span><a class="deleteMultiSearch">x</a></div>' +
                            '<input type="hidden" name="'+name+'[]" value="'+value+'" /></li>');
                    if(e.charCode == 38 ){
                        $('#'+inputName+'Type').val('AND');
                        op = '<?php echo $Lang->and;?>';
                    }
                    if(e.charCode == 124 ){
                        $('#'+inputName+'Type').val('OR');
                        op = '<?php echo $Lang->or;?>';
                    }
                    $('#'+inputName).val('');
                    $('#'+inputName+'Op').html(op);
                }

            }
        });
        if ($('#' + inputName + "Type").length <= 0) {
            $('#' + inputName).parent().before('<div style="width: 100%;text-align: right;top:14px;position: relative;">'
                    + '<ul class="filterlist" id="' + inputName + 'Filter" style="border: none;" >'
                    + '</ul>'
                    + '<input type="hidden" class="oneInputSaveEnter" readonly="readonly" />'
                    + '<input type="hidden" name="' + name + '_type" id="' + inputName + 'Type"/></div>');
            $('#' + inputName).before('<span style="width: 30px;" id="' + inputName + 'Op"></span>');
            //$('#'+inputName+'Filter').append('<li id="listItem'+inputName+'"><div class="item"><span>' + name + '</span><a class="">x</a></div></li>');38,124
//        $('#'+inputName).focusout(function(e){
//            if($.trim($(this).val().length) != 0 ){
//                var type = $('#'+inputName+'Type').val();
//                if( type.length != 0  ){
//                    var ee = $.Event("keypress");
//                    if(type == 'AND'){
//                        ee.charCode = 38;
//                    }else{
//                        ee.charCode = 124;
//                    }
//                    $("#"+inputName).trigger(ee);
//                }
//            }
//        });
        }
    }
//
    function searchMultiSelectMakerAutoComplete( inputName , name ){
        $("#"+inputName).keypress(function(e) {
            var value = $.trim( $(this).val() );
            var op;
            var reg = /^[0-9]*$/;
            if( value.length != 0 ){
                if( (e.charCode == 38) || (e.charCode == 124 ) ){
                    e.preventDefault();
                    if(reg.test(value)){
                        $.ajax({
                            url: '<?php echo ROOT?>add/checkDicId/'+value,
                            type:'POST',
                            data:{ 'table':$(this).attr('dataTableName') },
                            dataType:'json',
                            success: function(data){
                                if(data.status){
                                    $('#'+inputName+'Filter').append('<li id="listItem'+inputName+'"><div class="item"><span>' + data.data.name + '</span><a class="deleteMultiSearch">x</a></div>' +
                                            '<input type="hidden" name="'+name+'[]" value="'+data.data.id+'" /><input type="hidden" name="'+name+'Name[]" value="'+data.data.name+'" /></li>');
                                    if(e.charCode == 38 ){
                                        $('#'+inputName+'Type').val('AND');
                                        op = '<?php echo $Lang->and;?>';
                                    }
                                    if(e.charCode == 124 ){
                                        $('#'+inputName+'Type').val('OR');
                                        op = '<?php echo $Lang->or;?>';
                                    }
                                    $('#'+inputName).val('');
                                    $('#'+inputName+'Op').html(op);
                                    $('#'+inputName+'Id').val('');
                                }else{
                                    $('#'+inputName).val('');
                                    $('#'+inputName+'Id').val('');
                                    alert('<?php echo $Lang->dictionary;?>'+value+' <?php echo $Lang->no_id;?>');
                                }
                            },
                            faild: function(data){
                                alert('<?php echo $Lang->err;?> ');
                                $('#'+inputName).val('');
                                $('#'+inputName+'Id').val('');
                            }
                        });
                    }else{
                        var val_id = $('#'+inputName+'Id').val();
                        if( val_id.length != 0 ){
                            $('#'+inputName+'Filter').append('<li id="listItem'+inputName+'"><div class="item"><span>' + value + '</span><a class="deleteMultiSearch">x</a></div>' +
                                    '<input type="hidden" name="'+name+'[]" value="'+val_id+'" /><input type="hidden" name="'+name+'Name[]" value="'+value+'" /></li>');
                            if(e.charCode == 38 ){
                                $('#'+inputName+'Type').val('AND');
                                op = '<?php echo $Lang->and;?>';
                            }
                            if(e.charCode == 124 ){
                                $('#'+inputName+'Type').val('OR');
                                op = '<?php echo $Lang->or;?>';
                            }
                            $('#'+inputName).val('');
                            $('#'+inputName+'Op').html(op);
                            $('#'+inputName+'Id').val('');
                        }else{
                            alert('<?php echo $Lang->enter_correct;?>');
                            $('#'+inputName).val('');
                            $('#'+inputName+'Id').val('');
                        }
                    }

                }

            }
        });
        if ($('#' + inputName + 'Type').length <= 0) {
            $('#' + inputName).parent().before('<div style="width: 100%;text-align: right;top:14px;position: relative;">'
                    + '<ul class="filterlist" id="' + inputName + 'Filter" style="border: none;" >'
                    + '</ul>'
                    + '<input type="hidden" class="oneInputSaveEnter" readonly="readonly" />'
                    + '<input type="hidden" name="' + name + '_type" id="' + inputName + 'Type"/></div>');
            $('#' + inputName).before('<span style="width: 30px;;position: absolute;margin-left: -50px;" id="' + inputName + 'Op"></span>');
            $('#' + inputName).focusout(function (e) {
                var c = $(window.lastElementClicked).attr('id');
                var reg = /^[0-9]*$/;
//            if(!reg.test($('#'+inputName+'Id').val())){
                if (($.trim($(this).val().length) == 0 && $('#' + inputName + 'Id').val().length != 0 ) || ($.trim($(this).val().length) != 0 && $('#' + inputName + 'Id').val().length == 0 )) {
                    $('#' + inputName).val('');
                    $('#' + inputName + 'Id').val('');
                    if (c != 'resetButton') {
                        alert('<?php echo $Lang->enter_correct;?>');
                    }
                }
//            }
            });
        }
    }

    function formNotEmpty( formName ){
        var check = false;
        $('#'+formName+' :input').map(function(){
            if( ( $(this).val() )&&( $(this).val() != 0) ){
                check = true;
            }
        })
        return check;
    }

        function dataBound(e) {
            if (this.dataSource.view().length == 0) {
                //insert empty row
                var colspan = this.thead.find("th").length;
                var emptyRow = "<tr><td colspan='" + colspan + "'></td></tr>";
                this.tbody.html(emptyRow);
            }
        }

//    function resetFilter(){
//        alert('asdasd');
//        $("form.k-filter-menu button[type='reset']").trigger("click");
//    }

    $('.k-grid-resetFilter').live('click',function(e){
        $("form.k-filter-menu button[type='reset']").trigger("click");
    });

    function closeAllFancy(){
        $.fancybox.close();
    }

    $(this).keyup(function(e){
        e.preventDefault();
        if(e.keyCode == 27){
            closeAllFancy();
        }
    });

    function check_session(){
        $.ajax({
            url : '<?php echo ROOT; ?>sns/index/true' ,
            dataType: 'json' ,
            success: function(data){
                if(data.status){
                    window.location = '<?php echo ROOT; ?>';
                }
            }

        });
        setTimeout(check_session,600000)
    }

    </script>

</div>
</body>
</html>