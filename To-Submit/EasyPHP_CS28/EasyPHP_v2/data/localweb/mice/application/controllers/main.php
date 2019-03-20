<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	 
	 function __construct()
	{
		parent::__construct();	 
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		$this->load->library('table');
	}
	
	public function index()
	{	
		//$this->load->view('header');
		$this->load->view('home');
	}

	/************             Staff Portal              *************/
	/************     Cinema System for staff start     *************/
	public function sys_cinema()
	{	
		$this->load->view('header_staff');
		//$this->load->view('header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		//table name exact from database
		$crud->set_table('cinema');
		
		//give focus on name used for operations e.g. Add Order, Delete Order
		$crud->set_subject('Cinema');
		
		//the columns function lists attributes you see on frontend view of the table
		//$crud->columns('cinemaNo', 'cinemaName', 'address', 'location', 'managerName', 'noOfScreens');
	
		//the fields function lists attributes to see on add/edit forms.
		//Note no inclusion of invoiceNo as this is auto-incrementing
		$crud->fields('cinemaNo', 'cinemaName', 'address', 'location', 'managerName', 'noOfScreens');
		
		//set the foreign keys to appear as drop-down menus
		// ('this fk column','referencing table', 'column in referencing table')
		//$crud->set_relation('custID','customers','custID');
		
		//many-to-many relationship with link table see grocery crud website: www.grocerycrud.com/examples/set_a_relation_n_n
		//('give a new name to related column for list in fields here', 'join table', 'other parent table', 'this fk in join table', 'other fk in join table', 'other parent table's viewable column to see in field')
		//$crud->set_relation_n_n('items', 'order_items', 'items', 'invoice_no', 'item_id', 'itemDesc');
		
		//form validation (could match database columns set to "not null")
		$crud->required_fields('cinemaNo', 'cinemaName', 'address', 'location', 'managerName', 'noOfScreens');
		
		//change column heading name for readability ('columm name', 'name to display in frontend column header')
		$crud->display_as('cinemaNo', 'Cinema Number');
		$crud->display_as('cinemaName', 'Cinema');
		$crud->display_as('managerName', 'Manager');
		$crud->display_as('noOfScreens', 'Number of Screens');
		
		$output = $crud->render();
		$this->sys_cinema_output($output);
	}
	
	function sys_cinema_output($output = null){
		//this function links up to corresponding page in the views folder to display content for this table
		$this->load->view('sys_cinema.php', $output);
	}
/************     Cinema System for staff end     *************/

/************     Member System for staff start     *************/
	public function sys_member()
	{	
		$this->load->view('header_staff');
		//$this->load->view('staff_header');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		$crud->set_table('member');
		$crud->set_subject('Member');
		$crud->fields('memberNo', 'title', 'memberName', 'dateJoined', 'memberStat', 'password');
		$crud->required_fields('memberNo', 'title', 'memberName', 'dateJoined', 'memberStat', 'password');
		//$crud->set_relation_n_n('orders', 'order_items', 'orders', 'item_id', 'invoice_no', 'invoiceNo');
		$crud->display_as('memberNo', 'Member Number');
		$crud->display_as('memberName', 'Name');
		$crud->display_as('dateJoined', 'Date Joined');
		$crud->display_as('memberStat', 'Membership Status');
		$crud->display_as('password', 'Password');
		
		$output = $crud->render();
		$this->sys_member_output($output);
	}
	function sys_member_output($output = null){
		$this->load->view('sys_member.php', $output);
	}
/************     Member System for staff end     *************/

/************     Screen System for staff start     *************/
	public function sys_screen()
	{	
		$this->load->view('header_staff');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		
		$crud->set_table('screen');
		$crud->set_subject('Screen');
		$crud->fields('screenNo', 'cinemaNo', 'numberOfSeats', 'price');
		$crud->required_fields('screenNo', 'cinemaNo', 'numberOfSeats', 'price');
		//$crud->set_relation_n_n('orders', 'order_items', 'orders', 'item_id', 'invoice_no', 'invoiceNo');
		$crud->display_as('screenNo', 'Screen Number');
		$crud->display_as('cinemaNo', 'Cinema Number');
		$crud->display_as('numberOfSeats', 'Capacity');
		$crud->display_as('price', 'Ticket Price');
		
		$output = $crud->render();
		$this->sys_screen_output($output);
	}
	function sys_screen_output($output = null){
		$this->load->view('sys_screen.php', $output);
	}
/************     Screen System for staff end     *************/

/************     Film System for staff start     *************/
public function sys_film()
{	
	$this->load->view('header_staff');
	$crud = new grocery_CRUD();
	$crud->set_theme('datatables');
	
	$crud->set_table('film');
	$crud->set_subject('Film');
	$crud->fields('filmNo', 'filmTitle', 'director', 'releaseYear');
	$crud->required_fields('filmNo', 'filmTitle', 'director', 'releaseYear');
	$crud->display_as('filmNo', 'Film Number');
	$crud->display_as('filmTitle', 'Film Title');
	$crud->display_as('director', 'Director');
	$crud->display_as('releaseYear', 'Year of Release');
	
	$output = $crud->render();
	$this->sys_film_output($output);
}
function sys_film_output($output = null){
	$this->load->view('sys_film.php', $output);
}
/************     Film System for staff end     *************/

/************     Booking System for staff start     *************/
public function sys_booking()
{	
	$this->load->view('header_staff');
	$crud = new grocery_CRUD();
	$crud->set_theme('datatables');
	
	$crud->set_table('booking');
	$crud->set_subject('Booking');
	$crud->fields('bookingNo', 'memberNo', 'seatsRequired', 'bookingDate', 'perfNo', 'totalPrice');
	$crud->required_fields('bookingNo', 'memberNo', 'seatsRequired', 'bookingDate', 'perfNo', 'totalPrice');
	$crud->display_as('bookingNo', 'Booking Number');
	$crud->display_as('memberNo', 'Member Number');
	$crud->display_as('seatsRequired', 'Seats Required');
	$crud->display_as('bookingDate', 'Performance Date');
	$crud->display_as('perfNo', 'Performance ID');
	$crud->display_as('totalPrice', 'Total Price');
	
	$output = $crud->render();
	$this->sys_booking_output($output);
}
function sys_booking_output($output = null){
	$this->load->view('sys_booking.php', $output);
}
/************     Booking System for staff end     *************/

/************     Performance System for staff start     *************/
public function sys_performance()
{	
	$this->load->view('header_staff');
	$crud = new grocery_CRUD();
	$crud->set_theme('datatables');
	
	$crud->set_table('performance');
	$crud->set_subject('Performance');
	$crud->fields('perfNo','cinemaNo', 'screenNo', 'perfDate', 'startTime', 'filmNo', 'seatsRemain');
	$crud->set_relation('cinemaNo','cinema','cinemaName');
	$crud->required_fields('perfNo','cinemaNo', 'screenNo', 'perfDate', 'startTime', 'filmNo', 'seatsRemain');
	$crud->display_as('cinemaNo', 'Cinema');
	$crud->display_as('screenNo', 'Screen Number');
	$crud->display_as('filmNo', 'Film Number');
	$crud->display_as('perfDate', 'Performance Date');
	$crud->display_as('startTime', 'Time');
	$crud->display_as('seatsRemain', 'Remaining Seats');
	
	$output = $crud->render();
	$this->sys_performance_output($output);
}
function sys_performance_output($output = null)
{
	$this->load->view('sys_performance.php', $output);
}
/************     Performance System for staff end     *************/

/************         Entry Log for staff start        *************/
public function sys_entry_log()
{	
	$this->load->view('header_staff');
	$this->load->view('sys_entry_log.php');
}

/************         Entry Log  for staff end         *************/
		/************           End of Staff Portal            *************/

		/************              Member Portal               *************/
/************        Film System for member start      *************/
public function mem_film()
{	
	$this->load->view('header_member');
	$this->load->view('mem_film.php');
}
/************     Film System for member end     *************/

/************     Entry System for member start     *************/
public function mem_entry()
{	
	$this->load->view('header_member');
	$this->load->view('mem_entry.php');
}
/************     Entry System for member end     *************/

/************     Account management System for member start     *************/
public function mem_manage_account()
{	
	$this->load->view('header_member');
	$this->load->view('mem_manage_account.php');
}
/************     Account management System for member end     *************/

/************     Booking Management System for member start     *************/
public function mem_manage_booking()
{	
	$this->load->view('header_member');
	$this->load->view('mem_manage_booking.php');
}
/************     Booking Management System for member end     *************/

/************     Search and Book System for member start     *************/
public function mem_search_book()
{	
	$this->load->view('header_member');
	$this->load->view('mem_search_book.php');
}
/************     Search and book System for member end     *************/
		/************           End of Member Portal           *************/

	public function staff_view()
	{	
		$this->load->view('header_staff');
		$this->load->view('staff_view.php');
	}

	public function member_view()
	{	
		$this->load->view('header_member');
		$this->load->view('member_view.php');
	}
	public function logout()
	{	
		$this->load->view('logout.php');
	}
	public function mem_help()
	{	
		$this->load->view('header_member');
		$this->load->view('mem_help.php');
	}
	public function staff_help()
	{	
		$this->load->view('header_staff');
		$this->load->view('staff_help.php');
	}
}
