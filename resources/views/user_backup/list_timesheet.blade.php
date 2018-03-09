<link href="css/datepicker/bootstrap-datepicker.css" rel="stylesheet">
<script src="js/jquery/jquery.js"></script>
<script src="js/datepicker/bootstrap-datepicker.js"></script>

<style type="text/css">
	@import url(https://fonts.googleapis.com/css?family=Lato:900);
*, *:before, *:after{
  box-sizing:border-box;
}
/*body{
  font-family: 'Lato', sans-serif;
    ;
}*/
div.foo{
  width: 90%;
  margin: 0 auto;
  text-align: center;
}
.letter{
  display: inline-block;
  font-weight: 900;
  font-size: 6em;
  margin: 0.2em;
  position: relative;
  color: #00B4F1;
  transform-style: preserve-3d;
  perspective: 400;
  z-index: 1;
}
.letter:before, .letter:after{
  position:absolute;
  content: attr(data-letter);
  transform-origin: top left;
  top:0;
  left:0;
}
.letter, .letter:before, .letter:after{
  transition: all 0.3s ease-in-out;
}
.letter:before{
  /*color: #fff;*/
  color: green;
  text-shadow: 
    -1px 0px 1px rgba(255,255,255,.8),
    1px 0px 1px rgba(0,0,0,.8);
  z-index: 3;
  transform:
    rotateX(0deg)
    rotateY(-15deg)
    rotateZ(0deg);
}
.letter:after{
  color: rgba(0,0,0,.11);
  z-index:2;
  transform:
    scale(1.08,1)
    rotateX(0deg)
    rotateY(0deg)
    rotateZ(0deg)
    skew(0deg,1deg);
}
.letter:hover:before{
  color: #fafafa;
  transform:
    rotateX(0deg)
    rotateY(-40deg)
    rotateZ(0deg);
}
.letter:hover:after{
  transform:
    scale(1.08,1)
    rotateX(0deg)
    rotateY(40deg)
    rotateZ(0deg)
    skew(0deg,22deg);
}
#dayofweek{
  width: 10%; 
  margin-left: 10%; 
  text-align: center;
  /*float: left;*/
}
</style>

<div class="foo">
  <span class="letter" data-letter="T">T</span>
  <span class="letter" data-letter="I">I</span>
  <span class="letter" data-letter="M">M</span>
  <span class="letter" data-letter="E">E</span>
  <span class="letter" data-letter="S">S</span>
  <span class="letter" data-letter="H">H</span>
  <span class="letter" data-letter="E">E</span>
  <span class="letter" data-letter="E">E</span>
  <span class="letter" data-letter="T">T</span>
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
  <div class="panel-body" style="padding-bottom: 0px;">
    <form action="user/search" method="POST" style="float: right;">
      <table>
        <tr>
          <td>
            <!-- <input id="searchItem" type="search" name="searchItem" class="form-control" placeholder="Search"> -->
          </td>
        </tr>
      </table>
    </form>
  </div>
  <div class="panel-body" style="padding-top: 0px;">
    <div class="table-responsive">
        
    </div>
  </div>
  
</div>
