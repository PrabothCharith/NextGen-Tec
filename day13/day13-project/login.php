<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="./src/output.css">
</head>

<body>

    <div class="w-full min-h-screen flex items-center justify-center">

        <div class="w-full max-w-2xl bg-blue-50/30 p-5 shadow-md rounded-2xl">

            <h1 class="text-3xl text-center uppercase font-bold">Login</h1>

            <input id="login_email" type="text" placeholder="Email" class="w-full p-2 mt-5 border border-gray-300 rounded-md">

            <input id="login_password" type="password" placeholder="Password" class="w-full p-2 mt-5 border border-gray-300 rounded-md">

            <button class="w-full p-2 mt-5 bg-blue-500 text-white rounded-md hover:bg-blue-600" id="login_submit">Register</button>

        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#login_submit").click(function() {

                let email = $("#login_email").val();
                let password = $("#login_password").val();

                if (email == "" || password == "") {
                    alert("Please fill all fields");
                    return;
                }

                let data = {
                    type: 'login',
                    email: email,
                    password: password
                }

                fetch('server.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                }).then(async response => {
                    let data = await response.json();
                    if (response.ok && data.status === 'success') {
                        alert("Login successful");
                    } else {
                        console.log(data);
                        alert("Login failed: " + data.message);
                    }
                })

            });
        });
    </script>

</body>

</html>