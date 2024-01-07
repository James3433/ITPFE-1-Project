    var equipmentDiv = document.getElementById('equipDiv');
    var empDiv = document.getElementById('empDiv');
    var equipmentBtn = document.getElementById('equipmentBtn');
    var empBtn = document.getElementById('employeeBtn');
    var overlay = document.getElementById("overlay");
    var popup = document.getElementById("popup");

    var editPopup = document.getElementById("editPopup");
    var deletePopup = document.getElementById("deletePopup");
    var logoutPopup = document.getElementById("logoutPopup");

    var empIdInput = document.querySelector('input[name="input_emp_id"]');
    var empFnameInput = document.querySelector('input[name="input_emp_fname"]');
    var empMnameInput = document.querySelector('input[name="input_emp_mname"]');
    var empLnameInput = document.querySelector('input[name="input_emp_lname"]');
    var empTypeInput = document.querySelector('input[name="input_emp_type"]');
    var empAgeInput = document.querySelector('input[name="input_emp_age"]');
    var empSuffixInput = document.querySelector('select[name="input_emp_suffix"]');
    var empGenderInput = document.querySelector('select[name="input_emp_gender"]');
    var empStatusInput = document.querySelector('select[name="input_emp_status"]');
    var addButton = document.getElementById('add');

    var empIdDropdown1 = document.querySelector('select[name="input_emp_id1"]');
    var empFnameInput1 = document.querySelector('input[name="input_emp_fname1"]');
    var empMnameInput1 = document.querySelector('input[name="input_emp_mname1"]');
    var empLnameInput1 = document.querySelector('input[name="input_emp_lname1"]');
    var empTypeInput1 = document.querySelector('input[name="input_emp_type1"]');
    var empAgeInput1 = document.querySelector('input[name="input_emp_age1"]');
    var empSuffixInput1 = document.querySelector('select[name="input_emp_suffix1"]');
    var empGenderInput1 = document.querySelector('select[name="input_emp_gender1"]');
    var empStatusInput1 = document.querySelector('select[name="input_emp_status1"]');
    var editOkButton = document.querySelector('#editPopup #OKEdit');

    var empIdDropdown2 = document.querySelector('select[name="input_emp_id2"]');
    var empFnameInput2 = document.querySelector('input[name="input_emp_fname2"]');
    var empMnameInput2 = document.querySelector('input[name="input_emp_mname2"]');
    var empLnameInput2 = document.querySelector('input[name="input_emp_lname2"]');
    var empTypeInput2 = document.querySelector('input[name="input_emp_type2"]');
    var empAgeInput2 = document.querySelector('input[name="input_emp_age2"]');
    var empSuffixInput2 = document.querySelector('input[name="input_emp_suffix2"]');
    var empGenderInput2 = document.querySelector('input[name="input_emp_gender2"]');
    var empStatusInput2 = document.querySelector('input[name="input_emp_status2"]');
    var okDeleteButton = document.getElementById('OKDelete');


    equipmentBtn.addEventListener('click', function() {
        equipmentDiv.style.display = 'block';
        empDiv.style.display = 'none';
        equipmentBtn.style.backgroundColor = 'rgb(43, 112, 216)';
        empBtn.style.backgroundColor = '';
    });
    
    empBtn.addEventListener('click', function() {
            equipmentDiv.style.display = 'none';
            empDiv.style.display = 'block';
            equipmentBtn.style.backgroundColor = '';
            empBtn.style.backgroundColor = 'rgb(43, 112, 216)';
    });

    function showLogoutPopup() {
        overlay.style.display = "block";
        logoutPopup.style.display = "block";
    }

    document.getElementById("edit").addEventListener("click", function () {
        overlay.style.display = "block";
        editPopup.style.display = "block";
    });

    document.getElementById("CancelEdit").addEventListener("click", function () {
        overlay.style.display = "none";
        editPopup.style.display = "none";
    });


    document.getElementById("delete").addEventListener("click", function () {
    overlay.style.display = "block";
    deletePopup.style.display = "block";
    });

    document.getElementById("CancelDelete").addEventListener("click", function () {
    overlay.style.display = "none";
    deletePopup.style.display = "none";
    });


    document.getElementById("logout").addEventListener("click", function () {
        showLogoutPopup();
    });

    document.getElementById("logoutYes").addEventListener("click", function () {
        overlay.style.display = "none";
        logoutPopup.style.display = "none";
        window.location.href = 'index.php';
    });
    document.getElementById("logoutNo").addEventListener("click", function () {
        overlay.style.display = "none";
        logoutPopup.style.display = "none";
    });

    document.addEventListener('DOMContentLoaded', function () {
    

        function inputTextFromTable() {
            var empId = empIdInput.value;
            var empFname = empFnameInput.value;
            var empMname = empMnameInput.value;
            var empLname = empLnameInput.value;
            var empType = empTypeInput.value;
            var empAge = empAgeInput.value;
            var empSuffix = empSuffixInput.value;
            var empGender = empGenderInput.value;
            var empStatus = getStatusInt(empStatusInput.value);
            // Use AJAX to send the data to the server to add a new record
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        // Handle the response (if needed)
                        console.log(xhr.responseText);
                    } else {
                        console.error('Failed to add employee data:', xhr.status);
                    }
                }
            }
        
             // Prepare the data to be sent as a JSON object
        var requestData = {
            emp_id: empId,
            emp_fname: empFname,
            emp_mname: empMname,
            emp_lname: empLname,
            emp_type: empType,
            emp_age: empAge,
            emp_suffix: empSuffix,
            emp_gender: empGender,
            emp_status: empStatus
        };
            // Log the data before sending
            var jsonData = JSON.stringify(requestData);
            console.log('Request Data:', jsonData);
            // Update the URL to point to the correct location of add_employee.php
            xhr.open('POST', 'action/add_employee.php', true);
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.send(jsonData);
        }
        
        function inputTextAndSelectEdit() {
            // Get the selected emp_id
            var selectedEmpId = empIdDropdown1.value;
    
            // Use AJAX to fetch the corresponding employee details
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        try {
                            // Parse the JSON response
                            var employeeDetails = JSON.parse(xhr.responseText);
    
                            // Set the values in the corresponding input fields
                            empFnameInput1.value = employeeDetails.emp_fname;
                            empMnameInput1.value = employeeDetails.emp_mname;
                            empLnameInput1.value = employeeDetails.emp_lname;
                            empTypeInput1.value = employeeDetails.emp_type;
                            empAgeInput1.value = employeeDetails.emp_age;
                            empSuffixInput1.value = employeeDetails.emp_suffix;
                            empGenderInput1.value = employeeDetails.emp_gender;
                            empStatusInput1.value = getStatusText(employeeDetails.emp_status); 

                        } catch (error) {
                            console.error('Failed to parse JSON response:', error);
                        }
                    } else {
                        console.error('Failed to fetch employee details. Status:', xhr.status);
                    }
                }
            };
    
            // Send a GET request to the server to get employee details based on emp_id
            xhr.open("GET", "action/get_employee_details.php?emp_id=" + selectedEmpId, true);
            xhr.send();
        }
    
        function inputTextAndSelectDelete() {
            var selectedEmpId = empIdDropdown2.value;
    
            // Use AJAX to fetch the corresponding employee details
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        try {
                            // Parse the JSON response
                            var employeeDetails = JSON.parse(xhr.responseText);
   
                            empFnameInput2.value = employeeDetails.emp_fname;
                            empMnameInput2.value = employeeDetails.emp_mname;
                            empLnameInput2.value = employeeDetails.emp_lname;
                            empTypeInput2.value = employeeDetails.emp_type;
                            empAgeInput2.value = employeeDetails.emp_age;
                            empSuffixInput2.value = employeeDetails.emp_suffix;
                            empGenderInput2.value = employeeDetails.emp_gender;
                            empStatusInput2.value = getStatusText(employeeDetails.emp_status); 

                        } catch (error) {
                            console.error('Failed to parse JSON response:', error);
                        }
                    } else {
                        console.error('Failed to fetch employee details. Status:', xhr.status);
                    }
                }
            };
    
            // Send a GET request to the server to get employee details based on emp_id
            xhr.open("GET", "action/get_employee_details.php?emp_id=" + selectedEmpId, true);
            xhr.send();  
        }

        // Add an event listener to the emp_id dropdown
        empIdDropdown1.addEventListener('change', function () {
            inputTextAndSelectEdit();
        }); 
        
        empIdDropdown2.addEventListener('change', function () {
            inputTextAndSelectDelete();
        });

        inputTextAndSelectEdit();
        inputTextAndSelectDelete();

        addButton.addEventListener('click', function () {
         // Get the values of the input fields
         var empFname = empFnameInput.value.trim();
         var empMname = empMnameInput.value.trim();
         var empLname = empLnameInput.value.trim();
         var empType = empTypeInput.value.trim();
         var empAge = empAgeInput.value.trim();

        // Check if any of the required fields is empty
        if (empFname === '' || empMname === '' || empLname === '' || empType === '' || empAge === '') {
                // Show a popup message
                alert("Some inputs are empty. Please fill in all required fields.");
            } else {
                 // All required fields are filled, proceed with adding the data
                inputTextFromTable();
                window.location.reload();
             }
        });

        editOkButton.addEventListener('click', function () {
        // Call a function to handle the update when "OK" is clicked 
        // Get the values of the input fields
        var empFname = empFnameInput.value.trim();
        var empMname = empMnameInput.value.trim();
        var empLname = empLnameInput.value.trim();
        var empType = empTypeInput.value.trim();
        var empAge = empAgeInput.value.trim();

       // Check if any of the required fields is empty
       if (empFname === '' || empMname === '' || empLname === '' || empType === '' || empAge === '') {
               // Show a popup message
               alert("Some inputs are empty. Please fill in all required fields.");
           } else {
               updateEmployeeDetails();
               overlay.style.display = "none";
               editPopup.style.display = "none";
               window.location.reload(); 
           }
        });
        
        okDeleteButton.addEventListener('click', function () {
        deleteEmployeeDetails();
        overlay.style.display = "none";
        deletePopup.style.display = "none";
        window.location.reload();
        });
    });

    function getStatusText($equipStatus) {
        switch ($equipStatus) {
            case 1:
                return 'Active';
            case 2:
                return 'Inactive';
            case 0:
                return 'Retired';
            default:
                return 'Unknown';
        }
    } 
    function getStatusInt($equipStatus) {
        switch ($equipStatus) {
            case 'Active':
                return 1;
            case 'Inactive':
                return 2;
            case 'Retired':
                return 0;
            default:
                return -1; 
        }
    }

    function updateEmployeeDetails() {
        // Get the values from the input fields
        var empId = empIdDropdown1.value;
        var empFname = empFnameInput1.value;
        var empMname = empMnameInput1.value;
        var empLname = empLnameInput1.value;
        var empType = empTypeInput1.value;
        var empAge = empAgeInput1.value;
        var empSuffix = empSuffixInput1.value;
        var empGender = empGenderInput1.value;
        var empStatus = getStatusInt(empStatusInput1.value);
    
    if(empSuffix === null){
        empSuffix = " ";
    }
        // Use AJAX to send the updated data to the server
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    // Handle the response (if needed)
                    console.log(xhr.responseText);
                } else {
                    console.error('Failed to update employee details. Status:', xhr.status);
                }
            }
        };
    
        // Prepare the data to be sent as a JSON object
        var requestData = {
            emp_id: empId,
            emp_fname: empFname,
            emp_mname: empMname,
            emp_lname: empLname,
            emp_type: empType,
            emp_age: empAge,
            emp_suffix: empSuffix,
            emp_gender: empGender,
            emp_status: empStatus
        };
    
        // Convert the data to JSON format
        var jsonData = JSON.stringify(requestData);
    
        // Send a POST request to the server to update employee details
        xhr.open("POST", "action/update_employee.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.send(jsonData);
    } 


    function deleteEmployeeDetails(){
        var selectedEmpId = empIdDropdown2.value;

        // Use AJAX to send a request to delete employee data
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                var response = xhr.responseText;
                if (response === 'success') {
                    // Handle success (if needed)
                    console.log('Employee data deleted successfully.');
                } else {
                    // Handle failure
                    console.error('Failed to delete employee data:', response);
                }
            } else {
                console.error('Failed to delete employee data. Status:', xhr.status);
            }
        }
        };

        // Send a GET request to the server to delete employee data
        xhr.open('GET', 'action/delete_employee.php?emp_id=' + selectedEmpId, true);
        xhr.send();
    }