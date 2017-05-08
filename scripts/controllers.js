(function(){


function strip_tags(input, allowed) {

  allowed = (((allowed || '') + '')
    .toLowerCase()
    .match(/<[a-z][a-z0-9]*>/g) || [])
    .join(''); // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
  var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
    commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
  return input.replace(commentsAndPhpTags, '')
    .replace(tags, function($0, $1) {
      return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
    });
}

 function isEmpty(obj) {
               if (typeof obj == 'undefined' || obj === null || obj === '') return true;
               if (typeof obj == 'number' && isNaN(obj)) return true;
               if (obj instanceof Date && isNaN(Number(obj))) return true;
               return false;
               }

var app = angular.module('CirrusIdea');

 function ratioCoords (coords, ratio) {
        coord_arr = coords;

        for(var j=0; j < coord_arr.length; j++) {
            coord_arr[j] = Math.round(ratio * coord_arr[j]);
        }
        return coord_arr;

        //return coord_arr.join(',');
       }


app.controller('contactusController', ['$http', function($http){
var self = this;
 self.error1 = false;
 
self.ctus_submit = function(){

var fname = $("#firstname").val();
var lname = $("#lastname").val();
var eMail = $("#email").val();
var coMment = $("#comment").val();
var cAptcha = $("#letters_code").val();


$http.post('contactus.php', 
       {firstname: fname,
       lastname: lname,
       email: eMail,
       comment: coMment,
       captcha: cAptcha       
       }).
  success(function(data, status, headers, config) {
 
 //alert(data);
 //  var arr = jQuery.parseJSON(data);
 // alert(data.errormsg);
 
      if(data.eRRor === '123'){
       self.error1 = data.errormsg;
    
    }else{ //Success!!!
      self.error1 = false;
      
      $('#contactUs').modal('toggle');
     $('#contactUsthanks').modal('toggle');
      
      
    }
      

  });




 };
 
}]);


  app.controller('MainCtrl', ['UserService', '$window', '$location',  '$route', function(UserService, $window, $location, $route) {
      var self = this;
      self.userService = UserService;

      // Check if the user is logged in when the application
      // loads
      // User Service will automatically update isLoggedIn
      // after this call finishes
      
      UserService.session();
        
      
  
    //   self.routed = false;
      
    //   if(  !app.routed   ){
    //   console.log(self.routed);

     //    $route.reload();
      //     self.routed = false;
      //     console.log(self.routed);

      //   }

       
//       console.log(self.routed);
       
      ////Do Not Delete//////////// window refresh function 
   //   $window.onbeforeunload = function(e){
  //     console.log(e);
    //   alert("WHE");
      // if(  !app.routed   ){
    //   console.log(self.routed);

   //      $route.reload();
     //      self.routed = true;
     //      console.log(self.routed);

   //      }
     //   e.preventDefault();
    //    console.log('windowrefresh');
     //   return "If you refreshed this page you may need to re-navigate here";
     //   };
        
        
     //   angular.element($window).bind('onbeforeunload', function(){
     //      $scope.$apply();
      //  });

  self.logout = function(){
  console.log('ReDir to logout ');
  $window.location.href='api/logout';
  
  };
      
  }]);
  
    app.controller('MyCirrusIdeaCtrl', ['MydeaTabService', 'UserService', function(MydeaTabService, UserService) {   //////////////////////MYDEA CONTROLLER////////////////////
      var self = this;
      UserService.session().then(function(resp){
       console.log('MyDea UserService!');
       console.log(resp);
      console.log(UserService.username);
      
      },function(err){
      
      
      });
      
     
      
      self.getmyTab = function(){
       return MydeaTabService.getMyTab();
      };
      self.tabcontrol = function(fun){
                 MydeaTabService.setMyTab(fun);
      };
      
  }]);
  



  app.controller('LoginCtrl', ['$location', '$http', '$routeParams', function($location, $http, $routeParams) {
      var self = this;
      self.user = {username: '', password: ''};
      self.errorMessage = '';
      self.locationpath = $routeParams.locationpath;
      self.locationpage = $routeParams.locationpage;
      self.locationtid = $routeParams.locationtid;
      
      self.login = function() {
       self.errorMessage = '';
      $('#login_loading').show();
      
   
       $http.post('api/login/', self.user).then(function(success) {
          console.log('Login Resp Success');
          console.log(success);
        
         $('#login_loading').hide();
          
          var redirurl = '/mycirrus';
          
        if(self.locationtid > 1){
          redirurl = 'cirrus/path/'+self.locationpath+'/page/' +self.locationpage +'/tid/'+self.locationtid;      
         }else if( self.locationpage !== '' &&  self.locationpage  !== null && self.locationpage !== undefined){
          redirurl = 'cirrus/path/'+self.locationpath+'/page/' +self.locationpage;
         }
           $location.path(redirurl);

          
        }, function(error) {
        
          console.log('Login Resp Error');
          console.log(error);
           $('#login_loading').hide();      
          self.errorMessage = error.data.msg;
          
        });
        
        
      };
  }]);
  
  
  
  
  app.controller('ResetCtrl', ['$location', '$http', function($location, $http) {
      var self = this;
      
        self.userreset = {useremail: '', username: ''};

         self.reset_err = {email_errmsg: '', username_errmsg: ''};



      self.getUsername = function() {
     $('#reset_u_loading').show();
      console.log(self.userreset.useremail);

      $('#reset_u_loading').show();
      
   
        $http.post('api/resetupw/', {useremail: self.userreset.useremail, getusername:1}).then(function(success) {
         
         console.log('get username Successful');
          console.log(success);
         $('#reset_u_loading').hide();
          $("#getusername-success-modal").modal('toggle');
           self.reset_err = {email_errmsg: '', username_errmsg: ''};

        }, function(error) {
         $('#reset_u_loading').hide();
       console.log('Reset Username UnSuccessful');
        console.log(error);
          self.reset_err = error.data;
          

        });
      };
      
         self.resetPassword = function() {
     $('#reset_pw_loading').show();
      console.log(self.userreset.username);

      $('#reset_pw_loading').show();
      
   
        $http.post('api/resetupw/', {username: self.userreset.username, resetpassword:1}).then(function(success) {
         
         console.log('Edit Successful');
          console.log(success);
         $('#reset_pw_loading').hide();
          $("#resetpassword-success-modal").modal('toggle');
           self.reset_err = {email_errmsg: '', username_errmsg: ''};

        }, function(error) {
         $('#reset_pw_loading').hide();
       console.log('Reset Username UnSuccessful');
        console.log(error);
          self.reset_err = error.data;
          

        });
      };

	self.goToLoginGetUsername = function(){
	  $("#getusername-success-modal").modal('toggle');
	$location.path('/login');
	     
	};      

       self.goToLoginResetPassword = function(){
	  $("#resetpassword-success-modal").modal('toggle');
	$location.path('/login');
	     
	}; 

     self.MyTab = 1;

      self.getmyTab = function(){
       return  self.MyTab;

      };
      self.tabcontrol = function(fun){
                self.MyTab = fun;
      };

  }]);
  

  app.controller('EditPasswordCtrl', ['$location', '$http', '$routeParams', 'UserService', function($location, $http, $routeParams, UserService) {
      var self = this;
       self.userpw = {username:  '', password1: '', password2: ''};

    self.userpw.username = $routeParams.user;
    self.LoggedIn = false;
    if(self.userpw.username === ''){
    $location.path('/accessfailure');
       $location.replace();
    }
   
    

         self.userpwerror =  {password_errmsg: ''};



      self.editPW = function() {
     $('#editpw_loading').show();
      console.log(self.userpw.username);

      $('#editpw_loading').show();
      
   
        $http.post('api/editpw/', {username:  self.userpw.username, password1:  self.userpw.password1,  password2: self.userpw.password2, code: $routeParams.code}).then(function(success){
         console.log('Edit Successful');
          console.log(success);
         $('#editpw_loading').hide();
          $("#editpw-success-modal").modal('toggle');
   
           }, function(error) {
         $('#editpw_loading').hide();
       console.log('EditUPW Unsuccessful');
        console.log(error);
          self.userpwerror = error.data;
          

        });
      };

     
     self.goToLoginEPW = function(){
	if($routeParams.code === undefined){
	
	$("#editpw-success-modal").modal('toggle');

          $location.path('/mycirrus');
          $location.replace();
         
          }else{
          
          $("#editpw-success-modal").modal('toggle');

          
          $location.path('/login');
          $location.replace();

          }

	
		          
	};      



  }]);
  

  app.controller('CirrusViewProfileCtrl', ['$http','$routeParams', 'UserService', '$timeout', function($http, $routeParams, UserService, $timeout) {
      var self = this;
      self.myprofile = {};
       UserService.session().then(function(resp){
       console.log('View Profile User  - UserService call !');
       console.log(resp);
       console.log(UserService.username);
        self.myprofile = resp.data;
      },function(err){
      
      
      });

      console.log($routeParams);
      console.log($routeParams.username);
      self.other_username = $routeParams.username;
      self.profile = {};
      self.getotheruserinfo = function() {
      $http.post('api/viewuserprofile/', {otherusername:self.other_username }).then(function(success) {
                
          console.log('Get Other User Info Response');
          console.log(success);
          self.profile = success.data;
          
           var t = self.profile.join_date.split(/[- :]/);

                        // Apply each element to the Date function
                      var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
                       
                        self.profile.join_date = d;

          
        }, function(error) {
        console.log('viewuserprofile Unsuccessful');
       console.log(error);
             });
      };
      
      self.getotheruserinfo();
      
      self.addAsCoDev = function(){
      
       $http.post('api/codevs/', {addit: 1, cdname: self.other_username}).then(function(resp){
       
       console.log('Add as a codev Button resp ');
       console.log(resp);
       self.isUserinCoDevList = true;
       
       },function(err){
       console.log('Add as a codev Button Err resp ');
       console.log(err);
       
       });
     
           
      };
      
      self.isUserinCoDevList = false;
      
      $http.post('api/codevs/', {isin: 1, cdname: self.other_username}).then(function(resp){
       
       console.log('Is In CoDev list? resp ');
       console.log(resp);
         self.isUserinCoDevList = true;
       
       },function(err){
    console.log('Is In CoDev list? ERR resp ');
       console.log(err);
        self.isUserinCoDevList = false;
       });

      
         self.chatformokay = function(){
             var nC = isEmpty(self.newComment);
                         
              if(!nC){
              	return true;
              }else{
              	return false;
              }   
          };
      
      self.CommentSend = true;

      
      self.sendComment = function(){
         
        var cleannewcomment = $("#viewProfile_comment").val();
        
       console.log(cleannewcomment);
       
      cleannewcomment =  cleannewcomment.replace(/\'/g, '&#39;');
        
     cleannewcomment =  cleannewcomment.replace(/\"/g, '&quot;');
       //'
        cleannewcomment = strip_tags(cleannewcomment);
      var  submitChatObj = {
          comment: cleannewcomment, 
          post_member_id: self.myprofile.user_id, 
          to_member_name: [self.other_username]
         };
  
       $http.post('api/chat/', submitChatObj).then(function(resp){
            console.log('Chat Post Resp');
            console.log(resp);   
      
             $("#viewProfile_comment").val("");

           },function(err){
            console.log('Veiw Profile COmment Post Err Resp');
            console.log(err);
      
      });

      
      self.CommentSend = false;
     
     $timeout(function(){
        self.CommentSend = true;
    }, 1000);
           };
      
      
  }]);
  


  
  
   app.controller('SignUpCtrl', ['$location', '$http',
    function($location, $http) {
      var self = this;
      self.newuser = {username: '', email: '', password1: '', password2: ''};

         self.signuperror = {username_errmsg: '', password_errmsg: '', email_errmsg: '', captcha_errmsg: ''};

     self.refreshCaptcha = function(){
   		 var img = document.images['signup_captchaimg'];
   		 img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
        };



      self.signup = function() {
       $('#signup_loading').show();
      console.log(self.newuser.username);
      console.log(self.newuser.email);
      console.log(self.newuser.password1);
      console.log(self.newuser.password2);
      console.log(self.newuser.captcha);
      
        $http.post('api/signup/', {newuser: self.newuser}).then(function(success) {
         console.log('Signup Successful');
          console.log(success);
         $('#signup_loading').hide();
          $("#signup-success-modal").modal('toggle');
          
        }, function(error) {
         $('#signup_loading').hide();
       console.log('Signup Unsuccessful');
        console.log(error);
          self.signuperror = error.data;
          self.newuser.captcha = null;
          self.refreshCaptcha();
        });
      };

	self.goToLogin = function(){
	
	$location.path('/login');
	$("#signup-success-modal").modal('toggle');
	          
	
	          
	};      



  }]);
  
  
  
 

  
  
   app.controller('CirrusEmailVerificationCtrl', ['$location', '$http', '$routeParams', '$window',  function($location, $http, $routeParams, $window) {
      var self = this;
       self.verif = {};
        self.verif.email = $routeParams.email;
        
        self.verif.user = $routeParams.user;
        
        self.verif.code = $routeParams.code;
        console.log("GOT THE PARAMS");
     console.log(self.verif);
     
     self.verif.verifyit = 1;
     self.msg = '';
     self.verifyerror = false;
     $http.post('api/emailverify/', self.verif).then(function(resp){
     
     console.log('Email Verify Resp');
     console.log(resp);
     self.msg = resp.data;
     
     },function(err){
     
     console.log('Email Verify ERR Resp');
     console.log(err);
     self.msg = err.data.msg;
     self.verifyerror = true;
     });
     
     self.re_send_verification_email = function(){
      
      $http.post('api/emailverify/', {user: self.verif.user, email: self.verif.email, re_send: 1}).then(function(resp){
     
     console.log('Re-Send  Verify Email  Resp');
     console.log(resp);
     self.msg = resp.data;
     
     setTimeout(function(){
     $window.close();
     },2000);
     
     self.verifyerror = false;
     
     },function(err){
     
      console.log('Re-Send  Verify Email ERR  Resp');
     console.log(err);
     self.msg = err.data.msg;
     self.verifyerror = true;
     });
     
     };
     
  }]);

  
  
  app.controller('BrowseCtrl',
    ['$http', 'UserService',  function($http, UserService) {
      var self = this;
     self.loggedin = UserService.isLoggedIn;    
     
     
     self.getIdeaChartData = function(chart, name){
     
	      $http.post('api/chartdata/' , {type: chart}).then(function(resp){
	       console.log('Get Chart Data Resp');
	       console.log(resp);
	       self.chartData = resp.data;
	       
	        var ctitle;
	        var cname;
	        if(chart === 1){
	        ctitle = 'CirrusIdea - # Thoughts In Category';
	       
	        
	            $('#'+ name).highcharts({
		        chart: {
		         backgroundColor: 'rgba(0,0,0,0)',
		            type: 'column',
		            margin: 75,
		            options3d: {
		                enabled: true,
		                alpha: 10,
		                beta: 25,
		                depth: 70
		            }
		        },
		        title: {
		            text: 'CirrusIdea - # Thoughts In Category'
		        },
		       legend:{
		        align: 'left',
		        verticalAlign: 'bottom'
		       
		       },
		        plotOptions: {
		            column: {
		                depth: 25
		            },
		                  },
		        xAxis: {
		            categories: self.chartData.labels
		        },
		        yAxis: {
		            title: {
		                text: null
		            }
		        },
		        series: [{
		            name: 'Thoughts',
		            data: self.chartData.dthoughts
		        }]
		    });
		
	        
	        
	        
	        }else{

	        
	            $('#'+ name).highcharts({
		        chart: {
		         backgroundColor: 'rgba(0,0,0,0)',
		            type: 'column',
		            margin: 75,
		            options3d: {
		                enabled: true,
		                alpha: 10,
		                beta: 25,
		                depth: 70
		            }
		        },
		        title: {
		            text: 'CirrusIdea - $$$ In Category'
		        },
		      legend:{
		        align: 'left',
		        verticalAlign: 'bottom'
		       
		       },
		        plotOptions: {
		            column: {
		                depth: 25
		            },
		             series: {
               			 color: '#94FF94'
            			}
		        },
		        xAxis: {
		            categories: self.chartData.labels
		        },
		        yAxis: {
		            title: {
		                text: null
		            }
		        },
		        series: [{
		            name: '$',
		            data: self.chartData.dmoney
		        }]
		    });
	        }
	        	
  


	      
	        
	    },function(err){
	       console.log('Get Chart Data ERR Resp');
	       console.log(err);
	    
	    });
	
	     
     };
  

          self.getIdeaChartData(1, 'ideasChart');
     self.getIdeaChartData(2, 'donationsChart');

     
     
     
      
   }]);
    



    
    app.controller('CirrusSearchPageCtrl',
    ['$http', '$location', '$routeParams', '$sce', 'UserService',  'SearchTabService', function($http, $location, $routeParams, $sce, UserService, SearchTabService) {
      var self = this;
       self.searchterm = $routeParams.search;
       self.loggedin = UserService.isLoggedIn;          

       self.getsearchTabFromService = function(){
         return SearchTabService.getSearchTab();
         };
           
       self.tabcontrol = function(fun){
            SearchTabService.setSearchTab(fun);
       };
       
           

      $("#searching").html('<img src="images/loading.gif" />');
      
   
    }]);
    
    
    
   app.controller('CirrusIdeaPageCtrl',
    ['$http', '$location', '$routeParams', '$sce', 'UserService', '$window',  function($http, $location, $routeParams, $sce, UserService, $window) {
      var self = this;
       
        
 self.path = $routeParams.path;
     self.page = $routeParams.page;
      
      
     UserService.session().then(function(res){
     console.log('CirrusIdeaPageCtrl  Is Logged in? ');
     console.log(res);
     
      self.loggedin = UserService.isLoggedIn;
      
      console.log(self.loggedin);
     });
   
   
   /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////PROJECT DATA//////////////////////////////////////////////
   
     self.projectdata = {};
     self.projectdata.isOwner = false;
     self.projectdata.isuptodate = false;

     self.projectdataopen = false;
    self.showprojectdata = false;
   
   self.getProjectData = function(){
     $http.post('api/projectdata/', {path: self.path, page: self.page}).then(function(resp){
     	console.log('Project Data Resp ');
     	console.log(resp);
        
     	self.projectdata = resp.data;
     	 if(self.projectdata.headline || self.projectdata.slogan || self.projectdata.synopsis){
     	 self.showprojectdata = true;
     	 }
     
     },function(err){
     	console.log('Project Data  ERR Resp ');
     	console.log(err);
     
     });
    };
    
    self.getProjectData();
   
   self.showProjectData = function(){
   
	   if(self.projectdataopen){
	   self.projectdataopen = false;
	   }else{
	   self.projectdataopen = true;
	   }
	 };

     self.updateprojectdata = function() {
      self.projectdata.isuptodate = true;
     $http.post('api/projectdata/', 
             {
             path: self.path, 
             page: self.page, 
             headline: self.projectdata.headline, 
             synopsis: self.projectdata.synopsis,
             slogan: self.projectdata.slogan,
             update: 1
             }).then(function(resp){
     	console.log('Project Data Resp ');
     	console.log(resp);
      self.projectdata = resp.data;
     	    
     	     },function(err){
     	console.log('Project Data  ERR Resp ');
     	console.log(err);
     self.projectdata.isuptodate = false;
     });

     
     
     };
     
    self.toggleisuptodate = function() {
    
    if(self.projectdata.isuptodate){
    self.projectdata.isuptodate = false;
    }else{
     self.projectdata.isuptodate= true;
    }
    
    };
    
    
      self.currentDelPfileID;
      
      self.deletePfilebtn = function(pojfilenum){
       
        console.log('Open Delete Project File Dialog Confirm');
        console.log(pojfilenum);
       self.currentDelPfileID = pojfilenum;
        $('#DeleteProjectFile').modal('toggle');
                             
     };
     
 
     
     self.deletePfile = function(projfileNum){
        console.log('Deleting Project File!');
        console.log('Project File # ' + projfileNum);
         $http.post('api/projectdata/',{path: self.path, page: self.page, p_file_num: projfileNum, del: 1}).then(function(resp){
         console.log('Delete Project File Response');
         console.log(resp);

              self.getProjectData();
              
             $('#DeleteProjectFile').modal('toggle');                 
         },function(err){
         console.log('Delete Project File ERR Response');
         console.log(err);
         });
         
          
     };
     
	     
	self.uploadProjectDataFile = function(){
	
	  console.log(self.p_file);
	                 
             $('#Projloader-icon').show();
             
            $('#addprojectfileform').ajaxSubmit({ 
                url: 'api/pfileuploader/',
                method: 'POST',
                beforeSubmit: function() {
                     $("#ProjfileUploadProgress").width('0%');
                      $("#ProjuploadProgressContainer").show();
                   
                },
                uploadProgress: function (event, position, total, percentComplete){	
                  $("#ProjfileUploadProgress").width(percentComplete + '%');
		  $("#ProjfileUploadProgress").html('<div id="progress-status">' + percentComplete +' %</div>')
                     },
                success:function (resp){
                  console.log('Project File Upload Response ' + resp);
                  console.log(resp);   
                  self.getProjectData();
                                       
                   self.p_file = [];
                   $('#Projloader-icon').hide();
                    $("#ProjfileUploadProgress").width('0%');
                    $("#ProjuploadProgressContainer").hide();
                },
                error:function(err){
               console.log(err);
                },
                clearForm: true,
               resetForm: true 
            }); 

	
	};
	    
      
    //////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////Payout Stats //////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////
    
     self.payoutstats = {};
     self.payoutstats.isOwner = false;
         self.payoutstats.payoutchartData = {};
     $http.post('api/payoutstats/', {path: self.path, page: self.page}).then(function(resp){
     	console.log('Payout Stats Resp ');
     	console.log(resp);
      
     	self.payoutstats.tabledata = resp.data;
    
     },function(err){
     	console.log('Payout Stats ERR Resp ');
     	console.log(err);
     
     });
     
   self.payoutstatsopen = false;
   
   self.showPayoutstat = function(){
   
	   if(self.payoutstatsopen){
	   self.payoutstatsopen = false;
	   }else{
	   self.payoutstatsopen = true;
	   self.getpayoutChartData(3, 'payoutChart');
	   }
	 };
    
    
     self.getpayoutChartData = function(chart){
     
	      $http.post('api/chartdata/' , {type: chart, path: self.path, page: self.page}).then(function(resp){
	       console.log('Get Chart Data Resp');
	       console.log(resp);
	       
	      self.payoutstats.payoutchartData = resp.data;

 	       
 	       var chartdata = [];
 	       ////fill chart data from resp.data //
 	       for( var i= 0; i<resp.data.length; i++){
 	           chartdata[i] = [];
 	           chartdata[i][0] = resp.data[i][0];
 	           chartdata[i][1] = resp.data[i][1];
 	       
 	       } 
 	       
 	       self.wndwidth = $window.innerWidth;

	
	$("#payoutstatschartcontainer").highcharts({
        chart: {
            backgroundColor: 'rgba(0,0,0,0)',
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Payout Stats: ' +  self.page
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Payout Percentage',
            data:    chartdata
            }]
          });


		
	    },function(err){
	       console.log('Get Chart Data ERR Resp');
	       console.log(resp);
	    
	    });
	
	     
     };
  

//angular.element($window).bind('resize', function(){
  //  self.wndwidth  = $window.innerWidth;
  //  self.payoutstats.payoutchartData = {};
   ///    	if( self.payoutstatsopen){

//       self.getpayoutChartData(3, 'payoutChart');
  //  }
    //  });

  
    
    
    //////////////////////////////////////////////////////////////////////////////////////
    /////////////////Funds Data/////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////
    
    
     
     self.donationItem = self.path.replace('files', 'CirrusIdeas') +'/'+ self.page;
       
       self.fundsdata = {};  
       
     $http.post('api/fundsdata/', {path: self.path, page: self.page}).then(function(resp){
     	console.log('FundsData Resp ');
     	console.log(resp);
      
     	self.fundsdata = resp.data;
     	
     	if(self.fundsdata.funds >0 && self.fundsdata.payoutvotes > 10 && self.payoutstatsopen){
     	self.getpayoutChartData(3, 'payoutChart');
     	}
     
     },function(err){
     	console.log('FundsData ERR Resp ');
     	console.log(err);
     
     });
     
     
     self.openDonationDialog = function(){
     
     $('#DonationModal').modal('toggle');     
     
     };
     
     
     
   /////////////////////////////////////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////Idea Payout Voting           /////////////////////////
      /////////////////////////////////////////////////////////////////////////////////////////////

      self.payoutVote = function(pos, votesin){
        console.log('Payout Vote Cast ! ');
        console.log(pos);
        

        self.fundsdata.usercanVote = false;
                   
	     $http.post('api/payoutvote/', {path: self.path, page: self.page, payout: pos, numVotes: votesin}).then(function(resp){
	     	console.log('Payout Vote Resp ');
	     	console.log(resp);
	             $http.post('api/fundsdata/', {path: self.path, page: self.page}).then(function(resp){
		     	console.log('FundsData Resp ');
		     	console.log(resp);
		      
		     	self.fundsdata = resp.data;
		     	if(self.fundsdata.funds >0 && self.fundsdata.payoutvotes > 10 && self.payoutstatsopen){
     	self.getpayoutChartData(3, 'payoutChart');
     	}
		     
		     },function(err){
		     	console.log('FundsData ERR Resp ');
		     	console.log(err);
		     
		     });

	     	     
	     },function(err){
	     	console.log('Payout Vote ERR Resp ');
	     	console.log(err);
	     
	     });
	            
              
      };
      
      
     self.needthoughtbarclass = function(){ 
     if(self.fundsdata.moredevneededpercent<40){
     return {'progress-bar' : 1,  'progress-bar-danger': 1, 'progress-bar-striped': 1};
     }else{
     return {'progress-bar' : 1,  'progress-bar-info': 1, 'progress-bar-striped': 1};
     }
     };
     
     self.payoutbarclass = function(){ 
     if(self.fundsdata.moredevneededpercent<40){
     return {'progress-bar': 1, 'progress-bar-warning': 1, 'progress-bar-striped': 1};
     }else{
     return {'progress-bar': 1, 'progress-bar-success': 1, 'progress-bar-striped': 1};
     }
     };
       
       self.addblinkclass = function(){
        if(self.fundsdata.moredevneededpercent<40){
     return {'blinkit': 1};
     }else{
     return {'blinkit': 0};
          }

       };
      
    
      
      
       self.PayoutWidthCtrl = function(){      
        
                         
           $("#payoutPoint").css('left', ($("#PayoutPoll").width()*0.6+7) + 'px');
            $("#payoutPointDollarLeft").css('left', ($("#PayoutPoll").width()*0.55+7) + 'px');
          
            $("#payoutPointDollarRight").css('left', ($("#PayoutPoll").width()*0.65+7) + 'px');
           
           };
           
           
           
           angular.element($window).bind('resize', function(){
             self.PayoutWidthCtrl();
            });

           
          
    

      /////////////////////////////////////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////End Idea Payout Voting   /////////////////////////
      /////////////////////////////////////////////////////////////////////////////////////////////

       
       self.addtoQuicklinks = function(){
       console.log('Add to Quick Links ');
       console.log(self.path);
       console.log(self.page);
       
       $http.post('api/quicklink/', {path: self.path, page: self.page, addit: 1}).then(function(resp){
        console.log('Quick Link Response');
        console.log(resp);
        self.alreadyinQuicklinks = true;
        
       
       },function(err){
       console.log('Quick Link Err Response');
        console.log(err);
        
       
       
       });
       };
       
        self.alreadyinQuicklinks = false;
       
        $http.post('api/quicklink/', {path: self.path, page: self.page, addit: 0, isin: 1}).then(function(resp){
        console.log('Is In Quick Link Response');
        console.log(resp);
        self.alreadyinQuicklinks = true;

       },function(err){
       console.log('Is in Quick Link Err Response');
        console.log(err);
        
           self.alreadyinQuicklinks = false;
       
       });
    
       
    }]);
    
    
      app.controller('CirrusIdeaAdminCtrl',
    ['$http', '$location', '$routeParams', '$sce', 'UserService',  function($http, $location, $routeParams, $sce, UserService) {
      var self = this;
       self.searchterm = $routeParams.search;
       self.loggedin = UserService.isLoggedIn;          
      
    
      self.members = [];
      self.getMemberList = function(){
      $http.get('api/admin/members/').then(function(resp){
      console.log('Admin Members Get Resp');
      console.log(resp);
      self.members = resp.data;
      
      },function(err){
       console.log(err);
      });
      
      };
    self.getMemberList();
      self.scratchresp = "";
    
    
      self.executescratch = function(passdata){
      console.log("Executing Scratch");
      
       $http.post('api/admin/scratch/', passdata).then(function(resp){
         console.log('Execute Scratch Response'); 
         console.log(resp);
         self.scratchresp = resp.data;
         
       },function(err){
          console.log('Execute Scratch Err Response'); 
         console.log(err);

       });
      
      
      };
      
      self.clearscratch = function(){
      self.scratchresp = "";
      
      };
    
     self.payoutStats = [];
       self.getPayoutStats = function(){
       $('#payoutstatsloading').show();
       $http.post('api/admin/payoutstats/',{}).then(function(resp){
         console.log('Get Payout Stats Response'); 
         console.log(resp);
          self.payoutStats =  resp.data;
           $('#payoutstatsloading').hide();
       },function(err){
          console.log('Get Payout Stats Err Response');  
         console.log(err);
           $('#payoutstatsloading').hide();
       });

       
       };

      self.payoutidea = function(ideaID){
      console.log(ideaID);
       
      $http.post('api/ideainfo/', {idea_id: ideaID}).then(function(resp){
      console.log('Get Idea Info ADMIN for path page for getpayout stats');
      console.log(resp);
       var payoutpath = resp.data.path.substring(1);  
      console.log(payoutpath);
         $http.post('api/payoutstats/', {path: payoutpath, page: resp.data.page}).then(function(resp){
            console.log('Payout to STATS Resp ');
            console.log(resp);
         
            $http.post('api/admin/payout/', {distribution: resp.data, ideaiD: ideaID}).then(function(resp){
             console.log('PAYOUT DISTRIB RESP');
             console.log(resp);
             
            },function(err){
            console.log('PAYOUT DISTRIB RESP ERR');
             console.log(err);
            
            });
         
           },function(err){
             console.log('Payout to STATS ERR resp ');
             console.log(err);
           
           
           });
      
      
      },function(err){
      
      console.log('Get Idea Info ADMIN for path page for getpayout stats ERR');
      console.log(err);
      
      
      });
      
      };

       self.paylistrequests = [];
       
       self.getPayListRequests = function(){
       $('#paylistloading').show();
       $http.post('api/admin/paylist/',{}).then(function(resp){
         console.log('Get PayList Response'); 
         console.log(resp);
          self.paylistrequests =  resp.data;
           $('#paylistloading').hide();
       },function(err){
        console.log('Get PayList ERR Response');   
         console.log(err);
           $('#paylistloading').hide();
       });
       
       };
       
       self.paymember = function(memUsername, memID, payamount, paylistid){
       
       $http.post('api/admin/paylist/', {distribute: 1, who: memUsername, userID: memID, amount: payamount, PayListID: paylistid}).then(function(resp){
          console.log('Distribute money response ');
           console.log(resp);
          self.getPayListRequests();
       },function(err){
         console.log('Distribute money response ERR ');
           console.log(err);
       
       
       
       });
      
       
       };
       
	self.deletecomment = function(msgID){
	$http.post('api/admin/contactusmsg/',{delete: 1, messageID: msgID}).then(function(resp){
         console.log('Delete Msg Resp Response'); 
         console.log(resp);
           self.getcontactusMsgs();
        
       },function(err){
        console.log('Get PayList ERR Response');   
         console.log(err);
          
       });

	
	};

       self.contactusmsglist = [];
       
       self.getcontactusMsgs = function(){
       $('#contactusmsglistloading').show();
       $http.post('api/admin/contactusmsg/',{}).then(function(resp){
         console.log('Get ContactUs List Response'); 
         console.log(resp);
          self.contactusmsglist =  resp.data;
           $('#contactusmsglistloading').hide();
       },function(err){
        console.log('Get PayList ERR Response');   
         console.log(err);
           $('#contactusmsglistloading').hide();
       });
       
       };
       
      

      self.action = 1;
       self.actionToggle = function(action){
        self.action = action;
          if(action === 5){
         
          self.getPayoutStats();
          }
          if(action === 4){
           
            self.getPayListRequests();
          }
          if(action === 3){
           
            self.getcontactusMsgs();
          }

       };
       
       self.deleteMember = function(memID){
       
       $http.post('api/admin/members/', {member_id: memID}).then(function(resp){
       
       console.log('Delete Member Resp');
       console.log(resp);
           self.getMemberList();
       },function(err){
       console.log('Delete Member Err Resp');
       console.log(err);
 
       });
       };
       
    
    }]);
    
    

  
   app.controller('DonationCtrl', ['$http', '$location', '$routeParams', '$sce', 'UserService', '$window', function($http, $location, $routeParams, $sce, UserService, $window) {
   
   //////////////////////Donation Control Control!////////////////////
      var self = this; 
      self.ideaID = $routeParams.ideaID;
      self.amount = $routeParams.amount;
      self.success = $routeParams.success;
      
      
      self.user = {};
       UserService.session().then(function(resp){
        
       self.user = resp.data;
       
       });
     
       $http.post('api/ideainfo/' , {idea_id: self.ideaID}).then(function(resp){
                console.log('Get Idea Info');
                 console.log(resp);
                
                  self.path = resp.data.path;
                   self.page = resp.data.page;
                               
		       },function(err){
		       console.log('Idea Info Err');
		       console.log(err);
		    
		    });
         
         
  }]);



    app.controller('ManageAccessCtrl', ['$http', '$location', '$routeParams', '$sce', 'UserService', '$window', function($http, $location, $routeParams, $sce, UserService, $window) {
   
   //////////////////////Manage Access Control!////////////////////
      var self = this; 
      self.idea_id = $routeParams.ideaid;
      self.ideadata = {};
       self.ideastuff= {};
      self.myprofile = {};
      
     $('#manageaccessloading').show();
      
      self.getListOmembers = function(){
      
        $http.post('api/folderprivate/' , {path: self.ideastuff.path, page: self.ideastuff.page, getlistofmembers: 1}).then(function(resp){
                console.log('Get Viewable By Members List Resp');
                 console.log(resp);
                 $('#viewablebyManageAccessdiv').show();
                  self.ideadata = resp.data;
                 $('#manageaccessloading').hide();
                 
		       },function(err){
		       console.log('Get Viewable By Members List ERR Resp');
		       console.log(err);
		    
		    });
		    

      
      
      };
      
      
       UserService.session().then(function(resp){
       console.log('View Profile User  - UserService call !');
       console.log(resp);
       console.log(UserService.username);
        self.myprofile = resp.data;
     
	      ///double check user is the owner of the idea //
	      
		 self.usercodves = [];
		  //////////Get co-dev list for sending messages ///////////////
		      
		      $http.post('api/codevs/', {user_id: self.myprofile.user_id , username: self.myprofile.username, getlist: 1}).then(function(resp){
		            console.log('ManageAccess CoDevs Resp');
		            console.log(resp);   
		            self.usercodves = resp.data;
		             $("#codevloading").hide();
		             
		             
		
		
		             $('#accessCoDevSelect').select2();
		
		
		
		
		      },function(err){
		            console.log('Chat CoDevs Err Resp');
		            console.log(err);
		      
		      });

	      
	      
	      $http.post('api/ideaowner/', {idea_id: self.idea_id, uid: self.myprofile.user_id }).then(function(resp){
	      console.log('User is owner ');    
	      console.log(resp);
	      self.ideastuff = resp.data;
	        
	      	       self.getListOmembers();
	      	       
	        },function(err){
	       
	       console.log('YOU ARE NOT THE OWNER');
	       console.log(err);
	       $location.path('/accessfailure');
	       $location.replace();
	
	      });
	      

     
      },function(err){
      
      
      });
      
      
      
      
     ///////
     self.arrowclassObj = {};
     
      self.arrowclass = function(){
      
       
        if($window.innerWidth > 993){
    self.arrowclassObj = {'glyphicon glyphicon-arrow-right' : 1, 'glyphicon glyphicon-arrow-down' : 0};
        }else{
       self.arrowclassObj = {'glyphicon glyphicon-arrow-right' : 0, 'glyphicon glyphicon-arrow-down' : 1};
        
        }
      };
       self.arrowclass();

      
         
        
    
      /////////////////////////////////////////////////////////////
      //////////////////Manage Idea Access ///////////////////////
      ///////////////////////////////////////////////////////////
         self.removeCoDevfromIdea = function(whotoremove){
                 if(self.myprofile.username !== whotoremove){
             $('#manageaccessloading').show();
             $http.post('api/managefolderprivate/', 
             {
	             removemember: 1, 
	             who: whotoremove, 
	             path: self.ideastuff.path, 
	             page: self.ideastuff.page,  
	             uid: self.myprofile.user_id,
	             idea_id: self.idea_id
              }).then(function(resp){
               console.log('Remove access from your co-dev successfull');
               console.log(resp);
               
               self.getListOmembers();
              
             
             },function(err){
             console.log('Remove access from you co-dev error');
               console.log(err);
             
             });
             
             
             }
         };
          
         self.addCoDev2Idea = function(){
         
          $('#manageaccessloading').show();
             $http.post('api/managefolderprivate/', 
             {
	             who: self.listofCoDevNames, 
	             path: self.ideastuff.path, 
	             page: self.ideastuff.page,  
	             uid: self.myprofile.user_id,
	             idea_id: self.idea_id
              }).then(function(resp){
               console.log('Add access for your co-dev successfull');
               console.log(resp);
               
               self.getListOmembers();
              
             
             },function(err){
             console.log('Add access for your co-dev error');
               console.log(err);
             
             });
          
        
        
        
         };
         
         
         
         
         
         
         
  }]);
  
app.controller('TermsAndConditionsCtrl', [function() {   //////////////////////Terms and Conditions CONTROLLER////////////////////
      var self = this;     
  }]);
  
  
app.controller('PrivacyPolicyCtrl', [function() {   //////////////////////Privacy Policy CONTROLLER////////////////////
      var self = this;     
  }]);
  
})();