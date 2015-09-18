
$(function() {

    $('#task_date').datepicker({
        showOn: 'button',
        buttonImage: '../../../../images/calendar.gif',
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        buttonImageOnly: true ,
        altField: '#alternate',
        altFormat: 'yy MM d'
    });
    
    $('#date').datepicker({
        showOn: 'button',
        buttonImage: '../../../../images/calendar.gif',
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        buttonImageOnly: true ,
        altField: '#alternate',
        altFormat: 'yy MM d'
    });
    
    $('#date2').datepicker({
        showOn: 'button',
        buttonImage: '../../../../images/calendar.gif',
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        buttonImageOnly: true ,
        altField: '#alternate',
        altFormat: 'yy MM d'
    });


    //confirmation dialog shown when user click on the delete link
    $('#dialog').dialog({
        autoOpen: false,
        show: "puff",
        hide: "clip",
        width: 270,
        modal: true,
        resizable: false,
        buttons: {
            "Delete": function() {
                var link = $(this).data('del-link');
                $(this).dialog("close");
                location.href = link;
            },
            "Cancel": function() {
                $(this).dialog("close");
            }
        }
    });
    
    // show message box when administrator click on delete link
    $(".delete").click(function(){
        var link = $(this).closest('a').attr('href');
        var index = link.lastIndexOf('/') + 1;
        id = link.substring(index);
        $("span#archieve_out_id").html(id);
        $('#dialog').data('del-link', link).dialog('open');
        return false;
    });

    //information dialog
    $('#info').dialog({
        autoOpen: false,
        width: 270,
        modal: true,
        resizable: false,
        buttons: {
            "OK": function() {
                $(this).dialog("close");
            }
        }
    });
	
    $("#user_login").click(function(){
        $("#form_login").submit();
    });

    $("#save_user_edit").click(function(){
        $("#form_user_edit").submit();
    });

    $("#save_user_new").click(function(){
        $("#form_user_new").submit();
    });

    $("#save_task_edit").click(function(){
        $("#form_task_edit").submit();
    });

    $("#save_task_new").click(function(){
        $("#form_task_new").submit();
    });

    
	
    $("#tree").treeview({
        collapsed: true,
        animated: "medium",
        control:"#sidetreecontrol",
        persist: "location"
    });

	
    $(".toggleCollapse").toggle(
        function(){
            var div = $(this).attr('href');
            $(div).slideUp();
            $(this).addClass('expand');
            return false;
        },
        function(){
            var div = $(this).attr('href');
            $(div).slideDown();
            $(this).removeClass('expand');
            return false;
        });
		
    $(".toggleExpand").toggle(
        function(){
            var div = $(this).attr('href');
            $(div).slideDown();
            $(this).addClass('collapse');
            return false;
        },
        function(){
            var div = $(this).attr('href');
            $(div).slideUp();
            $(this).removeClass('collapse');
            return false;
        });
});

/**
 * Accordion Menu InitMenu
 * 
 */
var nav = location.pathname.substr(1).split('/', 2)[0] || '/';
// initialitation accordion menu
function initMenu() {
    $('#menu ul').hide();
    (nav == '/' ) ? $('#menu ul:first').show() : $('#menu ul#'+nav).show();
    $('#menu li a').click(
        function() {
            var checkElement = $(this).next();
            if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                return false;
            }
            if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                $('#menu ul:visible').slideUp('normal');
                checkElement.slideDown('normal');
                return false;
            }
        }
        );
}



/*
	Tambahan javascript
*/

$(document).ready(function(){
	$('.akordion .akordion-title')
		.next('.akordion-content')
		.filter(':not(:first)')
		.hide();

	$('.akordion > .akordion-title').click(function(){
		var selfClick = $(this).next('div:first').is(':visible');
		if(selfClick) {
		  return;
		}

		$(this).parent()
			.find('> div:visible')
			.slideToggle('slow');

		$(this).next('div:first') 
			.slideToggle('slow');
	 });
});

$(document).ready(function(){
	$('.treeakordion .treeakordion-title')
		.next('.treeakordion-content')
		.filter(':not(:first)')
		.hide();

	$('.treeakordion > .treeakordion-title').click(function(){
		var selfClick = $(this).next('div:first').is(':visible');
		if(selfClick) {
		  return;
		}

		$(this).parent()
			.find('> div:visible')
			.slideToggle('slow');

		$(this).next('div:first') 
			.slideToggle('slow');
	 });
});

$(function() {
	$( "#slider-hours" ).slider({
		range: "min",
		value: 1,
		anmate:true,
		min: 0,
		max: 8,
		slide: function( event, ui ) {
			$( "#hours" ).val( ui.value );
		}
	});
	$( "#hours" ).val( $( "#slider-hours" ).slider( "value" ) );
});

function changeslider(e){
    if(e.value>8) {
        e.value = 8;
    }else if(e.value<0){
        e.value=0;
    }
    $( "#slider-hours" ).slider( "value",e.value)
}
	
function numbersonly(myfield, e, dec)
{
    var key;
    var keychar;

    if (window.event)
       key = window.event.keyCode;
    else if (e)
       key = e.which;
    else
       return true;
    keychar = String.fromCharCode(key);

    // control keys
    if ((key==null) || (key==0) || (key==8) || 
        (key==9) || (key==13) || (key==27) )
       return true;

    // numbers
    else if ((("0123456789").indexOf(keychar) > -1))
       return true;

    // decimal point jump
    else if (dec && (keychar == "."))
       {
       myfield.form.elements[dec].focus();
       return false;
       }
    else
       return false;
}



