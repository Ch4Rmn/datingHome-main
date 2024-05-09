var app = angular.module("myApp", []);
app.controller("myCtrl", function ($scope, $http) {
  $scope.cities = [];
  $scope.hobbies = [];
  $scope.message = "";
  $scope.data = {};

  $scope.name = "";
  $scope.email = "";
  $scope.password = "";
  $scope.confirm_password = "";
  $scope.phone = "";
  $scope.birthday = "";
  // $scope.hobby.selected = "";
  $scope.city = "";
  $scope.gender = "";
  $scope.education = "";
  $scope.about = "";
  $scope.heightFeet = "";
  $scope.heightInches = "";
  $scope.minAges = "";
  $scope.maxAges = "";
  $scope.partner_gender = "";
  // $scope.gender = $(".gender:checked").val() ;

  // $scope.minAge = 18;
  // $scope.maxAge = 55;
  $scope.partnerAge = [];
  $scope.userInfo = true;
  $scope.userPhoto = false;

  //  $scope.username = "";
  //  $scope.email = "";
  //  $scope.password = "";
  //  $scope.confirm_password = "";
  //  $scope.phone = "";
  //  $scope.birthday = "";
  //  $scope.city = "";
  //  $scope.hfeet = "";
  //  $scope.hinches = "";
  //  $scope.gender = "";
  //  $scope.education = "";
  //  $scope.about = "";
  //  $scope.selected_hobbies = [];
  //  $scope.partner_gender = "";
  //  $scope.min_age = "";
  //  $scope.max_age = "";
  //  $scope.religion = "";
  //  $scope.work = "";
  //  $scope.data = {};
  //  $scope.process_error = false;
  //  $scope.user_info = true;
  //  $scope.user_photo = false;
  //  $scope.emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  //  $scope.passwordRegex =
  //    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]*$/;
  //  $scope.dateRegex = /^\d{4}-\d{2}-\d{2}$/;
  //  $scope.min_ages = [];
  //  $scope.max_ages = [];

  // error
  $scope.process_error = false;
  // $scope.error_name_message = "";

  //       $scope.process_error = false;
  $scope.error_name = false;
  $scope.error_password = false;
  $scope.error_email = false;
  $scope.error_confirm_password = false;
  $scope.error_city = false;
  $scope.error_hobby = false;

  // message
  $scope.error_name_message = "";
  $scope.error_password_message = "";
  $scope.error_email_message = "";
  $scope.error_confirm_password_message = "";
  $scope.error_city_message = "";
  $scope.error_hobby_message = "";

  $scope.init = function () {
    for (let i = 18; i < 55; i++) {
      $scope.partnerAge.push(i);
    }
    // alert("hello");

    // cities
    let req_url = base_url + "api/get_cities.php";
    $http.get(req_url).then(function (response) {
      // console.log(response.data);
      $scope.cities = response.data;
    });

    // hobbies
    let req_url2 = base_url + "api/get_hobbies.php";
    $http.get(req_url2).then(function (response) {
      // console.log(response.data);
      $scope.hobbies = response.data;
    });
  };

  $scope.validate = function (field) {
    const form_value = $("#" + field).val();
    // console.log(form_value);
    if (form_value == "") {
      switch (field) {
        case "name":
          $scope.error_name = true;
          //  $scope.process_error = true;
          $scope.error_name_message = error_messages.a001 + "name";
          break;
        case "password":
          $scope.error_password = true;
          //  $scope.process_error = true;
          $scope.error_password_message = error_messages.a001 + "password";
          break;

        case "email":
          $scope.error_email = true;
          // $scope.process_error = true;
          $scope.error_email_message = error_messages.a001 + "email";
          break;

        case "confirm_password":
          $scope.error_confirm_password = true;
          //  $scope.process_error = true;
          $scope.error_confirm_password_message =
            error_messages.a001 + "confirm_password";
          break;

        default:
          break;
      }
    } else {
      switch (field) {
        case "name":
          $scope.error_name = false;
          //  $scope.process_error = true;
          $scope.error_name_message = "";
          break;
        case "password":
          $scope.error_password = false;
          //  $scope.process_error = false;
          $scope.error_password_message = "";
          break;

        case "email":
          $scope.error_email = false;
          // $scope.process_error = false;
          $scope.error_email_message = "";
          break;

        case "confirm_password":
          // $scope.error_confirm_password = false;
          // //  $scope.process_error = false;
          // $scope.error_confirm_password_message = "";
          const password = $("#password").val();
          const confirm_password = $("#confirm_password").val();
          // alert(confirm_password);
          if (password != confirm_password) {
            $scope.error_confirm_password = true;
            //  $scope.process_error = false;
            $scope.error_confirm_password_message = error_messages.a003;
          } else {
            $scope.error_confirm_password = false;
            //  $scope.process_error = false;
            $scope.error_confirm_password_message = "";
          }
          break;

        default:
          break;
      }
      // console.log(form_value);

      // console.log(field);
    }
  };

  $scope.changeMinAge = function () {
    $scope.minAges = $("#minAges").val();
    $scope.maxAges = $("#maxAges").val();
    // console.log($scope.minAges);
    if ($scope.maxAges != "" && $scope.maxAges < $scope.minAges) {
      $scope.minAges = "";
    }
  };
  // $scope.changeMaxAge = function () {
  //   console.log(max);

  //   if ($scope.minAges != "" && $scope.minAges < $scope.maxAges) {
  //     $scope.maxAges = "";
  //   }
  // };

  $scope.step2 = function () {
    const name = $("#name").val();
    const password = $("#password").val();
    const confirm_password = $("#confirm_password").val();
    const city = $("#city").val();
    const email = $("#email").val();
    const hobby = $("#hobby").val();

    // console.log(name);
    if (name == "") {
      // console.log('hello');
      $scope.error_name = true;
      $scope.process_error = true;
      $scope.error_name_message = error_messages.a001 + "name";
    }
    // else {
    //   alert("have data")
    // }
    if (password == "") {
      // console.log('hello');
      $scope.error_password = true;
      $scope.process_error = true;
      $scope.error_password_message = error_messages.a001 + "password";
    }
    if (hobby == "") {
      // console.log("hello");
      $scope.error_hobby = true;
      $scope.process_error = true;
      $scope.error_hobby_message = error_messages.a001 + "hobby";
    }
    if (confirm_password == "") {
      // console.log('hello');
      $scope.error_confirm_password = true;
      $scope.process_error = true;
      $scope.error_confirm_password_message =
        error_messages.a001 + "confirm_password";
    }
    if (email == "") {
      // console.log('hello');
      $scope.error_email = true;
      $scope.process_error = true;
      $scope.error_email_message = error_messages.a001 + "email";
    }
    if (city == "") {
      // console.log('hello');
      $scope.error_city = true;
      $scope.process_error = true;
      $scope.error_city_message = error_messages.a001 + "city";
    }
    if ($scope.process_error == false) {
      // when process error false get data then send data
      $scope.data = {};
      let data = {};
      let hobbies = [];

      data.name = $("#name").val();
      data.email = $("#email").val();
      data.password = $("#password").val();
      data.phone = $("#phone").val();
      data.birthday = $("#birthday").val();
      data.education = $("#education").val();
      data.about = $("#about").val();
      data.city = $("#city").val();
      data.gender = $(".gender:checked").val();
      data.heightFeet = $("#heightFeet").val();
      data.heightInches = $("#heightInches").val();

      // select option
      data.partner_gender = $(".partner_gender:checked").val();
      data.minAges = $("#minAges").val();
      data.maxAges = $("#maxAges").val();

      // data.email_confirm_code = getEmailConfirmCode();

      // data.partner_gender = $("")
      // data.apple = "apple";
      // data.gender = $(".gender:checked").val();
      // data.hobbies = $("#hobby").val();

      // array checkbox
      // console.log($(".hobby:checked").length);
      // Check the number of checked checkboxes
      $(".hobby:checked").each(function () {
        // console.log($(this).val()); // Log each checkbox value
        hobbies.push($(this).val());
      });
      // console.log(hobbies);
      // Log the hobbies array after populating it

      // $(".hobby:checked").each(function () {
      //   hobbies.push($(this).val());
      // });
      data.hobbies = hobbies;
      $scope.data = data;
      $scope.userInfo = false;
      $scope.userPhoto = true;
      // console.log($scope.data, "hello");
      // console.log(data.name);
      // alert($scope.error_password_message);
      // $("#my-form").submit();
      // $scope.process_error == false;
    } else {
    }
  };

  $scope.formSub = function () {
    // alert("sadasd");

    // alert("data");
    // console.log($scope.data, "hello");

    const req_url3 = "http://localhost/datingHome-main/api/RegisterMember.php";

    const headers = {
      Accept: "application/json", // Example Accept header
      "Content-Type": "application/json", // Example Content-Type header
      // Add more headers as needed
    };

    $http({
      method: "POST",
      url: req_url3,
      headers: headers, // Include headers in the request
      data: $scope.data,
    })
      .then(function (response) {
        console.log(response);
        if (response.data.status == 200) {
          $("#member_id").val(response.data.member_id);
          $("#formSubmit").submit();
          // $("#formSubmit").submit();
        } else {
          alert(error_messages.a004);
        }
        // console in browser
      })
      .catch(function (error) {
        console.error("Error is custom:", error);
      });
  };
  //   if (response.data.status == 200) {
  //     console.log(response.data);
  //   } else {
  //     alert(error_messages.a004);
  //   }
  // })
  // .catch(function (error) {
  //   console.error("Error is custom:", error);
  // });

  $scope.upload1 = function () {
    $("#uploaD1").click();
  };

  $scope.upload2 = function () {
    $("#uploaD2").click();
  };

  $scope.upload3 = function () {
    $("#uploaD3").click();
  };

  $scope.upload4 = function () {
    $("#uploaD4").click();
  };

  $scope.upload5 = function () {
    $("#uploaD5").click();
  };

  $scope.upload6 = function () {
    $("#uploaD6").click();
  };
});
