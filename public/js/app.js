var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope, $http, $window){
$scope.sendAjax = function(){
    // $http.get("/index/send");
    var get = $http({
        method: "GET",
        url: "/index/send",
    })
    .then(function(response) {
        if (response.status == 200){
            $window.alert("Это успех братан");
        }
        else {
                $window.alert("Это НЕуспех братан");
             }
        $window.alert(response.data);
      })
}
});
