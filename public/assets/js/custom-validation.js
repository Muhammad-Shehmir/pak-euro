// alphabets format

$(document).ready(function () {
    // Listen for input events on the name input field
    $('.name-validate').on('input', function () {
        // Get the user's input
        var name = $(this).val();
        // Regular expression to match numbers
        var numbersPattern = /[0-9]/;

        // Check if the input contains numbers
        if (name.match(numbersPattern)) {
            // If it contains numbers, show the validation message
            $('.validation-name').show();
            $('#submitBtn').prop('disabled', true);
        } else {
            // If it doesn't contain numbers, hide the validation message
            $('.validation-name').hide();
            $('#submitBtn').prop('disabled', false);

        }
    });
});

$(document).ready(function () {
    // Listen for input events on the name input field
    $('.admin-name-validate').on('input', function () {
        // Get the user's input
        var name = $(this).val();
        // Regular expression to match numbers
        var numbersPattern = /[0-9]/;

        // Check if the input contains numbers
        if (name.match(numbersPattern)) {
            // If it contains numbers, show the validation message
            $('.validation-name-admin').show();
            $('#submitBtn').prop('disabled', true);
        } else {
            // If it doesn't contain numbers, hide the validation message
            $('.validation-name-admin').hide();
            $('#submitBtn').prop('disabled', false);

        }
    });
});

// email format

$(document).ready(function () {
    // Listen for input events on the email input field
    $('.email-validate').on('input', function () {
        // Get the user's input
        var email = $(this).val();

        // Regular expression to match a valid email address
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

        // Check if the input matches the email pattern
        if (!email.match(emailPattern)) {
            // If it doesn't match, show the validation message
            $('.validation-email').show();
            $('#submitBtn').prop('disabled', true);
        } else {
            // If it matches, hide the validation message
            $('.validation-email').hide();
            $('#submitBtn').prop('disabled', false);
        }
    });
});



// number format

$(document).ready(function () {
    // Listen for input events on the number input field
    $('.number-validate').on('input', function () {
        // Get the user's input
        var number = $(this).val();
        // Regular expression to match alphabets
        var alphabetsPattern = /[a-z,A-Z]/;

        // Check if the input contains alphabets
        if (number.match(alphabetsPattern)) {
            // If it contains alphabets, show the validation message
            $('.validation-number').show();
            $('#submitBtn').prop('disabled', true);

        } else {
            // If it doesn't contain alphabets, hide the validation message
            $('.validation-number').hide();
            $('#submitBtn').prop('disabled', false);

        }
    });
});

//age validation
$(document).ready(function () {
    // Listen for input events on the number input field
    $('.age-validate').on('input', function () {
        // Get the user's input
        var age = $(this).val();
        // Check if the input is a number
        if (!isNaN(age)) {
            // If it's a number, check if it's less than or equal to 100
            if (parseInt(age) <= 100 && parseInt(age) >= 1) {
                // If it's a valid age (1-100), hide the validation message and enable the submit button
                $('.validation-age').hide();
                $('#submitBtn').prop('disabled', false);
            } else {
                // If it's not a valid age, show the validation message and disable the submit button
                $('.validation-age').show();
                $('#submitBtn').prop('disabled', true);
            }
        } else {
            // If it's not a age, show the validation message and disable the submit button
            $('.validation-age').show();
            $('#submitBtn').prop('disabled', true);
        }
    });
});



//whtp number format

$(document).ready(function () {
    // Listen for input events on the number input field
    $('.whtp-number-validate').on('input', function () {
        // Get the user's input
        var number = $(this).val();
        // Regular expression to match alphabets
        var whtpnumberPattern = /[a-z,A-Z]/;

        // Check if the input contains whtp-number-
        if (number.match(whtpnumberPattern)) {
            // If it contains alphabets, show the validation message
            $('.validation-whtp-number').show();
            $('#submitBtn').prop('disabled', true);

        } else {
            // If it doesn't contain alphabets, hide the validation message
            $('.validation-whtp-number').hide();
            $('#submitBtn').prop('disabled', false);

        }
    });
});

//password format
$(document).ready(function () {
    // Listen for input events on the password input field
    $('.password-validate').on('input', function () {
        // Get the user's input
        var password = $(this).val();

        // Define regular expressions for each requirement
        var hasNumber = /[0-9]/.test(password);
        var hasCapitalLetter = /[A-Z]/.test(password);
        var hasSpecialCharacter = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password);
        var hasLowerCaseLetter = /[a-z]/.test(password);

        // Check if all requirements are met
        if (
            password.length >= 8 &&
            hasNumber &&
            hasCapitalLetter &&
            hasSpecialCharacter &&
            hasLowerCaseLetter
        ) {
            // If all conditions are met, hide the validation message
            $('.validation-password').hide();
            $('#submitBtn').prop('disabled', false);
        } else {
            // If any condition is not met, show the validation message
            $('.validation-password').show();
            $('#submitBtn').prop('disabled', true);
        }
    });
});



// DoB format
$(document).ready(function () {
    // Listen for input events on the date of birth input field
    $('.dob-validate').on('input', function () {
        // Get the user's input
        var dob = $(this).val();

        // Regular expression to match a date in the format "YYYY-MM-DD"
        var dobPattern = /^\d{4}-\d{2}-\d{2}$/;

        // Check if the input matches the date pattern
        if (dob.match(dobPattern)) {
            // Parse the input as a date
            var dobDate = new Date(dob);

            // Get the current date without the time
            var currentDate = new Date();
            currentDate.setHours(0, 0, 0, 0);

            // Check if the date of birth is before or on the current date
            if (dobDate <= currentDate) {
                // If it's a valid date of birth, hide the validation message
                $('.validation-dob').hide();
                $('#submitBtn').prop('disabled', false);
            } else {
                // If it's in the future, show the validation message
                $('.validation-dob').show();
                $('#submitBtn').prop('disabled', true);
            }
        }

    });
});



// //delete
// $(document).ready(function () {
//     // Capture the click event on the "Yes" button in the modal
//     $('#confirmDelete').on('click', function () {
//         var id = $(this).data('id'); // Get the ID of the record to be deleted

//         // Perform the delete action (you can use AJAX here if needed)
//         $.ajax({
//             url: '/delete/' + id, // Replace with your delete route
//             type: 'DELETE', // Use DELETE HTTP method
//             success: function (data) {
//                 // Handle success (e.g., show a success message)
//                 alert('Record deleted successfully!');
//                 // Redirect to a new page or update the UI as needed
//                 window.location.reload();
//             },
//             error: function () {
//                 // Handle error (e.g., show an error message)
//                 alert('Something went wrong!');
//             }
//         });

//         // Close the modal after the action is performed
//         $('#deleteModal').modal('hide');
//     });
// });


