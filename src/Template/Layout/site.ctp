<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<link href="/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" type="text/css" href="/jquery-ui/jquery-ui.min.css">
</head>
<body>
	<div class="container">
	<?= $this->Flash->render() ?>
	</div>
	<?= $this->fetch('content') ?>
</body>
</html>
<script type="text/javascript" src="/jquery-ui/external/jquery/jquery.js"></script>
<script type="text/javascript" src="/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/inserir.js"></script>