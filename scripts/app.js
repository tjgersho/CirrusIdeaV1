(function(){


var initDeviceWidth = $(window).width();

//function zoom(intDevWidth)
//{
// $('body').css('zoom','100%'); /* Webkit browsers */
//  $('body').css('zoom','1.0'); /* Other non-webkit browsers */
//  $('body').css('-moz-transform','scale(1.0, 1.0)'); /* Moz-browsers */
//document.getElementById("viewPort").setAttribute('content','user-scalable=yes, width='+intDevWidth+', minimum-scale=1, maximum-scale=10');//
 //alert("HELLO"+ intDevWidth);

//}

var app = angular.module('CirrusIdea', ['ngRoute', 'ngSanitize', 'ngAnimate', 'ui.bootstrap']);
  app.config(['$routeProvider', '$compileProvider', '$locationProvider',  function($routeProvider, $compileProvider, $locationProvider) {
    $routeProvider.when('/', {
      templateUrl: 'views/home.php',
      controller: 'MainCtrl',
      controllerAs: 'mainCtrl',
      resolve: {
       access: ['$window', '$route', function($window){
          $window.scrollTo(0, 0);
          //zoom(initDeviceWidth);
       }]
       }
    })
    .when('/login', {
      templateUrl: 'views/login.php',
      controller: 'LoginCtrl',
       controllerAs: 'loginCtrl',
      resolve: {
       access: ['$window', function($window){
       $window.scrollTo(0, 0);
       //zoom(initDeviceWidth);
       }]
       }
    })
    .when('/signup', {
      templateUrl: 'views/signup.php',
      controller: 'SignUpCtrl',
       controllerAs: 'signupCtrl',
      resolve: {
       access: ['$window', function($window){
       $window.scrollTo(0, 0);
       //zoom(initDeviceWidth);
       }]
       }
    })
     .when('/mycirrus', {
      templateUrl: 'views/mycirrus.php',
      controller: 'MyCirrusIdeaCtrl',
      controllerAs: 'mycirrusIdeaCtrl',
           resolve: {
         access: ['$q', '$location', '$window', '$route', 'UserService', 
          function($q, $location, $window, $route,  UserService) {
           $window.scrollTo(0, 0);
           //zoom(initDeviceWidth);
           console.log('Access Route Params variable ');
             return UserService.sessionaccess().then(
               function(success) {
               console.log('MyCirrus Resolve Access Resp');
               console.log(success);
            
		},
               function(err) {
               console.log('MyCirrus Resolve Err Rsp');
               console.log(err);
              if(err.data.msg !== 'Goto Login'){
              UserService.isLoggedIn = false;
              
	           
                   $location.path('/login');
                  $location.replace();
                  return $q.reject(err);                  
                  }                                 
             });
        }]
       } 
   }).when('/search', {
      templateUrl: 'views/search.php',
       controller: 'CirrusSearchPageCtrl',
       controllerAs: 'cirrusSearchPageCtrl',
       resolve: {
       access: ['$window', 'SearchTabService', function($window, SearchTabService){
       SearchTabService.SearchTab = 1;
       $window.scrollTo(0, 0);
       //zoom(initDeviceWidth);
       }]
       }
    })
    .when('/cirrus', {
      templateUrl: 'views/browse.php',
      controller:'BrowseCtrl',
      controllerAs: 'browseCtrl',
      resolve: {
       access: ['$window', function($window){
        $window.scrollTo(0, 0);
       //zoom(initDeviceWidth);
       }]
       }
    }).when('/cirrus/path/:path*\/page/:page', {
     templateUrl: 'views/idea.php',
      controller:'CirrusIdeaPageCtrl',
      controllerAs: 'cirrusideaPageCtrl',
        resolve: {
         access: ['$q', '$location', '$window', '$route', 'AccessService',
          function($q, $location, $window, $route,  AccessService) {
           $window.scrollTo(0, 0);
           //zoom(initDeviceWidth);
           console.log('Access Route Params variable '+ $route.current.params.path + ' Access route params page ' + $route.current.params.page);
             return AccessService.grantAccess($route.current.params.path, $route.current.params.page).then(
               function(success) {
               console.log(success);
             
		},
               function(err) {
             
                  
                    $location.path('/login');
                    $location.search('locationpath',  $route.current.params.path);
 $location.search('locationpage', $route.current.params.page);
               
                          $location.replace();
                  return $q.reject(err);                         
             });
        }]
       }
     }).when('/cirrus/path/:path*\/page/:page*\/tid/:tid', {
     templateUrl: 'views/idea.php',
      controller:'CirrusIdeaPageCtrl',
      controllerAs: 'cirrusideaPageCtrl',
      resolve: {
         access: ['$q', '$location', '$window', '$route', 'AccessService',
          function($q, $location, $window, $route,  AccessService) {
           $window.scrollTo(0, 0);
           //zoom(initDeviceWidth);
           console.log('Access Route Params variable '+ $route.current.params.path + ' Access route params page ' + $route.current.params.page);
             return AccessService.grantAccess($route.current.params.path, $route.current.params.page).then(
               function(success) {
               console.log(success);
              
		},
               function(err) {
              
                  
                   $location.path('/login');
                    $location.search('locationpath',  $route.current.params.path);
                    $location.search('locationpage', $route.current.params.page);
                    $location.search('locationtid',  $route.current.params.tid);

                  $location.replace();
                  return $q.reject(err);                  
                                                   
             });
        }]
       }
        }).when('/viewprofile/username/:username', {
     templateUrl: 'views/viewprofile.php',
      controller:'CirrusViewProfileCtrl',
      controllerAs: 'viewProfileCtrl',
      //  resolve: {
      //  access: ['$q', '$location', '$window', '$route', 'AccessService',
      //    function($q, $location, $window, $route,  AccessService) {
      //     $window.scrollTo(0, 0);
           //zoom(initDeviceWidth);
       //    console.log('Access Route Params variable '+ $route.current.params.username);
       //      return AccessService.grantviewProfile($route.current.params.username).then(
      //         function(success) {
      //         console.log('Access Service Return Resp');
    //           console.log(success);
  //           
//		},
        //       function(err) {
        //      if(err.data.msg !== 'Goto Login'){
         //         $location.path('/privateprofile');
         //         $location.replace();
         //         return $q.reject(err);
          //        }else{
          //         $location.path('/login');
          //        $location.replace();
           //       return $q.reject(err);                  
           //       }                                 
         //    });
       // }]
       //}
        resolve: {
       access: ['$window', function($window){
       $window.scrollTo(0, 0);
       //zoom(initDeviceWidth);
       }]
       }

     })
      .when('/emailverification/user/:user/email/:email/code/:code', {
      templateUrl: 'views/emailverification.php',
       controller:'CirrusEmailVerificationCtrl',
      controllerAs: 'emailverificationCtrl',
      resolve: {
       access: ['$window', function($window){
       $window.scrollTo(0, 0);
       //zoom(initDeviceWidth);
       }]
       }
    }) 
     .when('/donation/amount/:amount/ideaID/:ideaID/success/:success', {
      templateUrl: 'views/donation.php',
       controller:'DonationCtrl',
      controllerAs: 'donationCtrl',
       resolve: {
       access: ['$window', function($window){
        $window.scrollTo(0, 0);
       //zoom(initDeviceWidth);
       }]
       }
    }) 
     .when('/manageaccess/ideaid/:ideaid', {
      templateUrl: 'views/manageaccess.php',
       controller:'ManageAccessCtrl',
      controllerAs: 'manageaccessCtrl',
      resolve: {
       access: ['$q', '$location', '$window', '$route', '$http',
          function($q, $location, $window, $route,  $http) {
            $window.scrollTo(0, 0);
            //zoom(initDeviceWidth);
           console.log('Access Route Params variable '+ $route.current.params.ideaid);
             return  $http.post('api/ideaowner/', {idea_id: $route.current.params.ideaid, resolve: 1}).then(function(resp){
          console.log('Resolve User is owner ');    
         console.log(resp);

         },function(err){
      
         console.log('Resolve YOU ARE NOT THE OWNER');
         console.log(err);
        $location.path('/accessfailure');
                  $location.replace();
                  return $q.reject(err);

         });
      

        }]
       }    
      })
      .when('/resetupw', {
      templateUrl: 'views/resetupw.php',
      controller: 'ResetCtrl',
      controllerAs: 'resetCtrl',
      resolve: {
       access: ['$window', function($window){
        $window.scrollTo(0, 0);
       //zoom(initDeviceWidth);
       }]
       }
    })
    .when('/editpassword/user/:user', {
      templateUrl: 'views/editpassword.php',
      controller: 'EditPasswordCtrl',
      controllerAs: 'editpwCtrl',
       resolve: {
       access: ['$q', '$location', '$window', '$route', '$http',
          function($q, $location, $window, $route,  $http) {
           $window.scrollTo(0, 0);
            //zoom(initDeviceWidth);
           console.log('Access Route Params variable '+ $route.current.params.user);
             return  $http.post('api/checkEPWcode/', {user: $route.current.params.user, loggedInCheck: 1}).then(function(resp){
          console.log('Resolve EditPassword Resp ');    
         console.log(resp);
      
      
         },function(err){
      
         console.log('Resolve Check EPW code Err');
         console.log(err);
        $location.path('/accessfailure');
                  $location.replace();
                  return $q.reject(err);

         });

        }]
        }
       })     
    .when('/editpassword/user/:user/code/:code', {
      templateUrl: 'views/editpassword.php',
       controller:'EditPasswordCtrl',
      controllerAs: 'editpwCtrl',
     resolve: {
       access: ['$q', '$location', '$window', '$route', '$http',
          function($q, $location, $window, $route,  $http) {
           $window.scrollTo(0, 0);
           //zoom(initDeviceWidth);
           console.log('Access Route Params variable '+ $route.current.params.user);
             return  $http.post('api/checkEPWcode/', {user: $route.current.params.user, code: $route.current.params.code}).then(function(resp){
          console.log('Resolve EditPassword Resp ');    
         console.log(resp);

         },function(err){
      
         console.log('Resolve Check EPW code Err');
         console.log(err);
        $location.path('/accessfailure');
                  $location.replace();
                  return $q.reject(err);
         });

        }]
        }
    })
      .when('/terms', {
      templateUrl: 'views/termsandconditions.php',
      resolve: {
       access: ['$window', function($window){
        $window.scrollTo(0, 0);
       //zoom(initDeviceWidth);
       }]
       }
    })
     .when('/privacypolicy', {
      templateUrl: 'views/privacypolicy.php',
      resolve: {
       access: ['$window', function($window){
       $window.scrollTo(0, 0);
       //zoom(initDeviceWidth);
       }]
       }
    }).when('/admin', {
      templateUrl: 'views/admin/',
      controller:'CirrusIdeaAdminCtrl',
      controllerAs: 'cirrusideaAdminCtrl',
        resolve: {
          access: ['$q', '$location', '$window', '$route', 'AccessService',
          function($q, $location, $window, $route,  AccessService) {
           $window.scrollTo(0, 0);
           //zoom(initDeviceWidth);
            console.log('Access Route Params variable');
             return AccessService.adminAccess().then(
               function(success) {
               console.log(success);
               $window.scrollTo(0, 0);
             //  console.log('Route Successfull');
		},
               function(err) {
              if(err.data.msg !== 'Goto Login'){
                  $location.path('/accessfailure');
                  $location.replace();
                  return $q.reject(err);
                  }else{
                   $location.path('/login');
                  $location.replace();
                  return $q.reject(err);                  
                  }                                 
             });
        }]    
     }
     }).when('/accessfailure', {
      templateUrl: 'views/accessfailure.php',
      resolve: {
       access: ['$window', function($window){
        $window.scrollTo(0, 0);
       //zoom(initDeviceWidth);
       }]
       }
      });
    $routeProvider.otherwise({
      redirectTo: '/'
    });
    
 app.compileProvider = $compileProvider;
  
 $locationProvider.html5Mode(true);
  $locationProvider.hashPrefix('!');
  
  }]);
  
  
  
   
  
  
})();