
<ul class="<?=$className?>">
    <?php foreach (arraySort($array, $key, $sort) as $key => $value): ?>
        <li>
          <a class="<?=($value['path'] === $_SERVER['REQUEST_URI']) ? 'active' : ''?>"
             href="<?=$value['path']?>"
          >
            <?php
                if ( mb_strlen($value['title']) > 15 ) {
                    echo cutString($value['title']);
                } else {
                    echo $value['title'];
                }
            ?>
          </a>
        </li>
    <?php endforeach; ?>
</ul>
