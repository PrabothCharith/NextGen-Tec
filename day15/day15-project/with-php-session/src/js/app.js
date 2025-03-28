$(document).ready(function () {

    $("#register").click(function () {

        let email = $("#email").val();
        let password = $("#password").val();

        // t = type and r = register
        fetch("http://localhost/final-project/api/auth.php?t=r", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                email: email,
                password: password
            })
        }).then((response) => {
            return response.json();
        }).then((data) => {
            console.log(data);
        });

    });

    $("#login").click(function () {

        let email = $("#email").val();
        let password = $("#password").val();

        // t = type and l = login
        fetch("http://localhost/final-project/api/auth.php?t=l", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                email: email,
                password: password
            })
        }).then((response) => {
            return response.json();
        }).then((data) => {
            console.log(data);
        });

    });

});