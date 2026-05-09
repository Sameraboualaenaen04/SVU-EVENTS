    <?php
    $conn = mysqli_connect("localhost", "root", "", "city_events");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    ?>