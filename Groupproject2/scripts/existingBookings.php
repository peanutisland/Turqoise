<?php
include('databaseConnection.php');
$loginAdmin = $_COOKIE['loginAdmin'];
$loginId = $_COOKIE['loginId'];

if ($loginAdmin == 1){
    $sql = "SELECT * FROM $appointmentsTable";
    $stmt = $conn->query($sql);
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $sql = "SELECT * FROM $appointmentsTable WHERE loginId = :loginId";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':loginId' => $loginId]);
    $bookings= $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    if (count($bookings) > 0) {
        echo '<table>';
        echo '<tr>';
        echo '<th>Name</th>';
        echo '<th>Phone</th>';
        echo '<th>Email</th>';
        echo '<th>Dentist</th>';
        echo '<th>Date</th>';
        echo '<th>Time</th>';
        echo '<th>Details</th>';
        if ($loginAdmin == 1) {
        echo '<th>Delete</th>';
        }
        echo '</tr>';

        foreach ($bookings as $row) {
            echo "<tr>";
            echo "<td>" . $row["dbname"] . "</td>";
            echo "<td>" . $row["dbphone"] . "</td>";
            echo "<td>" . $row["dbemail"] . "</td>";
            echo "<td>" . $row["dbdentist"] . "</td>";
            echo "<td>" . $row["dbdate"] . "</td>";
            echo "<td>" . $row["dbtime"] . "</td>";
            echo "<td>" . $row["dbdetails"] . "</td>";
            if ($loginAdmin == 1) {
                echo '<td>
                        <form method="post" action="scripts/delete.php">
                            <input type="hidden" name="id" value="' . $row['id'] . '">
                            <input type="submit" value="Delete" class="deleteBtn">
                        </form>
                    </td>';
            }
            echo "</tr>";
           
        } 
        echo "</table>";
    } else {
        echo "<p>No bookings found.<p>";
    }

?>