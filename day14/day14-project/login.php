<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
</head>

<body>

    <div>
        <input id="username" type="text" placeholder="Username">
        <input id="password" type="password" placeholder="Password">
        <button id="login_btn">Login</button>
    </div>

    <script>
        document.getElementById('login_btn').addEventListener('click', function() {
            let username = document.getElementById('username').value;
            let password = document.getElementById('password').value;

            if (username && password) {

                let formdata = new FormData();
                formdata.append('username', username);
                formdata.append('password', password);
                formdata.append('action', 'login');

                fetch('server.php', {
                    method: 'POST',
                    body: formdata
                }).then(async response => {
                    let data = await response.json();
                    if (response.ok && data.status === 'success') {
                        alert("Login successful");
                    } else {
                        console.log(data);
                        alert("Login failed");
                    }
                })

            } else {
                alert("Please fill in all fields");
                return;
            }
        })
    </script>
</body>

</html>