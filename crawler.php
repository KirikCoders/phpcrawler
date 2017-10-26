<?php
include ('simple_html_dom.php');
function get_usn($usn)
{
    $url = "http://results.vtu.ac.in/cbcs_17/result_page.php";
    $postdata = "usn=".$usn; 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt ($ch, CURLOPT_POSTFIELDS,$postdata);  
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,0);
    curl_setopt($ch,CURLOPT_TIMEOUT,1000);
    $results = curl_exec($ch);
    curl_close ($ch);
    //$results = str_replace("<","&lt", $results);
    //$results = str_replace(">","&gt", $results);
    $html = new simple_html_dom();
    $html = str_get_html($results);
    $table_0 = $html->find('table',0);
    $rtt =array();
       foreach($table_0->find('td') as $li)
       {
             array_push($rtt,trim($li->innertext));;
             
             // echo("<html><br></html>");
       }
      
        $table_1 = $html->find('table',1);
    $rtt1=array();
       foreach($table_1->find('tr') as $li)
       {
        foreach($li->find('td') as $ti)
        {
             array_push($rtt1,trim($ti->innertext));;
             
             // echo("<html><br></html>");
       }
   }
       //for ($i=0;$i<135;$i++)
       //{
   $suba=$subb=$subc=$subd=$sube=$subf=$subg=$subh="";
   if($rtt[1]!="F -> FAIL,")
   {
       $usn=$rtt[1];
       $usn  =  str_replace(":","",$usn);
       $usn  =  str_replace("<b>","",$usn);
       $usn  =  str_replace("</b>","",$usn);
       
       if(isset($rtt1[4]) && $rtt1[0]=="15MAT41")
       {
       $suba=$rtt1[4];
       
     }
       if(isset($rtt1[10]))
       {
       $subb=$rtt1[10];
       
    }
       if(isset($rtt1[16]))
       {
       $subc=$rtt1[16];
        
      }
      if(isset($rtt1[22]))
       {
        
       $subd=$rtt1[22];
        }
        if(isset($rtt1[28]))
        {
        
       $sube=$rtt1[28];
        }
       if(isset($rtt1[34]))
       {
       
       $subf = $rtt1[34];
        }
       if(isset($rtt1[40]))
       {
       
       $subg=$rtt1[40];
         }
       if(isset($rtt1[46]))
       {
       $subh=$rtt1[46];
    }
    
}
    
     insert_data_into_db($usn,$suba,$subb,$subc,$subd,$sube,$subf,$subg,$subh);
    
}
function insert_data_into_db($usn,$suba,$subb,$subc,$subd,$sube,$subf,$subg,$subh)
{
    // echo "$usn    ";
    $sql ="INSERT INTO sem5 (usn,sub1,sub2,sub3,sub4,sub5,sub6,sub7,sub8)
VALUES ('$usn',$suba,$subb,$subc,$subd,$sube,$subf,$subg,$subh)";

    
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "exam";
        // Create connection
        $conn = new mysqli($host, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            echo "PAVAN";
        }
      
mysqli_query($conn, "INSERT INTO sem5 (usn,sub1,sub2,sub3,sub4,sub5,sub6,sub7,sub8)
VALUES ('$usn',$suba,$subb,$subc,$subd,$sube,$subf,$subg,$subh)");
    // if ($conn->query($sql)) {
    //   echo "New record created successfully";
    //   echo ("finished");
    //   }
    //   else{
    //     echo "Error";
    //   }
echo ".";
}

$region=$_POST['input1'];
$college=$_POST['input2'];
$batch=$_POST['input3'];
$branch=$_POST['input4'];
$startusn=$_POST['input5'];
$endusn=$_POST['input6'];
$start=$region.$college.$batch.$branch;
$start_seq = $start;
for ($i=$startusn;$i<$endusn;$i++)
{
    $j = strlen((string)$i);
    if( $j== 1)
    {
        $roll = "00".(string)$i;
    }
    if($j == 2)
    {
        $roll = "0".(string)$i;
        }
        if($j == 3)
    {
       $roll = (string)$i;
    }
    
    $usn = $start_seq.$roll;
    get_usn($usn);
    }
    header('Location: crawlerselect.php');
    ?>