<style>
    .submit-btn,
    input[type="submit"]:hover {
        background-image: linear-gradient(-180deg, #34d058, #00aa00 90%);
        background-color: #00aa00;
        color: white;
        font-weight: 700;
    }
</style>

<div class="container mt-4" style="width: 100%; margin: 0 auto;max-width: 350px;padding: 15px;border: 1px solid #d8dee2;background-color: white;">

    <div class="mt-3">
        <div class="text-center">
            <img src="/favicon.ico" alt="" style="height:75px;width:75px">
        </div>
        <div class="text-center h3 font-weight-bold mb-1 mt-2">
            Sign in
        </div>
    </div>
    <?php $sess = \Config\Services::session();?>
    <?php if(isset($_SESSION['auth']) and $sess->get('auth') == 0):?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div>Wrong Username and Password.</div>
            <button type="button" class="close pl-0" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?= form_open('login/auth'); ?>

    <div class="form-group">
        <label for="mail">Username</label>
        <?php $email_data = ["id" => "mail", "class" => "form-control", "type" => "text", "name" => "uname", "placeholder" => "Username"]; ?>
        <?= form_input($email_data); ?>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <?php $pass_data = ["id" => "password", "class" => "form-control", "type" => "password", "name" => "password", "placeholder" => "Password"]; ?>
        <?= form_password($pass_data); ?>
    </div>

    <div class="mt-4">
        <input class="btn btn-block btn-success submit-btn" type="submit" name="" value="Sign in">
    </div>

    <?= form_close(); ?>
</div>

<div class="mt-3">
    <div style="width: 100%; margin: 0 auto;max-width: 350px;padding: 15px;border: 1px solid #d8dee2;
      background-color: white;">
        <div style="text-align:center">
            New to Blog?<div style="float:center"><a href="signup" style="text-align:right">Create an account</a>.</div>
        </div>
    </div>
</div>