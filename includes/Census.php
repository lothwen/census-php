<?		
/*
 * Census main class
 *
 */

class Census {

	function __construct(){
	
	}

	function getParam($param){
		if(isset($_POST[$param])) return $_POST[$param];
		elseif(isset($_GET[$param])) return $_GET[$param];
		else return "undefined";
	}

	function build_url($filename, $key, $value, $post=array()){
		
		$values = array();
  		$query_str = array();

  		//get the query string arguments and store them in the $values array
  		parse_str($_SERVER['QUERY_STRING'], $values);
  		
		//loop through the $values array and add the appropriate keys to the query string
  		foreach($values as $k=>$v){
    			//IF, though, a key in the existing query string matches the same key
    			//we're trying to add, ignore it, since we'll add it manually in a moment
    			//This prevents having multiples of the same keys
    			if($k!=$key)
      				$query_str[] = "{$k}={$v}";
    
  		}
  
  		// Add POST vars to the url
  		foreach($post as $k=>$v){
    			//IF, though, a key in the existing query string matches the same key
    			//we're trying to add, ignore it, since we'll add it manually in a moment
    			//This prevents having multiples of the same keys
    			if($k!=$key && $v!="")
		        	$query_str[] = "{$k}={$v}";
    
  		}

  		//add in our new key and value
  		$query_str[] = "{$key}={$value}";
  		
		//reconstruct the full URL using the implode() function to piece together all
  		//the query string values in the $query_string array, joining them together with "&"  
  		return "$filename?".implode("&", $query_str);
	}
}
?>
