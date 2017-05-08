(function(){

// File: chapter10/routing-example/app/scripts/services.js
var app = angular.module('CirrusIdea');

app.filter('makeRange', function() {
        return function(input) {
            var lowBound, highBound;
            switch (input.length) {
            case 1:
                lowBound = 1;
                highBound = parseInt(input[0]);
                break;
            case 2:
                lowBound = parseInt(input[0]);
                highBound = parseInt(input[1]);
                break;
            default:
                return input;
            }
            var result = [];
            for (var i = lowBound; i <= highBound; i++)
                result.push(i);
            return result;
        };
    });
  ////  /////////////////////////////////////////////////////////
////<div ng-repeat="n in [10] | makeRange">Do something 0..9: {{n}}</div>
////
//or
///<div ng-repeat="n in [20, 29] | makeRange">Do something 20..29: {{n}}</div>
    ////////////////////////////////////////////////

})();
