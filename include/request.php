<?php

function request($method, $path, $body = null) {
	$context = stream_context_create([
		"http" => [
			"header" =>
				"Accept: application/json\r\n",
			"method" => $method,
		],
	]);

	if ($body) {
		$data = json_encode($body);

		$context["http"]["header"] .=
			"Content-Type: application/json\r\n" .
			"Content-Length: " . strlen($data) . "\r\n";

		$context["http"]["content"] = $data;
	}

	$result = file_get_contents((getenv("LEMMY_HOST") ?: "http://localhost:8536") . "/api/v3$path");

	// TODO Handle errors properly

	if ($result === false) {
		die("ERROR: Could not send request to $path <br><br> " . json_encode(error_get_last()));
	}

	$response = json_decode($result);

	if ($response === null) {
		die("ERROR: Could not parse response from request to $path: <br><br> $response");
	}

	return $response;
}

