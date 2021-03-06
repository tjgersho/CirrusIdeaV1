<!DOCTYPE html>
<html ng-app="app" flow-init>
<head>
  <title>basic</title>
  <script src="../scripts/vendors/angular.min.js"></script>
  <script src="ng-flow-standalone.min.js"></script>
  <script src="app.js"></script>
  <link href="../bootstrap/css/bootstrap.css" rel="stylesheet"/>
</head>
<body flow-prevent-drop flow-drag-enter="style={border: '5px solid green'}"  flow-drag-leave="style={}"  ng-style="style">


<div class="container"  ng-controller="progressController">  
  <h1>flow basic example</h1>
  <hr class="soften"/>

  <div class="row">
    <div class="span6">
      <h2>Inputs:</h2>

      <input type="file" flow-btn/>
      <input type="file" flow-btn flow-directory ng-show="$flow.supportDirectory"/>
    </div>
    <div class="span6">
      <h2>Buttons:</h2>

      <span class="btn" flow-btn><i class="icon icon-file"></i>Upload File</span>
      <span class="btn" flow-btn flow-directory ng-show="$flow.supportDirectory"><i class="icon icon-folder-open"></i>
        Upload Folder
      </span>
    </div>
  </div>
  <hr class="soften">

  <h2>Transfers:</h2>

  <p>
    <a class="btn btn-small btn-success" ng-click="$flow.resume()">Upload</a>
    <a class="btn btn-small btn-danger" ng-click="$flow.pause()">Pause</a>
    <a class="btn btn-small btn-info" ng-click="$flow.cancel()">Cancel</a>
    <span class="label label-info">Size: {{$flow.getSize()}}</span>
    <span class="label label-info">Is Uploading: {{$flow.isUploading()}}</span>
  </p>
  <table class="table table-hover table-bordered table-striped" flow-transfers>
    <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Size</th>
      <th>Relative Path</th>
      <th>Unique Identifier</th>
      <th>#Chunks</th>
      <th>Progress</th>
      <th>Paused</th>
      <th>Uploading</th>
      <th>Completed</th>
      <th>Settings</th>
    </tr>
    </thead>
    <tbody>
    <tr ng-repeat="file in transfers">
      <td>{{$index+1}}</td>
      <td>{{file.name}}</td>
      <td>{{file.size}}</td>
      <td>{{file.relativePath}}</td>
      <td>{{file.uniqueIdentifier}}</td>
      <td>{{file.chunks.length}}</td>
      <td>{{file.progress()}}<div class="progress progress-success progress-striped active">
<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" ng-style="getprogress(file.progress()*100)">{{file.progress()*100 | number: 0}}</div>  
</div> </td>
      <td>{{file.paused}}</td>
      <td>{{file.isUploading()}}</td>
      <td>{{file.isComplete()}}</td>
      <td>
        <div class="btn-group">
         
          <a class="btn btn-mini btn-danger" ng-click="file.cancel()">
            Cancel
          </a>
          <a class="btn btn-mini btn-info" ng-click="file.retry()" ng-show="file.error">
            Retry
          </a>
        </div>
      </td>
    </tr>
    </tbody>
  </table>
  <div ng-repeat="prev in $flow.files">
  <img flow-img="prev" style="width:100px;"/>
  </div>
   <div flow-transfers>
{{transfers[0].progress}}
   
 </div>

  <hr class="soften"/>

  <div class="alert" flow-drop flow-drag-enter="class='alert-success'" flow-drag-leave="class=''" ng-class="class">
    Drag And Drop your file here
  </div>
</div>




</body>
</html>