<?php
function par_check($inpt_type, $val){
	
    /*if(preg_match("#[\\~\\`\\!\\@\\#\\$\\%\\^\\&\\*\\(\\)\\_\\-\\+\\=\\{\\}\\[\\]\\|\\:\\;\\&lt;\\&gt;\\.\\?\\/\\\\\\\\]+#", $val)){
        redirect('/e404');
    }*/
	/*if ($val!='' && strlen($val)>10)
	{
		redirect('/eror');
	}
    
    if($inpt_type=='notnull_date' && $val!=''){
        list($d, $m, $y) = explode('-', $val);
    }
	
	if ($inpt_type=='int' && is_numeric($val)==false)
	{
	   redirect('/eror');
	}
	else if ($inpt_type=='email' && filter_var($val, FILTER_VALIDATE_EMAIL)==false)
	{
	   redirect('/eror');
	}
	else if ($inpt_type=='notnull' && $val=='')
	{
	   redirect('/eror');
	}
	else if ($inpt_type=='notnull_int' && ($val=='' || is_numeric($val)==false))
	{
	   redirect('/eror');
	}
	else if ($inpt_type=='notnull_date'  &&  checkdate($m, $d, $y)==false && ($val=='' ||  strlen($val)==10))
	{
	   //REGullex
	   redirect('/eror');
	}*/
	
	
	
	return true;
	
}
function formatcurrency($floatcurr, $curr = "BDT"){
    $currencies['ARS'] = array(2,',','.');          //  Argentine Peso
    $currencies['AMD'] = array(2,'.',',');          //  Armenian Dram
    $currencies['AWG'] = array(2,'.',',');          //  Aruban Guilder
    $currencies['AUD'] = array(2,'.',' ');          //  Australian Dollar
    $currencies['BSD'] = array(2,'.',',');          //  Bahamian Dollar
    $currencies['BHD'] = array(3,'.',',');          //  Bahraini Dinar
    $currencies['BDT'] = array(2,'.',',');          //  Bangladesh, Taka
    $currencies['BZD'] = array(2,'.',',');          //  Belize Dollar
    $currencies['BMD'] = array(2,'.',',');          //  Bermudian Dollar
    $currencies['BOB'] = array(2,'.',',');          //  Bolivia, Boliviano
    $currencies['BAM'] = array(2,'.',',');          //  Bosnia and Herzegovina, Convertible Marks
    $currencies['BWP'] = array(2,'.',',');          //  Botswana, Pula
    $currencies['BRL'] = array(2,',','.');          //  Brazilian Real
    $currencies['BND'] = array(2,'.',',');          //  Brunei Dollar
    $currencies['CAD'] = array(2,'.',',');          //  Canadian Dollar
    $currencies['KYD'] = array(2,'.',',');          //  Cayman Islands Dollar
    $currencies['CLP'] = array(0,'','.');           //  Chilean Peso
    $currencies['CNY'] = array(2,'.',',');          //  China Yuan Renminbi
    $currencies['COP'] = array(2,',','.');          //  Colombian Peso
    $currencies['CRC'] = array(2,',','.');          //  Costa Rican Colon
    $currencies['HRK'] = array(2,',','.');          //  Croatian Kuna
    $currencies['CUC'] = array(2,'.',',');          //  Cuban Convertible Peso
    $currencies['CUP'] = array(2,'.',',');          //  Cuban Peso
    $currencies['CYP'] = array(2,'.',',');          //  Cyprus Pound
    $currencies['CZK'] = array(2,'.',',');          //  Czech Koruna
    $currencies['DKK'] = array(2,',','.');          //  Danish Krone
    $currencies['DOP'] = array(2,'.',',');          //  Dominican Peso
    $currencies['XCD'] = array(2,'.',',');          //  East Caribbean Dollar
    $currencies['EGP'] = array(2,'.',',');          //  Egyptian Pound
    $currencies['SVC'] = array(2,'.',',');          //  El Salvador Colon
    $currencies['ATS'] = array(2,',','.');          //  Euro
    $currencies['BEF'] = array(2,',','.');          //  Euro
    $currencies['DEM'] = array(2,',','.');          //  Euro
    $currencies['EEK'] = array(2,',','.');          //  Euro
    $currencies['ESP'] = array(2,',','.');          //  Euro
    $currencies['EUR'] = array(2,',','.');          //  Euro
    $currencies['FIM'] = array(2,',','.');          //  Euro
    $currencies['FRF'] = array(2,',','.');          //  Euro
    $currencies['GRD'] = array(2,',','.');          //  Euro
    $currencies['IEP'] = array(2,',','.');          //  Euro
    $currencies['ITL'] = array(2,',','.');          //  Euro
    $currencies['LUF'] = array(2,',','.');          //  Euro
    $currencies['NLG'] = array(2,',','.');          //  Euro
    $currencies['PTE'] = array(2,',','.');          //  Euro
    $currencies['GHC'] = array(2,'.',',');          //  Ghana, Cedi
    $currencies['GIP'] = array(2,'.',',');          //  Gibraltar Pound
    $currencies['GTQ'] = array(2,'.',',');          //  Guatemala, Quetzal
    $currencies['HNL'] = array(2,'.',',');          //  Honduras, Lempira
    $currencies['HKD'] = array(2,'.',',');          //  Hong Kong Dollar
    $currencies['HUF'] = array(0,'','.');           //  Hungary, Forint
    $currencies['ISK'] = array(0,'','.');           //  Iceland Krona
    $currencies['INR'] = array(2,'.',',');          //  Indian Rupee
    $currencies['IDR'] = array(2,',','.');          //  Indonesia, Rupiah
    $currencies['IRR'] = array(2,'.',',');          //  Iranian Rial
    $currencies['JMD'] = array(2,'.',',');          //  Jamaican Dollar
    $currencies['JPY'] = array(0,'',',');           //  Japan, Yen
    $currencies['JOD'] = array(3,'.',',');          //  Jordanian Dinar
    $currencies['KES'] = array(2,'.',',');          //  Kenyan Shilling
    $currencies['KWD'] = array(3,'.',',');          //  Kuwaiti Dinar
    $currencies['LVL'] = array(2,'.',',');          //  Latvian Lats
    $currencies['LBP'] = array(0,'',' ');           //  Lebanese Pound
    $currencies['LTL'] = array(2,',',' ');          //  Lithuanian Litas
    $currencies['MKD'] = array(2,'.',',');          //  Macedonia, Denar
    $currencies['MYR'] = array(2,'.',',');          //  Malaysian Ringgit
    $currencies['MTL'] = array(2,'.',',');          //  Maltese Lira
    $currencies['MUR'] = array(0,'',',');           //  Mauritius Rupee
    $currencies['MXN'] = array(2,'.',',');          //  Mexican Peso
    $currencies['MZM'] = array(2,',','.');          //  Mozambique Metical
    $currencies['NPR'] = array(2,'.',',');          //  Nepalese Rupee
    $currencies['ANG'] = array(2,'.',',');          //  Netherlands Antillian Guilder
    $currencies['ILS'] = array(2,'.',',');          //  New Israeli Shekel
    $currencies['TRY'] = array(2,'.',',');          //  New Turkish Lira
    $currencies['NZD'] = array(2,'.',',');          //  New Zealand Dollar
    $currencies['NOK'] = array(2,',','.');          //  Norwegian Krone
    $currencies['PKR'] = array(2,'.',',');          //  Pakistan Rupee
    $currencies['PEN'] = array(2,'.',',');          //  Peru, Nuevo Sol
    $currencies['UYU'] = array(2,',','.');          //  Peso Uruguayo
    $currencies['PHP'] = array(2,'.',',');          //  Philippine Peso
    $currencies['PLN'] = array(2,'.',' ');          //  Poland, Zloty
    $currencies['GBP'] = array(2,'.',',');          //  Pound Sterling
    $currencies['OMR'] = array(3,'.',',');          //  Rial Omani
    $currencies['RON'] = array(2,',','.');          //  Romania, New Leu
    $currencies['ROL'] = array(2,',','.');          //  Romania, Old Leu
    $currencies['RUB'] = array(2,',','.');          //  Russian Ruble
    $currencies['SAR'] = array(2,'.',',');          //  Saudi Riyal
    $currencies['SGD'] = array(2,'.',',');          //  Singapore Dollar
    $currencies['SKK'] = array(2,',',' ');          //  Slovak Koruna
    $currencies['SIT'] = array(2,',','.');          //  Slovenia, Tolar
    $currencies['ZAR'] = array(2,'.',' ');          //  South Africa, Rand
    $currencies['KRW'] = array(0,'',',');           //  South Korea, Won
    $currencies['SZL'] = array(2,'.',', ');         //  Swaziland, Lilangeni
    $currencies['SEK'] = array(2,',','.');          //  Swedish Krona
    $currencies['CHF'] = array(2,'.','\'');         //  Swiss Franc
    $currencies['TZS'] = array(2,'.',',');          //  Tanzanian Shilling
    $currencies['THB'] = array(2,'.',',');          //  Thailand, Baht
    $currencies['TOP'] = array(2,'.',',');          //  Tonga, Paanga
    $currencies['AED'] = array(2,'.',',');          //  UAE Dirham
    $currencies['UAH'] = array(2,',',' ');          //  Ukraine, Hryvnia
    $currencies['USD'] = array(2,'.',',');          //  US Dollar
    $currencies['VUV'] = array(0,'',',');           //  Vanuatu, Vatu
    $currencies['VEF'] = array(2,',','.');          //  Venezuela Bolivares Fuertes
    $currencies['VEB'] = array(2,',','.');          //  Venezuela, Bolivar
    $currencies['VND'] = array(0,'','.');           //  Viet Nam, Dong
    $currencies['ZWD'] = array(2,'.',' ');          //  Zimbabwe Dollar

    return number_format($floatcurr,$currencies[$curr][0],$currencies[$curr][1],$currencies[$curr][2]);

}
function get_encloser($id){

    $ci=& get_instance();
    $ci->load->database();

    $ci->db->select('name');
    $query = $ci->db->get_where('ref_enclosure',array('id'=>$id));
    return $query->row()->name;
}
function get_subcategory_list($category_id,$subcat_id){
     $CI=& get_instance();
     $CI->load->model('billprocess_model');
     $subcategory=$CI->billprocess_model->get_parameter_data_array('service_sub_category','name','id','name',array('service_cat_id'=>$category_id,'sts' =>1));
     $option='';
    if(isset($subcategory)){
        foreach($subcategory as $key => $value){
            if(isset($subcat_id) && $subcat_id==$key){
                $option .='<option selected="selected" value="'.@$key.'" >'.@$value.'</option>';
            }
            else
                $option .='<option  value="'.@$key.'" >'.@$value.'</option>';

       }
    }
   return $option;
}

function number_format_custom($amount){
    $format=formatcurrency($amount, "BDT");
   return  isset($format)?$format:$amount;
}

function num2words($amountcon)
{
    $NO_A=explode(".",$amountcon);
    //$NO_A = explode(",",$NO_A);
    if (count($NO_A)==1){$part1=$NO_A[0]; $part2=0;
    return 'Taka '.convert_number($part1).'';
    }else if (count($NO_A)==2 && ($NO_A[1]==0 || $NO_A[1]=='00')){$part1=$NO_A[0]; $part2=$NO_A[1];
    return 'Taka '.convert_number($part1).'';
    }else{$part1=$NO_A[0]; $part2=$NO_A[1];
    return 'Taka '.convert_number($part1).' and Paisa '.convert_number($part2).'';
    }
}

function convert_number($number)
{
    if (($number < 0) || ($number > 99999999999999))
    {
        return "$number";
    }

   // $Gn = floor($number / 1000000);  //Millions (giga)
   // $number -= $Gn * 1000000;

    $Gn = floor($number / 10000000);
    $number -= $Gn * 10000000;
    $lukn = floor($number / 100000);  //luk (giga)
   $number -= $lukn * 100000;

    $kn = floor($number / 1000);     /* Thousands (kilo) */
    $number -= $kn * 1000;
    $Hn = floor($number / 100);      /* Hundreds (hecto) */
    $number -= $Hn * 100;
    $Dn = floor($number / 10);       /* Tens (deca) */
    $n = (int)$number % 10;               /* Ones */

    $res = "";

    /*if ($Gn)
    {
        $res .= convert_number($Gn) . " Million";
    } */
    if ($Gn)
    {
        $res .= convert_number($Gn) . " Crore";
    }
    if ($lukn)
    {
        $res .= (empty($res) ? "" : " ") .
            convert_number($lukn) . " Lac";
    }

    if ($kn)
    {
        $res .= (empty($res) ? "" : " ") .
            convert_number($kn) . " Thousand";
    }

    if ($Hn)
    {
        $res .= (empty($res) ? "" : " ") .
            convert_number($Hn) . " Hundred";
    }

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six",
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen",
        "Nineteen");
    $tens = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty",
        "Seventy", "Eighty" , "Ninety");

    if ($Dn || $n)
    {
        if (!empty($res))
        {
            $res .= " ";
        }

        if ($Dn < 2)
        {
            $res .= $ones[$Dn * 10 + $n];
        }
        else
        {
            $res .= $tens[$Dn];

            if ($n)
            {
                $res .= "-" . $ones[$n];
            }
        }
    }

    if (empty($res))
    {
        $res = "zero";
    }

    return $res;
}
function addOrdinalNumberSuffix($num) {
  if (!in_array(($num % 100),array(11,12,13))){
    switch ($num % 10) {
      // Handle 1st, 2nd, 3rd
      case 1:  return $num.'st';
      case 2:  return $num.'nd';
      case 3:  return $num.'rd';
    }
  }
  return $num.'th';
}

function xl_col($num=null){
    $arr=array(
        0=>'A',
        1=>'B',
        2=>'C',
        3=>'D',
        4=>'E',
        5=>'F',
        6=>'G',
        7=>'H',
        8=>'I',
        9=>'J',
        10=>'K',
        11=>'L',
        12=>'M',
        13=>'N',
        14=>'O',
        15=>'P',
        16=>'Q',
        17=>'R',
        18=>'S',
        19=>'T',
        20=>'U',
        21=>'V',
        22=>'W',
        23=>'X',
        24=>'Y',
        25=>'Z',
    );
    $a=(int) ($num/26);
    $b=$num%26;
    if($a>0){
        return $arr[$a-1].$arr[$b];
    }else{
        return $arr[$b];
    }
    
}

class Number_format {
   
    public $first=["","GK", "`yB", "wZb", "Pvi", "cvuP", "Qq", "mvZ", "AvU", "bq", "`k", "GMv‡iv", "ev‡iv", "†Z‡iv", "‡PŠÏ", "c‡b‡iv", "†lv‡jv", "m‡Z‡iv", "AvVv‡iv", "Dwbk", "wek", "GKzk", "evBk", "†ZBk", "PweŸk", "cuwPk", "QvweŸk", "mvZvk", "AvUvk", "EbwÎk", "wÎk", "GKwÎk", "ewÎk", "†ZwÎk", "†PŠwÎk", "cuqwÎk", "QwÎk", "mvuBwÎk", "AvUwÎk", "EbPwjøk", "Pwjøk", "GKPwjøk", "weqvwjøk", "†ZZvwjøk", "Pzqvwjøk", "cuqZvwjøk", "‡QPwjøk", "mvZPwjøk", "AvUPwjøk", "EbcÂvk", "cÂvk", "GKvb", "evnvb", "wZàvb", "Pzqvb", "cÂvb", "Qvàvb", "mvZvb", "AvUvb", "EblvU", "lvU", "GKlwÆ", "evlwÆ", "†ZlwÆ", "†PŠlwÆ", "cuqlwÆ", "†QlwÆ", "mvZlwÆ", "AvUlwÆ", "EbmËi", "mËi", "GKvËi", "evnvËi", "wZqvËi", "PzqvËi", "cuPvËi", "wQqvËi", "mvZvËi", "AvUvËi", "EbAvwk", "Avwk", "GKvwk", "weivwk", "wZivwk", "Pzivwk", "cuPvwk", "wQqvwk", "mvZvwk", "AóAvwk", "EbbeŸB", "beŸB", "GKbeŸB", "weivbeŸB", "wZivbeŸB", "PzivbeŸB", "cuPvbeŸB", "wQqvbeŸB", "mvZvbeŸB", "AvUvbeŸB", "wbivbeŸB"];

    public $first_des=["k~b¨","GK", "`yB", "wZb", "Pvi", "cvuP", "Qq", "mvZ", "AvU", "bq", "`k", "GMv‡iv", "ev‡iv", "†Z‡iv", "‡PŠÏ", "c‡b‡iv", "†lv‡jv", "m‡Z‡iv", "AvVv‡iv", "Dwbk", "wek", "GKzk", "evBk", "†ZBk", "PweŸk", "cuwPk", "QvweŸk", "mvZvk", "AvUvk", "EbwÎk", "wÎk", "GKwÎk", "ewÎk", "†ZwÎk", "†PŠwÎk", "cuqwÎk", "QwÎk", "mvuBwÎk", "AvUwÎk", "EbPwjøk", "Pwjøk", "GKPwjøk", "weqvwjøk", "†ZZvwjøk", "Pzqvwjøk", "cuqZvwjøk", "‡QPwjøk", "mvZPwjøk", "AvUPwjøk", "EbcÂvk", "cÂvk", "GKvb", "evnvb", "wZàvb", "Pzqvb", "cÂvb", "Qvàvb", "mvZvb", "AvUvb", "EblvU", "lvU", "GKlwÆ", "evlwÆ", "†ZlwÆ", "†PŠlwÆ", "cuqlwÆ", "†QlwÆ", "mvZlwÆ", "AvUlwÆ", "EbmËi", "mËi", "GKvËi", "evnvËi", "wZqvËi", "PzqvËi", "cuPvËi", "wQqvËi", "mvZvËi", "AvUvËi", "EbAvwk", "Avwk", "GKvwk", "weivwk", "wZivwk", "Pzivwk", "cuPvwk", "wQqvwk", "mvZvwk", "AóAvwk", "EbbeŸB", "beŸB", "GKbeŸB", "weivbeŸB", "wZivbeŸB", "PzivbeŸB", "cuPvbeŸB", "wQqvbeŸB", "mvZvbeŸB", "AvUvbeŸB", "wbivbeŸB"];
    public $unit=["kZ","nvRvi","jÿ","†KvwU"];
    public $desplace="";
    public $number="";
    function __construct() {
        

    }
    public function get_number($number){
        $num = number_format((float)$number, 2, '.', '');
        //$num=(float)$number;
        //$num=(string)$num;
        $arr  = explode(".",$num);
        $number=$arr[0];
        if($arr[1]>0){
            $this->desplace=$arr[1];
        }

        if(strlen((string) $number)<3){
            return $this->first2deg($number);
        }
        elseif(strlen((string) $number)<4){
            return $this->hundred($number);
        }
        elseif(strlen((string) $number)<6){
            return $this->thousand($number);
        }
        
        elseif(strlen((string) $number)<8){
            return $this->lakh($number);
        }
        elseif(strlen((string) $number)<10){
            return $this->crore($number);
        }elseif(strlen((string) $number)<11){
            return $this->crore($number);
        }

        //$this->desplace='24';
        //echo $this->first2deg($number);
    }
    function dec($ddd){ //Function for Showing Decimal place
        if($ddd!=null){
            if(strlen((string) $ddd)>1){
                return " `kwgK ".$this->first_des[$ddd[0]]." ".$this->first_des[($ddd[1])]." cqmv";
            }
            else if(strlen((string) $ddd)==1){
                return " `kwgK ".$this->first_des[$ddd[0]]." cqmv";
            }
        }
        else {
            return "";
        }
    }
    function first2degred($number){
        $number=(int) $number;
        $number=(string) $number;
        $word=$this->first[$number];
        if($word!=null){
            return $word;
        }
        /*
        else if(word==null && number.length<3){
            word=second[number[0]]+" "+first[number[1]];
            return word;
        }*/

    }
    function first2deg($number){
        $number=(int) $number;
        $number=(string) $number;
        $word=$this->first[$number];
        if($word!=null){
            return $word.$this->dec($this->desplace);
        }elseif($word==null && $this->desplace!=null){
            return $this->dec($this->desplace);;
        }
    }
    //Hundred Start here
    function hundred($number){
        if(strlen((string) $number)==3){
            $subnum=$number[1].$number[2];
                if($number[0]<1){
                    $this->unit[0]="";
                }
                $word= $this->first[$number[0]]." ".$this->unit[0]." ".$this->first2deg($subnum);
                return $word;
            
        }
    }
    //Hundred End here

    //Thousand Start here
    function thousand($number){
        if(strlen((string) $number)==4){
            $subnum=$number[1].$number[2].$number[3];
            if($number[0]<1){
                $this->unit[1]="";
            }
            $word= $this->first[$number[0]]." ".$this->unit[1]." ".$this->hundred($subnum);
            return $word;
        }
        elseif(strlen((string) $number)==5){
            $subnum=$number[2].$number[3].$number[4];
            if ($number[0]!='0') {
                $word= $this->first2degred($number[0].$number[1])." ".$this->unit[1]." ".$this->hundred($subnum);
            }
            elseif($number[1]!='0'){
                $word=$this->first2degred($number[1])." ".$this->unit[1]." ".$this->hundred($subnum);
            }
            else{
                $word=$this->hundred($subnum);
            }
            return $word;
        }
    }
    //Thousand End here    

    //Lakh Start here
    function lakh($number){
        if(strlen((string) $number)==6){
            $subnum=$number[1].$number[2].$number[3].$number[4].$number[5];
            if($number[0]<1){
                $this->unit[2]="";
            }
            $word= $this->first[$number[0]]." ".$this->unit[2]." ".$this->thousand($subnum);
            return $word;
        }
        elseif(strlen((string) $number)==7){
            $subnum=$number[2].$number[3].$number[4].$number[5].$number[6];
            if ($number[0]!='0') {
                $word= $this->first2degred($number[0].$number[1])." ".$this->unit[2]." ".$this->thousand($subnum);
            }
            elseif($number[1]!='0'){
                $word= $this->first2degred($number[1])." ".$this->unit[2]." ".$this->thousand($subnum);
            }
            else{
                $word=$this->thousand($subnum);
            }
            return $word;
        }
    }
    //Lakh End here

    //Crore Start here
    function crore($number){

        if(strlen((string) $number)==8){
            $subnum=$number[1].$number[2].$number[3].$number[4].$number[5].$number[6].$number[7];
            $word= $this->first[$number[0]]." ".$this->unit[3]." ".$this->lakh($subnum);
            return $word;
        }
        elseif(strlen((string) $number)==9){
            $subnum=$number[2].$number[3].$number[4].$number[5].$number[6].$number[7].$number[8];
            $word= $this->first2degred($number[0].$number[1])." ".$this->unit[3]." ".$this->lakh($subnum);
            return $word;
        }elseif(strlen((string) $number)==10){
            $subnum=$number[3].$number[4].$number[5].$number[6].$number[7].$number[8].$number[9];
            $word= $this->first[$number[0]]." ".$this->unit[0]." ".$this->first2degred($number[1].$number[2])." ".$this->unit[3]." ".$this->lakh($subnum);
            return $word;
        }
    }
    //Crore End here

}

function multi_selected_query_maker($data,$column_name)
{
    if($data=='' || $column_name=='')
    {
        return '';
    }
    $data_array = explode(",",$data);
    if(count($data_array)>1)
    {
        $str = " AND (";
        for ($i=0; $i < count($data_array); $i++) { 
            if($i==count($data_array)-1)
            {
                $str.="FIND_IN_SET('".$data_array[$i]."',$column_name))";
            }
            else
            {
                $str.="FIND_IN_SET('".$data_array[$i]."',$column_name) OR ";
            }
        }
        return  $str;
    }
    else
    {
        return " AND FIND_IN_SET('".$data."',$column_name)";
    }
}

function multi_selected_query_maker_2($data,$column_name)
{
    if($data=='' || $column_name=='')
    {
        return '';
    }
    $data_array = explode(",",$data);
    if(count($data_array)>1)
    {
        $str = "(";
        for ($i=0; $i < count($data_array); $i++) { 
            if($i==count($data_array)-1)
            {
                $str.="FIND_IN_SET('".$data_array[$i]."',$column_name))";
            }
            else
            {
                $str.="FIND_IN_SET('".$data_array[$i]."',$column_name) OR ";
            }
        }
        return  $str;
    }
    else
    {
        return " FIND_IN_SET('".$data."',$column_name)";
    }
}

function check_group($group_id)
{
    $ci=& get_instance();
    if($group_id=='')
    {
        return false;
    }
    if(isset($ci->session->userdata['ast_user']['user_work_group_id']))
    {
        $data_array = explode(",",$ci->session->userdata['ast_user']['user_work_group_id']);
        if(empty($data_array))
        {
            return false;
        }
        if (in_array($group_id, $data_array))
        {
            return true;
        }
    }
    return false;
}

function check_group_by_array($group_array)
{
    $ci=& get_instance();
    if(!is_array($group_array))
    {
        return false;
    }
    if(empty($group_array))
    {
        return false;
    }
    if(isset($ci->session->userdata['ast_user']['user_work_group_id']))
    {
        $data_array = explode(",",$ci->session->userdata['ast_user']['user_work_group_id']);
        for ($i=0; $i < count($group_array); $i++) { 
            if (in_array($group_array[$i], $data_array))
            {
                return true;
            }
        }
    }
    return false;
}
function user_group_condition_maker($user_group_ids,$column_name)
{
    if($user_group_ids=='' || $column_name=='')
    {
        return "";
    }
    $array = explode(",",$user_group_ids);
    if(empty($array))
    {
        return "";
    }
    else
    {
        $str="(";
        for ($i=0; $i < count($array); $i++) { 
            if($i==count($array)-1)
            {
                $str.=" FIND_IN_SET(".$array[$i].",$column_name))";
            }
            else
            {
                $str.=" FIND_IN_SET(".$array[$i].",$column_name) OR";
            }
        }
        return $str;
    }
    return "";
}
function convert_number_bangla($number) { 
    $apple = new Number_format();
    return $r=$apple->get_number($number);
}


?>
