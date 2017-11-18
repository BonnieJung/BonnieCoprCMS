<?php
	function confirm_query($result_set){
		if(!@reslt_set){
			die("Database query failed.");
		}
	}
	function find_all_subjects(){
	global $connection;
	$query  = "SELECT * ";
	$query .= "FROM subjects ";
	$query .= "WHERE visible = 1 ";
	$query .= "ORDER BY position ASC";
	$subject_set = mysqli_query($connection, $query);
	// Test if there was a query error
	confirm_query($subject_set);
	return $subject_set;
	}
	
	function find_page_by_id($subject_id){
	global $connection;
	$query  = "SELECT * ";
	$query .= "FROM pages ";
	$query .= "WHERE visible = 1 "; 
	$query .= "AND subject_id = {$subject_id} ";
	$query .= "ORDER BY position ASC ";
	$page_set = mysqli_query($connection, $query);
	// Test if there was a query error
	confirm_query($page_set);
	return $page_set;
	
	}
	
	//navigation takes 2 arguments
	// - the currently selected subject ID (if any)
	// - the currently selected page ID (if any)
	function navigation($subject_id, $page_id) {
	$output = "<ul class = \"subjects\">";
	// 2. Perform database query
	$subject_set = find_all_subjects();
			// 3. Use returned data (if any)
			while($subject = mysqli_fetch_assoc($subject_set)) {
				$output .= "<li ";
				if($subject_id == $subject["id"]){
					$output .= "class =\"selected\" ";
				}  
				$output .= ">";
				$output .= "<a href=\"manage_content.php?subject=";
				$output .= urlencode($subject["id"]);
				$output .= "\">";
				$output .= $subject["menu_name"]; 
				$output .= "</a>";
		
				// 2. Perform database query
				$page_set = find_page_by_id($subject["id"]);
			
				$output .= "<ul class=\"pages\">";
						
				while($page = mysqli_fetch_array($page_set)){ 
					$output .= "<li ";
					if($page_id == $page["id"]){
						$output .= "class =\"selected\" ";
					}  
					$output .= ">"; 
					$output .= "<a href=\"manage_content.php?page=";
					$output .= urlencode($page["id"]);  
					$output .= "\">";
					$output .= $page["menu_name"]; 
					$output .= "</a></li>";
				}//end fo page while
					mysqli_free_result($page_set);
					$output .= "</ul></li>";
			}//end of subject while
			// 4. Release returned data
			mysqli_free_result($subject_set);
			$output .="</ul>";
			return $output;
	}//end of nav function
	
	?>

