<?php

/*******************  Helper Functions *******************/
function clean($string)
{
    return htmlentities($string);
}

function redirect($location)
{
    return header("Location: {$location}");
}

function set_message($message)
{
    if (!empty($message)) {
        $_SESSION['message'] = $message;
    } else {
        $message = '';
    }
}

function display_message()
{
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

function token_generator()
{
    $token = $_SESSION['TOKEN'] = md5(uniqid(mt_rand(), true));
    return $token;
}


/*******************  Validation Functions *******************/

function validation_errors($error_message)
{
    $error_message =
        <<<DELIMITER
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Warning</strong> $error_message
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                DELIMITER;

    return $error_message;
}

function email_exists($email)
{
    $sql = "SELECT id FROM users WHERE email = '$email'";

    $result = query($sql);

    if (row_count($result) == 1) {
        return true;
    } else {
        return false;
    }
}

function username_exists($username)
{
    $sql = "SELECT id FROM users WHERE username = '$username'";

    $result = query($sql);

    if (row_count($result) == 1) {
        return true;
    } else {
        return false;
    }
}
function validate_user_registration()
{
    $errors = [];
    $min = 3;
    $max = 20;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first_name       = clean($_POST['first_name']);
        $last_name        = clean($_POST['last_name']);
        $username         = clean($_POST['username']);
        $email            = clean($_POST['email']);
        $password         = clean($_POST['password']);
        $confirm_password = clean($_POST['confirm_password']);
        $role             = $_POST['role'];

        // first name validation
        if (strlen($first_name) < $min) {
            $errors[] = "Your First name cannot be less than {$min} characters";
        }

        if (strlen($first_name) > $max) {
            $errors[] = "Your First name cannot be greater than {$max} characters";
        }

        // last name validation
        if (strlen($last_name) < $min) {
            $errors[] = "Your Last name cannot be less than {$min} characters";
        }

        if (strlen($last_name) > $max) {
            $errors[] = "Your Last name cannot be greater than {$max} characters";
        }

        // username validation
        if (strlen($username) < $min) {
            $errors[] = "Your Username cannot be less than {$min} characters";
        }

        if (strlen($username) > $max) {
            $errors[] = "Your Username cannot be greater than {$max} characters";
        }
        if (username_exists($username)) {
            $errors[] = "Sorry This Username is already taken!";
        }
        // email validation
        if (email_exists($email)) {
            $errors[] = "This Email is already registered!";
        }

        if (strlen($email) < $max) {
            $errors[] = "Your Email cannot be less than {$max} characters";
        }

        // password validation
        if ($password !== $confirm_password) {
            $errors[] = "Your Password fields does not match";
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo validation_errors($error);
            }
        } else {
            if (register_user($first_name, $last_name, $username, $email, $password, $role)) {
                set_message("<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>Success</strong> You have registered successfully!
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>");
                redirect("login.php");
            }
        }
    } //post request
} // function 

function register_user($first_name, $last_name, $username, $email, $password, $role)
{
    global $con;
    $first_name = escape($first_name);
    $last_name  = escape($last_name);
    $username   = escape($username);
    $email      = escape($email);
    $password   = escape($password);
    if (email_exists($email)) {
        return false;
    } else if (username_exists($username)) {
        return false;
    } else {
        $password_hash = md5($password);

        // to prevet SQL injections
        $sql = "INSERT INTO users(first_name, last_name, username, email, password, role) 
                VALUES(?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);

        mysqli_stmt_bind_param($stmt, "ssssss", $first_name, $last_name, $username, $email, $password_hash, $role);
        $result = mysqli_stmt_execute($stmt);

        confirm($result);

        return true;
    }
} // function 
/*******************  Validate user login *******************/

function validate_user_login()
{
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email    = clean($_POST['email']);
        $password = clean($_POST['password']);

        if (empty($email)) {
            $errors[] = 'Email field connot be empty!';
        }
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo validation_errors($error);
            }
        } else {
            if (login_user($email, $password) == 'admin') {
                redirect("admin/index.php");
            } else if (login_user($email, $password) == 'user') {
                redirect("index.php");
            } else {
                echo validation_errors("Your credentials are not correct!");
            }
        }
    }
}

/******************* login feature *******************/

function login_user($email, $password)
{
    $sql = "SELECT password, id, role FROM users WHERE email = '" . escape($email) . "'";
    $result = query($sql);
    if (row_count($result) == 1) {
        $row = fetch_array($result);
        $db_password = $row["password"];
        $db_role = $row["role"];
        if (md5($password) == $db_password && $db_role == '1') {
            $_SESSION["id"] = $row["id"];
            $_SESSION["role"] = $row["role"];
            return 'admin';
        } else if (md5($password) == $db_password && $db_role == '0') {
            $_SESSION["id"] = $row["id"];
            $_SESSION["role"] = $row["role"];
            return 'user';
        } else {
            return false;
        }
    } else {
        return false;
    }
} // function


/******************* logged in function *******************/

function logged_in()
{
    if (isset($_SESSION["id"])) {
        if (isset($_SESSION["role"]) && $_SESSION["role"] == '1') {
            return 'admin';
        } else {
            return 'user';
        }
    } else {
        return false;
    }
}
