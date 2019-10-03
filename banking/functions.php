<?php
include WP_CONTENT_DIR . '/themes/banking/ajax.php';

if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
add_action( 'after_setup_theme', 'register_my_menu' );
function register_my_menu() {
  register_nav_menu( 'primary', __( 'Primary Menu', 'theme-slug' ) );
}

add_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );

    function wpdocs_set_html_mail_content_type() {
        return 'text/html';
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
            case 'lar':
            if($item['etype'] == 'Business Loan'){
                 $tmp .='<b>Loan amount Required:</b>'.$item['lar'].'<br>'.'<b>Company Type:</b>'.$item['cmpytype'];
             }
                 return $tmp;
            case 'cc':
                if($item['etype'] == 'Business Loan'){
                    $tmp .='<b>Current Account Maintained In:</b>'.$item['cab'].'<br>'.'<b>Latest year profit as per ITR:</b>'.$item['profit'];
                 }
	            else if($item['etype'] == 'Credit Card'){
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
            case 'mobile_verified':
                return $item['mobile_verified'] ? 'Yes' : 'No'; 
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
            'lar' => 'Loan Details',
            'cc' => 'Account Details',
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

class Bank_List_Table extends WP_List_Table {
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
            'name'     => 'Bank Name'
        );
        return $columns;
    }

    function get_sortable_columns() {
        $sortable_columns = array(
            'name'     => array('name',false)
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
                $banks = get_option('cb_banks');
                $banks = $banks ? $banks : [];
                $newbank = [];
                foreach ($banks as $key1 => $value1) {
                    if($value != $value1['id']){
                        $newbank[] = $value1;
                    }
                }
                update_option('cb_banks', $newbank);
            }

            wp_redirect('?page=cb_bank');
        }
        
    }

    function prepare_items() {
        global $wpdb; 

        $per_page = 20;
        
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array($columns, $hidden, $sortable);
        
        $this->process_bulk_action();
        
        $data = get_option('cb_banks');

        $data = $data ? $data : [];
               
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

class Area_List_Table extends WP_List_Table {
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
            'name'     => 'Area Name',
            'pin'     => 'Pin Code'
        );
        return $columns;
    }

    function get_sortable_columns() {
        $sortable_columns = array(
            'name'     => array('name',false),
            'pin'     => array('pin',false)
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
                $banks = get_option('cb_area');
                $banks = $banks ? $banks : [];
                $newbank = [];
                foreach ($banks as $key1 => $value1) {
                    if($value != $value1['id']){
                        $newbank[] = $value1;
                    }
                }
                update_option('cb_area', $newbank);
            }

            wp_redirect('?page=cb_area');
        }
        
    }

    function prepare_items() {
        global $wpdb; 

        $per_page = 20;
        
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array($columns, $hidden, $sortable);
        
        $this->process_bulk_action();
        
        $data = get_option('cb_area');

        $data = $data ? $data : [];
               
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
    add_menu_page('Chennai Banking', 'Chennai Banking', 'activate_plugins', 'cb_leads', 'cb_render_list_page');
    add_submenu_page('cb_leads', 'Leads', 'Leads', 'activate_plugins', 'cb_leads', 'cb_render_list_page');
    add_submenu_page('cb_leads', 'Referal List', 'Referal List', 'activate_plugins', 'cb_referrals', 'cb_refer_list_page');
    add_submenu_page('cb_leads', 'Bank List', 'Bank List', 'activate_plugins', 'cb_bank', 'cb_bank_list_page');
    add_submenu_page('cb_leads', 'Area List', 'Area List', 'activate_plugins', 'cb_area', 'cb_area_list_page');
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

if(isset($_POST['banksubmit'])){
    $banks = get_option('cb_banks');

    $banks = $banks ? $banks : [];

    $banks[] = array('id' => strtotime('now'), 'name' => $_POST['name']);

    update_option('cb_banks', $banks);

    wp_redirect('admin.php?page=cb_bank');
}

function cb_bank_list_page(){
    
    //Create an instance of our package class...
    $testListTable = new Bank_List_Table();
    //Fetch, prepare, sort, and filter our data...
    $testListTable->prepare_items();

    ?>
    <div class="wrap">
        
        <div id="icon-users" class="icon32"><br/></div>
        <h2>Bank List</h2>
        
        <div id="col-container" class="wp-clearfix">
            <div id="col-left">
                <div class="col-wrap">
                    <div class="form-wrap">
                    <h2>Add New Bank</h2>
                        <form id="addtag" method="post" class="validate">
                            <div class="form-field form-required term-name-wrap">
                                <label for="tag-name">Bank Name</label>
                                <input name="name" id="tag-name" type="text" value="" size="40" aria-required="true">
                            </div>
                            <p class="submit"><input type="submit" name="banksubmit" id="submit" class="button button-primary" value="Add New"></p>
                        </form>
                    </div>
                </div>
            </div><!-- /col-left -->

            <div id="col-right">
                <div class="col-wrap">

                    <form id="movies-filter" method="get">
                        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
                        <?php $testListTable->display() ?>
                    </form>
                </div>
            </div><!-- /col-right -->

        </div>
        
    </div>
    <?php
}

if(isset($_POST['areasubmit'])){
    $banks = get_option('cb_area');

    $banks = $banks ? $banks : [];

    $banks[] = array('id' => strtotime('now'), 'name' => $_POST['name'], 'pin' => $_POST['pin']);

    update_option('cb_area', $banks);

    wp_redirect('admin.php?page=cb_area');
}

function cb_area_list_page(){
    
    //Create an instance of our package class...
    $testListTable = new Area_List_Table();
    //Fetch, prepare, sort, and filter our data...
    $testListTable->prepare_items();

    ?>
    <div class="wrap">
        
        <div id="icon-users" class="icon32"><br/></div>
        <h2>Area List</h2>
        
        <div id="col-container" class="wp-clearfix">
            <div id="col-left">
                <div class="col-wrap">
                    <div class="form-wrap">
                    <h2>Add New Area</h2>
                        <form id="addtag" method="post" class="validate">
                            <div class="form-field form-required term-name-wrap">
                                <label for="tag-name">Area Name</label>
                                <input name="name"  type="text" value="" size="40" aria-required="true">
                            </div>
                            <div class="form-field form-required term-name-wrap">
                                <label for="tag-name">Pin Code</label>
                                <input name="pin"  type="text" value="" size="40" aria-required="true">
                            </div>
                            <p class="submit"><input type="submit" name="areasubmit" id="submit" class="button button-primary" value="Add New"></p>
                        </form>
                    </div>
                </div>
            </div><!-- /col-left -->

            <div id="col-right">
                <div class="col-wrap">

                    <form id="movies-filter" method="get">
                        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
                        <?php $testListTable->display() ?>
                    </form>
                </div>
            </div><!-- /col-right -->

        </div>
        
    </div>
    <?php
}