<?php
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'utf-8');
}
?>
<h1>ChatGPT Interface</h1>
<meta name="robots" content="noindex">
<form method="post">
<textarea name="input" style="width:600px;height:300px;"><?=h($_REQUEST['input']??'')?></textarea><br>
<input type="submit" value="送信" style="width:195px;">
<input type="submit" name="proofread" value="校正" style="width:195px;">
<input type="submit" name="english" value="英語に翻訳" style="width:195px;">
</form>
<?php
if(isset($_REQUEST['proofread']))$_POST['input'] =  '以下の文を校正してください。'.PHP_EOL.PHP_EOL.$_POST['input'];
if(isset($_REQUEST['english']))$_POST['input'] =  '以下の文を英語に翻訳してください。'.PHP_EOL.PHP_EOL.$_POST['input'];

if(isset($_POST['input'])===false)exit;
if(array_key_exists('ChatGPT-Bearer', $_SERVER) === false){
	// 環境変数を設定できない場合は以下の行にChatGPTで発行したTokenを設定ください
	$_SERVER['ChatGPT-Bearer'] = "sk-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
$headers = [
    "HTTP/1.0",
    "Authorization: Bearer {$_SERVER['ChatGPT-Bearer']}",
    'Content-Type: application/json'
];

$data = [
    'model' => "gpt-3.5-turbo",
    'messages' => [['role'=>'user', 'content' => $_POST['input']]],
    'temperature' => 0,
    'max_tokens' => 3000
];
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$content = curl_exec($ch);
$data = json_decode($content, true);
echo(nl2br(h(trim($data['choices'][0]['message']['content']))));
