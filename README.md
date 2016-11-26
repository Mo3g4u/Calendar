# Calendar
行列形式のカレンダーを想定して、カレンダーデータを出力する。
特定年月の1日までと末日以降の空白にあたる箇所のデータも保持する。
DateTimeの配列を返すだけ。

## Usage

※raw無しのメソッドはDateTimeではなく['year' => xx, 'month' => xx, 'day' => xx, 'dow' => xx]の配列で返します。

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


### 年月を指定して2次元配列のカレンダーデータを取得

デフォルトは日曜日始まり。

```php
$calendar = new Calendar(2016, 11);
$array = $calendar->rawDatesChunk();
var_dump($array);
```
結果

```php
array(5) {
  [0]=>
  array(7) {
    [0]=>
    object(DateTime)#52 (3) {
      ["date"]=>
      string(26) "2016-10-30 13:18:13.000000"
      ["timezone_type"]=>
      int(3)
      ["timezone"]=>
      string(10) "Asia/Tokyo"
    }
    
・・・

    [6]=>
    object(DateTime)#47 (3) {
      ["date"]=>
      string(26) "2016-11-05 13:18:13.000000"
      ["timezone_type"]=>
      int(3)
      ["timezone"]=>
      string(10) "Asia/Tokyo"
    }
  }
  [1]=>
  array(7) {
    [0]=>
    object(DateTime)#46 (3) {
      ["date"]=>
      string(26) "2016-11-06 13:18:13.000000"
      ["timezone_type"]=>
      int(3)
      ["timezone"]=>
      string(10) "Asia/Tokyo"
    }

・・・

    [6]=>
    object(DateTime)#40 (3) {
      ["date"]=>
      string(26) "2016-11-12 13:18:13.000000"
      ["timezone_type"]=>
      int(3)
      ["timezone"]=>
      string(10) "Asia/Tokyo"
    }
  }
  [2]=>
  array(7) {
    [0]=>
    object(DateTime)#39 (3) {
      ["date"]=>
      string(26) "2016-11-13 13:18:13.000000"
      ["timezone_type"]=>
      int(3)
      ["timezone"]=>
      string(10) "Asia/Tokyo"
    }

・・・

    [6]=>
    object(DateTime)#33 (3) {
      ["date"]=>
      string(26) "2016-11-19 13:18:13.000000"
      ["timezone_type"]=>
      int(3)
      ["timezone"]=>
      string(10) "Asia/Tokyo"
    }
  }
  [3]=>
  array(7) {
    [0]=>
    object(DateTime)#32 (3) {
      ["date"]=>
      string(26) "2016-11-20 13:18:13.000000"
      ["timezone_type"]=>
      int(3)
      ["timezone"]=>
      string(10) "Asia/Tokyo"
    }

・・・

    [6]=>
    object(DateTime)#26 (3) {
      ["date"]=>
      string(26) "2016-11-26 13:18:13.000000"
      ["timezone_type"]=>
      int(3)
      ["timezone"]=>
      string(10) "Asia/Tokyo"
    }
  }
  [4]=>
  array(7) {
    [0]=>
    object(DateTime)#25 (3) {
      ["date"]=>
      string(26) "2016-11-27 13:18:13.000000"
      ["timezone_type"]=>
      int(3)
      ["timezone"]=>
      string(10) "Asia/Tokyo"
    }

・・・

    [6]=>
    object(DateTime)#53 (3) {
      ["date"]=>
      string(26) "2016-12-03 13:18:13.000000"
      ["timezone_type"]=>
      int(3)
      ["timezone"]=>
      string(10) "Asia/Tokyo"
    }
  }
}
```

### 年月を指定して第N週のカレンダーデータを取得

```php
$calendar = new Calendar(2016, 11);
$array = $calendar->rawDatesNthWeek(2); // 第二週
var_dump($array);
```

結果

```php
array(7) {
  [0]=>
  object(DateTime)#28 (3) {
    ["date"]=>
    string(26) "2016-11-06 13:22:33.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(10) "Asia/Tokyo"
  }
  [1]=>
  object(DateTime)#29 (3) {
    ["date"]=>
    string(26) "2016-11-07 13:22:33.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(10) "Asia/Tokyo"
  }
  [2]=>
  object(DateTime)#30 (3) {
    ["date"]=>
    string(26) "2016-11-08 13:22:33.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(10) "Asia/Tokyo"
  }
  [3]=>
  object(DateTime)#31 (3) {
    ["date"]=>
    string(26) "2016-11-09 13:22:33.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(10) "Asia/Tokyo"
  }
  [4]=>
  object(DateTime)#32 (3) {
    ["date"]=>
    string(26) "2016-11-10 13:22:33.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(10) "Asia/Tokyo"
  }
  [5]=>
  object(DateTime)#33 (3) {
    ["date"]=>
    string(26) "2016-11-11 13:22:33.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(10) "Asia/Tokyo"
  }
  [6]=>
  object(DateTime)#34 (3) {
    ["date"]=>
    string(26) "2016-11-12 13:22:33.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(10) "Asia/Tokyo"
  }
}
```

### 年月を指定して指定曜日のカレンダーデータを取得

```php
$calendar = new Calendar(2016, 11);
$array = $calendar->rawSpecifyDow(4); // 0 sun - 6 sat
var_dump($array);
```

結果

```php
array(5) {
  [0]=>
  object(DateTime)#28 (3) {
    ["date"]=>
    string(26) "2016-11-03 13:25:16.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(10) "Asia/Tokyo"
  }
  [1]=>
  object(DateTime)#50 (3) {
    ["date"]=>
    string(26) "2016-11-10 13:25:16.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(10) "Asia/Tokyo"
  }
  [2]=>
  object(DateTime)#43 (3) {
    ["date"]=>
    string(26) "2016-11-17 13:25:16.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(10) "Asia/Tokyo"
  }
  [3]=>
  object(DateTime)#36 (3) {
    ["date"]=>
    string(26) "2016-11-24 13:25:16.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(10) "Asia/Tokyo"
  }
  [4]=>
  object(DateTime)#13 (3) {
    ["date"]=>
    string(26) "2016-12-01 13:25:16.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(10) "Asia/Tokyo"
  }
}
```

### 年月を指定して第N週、N曜日のカレンダーデータを取得

```php
$calendar = new Calendar(2016, 11);
$date = $calendar->rawNthDow(2, 3); // second week & wed
var_dump($date);
```

結果

```php
object(DateTime)#27 (3) {
  ["date"]=>
  string(26) "2016-11-09 13:28:46.000000"
  ["timezone_type"]=>
  int(3)
  ["timezone"]=>
  string(10) "Asia/Tokyo"
}
```

