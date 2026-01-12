<?php
$host = "localhost";
$user = "root"; 
$pass = "";     
$dbname = "levender_bd"; 
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $comment = $conn->real_escape_string($_POST['comment']);
    if ($username != "" && $comment != "") {
        $sql = "INSERT INTO comments (username, comments) VALUES ('$username', '$comment')";
        $conn->query($sql);
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>صفحة التعليقات</title>
    <link rel="stylesheet" href="style.css">
        <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            direction: rtl;
            margin: 0;
            padding: 0;
            background-image: url("photo_2025-12-27_18-00-59.jpg");
             background-attachment: fixed;
            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
        }
       
    </style>
</head>
<body>
<div class="comments-page">  
    <h1 id="comtit">شارك رأيك</h1>

  
    <div class="comments-container">
    <form class="comment-form" method="POST" action="">
        <table>
            <tr>
                <td>
                    <label><strong>اسم المستخدم:</strong></label>
                </td>
                <td>
                    <input type="text" name="username" required><br><br>
                </td>
            </tr> 
            <tr>
                <td> 
                    <label><strong>التعليق:</strong></label>                 
                </td>
                <td>                    
                    <textarea name="comment" rows="4" cols="50" required></textarea><br><br>
                </td>
            </tr>  
            
        </table>
        <button type="submit" >إرسال التعليق</button>
    </form>
    <a id="linkhome" href="Home.html">الصفحة الرئسية</a>
    <hr>

    <h2>التعليقات السابقة:</h2>
        <?php
        
        $sql = "SELECT * FROM comments ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="comment">';
                echo "<strong>" . htmlspecialchars($row['username']) . ":</strong>";
                echo "<p>" . htmlspecialchars($row['comments']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>لا توجد تعليقات بعد. كن أول من يشارك!</p>";
        }

        $conn->close();
        ?>
    </div> 
</div> 
</body>
</html>
