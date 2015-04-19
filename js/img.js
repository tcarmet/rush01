 $(document).ready(function(){
 	$("img").click(function()
 	{
		$('#mapclick').load('./functions/create_table_map.php?action=' + this.id);
		return (true);
     });
 });
