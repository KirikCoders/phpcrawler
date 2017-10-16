<?php
//YOU HAVE TO DOWNLOAD THIS FILE AND INCLUDE IN YOUR CODE FOLDER
//ITS A HEADER USED TO PARSE HTML 
include ('simple_html_dom.php');

//IVE USED A FUNCTION GET USN
//GO DOWN TO FIND OUT WHAT IM PASSING
function get_usn($usn)
{
    //THE URL
    $url = "http://results.vtu.ac.in/cbcs_17/result_page.php";
    //THE USN PASSED
    $postdata = "usn=".$usn;
    //INITIALIZE CURL OBJECT WHICH IS AN API TO DO CRAWLLING FUCTIONS 
    $ch = curl_init();
    // ACCESSING URL BY PASSING URL TO THE CURL OBJECT $CH
    curl_setopt($ch, CURLOPT_URL, $url);
    // FOR CURL TO ACTUALLY RETURN SOMETHING RATHER THAN JUST PROCESSING AND UTILIZE THE RESULT SET 1 FOR TRUE
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
    //HERE WE ARE PASSING THE USN INTO THE FORM BASICALLY CURL GOES TO THE FORM INSERTS THE USN AND OPENS THE RESULT PAGE
    curl_setopt ($ch, CURLOPT_POSTFIELDS,$postdata);  
    curl_setopt ($ch, CURLOPT_POST, 1);
    //SETTING TO TRUE
    //THE BROWSER TIMING IS LIMITED HENCE WE HAVE TO SET THE TIME FOR THE CURL OPERATIONS TO CONTINUE
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,0);
    curl_setopt($ch,CURLOPT_TIMEOUT,1000);
    //EXECUTING THE CURL OBJECT
    //SINCE WE HAD ALLOWED RESTURN TRANSEFER WE CAN RETURN VALUE TO RESULTS

    $results = curl_exec($ch);
    //CLOSE THE CURL SESSION
    curl_close ($ch);
    //$results = str_replace("<","&lt", $results);
    //$results = str_replace(">","&gt", $results);

    // HERE WE ARE USING THE HEADER PROVIDED FUCTIONS TO CONVERT THE EXTRACTED DATA TO HTML TO SEE WHATS THERE IN RESULTS ECHO RESULTS AND TYPE EXIT;
    $html = new simple_html_dom();

    $html = str_get_html($results);
    //HERE WE ARE FINDING THE TABLE 0 WHICH MEANS THE FIRST TABLE <TAG> PRESENT IN THE HTML FILE WITH THE HELP OF DOM PARSER I GUESS WE HAVE 3 TABLES 1 FOR 
    //USN AND NAME 1 FOR RESULTS 1 FOR DESCRIPTIONS
    // WE ARE CONSIDERING FIRST TABLE WHICH IS NAME AND USN 
    $table_0 = $html->find('table',0);
    $rtt =array();
   // STORE THE OCCURENCES OF TD IN TABLE O TO AN ARRAY NOTE WE HAVE TO APPEND IT RATHER THAN ADD IT ELSE IT WILL GET REPLACED BY THE LAST THING TRAVERSED
       foreach($table_0->find('td') as $li)
       {
             array_push($rtt,trim($li->innertext));;
             
             // echo("<html><br></html>");
       }

      


//TO FIND SECOND TABLE JUST THE REULTS TABLE
        $table_1 = $html->find('table',1);
    $rtt1=array();
    //HERE WE ARE USING TABLE_1 OBJECT TO FIND OCCURENCES OF TAG<TR> THAT IS ROW
       foreach($table_1->find('tr') as $li)
       {
        //USING ROWS WE ARE TRAVERSING COLUMNS
        foreach($li->find('td') as $ti)
        {
            //AND PUSING WHATEVERS THERE INSIDE TD INTO AN ARRAY(AGAIN IT IS APPENDING)
             array_push($rtt1,trim($ti->innertext));;
             
             // echo("<html><br></html>");
       }
   }
       //for ($i=0;$i<135;$i++)
       //{

   //THIS BELOW CODE IS TO FILTER UNWANTED STUFF INCLUDED IN TD TAGS

   $suba=$subb=$subc=$subd=$sube=$subf=$subg=$subh="";//*******
   if($rtt[1]!="F -> FAIL,")
   {
//AGAIN FILTERING BY REMOVING : <B> </B>
       $usn=$rtt[1];
       $usn  =  str_replace(":","",$usn);
       $usn  =  str_replace("<b>","",$usn);
       $usn  =  str_replace("</b>","",$usn);

// CHECKING IF THAT ARRAY ACTUALLY HAS ANYTHING IN THAT INDEX
       //ELSE ASSIGNED WITH NULL AS GIVEN ABOVE******
       
       if(isset($rtt1[4]))
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




//PASS TO FUNCTION TO INSERT INTO DATABASE
    

     insert_data_into_db($usn,$suba,$subb,$subc,$subd,$sube,$subf,$subg,$subh);
    

}

function insert_data_into_db($usn,$suba,$subb,$subc,$subd,$sube,$subf,$subg,$subh)
{
    // echo "$usn    ";
    //THIS IS THE SQL COMMAND
    $sql ="INSERT INTO sem5 (usn,sub1,sub2,sub3,sub4,sub5,sub6,sub7,sub8)
VALUES ('$usn',$suba,$subb,$subc,$subd,$sube,$subf,$subg,$subh)";
    //TO CONNECT TO A DATABASE
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "exam";

        // Create connection
        $conn = new mysqli($host, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
       
        }
      //EXECUTE QUERY
mysqli_query($conn, "INSERT INTO sem5 (usn,sub1,sub2,sub3,sub4,sub5,sub6,sub7,sub8)
VALUES ('$usn',$suba,$subb,$subc,$subd,$sube,$subf,$subg,$subh)");
    // if ($conn->query($sql)) {
    //   echo "New record created successfully";
    //   echo ("finished");
    //   }
    //   else{
    //     echo "Error";
    //   }

echo "INSERTED";

//GETS RETURNED TO GETUSN WHICH INTURN RETURNS TO THE FOR LOOP EXECUTING USN SERIES

}


//THIS IS THE START
//IM FINDING USN SERIES
$start_seq = "1BI15CS";
for ($i=1;$i<200;$i++)
{
    $j = strlen((string)$i);
    //IF THE USN IS 1 LENGTH APPEN 00 TO MAKE IT 001
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
    //APPEND THE START
    $usn = $start_seq.$roll;
    //CALL FUNCTION BY PASSING USN
    get_usn($usn);
    
    }

    // ALSO CREATE A DATA BASE FIRST AND THEN EXECUTE
    //AT EACH STATEMENT ECHO AND FIND OUT WHATS HAPPENING
    //OR USE PRINT_R;
    ?>




