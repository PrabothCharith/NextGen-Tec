// function testing() {
//     let age = 18;
//     let name = 'Ashan'
//     let currentYear = 2025
//     let married = false
//     console.log();
// }

// function testing() {
//     let age = 10
//     let childrens = 5;

//     switch (age) {
//         case 10:
//             console.log("age is 10");

//             break;

//         default:
//             console.log("age is not 10");

//             break;
//     }

// }


function saveData() {
    let clientName = document.getElementById("client-name");
    let clientNamevalue = clientName.value;

    let clientAge = document.getElementById("client-age");
    let clientAgeValue = clientAge.value;

    // if (clientNamevalue == "" || clientAgeValue == "") {
    //     alert("Please Fill all fields")
    // } else if (clientAgeValue < 18) {
    //     alert("You are not meet our Requiremnts")
    // } else {
    //     alert("Welcome")
    // }

    if (clientNamevalue != "" && clientAgeValue != "") {
        clientAge.style.backgroundColor = ''
        clientName.style.backgroundColor = ''

        if (clientAgeValue > 18) {
            alert("Welcome")
        } else {
            alert("You are not meet our Requiremnts")
        }
    } else {
        if (clientNamevalue == "") {
            alert("Please Fill Your Name")
            clientName.style.backgroundColor = 'red'
        } else if (clientAgeValue == "") {
            clientName.style.backgroundColor = '';
            alert("Please Fill Your age")
            clientAge.style.backgroundColor = 'red'
        }
    }

}