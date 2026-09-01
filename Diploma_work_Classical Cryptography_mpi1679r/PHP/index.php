<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>Класическа криптография</title>
<style type="text/css">
  .font {
	font-weight: bold;
	color: #009;
    }

</style>
</head>
    <body>
      <?php
        error_reporting(E_ERROR | E_WARNING | E_PARSE); // съобщение за грешка при празно текстово поле;
        
        $enc = "";
        $dec = "";
        $strlen = "";

        if (isset($_POST['go1'])) {
            $text = $_POST['text'];
            $alphabet = array('а', 'б', 'в', 'г', 'д', 'е', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ь', 'ю', 'я');
            for ($i = 0; $i < count($alphabet); $i++) {
                $a = $i - $_POST['shift'];
                $tmp[$alphabet[$i]] = $i;
                if ($a < 0)
                    $a += count($alphabet);
                $alphabet_new[$a] = $alphabet[$i];
            }
            $alphabet = $tmp;

// честотен анализ
            $strlen = strlen($text);
            $letters = array();
            $letters2 = array();
            $letters3 = array();
            for ($i = 0; $i < $strlen; $i++) {
                if (isset($letters[$text[$i]])) {
                    $letters[$text[$i]]++;
                } else {
                    $letters[$text[$i]] = 1;
                }

// кодиране
                if (in_array($text[$i], $alphabet_new)) {
                    $enc .= $alphabet_new[$alphabet[$text[$i]]];
// модул
                    $sdvig = ($i % (count($alphabet)));
                    $sdvig += $alphabet[$text[$i]];
                } else {
                    $dec .= $text[$i];
                }
            }

            for ($i = 0; $i < $strlen; $i++) {
// статистика
                if (isset($letters2[$enc[$i]])) {
                    $letters2[$enc[$i]]++;
                }
            }

// сортиране
            arsort($letters);
            $keys = array_keys($letters);
            arsort($letters2);
            $keys2 = array_keys($letters2);
        }

        if (isset($_POST['go2'])) {
            $text = $_POST['sumb'];
            $alphabet = array('а', 'б', 'в', 'г', 'д', 'е', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ь', 'ъ', 'ю', 'я');
            for ($i = 0; $i < count($alphabet); $i++) {
                $a = $i + $_POST['shift'];     // - kriptira, + dekriptira
                $tmp[$alphabet[$i]] = $i;
                if ($a > 29)
                    $a -= count($alphabet);     // + kriptira - dekriptira
                $alphabet_new[$a] = $alphabet[$i];
            }
            $alphabet = $tmp;

// честотен анализ
            $strlen = strlen($text);
            $letters = array();
            $letters2 = array();
            $letters3 = array();
            for ($i = 0; $i < $strlen; $i++) {
                if (isset($letters[$text[$i]])) {
                    $letters[$text[$i]]++;
                } else {
                    $letters[$text[$i]] = 1;
                }

// кодиране
                if (in_array($text[$i], $alphabet_new)) {
                    $dec .= $alphabet_new[$alphabet[$text[$i]]];
// модул
                    $sdvig = ($i % (count($alphabet)));
                    $sdvig += $alphabet[$text[$i]];
                } else {
                    $enc .= $text[$i];
                }
            }

            for ($i = 0; $i < $strlen; $i++) {
// статистика
                if (isset($letters2[$dec[$i]])) {
                    $letters2[$enc[$i]]++;
                }
            }

// сортиране
            arsort($letters);
            $keys = array_keys($letters);
            arsort($letters2);
            $keys2 = array_keys($letters2);
        }
        ?>
      
      
    </p>
        <table>
            <tr>
              <td><p class="font">КЛАСИЧЕСКА КРИПТОГРАФИЯ<br>
                <br>
              </p></td></tr><tr>
            <form method="post" action"">
                    <tr>
                    <td class="font">Ясен текст:</td>
                    <td class="font">Криптиран текст:</td>
                    
                <tr />
                <tr><td><textarea rows="10" cols="40" name="text"><?php echo $dec; ?></textarea></td>
                    <td><textarea rows="10" cols="40" name="sumb"><?php echo $enc; ?></textarea></td>
                <tr>
                  <td><span class="font">Стъпка:</span>                    <input type="text" value="" name="shift" size="2"/></td></tr>
                <tr><td><input type="submit" name="go1" value="Криптиране" /></td>
                    <td><input type="submit" name="go2" value="Декриптиране" /></td></tr>
          </form>
    </table>
<?php
echo '<br /><b>Всички символи в текста са: ' . $strlen . '</b><br />';
echo '<br /><b>Честотен анализ:</b><br />';

echo '<table><tr><td>';

echo '<br /><table>';
echo '<tr><td>Символ</td><td>Честота</td><td>Проценти</td></tr>';
for ($i = 0; $i < count($letters); $i++) {
    $procent = $letters[$keys[$i]] * 100 / $strlen;
    $procent = substr($procent, 0, 4);
    echo '<tr><td>' . $keys[$i] . '</td><td>' . $letters[$keys[$i]] . '</td><td><img src="dot.gif" border="0" width="' . ($procent * 10) . '" height="10">' . $procent . '%</td></tr>';
}
echo '</table>';
echo '</table>';
echo '</td></tr></table>';
?>

    </body>
</html>
