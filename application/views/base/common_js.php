<script type="text/javascript">

  $(document).ready(function ()
  {
    var openModalsCount = 0;
    $('.modal').on('shown.bs.modal', function() {
        openModalsCount++;
    }).on('hidden.bs.modal', function() {
        openModalsCount--;
        if (openModalsCount > 0) $('body').addClass('modal-open');
    });

    $('.select2').select2();

    //Date picker
    $('.single-daterange').daterangepicker({
      singleDatePicker: true,
      //showDropdowns: true
      locale: {
                format: 'DD-MM-YYYY'
              }
    });

    //Date picker for salary slip
    $('.single-from').daterangepicker({
      singleDatePicker: true,
      locale: {
                format: 'DD-MM-YYYY'
              }
    });

    $('.single-to').daterangepicker({
        singleDatePicker: true,
        minDate: new Date(),
        locale: {
                  format: 'DD-MM-YYYY'
                }
    });

    //To date Picker loaded based on from date
    $('.single-from').on('apply.daterangepicker', function(ev, picker) {
      var fromDate = picker.startDate.format('DD-MM-YYYY');
      $('.single-to').daterangepicker({
        singleDatePicker: true,
        minDate: fromDate,
        locale: {
                  format: 'DD-MM-YYYY'
                }
      });
    });

    //From Date picker
    $('.single-daterange-from').daterangepicker({
      singleDatePicker: true,
      locale: {
                //format: 'YYYY-MM-DD'
                format: 'DD-MM-YYYY'
              }
    });

    $('.single-daterange-to').daterangepicker({
        singleDatePicker: true,
        minDate: new Date(),
        locale: {
                  format: 'DD-MM-YYYY'
                }
    });
        
    //To date Picker loaded based on from date
    $('.single-daterange-from').on('apply.daterangepicker', function(ev, picker) {
      var fromDate = picker.startDate.format('DD-MM-YYYY');
      $('.single-daterange-to').daterangepicker({
        singleDatePicker: true,
        minDate: fromDate,
        locale: {
                  format: 'DD-MM-YYYY'
                }
      });
    });
    
    // Toggle Menu
    /*$('legend').click(function() {
        var $this = $(this);
        var parent = $this.parent();
        var contents = parent.contents().not(this);
        if (contents.length > 0) {
            $this.data("contents", contents.remove());
        } else {
            $this.data("contents").appendTo(parent);
        }
        return false;
    });*/

    <?php
    if($dataTableUrl)
    {
      ?>
        var oTable = $('#dataTableId').dataTable
        ({
          "sScrollX"        : "100%",
          "sScrollXInner"   : "100%",
          "bScrollCollapse" : true,                
          "bProcessing"     : true,
          //"serverSide"      : true,
          "searchable"      : true,
          responsive        : true,
          "sAjaxSource"     : '<?php echo base_url(); ?>index.php/<?php echo $dataTableUrl;?>',
          "bJQueryUI"       : true,
          "sPaginationType" : "full_numbers",
          "iDisplayStart "  :20,
              "oLanguage"   : {
          "sProcessing"     : "<img src='<?php echo base_url(); ?>assets/ajax-loader_dark.gif'>"

          },
          "fnInitComplete": function()
           {
              oTable.fnAdjustColumnSizing();
           },
          'fnServerData': function(sSource, aoData, fnCallback)
          {
            $.ajax
            ({
              'dataType': 'json',
              'type'    : 'POST',
              'url'     : sSource,
              'data'    : aoData,
              'success' : fnCallback
            });
          }
        });
      <?php 
    }
    ?>

    // When the form is submitted
    $("#ajaxModelForm, #ajaxModelForm1, #ajaxModelForm2").submit(function()
    { 
      // 'this' refers to the current submitted form 
      var str       = $(this).serialize();
      var actionUrl = $(this).data('action');
      var model_no1  = $(this).data('model_no');
      (typeof model_no1 == 'undefined') ? (model_no='1') : (model_no = model_no1);
      console.log(model_no);
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
                var parsedJson = JSON.parse(html1);
                $('#modal'+model_no).modal('hide');
                 $('.select2me').select2();
                location.reload();
            }       
          } 
          catch(e) 
          {
            $("#body"+model_no).html("<p>"+html1+"</p>"); // msg in modal body
            $("#modal"+model_no).modal("show"); // show modal instead alert box
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
              var parsedJson = JSON.parse(html1);
              $('#modal1').modal('hide');
              location.reload();
            }       
          } 
          catch(e) 
          {
            $("#body1").html("<p>"+html1+"</p>"); // msg in modal body
            $("#modal1").modal("show"); // show modal instead alert box
          }
        },
      });
    }); // end submit event 
    

    // When the form is submitted
    $("#ajaxContentForm").submit(function()
    { 
      // 'this' refers to the current submitted form 
      var str       = $(this).serialize();
      var actionUrl = $(this).data('action');

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
                var parsedJson = JSON.parse(html1);
                $('#result').val(parsedJson.inserted_id);
               console.log(parsedJson);
                $('#modal2').modal('hide');
                //location.reload();
            }       
          } 
          catch(e) 
          {
            $("#body2").html("<p>"+html1+"</p>"); // msg in modal body
            $("#modal2").modal("show"); // show modal instead alert box
          }
        },
      });
    }); 

    //Alert message fade
    $("#alert-message").fadeTo(2000, 500).slideUp(500, function(){
    $("#alert-message").slideUp(500);
    $("#alert-message").remove();
    });
  
    // Check all and un-check all for HR/attendance
    $("#checkAll").click(function(){
        $(".checkbox").prop("checked", true);
    });

    $("#uncheckAll").click(function(){
        $(".checkbox").prop("checked", false);
    });  
  });

  //Add new popup
  function addNewPop(addFormUrl, pkey)
  {
    $.ajax({
    type: "GET",
    url: "<?php echo base_url();?>"+addFormUrl,
    data: {'pkey_id' : pkey},
    dataType:"html",
        success: function(html1)
        {
          if(html1 != 'success')
          {
            // assigning modal title from parameter
            $("#body1").html("<p>"+html1+"</p>"); // msg in modal body
            $("#modal1").modal("show"); // show modal instead alert box
          }
        },
    });
  } 

  function addNewRow(content_id)
  {
    var row = $("#"+content_id+" tr:last");

    row.clone().find("input, textarea, select, button, checkbox, radio").each(function()
    {
      i   = $(this).data('row') + 1;
      id  = $(this).data('name') + i;
      $(this).val('').attr({'id' : id, 'data-row' : i});
      $(this).removeAttr('disabled');
    }).end().appendTo("#"+content_id);

    //$("select.select2").select2();
    $('.single-daterange').daterangepicker({singleDatePicker: true,locale: {format: 'DD-MM-YYYY'}});

    //From Date picker
    $('#from_date'+i).daterangepicker({
      singleDatePicker: true,
      locale: {
                //format: 'YYYY-MM-DD'
                format: 'DD-MM-YYYY'
              }
    });

    $('#to_date'+i).daterangepicker({
        singleDatePicker: true,
        minDate: new Date(),
        locale: {
                  format: 'DD-MM-YYYY'
                }
    });
        
    //To date Picker loaded based on from date
    $('#from_date'+i).on('apply.daterangepicker', function(ev, picker) {
      var fromDate = picker.startDate.format('DD-MM-YYYY');
      $('#to_date'+i).daterangepicker({
        singleDatePicker: true,
        minDate: fromDate,
        locale: {
                  format: 'DD-MM-YYYY'
                }
      });
    });
  }

  function checkDeleteButton(inputClass, disabledClass) 
  {
    var checkVal = 0;
    var value    = 0;
    $('.'+inputClass+':checkbox:checked').each(function ()
    {
      checkVal = (this.checked ? '1' : "");
      value    = (this.checked ? $(this).val() : "");
    });

    if(!value)
    {
      if(checkVal > 0)
      {
        $('.'+disabledClass).removeAttr("disabled");
      }else
      {
        $('.'+disabledClass).attr("disabled", "disabled");
      }
    }else{
        $('.'+disabledClass).removeAttr("disabled");
    }
  }

  function addRowDelete(content_id, inputClass, table, pk_field)
  {
    if((arguments[0] != null))
    {
      swal({
          title: "Are you sure?",
          text: "You want to delete this???",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          confirmButtonText: "Yes",
          cancelButtonText:  "Cancel",
          closeOnConfirm: false,
          closeOnCancel: false
       },
        function(isConfirm)
        {
          if (isConfirm)
          {
          $('.'+inputClass+':checkbox:checked').each(function ()
          {
            var isThisVal = (this.checked ? $(this).val() : "");                
            if(isThisVal)
            {
              $.ajax({
                        type: "POST",
                        url :"<?php echo base_url();?>/Common_controller/delete",
                        data: {"table" : table, "pk_field" : pk_field, "val" : isThisVal}
                    });
            }
            $(this).closest('tr').remove();

            //Add Disabled Atribute
            $(".add-delete").attr("disabled", "disabled");
          });
          swal("DONE", "", "success");
          } 
          else 
          {
            swal("This operation has been cancelled", "", "error");
            //e.preventDefault();
          }
        });
    }
  }

  function addTableContentPop(addFormUrl, pkey)
  {
    $.ajax({
    type: "GET",
    url: "<?php echo base_url();?>"+addFormUrl,
    data: {'pkey_id' : pkey},
    dataType:"html",
        success: function(html1)
        {      
          if(html1 != 'success')
          {
            // assigning modal title from parameter
            $("#body1").html("<p>"+html1+"</p>"); // msg in modal body
            $("#modal1").modal("show"); // show modal instead alert box
            //loadDeliveryNoteDropdown();
          }
        },
    });
  }
  
  function addTableContentPop1(addFormUrl, pkey)
  {
    $.ajax({
    type: "GET",
    url: "<?php echo base_url();?>"+addFormUrl,
    data: {'pkey_id' : pkey},
    dataType:"html",
        success: function(html1)
        {      
           
              // assigning modal title from parameter
              $("#body1").html("<p>"+html1+"</p>"); // msg in modal body
              $("#modal1").modal("show"); // show modal instead alert box
            
        },
    });
  }

  function addDropdownPopup(addFormUrl, pkey)
  {
      $.ajax({
      type: "GET",
      url: "<?php echo base_url();?>"+addFormUrl,
      data: {'pkey_id' : pkey},
      dataType:"html",
          success: function(html1)
          {      
            if(html1 != 'success')
            {
              // assigning modal title from parameter
              $("#body3").html("<p>"+html1+"</p>"); // msg in modal body
              $("#modal3").modal("show"); // show modal instead alert box
            }
          },
      });
  }

  //Delete function with sweet alert
  function confirmDelete(url)
  {
    if(arguments[0] != null)
    {
      swal({
          title: "Are you sure?",
          text: "You want to delete this???",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          confirmButtonText: "Yes",
          cancelButtonText:  "Cancel",
          closeOnConfirm: false,
          closeOnCancel: false
       },
       function(isConfirm)
       {
         if (isConfirm)
         {
            //swal("<?php echo lang('common_message_delete')?>", "", "success");
            location.href = url;

          } else 
          {
            swal("This operation has been cancelled", "", "error");
            //e.preventDefault();
          }
       });
    }
    else
    {
      return false;
    }
    return;
  }

  //Delete function with sweet alert
  function moduleDelete(url, error)
  {
    if(error == '0')
    {
      if(arguments[0] != null)
      {
        swal({
            title: "Are you sure?",
            text: "You want to delete this???",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: "Yes",
            cancelButtonText:  "Cancel",
            closeOnConfirm: false,
            closeOnCancel: false
         },
         function(isConfirm)
         {
           if (isConfirm)
           {
              //swal("<?php echo lang('common_message_delete')?>", "", "success");
              location.href = url;

            } else 
            {
              swal("This operation has been cancelled", "", "error");
              //e.preventDefault();
            }
         });
      }
      else
      {
        return false;
      }
      return;     
    }else
    {
      swal("Do not delete the module", "Because this module have lot of operations!");
    }
  }

  //Delete function with sweet alert
  function trainerDelete(url, trainer_id)
  {
    $.ajax({
      type: "GET",
      url: "<?php echo base_url('hr/Training/Trainer/checkTrainer');?>",
      data: {'trainer_id' : trainer_id},
          success: function(data)
          {
            if(data == 0)
            {
              if(arguments[0] != null)
              {
                swal({
                    title: "Are you sure?",
                    text: "You want to delete this???",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: "Yes",
                    cancelButtonText:  "Cancel",
                    closeOnConfirm: false,
                    closeOnCancel: false
                 },
                 function(isConfirm)
                 {
                   if (isConfirm)
                   {
                      //swal("<?php echo lang('common_message_delete')?>", "", "success");
                      location.href = url;

                    } else 
                    {
                      swal("This operation has been cancelled", "", "error");
                      //e.preventDefault();
                    }
                 });
              }
              else
              {
                return false;
              }
              return;     
            }else
            {
              swal("Do not delete the trainer", "The Trainer have already assign the program!");
            }            
          },
      });
  }     

  //Checkbox show content
  function showContent(checkbox, contentDiv) 
  {
    if(checkbox.checked)
    {
        $(contentDiv).css('display', 'block');
    }else
    {
        $(contentDiv).css('display', 'none');
    }
  }

  //Checkbox show Multicontent BY CHANDRU
  function showMultiContent(checkbox, contentDiv, value) 
  {
    if(checkbox.checked)
    {
        $(contentDiv).css('display', 'block');
        $(value).css('display', 'none');
    }else
    {
        $(contentDiv).css('display', 'none');
        $(value).css('display', 'block');
    }
  }

  //Select box show content
  function showSelectContent(opt, contentDiv)
  {
    if(opt  ==  contentDiv)
    {
         $('#'+contentDiv).css('display', 'block');
    }
    else
    {
         $('#'+contentDiv).css('display', 'none');
    }
  }

  //Select box show content
  function showSelectContentremarks(opt)
  {
    if(opt  ==  3)
    {
         $('#rejection_remarks').css('display', 'block');
    }
    else
    {
         $('#rejection_remarks').css('display', 'none');
    }
  }

  //script for load leave approver name
  function loadleave_approver_name()
  {
    leave_approver_id = $('#leave_approver_id').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Leaves_holiday/Leave_application/loadleave_approver_name',
      data : {'leave_approver_id' : leave_approver_id},
      success : function(data)
      {
        $('#leave_approver_name').val(data);
      },
    });
  }

  function loadjobapplicantname()
  {
    job_applicant_id = $('#job_applicant_id').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Recruitment/Offerletter/getjobapplicantname',
      data : {'job_applicant_id' : job_applicant_id},
      success : function(data)
      {
        $('#applicant_name').val(data);
      },
    });
  }

  //Load Employee Name by praveen
  function loademployeename()
  {
    $employee_id = $('#employee_id').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Employee_loan/Loan_application/getemployeename',
      data : {'employee_id' : $employee_id},
      success : function(data)
      {
        parseData = JSON.parse(data);
        if(parseData)
        {
          $('#employee_name').val(parseData.employee_name);
          $('#company_id').select2('val', parseData.company_id);
          $('#company_id_hidden').val(parseData.company_id);
        }else
        {
          $('#employee_name').val('');
          $('#company_id').select2('val', '');
          $('#company_id_hidden').val('');
        }
      },
    });
  }

  //Load User name
  function loadusername()
  {
    $user_id = $('#user_id').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Leaves_holiday/Leave_application/getusername',
      data : {'user_id' : $user_id},
      success : function(data)
      {
        $('#leave_approver_name').val(data);
      },
    });
  }

  /*  by uday dropdown select  */
  function showSelectContent1(opt,values1,values2)
  {
    if (opt == "1")
    {
      $('#'+values1).css('display', 'block');
      $('#'+values2).css('display', 'none');
    }else if(opt == "2")
    {
      $('#'+values1).css('display', 'none');
      $('#'+values2).css('display', 'block');
    }else
    {
      $('#'+values1).css('display', 'none');
      $('#'+values2).css('display', 'none');
    }
  }

  //Load details for trainer by praveen
  function loadDetails()
  {
    trainer_id = $('#trainer_id').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Training/Training_event/loadDetails',
      data : {'trainer_id' : trainer_id},
      success : function(data)
      {         
        parseData = JSON.parse(data);
        $('#trainer_email').val(parseData.trainer_email);
        $('#contact_number').val(parseData.trainer_contact);
        $('#company_id').select2('val', parseData.company_id);
      },
    });
  }

  function loadTranierName()
  {
    training_event_id = $('#training_event_id').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Training/Training_feedback/getTranierName',
      data : {
        'training_event_id' : training_event_id},
      success : function(data)
      {         
        parseData = JSON.parse(data);
         $('#trainer_name').val(parseData.trainer_name);
      },
    });
  }

  //counthalfdays in leave application by dhanam
  function counthalfdays(val)
  {
    if($('#half_day').is(':checked'))
    {
      from_date       = $('#from_date').val();
      to_date         = $('#to_date').val();
      
      if($("#half_day").is(':checked'))
      {
        half_day_date   = $('#half_day_date').val();        
      }

      $.ajax
      ({
        type : "POST",
        url  : '<?php echo base_url();?>hr/Leaves_holiday/Leave_application/halfdaydiff',
        data : {
                'from_date' : from_date,
                'to_date' : to_date,
                'half_day_date' : half_day_date,
              },
        success : function(data)
        {         
          $('#total_leave_days').val(data);
        },
      });
    }
    else
    {
      from_date  = $('#from_date').val();
      to_date    = $('#to_date').val();

      if(from_date && to_date)
      {
        $.ajax
        ({
          type : "POST",
          url  : '<?php echo base_url();?>hr/Leaves_holiday/Leave_application/daydiff',
          data : {
                    'from_date' : from_date,
                    'to_date' : to_date,
                },
          success : function(data)
          {

           $('#total_leave_days').val(data);
          },
        });
      }
    }
  } 
 
  function loadVehicle()
  {
    vehicle_id = $('#vehicle_id').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Fleet_management/Vehicle_log/getVehicle',
      data : {'vehicle_id' : vehicle_id},
      success : function(data)
      {         
        parseData = JSON.parse(data);
        $('#make').val(parseData.make);
        $('#model').val(parseData.model);
      },
    });
  }  

  // Get End Date 
  function loadEnddate(val)
  {
    from_date   = $('#from_date').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Leaves_holiday/Holiday_list/getToDate/',
      data : {
        'from_date' : from_date,
    },
      success : function(data)
      {         
       $('#to_date').val(data);
      },
    });
  }

  function loadTodate(val)
  {
    from_date   = $('#from_date').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Payroll/Salary_structure/getToDate/',
      data : {
        'from_date' : from_date,
    },
      success : function(data)
      {         
       $('#to_date').val(data);
      },
    });
  } 

  // Get WeekOff Days 
  function LoadWeekOff(val)
  {
    from_date                   = $('#from_date').val();
    to_date                     = $('#to_date').val();
    holliday_list_weekly_off_id = $('#holliday_list_weekly_off_id').val();  

    if(holliday_list_weekly_off_id == '0' || holliday_list_weekly_off_id)
    {
      $.ajax
      ({
        type : "POST",
        dataType:'html',
        url  : '<?php echo base_url();?>hr/Leaves_holiday/Holiday_list/getWeekOff',
        data : 
        {
          'from_date' : from_date,
          'to_date'   : to_date,
          'holliday_list_weekly_off_id' : holliday_list_weekly_off_id,
        },
        success : function(htmlContent)
        {     
          $('#holidayList').html(htmlContent);
        }
      });      
    }else
    {
      swal("Please select from date or to date or weekly off");
    }
  }

  //HR Module Loan application Dropdown
  function loadrepayment(opt)
  {
    if(opt == '1')
    {
      $('#Repayfixedamount').css('display', 'block');
      $('#Repayovernumber').css('display', 'none');
    }else
    {
      $('#Repayfixedamount').css('display', 'none');
      $('#Repayovernumber').css('display', 'block');
    }
  }

  //HR Module Loan application rejection remarks
  function loadRejectionRemarks(opt)
  {
    if(opt == 3)
    {
      $('#rejection_remarks').css('display', 'block');
     
    }else
    {
      $('#rejection_remarks').css('display', 'none');
    }
  }

  // Check all and un-check all for HR/attendance
  $(function () 
  {
    $("#checkAll").click(function(){
        $(".checkbox").prop("checked", true);
    });

    $("#uncheckAll").click(function(){
        $(".checkbox").prop("checked", false);
    });  
  });

  function addEmployee()
  {
    branch_id     = $('#branch_id').val();
    company_id    = $('#company_id').val();
    department_id = $('#department_id').val();

    $.ajax
    ({
      type : "POST",
      dataType:'html',
      url  : '<?php echo base_url();?>hr/Employee_attendance/Employee_attendance/getEmployeeDetails/',
      data : {

                'branch_id' : branch_id,
                'company_id' : company_id,
                'department_id' : department_id
            },
      success : function(html1)
      {
        $('#employeeAttendanceData').html(html1);
      }
    });
  }

  function getCheckedCheckboxesFor(attendanceStatus) 
  {
      var checkboxes = $(".employeeList:checked"), values = [];
      Array.prototype.forEach.call(checkboxes, function(el){
        if(!el.disabled)
        {
          values.push(el.value);
        }
      });         

      $("#employeeList_"+attendanceStatus).val(values);

      presentList = $("#employeeList_1").val();
      absentList  = $("#employeeList_2").val();
      halfDayList = $("#employeeList_3").val();
      leaveList   = $("#employeeList_4").val();

      //AjaxCall
      $.ajax
      ({
        type : "POST",
        url  : '<?php echo base_url();?>hr/Employee_attendance/Employee_attendance/loadDetails/',
        data : {
                  'presentList'   : presentList,
                  'absentList'    : absentList,
                  'halfDayList'   : halfDayList,
                  'leaveList'     : leaveList
               },
        success : function(data)
        {        
          $('#employeeAttendanceContent').html(data);
          
          $(".employee_id").each(function()
          {
            employee_id = $(this).data('id');
            $('#employee_id_'+employee_id).prop('disabled', true);
          });
        },
      });
  }

  //Load details for Loan Type by Manoj
  function loadLoanDetails()
  {
    loan_type_id = $('#loan_type_id').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Employee_loan/Loan_application/loadLoanDetails',
      data : {'loan_type_id' : loan_type_id},
      success : function(data)
      {         
        parseData = JSON.parse(data);
        $('#rate_of_interest').val(parseData.rate_of_interest);
      },
    });
  }

  // Calculate total payable interest and total payable amount in employee loan application by Manoj
  function calculateInterest()
  {
    var repay_period        = $('#emp_loan_repayment_method_id').val();
    var loan_amount         = $('#maximum_loan_amount').val();
    var rate_of_interest    = parseFloat($('#rate_of_interest').val());
    var no_of_months        = $('#repayment_periods').val();
    var repay_month_amount  = $('#repayment_amount').val();
    var no_of_periods       = no_of_months/12; 

    if(repay_period == 2)
    {
      /* OLD CALCULATIONS blocked by praveen
        var repay_amount            = Number(loan_amount)/Number(no_of_months);
        $('#repayment_amount').val(repay_amount.toFixed(2));

        if(repay_month_amount)
        {
          var payable_interest        = (Number(loan_amount)*Number(no_of_periods)*Number(rate_of_interest))/100;
          //var payable_interest        = (Number(loan_amount)*Number(no_of_periods)*Number(rate_of_interest))/100;
          $('#total_payable_interest').val(payable_interest.toFixed(2));

          var total_payable_amount    = Number(payable_interest)+Number(loan_amount);
          $('#total_payable_amount').val(total_payable_amount.toFixed(2));        
        }
      */

      /* EMI CALCULATION By Praveen
        Formula(EMI) = [(P*R)*(1+R)^n]/[(1+R)^n-1]
        P-Loan Amount
        R-Rate of interest 
        n-Tenure of repayment
      */
      if(loan_amount)
      {
        if(no_of_months)
        {
          var interest             = (rate_of_interest/(no_of_months * 100));
          var emi                  = (((loan_amount * interest) * Math.pow((1+interest), no_of_months))/((Math.pow((1+interest), no_of_months))-1));
          var total_payable_amount = emi * no_of_months;
          var payable_interest     = total_payable_amount - loan_amount;

          $('#repayment_amount').val(emi.toFixed(2));
          $('#total_payable_amount').val(total_payable_amount.toFixed(2));
          $('#total_payable_interest').val(payable_interest.toFixed(2));          
        }
      }else
      {
        $('#repayment_periods').val('');
        swal("Please given loan amount");
      }
    }
    else 
    {
      /* OLD CALCULATION
        var repay_month_period      = Number(loan_amount)/Number(repay_month_amount);
        $('#repayment_periods').val(repay_month_period.toFixed(0));

        if(repay_month_amount)
        {
          var payable_interest        = (Number(loan_amount)*Number(repay_month_period)/12*Number(rate_of_interest))/100;
          $('#total_payable_interest').val(payable_interest.toFixed(2));

          var total_payable_amount    = Number(payable_interest)+Number(loan_amount);
          $('#total_payable_amount').val(total_payable_amount.toFixed(2)); 
        }
      */

      /* NEW CALCULATION by praveen */

      if(loan_amount)
      {
        if(repay_month_amount)
        {
          var repay_month_period    = ((loan_amount/repay_month_amount).toFixed(0));
          var total_payable_amount  = repay_month_amount * repay_month_period;
          var payable_interest      = Number(total_payable_amount) - Number(loan_amount);

          $('#repayment_periods').val(repay_month_period);
          $('#total_payable_amount').val(total_payable_amount.toFixed(2));
          $('#total_payable_interest').val(payable_interest.toFixed(2));  
        }
      }else
      {
        $('#repayment_amount').val('');
        swal("Please given loan amount");
      }
    }
  }

  // Load repayment period and repayment amount
  function showSelectContentrepayment(opt)
  { 
    if (opt == "1")
    {
      $('#repaymentAmountContent').show();
      $('#repayment_amount').attr("readonly",false);
      $('#repayment_periods').attr("readonly",true); 
      $('#repayment_periods').val('');
      $('#repayment_amount').val('');
    }else if(opt == "2")
    {
      $('#repaymentAmountContent').show();
      $('#repayment_periods').attr("readonly",false);
      $('#repayment_amount').attr("readonly",true);
      $('#repayment_amount').val('');
      $('#repayment_periods').val('');
    }
  }
  
  //Load Salary Earning abbr For Salary Structure by KR
  function loadSalaryearn_abbr(id,val)
  {
    var id               =   id;
    var thenum           =   id.match(/\d+$/)[0];
    salary_component_id  =   $('#salary_component_id_earing'+thenum).val();
      
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Payroll/Salary_structure/getsalary_earnabbr',
      data : {'salary_component_id' : salary_component_id},
      success : function(data)
      {
         $('#salary_component_abbr_earing'+thenum).val($.trim(data));
      },
    });
  }

  //Load Salary Deduction For Salary Structure abbr by KR
  function loadSalarydeduct_abbr(id,val)
  {
    var id             =   id;
    var thenum           =   id.match(/\d+$/)[0];
    salary_component_id  =   $('#salary_component_id_deduction'+thenum).val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Payroll/Salary_structure/getsalary_deductabbr',
      data : {'salary_component_id' : salary_component_id},
      success : function(data)
      {
        $('#salary_component_abbr_deduction'+thenum).val($.trim(data));
      },
    });
  }
  
  //Calculate halday
  function halfdaydate()
  {
    if($('#half_day').is(':checked'))
    {
    $('#halfday').css('display', 'block');
    }
    else
    {
        $('#halfday').css('display', 'none'); 
    }
  }

  // unused leaves for leave application  
  function leavebalance(val)
  {
    total_leaves_allocated   = (val) ? val : $('#total_leaves_allocated').val();
    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Leaves_holiday/Leave_application/getleavebalance/',
      data : {
        'total_leaves_allocated' : total_leaves_allocated,
    },
      success : function(data)
      {         
       $('#leave_balance').val(data);
      },
    });
  } 

  //Block Leaves
  function blockLeaves(val)
  {
    from_date = $('#from_date').val();
    to_date   = $('#to_date').val();
    $.ajax
    ({
        type : "POST",
        url  : '<?php echo base_url();?>hr/Leaves_holiday/Leave_application/blockLeaves/',
        data : {
                from_date: from_date,
                to_date: to_date,
               },
      success : function(data)
      {
        if(data == 0)
        {
         
        } 
        else
        {
          alert('These dates are in block list!!!!');
        }
      }
    });
  }

  function carryforwardleaves()
  {
    employee_id = $('#employee_id').val();
    total_leaves_allocated = $('#total_leaves_allocated').val();   

      $.ajax
      ({
        type : "POST",
        url  : '<?php echo base_url();?>hr/Leaves_holiday/Leave_allocation/gettotalleavesallocated',
        data : {
                 'employee_id' : employee_id,
                 'total_leaves_allocated' : total_leaves_allocated
                },
        success : function(data)
        {  

         $('#carry_forwarded_leaves').val(data);

        },
      });
  }

  function loadUnusedLeaves(checkbox, contentDiv)
  {
    if(checkbox.checked)
    {
        carry_forward   = $('#carry_forward').val();
        employee_id     = $('#employee_id').val();
        leave_type_id   = $('#leave_type_id').val();
        $.ajax
        ({
            type : "POST",
            url  : '<?php echo base_url();?>hr/Leaves_holiday/Leave_allocation/loadUnusedLeaves',
            data : {'carry_forward' : carry_forward,
                    'employee_id'   : employee_id,
                    'leave_type_id' : leave_type_id
                    }, 
            success : function(data)
            {
                //parseData = JSON.parse(data);
                $('#unused_leaves').show();
                carryforwardleaves();

                var new_leaves      = $('#new_leaves_allocated').val();
                var unused_leaves   = $('#carry_forwarded_leaves').val();
                var total_leaves    = new_leaves+unused_leaves;

                $('total_leaves_allocated').val(total_leaves);
            },
        });
    }
    else
    {
        $('#unused_leaves').hide();
        var new_leaves    = $('#new_leaves_allocated').val();
        $('#total_leaves_allocated').val(new_leaves);  
    }
  }

  $("#new_leaves_allocated").keyup(function()
  {
    $("#total_leaves_allocated").val($(this).val());
  });

  function Iscritical()
  {
      if($('#is_critical').is(':checked'))
      {
      $('#disabled').css('display', 'none');
      }
      else
      {
          $('#disabled').css('display', 'block'); 
      }
  }

  function loadcurrency(val)
  {
    price_list_id   = $('#price_list_id').val();
    $.ajax
    ({

      type : "POST",
      url  : '<?php echo base_url();?>inventory/Items_and_pricing/Item_price/getcurrency',
      data : {
        'price_list_id' : price_list_id,
    },
      success : function(data)
      {         
        parseData = JSON.parse(data);
        $('#currency').val(parseData.currency);
        if(parseData.buying  == '1')
        {
          $("#buying").attr('checked', 'true');
        }
        if(parseData.selling  == '1')
        {
        $("#selling").attr('checked', 'true');
        }
      },
    });
  }

  // Below code for Salary silp  And Salary Strcuture author by @ KarthiRam
  function salaryStructureEmployee()
  {
    employee_id             = $('#employee_id').val();
    $.ajax
    ({
    type : "POST",
    url  : '<?php echo base_url();?>hr/Payroll/Salary_slip/loadEmployeeDetails/',
    data : {
      'employee_id' : employee_id,
    },
      success : function(data)
      {
        parseData = JSON.parse(data);
        $('#employee_name').val(parseData.employee_name);
        $('#company_id').val(parseData.company_name);
        $('#department_id').val(parseData.department_name);
        $('#branch_id').val(parseData.branch);
        $('#designation_id').val(parseData.designation_name);
        $('#payroll_frequency_id').select2('val', parseData.payroll_frequency_id);
        $('#letter_head_id').select2('val', parseData.letter_head_id);
        $('#salary_structure_id').select2('val', parseData.salary_structure_id);
        $('#base').val(parseData.base);

        calculateWorkingdays();
      },
    });
  }

  // Below code for Salary silp  And Salary Strcuture author by @ KarthiRam
  function salaryslipGetToDate()
  {
    posting_date            = $('#posting_date').val();
    payroll_frequency_id    = $('#payroll_frequency_id').val();
    $.ajax
    ({
    type : "POST",
    url  : '<?php echo base_url();?>hr/Payroll/Salary_slip/getToDate/',
    data : {
      'posting_date' : posting_date,
      'payroll_frequency_id' : payroll_frequency_id,
    },
        success : function(data)
    {

        $('#start_date').val(posting_date);
        $('#end_date').val(data);
        
    },
    });
  }

  // Below code for Salary silp And Salary Strcuture author by @ KarthiRam
  function getComponent()
  {
    salary_structure_id    = $('#salary_structure_id').val();
    employee_id            = $('#employee_id').val();
    base_salary            = $('#base_salary').val();
    base_salary            = $('#base_salary').val();
    salary_slip_id         = $('#salary_slip_id').val();

    $.ajax
    ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Payroll/Salary_slip/getComponent/',
      data : {'salary_structure_id' : salary_structure_id, 'employee_id' : employee_id, 'base_salary' : base_salary, 'salary_slip_id' : salary_slip_id},
          success : function(htmlContent)
          {
              $('#Earning').html(htmlContent);
          },
    });
   
    if(salary_structure_id != '')
    {
      $.ajax
      ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Payroll/Salary_slip/getDedComponent/',
      data : {
        'salary_structure_id' : salary_structure_id, 'employee_id' : employee_id, 'base_salary' : base_salary, 'salary_slip_id' : salary_slip_id
      },
          success : function(htmlContent)
          {
              $('#Deduction').html(htmlContent);
          },
      });
    }
  }

  // Below code for Salary silp And Salary Strcuture 
  function calculateWorkingdays()
  {
    start_date              = $('#start_date').val();
    end_date                = $('#end_date').val();
    employee_id             = $('#employee_id').val();
    hour_rate               = $('#hour_rate').val();
    total_working_hours     = $('#total_working_hours').val();

    $.ajax
    ({
    type : "POST",
    url  : '<?php echo base_url();?>hr/Payroll/Salary_slip/calculateSalary/',
    data : {
      'from_date' : start_date,
      'to_date' : end_date,
      'employee_id' : employee_id,
      'hour_rate' : hour_rate,
      'total_working_hours' : total_working_hours,
    },
    success : function(data)
    {
      parseData = JSON.parse(data);

      $('#total_working_days').val(parseData.total_working_days);
      $('#payment_days').val(parseData.payment_days);
      $('#leave_without_pay').val(parseData.leave_without_pay);
      $('#payment_days').val(parseData.payment_days);
      $('#salary_component_earning').select2('val', parseData.salary_component_id);
      $('#salary_component_abbr_ear').val(parseData.salary_component_abbr_ear);
      $('#salary_component_formula_ear').val(parseData.salary_component_formula_ear);
      $('#gross_pay').val(parseData.totalEarnings);
      //$('#total_deduction').val(parseData.totalDeduction);
      $('#total_holidays').val(parseData.total_holidays);
      $('#per_day_salary').val(parseData.per_day_salary);
      $('#per_hour_salary').val(parseData.per_hour_salary);
      $('#base_salary').val(parseData.base_salary);       
      $('#total_working_hours').val(parseData.total_working_hours);
      $('#hour_rate').val(parseData.base_salary);
      
      $('#allowed_leaves').val(parseData.allowed_leaves);
      $('#lop').val(parseData.lop);
      $('#lop_amount').val(parseData.lop_amount);

      if(parseData.totalEarnings || parseData.totalDeduction)
      {
        $('#net_pay').val(parseData.totalEarnings-parseData.totalDeduction);
        $('#rounded_total').val(parseData.totalEarnings-parseData.totalDeduction);            
      }
      getComponent();
    },
    });
  }

  //Load Appraisal Tem[plate
  function getAppraisalTemplate()
  {
    appraisal_template_id            = $('#appraisal_template_id').val();
    $.ajax
    ({
    type : "POST",
    url  : '<?php echo base_url();?>hr/Appraisals/Appraisal/getAppraisalTemplate/',
    data : {
      'appraisal_template_id' : appraisal_template_id,
            },
    dataType : 'JSON',

        success : function(response)
        {
            $('#template_goal').html(response['templateContent']);


        },
    });
  }

  // Calculate total score based on kra  
  function calculateScore() 
  {
    $('.all_row_values').each(function(i,o){
      weightAge       = $(o).find('.weight_age').val()/100;
      score           = $(o).find('.score').val();
      if(score > 5)
      {
        swal({
              title: "Score must be less than or equal to 5",
              type: "warning",
              confirmButtonColor: '#339eff',
              confirmButtonText: "Ok",
           })
        $(o).find('.score').val('');
        $(o).find('.score_earned').val('');
      }
      else
      {
        var total = 0;

        scoreEarned    = Number(weightAge) * Number(score);

        $(o).find('.score_earned').val(scoreEarned.toFixed(2));
        $('.score_earned').each(function() 
        {
            total += Number($(this).val());
            var count = $('.score_earned').length;
            totalAvg = total/count;
            $('#total_score').val(totalAvg.toFixed(2));
        });
      }
      
    });
  }

  //Calculate total weightage author@Manojkumar
  function calculateWeightAge()
  {
    total = 0;
    $('.weight_age').each(function() 
    {
        total += Number($(this).val());
    });
    if((total>100) || (total<100))
    {
      swal({
        title: "Sum of weight age for all goals should be equal to 100",
        type: "warning",
        confirmButtonColor: '#339eff',
        confirmButtonText: "Ok",
     })
      $('.weight_age').val('');
    }
    else if(total == 100)
    {
      $("form").submit();
    }
  }

  //Employrr_form.php
  function showSelectContent2(opt,values1)
  {
    if (opt == "1")
    {
      $('#'+values1).css('display', 'block');
      
    }else
    {
      $('#'+values1).css('display', 'none');
      
    }
  }

  function showStatusContent(opt,values1)
  {
    if (opt == "1")
    {
      $('#Active').css('display', 'block');
      $('#left').css('display', 'none');      
    }else
    {
      $('#Active').css('display', 'none');
      $('#left').css('display', 'block');
    }
  }

  //Expense_claim_form.php
  function getecd()
  {
    $.ajax({
    type: "GET",
    url: "<?php echo base_url();?>hr/Expense_claims/Expense_claim/getecd", 
    data: {},
    dataType:"html",
        success: function(html1)
        {
            if(html1 != 'success')
            {
              // assigning modal title from parameter
              $(".modal-title").html("Expense claims Details Form"); 
              $(".modal-body").html("<p>"+html1+"</p>"); // msg in modal body
              $(".modal").modal("show"); // show modal instead alert box
            }
        },
    });
  }

  function calculateClaimAmount() 
  {
    claim_amount            = 0;

    $('.claim_amount').each(function()
    {
      claim_amount                  += Number($(this).val());
      $('#total_claimed_amount').val(claim_amount);
    });
  }

  function calculateSanctionedAmount() 
  {
    sanctioned_amount       = 0;

    $('.sanctioned_amount').each(function()
    {
      sanctioned_amount             += Number($(this).val());
      $('#total_sanctioned_amount').val(sanctioned_amount);
    });
  }

  function loadFrequency()
  {
    if ($('#salary_slip_based_on_timesheet').is(":checked"))
    {     
      $('#content_payroll_frequency').css('display', 'none');
    }
    else
    {
      $('#content_payroll_frequency').css('display', 'block');
    }
  }

  //Process_payroll_form.php
  function bulkEmployeeSalary()
  {
      department_id           = $('#department_id').val();
      start_date              = $('#start_date').val();
      end_date                = $('#end_date').val();
      posting_date            = $('#posting_date').val();
      branch_id               = $('#branch_id').val();
      designation_id          = $('#designation_id').val();
      $.ajax
      ({
      type : "POST",
      url  : '<?php echo base_url();?>hr/Payroll/Process_payroll/bulkEmployeeSalary/',
      data : {
        'department_id' : department_id,
        'start_date' : start_date,
        'end_date' : end_date,
        'posting_date' : posting_date,
        'branch_id' : branch_id,
        'designation_id' : designation_id},
      success : function(data)
      {
          if(department_id && start_date && end_date && posting_date)
          {   
              swal({
                    title: "Salary Slip created for mentioned criteria...",
                    type: "success",
                    confirmButtonColor: '#339eff',
                    confirmButtonText: "Ok",
                 })
          }
      },
      });
  }
  
  //Salary_slip_print_form.php
  function PrintMeSubmitMe()
  {
    $('#Active').css('display', 'none');
    window.print();
    SubmitMe();
  }

  //Training_program_form.php
  function loadtrainerdetails(id)
  {
    trainer_id           = $('#trainer_id').val();
    $.ajax
    ({
        type : "POST",
        url  : '<?php echo base_url();?>hr/Training/Training_program/gettrainerdetails',
        data : {
                'trainer_id' : trainer_id
                },
        success : function(data)
        {         
            parseData = JSON.parse(data);
                $('#trainer_email').val(parseData.trainer_email);     
                $('#trainer_contact').val(parseData.trainer_contact);     
        },
    }); 
  }

  function isNumberKey(evt) 
  {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if ((charCode < 48 || charCode > 57))
      return false;

      return true;
  }
</script>