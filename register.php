<?php
require("../config/config.php");
require("../config/include_function.php");
$title = "LoginMember | mmCupid";
$meta_content = "Online Dating | Myanmar Online Dating | find love | find lover";
$meta_keywords = "Online Dating,Myanmar Online Dating,find love,find lover";



if (isset($_POST['form-sub']) &&  $_POST['form-sub'] == 1) {
  // echo "hsad";
  // die;
  // $name = $mysql->real_escape_string($_POST['name']);
  // print_r($_FILES);
  // exit();
}
// require("../master/template-header.php");
require("./master/template-header.php")


?>

<!DOCTYPE html>
<html lang="en">

<div class="container my-5" ng-app="myApp" ng-controller="myCtrl" ng-init="init()">
  <div class="row">
    <div class="col-md-4"></div>

    <div class="col-md-4">
      <h1 class="fw-bold" style="font-size: 60px">Sign up</h1>
      <div class="py-3" style="font-size: 14px;">
        Already have an account? <a href="#" class="text-black">Log in</a>
      </div>
      <!-- form  -->
      <!--  -->
      <form action="<?php echo $adminBaseUrl ?>registerMember.php" method="POST" enctype="multipart/form-data" id="formSubmit">
        <div class="" ng-if="userInfo">
          <div class="fw-medium" style="font-size: 14px;">Sign up with your email or phone number</div>
          <div class="">
            <input ng-model="name" placeholder="name" name="name" type="text" class="form-control form-control-lg border border-1 border-black rounded rounded-4 mt-2" style="width:81vh;" id="name" ng-blur="validate('name')" />
            <span class="text-danger" ng-if="error_name">{{ error_name_message }}</span>

            <input ng-model="password" id="password" placeholder="password" name="password" type="password" class="form-control form-control-lg border border-1 border-black rounded rounded-4 mt-2" style="width:81vh;" ng-blur="validate('password')" />
            <span class="text-danger" ng-if="error_password">{{ error_password_message }}</span>

            <input ng-model="confirm_password" id="confirm_password" placeholder="confirm_password" name="confirm_password" type="text" class="form-control form-control-lg border border-1 border-black rounded rounded-4 mt-2" style="width:81vh;" ng-blur="validate('confirm_password')" ng-change="validate('confirm_password')" />
            <span class="text-danger" ng-if="error_confirm_password">{{ error_confirm_password_message }}</span>

            <input ng-model="email" id="email" placeholder="email" name="email" type="text" class="form-control form-control-lg border border-1 border-black rounded rounded-4 mt-2" style="width:81vh;" ng-blur="validate('email')" />
            <span class="text-danger" ng-if="error_email">{{ error_email_message }}</span>

            <input ng-model="phone" id="phone" placeholder="phone" name="phone" type="number" class="form-control form-control-lg border border-1 border-black rounded rounded-4 mt-2" style="width:81vh;" />
            <input ng-model="birthday" id="birthday" placeholder="birthday" name="birthday" id="birthday" type="text" class="form-control form-control-lg border border-1 border-black rounded rounded-4 mt-2" style="width:81vh;" />

            <select name="city" id="city" ng-model="city" class="form-control form-control-lg border border-1 border-black rounded rounded-4 mt-2" style="width:81vh;">
              <option value="">choose ur town</option>
              <option ng-repeat="city in cities" value=" {{city.id}} ">{{ city.name}}</option>
            </select>
            <span class="text-danger" ng-if="error_city">{{ error_city_message }}</span><br>


            <p>Choose Ur gender</p>
            <div class="form-check form-check-inline mt-2">
              <input ng-model="gender" class="form-check-input gender" type="radio" name="gender" id="gender" value="1">
              <label class="form-check-label" for="gender">Male</label>
            </div>
            <div class="form-check form-check-inline">
              <input ng-model="gender" class="form-check-input gender" type="radio" name="gender" id="gender" value="2">
              <label class="form-check-label" for="gender">Female</label>
            </div>
            <div class="form-check form-check-inline">
              <input ng-model="gender" class="form-check-input gender" type="radio" name="gender" id="gender" value="3">
              <label class="form-check-label" for="gender">other</label>
            </div><br>



            <label for="">Education</label>
            <textarea id="education" name="education" ng-model="education" rows="2" cols="30" placeholder="tell me about your Education" class="form-control form-control-lg border border-1 border-black rounded rounded-4 mt-2" style="width:81vh;">
          </textarea>

            <label for="">About</label>
            <textarea id="about" name="about" ng-model="about" rows="4" cols="50" placeholder="tell me about yourself" class="form-control form-control-lg border border-1 border-black rounded rounded-4 mt-2" style="width:81vh;">
        </textarea>

            <div class="form-control form-control-lg border border-1 border-black rounded rounded-4 mt-2" style="width:81vh;">
              <div class="row" style="width:81vh;">
                <div class="col"> <label for="height">Choose your feet</label>
                  <select name="heightFeet" id="heightFeet" ng-model="heightFeet">
                    <option value="" selected>choose your height feet</option>
                    <option value="">4'</option>
                    <option value="">5'</option>
                    <option value="">6'</option>
                    <option value="">7'</option>
                  </select>
                </div>
                <div class="col"> <label for="height">Choose your inches</label>
                  <select name="heightInches" id="heightInches" ng-model="heightInches">
                    <option value="" selected>choose your height inches</option>
                    <option value="1">1"</option>
                    <option value="2">2"</option>
                    <option value="3">3"</option>
                    <option value="4">4"</option>
                    <option value="5">5"</option>
                    <option value="6">6"</option>
                    <option value="7">7"</option>
                    <option value="8">8"</option>
                    <option value="9">9"</option>
                    <option value="10">10"</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-control form-control-lg border border-1 border-black rounded rounded-4 mt-2" style="width:81vh;">
              <div class="row" style="width:81vh;">
                <div class="col "> <label for="">Choose your partner min ages</label>
                  <select name="" id="minAges" ng-model="minAges" ng-change="changeMinAge()">
                    <option value="" selected>Minium Age</option>
                    <option ng-repeat="ages in partnerAge" value="{{ ages }}">{{ ages }}</option>
                  </select>
                </div>
                <div class="col "> <label for="">Choose your partner max ages</label>
                  <select name="" id="maxAges" ng-model="maxAges" ng-change="changeMaxAge()">
                    <option value="" selected>Maximum Age</option>
                    <option ng-repeat="ages in partnerAge" value="{{ ages }}">{{ ages }}</option>
                  </select>
                </div>
              </div>
            </div>


            <!-- choose your partner gender  -->
            <div class="border">
              <p>Choose Partner gender</p>
              <div class="form-check form-check-inline mt-2">
                <input class="form-check-input partner_gender" type="radio" name="pMale" id="gender" value="0">
                <label class="form-check-label" for="male">Male</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input partner_gender" type="radio" name="pFemale" id="inlineRadio2" value="1">
                <label class="form-check-label" for="female">Female</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input partner_gender" type="radio" name="pBoth" id="inlineRadio2" value="2">
                <label class="form-check-label" for="female">Other</label>
              </div>
            </div>
            <br>
            <!--  -->

            <!-- <h1>form2</h1> -->
            <div class="row">
              <div class="col-md-4" ng-repeat="hobby in hobbies">
                <div class="form-check form-check-inline">
                  <input type="checkbox" ng-model="hobby.selected" name="hobby[]" id="hobby-{{hobby.id}}" class="form-check-input hobby" value="{{ hobby.id }}">
                  <label for="hobby-{{hobby.id}}" class="form-check-label">{{ hobby.name }}
                </div>
              </div>
            </div>

            <button class="btn btn-dark rounded rounded-5 btn-lg mt-4" style="width:81vh;" ng-click="step2()">
              Sign up
            </button>
          </div>
        </div>

        <!--  -->
        <div ng-if="userPhoto" class="">

          <div class="container">
            <table style="width:100%">
              <tr>
                <td class="" colspan="2">
                  <div class="img-fluid img-thumbnail border border-dark rounded m-2 d-flex justify-content-center align-items-center rounded-4 mt-2" style="height:48vh;cursor:pointer;overflow:hidden;width:400px;object-fit: contain;" ng-click="upload1()" id="upload1-icons"><i class="fa fa-upload fs-1"></i>
                    <div class="" id="preview1" style="display: none;">
                      <!-- <img src="" alt="" style="width:440px;height:350px;object-fit: contain;overflow:hidden"> -->
                    </div>
                  </div>
                </td>

                <td class="row">
                  <div class="img-fluid img-thumbnail border border-dark rounded m-2 d-flex justify-content-center align-items-center rounded-4 mt-2" style="height:24vh;cursor:pointer;overflow:hidden;width:150px;object-fit: contain;" ng-click="upload2()" id="upload2-icons"><i class="fa fa-upload fs-1"></i>
                    <div class="" id="preview2" style="display: none;">

                </td>

                <td class="row">
                  <div class="img-fluid img-thumbnail border border-dark rounded m-2 d-flex justify-content-center align-items-center rounded-4 mt-2" style="height:24vh;cursor:pointer;overflow:hidden;width:150px;object-fit: contain;" ng-click="upload3()" id="upload3-icons"><i class="fa fa-upload fs-1"></i>
                    <div class="" id="preview3" style="display: none;">
                </td>
              </tr>
              <td class="">
                <div class="img-fluid img-thumbnail border border-dark rounded m-2 d-flex justify-content-center align-items-center rounded-4 mt-2" style="height:24vh;cursor:pointer;overflow:hidden;width:150px;object-fit: contain;" ng-click="upload4()" id="upload4-icons"><i class="fa fa-upload fs-1"></i>
                  <div class="" id="preview4" style="display: none;">
              </td>
              <td class="">
                <div class="img-fluid img-thumbnail border border-dark rounded m-2 d-flex justify-content-center align-items-center rounded-4 mt-2" style="height:24vh;cursor:pointer;overflow:hidden;width:150px;object-fit: contain;" ng-click="upload5()" id="upload5-icons"><i class="fa fa-upload fs-1"></i>
                  <div class="" id="preview5" style="display: none;">
              </td>
              <td class="">
                <div class="img-fluid img-thumbnail border border-dark rounded m-2 d-flex justify-content-center align-items-center rounded-4 mt-2" style="height:24vh;cursor:pointer;overflow:hidden;width:150px;object-fit: contain;" ng-click="upload6()" id="upload6-icons"><i class="fa fa-upload fs-1"></i>
                  <div class="" id="preview6" style="display: none;">
              </td>
              </tr>
            </table>
            <input type="file" name="uploaD1" id="uploaD1" style="display: none;" onchange="fileUpload('1')">
            <input type="file" name="uploaD2" id="uploaD2" style="display: none;" onchange="fileUpload('2')">
            <input type="file" name="uploaD3" id="uploaD3" style="display: none;" onchange="fileUpload('3')">
            <input type="file" name="uploaD4" id="uploaD4" style="display: none;" onchange="fileUpload('4')">
            <input type="file" name="uploaD5" id="uploaD5" style="display: none;" onchange="fileUpload('5')">
            <input type="file" name="uploaD6" id="uploaD6" style="display: none;" onchange="fileUpload('6')">
          </div>
          <button class="btn btn-dark rounded rounded-5 btn-lg mt-4" style="width:81vh;" ng-click="formSub()">
            Sign up
          </button>
          <input type="hidden" name="form-sub" value="1">

          <!--  -->
        </div>
      </form>

      <p class="w-75 mt-4 fw-medium text-center" style="font-size: 12px; line-height:16px;">By signing up, you agree to our
        <a href="" class="text-black">Terms & Conditions</a>. Learn how we
        use your data in our
        <a href="" class="text-black">Privacy Policy</a>
      </p>


      <div class="col-md-4"></div>
    </div>
  </div>

  <script src="<?php echo $baseUrl; ?>assets/css/front/register.js?v=20240430"></script>
</div>

</div>
</div>
</div>


<script>
  $(function() {
    $("#birthday").datepicker();
  });

  function fileUpload(index) {
    const fileInput = document.getElementById('uploaD' + index);
    const input = $('#uploaD' + index)[0];
    // console.log(input);

    const inputName = input.files[0].name;
    // console.log(inputName);

    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];

    if (inputName) {
      const fileExtension = inputName.split('.').pop().toLowerCase();
      // console.log(fileExtension);
      if (!allowedTypes.includes(input.files[0].type) || !['jpeg', 'jpg', 'png'].includes(fileExtension)) {
        alert('Please select a valid image file (JPEG/JPG/PNG).');
        fileInput.value = '';
        // Clear the file input
        return;
      } else {
        // alert("good")
        const fileInput = document.getElementById('uploaD' + index);
        const preview = document.getElementById('preview' + index);
        const file = fileInput.files[0];
        // console.log(file);
        if (file) {
          const reader = new FileReader();
          reader.onload = function(event) {
            const imageUrl = event.target.result;
            preview.innerHTML = `<img src="${imageUrl}" alt="" style="width:440px;height:400px;object-fit: contain;overflow:hidden">`;
          };
          reader.readAsDataURL(file)
        }
        preview.style.display = 'block'; // Display the preview
        $('#upload' + index + '-icons').hide(); // Hide the label
      }
      // Perform any additional operations if needed
    } else {
      // alert("no image")
    }
    // Perform any additional operations if needed
  }
</script>

</html>

<?php
// require("../master/template-footer.php");
require("./master/template-footer.php")
?>