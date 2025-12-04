<?php if (empty($vehicles)): ?>
    <p>No results found.</p>
<?php else: ?>
    <h3>Search Results:</h3>
    <table border="1">
        <tr>
            <th>Make</th>
            <th>Model</th>
            <th>Color</th>
            <th>Plate</th>
            <th>Status</th>
        </tr>
        <?php foreach ($vehicles as $vehicle): ?>
            <tr>
                <td><?= $vehicle['make']; ?></td>
                <td><?= $vehicle['model']; ?></td>
                <td><?= $vehicle['color']; ?></td>
                <td><?= $vehicle['plate']; ?></td>
                <td><?= $vehicle['status']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
