# chatgpt-interface
chatgptのAPIを呼び出すだけのシンプルなPHPコード

## 動作環境
- PHP7.4 以降 で動作確認しています

## 設定方法
- openAIのサイトにアカウントを登録しAPIで使うkeyを発行します
  - APIキーのページ https://platform.openai.com/account/api-keys 
- 発行したキーを以下のどちらかの方法で設定します
  - 環境変数　ChatGPT-Bearer に設定する
  - index.phpの22行目付近の$_SERVER['ChatGPT-Bearer']の行の値として設定する

## 使い方
ブラウザでアクセスし、テキスト入力欄に質問を記入します。
- 送信ボタン: chatGPTにそのまま送信します。用途を指定しない使い方です。
- 校正ボタン: 入力した文章を校正します。
- 英語に翻訳ボタン: 入力した文章を英語に翻訳します。

![image](https://user-images.githubusercontent.com/6766321/233530194-97905324-4eac-46cc-964a-1225b3ee97e5.png)
