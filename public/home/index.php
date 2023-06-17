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
		<table id="posts">
			<?php foreach ($result->posts as $post): ?>
				<tr class="post-row">
					<td class="post-icon">
						<?php if (!is_null($post->thumbnail_url)): ?>
							<img src="<?= $post->thumbnail_url ?>" alt="<?= $post->embed_title ?>">
						<?php elseif ($post->url): ?>
							<img class="placeholder-icon" src="/assets/icons/link.png" alt="">
						<?php else: ?>
							<img class="placeholder-icon" src="/assets/icons/text.png" alt="">
						<?php endif ?>
					</td>
					<td class="post">
						<a class="post-title" href="<?= $post->post->url ?: "#" ?>" target="_blank">
							<?= $post->post->body ?>
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
							<a class="comments" href="/post?id=<?= $post->id ?>">
								<?= $post->counts->comments ?>
								comment<?= $post->counts->comments != 1 ? "s" : "" ?>
								<?= $post->counts->unread_comments != $post->counts->comments && $post->counts->unread_comments > 0 ? " (" . $post->counts->unread_comments . ")" : "" ?>
							</a>
						</span>
					</td>
				</tr>
			<?php endforeach ?>
		</table>
	</body>
</html>

