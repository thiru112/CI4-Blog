<div class="container">
  <?php
  $blog = $posts;
  $blog_cat = $categories;
  $blogs_chunk = array_chunk($blog, 2);
  $badge_class = ["badge-primary", "badge-secondary", "badge-success", "badge-danger", "badge-warning", "badge-info", "badge-dark"];
  ?>
  <?php if ($blog === null) : ?>
    <div class="row mb-2">
      <h2>No blogs are present </h2>
    </div>
  <?php else : ?>
    <?php foreach ($blogs_chunk as $key => $items) : ?>
      <div class="row mb-2">
        <?php foreach ($items as $key => $value) : ?>
          <div class="col-md-6">
            <div class="card mb-3">
              <div class="row no-gutters border rounded overflow-hidden flex-md-row">
                  <div class="card-body">
                    <?php $temp_array = $blog_cat[$value['blog_id']]; ?>
                    <?php foreach ($temp_array as $key => $catg) : ?>
                      <?php $single_badge = array_rand($badge_class, 1); ?>
                      <a href="/category/<?= $catg ?>" class="d-inline-block mb-2 badge <?=$badge_class[$single_badge]?>"><?= $catg ?></a>
                    <?php endforeach; ?>
                    <h2 class="card-title mb-0"><?= $value['blog_title'] ?></h2>
                    <p class="card-text mb-1"><small class="text-muted"><?=$value['blog_created_time'] ?></small></p>
                    <p class="card-text"><?= strip_tags(htmlspecialchars_decode(word_limiter($value['blog_body'], 19)), ENT_HTML5)?></p>
                    <a href="/posts/<?= $value['blog_id'] ?>" class="stretched-link">Continue reading</a>
                  </div>
                </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>
