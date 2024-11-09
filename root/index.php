<?php
// Predefined users (email => password)
$users = [
    'user1-capiliryan@email.com' => 'ryan12345',
    'user2-capili123@email.com' => 'capili',
    'user3-bornel@email.com' => 'borne1',
    'user4-yanyan@email.com' => 'yanyan',
    'user5-johnloe@email.com' => 'johnloe',
];


$email = $password = '';
$emailErr = $passwordErr = '';
$errorDetails = [];
$loginError = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    if (empty($email)) {
        $emailErr = 'Email is required.';
        $errorDetails[] = $emailErr; 
    }

    
    if (empty($password)) {
        $passwordErr = 'Password is required.';
        $errorDetails[] = $passwordErr; 
    }

   
    if (empty($emailErr) && empty($passwordErr)) {
        
        if (array_key_exists($email, $users)) {
        
            if ($users[$email] !== $password) {
                $errorDetails[] = 'Password is incorrect.';
            }
        } else {
            $errorDetails[] = 'Email not found.';
        }
    }

   
    if (!empty($errorDetails)) {
        $loginError = 'System Errors:';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="w-100" style="max-width: 400px;">
            
            <?php if (!empty($loginError)): ?>
                <div id="error-box" class="alert alert-danger" role="alert">
                    <strong><?php echo $loginError; ?></strong>
                    <ul>
                        <?php foreach ($errorDetails as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Login</h3>
                    <form method="POST" id="login-form">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Enter email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>