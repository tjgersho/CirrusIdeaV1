<?php
$page = $this->file_name;

$pathstr = $this->file_path;


echo '<br /><br /><br /><br /> Test Page: ' . $page;

echo '    <br />PathString   <br />' . $pathstr;


$breadcrumblinks = array();
  
$patharr = explode("/", $pathstr);
$ii = 0;
while (sizeof($patharr) > 1 && $ii<100){
         $temparr = $patharr;
          //console.log(patharr);
         // console.log(self.links);
       //  $sliced = $patharr.splice(sizeof($patharr)-1,1).join('/');
         
         $sliced =   implode('/', array_splice($patharr, sizeof($patharr)-1,1 ));
         
       
  
          
          if ( sizeof($patharr) == 0){
     
          $ii++;
          $breadcrumblinks[$ii]['path'] =  ' ';
          $breadcrumblinks[$ii]['page'] = $sliced;
          
          }else{
    
          $ii++;
          
          $breadcrumblinks[$ii]['path'] =  implode('/', $patharr);
          $breadcrumblinks[$ii]['page'] = $sliced;
          }
       
       echo $patharr;
       var_dump($breadcrumblinks);
 }
         
 $breadcrumblinks = array_reverse($breadcrumblinks );   
?>

<div ng-model="breadcrumbCtrl.path"></div>

<ul class="breadcrumb">
  <li><a href="#!/cirrus">CirrusIdeas</a></li>

  
<li>
<?php 
  for($i=0; $i<$ii; $i++){
 echo '<a href="#!/cirrus/path/' .  $breadcrumblinks[$i]['path']  . '/page/' . $breadcrumblinks[$i]['page'] .'">' . $breadcrumblinks[$i]['page']  . '</a>';
  }
 
echo '</li>';
  
  
echo '<li class="active">'.$page. '</li>';

echo '</ul>';


?> 