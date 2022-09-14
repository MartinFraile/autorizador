<?PHP
// Class CROSSDATA V. 0.7.0 5 august 2015 PHP 5 compatible
//                                       PDO compatible
// free to use but no warranties
// El Condor - Condor Informatique - Turin
require_once "DB.php";
class CrossData {
    var $sql;                       // sql for get data
    var $error = "";                // syntax error
    var $percent = false;           // percent
    var $data1Label = "";           // first column head
    var $data2Label = "";           // first row head
    var $lastLabel = "";            // last row and column head
    var $myBeLabel = "";            // last row and column head
    var $onlyData = false;          // true return data array
    var $driverName = "";           // PDO DRIVER_NAME
    var $operation = "";            // required operation (COUNT, SUM, MIN, MAX, VAL, ...)
    public $precision = "";         // decimal
    public $ifEmpty = "";           // display if empty
    public $dbh = null;             // PDO Handle
    public $decPoint = ".";         // decimal point
    public $thousandsSep = ",";     // thousands separator
    public $tableClass = "CDTable"; // table class
    public $noStyle = false;        // if true table without styling
    public $IDClass = "";           // ID Class
    public $callBack = "";          // Call Back
    function percent($a,$t) {
        if (!is_numeric($a)) $a = 0;
        $p = round(100*$a/$t,$this->precision);
        if (!$this->onlyData && $p == 0) return "";
        return sprintf("%3.".$this->precision."f",$p);
    }
    function sortFields($i,$j,$arr) {
        $a = explode(",",$arr[$i][$j]);
        sort($a);
        return implode(",",$a);
    }
    function createTitle($f1,$f2,$op,$f3="") {
        return $this->handleOperator($op)." $f3 of $f1 by $f2";
    }
    function handleOperator($op) {
        if ($op == "Rows") return "% on rows of";
        if ($op == "Cols") return "% on columns of";
        if ($op == "Avg") return "Average";
        return ucfirst(strtolower($op));
    }
    function takeWord(&$str) {   // take words, space separated, and words in apostrophe
        $str = ltrim($str);
        If (substr($str,0,1) == "'") {
            $token = strtok($str, "'");
            $str = substr($str,strlen($token)+2);
        } else { 
            $token = strtok($str, " ");
            $str = substr($str,strlen($token));
        }
        return $token;
    }
    function scanCommand($cross) {
        $sum = "COUNT(*)";      // default group function
        if (strtoupper($this->takeWord($cross))!= "CROSS") {$this->error = "lack of CROSS command";return false;}
        $data1 = $this->takeWord($cross);       // first field
        $this->data1Label = $data1;
        $par = $this->takeWord($cross);
        if (strtoupper($par) != "BY") {
            $this->data1Label = $par;           // first label
            $par = $this->takeWord($cross);
        }
        if (strtoupper($par) != "BY") {$this->error = "lack of BY clause";return false;}
        $data2 = $this->takeWord($cross);       // second field 
        while (true) {
            $par = $this->takeWord($cross);
            switch (strtoupper($par)) {             
                case "%":
                    $this->percent = TRUE;
                    $this->operation = $par;
                    break;
                case "SUM":
                case "MIN":
                case "MAX":
                case "AVG":
                    $field = $this->takeWord($cross);
                    $this->myBeLabel = $field;
                    if ($this->percent) $this->myBeLabel .= " %";
                    $this->operation = ucfirst(strtolower($par));
                    if ($this->operation == "Avg") {
                        if (!is_numeric($this->precision)) $this->precision = 2;
                        $sum = "AVG($field), COUNT(*)";
                    } else $sum = "$par($field)";
                    break;
                case "ROWS":
                case "COLS":
                    $field = $this->takeWord($cross);
                    $this->operation = ucfirst(strtolower($par));
                    $this->myBeLabel = $field;
                    $sum = "SUM($field)";
                    break;
                case "FIELD":
                    $field = $this->takeWord($cross);
                    $sum = "GROUP_CONCAT(DISTINCT $field)";
                    $this->myBeLabel = $field;
                    $this->operation = "Field";
                    if ($this->callBack == "") $this->callBack = "CrossData::sortFields";
                    break;
                case "FROM":
                    break;
                default:
                    if ($this->operation == "") {
                        if ($this->data2Label == "")  $this->data2Label = $par;
                        else $this->lastLabel = $par;
                    } else $this->lastLabel = $par;
            }
            if (strtoupper($par) == "FROM") break;
            if ($par == "") {$this->error = "my be lack of field";return false;}
        }
        if ($this->operation == "") $this->operation = "Count";
        if ($this->percent && !is_numeric($this->precision)) $this->precision = 2;
        if ($this->lastLabel == "") $this->lastLabel = (($this->operation != "")?$this->operation." ":"").$this->myBeLabel;
        if ($this->data2Label == "")  $this->data2Label = $data2;
        $this->sql = "SELECT $data1,$data2, $sum FROM $cross GROUP BY $data1,$data2";
        return true;
    }
    function Cross($cross,$title="",$onlydata=false) {
        //$this->driverName = $this->dbh->getAttribute(PDO::ATTR_DRIVER_NAME);
        if (!$this->scanCommand($cross)) {
            echo "<br>Error: ".$this->error;
            exit;
        }
        $this->onlyData = $onlydata;
        if (!is_numeric($this->precision)) $this->precision = 0;
        if ($this->ifEmpty == "0") $this->ifEmpty = sprintf("%1.".$this->precision."f",0);
        $aRows = array();       // array of data1 values
        $aCols = array();       // array of data2 values
        $error                = DB::Connect();
        if ($error) {
          die($error);;
        }
     //   die($this->sql);
        $aResult = DB::Query($this->sql,'','',PDO::FETCH_NUM);
       // $aResult = $res->fetchAll(PDO::FETCH_NUM);
       
        if (count($aResult) == 0) {
            return ((!$onlydata)? "No data for: ".$this->sql:array());
        }
        foreach ($aResult as $fields) {
            $aRows[$fields[0]] = "";
            $aCols[$fields[1]] = "";
        }
        ksort($aCols);
        ksort($aRows);
        foreach($aRows as $k=>$v) $arrAss[$k] = $aCols; // complete array
        foreach ($aResult as $fields) $arrAss[$fields[0]][$fields[1]] = $fields[2].(($this->operation == "Avg")?"*".$fields[3]:""); // populate array
        // transform of associative array in numeric indexed array
        $arrOut = array_values($arrAss);
        for ($i=0;$i<count($arrOut);$i++) $arrOut[$i] = array_values($arrOut[$i]);
        if ($this->operation != "Field") {
            // add last column
            for ($nElem=count($arrOut),$i=0;$i<$nElem;$i++) 
                $arrOut[$i][count($arrOut[$i])] = $this->groupOp($arrOut[$i],$this->operation);
            // add last row and las cell
            $a = $arrOut;
            for ($nRows=count($a),$nElem=count($arrOut[0]),$i=0;$i<$nElem;$i++)             
                $arrOut[$nRows][$i] = $this->groupOp($this->array_column($a,$i),$this->operation);
            if ($this->operation == "Avg") {        // clean average fields
                for ($i=0;$i<count($arrOut);$i++) {
                    for ($j=0;$j<count($arrOut[$i]);$j++) $arrOut[$i][$j] = preg_replace("/\*.*/","",$arrOut[$i][$j]);
                }
            }
        }
// % handling
        if ($this->percent) {
            $totGen = $arrOut[count($arrOut)-1][count ($arrOut[0])-1];
            $nRows = count($arrOut);
            $nCols = count ($arrOut[0]);
            switch ($this->operation) {
                case "%":case "Sum":
                    for($i=0;$i<$nRows;$i++)        // horizontal %
                        for($j=0;$j<$nCols;$j++) $arrOut[$i][$j] = $this->percent($arrOut[$i][$j],$totGen);
                    break;
                case "Rows":                
                    for($i=0;$i<$nRows;$i++) {      // horizontal %
                        $rowTotal = $arrOut[$i][$nCols-1];
                        for($j=0;$j<$nCols;$j++) $arrOut[$i][$j] = $this->percent($arrOut[$i][$j],$rowTotal);
                    }
                    array_pop($arrOut);     // remove last row
                    break;
                case "Cols":                
                    for($i=0;$i<$nCols;$i++) {      // vertical %
                        $colTotal = $arrOut[$nRows-1][$i];
                        for($j=0;$j<$nRows;$j++) {$arrOut[$j][$i] = $this->percent($arrOut[$j][$i],$colTotal);                      }
                    }
                    for($j=0;$j<$nRows;$j++) array_pop($arrOut[$j]);
            }
        }
        $res = null;
        $aRows[$this->lastLabel] = $this->lastLabel;
        if ($this->operation != "Field") $aCols[$this->lastLabel] = "";     
        if (!$onlydata) return $this->makeTable($arrOut,array_keys($aRows),$aCols,$title);               // no list, only need data
        else return $this->makeArray($arrOut,array_keys($aRows),$aCols);
    }
    function makeTable($arr,$aRows,$aCols,$title="") {
        if ($title == "")
            $title = $this->createTitle($this->data1Label,$this->data2Label,$this->operation,$this->myBeLabel);
        $textAlignRight = ($this->operation == "Field" || $this->noStyle) ? "" : " style='text-align:right'";
        $styleFirstHead = ($this->noStyle) ? "" : " style='vertical-align:top;text-align:center'";
        $cellStyle = ($this->operation == "Field" || $this->noStyle) ? "" : "style='text-align:right'";
        $cd = "<TABLE CLASS='".$this->tableClass."' ID='".$this->IDClass."'$textAlignRight>";
        $cd .= "<CAPTION>$title</CAPTION>\n<THEAD>";
        $cd .= "\n<tr$styleFirstHead><th$textAlignRight>$this->data2Label<div$textAlignRight>$this->data1Label</div>";
        $aCols = array_keys($aCols);        // create numeric entry
        for($j=0;$j<count($arr[0]);$j++) {$cd .= "<TH>".$aCols[$j];}        // heads values
        for ($i=0;$i<count($arr);$i++) {
            $cd .= "\n<tr><td>".$aRows[$i];
            for ($j=0;$j<count($arr[$i]);$j++) {
                $v = $arr[$i][$j];
                if (is_numeric($this->ifEmpty) && $v == "") $arr[$i][$j] = 0;
                if ($v == "") $v = (is_numeric($this->ifEmpty)) ? 0 : $this->ifEmpty;
                if (is_numeric($v)) {
                    $v = number_format($v,$this->precision, $this->decPoint,$this->thousandsSep);
                    $arr[$i][$j] = number_format($arr[$i][$j],$this->precision);
                }
                if ($this->callBack != "") $v = call_user_func($this->callBack,$i,$j,$arr,$aRows[$i],$aCols[$j]);
                $cd .= "<TD>$v</TD>";               
            }   
        }       
        return $cd."</TABLE>";
    }   
    function makeArray($arr,$aRows,$aCols) {
        for ($i=0;$i<count($arr);$i++) {
            for ($j=0;$j<count($arr[$i]);$j++) {
                if ($arr[$i][$j] == "") $arr[$i][$j] = $this->ifEmpty;
                if (is_numeric($arr[$i][$j])) $arr[$i][$j] = number_format($arr[$i][$j],$this->precision,".","");
            }
            array_unshift($arr[$i],$aRows[$i]);
        }
        $a[] = $this->data2Label."/".$this->data1Label;
        foreach($aCols as $key => $v) $a[] = $key;
        array_unshift($arr,$a);
        return $arr;
    }
    function groupOp($arr,$op) {
        switch ($op) {
            case "%":case "Count":case "Sum":case "Rows":case "Cols":
                return array_sum($arr);
            case "Min":
                return min(array_filter($arr));
            case "Max":
                return max(array_filter($arr));
            case "Avg":
                $sAvg = 0;
                $sCount = 0;
                for($i=0;$i<count($arr);$i++) {
                    $aExpl = explode("*",$arr[$i]);
                    if(count($aExpl) == 2) {
                        $sAvg += $aExpl[0]*$aExpl[1];   // value
                        $sCount += $aExpl[1];           // count
                    }
                }
                return ($sAvg/$sCount)."*$sCount";
        }
    }
    function array_column($a,$i) {
        for ($j=0;$j<count($a);$j++) $aR[] = $a[$j][$i];
        return $aR;
    }
}          // end class
?>
