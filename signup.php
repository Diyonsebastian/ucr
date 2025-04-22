<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Login Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #1e1e2e, #2a2a3e);
            animation: backgroundAnimation 10s infinite alternate;
        }
        @keyframes backgroundAnimation {
            0% { background: linear-gradient(135deg, #1e1e2e, #2a2a3e); }
            100% { background: linear-gradient(135deg, #3e1e68, #1b1b2f); }
        }
        .login-container {
            background: rgba(255, 255, 255, 0.15);
            padding: 25px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            text-align: center;
            width: 350px;
            backdrop-filter: blur(15px);
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #fff;
            font-size: 24px;
            animation: glow 1.5s infinite alternate;
        }
        @keyframes glow {
            0% { text-shadow: 0 0 10px #fff; }
            100% { text-shadow: 0 0 20px #ff6b6b; }
        }
        .input-group {
            margin-bottom: 15px;
            position: relative;
        }
        .input-group input {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            outline: none;
            font-size: 16px;
            transition: 0.3s;
        }
        .input-group input:focus {
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.7);
            transform: scale(1.05);
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #ddd;
            transition: 0.3s;
        }
        .toggle-password:hover {
            color: #ffeb3b;
        }
        .login-btn {
            width: 100%;
            padding: 12px;
            background: #ff6b6b;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
            animation: pulse 1.5s infinite;
        }
        .login-btn:hover {
            background: #ff4757;
            transform: scale(1.05);
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 10px rgba(255, 107, 107, 0.5); }
            100% { box-shadow: 0 0 20px rgba(255, 107, 107, 0.8); }
        }
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #fff;
            margin-bottom: 15px;
        }
        .remember-forgot a {
            color: #fff;
            text-decoration: none;
        }
        .remember-forgot a:hover {
            text-decoration: underline;
        }
        .signup-link {
            margin-top: 15px;
            font-size: 14px;
            color: #fff;
        }
        .signup-link a {
            color: #ffeb3b;
            text-decoration: none;
        }
        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container"> 
        <h2>Sign Up</h2>
        <form action="sign2.php" method="post">
            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <input type="text" name="email" placeholder="Email ID" required>
            </div>
            <div class="input-group">
                <input type="text" name="phone" placeholder="Phone" required>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <span class="toggle-password" onclick="togglePassword()">👁️</span>
            </div>
            <button class="login-btn" type="submit">Sign Up</button>
        </form>
        <div class="signup-link">
            Already have an account? <a href="login.php">Login</a>
        </div>
    </div>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            passwordField.type = passwordField.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>
