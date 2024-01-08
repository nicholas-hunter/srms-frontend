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
             <img src="includes/img/jcflogo.png" alt="Logo" class="logo">
        </div>
        <form action="index.php" method="post" class="entry-form">
            <label for="regulationNumber">Regulation Number:</label>
            <input type="text" id="regulationNumber" name="regulationNumber" placeholder="Enter Reg Number" required>

            <label for="recordStatus">Select Record Status:</label>
            <select id="recordStatus" name="recordStatus" required>
                <option value="New">New</option>
                <option value="Amend">Amend</option>
                <option value="Archive">Archive</option>
            </select>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
