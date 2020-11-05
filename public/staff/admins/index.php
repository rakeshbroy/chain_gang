<?php require_once('../../../private/initialize.php') ?>

<?php

require_login();

// find all admins
// $admins = Admin::find_all();

$current_page = $_GET['page'] ?? 1;
$per_page = 5;
$total_count = Admin::count_all();

// Find all admins;
// use pegination instead
// $admins = Admin::find_all();
$pagination = new Pagination($current_page, $per_page, $total_count);

$sql = "select * from admins   ";
$sql .= "limit {$per_page} ";
$sql .= "offset {$pagination->offset()}";

$admins = Admin::find_by_sql($sql);

?>

<?php $page_title = "Admins"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="admins listing">
    <h2>Admins</h2>
    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/admins/new.php'); ?>">Add Admin</a>
    </div>
    <table class="list">
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Username</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php foreach($admins as $admin) { ?>
        <tr>
          <td><?php echo h($admin->id); ?></td>
          <td><?php echo h($admin->first_name); ?></td>
          <td><?php echo h($admin->last_name); ?></td>
          <td><?php echo h($admin->email); ?></td>
          <td><?php echo h($admin->username); ?></td>
          <td><a class="action" href="<?php echo url_for('/staff/admins/show.php?id=' . h(u($admin->id))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/admins/edit.php?id=' . h(u($admin->id))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin->id))); ?>">Delete</a></td>
        </tr>
      <?php } ?>
    </table>

    <?php

    echo $pagination->page_links();

    ?>

  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
