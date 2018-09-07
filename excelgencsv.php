<head>
<h2 id='k'></h2>
<script>
function startt()
			{
		//for (i=1;i<=2;i++)
			//alert('excelgen.php?count='+i)
			document.getElementById('k').innerHTML='In Progress..............Please wait';
			window.location.href='excelgencsv.php?sta=yes';
			
			}
</script>
<?php
// Connection 
function sanitizze($finename)
  {
  
 
  $file_save=fopen('downloaded/'.$finename,"w+");
  flock($file_save,LOCK_EX);
  fputs($file_save,"");
  
  flock($file_save,LOCK_UN);
  fclose($file_save);
  }
function store2debug($contentt,$finename)
  {
  
 
  $file_save=fopen('downloaded/'.$finename,"a+");
  flock($file_save,LOCK_EX);
  fputs($file_save,$contentt."\n");
  
  flock($file_save,LOCK_UN);
  fclose($file_save);
  }

  function readdb($fil="listofiles.txt")
	{
		$entire_file=file($fil,FILE_IGNORE_NEW_LINES);
		return $entire_file;
	}



if (isset($_REQUEST['sta']))              {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "KSHB";
	$cntout=1;
	//$cntout=$_REQUEST['count'];
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
    			die("Connection failed: " . $conn->connect_error);
				   			  }
    //$query="select ps_nm,ps_idn from prsnl_infrmtn_systm where ps_nm like 'K%' and ps_flg='W'";
				   			  /*
    if($cntout==1){
		$query="show tables";
		$result = $conn->query($query);
		while($row = $result->fetch_assoc())
		{
		foreach($row as $key=>$val)
		{
		store2debug($val);
		}
		}         }
		*/
		$countt=0;
		//echo '<h2>In Progress Please wait............</h2>';
    foreach (readdb() as $elem)
        {
        	//echo "<script>";
        	//echo "document.getElementById('emp').innerHTML='In Progress';";
        	//echo "<script>";
        	$countt+=1;
        	//if ($countt!=$cntout)
        	//	continue;
        	//if ($countt>3) break;
        	$query="select * from ".$elem;
	
			
			
			 
			
			if(!($result = $conn->query($query))) die ($conn->error);
 	
	$filename = $elem.".csv"; // File Name
	sanitizze($filename);
	//store2debug("hello",$filename);break;
	//die($filename)
	//header("Content-Disposition: attachment; filename=\"$filename".$cntout.".xls\"");
	//header("Content-Type: application/vnd.ms-excel");
	
	
	
	$firstrow=True;
	$emptstr="";
			//echo '<table>';
			while($row = $result->fetch_assoc())
				{   $rowsel=0;
					if ($firstrow)
					{ $emptstr="";
					//echo '<tr>';
					foreach($row as $key=>$val)
						{
					$rowsel+=1;
					//if (($rowsel%2)==0)									
                    $emptstr.=($key.",");
                    	}				
					store2debug(substr($emptstr,0,strlen($emptstr)-1)."",$filename);
				    }  
				    $firstrow=False;
				    $rowsel=0;
				    //echo '<tr>';
				    $emptstr="";
					foreach($row as $key=>$val)	
						{	
					$rowsel+=1;		
					//if (($rowsel%2)==0)						
                    $emptstr.=($val.",");
                    	}				
					store2debug(substr($emptstr,0,strlen($emptstr)-1)."",$filename);
					
				}  if ($countt>5 ) break;

		}
			echo '<h1>Process Complete Check Output</h1>';  
			//echo "<script>";
        	//echo "document.getElementById('emp').innerHTML='Done';";
        	//echo "<script>";
			                                                          }
			
?>

</head>

<body>
<button type= 'button' id='bu' onclick="startt()">Start Generation</button>
</body>