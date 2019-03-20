<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<style>
			/* #nav { font-family: Arial; font-size: 14px; width: 100%; float: left; margin: 0 0 1em 0; padding: 0; list-style: none;}
			#nav {list-style: none; border:0;}
			#rightnav { list-style: none; }
			#nav li { float: left; }
			#rightnav li { float: right; }
			#nav li a { margin: 0 3px 0 0; font-size: 15px; display: block; padding: 8px 15px; text-decoration: none; color: #000; background-color: #f2f2f2; border: 1px solid #c1c1c1;}
			#nav li a:hover {background-color: #f2e4d5;}
			#nav a:link, a:visited {border-radius: 12px 12px 12px 12px; }		 */

			<?php include ("style.php"); ?>
		
		</style>
		

	</head>
	<body>
		<h1>Member Portal</h1>

		<div class ="topnav" id="myTopnav">
				<a href='<?php echo site_url('main/member_view')?>' class="active">Home</a>
				<a href='<?php echo site_url('main/mem_film')?>'>Films</a>
				<a href='<?php echo site_url('main/mem_search_book')?>'>Search and Book</a>
				<div class="dropdown">
					<button class="dropbtn">Manage
						<i class="fa fa-caret-down"></i>
					<button>
					<div class="dropdown-content">
						<a href='<?php echo site_url('main/mem_entry')?>'>Entry</a>
						<a href='<?php echo site_url('main/mem_manage_booking')?>'>Bookings</a>
						<a href='<?php echo site_url('main/mem_manage_account')?>'>Account</a>
					</div>
				</div>
				<a href='<?php echo site_url('main/mem_help')?>'>Help</a>
				<a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
		</div>

		<script>
			function myFunction() {
  				var x = document.getElementById("myTopnav");
  				if (x.className === "topnav") {
    				x.className += " responsive";
 				} else {
   					x.className = "topnav";
  				}
			}
		</script>

	</body>
</html>