
<?php
try {
    require_once "includes/dbc.inc.php";

    $query = "SELECT * FROM users;";

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $pdo = null;
    $stmt = null;

}   catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <a href="index.php">Home</a> |
    <a href="comments.php">Comments</a> |
    <a href="contact.php">Contact Us</a> |
    <a href="login.php">Logout</a><br /><br />



    <form action="includes/comments.inc.php" method="post">
        <select name="user">

        <?php foreach ($results as $row) : ?>
            <option value="<?= ($row['id']) ?>">
                           <?= ($row['username']) ?>
        <?php endforeach; ?>

        </select><br />
        <textarea name="comments"></textarea><br />
        <button>Submit</button>
    </form>

</body>

</html>
