<h1>Comments List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Description</th>
      <th>Record model</th>
      <th>Record</th>
      <th>User</th>
      <th>Dest user</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($comments as $comment): ?>
    <tr>
      <td><a href="<?php echo url_for('comment/edit?id='.$comment->getId()) ?>"><?php echo $comment->getId() ?></a></td>
      <td><?php echo $comment->getDescription() ?></td>
      <td><?php echo $comment->getRecordModel() ?></td>
      <td><?php echo $comment->getRecordId() ?></td>
      <td><?php echo $comment->getUserId() ?></td>
      <td><?php echo $comment->getDestUserId() ?></td>
      <td><?php echo $comment->getCreatedAt() ?></td>
      <td><?php echo $comment->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('comment/new') ?>">New</a>
