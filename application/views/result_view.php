<script>
$(document).ready(function(){
  $("#res_list *").tooltip({
	showURL: false 
	});
});
</script>

<div id="res_list" class="result">

<?php

if($spelling)
{

	echo "<ul class='spell'>";
	echo "<li>Did you mean: </li>";
	foreach($spelling as $spell_word)
	{
		echo "<li><a class='spelling_check' href='#'>".$spell_word."</a></li>";
	}
	
	echo "</ul>";
}

$voice=$base.'/images/voice.png';
$approve=$base.'/images/approve.png';
foreach ($query  as $row)
{
    echo "<div class='result'>";


   
    if(!$mm)
    {
        echo str_replace($result,"<span class='bluesel'>".$result."</span>",$row->Word);   
    }
    else{
        echo $row->Word;
    }
    ?>
   <div style="display:none" id="tts_<?php echo $row->Word ?>"><?php echo $row->Word ?></div>
    <?php
   
   if($row->approve==0)
   {
	 echo "<img src='".$approve."' alt='approve' class='res_img' title='waiting to approve' >";
   }
    echo '<a href="javascript:void(0);" onclick="get_id(\'tts_'.$row->Word.'\',\'en\',\'fm\');">';
    echo "<img src='".$voice."' alt='voice' class='res_img' title='click to speech' >";
    echo "</a>";
    echo "<br>";
    echo "<b><span class='bluesel'>".$row->state."</span></b>";
    echo "<br>";
    if(!$mm)
    {
        echo str_replace("|","",$row->def);
    }
    else{
        $result=str_replace("|","",$result);
         echo str_replace($result,"<span class='bluesel'>".$result."</span>", str_replace("|","",$row->def));
    }
    echo "</div>";
}


$start=floor($page/$numshow);
$end=$start+10; // 10 is show number of page nav in current page

$tot_page=ceil($num_rows/$numshow);
$start_mod=$page % $numshow;
if($start_mod==0) $start=$start-1;
$start=$start * $numshow;
if($start==0) $start=1;

?>
<div class="page_lnk">
<?php
for($i=$start;$i<=$end;$i++)
{
	if($i>$tot_page) break;
	
	if($i==$page)
	{
		echo "<b>$i</b>&nbsp;";
	}
	else
	{
		echo "<a href='#' rel='{$result}' class='page_nav'>$i</a>&nbsp;";
	}
}
?>
</div>

