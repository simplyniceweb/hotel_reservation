<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?=$title?></title>
<link href="//maxcdn.bootstrapcdn.com/bootswatch/3.1.1/amelia/bootstrap.min.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href="<?=base_url()?>assets/styles/global.css" rel="stylesheet">
</head>
<body>

	<div class="container">
    	<div class="row">
            <div class="col-lg-6 col-lg-offset-3">
            <?=form_open('login/authenticate')?>
                <div class="panel panel-default" style="margin-top:80px">
                  <div class="panel-heading">
                    <h3 class="panel-title">Sign in</h3>
                  </div>
                  <div class="panel-body">
				<?php if (isset($message) && $message == 'false'): ?>
                    <div class="alert alert-warning">
                        <p>Invalid credentials.</p>
                    </div>
                <?php endif; ?>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" autofocus required />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required />
                    </div>
                    <div class="form-group">
                    	<button type="submit" class="btn btn-danger btn-md btn-block">Sign in</button>
                    </div>
                  </div>
                </div>
            </div>
            <?=form_close()?>
        </div>
    </div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script>
var config = {
	doc      : $(document),
	base_url : '<?=base_url()?>',
	cookie   : '<?=$this->security->get_csrf_hash()?>',
}
</script>
</body>
</html>