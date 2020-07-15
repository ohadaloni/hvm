/*------------------------------------------------------------*/
$(function() {
	hvmPaintRows(document);
	/*	$(".imgToolTip").imgToolTip();	*/
	$(".showImage").showImage();
});
/*------------------------------------------------------------*/
function hvmPaintRows(context)
{
	$(".mRow", context).hoverClass("hilite");
	$(".hvmRow", context).hoverClass("hilite");
	$(".mFormRow", context).hoverClass("hilite");
	$(".mHeaderRow", context).addClass("hvmZebra0");
	$(".hvmHeaderRow", context).addClass("hvmZebra0");
	$(".mFormRow:nth-child(odd)", context).addClass("hvmZebra1");
	$(".mFormRow:nth-child(even)", context).addClass("hvmZebra2");
	$(".mRow:nth-child(odd)", context).addClass("hvmZebra1");
	$(".mRow:nth-child(even)", context).addClass("hvmZebra2");
	$(".hvmRow:nth-child(odd)", context).addClass("hvmZebra2");
	$(".hvmRow:nth-child(even)", context).addClass("hvmZebra1"); // first row is 1
	$(".hvmFormRow:nth-child(odd)", context).addClass("hvmZebra2");
	$(".hvmFormRow:nth-child(even)", context).addClass("hvmZebra1"); // first row is 1

	$(".today:nth-child(odd)", context).addClass("hvmZebra3");
	$(".today:nth-child(even)", context).addClass("hvmZebra4");
	$(".yesterday:nth-child(odd)", context).addClass("hvmZebra5");
	$(".yesterday:nth-child(even)", context).addClass("hvmZebra6");

}
/*------------------------------------------------------------*/
