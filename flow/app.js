(function(){


/*global angular */
'use strict';

/**
 * The main app module
 * @name app
 * @type {angular.Module}
 */
var app = angular.module('app', ['flow']);

app.config(['flowFactoryProvider', function (flowFactoryProvider) {
  flowFactoryProvider.defaults = {
    target: '../api/fupload/',
    permanentErrors: [404, 500, 501],
    maxChunkRetries: 1,
    chunkRetryInterval: 5000,
    simultaneousUploads: 4
  };
  flowFactoryProvider.on('catchAll', function (event) {
    console.log('catchAll', arguments);
  });
    
  // Can be used with different implementations of Flow.js
  // flowFactoryProvider.factory = fustyFlowFactory;
}]);

app.controller('progressController', ['$scope','$http', function($scope, $http) {
        
    $scope.getprogress = function(prog) {
     
        return {'width': prog + '%'};
    };
    
 //    $scope.$on('flow::fileAdded', function (event, $flow, flowFile) {
 //   event.preventDefault();//prevent file from uploading
//     console.log('File Added Event');
 //   console.log(event);
 //   console.log(flowFile);
 //   console.log($flow);
  
 //  });


 $scope.$on('flow::fileProgress', function (event, $flow, flowFile) {
    event.preventDefault();//prevent file from uploading
    console.log('FileProgress Event');
    console.log(event);
    console.log(flowFile);
    console.log($flow);
  
   });
   
   $scope.$on('flow::progress', function (event, $flow, flowFile) {
    event.preventDefault();//prevent file from uploading
    console.log('Progress Event');
    console.log(event);
    console.log(flowFile);
    console.log($flow);
  
   });
   
     $scope.$on('flow::complete', function (event, $flow, flowFile) {
    event.preventDefault();//prevent file from uploading
    console.log('Complete Event');
    console.log(event);
    console.log(flowFile);
    console.log($flow);
    
  
   });
   
   
  $scope.$on('flow::filesSubmitted', function (event, $flow, flowFile) {
  //  event.preventDefault();//prevent file from uploading
    console.log('FilesSubmitted Event');
  //  console.log(event);
  //  console.log(flowFile);
  //  console.log($flow);
  
   // $http.post('../api/fupload/', {test: 1});
    
  
   });
   
 $scope.$on('flow::error', function (event, $flow, flowFile) {
    event.preventDefault();//prevent file from uploading
    console.log('Error Event');
    console.log(event);
    console.log(flowFile);
    console.log($flow);
  
   });

      
}]);

})();