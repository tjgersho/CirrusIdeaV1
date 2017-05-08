<?php
$idealistpath = $this->file_path;
$idealistpage = $this->file_name;


$queryidealist = "SELECT * FROM ideas WHERE file_private != '1' AND file_path = '" .$idealistpath. "/" . $idealistpage . "'";
$dataidealist = mysqli_query($this->dbc, $queryidealist);
$j = 0;
while($rowidealist = mysqli_fetch_array($dataidealist)){
$subpage[$j] = $rowidealist['filename'];
$j++;
}

?> 
			
			<div class="panel panel-default">
			<div class="panel-body">
			  
			  
		
						<h5>CirrusIdeas</h5>
						
						
						<div>
						
						
			<?php
			
			
			for($i=0; $i<$j; $i++){
						
			echo '<a href="#!/cirrus/path'. $idealistpath .'/page/' .$subpage[$i] . '" style="float:left; padding:10px; margin:5px;">'. $subpage[$i] .'</a>';
						
					}
		      ?>				
			
						</div>
						
				 <div class="clr"></div>		   
			   
			    </div>
			   
			   
			   


			   
			      </div>
			     </div>
			</div>
			
			





