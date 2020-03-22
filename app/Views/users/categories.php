<div class="container">
    <label for="categories" class=" font-weight-bolder">Create a new categories</label>
    <?= form_open() ?>
    <div class="form-row">
        <div class="col-md-10">
            <?php $cat_data = [
                'id'       =>   'categories',
                'class'    =>   'form-control',
                'name'     =>   'category',
                'placeholder' => 'Create a new categories'
            ]; ?>
            <?= form_input($cat_data) ?>
        </div>
        <div class="col-md-2">
            <?= form_button(['class' => 'btn btn-primary btn-block', 'content' => 'Create', 'id' => 'cat_update']) ?>
        </div>
    </div>
    <?= form_close() ?>
    <div class="card mt-4">
        <div class="card-body">
            <div id="categories_data">
                <?php $badge_class = ["badge-primary", "badge-secondary", "badge-success", "badge-danger", "badge-warning", "badge-info", "badge-dark"]; ?>
                <?php if (!empty($cat)) : ?>
                    <?php foreach ($cat as $key => $value) {
                        $single_badge = array_rand($badge_class, 1);
                        echo '<a class="m-2 text-capitalize text-wrap badge ' . $badge_class[$single_badge] . '" href="' . base_url() . '/category/' . $value['cat_name'] . '">' . $value['cat_name'] . '</a>';
                    } ?>
                <?php else : ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'No data',
                            text: "There is no category available",
                            footer: 'Create a category of your own'
                        });
                    </script>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $("#cat_update").on('click', function() {
            var csrf_name = "<?= csrf_token() ?>";
            var csrf_hash = $("[name=csrf_test_name]").val();

            var category = $("#categories").val();
            var cat_j_data = {
                "category_name": category
            }
            var xhr = $.ajax({
                url: "<?= base_url() ?>/users/cat_create",
                method: "POST",
                dataType: "json",
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                },
                data: {
                    [csrf_name]: csrf_hash,
                    "cat_data": JSON.stringify(cat_j_data)
                },
                success: function(data) {
                    if (data.msg == "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Created',
                            text: 'Your category has been created',
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else {
                        if (data.msg == "error") {
                            Swal.fire({
                                icon: 'error',
                                title: "Invalid Input",
                                text: data.category_name
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Already exists',
                                text: "The category already exsists"
                            });
                        }
                    }
                    var csrf = xhr.getResponseHeader("X-CSRF-TOKEN");
                    $("[name=csrf_test_name]").val(csrf);
                },
                error: function(err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "Something went wrong",
                        footer: '<a href>What went wrong?</a>'
                    });
                    var csrf = xhr.getResponseHeader("X-CSRF-TOKEN");
                    $("[name=csrf_test_name]").val(csrf);
                }
            });
        });
    </script>
</div>