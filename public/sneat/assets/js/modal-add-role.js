// Wait until the DOM is fully loaded
    document.addEventListener("DOMContentLoaded", function(e) {

      // Initialize form validation for the form with ID "addRoleForm"
      FormValidation.formValidation(
        document.getElementById("addRoleForm"), // The form element to be validated
        {
          // Define the fields to be validated
          fields: {
            modalRoleName: { // Field name
              validators: {
                notEmpty: { // Validator to check if the field is not empty
                  message: "Please enter role name" // Error message if the field is empty
                }
              }
            }
          },
          // Define the plugins used for validation
          plugins: {
            trigger: new FormValidation.plugins.Trigger(), // Automatically triggers validation
            bootstrap5: new FormValidation.plugins.Bootstrap5({
              eleValidClass: "", // Class applied to valid fields
              rowSelector: ".col-12" // Selector for the row containing the field
            }),
            submitButton: new FormValidation.plugins.SubmitButton(), // Controls the submit button state
            autoFocus: new FormValidation.plugins.AutoFocus() // Focuses on the first invalid field
          }
        }
      );

      // "Select All" checkbox functionality
      let selectAllCheckbox = document.querySelector("#selectAll"), // Select the "Select All" checkbox
        allCheckboxes = document.querySelectorAll('[type="checkbox"]'); // Select all checkboxes on the form

      // Add event listener to "Select All" checkbox
      selectAllCheckbox.addEventListener("change", function(event) {
        // Toggle the checked state of all checkboxes based on the "Select All" checkbox
        allCheckboxes.forEach(function(checkbox) {
          checkbox.checked = event.target.checked; // Set the checked state
        });
      });

    });