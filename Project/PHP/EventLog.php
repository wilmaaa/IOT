<?php
include 'GuestFunctions.php';

// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 15;

// Prepare the SQL statement and get records from our Item table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM `Event log` ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$Item = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of Item, this is so we can determine whether there should be a next and previous button
$num_Item = $pdo->query('SELECT COUNT(*) FROM `Event log`')->fetchColumn();
?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table_id td.y_n').each(function() {
            if ($(this).text() == 'Door Closed') {
                $(this).css('background-color', '#f00');
            }
            if ($(this).text() == 'Door Opened') {
                $(this).css('background-color', '#00FF00');
            }
        });
    });
</script>

<?= template_header('Sensor Status') ?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="content read container">
    <h2 class="text-center">Event Log</h2>
    <table id="table_id" class="table">
        <thead>
            <tr>
                <td>Id</td>
                <td>Sensor</td>
                <td class="y_n">ChangeMade</td>
                <td>Time</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Item as $Item) : ?>
                <tr>
                    <td><?= $Item['Id'] ?></td>
                    <td><?= $Item['Sensor'] ?></td>
                    <td class="y_n"><?= $Item['ChangeMade'] ?></td>
                    <td><?= $Item['Date'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php if ($page > 1) : ?>
            <a href="GuestItem.php?page=<?= $page - 1 ?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
        <?php endif; ?>
        <?php if ($page * $records_per_page < $num_Item) : ?>
            <a href="GuestItem.php?page=<?= $page + 1 ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
        <?php endif; ?>
    </div>
    <div class="text-center"> <a href="https://cs2s.yorkdc.net/~william.hill1/here/GuestItem.php" class="btn btn-primary center-block">Check current Overview</a>
    </div>
</div>

<?= template_footer() ?>