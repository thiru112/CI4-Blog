<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group" id="List">
                <div class="text-center">
                    <svg class="list-group-item list-group-item-action bd-placeholder-img rounded" width="200" height="200" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 200x200">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">200x200</text>
                    </svg>
                </div>
                <button type="button" class="list-group-item list-group-item-action h5 active" data-toggle="list" href="#settings">Your Posts</button>
                <button type="button" class="list-group-item list-group-item-action h5" href="#profile_card" data-toggle="list">Profile</button>
                <button type="button" class="list-group-item list-group-item-action h5" data-toggle="list" href="#change_pass">Edit Password</button>
                <button type="button" class="list-group-item list-group-item-action h5" data-toggle="list" href="#stats">Stats</button>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane" id="profile_card" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div id="profile_card">
                                <?= form_open('users/profile/update') ?>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="first_name">First Name</label>
                                        <?php $fname_data = [
                                            'id'       =>   'first_name',
                                            'class'    =>   'form-control',
                                            'name'     =>   'fname'
                                        ]; ?>
                                        <?= form_input($fname_data) ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="last_name">Last Name</label>
                                        <?php $lname_data = [
                                            'id'       =>   'last_name',
                                            'class'    =>   'form-control',
                                            'name'     =>   'lname'
                                        ]; ?>
                                        <?= form_input($lname_data) ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bio">Bio</label>
                                    <textarea name="bio" class="form-control" id="bio" rows="3"></textarea>
                                </div>
                                <?= form_button(['class' => 'btn btn-primary', 'content' => 'Update', 'id' => 'profile_update']) ?>
                                <?= form_close() ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="change_pass" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <?= form_open('users/pass_change') ?>
                            <div class="form-row align-items-center">
                                <div class="col-4">
                                    <label for="">Old Password:</label>
                                    <?= form_password(['class' => 'form-control mb-2', 'name' => 'old_pass']) ?>
                                </div>
                                <div class="col-4">
                                    <label for="">New Password:</label>
                                    <?= form_password(['class' => 'form-control mb-2', 'name' => 'pass1']) ?>
                                </div>
                                <div class="col-4">
                                    <label for="">Retype new password</label>
                                    <?= form_password(['class' => 'form-control mb-2', 'name' => 'pass2']) ?>
                                </div>
                            </div>
                            <?= form_submit(['class' => 'btn btn-danger', 'value' => 'Update']) ?>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="stats" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
                            <canvas id="post_stats" width="200" height="200"></canvas>
                            <script>
                                var ctx = document.getElementById("post_stats");
                                var chart = new Chart(ctx, {
                                    // The type of chart we want to create
                                    type: 'bar',

                                    // The data for our dataset
                                    data: {
                                        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                                        datasets: [{
                                            label: 'My First dataset',
                                            backgroundColor: 'rgb(255, 99, 132)',
                                            borderColor: 'rgb(255, 99, 132)',
                                            data: [0, 10, 5, 2, 20, 30, 45]
                                        }]
                                    },

                                    // Configuration options go here
                                    options: {}
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="tab-pane active" id="settings" role="tabpanel">
                    <?php
                    $blogs = $posts;
                    $blog_category = $categories;
                    $badge_class = ["badge-primary", "badge-secondary", "badge-success", "badge-danger", "badge-warning", "badge-info", "badge-dark"];
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <?php if (empty($blogs)) : ?>
                                <div class="card mb-3">
                                    <div class="row no-gutters border rounded overflow-hidden flex-md-row">
                                        <div class="card-body">
                                            <h2 class="card-title mb-2">It seems you didn't write a blog</h2>
                                            <p class="card-text">Write a blog by clicking down the button</p>
                                            <a href="<?=base_url()?>/users/post" class="btn btn-success">WRITE A BLOG</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php foreach ($blogs as $key => $blog_key) : ?>
                                <div class="card mb-3">
                                    <div class="row no-gutters border rounded overflow-hidden flex-md-row">
                                        <div class="card-body">
                                            <?php $temp_array = $blog_category[$blog_key['blog_id']]; ?>
                                            <?php foreach ($temp_array as $key => $category) : ?>
                                                <?php $single_badge = array_rand($badge_class, 1); ?>
                                                <a href="/category/<?= $category ?>" class="d-inline-block mb-2 badge <?= $badge_class[$single_badge] ?>"><?= $category ?></a>
                                            <?php endforeach; ?>
                                            <h2 class="card-title mb-0"><?= $blog_key['blog_title'] ?></h2>
                                            <p class="card-text mb-1"><small class="text-muted"><?= $blog_key['blog_created_time'] ?></small></p>
                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                            <a href="/post/edit" class="btn btn-primary">EDIT</a>
                                            <a href="/post/delete/<?= $blog_key['blog_id'] ?>" class="btn btn-danger">DELETE</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$errors = \Config\Services::validation()->getErrors(); //best wasy to show the errors;
$sess = session();
$sess->start(); ?>
<script>
    $(document).ready(function() {
        var csrf_name = "<?= csrf_token() ?>";
        var csrf_hash = "<?= csrf_hash() ?>";
        var csrf_val = {
            [csrf_name]: csrf_hash
        };
        var xhr = $.ajax({
            url: "<?= base_url() ?>/users/profdata",
            method: "POST",
            dataType: "json",
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            },
            data: csrf_val,
            success: function(data) {
                var dat = data;
                if (dat.user_fname === null && dat.user_lname === null) {
                    $("#first_name").attr("placeholder", "Enter your first name");
                    $("#last_name").attr("placeholder", "Enter your last name");
                    $("#bio").attr("placeholder", "Enter your Bio");
                } else {
                    $("#first_name").val(dat.user_fname);
                    $("#last_name").val(dat.user_lname);
                    $("#bio").val(dat.user_about);
                }
                var csrf = xhr.getResponseHeader("X-CSRF-TOKEN");
                $("[name=csrf_test_name]").val(csrf);
            }
        });
    });
    $('#List button').on('click', function(e) {
        e.preventDefault();
        $(this).tab('show');
    });
    $("#profile_update").click(function() {
        var datas;
        var csrf_name = "<?= csrf_token() ?>";
        var csrf_hash = $("[name=csrf_test_name]").val();
        var fname = $("#first_name").val();
        var lname = $("#last_name").val();
        var bio = $("#bio").val();
        var up_data = {
            "user_fname": fname,
            "user_lname": lname,
            "user_about": bio
        };
        var xhr = $.ajax({
            url: "<?= base_url() ?>/users/update_profile",
            method: "POST",
            dataType: "json",
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            },
            data: {
                [csrf_name]: csrf_hash,
                "user_data": JSON.stringify(up_data)
            },
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Updated',
                    text: 'Changes are updated successfully',
                });
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
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "7000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
<?php
if (!empty($errors)) {
    foreach ($errors as $key => $error) {
        echo '<script>toastr.error("' . esc($error) . '");</script>';
    }
}

if ($sess->has('old')) {
    echo '<script>toastr.error("' . esc($_SESSION['old']) . '");</script>';
}

if ($sess->has('success')) {
    echo '<script>Swal.fire({
        icon: "success",
        title: "Updated",
        text: "Password updated successfully",
    });</script>';
}

if ($sess->has('posted')) {
    echo '<script>Swal.fire({
        icon: "success",
        title:"Saved",
        text: "Posted Sucessfully",
    });</script>';
}

if ($sess->has('error')) {
    echo '<script>Swal.fire({
        icon: "error",
        title:"Error",
        text: "Error Occured",
    });</script>';
}

if ($sess->has('post_deleted')) {
    echo '<script>Swal.fire({
        icon: "success",
        title:"Success",
        text: "Deleted Sucessfully",
    });</script>';
}
?>
