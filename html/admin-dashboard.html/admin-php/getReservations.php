<?php
$con = mysqli_connect("localhost", "root", "root", "hotel");

$result = mysqli_query($con, "SELECT RoomID, Room_type, Price FROM rooms");
$data = $result->fetch_all(MYSQLI_ASSOC);
?>

<table border="1">
    <tr>
        <th>Room ID</th>
        <th>Room Type</th>
        <th>Price</th>
        <th>Book Now</th>
    </tr>
    <?php foreach ($data as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['RoomID']) ?></td>
            <td><?= htmlspecialchars($row['Room_type']) ?></td>
            <td><?= htmlspecialchars($row['Price']) ?></td>
            <td><button class="btn-book-now" data-room-id="<?= htmlspecialchars($row['RoomID']) ?>">Book Now</button></td>
        </tr>
    <?php endforeach ?>
</table>