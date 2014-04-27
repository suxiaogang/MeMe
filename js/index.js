$(function(){
	prettyPrint();
	$(".close").click(closeWindow);
	$(".showWell").click(showWell);
	changeRadio();
	$('.tooltip-test').tooltip();

	/*
	$(".nofinish").click(function (){ 
		if(confirm('Are you sure to DELETE it Permanently?')){
			var tid = $(this).attr('value');
			$(this).parent().parent().slideUp(300);
			$.get('/main/delete', 'tid=' + tid);
			//
		}//confirm
	});//click
	*/

    $('#hero-unit').hammer({
			hold_timeout: 5000
		}).on("hold", '.nofinish', function(event) {
			var $e = $(this);
			var $p = $(this).parent();
			if(confirm('Are you sure to delete it permanently?')){
				$p.parent().slideUp(300);
				$.get('/main/delete', 'tid=' + $e.attr('value'));
			}
    });
});


function changeRadio(){
	$("input[name$='type']").click(function() {
        var test = $(this).val();
        if(test == 1){
			$(".input-xxlarge").slideDown("fast");
			$("#some-textarea").css("height","75px");
			$(".input-xxlarge").attr("placeholder","Page title");
			$("#some-textarea").attr("placeholder","Page URL");
		} else if(test == 2) {
			$(".input-xxlarge").slideDown("fast");
			$("#some-textarea").css("height","50px");
			$(".input-xxlarge").attr("placeholder","Artist - Track");
			$("#some-textarea").attr("placeholder","paste music MP3 url page link here...");
		} else if(test == 3) {
			$(".input-xxlarge").slideUp("fast");
			$("#some-textarea").css("height","200px");
			$("#some-textarea").attr("placeholder","type something in your mind...");
		} else if(test == 4) {
			$(".input-xxlarge").slideUp("fast");
			$("#some-textarea").css("height","200px");
			$("#some-textarea").attr("placeholder","write or paste code snippets here...");
		}
    });
}

function closeWindow() {
    $(".well-large").slideUp("fast");
	if($(".showWell").text() == "+"){
		$(".showWell").text("-");
	} else {
		$(".showWell").text("+");
	}
}

function showWell(){
	$(".well-large").slideToggle("fast");
	if($(".showWell").text() == "+"){
		$(".showWell").text("-");
	} else {
		$(".showWell").text("+");
	}
}

function viewRawCode(param){
	window.open("/main/viewCode?tid="+param)
}

function viewImage(param){
	window.open("/main/viewImage?tid="+param)
}

function viewArticle(param){
	window.open("/main/viewArticle?tid="+param)
}