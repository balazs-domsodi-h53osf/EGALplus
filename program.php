<!DOCTYPE html>
<html>
	<head>
		<style>
			#advanced {
				display: none;
			}
		</style>
		<script>
			function ShowAdvanced() {
				if (window.getComputedStyle(document.getElementById("advanced")).display === "none") {
					document.getElementById("advanced").style.display = "block";
				}
				else {
					document.getElementById("advanced").style.display = "none";
				}
			}
		</script>
	</head>
	<body>
		<button onclick="ShowAdvanced()">Show/hide additional information</button>
		<div id="advanced">
<?php
ini_set('max_execution_time', '10800');
$MaxGen=50;
$Epsilon=0.0000000001;
$FailedEpsilonCheckLimit=10;
$PopSize=$_POST['PopSize'];
echo "PopSize: ".$PopSize."<br>";
$NumberOfTasks=$_POST['NumberOfTasks'];
echo "NumberOfTasks: ".$NumberOfTasks."<br>";
$TSize=$_POST['TSize'];
echo "TSize: ".$TSize."<br>";
$HMCR=0.5;
$PAR=0.2;
foreach ($_POST['e'] as $Key => $Value) {
	$Keys=explode('/', $Key);
	$E[$Keys[0]][$Keys[1]]=$Value;
	$E[$Keys[1]][$Keys[0]]=$Value;
}
foreach ($_POST['a'] as $Key => $Value) {
	$A[$Key]=$Value;
}
if (isset($_POST['d']) && isset($_POST['Difficulty'])) {
	foreach ($_POST['d'] as $Key => $Value) {
		$D[$Key]=$Value;
	}
	$Difficulty=$_POST['Difficulty'];
}
else {
	for ($i=0; $i<=$NumberOfTasks; $i++) {
		$D[$i]=1;
	}
	$Difficulty=$TSize;
}
echo "Chosen Difficulty: ".$Difficulty."<br>";

echo "<h3>E matrix:</h3>";
for ($i=0; $i<=$NumberOfTasks-1; $i++) { 	
	for ($j=0; $j<=$NumberOfTasks-1; $j++) {
		if ($E[$i][$j]<10) echo $E[$i][$j]."&nbsp;&nbsp;&nbsp;&nbsp;";
		else echo $E[$i][$j]."&nbsp;&nbsp";
	}
	echo "<br>";
}

for ($p=0; $p<=$PopSize-1; $p++) {
	do { 
		for ($i=0; $i<=$NumberOfTasks-1; $i++) {
			$P[$p][$i]=0;
		}
		$RandomKeys=array_rand($P[$p], $TSize);
		$Valid=true;
		for ($i=0; $i<=$TSize-2; $i++) {
			for ($j=$i+1; $j<=$TSize-1; $j++) {
				if ($E[$RandomKeys[$i]][$RandomKeys[$j]]==0) {  
					$Valid=false;
					break 2;
				}
			}
		}
		if ($Valid) {
			$DSum=0;
			for ($i=0; $i<=$TSize-1; $i++) {
				$P[$p][$RandomKeys[$i]]=1;
				$DSum+=$D[$RandomKeys[$i]];
			}
		}
	}
	while (!$Valid || $DSum!=$Difficulty);
}

echo "<h3>Initial population: </h3>";
for ($p=0; $p<=$PopSize-1; $p++) { 
	echo "The ".$p.".  element:  "; 
	$DSum=0;
	for ($i=0; $i<=$NumberOfTasks-1; $i++) {
		echo  $P[$p][$i]," ";
		$DSum=$P[$p][$i]*$D[$i]+$DSum;
	}
	echo "Difficulty: ".$DSum;
	echo "<br>";
}

for ($p=0; $p<=$PopSize-1; $p++) {
	$F[$p]=0;
	for ($i=0; $i<=$NumberOfTasks-1; $i++) {
		for ($j=0; $j<=$NumberOfTasks-1; $j++) {
			$F[$p]+=$E[$i][$j]*$P[$p][$i]*$P[$p][$j];
		}
	}
}

echo "<h3>Initial fitness values: </h3>";
for ($p=0; $p<=$PopSize-1; $p++) {
	echo "The ".$p.".  element's initial fitness value: ".$F[$p]." <br> ";
}
echo "<br>";

for ($p=0; $p<=$PopSize-1; $p++) {
	for ($t=0; $t<=$PopSize-1; $t++) {
		$X[$p][$t]=0;
	}
}

for ($p=0; $p<=$PopSize-1; $p++) {
	for ($t=0; $t<=$PopSize-1; $t++) {
		for ($i=0; $i<=$NumberOfTasks-1; $i++) {
			if  ($P[$p][$i]!=$P[$t][$i]) {
				$X[$p][$t]++;
			}
		}
	}
}

echo "<h3>Difference matrix: </h3>";
for ($t=0; $t<=$PopSize-1; $t++) {
	for ($p=0; $p<=$PopSize-1; $p++) {
		if ($X[$t][$p]<10) echo $X[$t][$p]."&nbsp;&nbsp;&nbsp;&nbsp;";
		else echo $X[$p][$t]."&nbsp;&nbsp;";
	}
	echo "<br>";
}

for ($p=0; $p<=$PopSize-1; $p++) {
	for ($t=0; $t<=$PopSize-1; $t++) { 
		$F[$p]+=($X[$p][$t])/($PopSize/20);
	}
}

echo "<h3>New fitness values: </h3>";
for ($p=0; $p<=$PopSize-1; $p++) {
	echo "The ".$p.". element's new fitness value: ".$F[$p]." <br> ";
}
echo "<br>";

$LastAverageFitness=array_sum($F)/count($F);
$FailedEpsilonCheckCount=0;
echo "Avarage fitness value in the initial population: ".$LastAverageFitness." <br> ";

for ($g=0; $g<=$MaxGen; $g++) {

	if (mt_rand()/mt_getrandmax()<=$HMCR) {
		$NewPopElement=$P[rand(0,$PopSize-1)];
		if (mt_rand()/mt_getrandmax()<=$PAR) {
			$Time = time();
			while (true) {
				if (time()>$Time+1) {
					goto CreateNewElement;
				}
				$RandomTask=rand(0,$NumberOfTasks-1);
				$Swappable=array();
				if ($NewPopElement[$RandomTask]==0) {
					for ($i=0; $i<=$NumberOfTasks-1; $i++) {
						if ($NewPopElement[$i]==1 && $D[$i]==$D[$RandomTask]) {
							$Valid=true; 
							for ($j=0; $j<=$NumberOfTasks-1; $j++) {
								if ($NewPopElement[$j]==1 && $E[$RandomTask][$j]==0 && $i!=$j) {
									$Valid=false;
								}
							}
							if ($Valid) {
								$Swappable[]=$i;
							}
						}
					}
					if (count($Swappable)>0) {
						$NewPopElement[$RandomTask]=1;
						$NewPopElement[$Swappable[array_rand($Swappable)]]=0;				
						break;
					}
				}
				else {
					for ($i=0; $i<=$NumberOfTasks-1; $i++) {
						if ($NewPopElement[$i]==0 && $D[$i]==$D[$RandomTask]) {
							$Valid=true; 
							for ($j=0; $j<=$NumberOfTasks-1; $j++) {
								if ($NewPopElement[$j]==1 && $E[$i][$j]==0 && $RandomTask!=$j) {
									$Valid=false;
								}
							}
							if ($Valid) {
								$Swappable[]=$i;
							}
						}
					}
					if (count($Swappable)>0) {
						$NewPopElement[$RandomTask]=0;
						$NewPopElement[$Swappable[array_rand($Swappable)]]=1;
						break;
					}
				}
			}
		}
	}
	else {
		CreateNewElement:
		do { 
			for ($i=0; $i<=$NumberOfTasks-1; $i++) {
				$NewPopElement[$i]=0;
			}
			$RandomKeys=array_rand($NewPopElement, $TSize);
			$Valid=true;
			for ($i=0; $i<=$TSize-2; $i++) {
				for ($j=$i+1; $j<=$TSize-1; $j++) {
					if ($E[$RandomKeys[$i]][$RandomKeys[$j]]==0) {  
						$Valid=false;
						break 2;
					}
				}
			}
			if ($Valid) {
				$DSum=0;
				for ($i=0; $i<=$TSize-1; $i++) {
					$NewPopElement[$RandomKeys[$i]]=1;
					$DSum+=$D[$RandomKeys[$i]];
				}
			}
		}
		while (!$Valid || $DSum!=$Difficulty);
	}
	$NewFitness=0;
	for ($i=0; $i<=$NumberOfTasks-1; $i++) {
		for ($j=0; $j<=$NumberOfTasks-1; $j++) {
			$NewFitness+=$E[$i][$j]*$NewPopElement[$i]*$NewPopElement[$j];
		}
	}
	for ($p=0; $p<=$PopSize-1; $p++) {
		for ($i=0; $i<=$NumberOfTasks-1; $i++) {
			if ($NewPopElement[$i]!=$P[$p][$i]) {
				$NewFitness+=1/($PopSize/20);
			}
		}
	}

	$Index=array_search(min($F), $F);
	$TempElement=$P[$Index];
	if ($F[$Index]<$NewFitness) {
		$P[$Index]=$NewPopElement;

		for ($p=0; $p<=$PopSize-1; $p++) {
			$F[$p]=0;
			for ($i=0; $i<=$NumberOfTasks-1; $i++) {
				for ($j=0; $j<=$NumberOfTasks-1; $j++) {
					$F[$p]+=$E[$i][$j]*$P[$p][$i]*$P[$p][$j];
				}
			}
		}
		
		for ($p=0; $p<=$PopSize-1; $p++) {
			for ($t=0; $t<=$PopSize-1; $t++) {
				$X[$p][$t]=0;
			}
		}
		
		for ($p=0; $p<=$PopSize-1; $p++) {
			for ($t=0; $t<=$PopSize-1; $t++) {
				for ($i=0; $i<=$NumberOfTasks-1; $i++) {
					if  ($P[$p][$i]!=$P[$t][$i]) {
						$X[$p][$t]++;
					}
				}
			}
		}
		
		
		for ($p=0; $p<=$PopSize-1; $p++) {
			for ($t=0; $t<=$PopSize-1; $t++) { 
				$F[$p]+=($X[$p][$t])/($PopSize/20);
			}
		}
	}

	$CurrentAverageFitness=array_sum($F)/count($F);

	if ($CurrentAverageFitness<$LastAverageFitness) {
		$P[$Index]=$TempElement;

		for ($p=0; $p<=$PopSize-1; $p++) {
			$F[$p]=0;
			for ($i=0; $i<=$NumberOfTasks-1; $i++) {
				for ($j=0; $j<=$NumberOfTasks-1; $j++) {
					$F[$p]+=$E[$i][$j]*$P[$p][$i]*$P[$p][$j];
				}
			}
		}
		
		for ($p=0; $p<=$PopSize-1; $p++) {
			for ($t=0; $t<=$PopSize-1; $t++) {
				$X[$p][$t]=0;
			}
		}
		
		for ($p=0; $p<=$PopSize-1; $p++) {
			for ($t=0; $t<=$PopSize-1; $t++) {
				for ($i=0; $i<=$NumberOfTasks-1; $i++) {
					if  ($P[$p][$i]!=$P[$t][$i]) {
						$X[$p][$t]++;
					}
				}
			}
		}
		
		
		for ($p=0; $p<=$PopSize-1; $p++) {
			for ($t=0; $t<=$PopSize-1; $t++) { 
				$F[$p]+=($X[$p][$t])/($PopSize/20);
			}
		}
	}

	$CurrentAverageFitness=array_sum($F)/count($F);

	echo "<h3>The ".$g.". population: </h3>";
	echo "Avarage fitness value in the ".$g.". population:".$CurrentAverageFitness."<br>";
	if ($CurrentAverageFitness-$LastAverageFitness<$Epsilon) {
		$FailedEpsilonCheckCount++;
	}
	else {
		$FailedEpsilonCheckCount=0;
	}
	if ($FailedEpsilonCheckCount==$FailedEpsilonCheckLimit) {
		break;
	}
	$LastAverageFitness=$CurrentAverageFitness;
}

echo "<h3>Final fitness values : </h3>";
for ($p=0; $p<=$PopSize-1; $p++) {
	echo "The ".$p.".  element's final fitness value: ".$F[$p]." <br> ";
}
?>
</div>
<div>
<?php
echo "<h3>Results: </h3>";
for ($p=0; $p<=$PopSize-1; $p++) {
	$TaskDifficulty=0;
	for ($i=0; $i<$NumberOfTasks; $i++) {
		if ($P[$p][$i]==1) {
			$O[$p][$i]=$A[$i];
			$TaskDifficulty+=$D[$i];
		}
		else {
			$O[$p][$i]=NULL;
		}
	}
	?>
	</div>
	<div>
	<?php
	if (!isset($_POST['CssExample'])) {
	?>
	<ol>
	<?php
	}
	if (isset($_POST['CssExample'])) {
		echo '<h3>'.$p.'. Task:</h3>';
		echo '<p style="';
	}
	for ($j=0; $j<$NumberOfTasks; $j++) {
		if (!empty($O[$p][$j])) {
			if (!isset($_POST['CssExample'])) {
			?>
			<li>
			<?php
			}
			echo $O[$p][$j];
			if (isset($_POST['CssExample'])) {
				echo ';';
			}
			if (!isset($_POST['CssExample'])) {
				echo ' / difficulty: '.$D[$j];
			}
			if (!isset($_POST['CssExample'])) {
			?>
			</li>
			<?php
			}	
		}
	}
	if (isset($_POST['CssExample'])) {
		echo '">Lorem ipsum dolor sit amet.</p>';
	}
	if (!isset($_POST['CssExample'])) {
	?>
	</ol>
	<?php
	echo 'difficulty sum: '.$TaskDifficulty;
	echo '<br>Difficulty goal: '.$Difficulty;
	?>
	<hr>
	<?php
	}
	?>
	</div>
	<?php
}
?>
</body>
</html>
