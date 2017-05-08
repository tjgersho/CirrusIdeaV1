<?php
?>





 <!-- Modal -->
  <div class="modal fade" id="cirrusGalleryModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color:#000000; color: #ffffff;">
          <button type="button" class="close" data-dismiss="modal" style="color:#FFFFFF; filter: alpha(opacity=80); opacity: 0.8;">&times;</button>
          <h4 class="modal-title">{{thoughtCtrl.page}}</h4>
        </div>
        <div class="modal-body" style="margin:0px;">
         
         
         
<div class="container">
  <br>
  <div id="cirrusCarousel" class="carousel slide" data-ride="carousel">
   

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

        <div class="item" ng-class="{'active':!$index}" ng-repeat="gal in thoughtCtrl.cirrusGallery">
        <img ng-src="{{gal.file}}"  alt="{{gal.fname}}"  width="100%">
        <div class="carousel-caption" style="left:0px; right:0px;">
           <p>{{gal.headline}}<br /></p>
                   </div>
      </div>
    
         </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" data-target="#cirrusCarousel" role="button" data-slide="prev" style="width:10%; height200px;" ng-click="thoughtCtrl.galPrev()">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only"></span>
    </a>
    <a class="right carousel-control" data-target="#cirrusCarousel" role="button" data-slide="next" style="width:10%; height200px;"  ng-click="thoughtCtrl.galNext()">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only"></span>
    </a>
  </div>
</div>
         
         
 <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#cirrusCarousel" data-slide-to="{{$index}}" ng-class="thoughtCtrl.getActivePill($index)" ng-repeat="gal in thoughtCtrl.cirrusGallery"  ng-click="thoughtCtrl.goToSlide($index)"></li>
    </ol>
         
          </div>
        <!--<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>-->
      </div>
      
    </div>
  </div>



