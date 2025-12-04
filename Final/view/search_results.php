<?php if (empty($vehicles)): ?>
    <p>No results found.</p>
<?php else: ?>
    <h3>Search Results:</h3>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Color</th>
            <th>Price</th>
        </tr>
        <?php foreach ($vehicles as $vehicle): ?>
            <tr>
                <td><a href="index.php?action=view_detail&id=<?= $vehicle['id']; ?>"><?= $vehicle['name']; ?></a></td>
                <td><?= $vehicle['type']; ?></td>
                <td><?= $vehicle['color']; ?></td>
                <td><?= $vehicle['price']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
