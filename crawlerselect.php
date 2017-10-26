<html>
<head>
  <title>crawler</title>
</head>


<style>




input[type=text], input[type=password] {
    width: 100%;
    padding: 7px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #009933;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.9;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: green;
}

.container1 {
    padding: 16px;
}


.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 50px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
<body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<div class="container-fluid ">    
 

   <div class="col-sm-5">
   <h2>select attributes</h2>
   
   
<form  method="POST" action="crawler.php">
  
  <div class="row">
 <div class="form-group col-md-6">
      <label >REGION</label>
      <select name="input1"  class="form-control">
        <option value="1">BANGALORE</option>
      </select>
    </div>
</div>
<div class="row">
<div class="form-group col-md-6">
      <label >COLLEGE</label>
      <select  name="input2" class="form-control">
        
        <option value="BI">BIT</option>
      </select>
    </div> 
  </div>
    <div class="row">
    <div class="form-group col-md-6">
      <label >BATCH</label>
      <select name="input3" class="form-control">
        <option value="15">15</option>
      </select>
    </div>
  </div>
    <div class="row">
    <div class="form-group col-md-6">
      <label >BRANCH</label>
      <select name="input4" class="form-control">
       
        <option value="CS">CS</option>
      </select>
    </div>
  </div>
    <div class="row">
    <div class="form-group col-md-6">
      <label >START USN</label>
      <input type="text" name="input5" required>
      </select>
    </div>
  </div>
    <div class="row">
    <div class="form-group col-md-6">
      <label >END USN</label>
      <input type="text" name="input6" required>
    </div>
  </div>
  
  <div class="row" >
    <div class="form-group col-md-1">
  
  <button type="submit" class="cancelbtn">crawl</button>
  <br>
  <br>

 <a href="excel.php"> <button type="button" class="cancelbtn">generate excel</button>
</div>
</div>
</form>
</div>

</body>
</html>