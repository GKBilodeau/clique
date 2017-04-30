<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use League\Csv\Reader;

class PagesController extends Controller
{

		public function index () {

			if (!ini_get("auto_detect_line_endings")) {
    			ini_set("auto_detect_line_endings", '1');
			}
			$csv = Reader::createFromPath('/Users/gregbilodeau/phpdev/mapsheet.csv');
			$csv = preg_replace('/([A-Z]){2}/', '$0,', $csv);
	        $csv = preg_replace('/[A-Z]/', ',$0', $csv,1);
	        $csv = explode(",",$csv);
	        array_shift($csv);
	        array_shift($csv);
	        array_pop($csv);

    	return view('index',compact('csv'));
	}

		public function show ($city,$country) {

			$client = new Client();

			$request1 = $client->get('http://api.openweathermap.org/data/2.5/weather?q='.$city.','.$country.'&&appid=d38ae2ac7da1b5cc8955346c6f3d236a');
			$data1 = $request1->getBody();
			$data1 = json_decode($data1);			
			$request2 = $client->get('http://api.openweathermap.org/data/2.5/forecast?q='.$city.','.$country.'&&appid=d38ae2ac7da1b5cc8955346c6f3d236a');
			$data2 = $request2->getBody();
			$data2 = json_decode($data2);


	        $temps = array();
	        $temps[0] = $data1->main->temp;
	        $temps[1] = $data1->main->temp_max;
	        $temps[2] = $data1->main->temp_min;
	        $name = $data1->name;


			$maxarr = array(0,0,0,0);
	        $minarr = array(350,350,350,350);
	        $date = array(date("Y-m-d"));
	        $data2 = $data2->list;
	        $i = 0;
	        foreach ($data2 as $info) {
	        	$currdate = substr($info->dt_txt,0,-9);
				if ($date[0] !== $currdate) {
		        	if ($date[$i] !== $currdate) {
		        		++$i;
		        		if ($i>4) {
		        			break;
		        		}
		        		$date[$i]=$currdate;
		        	}
		    		if ($info->main->temp_min < $minarr[$i-1]) {
		    			$minarr[$i-1] = $info->main->temp_min;
		    		}
		    		if ($info->main->temp_max > $maxarr[$i-1]) {
		    			$maxarr[$i-1] = $info->main->temp_max;
		    		}
				}
	    	}
	    	

			for($i=0;$i<4;$i++){
				if ($i<3) {
					$temps[$i]=round($temps[$i]*9/5 - 459.67);
				}
				$minarr[$i]=round($minarr[$i]*9/5 - 459.67);
				$maxarr[$i]=round($maxarr[$i]*9/5 - 459.67);
			}

			for($i=0; $i<count($date); $i++) {
				$date[$i] = strtotime($date[$i]);
				$date[$i] =  date('F jS Y', $date[$i]);
			}

    	return view('show',compact('minarr','maxarr','date','temps','name','city','country'));
	}


}
