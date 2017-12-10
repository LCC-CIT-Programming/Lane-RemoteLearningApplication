window.onload = setupPage;

function setupPage()
{
	createDisplayExpertise();
	// var tutor = document.getElementsByTagName("a");
	// //var tutor = document.forms[0].elements.namedItem("tutor");
	// //tutor.onmouseover = displayExpertise;
	// for (var i = 0; i < tutor.length; i++)
	// {
	// 	// TODO: if the anchor tag is styled with the class has events
	// 	if (tutor[i].className == "hasTutor")
	// 	{
	// 		// TODO:  add 3 event handlers (onmouseover (display), onmouseout (clear) and onclick (cancel the click))
	// 		// tutor[i].onmouseover = displayExpertise;
	// 		// tutor[i].onmouseout = clearEvents;
	// 		// tutor[i].onclick = cancelClick;
	// 		tutor[i].onclick = displayExpertise;
	// 	}
	// }
}

// TODO:  write the body of this one
function clearEvents()
{
	var eventsDiv = document.getElementById("events");
	eventsDiv.innerHTML = "";
}

function cancelClick()
{
	return false;
}

function displayExpertise()
{
	var expertiseDiv = document.getElementById("expertise");
	expertiseDiv.style.position = "absolute";
	expertiseDiv.style.top = "50px";
	expertiseDiv.style.left = "860px";
	
	// TODO:  make the ajax call to load the div with an id of events
	$("div#expertise").load("App/displayExpertise.php");
	
}

function createDisplayExpertise(categories) {
		
	$("a.hasTutor").click( function(event){
    	event.preventDefault();
    	displayExpertise();
  //   	newCategoryName = this.innerHTML;
		// geturl = url + "?action=getProductsByCategory&category_id=" + this.id;
		// $.getJSON( geturl, createProductTable);
	});
	// $("a.getProducts:first").trigger("click");
}

/* This version uses jquery selectors exclusively.
   Can you read it and "guess" what it does?
$(document).ready(function(){
  $("a.hasEvents").mouseover(function(e){
    $("div#events").load(this.href);
  });
  $("a.hasEvents").click(function(e){
	e.preventDefault();
  });
  $("a.hasEvents").mouseout(function(e){
    $("div#events").text("");
  });
});
*/