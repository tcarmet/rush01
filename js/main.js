 $(document).ready(function(){
 	$("td").click(function()
 	{
 		if ($(this).css('background-color') == 'rgb(255, 192, 203)')
 	 		$('#mapclick').load('./functions/create_table_map.php?pos=' + this.id);
 	 	else
 	 		alert('Tu ne peux pas jouer ici :(');
     });
 });
