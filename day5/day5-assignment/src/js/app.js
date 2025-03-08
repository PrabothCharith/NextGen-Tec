function submitForm() {
    let userFullName = document.getElementById("userFullName");
    let userFullNameValue = userFullName.value;

    let userEmail = document.getElementById("userEmail");
    let userEmailValue = userEmail.value;

    let userPassword = document.getElementById("userPassword");
    let userPasswordValue = userPassword.value;

    let userPasswordConfirm = document.getElementById("userPasswordConfirm");
    let userPasswordConfirmValue = userPasswordConfirm.value;

    let userGender = document.getElementById("userGender");
    let userGenderValue = userGender.value;

    let userCountry = document.getElementById("userCountry");
    let userCountryValue = userCountry.value;

    let termsAndConditions = document.getElementById("termsAndConditions");
    let termsAndConditionsValue = termsAndConditions.checked;

    userFullName.classList.remove("is-invalid");
    userEmail.classList.remove("is-invalid");
    userPassword.classList.remove("is-invalid");
    userPasswordConfirm.classList.remove("is-invalid");
    userGender.classList.remove("is-invalid");
    userCountry.classList.remove("is-invalid");
    termsAndConditions.classList.remove("is-invalid");

    if (
        userFullNameValue != "" &&
        userEmailValue != "" &&
        userPasswordValue != "" &&
        userPasswordConfirmValue != "" &&
        userGenderValue != "" && userGenderValue != "select" &&
        userCountryValue != "" && userCountryValue != "select" &&
        termsAndConditionsValue
    ) {
        if (userPasswordValue === userPasswordConfirmValue) {
            alert("Form submitted successfully");
            console.log("Full Name: ", userFullNameValue);
            console.log("Email: ", userEmailValue);
            console.log("Password: ", userPasswordValue);
            console.log("Password Confirm: ", userPasswordConfirmValue);
            console.log("Gender: ", userGenderValue);
            console.log("Country: ", userCountryValue);
            console.log("Terms and Conditions: ", termsAndConditionsValue);
        } else {
            userPassword.classList.add("is-invalid");
            userPasswordConfirm.classList.add("is-invalid");
            userPassword.focus();
            alert("Password does not match");
        }
    } else {
        if (userFullNameValue === "") {
            userFullName.classList.add("is-invalid");
            userFullName.focus();
            alert("Full Name is required");
        } else if (userEmailValue === "") {
            userEmail.classList.add("is-invalid");
            userEmail.focus();
            alert("Email is required");
        } else if (userPasswordValue === "") {
            userPassword.classList.add("is-invalid");
            userPassword.focus();
            alert("Password is required");
        } else if (userPasswordConfirmValue === "") {
            userPasswordConfirm.classList.add("is-invalid");
            userPasswordConfirm.focus();
            alert("Password confirm is required");
        } else if (userGenderValue === "" || userGenderValue === "select") {
            userGender.classList.add("is-invalid");
            userGender.focus();
            alert("Gender is required");
        } else if (userCountryValue === "" || userCountryValue === "select") {
            userCountry.classList.add("is-invalid");
            userCountry.focus();
            alert("Country is required");
        } else if (!termsAndConditionsValue) {
            termsAndConditions.classList.add("is-invalid");
            termsAndConditions.focus();
            alert("You must agree with terms and conditions");
        } else {
            userFullName.focus();
            alert("Please fill all the fields");
        }
    }
}