<?php
function xorEncrypt($text, $key) {
  $result = '';
  for ($i = 0; $i < strlen($text); $i++) {
    $result .= chr(ord($text[$i]) ^ ord($key[$i % strlen($key)]));
  }
  return base64_encode($result);
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$users = json_decode(file_get_contents('users.json'), true);
$users[] = [
  "username" => $username,
  "plain" => $password,
  "hash" => password_hash($password, PASSWORD_DEFAULT),
  "encrypted" => xorEncrypt($password, "key123")
];

file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
echo "User registered successfully!";
?>
