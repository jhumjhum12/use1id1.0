var app = angular.module('myApp', [],  function($interpolateProvider) {
    $interpolateProvider.startSymbol('{%');
    $interpolateProvider.endSymbol('%}');
});
app.controller('myCtrl', function($scope, $http, $filter) {

    // VARIABLES INITIATED

    $scope.data = null;
    $scope.activeFieldData = null;
    $scope.activeSegmentData = null;
    $scope.activeScreenData = null;
    $scope.view = "fields";
    $scope.loading = false;
    $scope.initCount = 0;
    $scope.newScreen = {};


    // FUNCTIONS

    $scope.changeScreen = function(i)
    {
		
        screen = i;
        window.location.hash = i;
        $scope.initCount = 0;
        $scope.init();
    }

    $scope.createNewSegment = function()
    {
        $scope.activeSegmentId = null;
        $scope.activeSegmentData = {};
        $scope.activeSegmentData.id = 0;
        $scope.activeSegmentData.status = 1;
        $scope.view = "segment";
        return false;
    }

    $scope.selectedSegmentIdChanged = function()
    {
        var key = $scope.selectedSegmentId;
        if(typeof $scope.data.segments[key] != "undefined")
        {
            $scope.activeSegmentData = angular.copy($scope.data.segments[key]);
        }
    }

    $scope.setActiveField = function(i)
    {
        if(i==null) {
            $scope.activeFieldData = null;
        } else {
            angular.forEach($scope.data.segments[$scope.selectedSegmentId].selectedFields, function (value, key) {
                if (i == value.id) $scope.activeFieldData = angular.copy(value);
            });
        }
    };

    $scope.saveFieldDeepCopy = function()
    {
        var i = $scope.activeFieldData.id;
        angular.forEach($scope.data.segments[$scope.selectedSegmentId].selectedFields, function (value, key) {
            if (i == value.id) $scope.data.segments[$scope.selectedSegmentId].selectedFields[key] = angular.copy( $scope.activeFieldData);
        });

        $scope.activeFieldData = null;
    };

    $scope.destroyFieldDeepCopy = function()
    {
        var c = confirm("This will delete field, please confirm");
        if (c == true) {
            var i = $scope.activeFieldData.id;
            angular.forEach($scope.data.segments[$scope.selectedSegmentId].selectedFields, function (value, key) {
                if (i == value.id) {
                    $scope.data.segments[$scope.selectedSegmentId].selectedFields.splice(key, 1);
                }
            });
            $scope.activeFieldData = null;
        }
    };

    $scope.selectField = function(i)
    {
        //var newTemp = $filter("filter")($scope.activeSegmentData.fields, {name:'foo'});
        var deepCopy = angular.copy($scope.data.segments[$scope.selectedSegmentId].fields[i]);

        deepCopy.id = Math.floor((1 + Math.random()) * 0x10000000000000)
            .toString(16)
            .substring(1);
        // if there's a label with same name as field name, auto-populate translation label as well

        if($scope.labels.indexOf( deepCopy.name ) !== -1) {
            deepCopy.label = deepCopy.name;
        } else {
            if(deepCopy.type=="submit") deepCopy.label = "submit";
        }

        $scope.data.segments[$scope.selectedSegmentId].selectedFields.push(deepCopy);

    };

    $scope.autoAddFields = function()
    {
        $scope.data.segments[$scope.selectedSegmentId].selectedFields = [];

        angular.forEach($scope.data.segments[$scope.selectedSegmentId].fields, function(value,key) {
            // if it's not custom and not already existing in selectedFields
            if(!value.custom) {
                $scope.selectField(key);
            }
        });
        $scope.selectField('HTML::Submit');
        $scope.selectField('HTML::Recordset');

    };

    // API CONNECTIONS

    $scope.init = function()
    {
        var partialLoad = false;
		
        var targetUrl = screenDataUrl + "/" + screen;
		
        if(!screen || screen=="undefined" || screen=="#undefined") {
            partialLoad = true;
            targetUrl = screensUrl;			
        }		
        $scope.loading=true;
        $scope.initCount++;
        $http({
            method: 'GET',
            url: targetUrl
        }).then(function successCallback(response) {
            $scope.data = null;
            $scope.data = response.data;
            $scope.loading = false;

            if(!partialLoad) {



                angular.forEach($scope.data.allScreens, function(value, key) {
                   if(value.id==$scope.data.screen.parent) {
                       $scope.data.screen.parent = angular.copy(value);
                   }
                });
                //$scope.data.screen.parent = {"id": temp};


                $scope.activeScreenData = angular.copy(response.data.screen);
                for (first in $scope.data.allSegments) break;
                if (typeof first != "undefined" && $scope.initCount == 1) {
                    $scope.selectedSegmentId = first;
                    $scope.selectedSegmentIdChanged();
                }
                $scope.view = "fields";
            } else {
                $scope.view = "screens";
            }

        }, function errorCallback(response) {
            $scope.loading=false;
            alert("Something went wrong ");
        });
    };

    $scope.updateScreen = function(i)
    {
        if(i==0) {
            var payload = $scope.newScreen;
            var id = 0;
        } else {
            var payload = $scope.activeScreenData;
            var id = screen;
        }
        if(typeof payload.parent !="undefined") {
            payload.parent = payload.parent.id;
        } else {
            payload.parent = 0;
        }

        $scope.loading=true;
        $http({
            method: 'POST',
            data: payload,
            url: saveScreenUrl + "/" + id + "?noredirect=1"
        }).then(function successCallback(response) {
            $scope.init();
            // $scope.data = response.data;
        }, function errorCallback(response) {
            $scope.loading=false;
            alert("Something went wrong  (" + response.status + ": " + response.statusText + ")");
        });
    };

    $scope.updateSegment = function()
    {
        $scope.loading=true;
        var id = 0;
        if($scope.activeSegmentData.id==0) {
            id = 0;
            $scope.activeSegmentData.screen_id = screen;
        } else {
            id = $scope.activeSegmentData.id;
        }
        $http({
            method: 'POST',
            data: $scope.activeSegmentData,
            url: saveSegmentUrl + "/" + id + "?noredirect=1"
        }).then(function successCallback(response) {
            $scope.init();
        }, function errorCallback(response) {
            $scope.loading=false;
            alert("Something went wrong  (" + response.status + ": " + response.statusText + ")");
        });
    };


    // POST Sent out field data

    $scope.updateFields = function()
    {
        $scope.loading=true;
        $http({
            method: 'POST',
            data: $scope.data.segments[$scope.selectedSegmentId].selectedFields,
            url: saveFieldsUrl + "/" + $scope.data.segments[$scope.selectedSegmentId].id + "?noredirect=1"
        }).then(function successCallback(response) {
            $scope.init();
        }, function errorCallback(response) {
            alert("Something went wrong  (" + response.status + ": " + response.statusText + ")");
            $scope.loading=false;
        });
    };



		$scope.updateFields1 = function()
			{
				$scope.loading=true;
				$http({
					method: 'POST',
					data: $scope.data.segments[$scope.selectedSegmentId].selectedFields,
					url: saveFieldsUrl + "/" + $scope.data.segments[$scope.selectedSegmentId].segment_id + "?noredirect=1"
				}).then(function successCallback(response) {
					$scope.init();
				}, function errorCallback(response) {
					alert("Something went wrong  (" + response.status + ": " + response.statusText + ")");
					$scope.loading=false;
				});
			};


    // GET Label definitions from the server

    $scope.populateLabels = function(i)
    {
        $scope.loading=true;
        $http({
            method: 'GET',
            url: populateLabelsUrl
        }).then(function successCallback(response) {
            $scope.labels = response.data.labels;
            $scope.screenNames = response.data.screenNames;
        }, function errorCallback(response) {
            $scope.loading=false;
            console.log(response);
            alert("Something went wrong with retrieving language pack (" + response.status + ": " + response.statusText + ")");
        });
    };


    // ON START

    if(window.location.hash) {
        var hash = window.location.hash;
        if(hash!="undefined") screen=hash.replace("#", "");
    }

    $scope.init();
    $scope.populateLabels();

    var el = document.getElementById('items');
    $scope.sortable = Sortable.create(el, {
        handle: ".my-handle",
        onUpdate: function() {
            var order = $scope.sortable.toArray();
            var temp = null;
            var i = 10;
            angular.forEach(order, function (o) {
                temp = $filter("filter")($scope.data.segments[$scope.selectedSegmentId].selectedFields, {id: o});
                temp[0].sort = i;
                i +=10;
            });
        }
    });

    $scope.test = function()
    {
        alert("!");
    }

});

