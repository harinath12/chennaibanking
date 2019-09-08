<?php
include WP_CONTENT_DIR . '/themes/banking/ajax.php';

if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Lead_List_Table extends WP_List_Table {
	function __construct(){
        global $status, $page;
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'movie',     //singular name of the listed records
            'plural'    => 'movies',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );
        
    }

    function column_default($item, $column_name){
    	$item = (array) $item;
        switch($column_name){
            case 'gender':
            	$tmp = '<b>Gender</b>: '.$item['gender'].'<br><b>Dob</b>: '.$item['dob'].'<br><b>Zip</b>: '.$item['zip'].'<br>';
            	$tmp .= '<b>Occupation:</b> '.$item['occupation'].'<br>';
            	if($item['occupation'] == 'Salaried'){
            		$tmp .= '<b>Company:</b> '.$item['company'].'<br>';
            		$tmp .= '<b>Monthly Income:</b> '.$item['monthly'].'<br>';
            		$tmp .= '<b>Salary By:</b> '.$item['salary_by'].'<br>';
            	} else if($item['occupation'] == 'Self Employed'){
            		$tmp .= '<b>Latest Year Income after Tax:</b> '.$item['income'];
            	}
            	return $tmp;
            case 'email':
            	return $item['email'].'<br>'.$item['mobile'];
            case 'cc':
	            if($item['etype'] == 'Credit Card'){
	            	$tmp = '<b>Exist Credit Card</b> - '.$item['cc'].'<br>';
	            } else {
	            	$tmp = '<b>Exist Loan</b> - '.$item['cc'].'<br>';
	            }
	            if($item['cc'] == 'Yes'){
	            	$tmp .= '<b>Banks</b> - '.implode(',', unserialize($item['banks'])).'<br>';
            		if($item['etype'] == 'Credit Card'){
		            	$tmp .= '<b>Credit Limit</b> - '.$item['creditlimit'].'<br>';
		            } else {
		            	$tmp .= '<b>Emi</b> - '.$item['creditlimit'].'<br>';
		            }
	            }
                return $tmp;
            case 'language':
            	if($item['language'] == 'Others'){
            		return $item['otherlanguage'];
            	} else {
            		return $item[$column_name];
            	}
            case 'title':
            return $item['name'];    
            default:
                return $item[$column_name]; //Show the whole array for troubleshooting purposes
        }
    }

    function column_title($item){
        
        //Build row actions
        $actions = array(
            //'edit'      => sprintf('<a href="?page=%s&action=%s&movie=%s">Edit</a>',$_REQUEST['page'],'edit',$item['id']),
            //'delete'    => sprintf('<a href="?page=%s&action=%s&movie=%s">Delete</a>',$_REQUEST['page'],'delete',$item['id']),
        );
        
        //Return the title contents
        return sprintf('%1$s <span style="color:silver">(id:%2$s)</span>%3$s',
            /*$1%s*/ $item['name'],
            /*$2%s*/ $item['id'],
            /*$3%s*/ $this->row_actions($actions)
        );
    }

    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            /*$2%s*/ $item['id']                //The value of the checkbox should be the record's id
        );
    }

    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
            'title'     => 'Name',
            'email'    => 'Contact',
            'gender'  => 'About',
            'etype'	=> 'Lead Type',
            'cc' => 'Existing Card / Emi',
            'language' => 'Language',
            'enquiry_ts' => 'Enquiry Date'
        );
        return $columns;
    }

    function get_sortable_columns() {
        $sortable_columns = array(
            'title'     => array('name',false), 
            'enquiry_ts'  => array('enquiry_ts',false)
        );
        return $sortable_columns;
    }

    function get_bulk_actions() {
        $actions = array(
            'delete'    => 'Delete'
        );
        return $actions;
    }

    function process_bulk_action() {
    	global $wpdb;
        if( 'delete'===$this->current_action() ) {
            foreach ($_GET['movie'] as $key => $value) {
            	$wpdb->delete('wp_enquiry', array('id' => $value));
            }

            wp_redirect('?page=cb_leads');
        }
        
    }

    function object_to_array($data)
	{
	    if (is_array($data) || is_object($data))
	    {
	        $result = array();
	        foreach ($data as $key => $value)
	        {
	            $result[$key] = $this->object_to_array($value);
	        }
	        return $result;
	    }
	    return $data;
	}

    function prepare_items() {
        global $wpdb; 

        $per_page = 5;
        
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array($columns, $hidden, $sortable);
        
        $this->process_bulk_action();
        
        $data = $this->object_to_array($wpdb->get_results('select * from wp_enquiry order by id desc'));
               
        function usort_reorder($a,$b){
            $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'title'; 
            $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc'; 
            $result = strcmp($a[$orderby], $b[$orderby]); 
            return ($order==='asc') ? $result : -$result; 
        }
        usort($data, 'usort_reorder');
        
        $current_page = $this->get_pagenum();
        
        $total_items = count($data);
        
        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);
        
        $this->items = $data;
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  
            'per_page'    => $per_page,                     
            'total_pages' => ceil($total_items/$per_page)   
        ) );
    }
}

class Refer_List_Table extends WP_List_Table {
	function __construct(){
        global $status, $page;
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'movie',     //singular name of the listed records
            'plural'    => 'movies',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );
        
    }

    function column_default($item, $column_name){
    	$item = (array) $item;
        switch($column_name){
            case 'name':
            	$tmp = '<b>Name:</b> '.$item['name'].'<br>';
        		$tmp .= '<b>Email:</b> '.$item['email'].'<br>';
        		$tmp .= '<b>Phone:</b> '.$item['phone'];
            	return $tmp;
            case 'name2':
            	$tmp = '<b>Name:</b> '.$item['name2'].'<br>';
        		$tmp .= '<b>Email:</b> '.$item['email2'].'<br>';
        		$tmp .= '<b>Phone:</b> '.$item['phone2'];
            	return $tmp;   
            default:
                return $item[$column_name]; //Show the whole array for troubleshooting purposes
        }
    }

    function column_title($item){
        
        //Build row actions
        $actions = array(
            //'edit'      => sprintf('<a href="?page=%s&action=%s&movie=%s">Edit</a>',$_REQUEST['page'],'edit',$item['id']),
            //'delete'    => sprintf('<a href="?page=%s&action=%s&movie=%s">Delete</a>',$_REQUEST['page'],'delete',$item['id']),
        );
        
        //Return the title contents
        return sprintf('%1$s <span style="color:silver">(id:%2$s)</span>%3$s',
            /*$1%s*/ $item['name'],
            /*$2%s*/ $item['id'],
            /*$3%s*/ $this->row_actions($actions)
        );
    }

    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            /*$2%s*/ $item['id']                //The value of the checkbox should be the record's id
        );
    }

    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
            'name'     => 'Refer By',
            'name2'    => 'Referal Details',
            'more' => 'More Details',
            'refer_date' => 'Refer Date'
        );
        return $columns;
    }

    function get_sortable_columns() {
        $sortable_columns = array(
            'name'     => array('name',false), 
            'refer_date'  => array('refer_date',false)
        );
        return $sortable_columns;
    }

    function get_bulk_actions() {
        $actions = array(
            'delete'    => 'Delete'
        );
        return $actions;
    }

    function process_bulk_action() {
    	global $wpdb;
        if( 'delete'===$this->current_action() ) {
            foreach ($_GET['movie'] as $key => $value) {
            	$wpdb->delete('wp_referral', array('id' => $value));
            }

            wp_redirect('?page=cb_referrals');
        }
        
    }

    function object_to_array($data)
	{
	    if (is_array($data) || is_object($data))
	    {
	        $result = array();
	        foreach ($data as $key => $value)
	        {
	            $result[$key] = $this->object_to_array($value);
	        }
	        return $result;
	    }
	    return $data;
	}

    function prepare_items() {
        global $wpdb; 

        $per_page = 5;
        
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array($columns, $hidden, $sortable);
        
        $this->process_bulk_action();
        
        $data = $this->object_to_array($wpdb->get_results('select * from wp_referral order by id desc'));
               
        function usort_reorder($a,$b){
            $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'title'; 
            $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc'; 
            $result = strcmp($a[$orderby], $b[$orderby]); 
            return ($order==='asc') ? $result : -$result; 
        }
        usort($data, 'usort_reorder');
        
        $current_page = $this->get_pagenum();
        
        $total_items = count($data);
        
        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);
        
        $this->items = $data;
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  
            'per_page'    => $per_page,                     
            'total_pages' => ceil($total_items/$per_page)   
        ) );
    }
}

function cb_add_menu_items(){
    add_menu_page('Leads', 'Leads', 'activate_plugins', 'cb_leads', 'cb_render_list_page');
    add_menu_page('Referal List', 'Referal List', 'activate_plugins', 'cb_referrals', 'cb_refer_list_page');
} 
add_action('admin_menu', 'cb_add_menu_items');





/** *************************** RENDER TEST PAGE ********************************
 *******************************************************************************
 * This function renders the admin page and the example list table. Although it's
 * possible to call prepare_items() and display() from the constructor, there
 * are often times where you may need to include logic here between those steps,
 * so we've instead called those methods explicitly. It keeps things flexible, and
 * it's the way the list tables are used in the WordPress core.
 */
function cb_render_list_page(){
    
    //Create an instance of our package class...
    $testListTable = new Lead_List_Table();
    //Fetch, prepare, sort, and filter our data...
    $testListTable->prepare_items();
    
    ?>
    <div class="wrap">
        
        <div id="icon-users" class="icon32"><br/></div>
        <h2>Leads Table</h2>
        
        <form id="movies-filter" method="get">
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <?php $testListTable->display() ?>
        </form>
        
    </div>
    <?php
}

function cb_refer_list_page(){
    
    //Create an instance of our package class...
    $testListTable = new Refer_List_Table();
    //Fetch, prepare, sort, and filter our data...
    $testListTable->prepare_items();
    
    ?>
    <div class="wrap">
        
        <div id="icon-users" class="icon32"><br/></div>
        <h2>Referal Table</h2>
        
        <form id="movies-filter" method="get">
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <?php $testListTable->display() ?>
        </form>
        
    </div>
    <?php
}