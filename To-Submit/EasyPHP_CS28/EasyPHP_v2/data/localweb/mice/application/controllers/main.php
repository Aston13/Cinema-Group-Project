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
		$crud->fields('memberNo', 'title', 'memberName', 'dateJoined', 'memberStat');
		$crud->required_fields('memberNo', 'title', 'memberName', 'dateJoined', 'memberStat');
		//$crud->set_relation_n_n('orders', 'order_items', 'orders', 'item_id', 'invoice_no', 'invoiceNo');
		$crud->display_as('memberNo', 'Membership Number');
		
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
	$crud->fields('bookingNo', 'seatsRequired', 'bookingDate');
	$crud->required_fields('bookingNo', 'seatsRequired', 'bookingDate');
	$crud->display_as('bookingNo', 'Booking Number');
	
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
	$crud->fields('perfNo', 'screenNo', 'cinemaNo', 'filmNo', 'perfDate', 'startTime', 'seatsRemain');
	$crud->set_relation('cinemaNo','cinema','cinemaName');
	$crud->required_fields('screenNo', 'cinemaNo', 'filmNo', 'perfDate', 'startTime', 'seatsRemain');
	$crud->display_as('cinemaNo', 'Cinema');
	
	$output = $crud->render();
	$this->sys_performance_output($output);
}
function sys_performance_output($output = null)
{
	$this->load->view('sys_performance.php', $output);
}
/************     Performance System for staff end     *************/
/************           End of Staff Portal            *************/

/************              Member Portal               *************/
/************     Film System for member start     *************/
public function mem_film()
{	
	$this->load->view('header_member');
	$crud = new grocery_CRUD();
	$crud->set_theme('datatables');
	
	$crud->set_table('film');
	$crud->set_subject('Film');
	$crud->fields('filmNo', 'filmTitle', 'director', 'releaseYear');
	$crud->required_fields('filmNo', 'filmTitle', 'director', 'releaseYear');
	$crud->display_as('filmNo', 'Film Number');
	
	$output = $crud->render();
	$this->mem_film_output($output);
}
function mem_film_output($output = null){
	$this->load->view('mem_film.php', $output);
}
/************     Film System for member end     *************/

/************     Entry System for member start     *************/
public function mem_entry()
{	
	$this->load->view('header_member');
	$crud = new grocery_CRUD();
	$crud->set_theme('datatables');
	
	$crud->set_table('booking');
	$crud->set_subject('Booking');
	$crud->fields('bookingNo', 'seatsRequired', 'bookingDate');
	$crud->required_fields('bookingNo', 'seatsRequired', 'bookingDate');
	$crud->display_as('bookingNo', 'Booking Number');
	
	$output = $crud->render();
	$this->mem_entry_output($output);
}
function mem_entry_output($output = null){
	$this->load->view('mem_entry.php', $output);
}
/************     Entry System for member end     *************/

/************     Account management System for member start     *************/
public function mem_manage_account()
{	
	$this->load->view('header_member');
	$crud = new grocery_CRUD();
	$crud->set_theme('datatables');
	
	$crud->set_table('booking');
	$crud->set_subject('Booking');
	$crud->fields('bookingNo', 'seatsRequired', 'bookingDate');
	$crud->required_fields('bookingNo', 'seatsRequired', 'bookingDate');
	$crud->display_as('bookingNo', 'Booking Number');
	
	$output = $crud->render();
	$this->mem_manage_account_output($output);
}
function mem_manage_account_output($output = null){
	$this->load->view('mem_manage_account.php', $output);
}
/************     Account management System for member end     *************/

/************     Booking Management System for member start     *************/
public function mem_manage_booking()
{	
	$this->load->view('header_member');
	$crud = new grocery_CRUD();
	$crud->set_theme('datatables');
	
	$crud->set_table('booking');
	$crud->set_subject('Booking');
	$crud->fields('bookingNo', 'seatsRequired', 'bookingDate');
	$crud->required_fields('bookingNo', 'seatsRequired', 'bookingDate');
	$crud->display_as('bookingNo', 'Booking Number');
	
	$output = $crud->render();
	$this->mem_manage_booking_output($output);
}
function mem_manage_booking_output($output = null){
	$this->load->view('mem_manage_booking.php', $output);
}
/************     Booking Management System for member end     *************/

/************     Search and Book System for member start     *************/
public function mem_search_book()
{	
	$this->load->view('header_member');
	$crud = new grocery_CRUD();
	$crud->set_theme('datatables');
	
	$crud->set_table('performance');
	$crud->set_subject('Performance');
	$crud->fields('perfNo', 'perfDate', 'startTime', 'seatsRemain');
	$crud->required_fields('perfNo', 'perfDate', 'startTime', 'seatsRemain');
	$crud->display_as('perfNo', 'Performance Number');
	
	$output = $crud->render();
	$this->mem_search_book_output($output);
}
function mem_search_book_output($output = null)
{
	$this->load->view('mem_search_book.php', $output);
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
}
