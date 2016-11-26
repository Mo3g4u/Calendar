# Calendar
行列形式のカレンダーを想定して、カレンダーデータを出力する。
特定年月の1日までと末日以降の空白にあたる箇所のデータも保持する。
DateTimeの配列を返すだけ。

## Usage

### 年月を指定してカレンダーデータを取得

デフォルトは日曜日始まり。
コンストラクタの第三引数に0～6の範囲で開始曜日を指定できる。
0:日曜日
1:月曜日
2:火曜日
3:水曜日
4:木曜日
5:金曜日
6:土曜日

```php
$calendar = new Calendar(2016, 11);
$raw = $calendar->rawDates();
var_dump($raw);
```

結果
```php
array(35) {
  [0]=>
  object(DateTime)#24 (3) {
    ["date"]=>
    string(26) "2016-10-30 11:41:37.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(10) "Asia/Tokyo"
  }
  [1]=>
  object(DateTime)#13 (3) {
    ["date"]=>
    string(26) "2016-10-31 11:41:37.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(10) "Asia/Tokyo"
  }
  [2]=>
  object(DateTime)#22 (3) {
    ["date"]=>
    string(26) "2016-11-01 11:41:37.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(10) "Asia/Tokyo"
  }
  [3]=>
  object(DateTime)#23 (3) {
    ["date"]=>
    string(26) "2016-11-02 11:41:37.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(10) "Asia/Tokyo"
  }

・・・

  [31]=>
  object(DateTime)#52 (3) {
    ["date"]=>
    string(26) "2016-11-30 11:41:37.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(10) "Asia/Tokyo"
  }
  [32]=>
  object(DateTime)#54 (3) {
    ["date"]=>
    string(26) "2016-12-01 11:41:37.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(10) "Asia/Tokyo"
  }
  [33]=>
  object(DateTime)#55 (3) {
    ["date"]=>
    string(26) "2016-12-02 11:41:37.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(10) "Asia/Tokyo"
  }
  [34]=>
  object(DateTime)#56 (3) {
    ["date"]=>
    string(26) "2016-12-03 11:41:37.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(10) "Asia/Tokyo"
  }
}
```


