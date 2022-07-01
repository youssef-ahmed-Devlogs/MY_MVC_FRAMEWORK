<h1>Employee Page</h1>

<?php if (isset($_SESSION['success_message'])) : ?>

    <div class="alert alert-success">
        <?= $_SESSION['success_message'] ?>
    </div>

<?php endif ?>

<ul>
    <li>ID: <?= $id ?> </li>
    <li>Name: <?= $name ?> </li>
    <li>Age: <?= $age ?> </li>
    <li>Country: <?= $country ?> </li>
</ul>