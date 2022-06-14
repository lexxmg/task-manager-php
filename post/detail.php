<?php require $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php' ?>

<?php
    $messageId = $_GET['id'] ?? '';

    $userMessage = getMessage($messageId);
    setMessageReading($messageId);
?>

<main class="detail-post">
  <h1 class="detail-post__title">Содержиние сообщения</h1>

  <pre>
      <?php var_dump($userMessage)?>
  </pre>

  <pre>
      <?php var_dump( getUser($userMessage['user_id_sender'])['name'] )?>
  </pre>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'?>
