@extends('layouts.app')

@section('content')
<?php if(isset($my_message)){ ?>

            <div class="container mt-2">
                <div class="alert alert-success">
                    12月6日に発生したSoftBank回線障害により一部のセンサー通信ユニットが通信できない状態になっています。電源の再投入をお願いいたします。<br/>お手数おかけしますが、よろしくお願いいたします。
                </div>
            </div>
<?php }?>
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
<?php //var_dump($functiongraphs);?>
<?php echo Form::submit('表示', ['id' => 'chengebtn']);?>
</div>
                {!! Form::close() !!}

<?php foreach ($sensors as $value) {
    $i=$value->id;
    ?>
           
               <div class="panel panel-default container" >
                   <div class="panel-heading statistics row" id="chart<?php echo $i; ?>" ><b>Chart<?php echo $i; ?></b></div>
                   <div class="panel-body">
                       <canvas id="canvas<?php echo $i; ?>" height="280" width="600"></canvas>
                   </div>
               </div>
<?php
foreach ($functiongraphs as $fncg){
	$pieces = explode("|", $fncg->settingString); //3つめの数字が配置位置の前のセンサーID
	$beforID=$pieces;
	if($beforID[2]){
		if($i==$beforID[2]){ 
?>
               <div class="panel panel-default container" >
                   <div class="panel-heading statistics row" id="chart_hs<?php echo $beforID[2]; ?>" ><b>Chart_hs<?php echo $beforID[2]; ?></b></div>
                   <div class="panel-body">
                       <canvas id="canvas_hs<?php echo $beforID[2];?>" height="280" width="600"></canvas>
                   </div>
               </div>
<?php 
		}
	}
} 
?>
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
				if(arravg.length==1) valmin = data.sddvalue;
				if(valmin > data.sddvalue) valmin = data.sddvalue;
            });
			if(arravg.length > 0) valavg = average(arravg);
			$('#chart<?php echo $i; ?>').html("<div class='col-md-4' style='font-size: 0.8em !important;'>" + titlename + "　" + labelname+"</div><div class='col-md-4'>　現在:"+valcur+"　平均:"+valavg+"　</div><div class='col-md-4'><p style='font-size: 0.8em !important;'>最大:"+valmax+"　最小:"+valmin + "</p></div>");
            //$('#chart<?php echo $i;?>').html(titlename);
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
    return Math.round(sum(arr, fn)/arr.length*10)/10;
};


<?php 
if(isset($i)){
foreach ($functiongraphs as $fncg){
	$pieces = explode("|", $fncg->settingString); //3つめの数字が配置位置の前のセンサーID
	$beforID=$pieces;
	if($beforID[2]){
		
?>

        $(document).ready(function(){
// DataSlider
$("#ex_hs<?php echo $beforID[2];?>").slider({});
			
            <?php if($timespan == 0){?>var url = "{{url('stock/housa/<?php echo $beforID[0];?>/<?php echo $beforID[1];?>')}}";<?php } ?>
            <?php if($timespan != 0){?>var url = "{{url('stock/housa2/'.$beforID[0].'/'.$beforID[1].'/'.$from_date.'/'.$to_date)}}";<?php } ?>

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
				if(arravg.length==1) valmin = data.sddvalue;
				if(valmin > data.sddvalue) valmin = data.sddvalue;
            });
			if(arravg.length > 0) valavg = average(arravg);
			$('#chart_hs<?php echo $beforID[2];?>').html("<div class='col-md-4'>" + titlename + "　" + labelname+"</div><div class='col-md-4'>　現在:"+valcur+"　平均:"+valavg+"　</div><div class='col-md-4'><p style='font-size: 0.8em !important;'>最大:"+valmax+"　最小:"+valmin + "</p></div>");
            var canvas_hs<?php echo $beforID[2];?> = document.getElementById("canvas_hs<?php echo $beforID[2];?>");
            var ctx_hs<?php echo $beforID[2];?> = canvas_hs<?php echo $beforID[2];?>.getContext("2d");
                var myChart_hs<?php echo $beforID[2];?> = new Chart(ctx_hs<?php echo $beforID[2];?>, {
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
			
		}
	} 
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

