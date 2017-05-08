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


   app.compileProvider.directive('cirrusThoughtsll', ['$http', '$routeParams', 'UserService', '$location', '$sce',
    '$window', 'ThoughtOrderByService', 'formDataObject', function($http, $routeParams, UserService, $location, $sce, $window,   ThoughtOrderByService, formDataObject){
     return{
       restrict: 'E',
       priority: 30,
   templateUrl: 'views/thoughts.php',
   controller:  function($scope) {
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
        self.page = $routeParams.page;
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
      
       self.shareThoughtDialogbtn = function(sharethoughtid){
       
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
       
        share_thought_comment += '<br /><br /> <a href="http://www.cirrusidea.com/#/cirrus/path/' + self.path + '/page/' + self.page +'/tid/'+resp.data.id+'">Got to thought @ '+ self.page +'</a>';

       if(resp.data.file_name !== null && resp.data.file_name !== ""){
       share_thought_comment += '<br /><a href="http://www.cirrusidea.com/'+resp.data.path+'" target="_blank">File: '+resp.data.file_name+"</a>";
       }
      
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
            
          
          
            
            
            
            
            
            
             },
   controllerAs: 'thoughtCtrl'

   };
  }]);

  

})();