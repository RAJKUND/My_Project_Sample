<!-- Footer -->
<footer  class="footer" >
    <span class="start-left">Copyright &copy; <script>document.write(new Date().getFullYear());</script> by </span> 
    <a href="https://stardigitekelectro.com/"class="left"> SDEPL. </a> 
    <span class="left"> All Rights Reserved. </span> 
    <a class="end-right" href="#">Terms and Conditions.</a> 
    <a class="right" href="#">Privacy Policy. </a> 
</footer>
</body>
</html>
<script>
$(document).ready(function(){
	load_data();
	function load_data(query)
	{
		$.ajax({
			url:"./fetch.php",
			method:"post",
			data:{query:query},
			success:function(data)
			{
				$('#search_result').html(data);
			}
		});
	}
	
	$('#search_text').keyup(function(){
		var search = $(this).val();
		if(search != '')
		{
			load_data(search);
		}
		else
		{
			load_data();			
		}
	});
});
</script>
