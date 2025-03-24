<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User registration</title>
</head>

<body>

    <form action="server.php" method="POST">
        <input name="username" type="text" placeholder="Username" required>
        <input name="password" type="password" placeholder="Password" required>
        <input type="hidden" name="action" value="register">
        <button type="submit">Register</button>
    </form>

    <!-- <script>
        document.getElementById('register_btn').addEventListener('click', function() {
            let username = document.getElementById('username').value;
            let password = document.getElementById('password').value;

            if (username && password) {

                let formdata = new FormData();
                formdata.append('username', username);
                formdata.append('password', password);
                formdata.append('action', 'register');

                fetch('server.php', {
                    method: 'POST',
                    body: formdata
                }).then(async response => {
                    let data = await response.json();
                    if (response.ok && data.status === 'success') {
                        alert("Registration successful");
                    } else {
                        console.log(data);
                        alert("Registration failed");
                    }
                })

            } else {
                alert("Please fill in all fields");
                return;
            }
        })
    </script> -->
</body>

</html>