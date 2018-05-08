phitFlyer, bitFlyer API PHP クライアント
=======================

## 説明

phitFlyerはbitFLyer-APIを呼び出す機能を持つPHPライブラリです。
配列やオブジェクトなど、複数のアクセス方法に対応しています。

## 特徴

- シンプルなインターフェース
- 返却値はデフォルトでjsonデコード結果（配列orオブジェクト）だが、デコレータによりオブジェクトで返却することも可能
- オプションで使用できるベンチマーククラスを内蔵


## デモ

### シンプルかつ最速の例:
```php
use PhitFlyer\PhitFlyerClient;
 
$flyer = new PhitFlyerClient();
 
$markets = $flyer->getMarkets();
 
foreach($markets as $idx => $market){
    echo $idx . '.' . PHP_EOL;
    echo 'product_code:' . $market->product_code . PHP_EOL;
    echo 'alias:' . (isset($market['alias']) ? $market['alias'] : '') . PHP_EOL;
}
 
```

### オブジェクトアクセスの例:
```php
use PhitFlyer\PhitFlyerClient;
use PhitFlyer\PhitFlyerObjectClient;
 
$flyer = new PhitFlyerObjectClient(new PhitFlyerClient());
 
$markets = $flyer->getMarkets();
 
foreach($markets as $idx => $market){
    echo $idx . '.' . PHP_EOL;
    echo 'product_code:' . $market->getProductCode() . PHP_EOL;
    echo 'alias:' . $market->getAlias() . PHP_EOL;
}
 
```

### ベンチマークの例:
```php
use PhitFlyer\PhitFlyerClient;
use PhitFlyer\PhitFlyerBenchmarkClient;
 
$flyer = new PhitFlyerBenchmarkClient(
            new PhitFlyerClient(), 
            function ($m, $e) use(&$method, &$elapsed){
                 echo "[$m]finished in $e sec" . PHP_EOL;
             }
        );
 
$flyer->getMarkets();
 
```

## 使い方

1. PhitFlyerClientオブジェクトを作成する。
2. APIに対応するメソッドを呼び出す。
3. PhitFlyerクラスが配列またはオブジェクト(stdClass)を返却。

## 要件

PHP 5.5 かまたはそれ以上


## phitFlyerのインストール方法

phitFlyerのインストールはComposerからのインストールが便利です。
[Composer](http://getcomposer.org).

```bash
composer require stk2k/phitflyer
```

インストール後、Composerのオートローダーを以下のようにrequireしてください。

```php
require 'vendor/autoload.php';
```

## ライセンス
[MIT](https://github.com/stk2k/grasshopper/blob/master/LICENSE)

## 作者

[stk2k](https://github.com/stk2k)


## 免責事項

このソフトウェアは無保証です。
私たちはこのソフトウェアによるいかなる結果も責任を負いません。
あなた自身の責任においてこのソフトウェアを使用するようにしてください。


## 寄付

-Bitcoin: 3HCw9pp6dSq1xU9iPoPKVFyVbM8iBrrinn

