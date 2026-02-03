<?php
session_start();
ob_start();

// Hardcoded credentials as requested
$ADMIN_USER = 'ETAAM2026';
$ADMIN_PASS = 'etaam2026';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === $ADMIN_USER && $password === $ADMIN_PASS) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user_id'] = 999; // Dummy ID for hardcoded admin
        $_SESSION['admin_username'] = $ADMIN_USER;
        $_SESSION['admin_role'] = 'admin'; // Assume admin role
        
        header('Location: admin.php');
        exit;
    }

    require_once 'includes/db_connect.php';

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_user_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            $_SESSION['admin_role'] = $user['role'];
            $_SESSION['admin_permissions'] = $user['permissions']; // Store permissions
            
            header('Location: admin.php');
            exit;
        } else {
            header('Location: login.php?error=invalid');
            exit;
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
        header('Location: login.php?error=db');
        exit;
    }
}

// Handle error messages from GET request
if (isset($_GET['error'])) {
    if ($_GET['error'] === 'invalid') {
        $error = 'Identifiants incorrects.';
    } elseif ($_GET['error'] === 'db') {
        $error = 'Erreur de connexion.';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Administration | ETAAM</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png" />
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css" />

    <!-- Styles -->
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/notech.css" />
    <link rel="stylesheet" href="assets/css/custom-style.css" />
    
    <style>
        :root {
            --etaam-violet: #6A4C93;
            --etaam-turquoise: #00d2d3;
            --etaam-dark: #1a1a2e; /* Deep Dark Blue/Black */
        }

        body {
            background-color: var(--etaam-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Outfit', sans-serif;
            overflow: hidden;
            position: relative;
        }

        /* Animated Background */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at center, rgba(106, 76, 147, 0.2) 0%, rgba(26, 26, 46, 0) 60%);
            animation: rotateBg 20s linear infinite;
            z-index: 0;
            pointer-events: none;
        }

        @keyframes rotateBg {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .login-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 50px 40px;
            border-radius: 24px;
            width: 100%;
            max-width: 420px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 10;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-container {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-container img {
            max-height: 80px;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.2));
            transition: transform 0.3s ease;
        }
        
        .logo-container img:hover {
            transform: scale(1.05);
        }

        h4 {
            color: #fff;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
            letter-spacing: -0.5px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 10px;
            display: block;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 15px 20px;
            color: #fff;
            font-size: 16px;
            transition: all 0.3s ease;
            height: auto;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--etaam-turquoise);
            box-shadow: 0 0 0 4px rgba(0, 210, 211, 0.1);
            color: #fff;
        }
        
        .form-control::placeholder {
             color: rgba(255, 255, 255, 0.3);
        }

        .btn-login {
            background: linear-gradient(135deg, var(--etaam-violet) 0%, #5841e2 100%);
            color: #fff;
            padding: 16px;
            border-radius: 12px;
            width: 100%;
            font-weight: 700;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(106, 76, 147, 0.3);
            margin-top: 10px;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(106, 76, 147, 0.4);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            background: rgba(220, 53, 69, 0.15);
            border: 1px solid rgba(220, 53, 69, 0.3);
            color: #ff6b6b;
            border-radius: 10px;
            padding: 15px;
            font-size: 14px;
            backdrop-filter: blur(5px);
        }

        /* Decorative Elements */
        .circle-1, .circle-2 {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            z-index: 1;
            opacity: 0.5;
        }

        .circle-1 {
            width: 300px;
            height: 300px;
            background: var(--etaam-violet);
            top: 10%;
            left: 20%;
            animation: float 8s ease-in-out infinite;
        }

        .circle-2 {
            width: 250px;
            height: 250px;
            background: var(--etaam-turquoise);
            bottom: 15%;
            right: 20%;
            animation: float 10s ease-in-out infinite reverse;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-30px); }
            100% { transform: translateY(0px); }
        }

    </style>
</head>
<body>

    <div class="circle-1"></div>
    <div class="circle-2"></div>

    <div class="login-card">
        <div class="logo-container">
            <img src="assets/images/resources/logo-3.png" alt="ETAAM Logo">
        </div>
        
        <h4>Bienvenue</h4>
        
        <?php if ($error): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Nom d'utilisateur</label>
                <div class="input-group">
                     <span class="input-group-text" style="background:transparent; border:none; position:absolute; left:15px; top:50%; transform:translateY(-50%); z-index:10; color:var(--etaam-violet);">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" name="username" class="form-control" placeholder="Entrez votre identifiant" required style="padding-left: 45px;">
                </div>
            </div>
            
            <div class="form-group">
                <label>Mot de passe</label>
                <div class="input-group" style="position: relative;">
                    <span class="input-group-text" style="background:transparent; border:none; position:absolute; left:15px; top:50%; transform:translateY(-50%); z-index:10; color:var(--etaam-violet);">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" name="password" id="passwordField" class="form-control" placeholder="••••••••" required style="padding-left: 45px; padding-right: 45px;">
                    <span class="input-group-text" onclick="togglePassword()" style="background:transparent; border:none; position:absolute; right:15px; top:50%; transform:translateY(-50%); z-index:10; color:var(--etaam-violet); cursor: pointer;">
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </span>
                </div>
            </div>
            
            <script>
                function togglePassword() {
                    const passwordField = document.getElementById('passwordField');
                    const toggleIcon = document.getElementById('toggleIcon');
                    
                    if (passwordField.type === 'password') {
                        passwordField.type = 'text';
                        toggleIcon.classList.remove('fa-eye');
                        toggleIcon.classList.add('fa-eye-slash');
                    } else {
                        passwordField.type = 'password';
                        toggleIcon.classList.remove('fa-eye-slash');
                        toggleIcon.classList.add('fa-eye');
                    }
                }
            </script>
            
            <button type="submit" class="btn-login">
                Se connecter <i class="fas fa-arrow-right ms-2"></i>
            </button>
            
            <div style="text-align: center; margin-top: 20px;">
                <a href="index.php" style="color: rgba(255,255,255,0.5); text-decoration: none; font-size: 14px; transition: color 0.3s ease;">
                    <i class="fas fa-arrow-left me-1"></i> Retour à l'accueil
                </a>
            </div>
        </form>
    </div>

</body>
</html>
