<?php
    require_once 'inc/connectdb.inc.php';
    $connect = connect_db();

    if (isset($_GET['npage']) && $_GET['npage']) { //on chercher le numéro de la page
        $npage = $_GET['npage'];
        } else {
            $npage = 1;
            }

        $total_par_page = 2;
        $offset = ($npage-1) * $total_par_page; //Offset permet de décaler le résultat à obtenir
        $previous = $npage - 1;
        $next = $npage + 1;
        $adjacents = "2"; 

        $result_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM MSG");
        $total_records = mysqli_fetch_array($result_count);
        $total_records = $total_records['total_records'];
        $total_pages = ceil($total_records / $total_par_page); //ceil permet d'arrondir 

        $result = mysqli_query($connect,"SELECT * FROM MSG LIMIT $offset, $total_par_page");
        while($row = mysqli_fetch_array($result)){
            echo "<tr>
                <td>".$row['CONT']."</td></br> 
                </br></br>
                </tr>";
            }// tester en créant une fonction pour mettre le prepare d'index à la place du CONT
        mysqli_close($connect);
    ?>

<div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
<strong>Page <?php echo $npage." of ".$total_pages; ?></strong>
</div>

<ul class="pagination"> <!-- test mais marche pas  -->
    
	<li <?php if($npage <= 1){ echo "class='disabled'"; } ?>>
	<a <?php if($npage > 1){ echo "href='?npage=$previous'"; } ?>>Previous</a>
	</li>
       
    <?php 
	if ($total_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_pages; $counter++){
			if ($counter == $npage) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?npage=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_pages > 10){
		
	if($npage <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $npage) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?npage=$counter'>$counter</a></li>";
				}
        }
		echo "<li><a>...</a></li>";
		echo "<li><a href='?npage=$second_last'>$second_last</a></li>";
		echo "<li><a href='?npage=$total_pages'>$total_pages</a></li>";
		}

	 elseif($npage > 4 && $npage < $total_pages - 4) {		 
		echo "<li><a href='?npage=1'>1</a></li>";
		echo "<li><a href='?npage=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $npage - $adjacents; $counter <= $npage + $adjacents; $counter++) {			
           if ($counter == $npage) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?npage=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li><a>...</a></li>";
	   echo "<li><a href='?npage=$second_last'>$second_last</a></li>";
	   echo "<li><a href='?npage=$total_pages'>$total_pages</a></li>";      
            }
		
		else {
        echo "<li><a href='?npage=1'>1</a></li>";
		echo "<li><a href='?npage=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_pages - 6; $counter <= $total_pages; $counter++) {
          if ($counter == $npage) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?npage=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
	<li <?php if($npage >= $total_pages){ echo "class='disabled'"; } ?>>
	<a <?php if($npage < $total_pages) { echo "href='?npage=$next'"; } ?>>Next</a>
	</li>
    <?php if($npage < $total_pages){
		echo "<li><a href='?npage=$total_pages'>Last &rsaquo;&rsaquo;</a></li>";
		} ?>
</ul>

<br /><br />
</div>
