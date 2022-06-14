<?php require $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'?>

<?php
    $messageSections = getMessageSections();
    $allowedToWrite = getAllowedToWrite()
?>

<main class="add-post">
  <h1 class="add-post__title">Добавить запись</h1>

  <form class="add-post__form add-post-form" method="post">
      <label class="add-post-form__label">Добаьте заголовок:
          <input class="add-post-form__input" type="text" name="title" value="">
      </label>

      <label class="add-post-form__label">Введите текст сообщения:
          <textarea class="add-post-form__text" name="text"></textarea>
      </label>

      <label class="add-post-form__label">Выберете раздел:
          <select class="add-post-form__select" name="sections">
              <?php foreach ($messageSections as $key => $value): ?>
                  <option class="add-post-form__option"
                    value="<?=$value['id']?>"><?=$value['name']?>
                  </option>
              <?php endforeach; ?>
          </select>
      </label>

      <label class="add-post-form__label">Кому:
          <select class="add-post-form__select" name="userRecipient">
              <?php foreach ($allowedToWrite as $key => $value): ?>
                  <option class="add-post-form__option"
                    value="<?=$value['id']?>"><?=$value['user']?>
                  </option>
              <?php endforeach; ?>
          </select>
      </label>

      <button class="add-post-form__btn" name="sendPost">Отправить</button>
  </form>

  <pre>
      <?php var_dump( $_POST ?? '' )?>
  </pre>

  <pre>
      <?php var_dump( getAllowedToWrite() )?>
  </pre>

  <pre>
      <?php var_dump( getMessageSections() )?>
  </pre>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'?>
