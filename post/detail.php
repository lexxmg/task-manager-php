<?php require $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php' ?>

<?php
    $messageId = $_GET['id'] ?? '';

    $userMessage = getMessage($messageId, $authUser['id']);
    $userSender = [];

    if ($userMessage) {
        $userSender = getUser($userMessage['sender_id']);
    }

    setMessageReading($messageId);
?>

<main class="detail-post">
  <h1 class="detail-post__title">Содержиние сообщения</h1>

  <div class="detail-post__container detail-post-container">
      <?php if ($userMessage): ?>
          <div class="detail-post-container__top detail-post-container-top">
              <h2 class="detail-post-container-top__title"><?=$userMessage['title']?></h2>

              <time class="detail-post-container-top__time"><?=$userMessage['date']?></time>
          </div>

          <div class="detail-post-container__body detail-post-container-body">
              <div class="detail-post-container-body__top detail-post-container-body-top">
                  <span class="detail-post-container-body-top__text">Отправитель:</span>

                  <div class="detail-post-container-body-top__inner">
                      <span class="detail-post-container-body-top__name"><?=$userSender['name']?></span>
                      <span class="detail-post-container-body-top__email"><?=$userSender['email']?></span>
                  </div>
              </div>

              <p class="detail-post-container-body__text"><?=$userMessage['text']?></p>
          </div>
      <?php else: ?>
          <span class="detail-post-container__err">Cообщения не найдены</span>

          <?php header("HTTP/1.0 404 Not Found")?>
      <?php endif; ?>

      <a href="/route/posts/" class="detail-post-container__btn">Вернуться к списку сообщений</a>
  </div>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'?>
