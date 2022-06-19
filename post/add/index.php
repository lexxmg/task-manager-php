<?php require $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'?>

<?php
    $titleMesages = htmlspecialchars($_POST['title'] ?? '');
    $textMesages = htmlspecialchars($_POST['text'] ?? '');
    $sectionsMesages = htmlspecialchars($_POST['sections'] ?? '');
    $userRecipientMesages = htmlspecialchars($_POST['userRecipient'] ?? '');

    $messageSections = getMessageSections();
    $allowedToWrite = getAllowedToWrite();

    if (isset($_POST['sendPost'])) {
        if ($titleMesages && $textMesages && $sectionsMesages && $userRecipientMesages) {

            if ( addMessage($authUser['id'], $userRecipientMesages, $titleMesages, $textMesages, $sectionsMesages) ) {
                $success = true;
            } else {
                $error = 'Ошибка базы данных, повторите попытку позже';
            }
        } else {
            $error = 'Все поля должны быть заполнены!';
        }
    }
?>

<main class="add-post">
  <h1 class="add-post__title">Добавить запись</h1>

  <form class="add-post__form add-post-form" method="post">
      <label class="add-post-form__label">Добаьте заголовок:
          <input class="add-post-form__input" type="text" name="title" value="<?=$titleMesages?>">
      </label>

      <label class="add-post-form__label">Введите текст сообщения:
          <textarea class="add-post-form__text" name="text"><?=$textMesages?></textarea>
      </label>

      <label class="add-post-form__label">Выберете раздел:
          <select class="add-post-form__select" name="sections">
              <option class="add-post-form__option"
                value="">Рздел не выбран
              </option>

              <?php foreach ($messageSections as $key => $value): ?>
                  <?php if ($value['id'] === $sectionsMesages): ?>
                      <option class="add-post-form__option"
                        value="<?=$value['id']?>"
                        selected
                        >
                        <?=$value['name']?>
                      </option>
                  <?php else: ?>
                      <option class="add-post-form__option"
                        value="<?=$value['id']?>"><?=$value['name']?>
                      </option>
                  <?php endif; ?>
              <?php endforeach; ?>
          </select>
      </label>

      <label class="add-post-form__label">Кому:
          <select class="add-post-form__select" name="userRecipient">
              <option class="add-post-form__option"
                value="">Пользователь не выбран
              </option>

              <?php foreach ($allowedToWrite as $key => $value): ?>
                  <?php if ($value['id'] !== $authUser['id']): ?>
                      <?php if ($value['id'] === $userRecipientMesages): ?>
                          <option class="add-post-form__option"
                            value="<?=$value['id']?>"
                            selected
                            >
                            <?=$value['user']?>
                          </option>
                      <?php else: ?>
                          <option class="add-post-form__option"
                            value="<?=$value['id']?>"><?=$value['user']?>
                          </option>
                      <?php endif; ?>
                  <?php endif; ?>
              <?php endforeach; ?>
          </select>
      </label>

      <?php if ($error): ?>
          <span class="text-error"><?=$error?></span>
      <?php endif; ?>

      <?php if ($success): ?>
          <span class="text-success">Сообщение отправлено!</span>
      <?php endif ?>


      <button class="add-post-form__btn" name="sendPost">Отправить</button>
  </form>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'?>
