<?php
	require "../include/request.php";

	$result = request("GET", "/post/list", null);
?>
<!-- <?= json_encode($result, JSON_PRETTY_PRINT) ?> -->
<!DOCTYPE html>
<html>
	<head>
		<?php require "../include/head.php" ?>
		<link rel="stylesheet" href="/assets/style/posts.css">
		<title>Posts</title>
	</head>
	<body>
		<table id="posts">
			<?php foreach ($result->posts as $index => $post): ?>
				<tr class="post-row">
					<td class="post-icon">
						<label for="post-content-<?= $index ?>">
							<?php if ($post->post->thumbnail_url): ?>
								<img class="thumbnail-icon" src="<?= $post->post->thumbnail_url ?>" alt="<?= $post->post->embed_title ?>">
							<?php elseif ($post->post->url): ?>
								<img class="placeholder-icon" src="/assets/icons/link.png" alt="">
							<?php else: ?>
								<img class="placeholder-icon" src="/assets/icons/text.png" alt="">
							<?php endif ?>
						</label>
					</td>
					<td class="post">
						<a class="post-title" href="<?= $post->post->url ?: "/post?id=" . $post->post->id ?>">
							<?= $post->post->name ?>
						</a>
						<br>
						<span class="post-info">
							by
							<a href="/user?id=<?= $post->creator->id ?>">
								@<?= $post->creator->name ?>
							</a>
							in
							<a href="/community?id=<?= $post->community->id ?>">
								!<?= $post->community->name ?>
							</a>
						</span>
						<br>
						<span class="post-actions">
							<button class="upvote">&#9650;</button>
							<span
								class="vote-count"
								title="<?= $post->counts->score ?> votes (<?= $post->counts->upvotes ?> upvotes / <?= $post->counts->downvotes ?> downvotes)">
								<?= $post->counts->score ?>
							</span>
							<button class="downvote">&#9660;</button>
							<a class="comments" href="/post?id=<?= $post->post->id ?>">
								<?= $post->counts->comments ?>
								comment<?= $post->counts->comments != 1 ? "s" : "" ?>
								<?= $post->counts->unread_comments != $post->counts->comments && $post->counts->unread_comments > 0 ? " (" . $post->counts->unread_comments . ")" : "" ?>
							</a>
						</span>
					</td>
				</tr>
				<tr>
					<td style="background-color: #EEE; padding: 0"></td>
					<td style="background-color: #EEE; padding: 0">
						<input type="checkbox" id="post-content-<?= $index ?>" class="post-content-checkbox">
						<?php if ($post->post->body): ?>
							<div class="post-content"><?= $post->post->body ?></div>
						<?php elseif ($post->post->thumbnail_url): ?>
							<div class="post-content"><!--
								--><a href="<?= $post->post->thumbnail_url ?>" target="_blank"><!--
									--><img src="<?= $post->post->thumbnail_url ?>" alt=""><!--
								--></a><!--
								<?php if ($post->post->embed_title): ?>
									--><h2><?= $post->post->embed_title ?></h2><!--
								<?php endif ?>
								<?php if ($post->post->embed_description): ?>
									--><p><?= $post->post->embed_description ?></p><!--
								<?php endif ?>
							--></div>
						<?php endif ?>
					</td>
				</tr>
				<tr>
					<td style="background-color: #EEE; padding: 0"></td>
					<td class="post-spacing"></td>
				</tr>
			<?php endforeach ?>
		</table>
	</body>
</html>

