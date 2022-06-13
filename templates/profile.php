<main class="profile">
  <h1 class="profile__title"><?=getTitle($menu)?></h1>

  <p class="profile__text">Данные пользователя:</p>

  <ul class="profile__list profile-list">
      <li class="profile-list__item">
          <span class="profile-list__text">Ф. И. О.</span><?=$authUser['name']?>
      </li>
      <li class="profile-list__item">
          <span class="profile-list__text">email:</span><?=$authUser['email']?>
      </li>
      <li class="profile-list__item">
          <span class="profile-list__text">Телефон:</span><?=$authUser['tel']?>
      </li>
  </ul>

  <p class="profile__text">Группы пользователя:</p>

  <ul class="profile__list profile-list">
      <?php foreach ($userGroups as $key => $group): ?>
          <li class="profile-list__item">
              <span class="profile-list__text"><?=$group['name']?></span>(<?=$group['description']?>)
          </li>
      <?php endforeach; ?>
  </ul>
</main>
