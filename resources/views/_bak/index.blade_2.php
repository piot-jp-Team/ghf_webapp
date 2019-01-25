@extends('layouts.app')

@section('content')
      <div class="row">
       <div class="col-md-10 col-md-offset-1">
		   

{!! Form::open(['class' => 'form-inline','id' => 'prjselectform','name' => 'prjselectform']) !!}
{{ csrf_field() }}
	<div class="form-group">
		<!-- <label class="control-label" for="usage1select3">プロジェクト</label> -->
<?php
echo '<select  class="form-control form-group-lg" style="height: 34px;" id = "prjid" name="projectid">';
foreach ($projectatusers as $key => $value) {
echo "<option ";
if($key==$projectid){echo "selected='selected' ";}
echo "value=" .$key. ">";
echo $value."</option>";
 }
echo "</select>";
?>
<div id="btntmspan" class="btn-group" data-toggle="buttons">
	<label class="btn btn-default <?php echo ($timespan==0)?"active":"";?>">
            <input id = "time-span0" type="radio" name="timespan" autocomplete="off" value="0" <?php echo ($timespan==0)?"checked":"";?> >24時間
        </label>
        <label class="btn btn-default  <?php echo ($timespan==1)?"active":"";?>">
            <input id = "time-span1" type="radio" name="timespan" autocomplete="off"  value="1" <?php echo ($timespan==1)?"checked":"";?> >1週間
        </label>
        <label class="btn btn-default  <?php echo ($timespan==2)?"active":"";?>">
            <input id = "time-span2" type="radio" name="timespan" autocomplete="off"  value="2" <?php echo ($timespan==2)?"checked":"";?> >1カ月
        </label>
        <label class="btn btn-default  <?php echo ($timespan==3)?"active":"";?>">
            <input id = "time-span3" type="radio" name="timespan" autocomplete="off"  value="3" <?php echo ($timespan==3)?"checked":"";?> >3カ月
        </label>
        <label class="btn btn-default  <?php echo ($timespan==4)?"active":"";?>">
            <input id = "time-span4" type="radio" name="timespan" autocomplete="off"  value="4" <?php echo ($timespan==4)?"checked":"";?> >6カ月
        </label>
        <label class="btn btn-default  <?php echo ($timespan==5)?"active":"";?>">
            <input id = "time-span5" type="radio" name="timespan" autocomplete="off"  value="5" <?php echo ($timespan==5)?"checked":"";?> >1年
        </label>
</div>

<?php echo Form::submit('表示', ['id' => 'chengebtn']);?>
</div>
                {!! Form::close() !!}

<?php foreach ($sensors as $value) {
    $i=$value->id;
    ?>
           
               <div class="panel panel-default" >
                   <div class="panel-heading" id="chart<?php echo $i; ?>" ><b>Chart<?php echo $i; ?></b></div>
                   <div class="panel-body">
                       <canvas id="canvas<?php echo $i; ?>" height="280" width="600"></canvas>
                   </div>
               </div>
<?php if($i==8){ ?>
               <div class="panel panel-default" >
                   <div class="panel-heading" id="chart_hs1" ><b>Chart_hs1</b></div>
                   <div class="panel-body">
                       <canvas id="canvas_hs1" height="280" width="600"></canvas>
                   </div>
               </div>
               <div class="panel panel-default" >
                   <div class="panel-heading" id="chart_hs2" ><b>Chart_hs2</b></div>
                   <div class="panel-body">
                       <canvas id="canvas_hs2" height="280" width="600"></canvas>
                   </div>
               </div>
<?php } ?>
<!-- <div style='margin-left: auto;width: 400px;'>
<b> Alert level&nbsp</b><input id="ex<?php echo $i; ?>" type="text" class="span2" value="" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,850]"/> 
</div>
--> 
<?php } ?>
       </div>
     </div>


		
        <script>
            
            
 <?php 
	echo "var timespan = ".$timespan.";";
	
    switch ($timespan) {
    case 0:
        $from_date=date('Y-m-d');
        break;
    case 1:
        $from_date=date('Y-m-d', strtotime('-1 week', time()));
        break;
    case 2:
        $from_date=date('Y-m-d', strtotime('-1 month', time()));
        break;
    case 3:
        $from_date=date('Y-m-d', strtotime('-3 month', time()));
        break;
    case 4:
        $from_date=date('Y-m-d', strtotime('-6 month', time()));
        break;
    case 5:
        $from_date=date('Y-m-d', strtotime('-1 year', time()));
        break;
    }

	$to_date=date('Y-m-d');
	foreach ($sensors as $value) {
    $i=$value->id;
    ?>


        $(document).ready(function(){
// DataSlider
$("#ex<?php echo $i;?>").slider({});
			
            <?php if($timespan == 0){?>var url = "{{url('stock/chart/'.$i)}}";<?php } ?>
            <?php if($timespan != 0){?>var url = "{{url('stock/chart2/'.$i.'/'.$from_date.'/'.$to_date)}}";<?php } ?>

            var x = new Array();
            var y = new Array();
            var items = [];
            var labelname = '';
            var titlename = '';
			var valcur = 0;
			var valavg = 0;
			var valmax = 0;
			var valmin = 0;
			var arravg = [];
          $.get(url, function(response){
            response.forEach(function(data){
                items.push({x:new Date(data.sddatetime),y:data.sddvalue});
                labelname = data.name;
                titlename = data.shieldname + data.unitname;
				valcur = data.sddvalue;
				arravg.push(data.sddvalue);
				if(valmax < data.sddvalue) valmax = data.sddvalue;
				if(valmin > data.sddvalue) valmin = data.sddvalue;
            });
			if(arravg.length > 0) valavg = average(arravg);
            $('#chart<?php echo $i;?>').html(titlename);
            var canvas<?php echo $i;?> = document.getElementById("canvas<?php echo $i;?>");
            var ctx<?php echo $i;?> = canvas<?php echo $i;?>.getContext("2d");
                var myChart<?php echo $i;?> = new Chart(ctx<?php echo $i;?>, {
                  type: 'scatter',
                  data: {
                      
                      datasets: [{
                          label: labelname ,
                          data: items,
                          borderWidth: 1,
                          fill: false,
                          borderColor: 'rgb(180, 80, 80)',
                          radius: 0,
                      }]
                  },
options: {
        scales: {
            xAxes: [{
                type: 'time',
                time: {
                    unit:  <?php echo ($timespan==0)?"'hour'":"'day'";?>,
                                    displayFormats: {
                                        'hour': 'H:mm', 
                                        'day': 'MM/DD', 
                                    },
                }
            }],
			<?php if($value->yscalemax!=0||$value->yscalemin!=0){ ?>
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    min: <?=$value->yscalemin?>,
                    max: <?=$value->yscalemax?>
                }
            }]
			<?php }?>
        }
    }
              });

$('.panel-body').waitMe('hide');

          });
        });
        
 <?php } ?>

var sum = function(arr, fn) {
    if (fn) {
        return sum(arr.map(fn));
    }
    else {
        return arr.reduce(function(prev, current, i, arr) {
                return prev+current;
        });
    }
};

var average = function(arr, fn) {
    return sum(arr, fn)/arr.length;
};


<?php 
if(isset($i)){
	//if($i==8){
?>
        $(document).ready(function(){
// DataSlider
$("#ex_hs1").slider({});
			
            var url = "{{url('stock/housa/1/2')}}";

            var x = new Array();
            var y = new Array();
            var items = [];
            var labelname = '';
            var titlename = '';
          $.get(url, function(response){
            response.forEach(function(data){
                items.push({x:new Date(data.sddatetime),y:data.sddvalue});
                labelname = data.name;
                titlename = data.shieldname + data.unitname;
            });
            $('#chart_hs1').html(titlename);
            var canvas_hs1 = document.getElementById("canvas_hs1");
            var ctx_hs1 = canvas_hs1.getContext("2d");
                var myChart_hs1 = new Chart(ctx_hs1, {
                  type: 'scatter',
                  data: {
                      
                      datasets: [{
                          label: labelname ,
                          data: items,
                          borderWidth: 1,
                          fill: false,
                          borderColor: 'rgb(180, 80, 80)',
                          radius: 0,
                      }]
                  },
options: {
        scales: {
            xAxes: [{
                type: 'time',
                time: {
                    unit:  <?php echo ($timespan==0)?"'hour'":"'day'";?>,
                                    displayFormats: {
                                        'hour': 'H:mm', 
                                        'day': 'MM/DD', 
                                    },
                }
            }],
        }
    }
              });

$('.panel-body').waitMe('hide');

          });
        });
        $(document).ready(function(){
// DataSlider
$("#ex_hs2").slider({});
			
            var url = "{{url('stock/housa/7/8')}}";

            var x = new Array();
            var y = new Array();
            var items = [];
            var labelname = '';
            var titlename = '';
          $.get(url, function(response){
            response.forEach(function(data){
                items.push({x:new Date(data.sddatetime),y:data.sddvalue});
                labelname = data.name;
                titlename = data.shieldname + data.unitname;
            });
            $('#chart_hs2').html(titlename);
            var canvas_hs2 = document.getElementById("canvas_hs2");
            var ctx_hs2 = canvas_hs2.getContext("2d");
                var myChart_hs2 = new Chart(ctx_hs2, {
                  type: 'scatter',
                  data: {
                      
                      datasets: [{
                          label: labelname ,
                          data: items,
                          borderWidth: 1,
                          fill: false,
                          borderColor: 'rgb(180, 80, 80)',
                          radius: 0,
                      }]
                  },
options: {
        scales: {
            xAxes: [{
                type: 'time',
                time: {
                    unit:  <?php echo ($timespan==0)?"'hour'":"'day'";?>,
                                    displayFormats: {
                                        'hour': 'H:mm', 
                                        'day': 'MM/DD', 
                                    },
                }
            }],
        }
    }
              });

$('.panel-body').waitMe('hide');

          });
        });
<?php
//}
}
?>

$(function(){
    $("*[name=timespan]").change(function() {
        //alert('続けて表示ボタンを押して下さい');
        $('#chengebtn').click();
    });

// none, bounce, rotateplane, stretch, orbit, 
// roundBounce, win8, win8_linear or ios
var current_effect = 'stretch'; // 

$(document).ready(function(){
run_waitMe(current_effect);
});



function run_waitMe(effect){
$('.panel-body').waitMe({

//none, rotateplane, stretch, orbit, roundBounce, win8, 
//win8_linear, ios, facebook, rotation, timer, pulse, 
//progressBar, bouncePulse or img
effect: 'stretch',

//place text under the effect (string).
text: 'Graphs loading....',

//background for container (string).
bg: 'rgba(255,255,255,0.7)',

//color for background animation and text (string).
color: '#000',

//max size
maxSize: '',

//wait time im ms to close
waitTime: -1,

//url to image
source: '',

//or 'horizontal'
textPos: 'vertical',

//font size
fontSize: '',

// callback
onClose: function() {}

});
}
  
});

</script>









@endsection

