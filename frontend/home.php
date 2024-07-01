<!DOCTYPE html>
<?php 
require '../API/conn.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('location:../index.html');
    exit; // Ensure script stops if user is not logged in
}

$id = $_SESSION['user'];
$sql = $conn->prepare("SELECT firstname, lastname FROM `member` WHERE `mem_id`='$id'");
$sql->execute();
$fetch = $sql->fetch();
$firstname = $fetch['firstname'];
$lastname = $fetch['lastname'];
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Dashboard</title>
    <link rel="stylesheet" href="dashboardStyle.css">
    <script src="https://unpkg.com/react/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/babel-standalone/babel.min.js"></script>
</head>
<body>

<div class="background"></div>
<div id="app"></div>

<script type="text/babel">
    var firstName = "<?php echo $firstname; ?>";
    var lastName = "<?php echo $lastname; ?>";

    // Render the React component with props
    ReactDOM.render(
        <App firstName={firstName} lastName={lastName} />,
        document.getElementById("app")
    );
</script>
<script type="text/babel" src="../API/app.php" defer></script>

</body>
</html>
