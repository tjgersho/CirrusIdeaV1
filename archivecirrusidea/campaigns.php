<?php  
  // Start the session
require_once('startsession.php');
$root = realpath($_SERVER["DOCUMENT_ROOT"]);  

   // Insert the page header
   $page_title = 'My Account';
 
 
  require_once('connectvars.php');

  // Make sure the user is logged in before going any further.

  if (!isset($_SESSION['user_id'])) {

   require_once('header.php');
   require_once('header2.php');
   require_once('navmenu.php');
   echo '<p> You are not logged in.  Enter your username and password above. </p>';
   
   // Insert the page footer
  require_once('footer.php');
    exit();
  
  }
  
   require_once('header.php');
  
      ?>
 <script>
 
 
  $(function() {
   
            
   
      var campaign_id = $( "#campaign_id" ),
      

      edit_campaign_name = $( "#edit_campaign_name" ),
      edit_campaign_description = $( "#edit_campaign_description" ),
    
      
      allFields = $( [] ).add( campaign_id ).add( edit_campaign_name ).add( edit_campaign_description ),
      tips = $( ".validateTips" );
    
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkSize( o, n, min, max ) {
      if ( o.val() > max || o.val() < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Select a number for " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }
 
    function checkRegexp( o, regexp, n ) {
     if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }



 $( "#editcampaignform" ).dialog({
 
 
      autoOpen: false,
      height: 600,
      width: 550,
      modal: true,
      buttons: {
        "Edit": function() {
          var bValid = true;
          allFields.removeClass( "ui-state-error" );
 
          //bValid = bValid && checkSize( pixel_x, "pixel_x", 1, 100 );
          //bValid = bValid && checkSize( pixel_y, "pixel_y", 1, 100 );
         // bValid = bValid && checkSize( R, "Red", 0, 255 );
         // bValid = bValid && checkSize( G, "Green", 0, 255 );
         // bValid = bValid && checkSize( B, "Blue", 0, 255 );
 
        //  bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
         ///  From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
         // bValid = bValid && checkRegexp( contact_email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
        //  bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
         bValid = bValid && checkRegexp( edit_campaign_name, /[a-z]/, "Enter your campaign name" );
          
          
          if ( bValid ) {
                             
     var    vcampaign_id = campaign_id.val(), 
              vedit_campaign_name =  edit_campaign_name.val(),
              vedit_campaign_description =  edit_campaign_description.val();
             
              
             $( this ).dialog( "close" ); 
             // enter AJAX here
        $("#"+vcampaign_id).html("<img src='http://www.znoter.com/images/loading.gif' />");
              
         $.post('ajax/editcampaign.php',
              {
               campaign_id: vcampaign_id,
              campaign_name: vedit_campaign_name,
              campaign_description: vedit_campaign_description
              },
                    
              function(data,status){
                    
                var arr = jQuery.parseJSON(data);
         
                 if (arr.errormessage != 0) {
                  alert("Ajax Error Occurred.");
                 }
            
                // alert(data); // show response from the php script.
              $(this).loadCampaigns();
                 
           });
            
         allFields.val( "" ).removeClass( "ui-state-error" ); 
            
          }
        },
        Cancel: function() {
          $( this ).dialog( "close" );
                     
        allFields.val( "" ).removeClass( "ui-state-error" ); 
            
        }
      },
      close: function() {
     
            allFields.val( "" ).removeClass( "ui-state-error" );       
           
      }
    });



  
        var del_campaign_id = $( "#del_campaign_id" ),
  
      allFields = $( [] ).add( del_campaign_id );
  
    $( "#delete_campaign_confirm" ).dialog({
      autoOpen: false,
      height: 250,
      width: 500,
      modal: true,
      buttons: {
        "Delete Campaign": function() {
       
         var     vdel_campaign_id = del_campaign_id.val();
             
                
             $( this ).dialog( "close" ); 
             // enter AJAX here
       
             
              
         $.post('ajax/deletecampaign.php',
              {
             del_campaign_id: vdel_campaign_id
              },
                    
                 function(data,status){
                    $("#campaign_accordion").html("<img src='http://www.znoter.com/images/loading.gif' />");

               alert(data);
              $(this).loadCampaigns();
               
                 
              });
          
            
          
        },
        Cancel: function() {
          $( this ).dialog( "close" );
         
        }
      }
    });
    
    
    

    
    
    
  });
 
 
 
 
 </script>
 
 
 <?php
   
 require_once('header2.php');


  // Show the navigation menu
require_once('navmenu.php');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($_SESSION['help']){
?>
<span class="hotspot" onmouseover="tooltip.show('Make sure you fill out your info, esspecially your interest.  If your interest is not in the selection, you\'ll have to add a new Geneal Topic Folder on the main CirrusIdeas page which suits your general interest.  Also, below is where you can manage your private and public folders that you\'ll create. <br /><br /> <strong>Next Tour Stop</strong>:  Click on the <i>CirrusIdeas</i> tab.');" onmouseout="tooltip.hide();">
<p><span class="ui-icon ui-icon-lightbulb" style="display:inline-block;"></span>Help</p>
</span><br />
<?php
 }
?>


<button id="addcampaign">Add Campaign</button>
 <div id="campaign_div" style="clear:both; display:none;"> 
 

<form id="AddNewCampaign" method="post" style="">

 <legend><b>Add New Campaign</b></legend>
    <div>Campaign Name:
    <input type="text" id="add_campaign_name" name="add_campaign_name" /></div></br>
    <div>
    Campaign Description:
    <textarea id="add_campaign_description" name="add_campaign_description" rows="5" cols="50" ></textarea>
   </div>
   <input type="submit"  class="stylebutton" value="Add" name="add_campaign" />
 
  </form>
  
</div>
  
  <br />

<div> 

<div class="content_underline"></div>

</div>
  <br />

<div id="campaign_container"> 

<div id="campaign_accordion"></div>

</div>


<!-- Hidden Forms --->



<div id="delete_campaign_confirm" title="Delete Campaign?">
<form id="delete_campaign_form">
<input type="hidden" name="del_campaign_id" id="del_campaign_id" value="" />
</form>
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure you want to permanently delete this campaign?</p>
</div>

<div id="editcampaignform" title="Edit Campaign">
  <p class="validateTips">All form fields are required.</p>
<form id="form_editcampaign_form" class="ui-widget">
<fieldset style="width:400px;">

<!-- Form Name -->
<legend>Edit Campaign</legend>

<input type="hidden" name="edit_campaign_id" id="edit_campaign_id" value=""/>


<!-- Text input-->
<div>
  <label  for="edit_campaign_name">Campaign Name:</label>
  <div>
    <input id="edit_campaign_name" name="edit_campaign_name" type="text">
    
  </div>
</div>

<!-- Text input-->
<div>
  <label  for="edit_campaign_description">Campaign Description:</label>
  <div>
    <input id="edit_campaign_description" name="edit_campaign_description" type="text">
    
  </div>
</div>

<!-- Text input-->

</form>

</div>


<script>

$.fn.loadCampaigns = function() {

alert("loadCampaigns called");

$("#campaign_accordion").html("<img src='http://www.znoter.com/images/loading.gif' />");

 $.post('ajax/ajaxcampaigns.php',
         
         function(data){
             
                var arr = jQuery.parseJSON(data);
         
                                   
               
             alert(arr.zcampaignshtml); // show response from the php script.
             alert(arr.javascriptz);
             
             
            $("#campaign_accordion").html(arr.zcampaignshtml);
            
            $("body").append(arr.javascriptz);
          
         $( "#campaign_accordion" ).accordion({collapsible: true});
           
         
          
         });
         
      //    $( "#campaign_accordion" ).accordion( "refresh" );  
          
};





$("#addcampaign").button();

$(document).ready(function(){
   $(this).loadCampaigns();
 
});


 $("#addcampaign").click(function(){
   
    $("#campaign_div").fadeToggle();
          
  });




$("#AddNewCampaign").submit(function(){

var campaign_name = $("#add_campaign_name").val();
var campaign_description = $("#add_campaign_description").val();

alert(campain_name);
alert(campaign_description);
$("#campaign_accordion").html("<img src='http://www.znoter.com/images/loading.gif' />");

  $.post('ajax/addcampaign.php',
              {
              campaign_name: campaign_name,
              campaign_description: campaign_description
              },
                    
              function(data){
                    
                var arr = jQuery.parseJSON(data);
         
                 if (arr.errormessage != 0) {
                  alert("Ajax Error Occurred.");
                 }
            
                alert(data); // show response from the php script.
              $(this).loadCampaigns();
                 
           });
           
           
});

        
        
        

$.fn.initialize = function(){

 $(this).refreshjava();

 
		
}; 


$(document).ajaxComplete(function(event, xhr, settings){
///alert(settings.url);


if ( settings.url === "ajax/ajaxcampaigns.php" ) {
     $(this).initialize();
    
   //  alert(xhr.responseHTML);
};


if ( settings.url === "ajax/addcampaign.php" ) {
     $(this).initialize();
    
   //  alert(xhr.responseHTML);
};

if ( settings.url === "ajax/deletecampaign.php" ) {
    
    $(this).initialize();
  
    
   //  alert(xhr.responseHTML);
};



});        
</script>


<?php
  mysqli_close($dbc);


  // Insert the page footer
  require_once('footer.php');
 
?>
