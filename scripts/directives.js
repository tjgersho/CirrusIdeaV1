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


  
    app.directive('cirrusContent', ['$http', '$routeParams', 'UserService', function($http, $routeParams, UserService){
  return{
   restrict: 'E',
   templateUrl: 'views/cirruscontent.php',
   controller: ['$http', '$routeParams', 'UserService', function($http, $routeParams, UserService){
    var self = this;
    self.progress = 0; 
    
    self.loggedin = UserService.isLoggedIn;
  
    }],
   controllerAs: 'cirrusContentCtrl'

   };
  }]);
  
  
  
  
  app.directive('cirrusNavbar', ['$http', '$routeParams', 'UserService', function($http, $routeParams, UserService){
  return{
   restrict: 'E',
   templateUrl: 'views/cirrusnavbar.php',
   controller: ['$http', '$routeParams', 'UserService', function($http, $routeParams, UserService){
    var self = this;
    
   self.loggedin = UserService.isLoggedIn;
   
   // console.log(self.loggedin);
    }],
   controllerAs: 'cirrusNavCtrl'

   };
  }]);

app.directive('cirrusSearch', ['$http', '$routeParams', '$location', 'UserService', function($http, $routeParams, $location, UserService){
  return{
   restrict: 'E',
   templateUrl: 'views/cirrussearch.php',
   controller: ['$http', '$routeParams', '$location', 'UserService', function($http, $routeParams, $location, UserService){
    var self = this;
     
   self.loggedin = UserService.isLoggedIn;
   
   self.searchterm = '';
    
    self.search = function(){
         if(self.searchterm !== ''){
       $('.navbar-collapse').collapse('hide');
    console.log(self.searchterm);
    $location.path('/search');
    $location.search('search',  self.searchterm);
      $location.replace();
      
      self.searchterm = "";
      }
    };
    
    
    self.searchkeypress = function($event){
    
    console.log($event.keyCode);
        
	    if($event.keyCode === 13){
	    self.search();
	    }
      };

   
       
    }],
   controllerAs: 'cirrusSearchCtrl'

   };
  }]);





  app.directive('viewableBy', ['$http', '$routeParams', function($http, $routeParams){
  return{
   restrict: 'E',
   templateUrl: 'views/viewableby.php',
   controller: ['$http', '$routeParams', 'UserService', function($http, $routeParams, UserService){
    var self = this;
    
   self.path = $routeParams.path;
   self.page = $routeParams.page;

    
    
    self.ideadata = {};
    
    
    self.getViewableByMembers = function(path, page){
    
    $http.post('api/folderprivate/' , {path: path, page: page, getlistofmembers: 1}).then(function(resp){
       console.log('Get Viewable By Members List Resp');
       console.log(resp);
       $('#viewablebydiv').show();
       self.ideadata = resp.data;
    
    },function(err){
       console.log('Get Viewable By Members List ERR Resp');
       console.log(err);
    
    });
    
    };
    
    self.getViewableByMembers($routeParams.path, $routeParams.page);
      
 
    }],
   controllerAs: 'viewableByCtrl'

   };
  }]);



  app.directive('cirrusideaProjectdata', ['$http', '$routeParams', function($http, $routeParams){
  return{
   restrict: 'E',
   templateUrl: 'views/projectdata.php',
   controller: ['$http', '$routeParams', 'UserService', function($http, $routeParams, UserService){
    var self = this;
    
   self.path = $routeParams.path;
   self.page = $routeParams.page;

 
    }],
   controllerAs: 'projectdataCtrl'

   };
  }]);
  
    app.directive('cirrusideaPayoutstats', ['$http', '$routeParams', function($http, $routeParams){
  return{
   restrict: 'E',
   templateUrl: 'views/payoutstats.php',
   controller: ['$http', '$routeParams', 'UserService',function($http, $routeParams, UserService){
    var self = this;
    
   self.path = $routeParams.path;
   self.page = $routeParams.page;

 
    }],
   controllerAs: 'projectdataCtrl'

   };
  }]);



  app.directive('cirrusFooter', ['$http', '$routeParams', 'UserService', function($http, $routeParams, UserService){
  return{
   restrict: 'E',
   templateUrl: 'views/cirrusfooter.php',
   controller: ['$http', 'UserService', function($http, UserService){
    var self = this;
    
   self.path = $routeParams.path;
   self.page = $routeParams.page;

    
   self.loggedin = UserService.isLoggedIn;
   
   
     self.refreshCaptcha = function(){
   		 var img = document.images['shoutout_captchaimg'];
   		 img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
        };

       self.shoutouterr = {};
       self.shoutouterr.captcha_errmsg = "";
       self.shoutouterr.email_errmsg = "";
      self.shoutouterr.yourname_errmsg = "";
       self.shoutouterr.youremail_errmsg = "";
       
       
     self.shoutoutdialogopen = function(){
        self.refreshCaptcha();
        $("#TellAFriend").modal("toggle");
        
        };
     
     self.shoutout = {};
     
     self.shoutout = function(){
    
   
     
     
      var shoutoutmsg =  $("#shoutout_message").val().replace(/\'/g, '&#39;');
        
      shoutoutmsg  =  shoutoutmsg.replace(/\"/g, '&quot;');
       //'
       shoutoutmsg  = strip_tags(shoutoutmsg );
       
      var  submitShoutOutObj = {
         shoutOutemail: self.shoutout.friends_email,
          shoutOutmsg:   shoutoutmsg, 
          shoutOutcaptcha: self.shoutout.captcha,
          shoutOutyourname: self.shoutout.your_name,
          shoutOutyouremail: self.shoutout.your_email
          };

  
     console.log('Shout Out Obj ');
     console.log(submitShoutOutObj);
     
     $http.post("api/shoutout/", submitShoutOutObj).then(function(resp){
     
     console.log("Shout Out Response");
     console.log(resp);
     
        $("#TellAFriend").modal("toggle");
        
         $("#shoutout_friends_email").val('');
        self.shoutout.captcha = null;
        self.shoutouterr.email_errmsg = '';
        self.shoutouterr.captcha_errmsg = '';
      },function(err){
     
     console.log("Shout Out Err Response");
     console.log(err);
     self.shoutouterr = err.data;
     self.shoutout.captcha = null;
      self.refreshCaptcha();
     });
     
     console.log("Shout Out!");
     
     
     }; 
      
      

    
    
    }],
   controllerAs: 'cirrusFooterCtrl'

   };
  }]);
  

  
   
  
  
   app.directive('browseIdeas', ['$http', '$routeParams', 'UserService', '$window', '$sce',  function($http, $routeParams, UserService, $window, $sce){
  return{
   restrict: 'E',
   templateUrl: 'views/browseideas.php',
   controller:  ['$http', '$routeParams', 'UserService', '$window',  '$sce', function($http, $routeParams, UserService, $window,  $sce) {
      var self = this;
      
           
      self.loggedin = UserService.isLoggedIn;
    
   self.path = $routeParams.path;
   self.page = $routeParams.page;

         
    self.ideaprivate = false;
    self.newIdea = "";
    
    self.error1 = false;
    
       self.modalprivate = function(){
           
        if(self.ideaprivate){
          $('#AddCategory').data('bs.modal').$backdrop.css('background-color','blue');
         }else{
         $('#AddCategory').data('bs.modal').$backdrop.css('background-color','black');
       }
       
       };
       

       
 
 	self.submit = function(){
 	 	           
          console.log(self.categories.current);
           self.categories.current = 0;
           
           console.log("ADDING A NEW CATEGORY");
           console.log(self.newIdea);
             self.newIdea = strip_tags(self.newIdea);

          $http.post('api/categories/', {idea: self.newIdea, file_private: self.ideaprivate}).then(function(resp){
          console.log(resp);
          
            console.log(self.categories.current);
           self.categories.current = 0;
           self.getCats();
            $('#AddCategory').modal('toggle');
	     self.newIdea = "";
	     self.ideaprivate = false;
             
              self.error1 = false;
              self.error2 = false;
             
               },function(err){
                 
          if(err.data.msg === 1){
           self.error1 = true;
        self.error2 = false;
          }else if(err.data.msg === 2){
           self.error2 = true;
           self.error1 = false;
          }          
          
          
          });
          
                     
            	
 	};
 	
 	
 	self.close = function(){
 		      
	    $("#newIdea").val('');
	    self.newIdea = "";
	   $("#momentvalue").val('');
           self.ideaprivate = false;
 	
 	};

      
      
      
      
     self.categories = {};
                
           
      self.getCats = function(){
     $http.get('api/categories/').then(function(response){
        console.log(response)
        self.categories = response.data;
       console.log(self.categories);

      },function(err){
      
      });
             };
      

      
     self.getCats();
     

    ///////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////Delete Category //////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////
                        self.currentDelID;
      
       self.deleteCategoryPopup = function(delcatid){
       
        console.log('Open Delete Dialog Confirm');
        console.log(delcatid);
       self.currentDelID = delcatid;
        $('#DeleteCategory').modal('toggle');
                             
     };
     
     self.deleteCategory = function(delctid){
        console.log('Deleting Category!');
        console.log('Cat ID # ' + delctid);
        
         $http.post('api/categories/', {file_id: delctid, delete: 1}).then(function(resp){
         console.log('Delete Category Response');
         console.log(resp);

           self.getCats();
             $('#DeleteCategory').modal('toggle');   
                           
         },function(err){
         console.log('Delete Category Err Response');
         console.log(err);
         
         $('#DeleteCategory').modal('toggle');
         
         $('#ErrorModal').modal('toggle');
         $('#ErrorMsg').html(err.data.msg);
         });
         
          
     };
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
                       
      self.ddclassobj  = {'dropdown-menu': 1, 'dropdown-menu-left': 1, 'dropdown-menu-right': 0}; 
     
      self.dropdownclick = function(e){
      
              
         var windwidth = $window.innerWidth;
         
         var clickloc = e.clientX;
         
         //console.log(windwidth);
         //console.log(clickloc);
         
         
        if(clickloc > 0.55*windwidth){
         self.ddclassobj  = {'dropdown-menu': 1, 'dropdown-menu-left': 0, 'dropdown-menu-right': 1}; 
          }else{
          self.ddclassobj  = {'dropdown-menu': 1, 'dropdown-menu-left': 1, 'dropdown-menu-right': 0}; 
          }
          
          //console.log(self.ddclassobj);
          
         };
         
               
     }],
   controllerAs: 'browseIdeasCtrl'

   };
  }]);



   app.directive('cirrusThoughts', ['$http', '$routeParams', 'UserService', '$location', '$sce',
    '$window', 'ThoughtOrderByService', 'formDataObject', function($http, $routeParams, UserService, $location, $sce, $window,   ThoughtOrderByService, formDataObject){
     return{
       restrict: 'E',
       priority: 30,
   templateUrl: 'views/thoughts.php',
   controller: ['$scope', '$http', '$routeParams', 'UserService', '$location', '$sce',
    '$window', 'ThoughtOrderByService', 'formDataObject', function($scope, $http, $routeParams, UserService, $location, $sce, $window,   ThoughtOrderByService, formDataObject) {
      var self = this;
      self.loggedin = UserService.isLoggedIn;
      
      UserService.session().then(function(resp){
       console.log('UserService Call to session to get user name resp');
       console.log(resp);
       
       self.viewerusername = resp.data.username;
       self.vieweruser_id = resp.data.user_id;
      },function(err){
       console.log('UserService Call to session to get user name ERR resp');
       console.log(err);
      });
      
      self.cirrusGallery = [];
 self.videoplayer = 0;
     self.setvideoplayer = function(player){
     console.log(player);
     self.videoplayer = player;
     };
      
       self.path = $routeParams.path;
       self.urlpath = encodeURI(self.path);
        self.page = $routeParams.page;
        self.urlpage = encodeURI(self.page);
      console.log('RouteParam tid: ');
      console.log($routeParams.tid);
      
      self.focusThoughtID = $routeParams.tid;
      
   self.specialpath = self.path.replace('files', 'CirrusIdeas');
   
           
    self.ideaprivate = false;
   
   self.openAddThought = function(){
   $('#AddThought').modal('toggle');
    if(self.ideaprivate){ 

          $('#AddThought').data('bs.modal').$backdrop.css('background-color','blue');
         }else{
         $('#AddThought').data('bs.modal').$backdrop.css('background-color','black');
       }
     };
   
        $http.post('api/folderprivate/', {path:    self.path, page:    self.page}).then(function(resp){
         
         self.ideaprivate = false;
     
         
         },function(err){
         
         
         self.ideaprivate = true;
     
         
         });
      
      
   /////////////////////////////////////////////////////////////////////////////////////////////
   //////////////////////////////START Put a new Thought ///////////////////////////////////////////
   //////////////////////////////////////////////////////////////////////////////////////////   
      
       self.userFile;
    
          self.formokay = function(){
             var uF = isEmpty(self.userFile);
             var nT = isEmpty(self.newThought);
             
              if(!uF || !nT){
              	return true;
              }else{
              	return false;
              }   
          };
        

        
        self.submit = function(){
        
               var newthoughtstring = $('#newthought').fieldValue()[0];
              newthoughtstring = newthoughtstring.replace(/http:\/\//gi, 'HTTPPROTOCOL234234');
              newthoughtstring = newthoughtstring.replace(/https:\/\//gi, 'HTTPPROTOCOLsss234234');
              newthoughtstring = strip_tags(newthoughtstring, '<a><b><i><br>');
              $('#newthought').val(newthoughtstring);
              
             $('#loader-icon').show();
             
            $('#addthoughtForm').ajaxSubmit({ 
                url: 'api/uploader/',
                method: 'POST',
                //data: JSON.stringify($('#addthoughtForm').serializeObject()),
                beforeSubmit: function() {
                     $("#fileUploadProgress").width('0%');
                      $("#uploadProgressContainer").show();
                   
                },
                uploadProgress: function (event, position, total, percentComplete){	
                  $("#fileUploadProgress").width(percentComplete + '%');
		  $("#fileUploadProgress").html('<div id="progress-status">' + percentComplete +' %</div>')
                     },
                success:function (resp){
                  console.log('Thought Upload Response ' + resp);
                  console.log(resp);   
                  self.getThoughts('/'+$routeParams.path, $routeParams.page, 'date DESC', 1);
                                       
                   self.userFile = [];
                   $('#loader-icon').hide();
                    $('#AddThought').modal('toggle');
                    $("#fileUploadProgress").width('0%');
                    $("#uploadProgressContainer").hide();
                },
                error:function(err){
               console.log(err);
                },
                clearForm: true,
               resetForm: true 
            }); 
            
           
        	 	
 	};
        
       

   /////////////////////////////////////////////////////////////////////////////////////////////
   //////////////////////////////END Put a new Thought ///////////////////////////////////////////
   //////////////////////////////////////////////////////////////////////////////////////////      
      
     ////////////////////////////////////////////////////////////////////////////////////////
     ////////////////////////////Start Delete Thought/////////////////////////////////////////
     ////////////////////////////////////////////////////////////////////////////////////////
     
      self.currentDelId;
      
       self.deleteThoughtDialogbtn = function(delthoughtid){
       
        console.log('Open Delete Dialog Confirm');
        console.log(delthoughtid);
       self.currentDelId = delthoughtid;
        $('#DeleteThought').modal('toggle');
                             
     };
     
     self.deleteThought = function(delthtid){
        console.log('Deleting Thought!');
        console.log('Thought ID # ' + delthtid);
         $http.post('api/deletethought/', {thought_id: delthtid}).then(function(resp){
         console.log('Delete Thought Response');
         console.log(resp);

           self.getThoughts('/'+$routeParams.path, $routeParams.page, ThoughtOrderByService.getThoughtOrder(), self.showPag);
             $('#DeleteThought').modal('toggle');                 
         },function(err){
         console.log('Delete Thought Err Response');
         console.log(err);
         });
         
          
     };
     
     
     
     /////////////////////////////////////////////////////////////////////////////////////////////
     /////////////////////////////////////////////////////////////////////////////////////////////
        
          self.thoughts = {};
                
      self.thoughtPage = function(){
      
	     if(typeof(self.thoughts.thoughtarray) !== 'undefined'){
	      return self.thoughts.thoughtarray[self.thoughts.thoughtarray.length].id; 
	         
	     }else{
	      return 0;
	    
	     }
         
            };        
                

           
      self.getThoughts = function(path, page, orderBy, viewpag){
     $('.LoadOrdering').show();
    
       
     if(self.focusThoughtID !== null){
     $http.post('api/getthoughtviewpage/', { path: path, page:  page, order: orderBy, focusthought_id: self.focusThoughtID, get: 1}).then(function(resp){
     console.log('GEt THought VIew Page for FOcus!!');
     console.log(resp)
     viewpag = Number(resp.data);
      self.showPag = viewpag;
      self.activePag(self.showPag);
     $http.post('api/thoughts/', {path: path, page:  page, order: orderBy, whichpage: viewpag, get: 1}).then(function(response){
        console.log("GetThoughts Response" + response);
        console.log(response);
        
		   self.thoughts = response.data;
		   
		   
		    for (thought in self.thoughts.thoughtarray){
		    
		      var t = self.thoughts.thoughtarray[thought].date.split(/[- :]/);

                        // Apply each element to the Date function
                      var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
                       
                        self.thoughts.thoughtarray[thought].date = d;
		           
		           for(com in self.thoughts.thoughtarray[thought].thoughtcomments){
		                
		                 var tc =  self.thoughts.thoughtarray[thought].thoughtcomments[com].com_date.split(/[- :]/);

                     			   // Apply each element to the Date function
                    			  var dc = new Date(tc[0], tc[1]-1, tc[2], tc[3], tc[4], tc[5]);
                       
                       				 self.thoughts.thoughtarray[thought].thoughtcomments[com].com_date = dc;
 
		             }
		             
		             		      }
		      
		      if(self.thoughts.showcase){
		      
		      
		      var j=0;
		      for (var i = 0; i<self.thoughts.thoughtarray.length; i++){
		       if(self.thoughts.thoughtarray[i].gallery){
		          if(self.thoughts.thoughtarray[i].gallery !== 'undefined'){
		         
		       self.cirrusGallery[j]={file: self.thoughts.thoughtarray[i].gallery, fname: self.thoughts.thoughtarray[i].file_name, headline: self.thoughts.thoughtarray[i].headline.substr(0,40)};
		    
		       
		          j++;
		         }
		       }
		      }
		     }
		    
		          if(self.focusThoughtID !== 'undefined'){
		   setTimeout(function(){ $('html, body').animate({
                          scrollTop: $("#thought_id_" + self.focusThoughtID).offset().top - 100 +'px'
                         }, 'slow');
		      }, 2000);
		      }
		      			       

	        
	        $('.LoadOrdering').hide();
	        },function(err){
	      
	      });
	    
    },function(err){
      console.log("Desicover ID Page # Err Resp");
      console.log(err);
      
          
    $http.post('api/thoughts/', {path: path, page:  page, order: orderBy, whichpage: viewpag, get: 1}).then(function(response){
        console.log("GetThoughts Response" + response);
        console.log(response);
        
		   self.thoughts = response.data;
		   
		   
		    for (thought in self.thoughts.thoughtarray){
		    
		      var t = self.thoughts.thoughtarray[thought].date.split(/[- :]/);

                        // Apply each element to the Date function
                      var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
                       
                        self.thoughts.thoughtarray[thought].date = d;
		           
		           for(com in self.thoughts.thoughtarray[thought].thoughtcomments){
		                
		                 var tc =  self.thoughts.thoughtarray[thought].thoughtcomments[com].com_date.split(/[- :]/);

                     			   // Apply each element to the Date function
                    			  var dc = new Date(tc[0], tc[1]-1, tc[2], tc[3], tc[4], tc[5]);
                       
                       				 self.thoughts.thoughtarray[thought].thoughtcomments[com].com_date = dc;
 
		             }
		             
		             		      }
		      
		      if(self.thoughts.showcase){
		      
		      
		      var j=0;
		      for (var i = 0; i<self.thoughts.thoughtarray.length; i++){
		       if(self.thoughts.thoughtarray[i].gallery){
		          if(self.thoughts.thoughtarray[i].gallery !== 'undefined'){
		         
		       self.cirrusGallery[j]={file: self.thoughts.thoughtarray[i].gallery, fname: self.thoughts.thoughtarray[i].file_name, headline: self.thoughts.thoughtarray[i].headline.substr(0,40)};
		    
		       
		          j++;
		         }
		       }
		      }
		     }
		    
		      	
        
        $('.LoadOrdering').hide();
        },function(err){
      
     });
      
      });
    
		     
     
     }else{
      
    $http.post('api/thoughts/', {path: path, page:  page, order: orderBy, whichpage: viewpag, get: 1}).then(function(response){
        console.log("GetThoughts Response" + response);
        console.log(response);
        
		   self.thoughts = response.data;
		   
		   
		    for (thought in self.thoughts.thoughtarray){
		    
		      var t = self.thoughts.thoughtarray[thought].date.split(/[- :]/);

                        // Apply each element to the Date function
                      var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
                       
                        self.thoughts.thoughtarray[thought].date = d;
		           
		           for(com in self.thoughts.thoughtarray[thought].thoughtcomments){
		                
		                 var tc =  self.thoughts.thoughtarray[thought].thoughtcomments[com].com_date.split(/[- :]/);

                     			   // Apply each element to the Date function
                    			  var dc = new Date(tc[0], tc[1]-1, tc[2], tc[3], tc[4], tc[5]);
                       
                       				 self.thoughts.thoughtarray[thought].thoughtcomments[com].com_date = dc;
 
		             }
		             
		             		      }
		      
		      if(self.thoughts.showcase){
		      
		      
		      var j=0;
		      for (var i = 0; i<self.thoughts.thoughtarray.length; i++){
		       if(self.thoughts.thoughtarray[i].gallery){
		          if(self.thoughts.thoughtarray[i].gallery !== 'undefined'){
		         
		       self.cirrusGallery[j]={file: self.thoughts.thoughtarray[i].gallery, fname: self.thoughts.thoughtarray[i].file_name, headline: self.thoughts.thoughtarray[i].headline.substr(0,40)};
		    
		       
		          j++;
		         }
		       }
		      }
		     }
		    
		      	
        
        $('.LoadOrdering').hide();
        },function(err){
      
     });
     
     }
    
      };
      
      /////////////////////////////////////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////Add Thought Comment /////////////////////////
      /////////////////////////////////////////////////////////////////////////////////////////////
      self.commentthoughtformokay = function(ind){
       var commentthoughtComment = $("#thoughtCommentTextarea_"+ind).val();

              if(!isEmpty(commentthoughtComment)){
              	return true;
              }else{
              	return false;
              } 

      
      };
      
     self.addthoughtComment = function($event, thid, thoughtArrIndex){
        console.log('Post Comment id '+ thid);
       var thought_comment = $($event.target).closest('.commentForm').find('textarea').val();
       
       console.log('Comment ' + thought_comment);
         $( ".postcommenttextarea" ).empty();
         
         
          if(typeof(self.thoughts.thoughtarray[thoughtArrIndex].thoughtcomments) != 'undefined') {
            
            self.thoughts.thoughtarray[thoughtArrIndex].thoughtcomments.unshift({com_date:  new Date(), comment: thought_comment, commenter_name:  self.viewerusername});
         
          }else{
             self.thoughts.thoughtarray[thoughtArrIndex].thoughtcomments = [];
           self.thoughts.thoughtarray[thoughtArrIndex].thoughtcomments[0] =  {com_date:  new Date(), comment: thought_comment, commenter_name:  self.viewerusername};
          
          }
         
         
          $http.post('api/thoughtcomment/', {thought_id: thid, comment: thought_comment});         

         
         
      };
      
      
      self.thoughtcomment_toggleIT = function(tid){ 
		              if(self.thoughts.thoughtarray[tid].thoughtcomment_toggle === 1){
		               self.thoughts.thoughtarray[tid].thoughtcomment_toggle = 0;
		               self.thoughts.thoughtarray[tid].thoughtcomment_togglestyle =  {'glyphicon glyphicon-plus': 1, 'glyphicon glyphicon-menu-up': 0}; 
		               }else{
		               self.thoughts.thoughtarray[tid].thoughtcomment_toggle = 1;
		               self.thoughts.thoughtarray[tid].thoughtcomment_togglestyle =  {'glyphicon glyphicon-plus': 0, 'glyphicon glyphicon-menu-up': 1}; 
		               }
		             };

       /////////////////////////////////////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////END Thought Comment /////////////////////////
      /////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
////////////////////Upadate Thought //////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////



self.outofFocus = function($event , arrindex) {  //// UPDATE Model ////
	
	  console.log($($event.target).data('id'));
          console.log( $($event.target).val());
          
           var editthtid = $($event.target).data('id');
           
           var thoughtheadline = $($event.target).val();
               
            
              thoughtheadline = strip_tags(thoughtheadline, '<a><b><i><br>');

               self.thoughts.thoughtarray[arrindex].headline = thoughtheadline;  
               thoughtheadline = thoughtheadline.replace(/http:\/\//gi, 'HTTPPROTOCOL234234');  
             thoughtheadline = thoughtheadline.replace(/https:\/\//gi, 'HTTPPROTOCOLsss234234');
            $http.post('api/editthought/', {thought_id: editthtid, headline: thoughtheadline}).then(function(resp){
         console.log('Edit Thought Response');
         console.log(resp);
         

         },function(err){
         console.log('Edit Thought Err Response');
         console.log(err);
         });

	
	};
	



////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////







     /////////////////////////////////////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////Add Cred            /////////////////////////
      /////////////////////////////////////////////////////////////////////////////////////////////

      self.addCred = function(thoughtID, thoughtArrIndex){
      
       self.thoughts.thoughtarray[thoughtArrIndex].credvote = false;
       
       var old_rating =  Number(self.thoughts.thoughtarray[thoughtArrIndex].rating);
       
       self.thoughts.thoughtarray[thoughtArrIndex].rating = old_rating+1;
       
       
           var old_percentage = Number(self.thoughts.thoughtarray[thoughtArrIndex].percentratingstyle.width.replace(/%/,''));
           
           console.log(old_percentage);
            var totalInIdea = self.thoughts.ideapeakrating;
            
          
              if(totalInIdea>0){
              self.thoughts.thoughtarray[thoughtArrIndex].percentratingstyle.width = (old_rating+1)/totalInIdea*100 + '%';
              }else{
               self.thoughts.thoughtarray[thoughtArrIndex].percentratingstyle.width = '100%';
              }
         
            

         $http.post('api/thoughtcred/', {thought_id: thoughtID, addcred: 1});
         
              
      };
      
       self.subtractCred = function(thoughtID, thoughtArrIndex){
       
             self.thoughts.thoughtarray[thoughtArrIndex].credvote = false;
       
           var old_rating =  Number(self.thoughts.thoughtarray[thoughtArrIndex].rating);
       
           self.thoughts.thoughtarray[thoughtArrIndex].rating = old_rating-1;
       
       
           var old_percentage = Number(self.thoughts.thoughtarray[thoughtArrIndex].percentratingstyle.width.replace(/%/,''));
           
           console.log(old_percentage);
           
            var totalInIdea = self.thoughts.ideapeakrating;
            self.thoughts.thoughtarray[thoughtArrIndex].percentratingstyle.width = (old_rating-1)/totalInIdea*100 + '%';
            
            
         $http.post('api/thoughtcred/', {thought_id: thoughtID});
         
          
      };
      


      /////////////////////////////////////////////////////////////////////////////////////////////
      ////////////////////////////////////////////////End Cred            /////////////////////////
      /////////////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////
    ////////////////////////////////////////////
    
        self.downloadThoughtFile = function(thoughtFile){
       console.log(thoughtFile);
       
          
       
      var  myTempWindow = window.open('api/downloadFile/index.php?file='+thoughtFile,'','left=10,screenX=10,toolbar=no,status=no,menubar=no,scrollbars=no,resizable=no,top=10, width=50, height=50');
        
      
	
//	var doc = myTempWindow.document.implementation.createHTMLDocument('Download Content');
//	
//	var para = myTempWindow.document.createElement("h1");                       // Create a <p> element
	
//        var t = myTempWindow.document.createTextNode("Downloading Content");       // Create a text node
        
  //      para.appendChild(t);    
                                                     // Append the text to <p>
    //      doc.documentElement.appendChild(para);   
             
          
       //   myTempWindow.document.execCommand('SaveAs','null','download.pdf');
                        
                      //myTempWindow.document.writeln("Downloading... Please be Patient");  
                        
	//myTempWindow.close();
         
        // var iframe = document.getElementById('invisible');
          //    iframe.src = 'api/downloadFile/index.php?file='+thoughtFile;

         
         
         // $http.post('api/downloadFile/', {file:  thoughtFile}).success(function(data, status, headers, config) {
           //         console.log('Download File Resp');
            //        console.log(data);
             ///                          
                                       
             //   }).error(function(data, status, headers, config) {

             //   });
           
        
        
        
        
        };
    
    
    
    
    
    
    
    //////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////
     self.thoughtOrder = ThoughtOrderByService.getThoughtOrder();
      
     self.showPag = 1;
 
     self.getThoughts('/'+$routeParams.path, $routeParams.page, ThoughtOrderByService.getThoughtOrder(), self.showPag);
 
     self.getThoughtsSpecial = function(viewpag){
      if(!(self.focusThoughtID === undefined || self.focusThoughtID === null || self.focusThoughtID === '')){
      //$location.path('/cirrus/path/'+$routeParams.path+'/page/'+$routeParams.page);
      self.focusThoughtID = undefined;
      }
      self.getThoughts('/'+$routeParams.path, $routeParams.page, ThoughtOrderByService.getThoughtOrder(), viewpag);
     
     };
    
 
     self.pagControl = function(pagshow){
     
    
      
     $window.scroll(0,300);
     self.showPag = pagshow;
     return self.showPag;
     
      if(!(self.focusThoughtID === 'undefined')){
      $location.path('/cirrus/path/'+$routeParams.path+'/page/'+$routeParams.page);
      }
      
     };
     
    self.activePag = function(current){
    
    
          if(current === self.showPag){
           return {'active': 1};
          
          }else{
           return {'active': 0};
          }
    
     
     };


      self.setThoughtOrderby = function(dateorrating){
      $('#LoadOrdering').show();
       var od = ThoughtOrderByService.getThoughtOrder();
		if(dateorrating === 1){
		    if (od == 'date DESC' ){
		      ThoughtOrderByService.setThoughtOrder('date ASC');
		    }else{
		      ThoughtOrderByService.setThoughtOrder('date DESC');
		    }
		
		}else{
		    if (od == 'rating DESC' ){
		       ThoughtOrderByService.setThoughtOrder('rating ASC');
		    }else{
		      ThoughtOrderByService.setThoughtOrder('rating DESC');
		    }
		
		}
		
		self.getThoughts('/'+$routeParams.path, $routeParams.page, ThoughtOrderByService.getThoughtOrder(), 1);
              };
     
     
     self.getThoughtOrderClassSelected = function(dateorrating){
      
       var od = ThoughtOrderByService.getThoughtOrder();
          if(dateorrating === 1){   
            if (od == 'date DESC' || od == 'date ASC'){
      		 return {'glyphicon glyphicon-ok': 1};
       	      }else{
       		return {'glyphicon glyphicon-remove': 1};
       	      }
        }else{
           if (od == 'rating DESC' || od == 'rating ASC'){
	       return {'glyphicon glyphicon-ok': 1};
	   }else{
	       return {'glyphicon glyphicon-remove': 1};
	       }
       
        }
            
      };
      
      
      self.getThoughtOrderClassDirection = function(dateorrating){
      
       var od = ThoughtOrderByService.getThoughtOrder();
        
        switch  (od){
         case 'date DESC':
	         if(dateorrating === 1){
	         return {'glyphicon glyphicon-triangle-bottom': 1};
	         }
	    break;
       
       case 'date ASC':
       if(dateorrating === 1){
	         return {'glyphicon glyphicon-triangle-top': 1};
	  }

             break;
       
       case 'rating DESC':
          if(dateorrating === 2){
	         return {'glyphicon glyphicon-triangle-bottom': 1};
	         }
         break;
       
       case 'rating ASC':
       if(dateorrating === 2){
	         return {'glyphicon glyphicon-triangle-top': 1};
	         }
       break;
       
       default:
       return {'glyphicon glyphicon-menu-left': 0};
       break;
       }
     
      };




      self.runLightBox = function(e){
      self.galCurrent = 0;
      $("#cirrusGalleryModal").find('.modal-dialog').css({'margin':'0px',
                               'height':'auto', 'background-color':'black',
                              'width':'100%'});

       $("#cirrusGalleryModal").find('.modal-body').css({'padding':'2px', 'background-color': '#000000'});
                               
                            
                               
       $(".carousel-inner").css( {'width':'100%', 'margin':'2px',  'padding':'2px'});
       $(".carousel-inner item").css( {'width':'100%', 'margin':'2px',  'padding':'2px'});
       $(".carousel-inner img").css({'max-height': $window.innerHeight-50, 'width':'auto'});
        $(".carousel-caption").css('position','relative');
      
       $(".carousel-indicators").css( 'position','relative');
       $("#cirrusCarousel").carousel({interval: false});
             
      $("#cirrusGalleryModal").modal();
      
         };
                            
        self.getActivePill = function(num){
        if(num === self.galCurrent){
        return {'active':1};
        }else{
        return {'active':0};
        }
        
        }               
                            
        self.goToSlide = function(num){
        self.galCurrent = num;
        
        };
        self.galNext = function(){
        if(self.cirrusGallery.length-1 === self.galCurrent){
        self.galCurrent = 0;
        }else{
        self.galCurrent = self.galCurrent+1;
        }
        };
        
        self.galPrev = function(){
        if(self.galCurrent === 0 ){
        self.galCurrent = self.cirrusGallery.length-1;
        }else{
        self.galCurrent = self.galCurrent-1;
        }
        };
               
               
               
     //////////////////////////////////////////////////////////////////////////////
    ////////////////Share Thought -- Get List CoDevs Shareable with//////////////
    /////////////////////////////////////////////////////////////////////////////
    self.ShareWithCoDevs = [];
     self.getViewableByMembers = function(){
    
    $http.post('api/listofCoDevstoShareWith/' , {path: self.path, page: self.page, getlistofmembers: 1}).then(function(resp){
       console.log('Get Share with Codev List Resp');
       console.log(resp);
      
       self.ShareWithCoDevs = resp.data;
              $("#shareCoDevSelect").select2();

    },function(err){
       console.log('Get Share with Codev List ERR Resp');
       console.log(err);
    
    });
    
    };
    
    self.getViewableByMembers(); 
    
        self.sharethought_id;
      
       self.shareThoughtDialogbtn = function(sharethoughtid, thoughtindex){
          self.sharethoughimage = false;
          self.sharethoughtindex =  thoughtindex;
       if(self.thoughts.thoughtarray[thoughtindex].file_type == 'image'){
        self.sharethoughimage = true;
                        }else{
         self.sharethoughimage = false;    
                }  
        console.log('Open Share Dialog');
        console.log(sharethoughtid);
       self.sharethought_id = sharethoughtid;
       $("#shareCoDevSelect").select2();
        $('#ShareThought').modal('toggle');
       
     };
     
     self.submitshareThought = function(thought_id, to_names){
     if(thought_id === self.sharethought_id){
   console.log('Thought ID');
     console.log(thought_id);
  
       
     console.log('Share COMMENT ' );
      var share_comment = $('#shareCommentTxtArea').val();
       console.log(share_comment);
      
             var cleansharecomment =  share_comment.replace(/\'/g, '&#39;');
        
     cleansharecomment =  cleansharecomment.replace(/\"/g, '&quot;');
       //'
     cleansharecomment = strip_tags(cleansharecomment);
    
      
      $http.post('api/sharethought/', {tht_id: thought_id}).then(function(resp){
      console.log("getThought For Share Resp");
      console.log(resp);
      
   var share_thought_comment = "";
       share_thought_comment += "Just wanted to share this thought with you!";
       share_thought_comment += "<br /><br /><b>Note:</b> " + cleansharecomment + "<br />";
       
       if(resp.data.thought !== null && resp.data.thought   !== ""){
       share_thought_comment +=  "<br /><b>Thought:</b> " + resp.data.thought + "<br />";
       }
       if(resp.data.file_name !== null && resp.data.file_name !== ""){
       share_thought_comment += '<br /><a href="http://cirrusidea.com/'+resp.data.path+'" target="_blank">File: '+resp.data.file_name+"</a>";
       }
       share_thought_comment += '<br /><br /> <a href="http://cirrusidea.com/#!/cirrus/path/' + self.path + '/page/' + self.page +'/tid/'+resp.data.id+'">Idea Link</a>';
        
      share_thought_comment = share_thought_comment.replace("'", "&#39;")
     var  submitShareThoughtChatObj = {
          comment: share_thought_comment, 
          post_member_id: self.vieweruser_id, 
          to_member_name: to_names,
          codeok: 1
          };
  
       $http.post('api/chat/', submitShareThoughtChatObj).then(function(resp){
            console.log('Share Thought Chat Post Resp');
            console.log(resp);   
      
     
       $('#ShareThought').modal('toggle');
       
          $('#shareCommentTxtArea').val(null);
          $('#shareCoDevSelect').val(null).trigger("change"); 
          $("#shareCoDevSelect").select2();

           },function(err){
            console.log('Share Thought Chat Post Resp');
            console.log(err);
      
      });
         },function(err){
         
         console.log("getThought For Share err Resp");
      console.log(err);
         });      
          }else{
          $('#ShareThought').modal('toggle');
          }
          
     };
     
     

    ///////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////        
               
               
       //////////////////////////////////////////////////////////////////////////////
    ////////////////Report Thought -- //////////////
    /////////////////////////////////////////////////////////////////////////////
     
        self.reportthought_id;
      
       self.reportThoughtDialogbtn = function(reportthoughtid){
       
        console.log('Open Report Dialog');
        console.log(reportthoughtid);
       self.reportthought_id = reportthoughtid;
              $('#ReportThought').modal('toggle');
                             
     };
     
     self.submitreportThought = function(thought_id, to_names){
     if(thought_id === self.reportthought_id){
   console.log('Thought ID');
     console.log(thought_id);
  
       
     console.log('Report COMMENT ' );
      var report_comment = $('#reportCommentTxtArea').val();
       console.log(report_comment);
      
             var cleanreportcomment =  report_comment.replace(/\'/g, '&#39;');
        
     cleanreportcomment =  cleanreportcomment.replace(/\"/g, '&quot;');
       //'
     cleanreportcomment = strip_tags(cleanreportcomment);
    
      
      $http.post('api/sharethought/', {tht_id: thought_id}).then(function(resp){
      console.log("getThought For Share Resp");
      console.log(resp);
      
   var report_thought_comment = "";
       report_thought_comment += "<b>"+ self.viewerusername + "</b> is reporting a thought as Malice!";
       report_thought_comment += "<br /><br /><b>Note:</b> " + cleanreportcomment + "<br />";
       
           if(resp.data.thought !== null && resp.data.thought   !== ""){
       report_thought_comment +=  "<br /><b>Thought:</b> " + resp.data.thought + "<br />";
       }
       if(resp.data.file_name !== null && resp.data.file_name !== ""){
       report_thought_comment += '<br /><a href="http://www.cirrusdea.com/'+resp.data.path+'" target="_blank">File: '+resp.data.file_name+"</a>";
       }
       report_thought_comment += '<br /><br /> <a href="#/cirrus/path/' + self.path + '/page/' + self.page +'/tid/'+resp.data.id+'">Idea Link</a>';
        

     var  submitReportThoughtChatObj = {
          comment: report_thought_comment, 
          post_member_id: self.vieweruser_id, 
          to_member_name: [to_names],
          codeok: 1
          };
  
       $http.post('api/chat/', submitReportThoughtChatObj).then(function(resp){
            console.log('Report Thought Chat Post Resp');
            console.log(resp);   
      
     
       $('#ReportThought').modal('toggle');
       
          $('#reportCommentTxtArea').val(null);
         
           },function(err){
            console.log('Report Thought Chat Post Resp');
            console.log(err);
      
      });
         },function(err){
         
         console.log("getThought For Report err Resp");
      console.log(err);
         });      
          }else{
          $('#ReportThought').modal('toggle');
          }
          
     };
     
     

    ///////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////        
               
               
           
               
               
                
       $window.addEventListener("orientationchange", function() {
	 $("#cirrusGalleryModal").find('.modal-dialog').css({'margin':'0px',
                               'height':'auto', 'background-color':'black',
                              'width':'100%'});

       $("#cirrusGalleryModal").find('.modal-body').css({'padding':'2px',
                               'background-color': '#000000'});
                               
                            
                               
       $(".carousel-inner").css( {'width':'100%', 'margin':'2px',  'padding':'2px'});
       $(".carousel-inner item").css( {'width':'100%', 'margin':'2px',  'padding':'2px'});
       $(".carousel-inner img").css({'max-height': $window.innerHeight-50, 'width':'auto'});
        $(".carousel-caption").css('position','relative');
      
       $(".carousel-indicators").css( 'position','relative');
       $("#cirrusCarousel").carousel({interval: false});

	}, false);            
            
          
          
            
            
            
            
            
            
             }],
   controllerAs: 'thoughtCtrl'

   };
  }]);
  
app.directive('cirrusTextarea', ['$http', function($http){
  return{
  priority : 10,
  restrict: 'A',
  controller:['$scope', '$element', '$attrs', '$http', function ($scope, $element, $attrs, $http){
      
            	      var self = this;
           /*global document:false, $:false */
           
	var txt =  $($element),
	    hiddenDiv = $(document.createElement('div')),
	    content = null;
//	    console.log('textarea width init');
//	    console.log(txt.width());
	    	    
	hiddenDiv.css('width', txt.width()+'px');
//	console.log('hidden Div width init');
//	    console.log(hiddenDiv.width());
	//txt.addClass('txtstuff');
	hiddenDiv.addClass('hiddendiv');
	
	$('body').append(hiddenDiv);
	
	content = $scope.thought.headline;
	
	content = content.replace(/\n/g, '<br />');
	hiddenDiv.html(content);
    //  console.log('hidden div height init');
    //   console.log(hiddenDiv.height());
       $($element).css('height', hiddenDiv.height()+50 + 'px');

	// console.log('new Element  height init');
      // console.log($($element).height());

	
	self.txtkeyup = function ($event) {
	        
	    content = $($event.target).val();

	    content = content.replace(/\n/g, '<br />');
	 
//	      console.log('textarea width');
//	    	    console.log(txt.width());

hiddenDiv.css('width', $($event.target).width()+'px');
   hiddenDiv.html(content);
//	          console.log(hiddenDiv.height());
           $($event.target).css('height', hiddenDiv.height() +50+ 'px');
	   	
	};
	
	self.outofFocus = function($event) {  //// UPDATE Model ////
	
//	  console.log($($event.target).data('id'));
//          console.log( $($event.target).val());
          
           var editthtid = $($event.target).data('id');
           
           var thoughtheadline = $($event.target).val();
           
            $http.post('api/editthought/', {thought_id: editthtid, headline: thoughtheadline}).then(function(resp){
         console.log('Edit Thought Response');
         console.log(resp);

                
         },function(err){
         console.log('Edit Thought Err Response');
         console.log(err);
         });

	
	};
	

    }],
   controllerAs: 'textareaCtrl'
   
   };
  }]);


app.directive('cirrusAddtextarea', [function(){
  return{
  priority : 10,
  restrict: 'A',
  controller: ['$scope', '$element', '$attrs', function ($scope, $element, $attrs){
      
            	      var self = this;
           /*global document:false, $:false */
           
	var txt =  $($element);
	
// console.log('textarea width init');
//	    console.log(txt.width());

	 var   hiddenDiv = $(document.createElement('div'));
	 hiddenDiv.addClass('hiddendiv');
//	console.log('hidden Div width init');
//	    console.log(hiddenDiv.width());


	 var content = null;
	    	    
	hiddenDiv.css('width', txt.width()+'px');
	
	
//	  console.log('textarea width init1');
//	  console.log(txt.width());


	
	 $($element).css('height', hiddenDiv.height()+50 + 'px');
		    
	$('body').append(hiddenDiv);
	
	self.txtkeyup = function ($event) {
	        
	    content = $($event.target).val();
	//  console.log('textarea width');
	  //   console.log( $($event.target).width());
hiddenDiv.css('width', $($event.target).width()+'px');
    
	    content = content.replace(/\n/g, '<br />');
	    
	    hiddenDiv.html(content);
	
         $($event.target).css('height', hiddenDiv.height() +50+ 'px');
	
	};
	  

    }],
   controllerAs: 'addtextareaCtrl'
   
   };
  }]);




   app.directive("fileread", [function () {
    return {
        scope: {
            fileread: "="
        },
        link: function (scope, element, attributes) {
            element.bind("change", function (changeEvent) {
                scope.$apply(function () {
                    scope.fileread = changeEvent.target.files;
                    console.log('File read ' + scope.fileread);
                    console.log(scope.fileread);
                    // or all selected files:
                    // scope.fileread = changeEvent.target.files;
                });
            });
        }
    };
}]);

  app.directive('thoughtPagination', ['$http', '$routeParams', 'UserService', function($http, $routeParams, UserService){
  return{
   restrict: 'E',
   templateUrl: 'views/thoughtpag.php',
   controller: ['$http', 'UserService', function($http, UserService){
    var self = this;

    self.loggedin = UserService.isLoggedIn;
 
    }],
   controllerAs: 'thoughtPagCtrl'

   };
  }]);
  


  app.directive('ownthoughtPagination', ['$http', '$routeParams', 'UserService', function($http, $routeParams, UserService){
  return{
   restrict: 'E',
   templateUrl: 'views/ownthoughtpag.php',
   controller: ['$http', '$routeParams', 'UserService', function($http, $routeParams, UserService){
    var self = this;

    self.loggedin = UserService.isLoggedIn;
 
    }],
   controllerAs: 'thoughtPagCtrl'

   };
  }]);
  

  


  app.directive('cirrusBreadcrumbs', ['$http', '$routeParams', 'UserService', '$location', '$sce',  function($http, $routeParams, UserService, $location, $sce){
  return{
   restrict: 'E',
   templateUrl: 'views/breadcrumbs.php',
   controller: ['$http', '$routeParams', 'UserService', '$location', '$sce', function($http, $routeParams, UserService, $location, $sce) {
      var self = this;
      
      self.links = [];
    
   // self.links = [{path: 'fun/neet', page: 'cool'},
                  
                  // {path: 'fun', page: 'neet'}];
                   
     

      var pathstr =  $routeParams.path;
        self.page = $routeParams.page;
     
     // console.log('BreadCrumb Path! '+pathstr);
     // console.log('SweetNess '+ self.page);
      
     var patharr = pathstr.split("/"); 
        //    console.log(patharr);
            
              
        
         while (patharr.length > 1){
          var temparr = patharr;
          //console.log(patharr);
         // console.log(self.links);
          var sliced = patharr.splice(patharr.length-1,1).join('/');
        //  console.log(sliced);
          
          
          if ( patharr.length === 0){
          self.links.push({path: " ", page: sliced});
          }else{
          self.links.push({path: patharr.join('/'), page: sliced});
          }
               
       //   console.log(patharr);
        //  console.log(self.links);
         }
         
        self.links.reverse();

     }],
   controllerAs: 'breadcrumbCtrl'

   };
  }]);



  app.directive('cirrusSubfolders', ['$http', '$routeParams', 'UserService', '$location', '$sce', '$window',  function($http, $routeParams, UserService, $location, $sce, $window){
  return{
   restrict: 'E',
   templateUrl: 'views/ideaslist.php',
   controller: ['$http', '$routeParams', 'UserService', '$location', '$sce', '$window',  function($http, $routeParams, UserService, $location, $sce, $window) {
      var self = this;
      
        
          
   self.path = $routeParams.path;
   self.page = $routeParams.page;

          self.specialpath = self.path.replace('files', 'CirrusIdeas');

    self.ideaprivate = false;
    self.newIdea = "";
    
    self.error1 = false;
    
       self.modalprivate = function(){
	           
	       if(self.ideaprivate){
	        	$('#AddIdea').data('bs.modal').$backdrop.css('background-color','blue');
	       }else{
	        	$('#AddIdea').data('bs.modal').$backdrop.css('background-color','black');
	       }
	     
	};


       self.openAddIdea = function(){
       $('#AddIdea').modal('toggle');
       console.log('Open Add Idea Dialog');
       console.log(self.ideaprivate);
      
           if(self.ideaprivate){
	        	$('#AddIdea').data('bs.modal').$backdrop.css('background-color','blue');
	       }else{
	        	$('#AddIdea').data('bs.modal').$backdrop.css('background-color','black');
	       }
       };
        
         self.submit = function(){
 	 	           
          
           self.ideas.current = 0;
           self.newIdea = strip_tags(self.newIdea);
           console.log('test');
         $http.post('api/ideas/', {idea: self.newIdea, path: '/'+self.path +'/'+ self.page, file_private: self.ideaprivate, headline: self.headline, synopsis: self.synopsis, slogan: self.slogan,  get: 0}).then(function(resp){
           console.log("Add Idea Resp");
           console.log(resp);
          
          
          self.ideas.current = 0;
          
           self.getIdeas();
           
            $('#AddIdea').modal('toggle');
	
	    self.newIdea = "";
	   self.error1 = false;
           self.error2 = false;
          },function(err){
          console.log(err);
          
           if(err.data.msg === 1){
           self.error1 = true;
        self.error2 = false;
          }else if(err.data.msg === 2){
           self.error2 = true;
           self.error1 = false;
          }   
                          
         });
 	
 	};
 	
 	
 	self.close = function(){
 		      
	    $("#newIdea").val('');
	    self.newIdea = "";
	   $("#momentvalue").val('');
          
 	
 	};

         $http.post('api/folderprivate/', {path:    self.path, page:    self.page}).then(function(resp){
         
         self.ideaprivate = false;
         self.privatedisabled = false;
         
         },function(err){
         
         
         self.ideaprivate = true;
         self.privatedisabled = true;
         
         });

     
    
        self.getIdeas = function(){
        $http.post('api/ideas/', {path: '/'+$routeParams.path+'/'+$routeParams.page, get: 1}).then(function(response){
           
           console.log('The Get Ideas Resp ' +  response);
           console.log(response);
            self.ideas = response.data;
         });
        
        
        };
        
        self.getIdeas();

                                
      self.ddclassobj  = {'dropdown-menu': 1, 'dropdown-menu-left': 1, 'dropdown-menu-right': 0}; 
     
      self.dropdownclick = function(e){
      
         var windwidth = $window.innerWidth;
         
         var clickloc = e.clientX;

         
        if(clickloc > 0.55*windwidth){
         self.ddclassobj  = {'dropdown-menu': 1, 'dropdown-menu-left': 0, 'dropdown-menu-right': 1}; 
          }else{
          self.ddclassobj  = {'dropdown-menu': 1, 'dropdown-menu-left': 1, 'dropdown-menu-right': 0}; 
          }
             
         };
         
         
         ///////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////Delete Idea //////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////
         self.currentDelID;
      
       self.deleteIdeaPopup = function(delIdeaid){
       
        console.log('Open Delete Dialog Confirm');
        console.log(delIdeaid);
       self.currentDelID = delIdeaid;
        $('#DeleteIdea').modal('toggle');
                             
     };
     
     self.deleteIdea = function(delIDaid){
        console.log('Deleting Idea!');
        console.log('Idea ID # ' + delIDaid);
         $http.post('api/ideas/', {file_id: delIDaid, delete: 1}).then(function(resp){
         console.log('Delete Idea Response');
         console.log(resp);

         self.getIdeas();
             $('#DeleteIdea').modal('toggle');   
                           
         },function(err){
         console.log('Delete Idea Err Response');
         console.log(err);
         $('#DeleteIdea').modal('toggle');
         
          
         $('#ErrorModal').modal('toggle');
         $('#ErrorMsg').html(err.data.msg);

         });
         
          
     };
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
                  
         

     }],
     
   controllerAs: 'subfolderlistCtrl'

   };
  }]);





    app.directive('cirrusProfile', ['$http', 'UserService', '$location', function($http, UserService, $location){
  return{
   restrict: 'E',
   templateUrl: 'views/cirrusprofile.php',
   controller: ['$http', 'UserService', '$location', function($http, UserService, $location){
    var self = this;
    self.profile = {};
    self.loggedin = UserService.isLoggedIn;
    
    self.profile.user_id = UserService.user_id;
     self.profile.username = UserService.username;
     $("#editprofilebutton").hide();
     
       self.possibleIdeas = [];
     
      self.getuserprofile = function(){
      
      $("#profileLoading").show();
      $http.post('api/userprofile/', self.profile).then(function(resp){
            console.log('User Profile Resp');
            console.log(resp);   
            self.profile = resp.data;
            
             var t = self.profile.join_date.split(/[- :]/);

                        // Apply each element to the Date function
                      var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
                       
                        self.profile.join_date = d;

                     if(self.profile.privateprofile === 'undefined'){
                     self.profile.privateprofile = 0;
                     }
                     if( self.profile.privateprofile ){
                     
                     $("#PrivateProfile").attr('checked', true);
                     
                     }else{
                     
                       $("#PrivateProfile").attr('checked', false);

                     }
                     
             $("#profileLoading").hide();
             
             
	       $http.post('api/getInterestList/', {}).then(function(resp){
	       console.log('Get Interest List ');
	       console.log(resp);
	          self.possibleIdeas = resp.data;
	          
			 $("#editprofilebutton").show();
			       
			       self.editProfDialogOpen = function(){
			       
			         $("#editProfile").modal('toggle');
			  
			          $('#CirrusIdeaInterestSelect').select2();
			          
			          $('#CirrusIdeaInterestSelect').select2('data', {id: "'INTREST_"+self.profile.interest+"'", text: self.profile.interest});
			          
			       };
		
                   if(self.profile.mailme == 0){
                    $('#NoMail').attr('checked', 'checked');
                   }else{
                   $('#MailMe').attr('checked', 'checked');
                   }
                   
	       },function(err){
	       console.log('Get Interest List  Err');
	       console.log(err);
	       
	       });
	       
	      	      
	      },function(err){
            console.log('User Profile Err Resp');
            console.log(err);
            $("#profileLoading").hide();
      });
      
      
      };
      
      self.getuserprofile();
      
      self.editerr = {
      firstname_errmsg: '',
      lastname_errmsg: '',
      about_errmsg: '',
      interest_errmsg: ''
      };
     self.updateprofile = function(){
     
      console.log("Update Profile");
       console.log($("#PrivateProfile").val());
         
      var aboutMe =  $('#aboutU').val().replace(/\'/g, '&#39;');
        
      aboutMe =  aboutMe.replace(/\"/g, '&quot;');
       //'
        aboutMe = strip_tags(aboutMe); 
         
         var updateProfObj = {
         updateProf: 1, 
         user_id:  self.profile.user_id,
         username: self.profile.username,
         first_name: self.profile.first_name,
         last_name: self.profile.last_name, 
         mailMe: $('input:radio[name=mailmeradio]:checked').val(), 
         aboutme: aboutMe,
         interest:   self.profile.interest,
         privateProf: self.profile.privateprofile        
         };
        
        $http.post('api/userprofile/', updateProfObj).then(function(resp){
            console.log('Update User Profile Resp');
            console.log(resp);   
           
             self.getuserprofile();
             
           $("#editProfile").modal('toggle');
           
         }, function(err){
         
         console.log('Update User Profile  ERR Resp');
            console.log(err); 
         
         });
         




     };  
     
     
     
     
     self.goToResetPW = function(){
                  
          $("#editProfile").modal('toggle');

          
          $location.path('/editpassword/user/'+ self.profile.username);
            $location.replace();
       };
       
       
      self.collecterr = {
      firstname_errmsg: '',
      lastname_errmsg: '',
      paypalemail_errmsg: '',
      };
      
       self.collectDialogOpen = function(){
       
       $("#CollectFunds").modal('toggle');
       
       };
       
       
       self.collectfunds = function(){
       
        
         var collectFundsfObj = {
         user_id:  self.profile.user_id,
         username: self.profile.username,
         first_name: self.profile.first_name,
         last_name: self.profile.last_name, 
         paypalemail: self.profile.paypalemail,
         amount: self.profile.balance
         };
        
        $http.post('api/collectfunds/', collectFundsfObj).then(function(resp){
            console.log('Collect Funds Resp');
            console.log(resp);   
           
             self.getuserprofile();
             
           $("#CollectFunds").modal('toggle');           
         }, function(err){
         
         console.log('Update User Profile  ERR Resp');
            console.log(err); 
         self.collecterr = err.data;
         });
         

      
      
       
       };
               
     }],
   controllerAs: 'cirrusProfileCtrl'

   };
  }]);



  app.directive('cirrusMyideas', ['$http', 'UserService', '$window', function($http, UserService, $window){
  return{
   restrict: 'E',
   templateUrl: 'views/cirrususerideas.php',
   controller: ['$http', 'UserService', '$window', function($http, UserService, $window){
    var self = this;
    self.profile = {};
    self.loggedin = UserService.isLoggedIn;
    self.profile.user_id = UserService.user_id;
    self.profile.username = UserService.username;
     UserService.session().then(function(resp){
      self.profile = resp.data;
     self.loggedin = resp.data.isLoggedIn;
     },function(err){
     
     });
      
      self.thoughts = {};
                
 
      self.getownThoughts = function(pagtoview){
     $('#LoadingOwnthoughts').show();
      
     $http.post('api/userthoughts/', {user_id:self.profile.user_id, username: self.profile.username, viewpag: pagtoview}).then(function(response){
        console.log("GetUserThoughts Response" + response);
        console.log(response);
        
		   self.thoughts = response.data;
		   
		   
		    for (thought in self.thoughts.thoughtarray ){
		      var t = self.thoughts.thoughtarray[thought].date.split(/[- :]/);

                        // Apply each element to the Date function
                      var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
                       
                        self.thoughts.thoughtarray[thought].date = d;
		    
		      }
		      
        
        $('#LoadingOwnthoughts').hide();
        },function(err){
        console.log("GetUserThoughts Err Response" + err);
        console.log(err);

      
     });
    
      };
      
      
       self.showPag = 1;
 
     self.pagControl = function(pagshow){
     $window.scroll(0,0);
     self.showPag = pagshow;
     return pagshow;
     };
     
    self.activePag = function(current){
          if(current === self.showPag){
           return {'active': 1};
          
          }else{
           return {'active': 0};
          }
    };

          

     self.getownThoughts(self.showPag);
     
     
     
         
        self.getIdeas = function(){
                $('#LoadingOwnideas').show();
        console.log('Passing User_id in to get Ideas');
        console.log(self.profile.user_id);

           $http.post('api/userideas/', {user_id: self.profile.user_id}).then(function(response){
           
           console.log('Get User Ideas Resp ');
           console.log(response);
            self.ideas = response.data;
            $('#LoadingOwnideas').hide();
         },function(err){
          console.log('Get UserIdeas Err Resp ');
           console.log(err);
         $('#LoadingOwnideas').hide();
         });
        
        
        };
        
        self.getIdeas();

                                
      self.ddclassobj  = {'dropdown-menu': 1, 'dropdown-menu-left': 1, 'dropdown-menu-right': 0}; 
     
      self.dropdownclick = function(e){
      
         var windwidth = $window.innerWidth;
         
         var clickloc = e.clientX;

         
        if(clickloc > 0.55*windwidth){
         self.ddclassobj  = {'dropdown-menu': 1, 'dropdown-menu-left': 0, 'dropdown-menu-right': 1}; 
          }else{
          self.ddclassobj  = {'dropdown-menu': 1, 'dropdown-menu-left': 1, 'dropdown-menu-right': 0}; 
          }
             
         };
         
         
         ///////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////Delete Idea //////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////
         self.currentDelID;
      
       self.deleteIdeaPopup = function(delIdeaid){
       
        console.log('Open Delete Dialog Confirm');
        console.log(delIdeaid);
       self.currentDelID = delIdeaid;
        $('#DeleteOwnIdea').modal('toggle');
                             
     };
     
     self.deleteIdea = function(delIDaid){
        console.log('Deleting Idea!');
        console.log('Idea ID # ' + delIDaid);
         $http.post('api/ideas/', {file_id: delIDaid, delete: 1}).then(function(resp){
         console.log('Delete Idea Response');
         console.log(resp);

         self.getIdeas();
             $('#DeleteOwnIdea').modal('toggle');   
                           
         },function(err){
         console.log('Delete Idea Err Response');
         console.log(err);
         $('#DeleteOwnIdea').modal('toggle');
         
          
         $('#ErrorModal').modal('toggle');
         $('#ErrorMsg').html(err.data.msg);

         });
         
          
     };
     
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
 self.videoplayer = 0;
     self.setvideoplayer = function(player){
     console.log(player);
     self.videoplayer = player;
     };
      

             
      
     }],
   controllerAs: 'cirrusMyIdeasCtrl'

   };
  }]);



  app.directive('cirrusYoumaylike', ['$http', 'UserService', '$window', function($http, UserService, $window){
  return{
   restrict: 'E',
   templateUrl: 'views/cirrusyoumaylike.php',
   controller: ['$http', 'UserService', '$window', function($http, UserService, $window){
    var self = this;
    self.profile = {};

   
     self.thoughts= {};
  
  
      self.getyoumaylikethoughtPage = function(pag, isort){
       
       $("#searchingthoughts").show();
       
       $http.post('api/thoughtsyoumightlike/', {interest: self.userinterest, page: pag, sort: isort}).then(function(resp){
         console.log('You might be interested Response');
         console.log(resp);
          self.thoughts = resp.data;
          $("#searchingthoughts").hide();
   
                        
         },function(err){
         console.log('You might be interested  ERR Response');
         console.log(err);

         });
      
      };

   
  UserService.session().then(function(resp){
  console.log('CirrusYoumaylike UserService Resp');
  console.log(resp);
   self.loggedin = UserService.isLoggedIn;
    self.profile.user_id = UserService.user_id;
    self.profile.username = UserService.username;
     self.userinterest =  UserService.interest; 
     console.log('Userinterest');
    console.log(self.userinterest);
  
   
      self.paginationpage = 1;
      self.youmaylikeresultsorder = 'date DESC';
      
      self.getyoumaylikethoughtPage(self.paginationpage,  self.searchresultsorder);

  
  },function(err){
  console.log('CirrusYoumaylike UserService Err Resp');
  console.log(err);
   
  });
  
           
    
    
                 
      self.getyoumaylikethoughtPageSpecial = function(pag){
      self.getyoumaylikethoughtPage(pag,  self.youmaylikeresultsorder);
      };
      
       self.activePag = function(current){
          if(current === self.paginationpage){
           return {'active': 1};
          
          }else{
           return {'active': 0};
          }

        };
        
     self.pagControl = function(pag){
     $window.scroll(0,120);
     self.paginationpage = pag;
     return pag;
     };
      
      
      
      
       self.setThoughtOrderby = function(dateorrating){
       $("#searchingthoughts").show();

       
		if(dateorrating === 1){
		    if (self.youmaylikeresultsorder  == 'date DESC' ){
		         self.youmaylikeresultsorder  = 'date ASC';
		    }else{
		     self.youmaylikeresultsorder = 'date DESC';
		    }
		
		}else{
		    if (self.youmaylikeresultsorder  == 'rating DESC' ){
		       self.youmaylikeresultsorder = 'rating ASC';
		    }else{
		      self.youmaylikeresultsorder = 'rating DESC';
		    }
		
		}
		
		self.getyoumaylikethoughtPage(self.paginationpage, self.youmaylikeresultsorder);
              };
     
     
     self.getThoughtOrderClassSelected = function(dateorrating){
      
       var od = self.youmaylikeresultsorder;
           if(dateorrating === 1){   
            if (od == 'date DESC' || od == 'date ASC'){
      		 return {'glyphicon glyphicon-ok': 1};
       	      }else{
       		return {'glyphicon glyphicon-remove': 1};
       	      }
        }else{
           if (od == 'rating DESC' || od == 'rating ASC'){
	       return {'glyphicon glyphicon-ok': 1};
	   }else{
	       return {'glyphicon glyphicon-remove': 1};
	       }
       
        }
            
      };
      
      
      self.getThoughtOrderClassDirection = function(dateorrating){
      
       var od = self.youmaylikeresultsorder;
        
        switch  (od){
         case 'date DESC':
	         if(dateorrating === 1){
	         return {'glyphicon glyphicon-triangle-bottom': 1};
	         }
	    break;
       
       case 'date ASC':
       if(dateorrating === 1){
	         return {'glyphicon glyphicon-triangle-top': 1};
	  }

             break;
       
       case 'rating DESC':
          if(dateorrating === 2){
	         return {'glyphicon glyphicon-triangle-bottom': 1};
	         }
         break;
       
       case 'rating ASC':
       if(dateorrating === 2){
	         return {'glyphicon glyphicon-triangle-top': 1};
	         }
       break;
       
       default:
       return {'glyphicon glyphicon-menu-left': 0};
       break;
       }
     
      };


  self.videoplayer = 0;
     self.setvideoplayer = function(player){
     console.log(player);
     self.videoplayer = player;
     };
      

      
     }],
   controllerAs: 'cirrusYouMayLikeCtrl'

   };
  }]);



  app.directive('cirrusChat', ['$http', 'UserService','$window','$sce', function($http, UserService, $window, $sce){
  return{
   restrict: 'E',
   templateUrl: 'views/cirruschat.php',
   controller: ['$http', 'UserService','$window','$sce', function($http, UserService, $window, $sce){
    var self = this;
    self.profile = {};
    self.loggedin = UserService.isLoggedIn;
    self.profile.user_id = UserService.user_id;
     self.profile.username = UserService.username;
     
     self.chats = {};
     
     ////////////////////////////////////////////////////////////////////////////
     ///////////////////////////////////////// Get Chats ///////////////////////////////////////////////
     /////////////////////////////////////////////////////////////////////////////////////////////////////
      self.getChatStream = function(pagc, sortc){
      
      $http.post('api/chat/', {user_id: self.profile.user_id, username: self.profile.username, pag: pagc, sort: sortc}).then(function(resp){
            console.log('Chat Resp');
            console.log(resp);   
            self.chats = resp.data;
            for(var i=0; i<self.chats.chatarray.length; i++){
            
            if(Number(self.chats.chatarray[i].codeok) === 1){
             self.chats.chatarray[i].comment =  $sce.trustAsHtml(self.chats.chatarray[i].comment);
                     }else{
                     
                     self.chats.chatarray[i].comment =   self.chats.chatarray[i].comment.replace(/&#39;/g, "'");

                     self.chats.chatarray[i].comment =   self.chats.chatarray[i].comment.replace(/&quot;/g, '"');

                     }


                     
                      var t = self.chats.chatarray[i].date.split(/[- :]/);

                        // Apply each element to the Date function
                      var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
                       
                      self.chats.chatarray[i].date = d;
		           
		           for(messg in self.chats.chatarray[i].chatcomments){
		                
		                 var tc =  self.chats.chatarray[i].chatcomments[messg].com_date.split(/[- :]/);

                     			   // Apply each element to the Date function
                    			  var dc = new Date(tc[0], tc[1]-1, tc[2], tc[3], tc[4], tc[5]);
                       
                       				 self.chats.chatarray[i].chatcomments[messg].com_date = dc;
                                   
                                   self.chats.chatarray[i].chatcomments[messg].comment =   self.chats.chatarray[i].chatcomments[messg].comment.replace(/&#39;/g, "'");

                                    self.chats.chatarray[i].chatcomments[messg].comment =   self.chats.chatarray[i].chatcomments[messg].comment.replace(/&quot;/g, '"');
		             }

                    
                    
                    }    
             },function(err){
            console.log('Chat Err Resp');
            console.log(err);
      
      });
      
      
      };
      
   self.chatformokay = function(){
             var nC = isEmpty(self.newcomment);
             var nM = isEmpty(self.newcomment_to_membername);
             
              if(!nC && !nM){
              	return true;
              }else{
              	return false;
              }   
          };
      
       self.chatBackformokay = function(ind){
          var chat_back_commentCheck = $("#chatbackTextarea_"+ind).val();
              //var chat_back_commentCheck = $(button).closest('.chatbackForm');
              
                          

              if(!isEmpty(chat_back_commentCheck)){
              	return true;
              }else{
              	return false;
              } 
               
          };
      
      self.submitComment = function(){
      
   
       var cleannewcomment =  self.newcomment.replace(/\'/g, '&#39;');
        
      cleannewcomment =  cleannewcomment.replace(/\"/g, '&quot;');
       //'
        cleannewcomment = strip_tags(cleannewcomment);
      var  submitChatObj = {
          comment: cleannewcomment, 
          post_member_id: self.profile.user_id, 
          to_member_name: self.newcomment_to_membername
          };
  
       $http.post('api/chat/', submitChatObj).then(function(resp){
            console.log('Chat Post Resp');
            console.log(resp);   
      
      self.paginationpage = 1;
      self.chatresultsorder = 'comment_date DESC';
      
     self.getChatStream(self.paginationpage,  self.chatresultsorder);
     self.newcomment = "";
     self.newcomment_to_membername = [];
     
                   
                    $('#chatCoDevSelect').val(null).trigger("change"); 
                   $('#chatCoDevSelect').select2();
                   
           },function(err){
            console.log('Chat Post Err Resp');
            console.log(err);
      
      });

      
      };
      
      self.paginationpage = 1;
      self.chatresultsorder = 'comment_date DESC';
      
     self.getChatStream(self.paginationpage,  self.chatresultsorder);
      
      self.getChatStreamSpecial = function(pag){
      self.getChatStream(pag,  self.chatresultsorder);
      };
      
       self.activePag = function(current){
          if(current === self.paginationpage){
           return {'active': 1};
          
          }else{
           return {'active': 0};
          }

        };
        
     self.pagControl = function(pag){
     $window.scroll(0,120);
     self.paginationpage = pag;
     return pag;
     };
      
      
      //////////Get co-dev list for sending messages ///////////////
      
      $http.post('api/codevs/', {user_id: self.profile.user_id, username: self.profile.username, getlist: 1}).then(function(resp){
            console.log('Chat CoDevs Resp');
            console.log(resp);   
            self.usercodves = resp.data;
             $("#codevloading").hide();
             
             


                   $('#chatCoDevSelect').select2();




      },function(err){
            console.log('Chat CoDevs Err Resp');
            console.log(err);
      
      });

      
      
      /////////////////////////////////////////////////////////////
      
      
      
       self.setChatOrderby = function(){
       $("#searchingthoughts").show();

       
		    if (self.chatresultsorder  == 'comment_date DESC' ){
		         self.chatresultsorder  = 'comment_date ASC';
		    }else{
		     self.chatresultsorder = 'comment_date DESC';
		    }
		
		self.getChatStream(self.paginationpage, self.chatresultsorder );
              };
     
           
      
      self.getChatOrderClassDirection = function(){
      
       var od = self.chatresultsorder;
        
        switch  (od){
         case 'comment_date DESC':
	         
	         return {'glyphicon glyphicon-triangle-bottom': 1};
	         
	    break;
       
       case 'comment_date ASC':
       
	         return {'glyphicon glyphicon-triangle-top': 1};

             break;
              
       default:
       return {'glyphicon glyphicon-menu-left': 0};
       break;
       }
     
      };

  self.chatcomment_toggleIT = function($index){
      
        if(self.chats.chatarray[$index]['chatcomment_toggle'] == 0){
         self.chats.chatarray[$index]['chatcomment_toggle'] = 1;
        
        }else{
        
         self.chats.chatarray[$index]['chatcomment_toggle'] = 0;
         
        }
   
  };
      
    self.addchatComment = function($event, re_to_Chat_ID, re_to_name, $index){
     
     
     console.log('Add chat back Event ');
     console.log($event);
   console.log('Re_to_id ');
     console.log(re_to_Chat_ID);
  
   console.log('INDEX  ');
     console.log($index);
     
     console.log('Chat Back COMMENT ' );
      var chat_back_comment = $($event.target).closest('.chatbackForm').find('textarea').val();
       console.log(chat_back_comment);
       
       var chat_back_comment1  =  chat_back_comment.replace(/\'/g, '&#39;');
        
      chat_back_comment1  =  chat_back_comment1.replace(/\"/g, '&quot;');
       //'
    chat_back_comment1  = strip_tags(chat_back_comment1);

     var  submitChatBackObj = {
          comment: chat_back_comment1, 
          post_member_id: self.profile.user_id, 
          to_member_name: [re_to_name],
          retocomment: re_to_Chat_ID
          };
  
       $http.post('api/chat/', submitChatBackObj).then(function(resp){
            console.log('ChatBack Post Resp');
            console.log(resp);   
      
      self.paginationpage = 1;
      self.chatresultsorder = 'comment_date DESC';
      
     self.getChatStream(self.paginationpage,  self.chatresultsorder);

           },function(err){
            console.log('Chat Back Post Err Resp');
            console.log(err);
      
      });

    };  
      
      
      
     }],
   controllerAs: 'cirrusChatCtrl'

   };
  }]);



  app.directive('cirrusQuicklinks', ['$http', 'UserService', '$window', function($http, UserService, $window){
  return{
   restrict: 'E',
   templateUrl: 'views/cirrusquicklinks.php',
   controller:['$http', 'UserService', '$window', function($http, UserService, $window){
    var self = this;
    self.profile = {};
    self.loggedin = UserService.isLoggedIn;
    
    UserService.session().then(function(resp){
    
    self.profile.user_id = resp.data.user_id;
     self.profile.username = resp.data.username;
      self.getuserquicklinks();
      
      },function(err){
      
      });
      
   $("#quicklinkloading").show();
     
      self.getuserquicklinks = function(){
        $("#quicklinkloading").show();
      $http.post('api/quicklink/', {user_id: self.profile.user_id, username: self.profile.username, getlist: 1}).then(function(resp){
            console.log('Quicklinks Resp');
            console.log(resp);   
            self.qlinklist = resp.data;
              $("#quicklinkloading").hide();
      },function(err){
            console.log('Quicklinks Err Resp');
            console.log(err);
      
      });
      
      
      };
      
     
      
      
         self.ddclassobj  = {'dropdown-menu': 1, 'dropdown-menu-left': 1, 'dropdown-menu-right': 0}; 
     
         self.dropdownclick = function(e){
      
              
         var windwidth = $window.innerWidth;
         
         var clickloc = e.clientX;
         
         //console.log(windwidth);
         //console.log(clickloc);
         
         
        if(clickloc > 0.55*windwidth){
         self.ddclassobj  = {'dropdown-menu': 1, 'dropdown-menu-left': 0, 'dropdown-menu-right': 1}; 
          }else{
          self.ddclassobj  = {'dropdown-menu': 1, 'dropdown-menu-left': 1, 'dropdown-menu-right': 0}; 
          }
          
          //console.log(self.ddclassobj);
          
         };

      
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////Delete Category //////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////
             
       self.deleteQuicklinkPopup = function(delQLid){
       
        console.log('Open Delete Dialog Confirm');
        console.log(delQLid);
       self.currentQLDelID = delQLid;
        $('#DeleteQuicklink').modal('toggle');
                             
     };
     
     self.deleteQuicklink = function(delQLid){
        console.log('Deleting QUICKLINK!');
        console.log('QL ID # ' + delQLid);
        
         $http.post('api/quicklink/', {quicklink_id: delQLid, delete: 1}).then(function(resp){
         console.log('Delete Quicklink Response');
         console.log(resp);

          self.getuserquicklinks();
             $('#DeleteQuicklink').modal('toggle');   
                           
         },function(err){
         console.log('Delete Quicklink Err Response');
         console.log(err);
         
         });
         
          
     };
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
                       

      
  
      
     }],
   controllerAs: 'cirrusQuicklinkCtrl'

   };
  }]);



  app.directive('cirrusCodevs', ['$http', 'UserService', '$window', function($http, UserService, $window){
  return{
   restrict: 'E',
   templateUrl: 'views/cirruscodevs.php',
   controller: ['$http', 'UserService', '$window', function($http, UserService, $window){
    var self = this;
    self.profile = {};
    self.loggedin = UserService.isLoggedIn;
    self.profile.user_id = UserService.user_id;
     self.profile.username = UserService.username;
     
     self.getuserCoDevs = function(){
      $("#codevloading").show();
      $http.post('api/codevs/', {user_id: self.profile.user_id, username: self.profile.username, getlist: 1}).then(function(resp){
            console.log('CoDevs Resp');
            console.log(resp);   
            self.codevlist = resp.data;
             $("#codevloading").hide();
      },function(err){
            console.log('CoDevs Err Resp');
            console.log(err);
      
      });
      
      
      };
      
      self.getuserCoDevs();
      
      
         self.ddclassobj  = {'dropdown-menu': 1, 'dropdown-menu-left': 1, 'dropdown-menu-right': 0}; 
     
         self.dropdownclick = function(e){
      
              
         var windwidth = $window.innerWidth;
         
         var clickloc = e.clientX;
         
         //console.log(windwidth);
         //console.log(clickloc);
         
         
        if(clickloc > 0.55*windwidth){
         self.ddclassobj  = {'dropdown-menu': 1, 'dropdown-menu-left': 0, 'dropdown-menu-right': 1}; 
          }else{
          self.ddclassobj  = {'dropdown-menu': 1, 'dropdown-menu-left': 1, 'dropdown-menu-right': 0}; 
          }
          
          //console.log(self.ddclassobj);
          
         };

      
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////Delete Category //////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////
             
       self.deleteCoDevPopup = function(delCDid){
       
        console.log('Open Delete Dialog Confirm');
        console.log(delCDid);
       self.currentCDDelID = delCDid;
        $('#DeleteCodev').modal('toggle');
                             
     };
     
     self.deleteCodev = function(delCDid){
     
        console.log('Deleting CoDev!');
        console.log('CD ID # ' + delCDid);
        
         $http.post('api/codevs/', {codev_id: delCDid, delete: 1}).then(function(resp){
         console.log('Delete CoDev Response');
         console.log(resp);
         
          self.getuserCoDevs();
             $('#DeleteCodev').modal('toggle');   
                           
         },function(err){
         console.log('Delete CoDev Err Response');
         console.log(err);
         
         });
         
          
     };
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
                       

      
        
     }],
   controllerAs: 'cirrusCoDevsCtrl'

   };
  }]);






////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ///////////////////////////////////////////////Search Directives/////////////////////////////////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
 
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
  app.directive('cirrusSearchideas', ['$http', 'UserService', '$routeParams', '$window', 'SearchTabService', function($http, UserService, $routeParams, $window, SearchTabService){
  return{
   restrict: 'E',
   templateUrl: 'views/searchideas.php',
   controller: ['$http', 'UserService', '$routeParams', '$window', 'SearchTabService', function($http, UserService, $routeParams, $window, SearchTabService){
    var self = this;
    self.profile = {};
    self.loggedin = UserService.isLoggedIn;
    self.profile.user_id = UserService.user_id;
    self.profile.username = UserService.username;
       self.searchterm = $routeParams.search;
  
      self.getsearchIdeaPage = function(pag, isort){
       
       $("#searching").show();
       
       $http.post('api/searchideas/', {searchterm: self.searchterm, page: pag, sort: isort}).then(function(resp){
         console.log('Search Response');
         console.log(resp);
          self.searchResults = resp.data;
          $("#searching").hide();
   
                            if(self.searchResults.ideaarray.length<1){
                  SearchTabService.setSearchTab(2);
                  }   
         },function(err){
         console.log('Search ERR Response');
         console.log(err);

         });
      
      };
      
      self.paginationpage = 1;
      
     self.getsearchIdeaPage(self.paginationpage, 2);
      
       self.activePag = function(current){
          if(current === self.paginationpage){
           return {'active': 1};
          
          }else{
           return {'active': 0};
          }

        };
        
     self.pagControl = function(pag){
     $window.scroll(0,120);
     self.paginationpage = pag;
     return pag;
     };
      
     }],
   controllerAs: 'cirrusSearchIdeaCtrl'

   };
  }]);
 
 
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
  app.directive('cirrusSearchthoughts', ['$http', 'UserService', '$routeParams', '$window', 'SearchTabService', function($http, UserService, $routeParams, $window, SearchTabService){
  return{
   restrict: 'E',
   templateUrl: 'views/searchthoughts.php',
   controller: ['$http', 'UserService', '$routeParams', '$window', 'SearchTabService', function($http, UserService, $routeParams, $window, SearchTabService){
    var self = this;
    self.profile = {};
    self.loggedin = UserService.isLoggedIn;
    self.profile.user_id = UserService.user_id;
    self.profile.username = UserService.username;
       self.searchterm = $routeParams.search;
  
        self.thoughts= {};
  
  
      self.getsearchthoughtPage = function(pag, isort){
       
       $("#searchingthoughts").show();
       
       $http.post('api/searchthoughts/', {searchterm: self.searchterm, page: pag, sort: isort}).then(function(resp){
         console.log('Search thoughts Response');
         console.log(resp);
          self.thoughts = resp.data;
          $("#searchingthoughts").hide();
   
                  if(self.thoughts.thoughtarray.length<1){
                  SearchTabService.setSearchTab(3);
                  }         
         },function(err){
         console.log('Search thoughts ERR Response');
         console.log(err);

         });
      
      };
      
      self.paginationpage = 1;
      self.searchresultsorder = 'date DESC';
      
     self.getsearchthoughtPage(self.paginationpage,  self.searchresultsorder);
      
      self.getsearchthoughtPageSpecial = function(pag){
      self.getsearchthoughtPage(pag,  self.searchresultsorder);
      };
      
       self.activePag = function(current){
          if(current === self.paginationpage){
           return {'active': 1};
          
          }else{
           return {'active': 0};
          }

        };
        
     self.pagControl = function(pag){
     $window.scroll(0,120);
     self.paginationpage = pag;
     return pag;
     };
      
      
      
      
       self.setThoughtOrderby = function(dateorrating){
       $("#searchingthoughts").show();

       
		if(dateorrating === 1){
		    if (self.searchresultsorder  == 'date DESC' ){
		         self.searchresultsorder  = 'date ASC';
		    }else{
		     self.searchresultsorder = 'date DESC';
		    }
		
		}else{
		    if (self.searchresultsorder  == 'rating DESC' ){
		       self.searchresultsorder = 'rating ASC';
		    }else{
		      self.searchresultsorder = 'rating DESC';
		    }
		
		}
		
		self.getsearchthoughtPage(self.paginationpage, self.searchresultsorder);
              };
     
     
     self.getThoughtOrderClassSelected = function(dateorrating){
      
       var od = self.searchresultsorder;
           if(dateorrating === 1){   
            if (od == 'date DESC' || od == 'date ASC'){
      		 return {'glyphicon glyphicon-ok': 1};
       	      }else{
       		return {'glyphicon glyphicon-remove': 1};
       	      }
        }else{
           if (od == 'rating DESC' || od == 'rating ASC'){
	       return {'glyphicon glyphicon-ok': 1};
	   }else{
	       return {'glyphicon glyphicon-remove': 1};
	       }
       
        }
            
      };
      
      
      self.getThoughtOrderClassDirection = function(dateorrating){
      
       var od = self.searchresultsorder;
        
        switch  (od){
         case 'date DESC':
	         if(dateorrating === 1){
	         return {'glyphicon glyphicon-triangle-bottom': 1};
	         }
	    break;
       
       case 'date ASC':
       if(dateorrating === 1){
	         return {'glyphicon glyphicon-triangle-top': 1};
	  }

             break;
       
       case 'rating DESC':
          if(dateorrating === 2){
	         return {'glyphicon glyphicon-triangle-bottom': 1};
	         }
         break;
       
       case 'rating ASC':
       if(dateorrating === 2){
	         return {'glyphicon glyphicon-triangle-top': 1};
	         }
       break;
       
       default:
       return {'glyphicon glyphicon-menu-left': 0};
       break;
       }
     
      };



      
      
      
     }],
   controllerAs: 'cirrusSearchThoughtCtrl'

   };
  }]);
 
  
 
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
  app.directive('cirrusSearchmembers', ['$http', 'UserService', '$routeParams', '$window',  function($http, UserService, $routeParams, $window){
  return{
   restrict: 'E',
   templateUrl: 'views/searchmembers.php',
   controller: ['$http', 'UserService', '$routeParams', '$window', function($http, UserService, $routeParams, $window){
    var self = this;
    self.profile = {};
    self.loggedin = UserService.isLoggedIn;
    self.profile.user_id = UserService.user_id;
    self.profile.username = UserService.username;
       self.searchterm = $routeParams.search;
    
      self.getsearchMemberPage = function(pag, isort){
       
       $("#searchingmembers").show();
       
       $http.post('api/searchmembers/', {searchterm: self.searchterm, page: pag, sort: isort}).then(function(resp){
         console.log('Search Members Response');
         console.log(resp);
          self.searchResults = resp.data;
          $("#searchingmembers").hide();
   
              
         },function(err){
         console.log('Search Members ERR Response');
         console.log(err);

         });
      
      };
      
      self.paginationpage = 1;
              self.searchresultsorder = 'username ASC';
              
    self.getsearchMemberPage(self.paginationpage, self.searchresultsorder);
          
          
      self.getsearchMemberPageSpecial = function(pag){
      self.getsearchMemberPage(pag,  self.searchresultsorder);
      };     
          
       self.activePag = function(current){
          if(current === self.paginationpage){
           return {'active': 1};
          
          }else{
           return {'active': 0};
          }

        };
        
     self.pagControl = function(pag){
     $window.scroll(0,120);
     self.paginationpage = pag;
     return pag;
     };
      
      

      
       self.setMemberOrderby = function(usernameorcred){
       $("#searchingmembers").show();

       
		if(usernameorcred === 1){
		    if (self.searchresultsorder  == 'username DESC' ){
		         self.searchresultsorder  = 'username ASC';
		    }else{
		     self.searchresultsorder = 'username DESC';
		    }
		
		}else{
		    if (self.searchresultsorder  == 'cred DESC' ){
		       self.searchresultsorder = 'cred ASC';
		    }else{
		      self.searchresultsorder = 'cred DESC';
		    }
		
		}
		
		self.getsearchMemberPage(self.paginationpage, self.searchresultsorder);
              };
     
     
     self.getMemberOrderClassSelected = function(usernameorcred){
      
       var od = self.searchresultsorder;
           if(usernameorcred === 1){   
            if (od == 'username DESC' || od == 'username ASC'){
      		 return {'glyphicon glyphicon-ok': 1};
       	      }else{
       		return {'glyphicon glyphicon-remove': 1};
       	      }
        }else{
           if (od == 'cred DESC' || od == 'cred ASC'){
	       return {'glyphicon glyphicon-ok': 1};
	   }else{
	       return {'glyphicon glyphicon-remove': 1};
	       }
       
        }
            
      };
      
      
      
      self.getMemberOrderClassDirection = function(usernameorcred){
      
       var od = self.searchresultsorder;
        
        switch  (od){
         case 'username DESC':
	         if(usernameorcred === 1){
	         return {'glyphicon glyphicon-triangle-bottom': 1};
	         }
	    break;
       
       case 'username ASC':
       if(usernameorcred === 1){
	         return {'glyphicon glyphicon-triangle-top': 1};
	  }

             break;
       
       case 'cred DESC':
          if(usernameorcred === 2){
	         return {'glyphicon glyphicon-triangle-bottom': 1};
	         }
         break;
       
       case 'cred ASC':
       if(usernameorcred === 2){
	         return {'glyphicon glyphicon-triangle-top': 1};
	         }
       break;
       
       default:
       return {'glyphicon glyphicon-menu-left': 0};
       break;
       }
     
      };


      
      
      
      
      
      
     }],
   controllerAs: 'cirrusSearchMemberCtrl'

   };
  }]);
 
 

 
 
 
})();