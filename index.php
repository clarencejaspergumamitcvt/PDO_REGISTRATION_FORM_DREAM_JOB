<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';

$applications = getAllCorporateApplications($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Corporate Job Application Portal</title>
    <style>
        body { font-family: Segoe UI, Tahoma, Geneva, Verdana, sans-serif; margin: 30px; background-color: #f9f9f9; }
        h2 { color: #333; }
        form { background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-width: 550px; margin-bottom: 30px; }
        form div { margin-bottom: 12px; }
        label { display: inline-block; width: 180px; font-weight: bold; color: #555; }
        input, select { padding: 6px 10px; width: 250px; border: 1px solid #ccc; border-radius: 4px; }
        button { background-color: #0056b3; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #003d80; }
        table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
        th, td { border: 1px solid #e0e0e0; padding: 10px; text-align: left; }
        th { background-color: #0056b3; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .action-btns a { margin-right: 8px; text-decoration: none; color: #0056b3; font-weight: bold; }
        .action-btns a.delete { color: #d9534f; }
    </style>
</head>
<body>

    <h2>Corporate Job Application Form</h2>
    
    <form action="core/handleForms.php" method="POST">
        <div>
            <label>First Name:</label>
            <input type="text" name="first_name" required>
        </div>
        <div>
            <label>Last Name:</label>
            <input type="text" name="last_name" required>
        </div>
        <div>
            <label>Email Address:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Department:</label>
            <select name="department_applied" required>
                <option value="Finance & Accounting">Finance & Accounting</option>
                <option value="Human Resources">Human Resources</option>
                <option value="Operations & Strategy">Operations & Strategy</option>
                <option value="Corporate Marketing">Corporate Marketing</option>
                <option value="Legal & Compliance">Legal & Compliance</option>
            </select>
        </div>
        <div>
            <label>Highest Education:</label>
            <select name="highest_education" required>
                <option value="Bachelor's Degree">Bachelor's Degree</option>
                <option value="Master's Degree">Master's Degree</option>
                <option value="Doctorate / PhD">Doctorate / PhD</option>
                <option value="Associate Degree">Associate Degree</option>
            </select>
        </div>
        <div>
            <label>Years of Experience:</label>
            <input type="number" name="years_experience" min="0" required>
        </div>
        <div>
            <label>Expected Salary ($):</label>
            <input type="number" step="0.01" name="expected_salary" required>
        </div>
        <div>
            <label>Notice Period (Days):</label>
            <input type="number" name="notice_period_days" min="0" required>
        </div>
        <button type="submit" name="insertBtn">Submit Application</button>
    </form>

    <h2>Submitted Applications Table</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Education</th>
                <th>Exp (Yrs)</th>
                <th>Expected Salary</th>
                <th>Notice Period</th>
                <th>Status</th>
                <th>Date Applied</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($applications)): ?>
                <?php foreach ($applications as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['department_applied']) ?></td>
                        <td><?= htmlspecialchars($row['highest_education']) ?></td>
                        <td><?= htmlspecialchars($row['years_experience']) ?></td>
                        <td>$<?= number_format($row['expected_salary'], 2) ?></td>
                        <td><?= htmlspecialchars($row['notice_period_days']) ?> Days</td>
                        <td><?= htmlspecialchars($row['application_status']) ?></td>
                        <td><?= htmlspecialchars($row['date_added']) ?></td>
                        <td class="action-btns">
                            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                            <a href="core/handleForms.php?delete_id=<?= $row['id'] ?>" class="delete" onclick="return confirm('Are you sure you want to delete this applicant record?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="11">No applicants found in the database.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
