# Stripe連携サンプル
- PHP 7.4.33
- Laravel Framework 7.30.6

## 各ページの内容
TOPページに3つリンクが設置してあり、それぞれ下記の決済ページへ遷移する。
| URL | 内容 | 区分 |
|--|--|--|
| localhost:8080/ | TOPページ | - |
| localhost:8080/option | 14日間優先表示オプション | 単発課金 |
| localhost:8080/right | CloudMeetsライトプラン |サブスク |
| localhost:8080/business | CloudMeetsビジネスプラン | サブスク |

## 動かし方
※以下の手順はエディタとしてVisual Studio Codeを利用している想定です。
### Dockerコンテナビルド
プロジェクトルート階層で以下のコマンドを実行
```
docker-compose build
```
### Dockerコンテナ起動
プロジェクトルート階層で以下のコマンドを実行
```
docker-compose up
```
### コンテナで再オープン
起動したコンテナをVSCodeで再オープンする。

VSCode左下の角にある緑色のボタンから開けるはず。

### ブラウザでアクセスしてみる
ブラウザで`localhost:8080`にアクセスすればTOPページが表示されると思います。

## .envに設定する値
.envはGitリポジトリに保存していないので、GoogleドライブからDLしてプロジェクトディレクトリに配置してください。
|キー|内容|
|-|-|
|STRIPE_PUBLIC_KEY|APIキー（公開鍵）|
|STRIPE_SECRET_KEY|APIキー（秘密鍵）|
|STRIPE_ITEM_OPTION|14日間優先表示オプションのpriceId|
|STRIPE_ITEM_PLAN_RIGHT|ライトプランのpriceId|
|STRIPE_ITEM_PLAN_BUSINESS|ビジネスプランのpriceId|

# 参考資料
- [Stripe - サブスクリプションの実装を構築する](https://stripe.com/docs/billing/subscriptions/build-subscriptions)
- [Stripe - 決済テスト用カード情報](https://stripe.com/docs/testing)
