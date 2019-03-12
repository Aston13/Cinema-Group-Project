<?php
	include('session.php');
	if(!isset($_SESSION['login_user'])){ 
		header('Location:http://localhost:8080/mice/index.php'); // Redirecting To Home Page 
	}

	include('query.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Festival Director's Portal</title>

    <style>
        h1, h2 {
            text-align: center;
            font-family: Calibri;
        }
        p.p-centre {
            text-align: center;
            font-family: Arial;
        }
		table.mytable {border-collapse: collapse;}
		table.mytable td, th {border: 1px solid grey; padding: 5px 15px 2px 7px;}
		th {background-color: #f2e4d5;}							
    </style>
</head>
<body>
	<b id="welcome">Welcome Director <i><?php echo $login_session; ?></i>.</b>
	<br>
	<b id="logout"><a href="logout">Log Out</a></b>
	
	<h1>Performances Search</h1>
	<div align='center'>
		<!-- Display performances searched by: 
		filmName,
		 screenNo(via cinemaName),
		  startDate(== exact),
		   startTime(=>),
		    cinemaNo  
			-->
		<button type="submit" onclick="location.href='<?php echo site_url('main/perf_query1_view')?>'">Query1</button>
		<button type="submit" onclick="location.href='<?php echo site_url('main/perf_query2_view')?>'">Query2</button>
	</div>
	<h2>Find a performance</h2>

	<select>
		<option value="*">Any</option>
 		<option value="Rialto">Rialto</option>
 		<option value="Intu">Intu</option>
		<option value="Phoenix">Phoenix</option>
		<option value="Intimate">Intimate</option>
	</select>		





	<!-- <div align='center'>
		
		//$tmpl = array ('table_open' => '<table class="mytable">');
		//$this->table->set_template($tmpl); 
	
		//$this->db->query('drop table if exists temp');
		//$this->db->query('create temporary table temp as (select orders.custID, custName, COUNT(invoiceNo) AS TotalOrders from orders, customers where orders.custID = customers.custID group by orders.custID)');
		
		//display * FROM performance and filmName FROM film WHERE perfomance.filmNo == film.filmNo AND WHERE cinema.cinemaNo == perfomance.cinemaNo
		// show * FROM performance WHERE $cinema_name == performance.cinemaNo/Name
		//$this->db->query('create temporary table temp as (select orders.custID, custName, COUNT(invoiceNo) AS TotalOrders from orders, customers where orders.custID = customers.custID group by orders.custID)');
		//$query = $this->db->query('select * from temp;');
		//echo $this->table->generate($query);
	--->


</body>
</html>