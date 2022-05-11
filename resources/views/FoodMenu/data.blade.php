

Skip to content
Using TRooTech Business Solutions Pvt Ltd Mail with screen readers
Conversations
0.04 GB of 30 GB used
Programme Policies
Powered by Google
Last account activity: 13 hours ago
Details
<!doctype html>
<html>
<head>
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="{{ asset('css/dropdowntree.css') }}" rel="stylesheet" type="text/css">
<style>
.container { margin:150px auto;}
</style>
</head>

<body>
<div id="jquery-script-menu">
	<div class="jquery-script-center">
<script type="text/javascript">
//-->
</script>
<div class="jquery-script-clear"></div>
</div>
</div>
<div class="container">
<h1>jQuery & Bootstrap Dropdown Tree Plugin Example</h1>
<div class="dropdown dropdown-tree" id="example">
</div>
<div data-category="{{$menulist}}" id="manu-dropdown"></div>









<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="{{ asset('js/dropdowntree.js') }}"></script>
<script>
const createData = lst => {
  return lst.map(e => {
    title = e.menu_title;
    if (e.hasOwnProperty("children") && e.children.length > 0) {
      return {title, data: createData(e.children)};
    }
    return {data: title, title}
  });
}

const catData = $("#manu-dropdown").data("category");
const data = createData(catData);
console.log("function",data);
console.log("raw", catData);
console.log("processed", data);

var options = {
	title : "jQueryScriptNet",
	data: data,
	maxHeight: 3000,
	selectChildren : true,
	clickHandler: function(element){
				//gets clicked element parents
		console.log($(element).GetParents());
		//element is the clicked element
		console.log(element);
		$("#example").SetTitle($(element).find("a").first().text());
		console.log("Selected Elements",$("#example").GetSelected());
	},
	checkHandler: function(element){
		$("#example").SetTitle($(element).find("a").first().text());
	},
	closedArrow: '<i class="fa fa-caret-right" aria-hidden="true"></i>',
	openedArrow: '<i class="fa fa-caret-down" aria-hidden="true"></i>',
	multiSelect: true,
}

$("#example").DropDownTree(options);
</script>

</body>
</html>

