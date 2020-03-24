<div class="container">
    <?php foreach ($blog as $key => $post) : ?>
        <h1 class="mb-3"><?= $post['blog_title'] ?></h1>
        <hr style="border-top: 3px solid black !important">
        <div id="blog_content">
            <?= htmlspecialchars_decode($post['blog_body'], ENT_HTML5) ?>
        </div>
    <?php endforeach; ?>
</div>