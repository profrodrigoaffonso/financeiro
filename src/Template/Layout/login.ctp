<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<link href="/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="/css/login.css" rel="stylesheet">
<script src="/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<?= $this->Flash->render() ?>
<?= $this->fetch('content') ?>

</body>
</html>