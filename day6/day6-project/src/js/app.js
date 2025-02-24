// document.getElementById("client-age").addEventListener("mouseenter", function () {
//     if (isNaN(this.value)) {
//         this.value = ''
//     }
// });

// document.getElementById("client-age").addEventListener("mouseenter", function () {
//     console.log("Mouse Enter");
// });

// document.getElementById("client-age").addEventListener("mouseleave", function () {
//     console.log("Mouse Leave");
// });


function onload() {
    let firstArray = ["first item", "second item", "third item"]
    console.log(firstArray);

    // firstArray.push("test item")
    // console.log(firstArray);

    // firstArray.unshift("zero index")
    // console.log(firstArray);

    // firstArray.pop()
    // console.log(firstArray);

    // firstArray.shift();
    // console.log(firstArray);

    // console.log(firstArray.indexOf("first item"));

    // console.log(firstArray.slice(1, 3));

    // console.log(firstArray.filter(item => item == "second item"));


}

// onload();


let firstJson = [
    {
        "name": "John Doe",
        "email": "john@example.com",
        "parent_details": {
            "name": "dasun",
            "email": "dasun@gmail.com"
        }
    }, {
        "name": "Sahan",
        "email": "sahan@gmail.com"
    }
]

// let secondJson = '{"name": "Alice", "age": 25}';

function jsonTest() {
    // console.log(firstJson[0].parent_details.email);

    // if (firstJson[0].parent_details.test) {
    //     console.log("test is found");
    // } else {
    //     console.log("test isn't found");
    // }

    // console.log(secondJson);
    // console.log(JSON.parse(secondJson));

    // console.log(firstJson);
    // console.log(JSON.stringify(firstJson));

}

// jsonTest();


$(document).ready(function () {
    $("#btnId").click(function () {
        $("#textId").hide();
    });

    $("#btnId").click(function () {
        $(".textClass").hide();
    })
});