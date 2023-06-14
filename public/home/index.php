<?php
	require "../include/request.php";

	$result = request("GET", "/post/list", null);
?>
<!DOCTYPE html>
<html>
	<head>
		<?php require "../include/head.php" ?>
		<title>Posts</title>
	</head>
	<body>
		<?php foreach ($result->posts as $post): ?>
			<div class="post">
				<a class="post-title" href="<?= $post->post->url ?: "#"?>"><?= $post->post->body ?></a>
				<br>
				<span class="post-info">
					by <a href="/user?id=<?= $post->creator->id ?>"><?= $post->creator->name ?></a>
					in <?= $post->community->name ?>
				</span>
			</div>
		<?php endforeach; ?>
	</body>
</html>

