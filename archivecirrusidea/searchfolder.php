<?php
  
$root = realpath($_SERVER["DOCUMENT_ROOT"]);  

  // Start the session
  require_once($root.'/startsession.php');

  // Insert the page header
  $page_title = 'Search Folder';
  require_once($root.'/header.php');

  require_once($root.'/appvars.php');
  require_once($root.'/connectvars.php');
 
  if (!isset($_SESSION['user_id'])) {

	echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';

    exit();
  
  }

  // Show the navigation menu
  require_once($root.'/navmenu.php');
 
 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
 
  // This function builds a search query from the search keywords and sort setting
  function build_query($user_search, $sort) {
    $search_query = "SELECT * FROM cbpfiles";

    // Extract the search keywords into an array
    $clean_search = str_replace(',', ' ', $user_search);
    $search_words = explode(' ', $clean_search);
    $final_search_words = array();
    if (count($search_words) > 0) {
      foreach ($search_words as $word) {
        if (!empty($word)) {
          $final_search_words[] = $word;
        }
      }
    }

    // Generate a WHERE clause using all of the search keywords
    $where_list = array();
    if (count($final_search_words) > 0) {
      foreach($final_search_words as $word) {
        $where_list[] = "file_name LIKE '%$word%'";
      }
    } 
    $where_clause = implode(' OR ', $where_list);

    // Add the keyword WHERE clause to the search query
    if (!empty($where_clause)) {
      $search_query .= " WHERE $where_clause";
    }
	 
	
    // Sort the search query using the sort setting
    switch ($sort) {
    // Ascending by job title
    case 1:
      $search_query .= " ORDER BY file_id";
      break;
    // Descending by job title
    case 2:
      $search_query .= " ORDER BY file_id DESC";
      break;
    // Ascending by date posted (oldest first)
	default:
      // No sort setting provided, so don't sort the query
    }

    return $search_query;
  }

  // This function builds heading links based on the specified sort setting
  function generate_sort_links($user_search, $sort) {
    $sort_links = '';

    switch ($sort) {
    case 1:
      $sort_links .= '<td><b><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=2">Link</a></b></td><td><b>Folder Path</b></td>';
  
      break;
    case 3:
      $sort_links .= '<td><b><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=1">Link</a></b></td><td><b>Folder Path</b></td>';
   
      break;

    default:
      $sort_links .= '<td><b><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=1">Link</a></b></td><td><b>Folder Path</b></td>';
 
    }

    return $sort_links;
  }

  // This function builds navigational page links based on the current page and the number of pages
  function generate_page_links($user_search, $sort, $cur_page, $num_pages) {
    $page_links = '';

    // If this page is not the first page, generate the "previous" link
    if ($cur_page > 1) {
      $page_links .= '<a href="' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=' . $sort . '&page=' . ($cur_page - 1) . '"><-</a> ';
    }
    else {
      $page_links .= '<- ';
    }

    // Loop through the pages generating the page number links
    for ($i = 1; $i <= $num_pages; $i++) {
      if ($cur_page == $i) {
        $page_links .= ' ' . $i;
      }
      else {
        $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=' . $sort . '&page=' . $i . '"> ' . $i . '</a>';
      }
    }

    // If this page is not the last page, generate the "next" link
    if ($cur_page < $num_pages) {
      $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=' . $sort . '&page=' . ($cur_page + 1) . '">-></a>';
    }
    else {
      $page_links .= ' ->';
    }

    return $page_links;
  }

  // Grab the sort setting and search keywords from the URL using GET

  $user_search = $_POST['usersearch'];

   if(isset($_GET['usersearch'])){
       $user_search = $_GET['usersearch'];
  }
 
?>

<br />
  <form method="post" action="searchfolder.php" style="text-align:center;">
    <label for="usersearch">CirrusIdea Folder Search: </label>
    <input type="text" id="usersearch" name="usersearch" <?php if (isset($user_search)) echo 'value="'. $user_search. '"'; ?> /><br />
    <input type="submit" name="submit" value="Submit" />
  </form>

<?php


  // Calculate pagination information
  $cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $results_per_page = 20;  // number of results per page
  $skip = (($cur_page - 1) * $results_per_page);
 $sort = $_GET['sort'];
  // Start generating the table of results
  echo '<br /><br /><table class="brain_table" width="75%">';

  // Generate the search result headings
  echo '<tr>';
  echo generate_sort_links($user_search, $sort);
  echo '</tr>';

  // Connect to the database
  require_once('connectvars.php');
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
  // Query to get the total results 
  $query = build_query($user_search, $sort);
  
  $result = mysqli_query($dbc, $query);
  $total = mysqli_num_rows($result);
  $num_pages = ceil($total / $results_per_page);

  // Query again to get just the subset of results
  $query =  $query . " LIMIT $skip, $results_per_page";
  $result = mysqli_query($dbc, $query);
  while ($row = mysqli_fetch_array($result)) {

	$show=0;

		if ($row['file_private']=='1'){

		$query99 = "SELECT user_name FROM folderprivacy WHERE folderID ='"  . $row['file_id'] . "'";
  		$data99 = mysqli_query($dbc, $query99);
    
 		while($row99 = mysqli_fetch_array($data99)){
 		if($row99['user_name']==$_SESSION['username']){
 		$show=1;
 		break;
 		 }
 		}
             }else{
		$show=1;
		}

if($show==1){ 

    echo '<tr>';
    echo '<td valign="top" width="20%"><a href="http://www.cirrusidea.com' . $row['file_path'] . '/' . $row['file_name'] . '">' . $row['file_name'] . '</a></td>';
    echo '<td valign="top" width="80%">' . substr($row['file_path'], 0, 300) . '/' . $row['file_name']. '...</td>';
    echo '</tr>';
}


  } 
  echo '</table>';

  // Generate navigational page links if we have more than one page
  if ($num_pages > 1) {
     echo '<p style="text-align:center">';
    echo generate_page_links($user_search, $sort, $cur_page, $num_pages);
	echo '</p>';
  }

  mysqli_close($dbc);


echo '<br /><br /><br /><br /><br /><br /><br /><br /><br />';
 
  // Insert the page footer
  require_once($root.'/footer.php');
 ?>
 
 