<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>
    <body>
<form id="form_payment" action="{{ route('register') }}" method="post">
@csrf
  Name:<input id="name" type="text" name="name">
  Email:<input id="email" type="text" name="email">
  <!-- ここのdivタブがカード入力フォームに置き換わります。 -->
  <div id="card-element" class="MyCardElement"></div>
  <!-- ここにエラーメッセージが表示されます。 -->
  <div id="card-errors" role="alert"></div>
  <button id="button">Submit</button>
</form>
<!-- stripAPIを読み込みます -->
<script src="https://js.stripe.com/v3/"></script>
<script>
  // 公開可能なAPIキーです。
  const stripe = Stripe('{{ env("STRIPE_PUBLIC_KEY") }}');
  // 入力フォームを生成します。スタイルを指定することもできます。
  const elements = stripe.elements();
  const cardElement = elements.create('card', {hidePostalCode: true});

  //　先程のdivタブにマウントします。
  cardElement.mount("#card-element");

  const submit = document.getElementById('button');
  const name = document.getElementById('name');
  const email = document.getElementById('email');

  // クレジットカード番号や有効期限の入力に合わせてエラーメッセージを出力します。
  cardElement.addEventListener('change', ({error}) => {
      const displayError = document.getElementById('card-errors');
      submit.disabled = true;
      if (error) {
        displayError.textContent = error.message;
      } else {
        displayError.textContent = '';
        submit.disabled = false;
      }
  });

  // 登録ボタンがクリックされたら、API通信をおこなう
  submit.addEventListener('click', async(e) => {
    e.preventDefault();
    const {paymentMethod, error} = await stripe.createPaymentMethod({
      type: 'card',
      card: cardElement,
        billing_details: {
          // 顧客名emailアドレスはなくてもOK
          name: name.value,
          email: email.value,
      },
    });
    // 通信エラー時
    if (error) {
      console.error(error)
    } else {
        // 成功したらトークンが返されるので、hiddenに埋め込む
        const form = document.getElementById('form_payment');
        const hiddenToken = document.createElement('input');
        hiddenToken.setAttribute('type', 'hidden');
        hiddenToken.setAttribute('value', paymentMethod.id);
        hiddenToken.setAttribute('name', 'token');
        form.appendChild(hiddenToken);
        form.submit();
      }
    });
</script>
    </body>
</html>
