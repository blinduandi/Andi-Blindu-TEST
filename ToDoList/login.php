<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f7f7f7;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h2 class="text-center">Login</h2>
        <form id="loginForm">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        <div id="message" class="text-center mt-3"></div>
        <div class="text-center mt-3">
            Don't have an account? <a href="register.php">Register here</a>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const email = String(document.getElementById('email').value);
    const password = String(document.getElementById('password').value);

    fetch('http://localhost/todo%20api/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            entity: 'login',
            email: email,
            password: password
        })
    })
    .then(response => response.json())
    .then(data => {
        const messageDiv = document.getElementById('message');
        if (data.status === 'success') {
            messageDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
            sessionStorage.setItem('logged_in','logged');
            sessionStorage.setItem('username',data.user.name);
            sessionStorage.setItem('user_id',data.user.id);
            window.location.href = "http://localhost/todolist/dashboard.php";  
        } else {
            messageDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('message').innerHTML = `<div class="alert alert-danger">An error occurred</div>`;
    });
});

</script>

</body>
</html>
