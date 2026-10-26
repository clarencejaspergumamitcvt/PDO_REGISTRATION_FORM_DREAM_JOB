<?php
require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['insertBtn'])) {
    $firstName       = trim($_POST['first_name']);
    $lastName        = trim($_POST['last_name']);
    $email           = trim($_POST['email']);
    $dept            = trim($_POST['department_applied']);
    $education       = trim($_POST['highest_education']);
    $yearsExp        = intval($_POST['years_experience']);
    $salary          = floatval($_POST['expected_salary']);
    $notice          = intval($_POST['notice_period_days']);

    if (!empty($firstName) && !empty($lastName) && !empty($email)) {
        if (insertCorporateApplication($pdo, $firstName, $lastName, $email, $dept, $education, $yearsExp, $salary, $notice)) {
            header("Location: ../index.php");
            exit();
        }
    }
}

if (isset($_POST['editBtn'])) {
    $id              = intval($_POST['id']);
    $firstName       = trim($_POST['first_name']);
    $lastName        = trim($_POST['last_name']);
    $email           = trim($_POST['email']);
    $dept            = trim($_POST['department_applied']);
    $education       = trim($_POST['highest_education']);
    $yearsExp        = intval($_POST['years_experience']);
    $salary          = floatval($_POST['expected_salary']);
    $notice          = intval($_POST['notice_period_days']);
    $status          = trim($_POST['application_status']);

    if (!empty($id)) {
        if (updateCorporateApplication($pdo, $firstName, $lastName, $email, $dept, $education, $yearsExp, $salary, $notice, $status, $id)) {
            header("Location: ../index.php");
            exit();
        }
    }
}

if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    if (deleteCorporateApplication($pdo, $id)) {
        header("Location: ../index.php");
        exit();
    }
}
?>
