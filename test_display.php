<?php include "/var/www/inc/dbinfo.inc"; ?>
<html>
<body>
        <h1>Testing database connectivity<h1>

<?php
        $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if(mysqli_connect_errno()) echo "Failed to connect to database: " .mysqli_connect_error();
        else{
                echo "Connection successful ";
        }

        if ($connection->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "SELECT file_path FROM MEMES";
        $result = $connection->query($sql);
        
        if ($result->num_rows > 0) {
            echo "<table><tr><th>File path</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<img src='".$row["file_path"]."'>";
                echo "<tr><td>" . $row["file_path"]. "</td></tr>";
                
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        
        $conn->close(); 



?>


        
</body>
</html>