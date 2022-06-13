<?php
    $isAllowedToWrite = false;

    foreach ($userGroups as $key => $value) {
        if ($value['name'] === 'is_allowed_to_write') {
            $isAllowedToWrite = true;
            break;
        }
    }

    $titleMessages = getTitleMessages($authUser['id']);
?>

<main class="posts">
  <h1 class="posts__title"><?=getTitle($menu)?></h1>

  <?php if (!$isAllowedToWrite): ?>
      <h2 class="posts__subtitle">Вы сможете отправлять сообщения после прохождения модерации</h2>
  <?php else: ?>
      <div class="posts__container">
          <div class="posts__column">
              <div class="posts__inner posts-inner">
                  <h3 class="posts-inner__title">Не прочитанные</h3>

                  <ul class="posts-inner__list posts-inner-list">
                      <?php foreach ($titleMessages as $key => $title): ?>
                          <?php if ($title['reading'] == 0): ?>
                              <li class="posts-inner-list__item">
                                  <a
                                      class="posts-inner-list__link"
                                      href="/post/detail.php?id=<?=$title['id']?>"
                                  ><?=$title['title'] . ' ' . $title['name']?>
                                  </a>
                              </li>
                          <?php endif; ?>
                      <?php endforeach; ?>
                  </ul>
              </div>

              <div class="posts__inner posts-inner">
                  <h3 class="posts-inner__title">Прочитанные</h3>

                  <ul class="posts-inner__list posts-inner-list">
                      <?php foreach ($titleMessages as $key => $title): ?>
                          <?php if ($title['reading'] == 1): ?>
                              <li class="posts-inner-list__item">
                                  <a
                                      class="posts-inner-list__link"
                                      href="/post/detail.php?id=<?=$title['id']?>"
                                  ><?=$title['title'] . ' ' . $title['name']?>
                                  </a>
                              </li>
                          <?php endif; ?>
                      <?php endforeach; ?>
                  </ul>
              </div>
          </div>

          <a class="posts-inner-list__btn" href="/post/add/">Написать сообщение</a>
      </div>
  <?php endif; ?>
</main>
