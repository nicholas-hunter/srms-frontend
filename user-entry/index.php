<?php
$host = 'localhost:3307';
$db   = 'connect';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$message = '';
$fName = '';
$forenameTwo = '';
$surname = '';
$rankname = '';
$emailAddress = '';
$gender = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $regulationNumber = $_POST['regulationNumber'] ?? '';

    if ($_POST['recordStatus'] === 'New' && !empty($regulationNumber)) {
        $stmt = $pdo->prepare('SELECT * FROM srsmPersonnel WHERE regulationNumber = :regulationNumber');
        $stmt->execute(['regulationNumber' => $regulationNumber]);

        $record = $stmt->fetch();

        if ($record) {
            $message = 'Record found.';

            $fName = $record['fName'];
            $forenameTwo = $record['forenameTwo'];
            $surname = $record['surname'];
            $rankname = $record['rankname'];
            $emailAddress = $record['emailAddress'];
            $gender = $record['gender'];
        } else {
            $message = 'Record not found.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="includes/css/styles.css">
    <title>SRMS Entry Form</title>
</head>
<body>
    <div class="container">
        <div class="logo-placeholder">
            <!-- Logo will be placed here -->
            <img src="path-to-your-logo.png" alt="Logo" class="logo">
        </div>
        
        <?php if (!empty($message)): ?>
            <div class="message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="#" method="post" class="entry-form">
            <label for="fName">First Name:</label>
            <input type="text" id="fName" name="fName" value="<?php echo htmlspecialchars($fName); ?>" required>

            <label for="forenameTwo">Middle Name:</label>
            <input type="text" id="forenameTwo" name="forenameTwo" value="<?php echo htmlspecialchars($forenameTwo); ?>">

            <label for="surname">Last Name:</label>
            <input type="text" id="surname" name="surname" value="<?php echo htmlspecialchars($surname); ?>" required>

            <label for="rankname">Rank:</label>
            <input type="text" id="rankname" name="rankname" value="<?php echo htmlspecialchars($rankname); ?>">

            <label for="emailAddress">Email:</label>
            <input type="email" id="emailAddress" name="emailAddress" value="<?php echo htmlspecialchars($emailAddress); ?>">

            <label for="gender">Gender:</label>
            <select id="gender" name="gender">
                <option value="Male" <?php echo ($gender === 'Male') ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo ($gender === 'Female') ? 'selected' : ''; ?>>Female</option>
            </select>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
