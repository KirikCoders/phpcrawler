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
   if($rtt[1]!="F -> FAIL,")
   {

       echo $rtt[1];
       echo("                       ");
       if(isset($rtt1[4]))
       {
       echo $rtt1[4];
       echo("                       ");
     }
       if(isset($rtt1[10]))
       {
       echo $rtt1[10];
       echo("                       ");
    }
       if(isset($rtt1[16]))
       {
       echo $rtt1[16];
        echo("                       ");
      }
      if(isset($rtt1[22]))
       {
        echo("                       ");
       echo $rtt1[22];
        }
        if(isset($rtt1[28]))
        {
        echo("                       ");
       echo $rtt1[28];
        }
       if(isset($rtt1[34]))
       {
       echo("                       ");
       echo $rtt1[34];
        }
       if(isset($rtt1[40]))
       {
       echo("                       ");
       echo $rtt1[40];
         }
       if(isset($rtt1[46]))
       {
       echo("                       ");
       echo $rtt1[46];
    }
       
       }






}
$start_seq = "1BI15CS";
for ($i=0;$i<200;$i++)
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
    ?>
