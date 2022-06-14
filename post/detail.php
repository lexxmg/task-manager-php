<?php require $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php' ?>

<?php
    $messageId = $_GET['id'] ?? '';

    $userMessage = getMessage($messageId, $authUser['id']);
    setMessageReading($messageId);
?>

<main class="detail-post">
  <h1 class="detail-post__title">Содержиние сообщения</h1>

  <pre>
      <?php if ($userMessage): ?>
          <?php var_dump($userMessage)?>

          <?php var_dump( getUser($userMessage['user_id_sender'])['name'] )?>
      <?php else: ?>
          <span>сообщения не найдены</span>
      <?php endif; ?>
  </pre>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'?>
