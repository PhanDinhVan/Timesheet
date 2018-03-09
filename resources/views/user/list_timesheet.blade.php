<link href="../css/datepicker/bootstrap-datepicker.css" rel="stylesheet">
<script src="../js/jquery/jquery.js"></script>
<script src="../js/datepicker/bootstrap-datepicker.js"></script>

<style type="text/css">
  #dayofweek{
    width: 10%; 
    margin-left: 10%; 
    text-align: center;
    /*float: left;*/
  }

  .foo p {
    font-size: 6vw;
    letter-spacing: 1vh;
  }

  .foo { 
    /*height: auto;
    position: relative;*/
    text-align: center;
    font-weight: bold;
  }

</style>

<div class="foo">
  <!-- <button id="add" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#yourModal" style="float: left;">
      Add Time <i class="mdi mdi-plus-circle-outline"></i>
  </button> -->
  <p>TIMESHEET</p>
</div>

<div class="form-group">
  <label style="width: 100%;">Today</label>
  <input class="date form-control" type="text" id="datepicker" style="width: 9%; float: left;">
  <label class="form-control" readonly="" id="dayofweek" type="text"></label>
</div>  
<!-- datepicker -->
<script type="text/javascript">
  $("#datepicker").datepicker({format: 'yyyy-mm-dd', autoclose: true}).datepicker("setDate", new Date());
  // $('.date').datepicker({  
  //    format: 'yyyy-mm-dd'
  //  });  
</script>

<div class="panel panel-default">
  <div class="panel-body" style="padding-top: 0px;">
    <div class="list_timesheet">
        
    </div>
  </div>
  
</div>
