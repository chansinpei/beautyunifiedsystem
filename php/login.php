<?php
header('Content-Type: application/json');
session_start(); // <-- add this at the top

include 'db.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    echo json_encode(['status'=>'error','message'=>'Invalid request']);
    exit;
}

// Get POST data
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? ''; // role from login.html

// Check if user exists
$stmt = $conn->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows !== 1){
    echo json_encode(['status'=>'error','message'=>'User not found']);
    exit;
}

$user = $result->fetch_assoc();

// Verify password
if(!password_verify($password, $user['password'])){
    echo json_encode(['status'=>'error','message'=>'Invalid password']);
    exit;
}

// Role-based login
if($role === 'admin'){
    if($user['role'] !== 'admin'){
        echo json_encode(['status'=>'error','message'=>'Access denied. Admins only.']);
        exit;
    }

    // ✅ Set session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = 'admin';

    echo json_encode([
        'status'=>'success',
        'role'=>'admin',
        'username'=>$user['username']
    ]);
    exit;
}

if($role === 'staff'){
    if($user['role'] !== 'staff'){
        echo json_encode(['status'=>'error','message'=>'Access denied. Staff only.']);
        exit;
    }

    if(strtolower($user['status']) !== 'approved'){
        echo json_encode([
            'status'=>'pending',
            'message'=>'Your account is pending admin approval.'
        ]);
        exit;
    }

    // ✅ Set session for staff
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = 'staff';

    echo json_encode([
        'status'=>'success',
        'role'=>'staff',
        'username'=>$user['username']
    ]);
    exit;
}

// Fallback
echo json_encode(['status'=>'error','message'=>'Unauthorized role']);
?>
