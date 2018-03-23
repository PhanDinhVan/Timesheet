<link href="../css/datepicker/bootstrap-datepicker.css" rel="stylesheet">
<script src="../js/jquery/jquery.js"></script>
<script src="../js/datepicker/bootstrap-datepicker.js"></script>

<style type="text/css">

    .foo p {
        font-size: 6vw;
        letter-spacing: 1vh;
    }

    .foo { 
        text-align: center;
        font-weight: bold;
    }

    #hidden {
        visibility: hidden;
    }

    .dayofweek {
        float: left;
    }

    .dayofweek input, label {
        text-align: center;
    }

</style>

<div class="foo">
  <p>TIMESHEET</p>
</div>
<div class="form-group row">
    <div class=" col-md-6">
        <div class=" col-md-3 dayofweek">
            <label class="col-form-label">Today</label>
            <input class="form-control date" type="text" id="datepicker">
            
        </div>

        <div class="col-md-3 dayofweek">
            <label class="col-form-label" id="hidden">hidden</label>
            <label class="form-control" readonly="" id="dayofweek" type="text"></label>
        </div>
    </div>
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
