<?php
require_once 'dbConfig.php';

function insertCorporateApplication($pdo, $first_name, $last_name, $email, $department_applied, $highest_education, $years_experience, $expected_salary, $notice_period_days) {
    $sql = "INSERT INTO corporate_applications (first_name, last_name, email, department_applied, highest_education, years_experience, expected_salary, notice_period_days) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$first_name, $last_name, $email, $department_applied, $highest_education, $years_experience, $expected_salary, $notice_period_days]);
}

function getAllCorporateApplications($pdo) {
    $sql = "SELECT * FROM corporate_applications ORDER BY date_added DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getCorporateApplicationByID($pdo, $id) {
    $sql = "SELECT * FROM corporate_applications WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function updateCorporateApplication($pdo, $first_name, $last_name, $email, $department_applied, $highest_education, $years_experience, $expected_salary, $notice_period_days, $application_status, $id) {
    $sql = "UPDATE corporate_applications 
            SET first_name = ?, last_name = ?, email = ?, department_applied = ?, highest_education = ?, years_experience = ?, expected_salary = ?, notice_period_days = ?, application_status = ?
            WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$first_name, $last_name, $email, $department_applied, $highest_education, $years_experience, $expected_salary, $notice_period_days, $application_status, $id]);
}

function deleteCorporateApplication($pdo, $id) {
    $sql = "DELETE FROM corporate_applications WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$id]);
}
?>
