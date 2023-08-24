<?php
//引数で与えられた配列を元にプルダウンリストを生成する
function arrayToSelect($inputName, $srcArray, $selectedIndex = "") {

  $temphtml = "<select class=\"form-select\" name=\"{$inputName}\">" . PHP_EOL;

  foreach ($srcArray as $key => $val) {
    //キーと選択値を比較して一致したらselectedをつける
    if ($key == $selectedIndex) {
      $selectedText = "selected";
    } else {
      $selectedText = "";
    }

    $temphtml .= "<option value=\"{$key}\" {$selectedText}>{$val}</option>" . PHP_EOL;
  }
  
  $temphtml .= "</select>" . PHP_EOL;

  return $temphtml;
}

//引数で与えたられた日時を表示形式に返還する
function format_date($yyyymmdd) {
  $week = array('日','月','火','水','木','金','土',);
  return date('n/j('.$week[date('w', strtotime($yyyymmdd))] .')', strtotime($yyyymmdd));
}

