# Stripe 連携サンプル

- PHP 7.4.33
- Laravel Framework 7.30.6

## 各ページの内容

TOP ページに 3 つリンクが設置してあり、それぞれ下記の決済ページへ遷移する。
| URL | 内容 | 区分 |
|--|--|--|
| localhost:8080/ | TOP ページ | - |
| localhost:8080/option | 14 日間優先表示オプション | 単発課金 |
| localhost:8080/right | CloudMeets ライトプラン |サブスク |
| localhost:8080/business | CloudMeets ビジネスプラン | サブスク |
| localhost:8080/subscribe | サブスクリプションサンプル | サブスク |

## 動かし方

※以下の手順はエディタとして Visual Studio Code を利用している想定です。

### Docker コンテナビルド

プロジェクトルート階層で以下のコマンドを実行

```
docker-compose build
```

### Docker コンテナ起動

プロジェクトルート階層で以下のコマンドを実行

```
docker-compose up
```

### コンテナで再オープン

起動したコンテナを VSCode で再オープンする。

VSCode 左下の角にある緑色のボタンから開けるはず。

### ブラウザでアクセスしてみる

ブラウザで`localhost:8080`にアクセスすれば TOP ページが表示されると思います。

## .env に設定する値

.env は Git リポジトリに保存していないので、Google ドライブから DL してプロジェクトディレクトリに配置してください。
|キー|内容|
|-|-|
|STRIPE_PUBLIC_KEY|API キー（公開鍵）|
|STRIPE_SECRET_KEY|API キー（秘密鍵）|
|STRIPE_ITEM_OPTION|14 日間優先表示オプションの priceId|
|STRIPE_ITEM_PLAN_RIGHT|ライトプランの priceId|
|STRIPE_ITEM_PLAN_BUSINESS|ビジネスプランの priceId|

# 参考資料

- [Stripe - サブスクリプションの実装を構築する](https://stripe.com/docs/billing/subscriptions/build-subscriptions)
- [Stripe - 決済テスト用カード情報](https://stripe.com/docs/testing)
- [Stripe - サブスクリプションの仕組み](https://stripe.com/docs/billing/subscriptions/overview?locale=ja-JP)
- [Stripe - 支払いリンク](https://stripe.com/docs/payment-links)
- [Stripe - サブスクリプションの実装を構築する](https://stripe.com/docs/billing/subscriptions/build-subscriptions?ui=elements&element=payment#collect-payment)
