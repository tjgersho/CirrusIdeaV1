(function(){

// File: chapter10/routing-example/app/scripts/services.js
var app = angular.module('CirrusIdea');
 
      app.service('ThoughtOrderByService', ['$http', function($http) {
  
    var self = this;
    self.thoughtOrder = 'date DESC';
		       
	self.getThoughtOrder = function(){
	
          return self.thoughtOrder;
	         
       };

        
        self.setThoughtOrder = function(orderBy){
               
              self.thoughtOrder = orderBy;
        };
        
        
         
  }]);
  
  
      app.service('SearchTabService', [function() {
  
    var self = this;
    self.SearchTab = 1;
		       
	self.getSearchTab = function(){
	
          return self.SearchTab;
	         
       };

        
        self.setSearchTab = function(tab){
               
              self.SearchTab = tab;
        };
        
        
         
  }]);
  
  
        app.service('MydeaTabService', [function() {
  
    var self = this;
    self.MyTab = 5;
		       
	self.getMyTab = function(){
	
          return self.MyTab;
	         
       };

        
        self.setMyTab = function(tab){
               
              self.MyTab = tab;
        };
        
        
         
  }]);
  
  app.factory('formDataObject',[function() {
 return function(data) {
	 var fd = new FormData();
	 angular.forEach(data, function(value, key) {
	 fd.append(key, value);
	 });
	 return fd;
	 };
     }]);
  
  
  app.factory('UserService', ['$http', function($http) {
    var service = {
      isLoggedIn: false,
      isAdmin: false,
      username: null,
      user_id: null,
      session: function() {
        return $http.post('api/session/',{})
              .then(function(response) {
              console.log('Session Response ' + response);
              console.log(response);
      
          service.isLoggedIn = true;
          service.isAdmin = response.data.admin;
          service.username = response.data.username;
          service.user_id = response.data.user_id;
          service.interest = response.data.interest;
          return response;
          
        }, function(err){
        service.isLoggedIn = false;
         console.log('Session Call Err Response');
         console.log(err);
          return err;
        });
      },
        sessionaccess: function() {
        return $http.post('api/session/',{});
         }
       
    };
    return service;
  }]);
  
  
  
  
   app.factory('AccessService', ['$http', '$window', function($http, $window) {
    var service = {
      hasAccess: false,
      grantAccess: function(path, page) {
      console.log('Access Service is called with path  '+ path + '  Page ' + page);
        return $http.post('api/access/',{cirruspath: path, cirruspage: page});//.then(function(response) {
             // console.log('Access Response ' + response);
             // console.log(response);
//
            //  service.hasAccess = true;
                    
             // return response;
       // });
      },
      grantviewProfile: function(uname){
     
      console.log('View Profile Access Service is called with username '+ uname);
        return $http.post('api/viewprofileaccess/',{otheruser: uname});//.then(function(response) {
             // console.log('View Profle Access Response ' + response);
             // console.log(response);

              // service.hasAccess = true;
                    
             // return response;
        //});
      },
       grantviewProfile: function(uname){
     
      console.log('View Profile Access Service is called with username '+ uname);
        return $http.post('api/viewprofileaccess/',{otheruser: uname});//.then(function(response) {
             // console.log('View Profle Access Response ' + response);
             // console.log(response);

              // service.hasAccess = true;
                    
             // return response;
        //});
      },
      adminAccess: function(){
        return $http.get('api/admin/adminaccess/');//.then(function(response) {
               // console.log('Access Response ' + response);
              // console.log(response);

              // service.hasAccess = true;
                    
              // return response;
       // });
      }
    };
    return service;
  }]);

  
})();