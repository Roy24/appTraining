<?PHP
require_once("./alpha/alpha_init.php");

// Connect and interact with DB
class adb {

    // Connect to the db and check if it's ok
	// PDO instead
    function DBLogin()
    {
        $this->connection = mysql_connect(ADB_HOST,ADB_USER,ADB_PASSWORD);

        if(!$this->connection)
        {   
            $this->HandleDBError("Database Login failed! Please make sure that the DB login credentials provided are correct");
            return false;
        }
        if(!mysql_select_db(ADB_DATABASE, $this->connection))
        {
            $this->HandleDBError('Failed to select database: '.ADB_DATABASE.' Please make sure that the database name provided is correct');
            return false;
        }
        if(!mysql_query("SET NAMES 'UTF8'",$this->connection))
        {
            $this->HandleDBError('Error setting utf8 encoding');
            return false;
        }
        return true;
    }  


    // test search query    
    function aSearchQuery($search)
    {    
    	$tablename = 'phpbb_users';
		$field_val = $this->SanitizeForSQL($search);
        //$qry = "SELECT username FROM $tablename WHERE username_clean LIKE '%".$field_val."%' order by username limit 6";
		
        $result = mysql_query($qry,$this->connection);
        if($result && mysql_num_rows($result) < 1)
        {
            return false;
        }
	$html_result;
	while($row=mysql_fetch_array($result))
	    {
		$r_array[]  = $row['username'];	
		$html_result .= $row['username'] . "<br />";
	    }
	//echo json_encode($r_array);
        return $html_result;
    }


    // Handle MYSQL errors
    function HandleDBError($err)
    {
        $this->HandleError($err."\r\n mysqlerror:".mysql_error());
    }

//Sanitize for SQL injection
    function SanitizeForSQL($str)
    {
        if( function_exists( "mysql_real_escape_string" ) )
        {
              $ret_str = mysql_real_escape_string( $str );
        }
        else
        {
              $ret_str = addslashes( $str );
        }
        return $ret_str;
    }
    
 /*
    Sanitize() function removes any potential threat from the
    data submitted. Prevents email injections or any other hacker attempts.
    if $remove_nl is true, newline chracters are removed from the input.
    */
    function Sanitize($str,$remove_nl=true)
    {
        $str = $this->StripSlashes($str);

        if($remove_nl)
        {
            $injections = array('/(\n+)/i',
                '/(\r+)/i',
                '/(\t+)/i',
                '/(%0A+)/i',
                '/(%0D+)/i',
                '/(%08+)/i',
                '/(%09+)/i'
                );
            $str = preg_replace($injections,'',$str);
        }

        return $str;
    }    
    function StripSlashes($str)
    {
        if(get_magic_quotes_gpc())
        {
            $str = stripslashes($str);
        }
        return $str;
    }  

}

?>
