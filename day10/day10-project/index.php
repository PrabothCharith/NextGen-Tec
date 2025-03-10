<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Day 10</h1>

    <div>
        <h2>Output</h2>
        <button id="startBtn">Start</button>
        <p id="output"></p>
    </div>

    <input type="number" name="v1" id="v1">
    <input type="number" name="v2" id="v2">

    <script>
        document.getElementById('startBtn').addEventListener('click', function() {
            const output = document.getElementById('output');
            const v1 = document.getElementById('v1').value;
            const v2 = document.getElementById('v2').value;

            // GET request with XMLHttpRequest
            // const req = new XMLHttpRequest();
            // req.open("GET", "server.php?v1=13&v2=7", true);
            // req.onreadystatechange = function() {
            //     console.log(req.readyState);
            //     if (req.readyState == 4 && req.status == 200) {
            //         output.innerText = req.responseText;
            //     }
            // };
            // req.send();


            // GET request with fetch
            // fetch("server.php?v1=13&v2=5").then(function(response) {
            //     return response.text();
            // }).then(function(data) {
            //     output.innerText = data;
            // });


            // GET request with fetch and template literals
            // fetch("server.php?v1=" + v1 + "&v2=" + v2).then(function(response) {
            //     return response.text();
            // }).then(function(data) {
            //     output.innerText = data;
            // });


            // GET request with fetch and template literals
            // fetch(`server.php?v1=${v1}&v2=${v2}`).then(function(response) {
            //     return response.text();
            // }).then(function(data) {
            //     output.innerText = data;
            // });


            // POST request with XMLHttpRequest and FormData
            // const req = new XMLHttpRequest();
            // req.open("POST", "server.php", true);
            // const formData = new FormData();
            // formData.append('v1', v1);
            // formData.append('v2', v2);
            // req.onreadystatechange = function() {
            //     console.log(req.readyState);
            //     if (req.readyState == 4 && req.status == 200) {
            //         output.innerText = req.responseText;
            //     }
            // };
            // req.send(formData);


            // POST request with fetch and FormData
            // const formData = new FormData();
            // formData.append('v1', v1);
            // formData.append('v2', v2);
            // fetch("server.php", {
            //     method: 'POST',
            //     body: formData
            // }).then(function(response) {
            //     return response.text();
            // }).then(function(data) {
            //     output.innerText = data;
            // });


            // POST request with XMLHttpRequest and JSON
            // const data = {
            //     'v1': v1,
            //     'v2': v2
            // };
            // const req = new XMLHttpRequest();
            // req.open("POST", "server.php", true);
            // req.onreadystatechange = function() {
            //     console.log(req.readyState);
            //     if (req.readyState == 4 && req.status == 200) {
            //         output.innerText = req.responseText;
            //     }
            // };
            // req.send(JSON.stringify(data));


            // POST request with fetch and JSON
            // const data = {
            //     'v1': v1,
            //     'v2': v2
            // };
            // fetch("server.php", {
            //     method: 'POST',
            //     body: JSON.stringify(data),
            // }).then(function(response) {
            //     return response.text();
            // }).then(function(data) {
            //     output.innerText = data;
            // });


            // POST request with fetch and JSON and response with JSON
            const data = {
                'v1': v1,
                'v2': v2
            };
            fetch("server.php", {
                method: 'POST',
                body: JSON.stringify(data),
            }).then(function(response) {
                return response.json();
            }).then(function(data) {
                console.log(data);
                output.innerText = data.result;
            });
        });
    </script>

</body>

</html>