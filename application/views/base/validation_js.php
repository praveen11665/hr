<style type="text/css">
  .help-block{
    color: red;
  }

  .customfocus{
    border: 1px solid red !important;
  }

  .closepopup
  {
    float: right;
  }
</style>

<script type="text/javascript">
  var app = angular.module('myApp', ['ngMessages','ngAnimate', 'ngSanitize', 'ui.bootstrap']);  
  
  app.config(['$qProvider', function ($qProvider) {
    $qProvider.errorOnUnhandledRejections(false);
  }]); 

  app.config(function(uibDatepickerConfig) {   
    uibDatepickerConfig.showButtonBar = false;
  });  

  //Cannot Access White Spaces to be call in a form disallow-spaces
  app.directive('disallowSpaces', function() {
      return {
          restrict: 'A',

          link: function($scope, $element) {
              $element.bind('keydown', function(e) {
                  if (e.which === 32) {
                      e.preventDefault();
                  }
              });
          }
      }
  })

  //Cannot Access numeric Keys to be call in a form allow-characters
  app.directive('allowCharacters', function() {
        return {
            restrict: 'A',
            link: function ($scope, $element) {
                $element.bind('keydown', function(e) {
                  if (e.ctrlKey || e.altKey) 
                  {
                    e.preventDefault();
                  }else{
                    var key = e.keyCode;    
                    if (!((key == 116) || (key == 8) || (key == 9) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) 
                    {          
                      e.preventDefault();            
                    }
                  }
                });
            }
        }
  })

  //Cannot Access numeric Keys to be call in a form allow-characters-with-underscore
  app.directive('allowCharactersWithUnderscore', function() {
        return {
            restrict: 'A',
            link: function ($scope, $element) {
                $element.bind('keydown', function(e) {
                  if (e.ctrlKey || e.altKey) 
                  {
                    e.preventDefault();
                  }else{
                    var key = e.keyCode;  
                    if (!((key == 116) || (key == 8) || (key == 9) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90) || (key == 189))) 
                    {          
                      e.preventDefault();            
                    }
                  }
                });
            }
        }
  })

  //Cannot Access Alphabetics Keys to be call in a form allow-only-numbers
  app.directive('allowOnlyNumbers', function () {
        return {  
            restrict: 'A',  
            link: function (scope, elm, attrs, ctrl) {  
                elm.on('keydown', function (event) {  
                    if (event.which == 64 || event.which == 16) {  
                        // to allow numbers  
                        return false;  
                    } else if (event.which >= 48 && event.which <= 57) {  
                        // to allow numbers  
                        return true;  
                    } else if (event.which >= 96 && event.which <= 105) {  
                        // to allow numpad number  
                        return true;  
                    } else if ([8, 13, 27, 37, 38, 39, 40].indexOf(event.which) > -1) {  
                        // to allow backspace, enter, escape, arrows  
                        return true;  
                    } else {  
                        event.preventDefault();  
                        // to stop others  
                        return false;  
                    }  
                });  
            }  
        }  
  })   

  //Check the Password Match check
  app.directive('passwordVerify', function (){
    return {
    restrict: 'A', // only activate on element attribute
    require: '?ngModel', // get a hold of NgModelController
    link: function(scope, elem, attrs, ngModel) {
      if (!ngModel) return; // do nothing if no ng-model

      // watch own value and re-validate on change
      scope.$watch(attrs.ngModel, function() {
        validate();
      });

      // observe the other value and re-validate on change
      attrs.$observe('passwordVerify', function(val) {
        validate();
      });

      var validate = function() {
        // values
        var val1 = ngModel.$viewValue;
        var val2 = attrs.passwordVerify;

        // set validity
        ngModel.$setValidity('passwordVerify', val1 === val2);
      };
    }
  }      
  })

  //Check the File is only images
  app.directive('validFile', function () {
    return {
      require: 'ngModel',
      link: function (scope, elem, attrs, ngModel) {
          var validFormats = ['jpg','jpeg','png'];
          elem.bind('change', function () {
              validImage(false);
              scope.$apply(function () {
                  ngModel.$render();
              });
          });
          ngModel.$render = function () {
              ngModel.$setViewValue(elem.val());
          };
          function validImage(bool) {
              ngModel.$setValidity('extension', bool);
          }
          ngModel.$parsers.push(function(value) {
              var ext = value.substr(value.lastIndexOf('.')+1);
              if(ext=='') return;
              if(validFormats.indexOf(ext) == -1){
                  return value;
              }
              validImage(true);
              return value;
          });
      }
    };
  })

  //Check the File is only images
  app.directive('csvFile', function () {
    return {
      require: 'ngModel',
      link: function (scope, elem, attrs, ngModel) {
          var validFormats = ['csv'];
          elem.bind('change', function () {
              validImage(false);
              scope.$apply(function () {
                  ngModel.$render();
              });
          });
          ngModel.$render = function () {
              ngModel.$setViewValue(elem.val());
          };
          function validImage(bool) {
              ngModel.$setValidity('extension', bool);
          }
          ngModel.$parsers.push(function(value) {
              var ext = value.substr(value.lastIndexOf('.')+1);
              if(ext=='') return;
              if(validFormats.indexOf(ext) == -1){
                  return value;
              }
              validImage(true);
              return value;
          });
      }
    };
  })  

  //Select 2 Call in directive
  app.directive("select2", function ($timeout, $parse) {
      return {
          restrict: 'AC',
          require: '^?form',
          link: function (scope, element, attrs) {
              $timeout(function () {
                  element.select2({
                    //allowClear: true
                  });
                  element.select2Initialized = true;
              });

              var refreshSelect = function () {
                  if (!element.select2Initialized) return;
                  $timeout(function () {
                      element.trigger('change');
                  });
              };

              var recreateSelect = function () {
                  if (!element.select2Initialized) return;
                  $timeout(function () {
                      element.select2('destroy');
                      element.select2();
                  });
              };

              scope.$watch(attrs.ngModel, refreshSelect);

              if (attrs.ngOptions) {
                  var list = attrs.ngOptions.match(/ in ([^ ]*)/)[1];
                  // watch for option list change
                  scope.$watch(list, recreateSelect);
              }

              if (attrs.ngDisabled) {
                  scope.$watch(attrs.ngDisabled, refreshSelect);
              }
          }
      };
  }) 

  //Check Empty Array
  app.filter('emptyFilter', function() {
    return function(array) {
      var filteredArray = [];
        angular.forEach(array, function(item) {
          if (item) filteredArray.push(item);
        });
      return filteredArray;  
    };
  }) 

   //Datepicker cannot keydown any buttons
  app.directive('uibDatepickerPopup', function() {
      return {
          restrict: 'A',
          link: function ($scope, $element) {
              $element.bind('keydown', function(e) {
                e.preventDefault(); 
              });
          }
      }
  }) 

  //MyCtrl Functions
  app.controller('myCtrl', function ($scope, $http) 
  {
    //Common dropdown loading
    $scope.loadDropdown = function(dropdownurl, array, dynamicVariable){ 
      $http.get(dropdownurl,{
      params: {
        search: array
      }
      }).then(function(data){
        var field = dynamicVariable;
        $scope[field] = data.data; 
      }); 
    }

    //Check Unique Values
    $scope.checkUnique = function(uniqueUrl, uniquevalue, dbfield){ 
      $http.get(uniqueUrl,{  
      params: {
        uniquevalue: uniquevalue,
        dbfield    : dbfield
      }  
      }).then(function(data){
        if(data.data.result == 'true')
        {
          $scope.showuniqueMsgs = true;
        }
        else if(data.data.result == 'false')
        {
          $scope.showuniqueMsgs = false;
        }      
      }); 
    }   

    //Common dropdown loading for Naming Series
    $scope.loadSeriesDropdown = function(dropdownurl){ 
      $http.get(dropdownurl).then(function(data){
        $scope.dropSeriesValues = data.data; 
      }); 
    }

    //When Submitted Form Throw Error
    $scope.submited = function(form, uniqueMsgs)
    {
      if ($scope[form].$valid) {
      }
      else if($scope[uniqueMsgs])
      {
        $scope.uniqueMsgs = true;
      }
      else 
      {
        //$(':required').addClass('customfocus');
        $scope.showMsgs = true;
      }    
    };

    $scope.checkJoiningDate  = function(){
      var date_of_joining    = $('#date_of_joining').val();
      var date_of_birth      = $('#date_of_birth').val();

      var joiningDateArray   = date_of_joining.split("-");
      var dobDateArray       = date_of_birth.split("-");

      var changeJoingDate    = joiningDateArray[2] + '-' + joiningDateArray[1] + '-' + joiningDateArray[0];
      var changedobDate      = dobDateArray[2] + '-' + dobDateArray[1] + '-' + dobDateArray[0];

      var newdJoingDate      = Date.parse(changeJoingDate);
      var newddobDate        = Date.parse(changedobDate);

      if (newdJoingDate < newddobDate) {
        $scope.showjoiningMsgs = true;
      }
      else{
        $scope.showjoiningMsgs = false;
      } 
    }; 

    /***************************ANGULAR DATE PICKER FUNCTIONS AND OPTIONS******************************/

    $scope.today = function() {
      $scope.dt = new Date();
    };

    $scope.today();

    $scope.clear = function() {
      $scope.dt = null;
    };

    $scope.inlineOptions = {
      customClass: getDayClass,
      minDate: new Date(),
      showWeeks: true
    };

    $scope.dateOptions = {
      //dateDisabled: disabled,
      formatYear: 'yy',
      //maxDate: new Date(2020, 5, 22),
      minDate: new Date(),
      startingDay: 1
    };

    $scope.pastDateOptions = {
      formatYear: 'yy',
      minDate: new Date(),
      startingDay: 1
    };

    $scope.futureDateOptions = {
      formatYear: 'yy',
      maxDate: new Date(),
      startingDay: 1
    };

    //Option For Block Futre Year and Past Year
    var year = (new Date()).getFullYear();

    $scope.pastYearBlockOptions = {
      formatYear: 'yy',
      minDate: new Date(year, 0, 1),
      startingDay: 1
    };

    $scope.pastYearOption = {
      formatYear: 'yy',
      minDate: new Date(year, 0, 1),
      maxDate: new Date(year, 11, 31),
      startingDay: 1
    };

    $scope.pastYearfutureDateOptions = {
      formatYear: 'yy',
      minDate: new Date(year, 0, 1),
      maxDate: new Date(),
      startingDay: 1
    };

    $scope.fromDateChange  = function(idName){
      var from_date        = $('#'+idName).val();
      var datearray        = from_date.split("-");
      var newdate          = datearray[1] + '-' + datearray[0] + '-' + datearray[2];
      var changeDate       = datearray[2] + '-' + datearray[1] + '-' + datearray[0];
      $scope.to_date       = changeDate;
      $scope.end_date      = changeDate;

      $scope.toDateOptions = {
        formatYear: 'yy',
        minDate: newdate,
        startingDay: 1
      };
    };  

    // Disable weekend selection
    function disabled(data) {
      var date = data.date,
        mode = data.mode;
      return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
    }

    $scope.toggleMin = function() {
      $scope.inlineOptions.minDate = $scope.inlineOptions.minDate ? null : new Date();
      $scope.dateOptions.minDate = $scope.inlineOptions.minDate;
    };

    $scope.toggleMin();

    $scope.init = function(dateValue, ngModel) {
      if(dateValue == '')
      {
        $scope[ngModel] = new Date();     
      }
      else
      {
        $scope[ngModel] = new Date(dateValue);     
      }
    };

    $scope.open = function(popup) {
      $scope[popup] = {};
      $scope[popup].opened = true;
    };

    $scope.formats = ['dd-MM-yyyy','shortDate'];
    $scope.format = $scope.formats[0];
    $scope.popup = {
      opened: false
    };

    var tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    var afterTomorrow = new Date();
    afterTomorrow.setDate(tomorrow.getDate() + 1);
   
    $scope.events = [
      {
        date: tomorrow,
        status: 'full'
      },
      {
        date: afterTomorrow,
        status: 'partially'
      }
    ];

    function getDayClass(data) {
      var date = data.date,
        mode = data.mode;
      if (mode === 'day') {
        var dayToCheck = new Date(date).setHours(0,0,0,0);

        for (var i = 0; i < $scope.events.length; i++) {
          var currentDay = new Date($scope.events[i].date).setHours(0,0,0,0);

          if (dayToCheck === currentDay) {
            return $scope.events[i].status;
          }
        }
      }
      return '';
    }

    $scope.selectDate = function(dt) {
      console.log(dt);
    };    
  })

/************************ Bootstrap Modal Popup Functions************************************/
  
  //ModalCtrl Functions
  app.controller('ModalCtrl', function ($uibModal, $log, $document) {
    var $ctrl = this;
    //Open popup
    $ctrl.open = function (size, parentSelector, modalURL) {
      var parentElem = parentSelector ? 
      angular.element($document[0].querySelector('.modal-angular ' + parentSelector)) : undefined;
      var modalInstance = $uibModal.open({
      ariaLabelledBy: 'modal-title',
      ariaDescribedBy: 'modal-body',
      templateUrl: modalURL,
      controller: 'ModalInstanceCtrl',
      controllerAs: '$ctrl',
      size: size,
      appendTo: parentElem, 
      //windowClass: 'app-modal-window',           
      });        
    };  
  })

  //Instant Popup
  app.controller('ModalInstanceCtrl', function ($scope, $uibModalInstance, $uibModal, $http) {
    var $ctrl = this;

    //Open popup inside popup
    $ctrl.openSecond = function(size, parentSelector, secondUrl){
      var parentElem = parentSelector ? 
      angular.element($document[0].querySelector('.modal-angular ' + parentSelector)) : undefined;
      var modalInstancesecond= $uibModal.open({
      ariaLabelledBy: 'modal-title',
      ariaDescribedBy: 'modal-body',
      templateUrl: secondUrl,
      controller: 'ModalInstanceCtrl',
      controllerAs: '$ctrl',
      size: size,
      appendTo: parentElem, 
      });        
    };

    //Submit popup form
    $ctrl.submit_form = function (form, msgs, uniqueMsgs) {

      if ($scope[form].$valid) 
      {
        if($scope[msgs])
        {
          $scope.msgs = true;
        }
        else if($scope[uniqueMsgs])
        {
          $scope.uniqueMsgs = true;
        }
        else
        {
          // When the form is submitted 
          $("#ajaxModelForm, #ajaxModelForm1, #ajaxModelForm2").submit(function()
          {
            // 'this' refers to the current submitted form 
            var str        = $(this).serialize();
            var actionUrl  = $(this).data('action');
            var model_no1  = $(this).data('model_no');
            (typeof model_no1 == 'undefined') ? (model_no='1') : (model_no = model_no1);
            $.ajax({
            type: "POST",
            url: actionUrl, 
            data: {postdata: str},
            dataType:"html",
              success: function(html1)
              {             
                try 
                {
                  var parsedJson = JSON.parse(html1);
                  if(parsedJson.result == 'success')
                  {
                    //$('#modal'+model_no).modal('hide');
                    //uibModalInstance.close();
                    //$('.select2me').select2();
                    $uibModalInstance.dismiss('cancel');                  
                    location.reload();
                  }       
                } 
                catch(e) 
                {
                  $scope.showMsgs = true;
                  /*var size           = 'ls';
                  var parentSelector = '';
                  var parentElem = parentSelector ? 
                  angular.element($document[0].querySelector('.modal-angular ' + parentSelector)) : undefined;
                  var modalInstance = $uibModal.open({
                    ariaLabelledBy: 'modal-title',
                    ariaDescribedBy: 'modal-body',
                    templateUrl: actionUrl,
                    controller: 'ModalInstanceCtrl',
                    controllerAs: '$ctrl',
                    size: size,
                    appendTo: parentElem, 
                    //windowClass: 'app-modal-window',           
                    });*/
                }
              },
            });
          }); // end submit event 

          $("#ajaxModelFormWithFile").submit(function()
          { 
            // 'this' refers to the current submitted form 
            //var str       = $(this).serialize();
            var actionUrl = $(this).data('action');
            $.ajax({
            type: "POST",
            url: actionUrl, 
            data: new FormData( this ),
            processData: false,
            contentType: false, 
              success: function(html1)
              {
                try 
                {
                  var parsedJson = JSON.parse(html1);
                  if(parsedJson.result == 'success')
                  {
                      //var parsedJson = JSON.parse(html1);
                      //$('#modal1').modal('hide');
                      $uibModalInstance.dismiss('cancel');
                      location.reload();
                  }       
                } 
                catch(e) 
                {
                  $scope.showMsgs = true;
                  //$("#body1").html("<p>"+html1+"</p>"); // msg in modal body
                  //$("#modal1").modal("show"); // show modal instead alert box
                }
              },
            });
          }); // end submit event
        }
      }else 
      {
        //$(':required').addClass('customfocus');
        $scope.showMsgs = true;
      }
    };

    //Submit popup form
    $ctrl.atten_submit_form = function (form) {

      var checkEmployee = 0;      
      if ($scope[form].$valid) 
      {  
        checkEmployee = $('#checkEmployee').val();

        if(checkEmployee)
        {
          // When the form is submitted 
          $("#ajaxModelForm, #ajaxModelForm1, #ajaxModelForm2").submit(function()
          {
            // 'this' refers to the current submitted form 
            var str        = $(this).serialize();
            var actionUrl  = $(this).data('action');
            var model_no1  = $(this).data('model_no');
            (typeof model_no1 == 'undefined') ? (model_no='1') : (model_no = model_no1);
            $.ajax({
            type: "POST",
            url: actionUrl, 
            data: {postdata: str},
            dataType:"html",
              success: function(html1)
              {             
                try 
                {
                  var parsedJson = JSON.parse(html1);
                  if(parsedJson.result == 'success')
                  {
                    //$('#modal'+model_no).modal('hide');
                    //uibModalInstance.close();
                    //$('.select2me').select2();
                    $uibModalInstance.dismiss('cancel');                  
                    location.reload();
                  }       
                } 
                catch(e) 
                {
                  $scope.showMsgs = true;
                  /*var size           = 'ls';
                  var parentSelector = '';
                  var parentElem = parentSelector ? 
                  angular.element($document[0].querySelector('.modal-angular ' + parentSelector)) : undefined;
                  var modalInstance = $uibModal.open({
                    ariaLabelledBy: 'modal-title',
                    ariaDescribedBy: 'modal-body',
                    templateUrl: actionUrl,
                    controller: 'ModalInstanceCtrl',
                    controllerAs: '$ctrl',
                    size: size,
                    appendTo: parentElem, 
                    //windowClass: 'app-modal-window',           
                    });*/
                }
              },
            });
          }); // end submit event 
        }else
        {
          swal("Please make attendance for employees", "", "error");
        }
      }else 
      {
        $scope.showMsgs = true;
      }
    };

    //Cancel Popup
    $ctrl.cancel = function () {
      $uibModalInstance.dismiss('cancel');
    };

    /****************************************************************************************/

    /****************************** Load Dropdown *******************************************/
    //Common dropdown loading
    $scope.loadDropdown = function(dropdownurl, array, dynamicVariable){ 
      $http.get(dropdownurl,{
      params: {
        search: array
      }
      }).then(function(data){
        var field     = dynamicVariable;
        $scope[field] = {};
        $scope[field] = data.data; 
      }); 
    } 

    //Common dropdown loading for Naming Series
    $scope.loadSeriesDropdown = function(dropdownurl){ 
      $http.get(dropdownurl).then(function(data){
        $scope.dropSeriesValues = data.data; 
      }); 
    }   

    /********************************* Unique Validations **********************************/

    //Check Unique Values
    $scope.checkUnique = function(uniqueUrl, uniquevalue, dbfield){ 
      $http.get(uniqueUrl,{  
      params: {
        uniquevalue: uniquevalue,
        dbfield    : dbfield
      }  
      }).then(function(data){
        if(data.data.result == 'true')
        {
          $scope.showuniqueMsgs = true;
        }
        else if(data.data.result == 'false')
        {
          $scope.showuniqueMsgs = false;
        }      
      }); 
    }

    //Check Email Unique Values
    $scope.emailUnique = function(uniqueUrl, uniquevalue, dbfield){ 
      $http.get(uniqueUrl,{  
      params: {
        uniquevalue: uniquevalue,
        dbfield    : dbfield
      }  
      }).then(function(data){
        if(data.data.result == 'true')
        {
          $scope.showEmailuniqueMsgs = true;
        }
        else if(data.data.result == 'false')
        {
          $scope.showEmailuniqueMsgs = false;
        }      
      }); 
    }

    //Check Unique Values
    $scope.checkAttentance = function(uniqueUrl, emp_id, att_date){
      var employee_id        = $('#'+emp_id).val();
      var attendance_date    = $('#'+att_date).val();       

      $http.get(uniqueUrl,{  
      params: {
        employee_id        : employee_id,
        attendance_date    : attendance_date
      }  
      }).then(function(data){
        if(data.data.result == 'true')
        {
          $scope.showattenMsgs = true;
        }
        else if(data.data.result == 'false')
        {
          $scope.showattenMsgs = false;
        }      
      }); 
    }

    //Check Loan as already given for employee
    $scope.checkExistLoan = function(uniqueUrl){ 
      var loan_type_id    = $('#loan_type_id').val();
      var employee_id     = $('#employee_id').val();

      $http.get(uniqueUrl,{  
      params: {
        employee_id: employee_id,
        loan_type_id    : loan_type_id
      }  
      }).then(function(data){
        if(data.data.result == 'true')
        {
          $scope.showLoanExistMsgs = true;
        }
        else if(data.data.result == 'false')
        {
          $scope.showLoanExistMsgs = false;
        }      
      }); 
    }
    
    /*****************************************************************************************/

    $scope.maxLoanAmount = function(url){
      var maximum_loan_amount = $('#maximum_loan_amount').val();
      var loan_type_id = $('#loan_type_id').val();
      if(loan_type_id)
      {
        $http.get(url,{
        params: {
          maximum_loan_amount: maximum_loan_amount,
          loan_type_id: loan_type_id

        }
        }).then(function(data){
          if(data.data.result == 'false')
          {
            $scope.showLoanMsg = true;
          }
          else if(data.data.result == 'success')
          {
            $scope.showLoanMsg = false;
          }
        });
      }else{
        $('#maximum_loan_amount').val('');
        swal("Please given loan type");
      }
    }

    $scope.rows = [{
    }]

    $scope.addnewrow = function(){
      $scope.rows.push({})
    };

    $scope.addEmployee = function(){
      branch_id     = $('#branch_id').val();
      company_id    = $('#company_id').val();
      department_id = $('#department_id').val();
      date          = $('#date').val();

      if(company_id)
      {
        $.ajax
        ({
          type : "POST",
          dataType:'html',
          url  : '<?php echo base_url();?>hr/Employee_attendance/Employee_attendance/getEmployeeDetails/',
          data : {

                    'branch_id' : branch_id,
                    'company_id' : company_id,
                    'department_id' : department_id,
                    'date'          : date
                },
          success : function(html1)
          {
            $('#employeeAttendanceData').html(html1);
          }
        });        
      }
    }; 

    /******************************************* Angular Date Picker Start *****************************************/
    //When Changed From Date the past dates are blocked for to_dates
    $scope.fromDateChange  = function(idName){
      from_date      = $('#'+idName).val();
      var datearray  = from_date.split("-");
      var newdate    = datearray[1] + '-' + datearray[0] + '-' + datearray[2];
      var changeDate = datearray[2] + '-' + datearray[1] + '-' + datearray[0];
      $scope.to_date = changeDate;
      $scope.toDateOptions = {
        formatYear: 'yy',
        minDate: newdate,
        startingDay: 1
      };
    };

    $scope.today = function() {
      $scope.dt = new Date();
    };

    $scope.today();

    $scope.clear = function() {
      $scope.dt = null;
    };

    $scope.inlineOptions = {
      customClass: getDayClass,
      minDate: new Date(),
      showWeeks: true
    };

    $scope.pastDateOptions = {
      formatYear: 'yy',
      minDate: new Date(),
      startingDay: 1
    };

    $scope.futureDateOptions = {
      formatYear: 'yy',
      maxDate: new Date(),
      startingDay: 1
    };

    $scope.dateOptions = {
      formatYear: 'yy',
      //maxDate: new Date(2020, 5, 22),
      minDate: new Date(),
      startingDay: 1
    }; 

    //Option For Block Futre Year and Past Year
    var year = (new Date()).getFullYear();
    $scope.pastYearOption = {
      formatYear: 'yy',
      minDate: new Date(year, 0, 1),
      maxDate: new Date(year, 11, 31),
      startingDay: 1
    };

    $scope.pastYearfutureDateOptions = {
      formatYear: 'yy',
      minDate: new Date(year, 0, 1),
      maxDate: new Date(),
      startingDay: 1
    };

    $scope.toggleMin = function() {
      $scope.inlineOptions.minDate = $scope.inlineOptions.minDate ? null : new Date();
      $scope.dateOptions.minDate   = $scope.inlineOptions.minDate;
    };

    $scope.toggleMin();

    $scope.init = function(dateValue, ngModel) {
      if(dateValue == '')
      {
        $scope[ngModel] = new Date();     
      }
      else
      {
        $scope[ngModel] = new Date(dateValue);     
      }
    };

    $scope.open = function(popup) {
      $scope[popup] = {};
      $scope[popup].opened = true;
    };

    $scope.formats = ['dd-MM-yyyy','shortDate'];
    $scope.format = $scope.formats[0];
    $scope.popup = {
      opened: false
    };
    var tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    var afterTomorrow = new Date();
    afterTomorrow.setDate(tomorrow.getDate() + 1);
    $scope.events = [
      {
        date: tomorrow,
        status: 'full'
      },
      {
        date: afterTomorrow,
        status: 'partially'
      }
    ];

    function getDayClass(data) 
    {
      var date = data.date,
        mode = data.mode;
      if (mode === 'day') {
        var dayToCheck = new Date(date).setHours(0,0,0,0);

        for (var i = 0; i < $scope.events.length; i++) {
          var currentDay = new Date($scope.events[i].date).setHours(0,0,0,0);

          if (dayToCheck === currentDay) {
            return $scope.events[i].status;
          }
        }
      }

      return '';
    }
    /****************************************** Angular Date picker End ***********************************/
  })

/***************************************************************************************/
  
  //OPEN NEW OPUP
  function addNewPopAngular(formURL)
  {
    var scope   = angular.element(document.getElementById('addNewPopupAngular')).scope();
    scope.$ctrl.open('lg', '', formURL);
  }

  //Only Given Numbers
  function isNumberKey(evt) 
  {
    var charCode = (evt.which) ? evt.which : event.keyCode;

    if ((charCode < 48 || charCode > 57))
      return false;

      return true;
  }

  //Only given alphabetics
  function IsAlphaNumeric(e) 
  {
    var target = event.target ? event.target : event.srcElement;
    var specialKeys = new Array();
    specialKeys.push(8); //Backspace
    specialKeys.push(9); //Tab
    specialKeys.push(46); //Delete
    specialKeys.push(36); //Home
    specialKeys.push(35); //End
    specialKeys.push(37); //Left
    specialKeys.push(39); //Right
    var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;

    if(target.value.length == 0 && (keyCode == 46)) 
    {
      return false;
    }else{
      var ret = ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode) || keyCode == 46);
      return ret;
    }
  }

  //Only given alphabetics
  function isRegistrationFormat(e) 
  {
    var target = event.target ? event.target : event.srcElement;
    var specialKeys = new Array();
    specialKeys.push(8); //Backspace
    specialKeys.push(9); //Tab
    specialKeys.push(46); //Delete
    specialKeys.push(36); //Home
    specialKeys.push(35); //End
    specialKeys.push(37); //Left
    specialKeys.push(39); //Right
    var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;

    if(target.value.length == 0 && (keyCode == 45 || keyCode == 32)) 
    {
      return false;
    }else{
      var ret = ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode) || keyCode == 45 || keyCode == 32);
      return ret;
    }
  }

  //FIRST NOT ALLOW 0
  function allowNonZeroIntegers(e) 
  {
    var val    = e.keyCode;
    var target = event.target ? event.target : event.srcElement;
    if (e.shiftKey) 
    {
      e.preventDefault();
    }
    if(target.value.length == 0 && (val == 48 || val == 96 || val == 110 || val == 190)) 
    {
      return false;
    }else if(val == 8 || val == 116 || val == 18 || val ==9 || val == 110 || val == 190)
    {
      return true;
    }
    else if (val >= 48 && val < 58 ) 
    {
      return true;
    }else if (val >= 96 && val < 106 ) 
    {
      return true;
    }
    else 
    {
      return false;
    }
  }

  function allowNonZeroIntegersNotDecimal(e) 
  {
    var val    = e.keyCode;
    var target = event.target ? event.target : event.srcElement;
    if (e.shiftKey) 
    {
      e.preventDefault();
    }
    if(target.value.length == 0 && (val == 48 || val == 96)) 
    {
      return false;
    }else if(val == 8 || val == 116 || val == 18 || val ==9)
    {
      return true;
    }
    else if (val >= 48 && val < 58 ) 
    {
      return true;
    }else if (val >= 96 && val < 106 ) 
    {
      return true;
    }
    else 
    {
      return false;
    }
  }

  //ONLY FLOAT NUMBERS ALLOWS 
  function isFloat(evt) 
  {
    var charCode = (event.which) ? event.which : event.keyCode;
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) 
    {
      return false;
    }
    else 
    {
      //if dot sign entered more than once then don't allow to enter dot sign again. 46 is the code for dot sign
      var parts = evt.srcElement.value.split('.');
      if (parts.length > 1 && charCode == 46)
      {
      return false;
      }
      return true;
    }
  }

  /*******ONLY FLOAT NUMBERS ALLOWS**********/
  function validateFloatKeyPress(el, evt) 
  {
      var charCode = (evt.which) ? evt.which : event.keyCode;
      var number1 = el.value;
      var number2 = parseInt(number1);
      var number = el.value.split('.');
      if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) 
      {
          return false;
      }
      //just one dot (thanks ddlab)
      if(number.length>1 && charCode == 46)
      {
           return false;
      }

      //get the carat position
      var caratPos = getSelectionStart(el);
      var dotPos = el.value.indexOf(".");
      if( caratPos > dotPos && dotPos>-1 && (number[1].length > 1))
      {
          return false;
      }
      else if(parseInt(number1).toString().length == 2 && number.length == 1 && charCode != 46)
      {
          return false;
      }
      return true;
  }

  function getSelectionStart(o) 
  {
    if (o.createTextRange) 
    {
      var r = document.selection.createRange().duplicate()
      r.moveEnd('character', o.value.length)
      if (r.text == '') return o.value.length
      return o.value.lastIndexOf(r.text)
    } else return o.selectionStart
  }
  /******************************************/
</script>