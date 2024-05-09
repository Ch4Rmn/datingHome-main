app.controller("myCtrl", function ($scope, $http) {
  $scope.cities = [];
  $scope.hobbies = [];
  $scope.message = "";

  // value
  $scope.name = "";
  $scope.password = "";
  $scope.email = "";
  $scope.confirm_password = "";
  $scope.phone = "";
  $scope.city = "";
  $scope.birthday = "";
  $scope.gender = "";
  $scope.education = "";
  $scope.about = "";
  $scope.heightFeet = "";
  $scope.heightInches = "";

  $scope.init = () => {
    let req_url = base_url + "api/get_cities.php";
    $scope.form1 = true;
    $scope.form2 = false;
    $http.get(req_url).then(function (response) {
      // console.log(response);
      $scope.cities = response.data;
    });
    // alert("hello");
  };

  $scope.step1 = function () {
    // error
    $scope.process_error = false;
    $scope.error_name = false;
    $scope.error_password = false;
    $scope.error_city = false;
    $scope.error_nameMessage = "";
    $scope.error_passwordMessage = "";
    $scope.error_cityMessage = "";

    const name = $("#name").val();
    const password = $("#password").val();
    // alert(name);
    //
    if (name == "") {
      // console.log('em');
      $scope.error_name == $scope.true;
      $scope.process_error == true;
      $scope.error_nameMessage = error_messages.a001 + " name";
    }
    if (password == "") {
      // console.log('em');
      $scope.error_password == true;
      $scope.process_error == true;

      $scope.error_passwordMessage = error_messages.a002;
    }
    // if ($scope.city == "") {
    //   // console.log('em');
    //   $scope.error_city = true;
    //   $scope.process_error == true;
    //   $scope.error_cityMessage = error_messages.a001 + " city";
    // }
    if ($scope.process_error == false) {
      let req_url = base_url + "api/get_hobbies.php";
      $http.get(req_url).then(function (response) {
        // console.log(response);
        $scope.hobbies = response.data;
        $scope.form1 = false;
        $scope.form2 = true;
      });
    }
  };

    $scope.step2 = function () {
        $("#myForm").submit();
    }


  // $scope.step1 = function () {
  //   if ($scope.name == "") {
  //     // $scope.message += error_messages.a001 + " name . \n";
  //     $scope.error_username = true;
  //     $scope.process_error = true;
  //   }
  //   if ($scope.process_error == true) {
  //     alert($scope.error_messages);
  //     $scope.process_error == false;
  //     $scope.message = "";
  //   } else {
  //   }
  //   // if ($scope.password == "") {
  //       // $scope.error_name = true;
  //   //   $scope.message += "Please fill in the password field.\n";
  //   //   $scope.process_error = true;
  //   // }
  //   // if ($scope.email == "") {
  //   //   $scope.message += "Please fill in the email field.\n";
  //   //   $scope.process_error = true;
  //   // }
  //   // if ($scope.confirm_password == "") {
  //   //   $scope.message += "Please fill in the confirm password field.\n";
  //   //   $scope.process_error = true;
  //   // }
  //   // if ($scope.phone == "") {
  //   //   $scope.message += "Please fill in the phone field.\n";
  //   //   $scope.process_error = true;
  //   // }
  //   // if ($scope.birthday == "") {
  //   //   $scope.message += "Please fill in the birthday field.\n";
  //   //   $scope.process_error = true;
  //   // }
  //   // if ($scope.gender == "") {
  //   //   $scope.message += "Please fill in the gender field.\n";
  //   //   $scope.process_error = true;
  //   // }
  //   // if ($scope.education == "") {
  //   //   $scope.message += "Please fill in the education field.\n";
  //   //   $scope.process_error = true;
  //   // }
  //   // if ($scope.about == "") {
  //   //   $scope.message += "Please fill in the about field.\n";
  //   //   $scope.process_error = true;
  //   // }
  //   // if ($scope.heightFeet == "") {
  //   //   $scope.message += "Please fill in the height feet field.\n";
  //   //   $scope.process_error = true;
  //   // }
  //   // if ($scope.heightInches == "") {
  //   //   $scope.message += "Please fill in the height inches field.\n";
  //   //   $scope.process_error = true;
  //   // }
  // };
  // $scope.name = "John Doe";
  // $scope.password = "John Doe";
  // $scope.email = "John Doe";
  // $scope.confirm_password = "John Doe";
  // $scope.phone = "John Doe";
  // $scope.gender = "John Doe";
  // $scope.education = "John Doe";
  // $scope.about = "John Doe";
  // $scope.heightFeet = 4;
  // $scope.heightInches = 2;
});
