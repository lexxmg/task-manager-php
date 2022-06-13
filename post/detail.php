<?php require $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php' ?>

<?php $messageId = $_GET['id'] ?? ''?>

<main class="detail-post">
  <h1 class="detail-post__title">Содержиние сообщения</h1>

  <pre>
      <?php var_dump(getMessage($messageId))?>
  </pre>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'?>
