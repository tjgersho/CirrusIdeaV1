<?php
?>





<?php
echo '</div>'; //end fillcontent
echo '<div id="footer"><br />';
echo '<div style="width:1150px; float:left;"><p>Copyright &copy;2011-2014 Paradigm Motion, LLC &nbsp;&nbsp;&nbsp; Patent Pending Platform &nbsp;&#183;&nbsp;';
echo '<a href="http://www.cirrusidea.com/contactus.php">Contact Us</a>&nbsp;&#183;&nbsp;';
echo '<a href="http://www.cirrusidea.com/privacypolicy.php">Privacy Policy</a>';
echo '&nbsp;&#183;&nbsp;<a href="http://www.cirrusidea.com/aboutus.php">About Us</a>';
echo '&nbsp;&#183;&nbsp;<a href="http://www.cirrusidea.com/termsandconditions.php">Terms and Conditions</a></p></div>';

echo '<a href="http://www.cirrusidea.com">';
echo '<img src="http://www.cirrusidea.com/images/CirrusIdeaLogo1.png" style="display:inline; height:60px;  float:left;"/>';
echo '</a>';
echo '</div></div>';

?>

<!-- The Gallery as lightbox dialog, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>



<script>
    		$(document).ready(function(){			
				//$('textarea').elastic();
			
               // $('textarea').spellAsYouType();
                 //  $('textarea').trigger('update');
                 
                 /*
Author - Yash Mathur
*/
jQuery.fn.autoGrow = function(){
    return this.each(function(){
        var colsDefault = this.cols;
        var rowsDefault = this.rows;
        
        var grow = function() {
            growByRef(this);
        }
        
        var growByRef = function(obj) {
            var linesCount = 0;
            var lines = obj.value.split('\n');
            
            for (var i=lines.length-1; i>=0; --i)
            {
                linesCount += Math.floor((lines[i].length / colsDefault) + 1);
            }

            if (linesCount > rowsDefault)
                obj.rows = linesCount;
            else
                obj.rows = rowsDefault;
        }
        
        var characterWidth = function (obj){
            var characterWidth = 0;
            var temp1 = 0;
            var temp2 = 0;
            var tempCols = obj.cols;
            
            obj.cols = 1;
            temp1 = obj.offsetWidth;
            obj.cols = 2;
            temp2 = obj.offsetWidth;
            characterWidth = temp2 - temp1;
            obj.cols = tempCols;
            
            return characterWidth;
        }
        this.style.overflow = "hidden";
        this.onkeyup = grow;
        this.onfocus = grow;
        this.onblur = grow;
        growByRef(this);
    });
};
$("textarea").autoGrow();
			});	

//$('textarea').elastic();
</script>


<!--<script type="text/javascript" src='http://www.cirrusidea.com/js/JavaScriptSpellCheck/include.js' ></script>
    <script type='text/javascript'> $Spelling.SpellCheckAsYouType('textareas')</script>
-->

<script src="http://www.cirrusidea.com/js/blueimp-gallery.min.js"></script>
<script>
document.getElementById('links').onclick = function (event) {
    event = event || window.event;
    var target = event.target || event.srcElement,
        link = target.src ? target.parentNode : target,
        options = {index: link, event: event},
        links = this.getElementsByTagName('a');
    blueimp.Gallery(links, options);
};
</script>

</body>
</html>
