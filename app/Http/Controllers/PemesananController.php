<?php namespace App\Http\Controllers;

use App\Http\Requests;
// use Str
use App\Http\Controllers\Controller;
use App\Pemesanan;
use Validator;
use Redirect;
use Input;
use Illuminate\Http\Request;

class PemesananController extends Controller {

	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function submit(Request $r)
	{

		// $this->validate($r, [
		// ]);
		$response = [];
		$r->telp = str_replace("_", null, $r->input('telp'));
		$r->telp = str_replace("-", null, $r->telp);

		$pesan = $r->all();
		$pesan['telp'] = $r->telp;

		$telepon = str_replace(['_','-'],['',''],Input::get('telp'));
		// dd(str_replace(['_','-'],['',''],Input::get('telp')));

		// die();


		// echo $r->telp;
		if (strlen($telepon)<12) {
			$response['success'] = false;
			$response['error_msg'] = 'Masukan data yang benar !';
			return response()->json($response);
		}

    	else{
			$validator = Validator::make($r->all(), 	[
		        'nama' => 'required|max:255|',
		        'alamat' => 'required|max:255',
		        // 'telp' => 'required|max:255|min:12',
		        'hari' => 'required|max:255',
		        'email' => 'required|max:255',
		        // 'gambar_pesanan' => 'required|max:255',
		        'pukul' => 'required|max:255',
	    	]);

	    	if ($validator->fails()) {
	    		// if (strlen($telepon)<12) {
	    		// 	// echo "validator";
	    		// 	dd($telepon);
	    		// }
	    		// echo "asu";
				$response['success'] = false;
				$response['error_msg'] = 'Data masih ada yang kosong.';
	    		return response()->json($response);
	    	}    		
    	}
    	// if ($validator->fails()) {
     //        return redirect('pesan')
     //                  ->withErrors($validator)
     //                  ->withInput();
     //    }



		$data = new Pemesanan;
		$data->nama = Input::get('nama');
		$data->alamat = Input::get('alamat');
		$data->telepon = $telepon;
		$data->hari = Input::get('hari');
		$data->pukul = Input::get('pukul');
		$data->email = Input::get('email');
		$data->no_pesanan = str_random(8);
		$data->status = 'pending';

		// if(Input::hasFile('gambar_pesanan')){
		// 	$gambar = date("YmdHis").uniqid().".".Input::file('gambar_pesanan')->getClientOriginalExtension();
		// 	Input::file('gambar_pesanan')->move(storage_path(),$gambar);
		// 	$data->gambar_pemesanan = $gambar;
		// }
		
		// EMAIL
		$email = Input::get('email');
		$subject = "Tatto Henna";
		$message = 
		"Nama Pemesan: ".$data->nama."<br>".
		"<b>*Copy nomor pesanan anda</b><br>".
		"No. Pesanan: ".$data->no_pesanan."<br>".
		"Klik <a href='".url('order')."'>disini</a> untuk mengecek orderan anda!";
		// echo $data->no_pesanan;
		//////////////////////////////////////////

		// echo "string";
		// die();
		$base64_photo = Input::get('image');
		list($type,$base64_photo) = explode(';',$base64_photo);
        list(,$base64_photo) = explode(',',$base64_photo);
        $base64_photo = base64_decode($base64_photo);
        $image = round(microtime(true));
        file_put_contents(storage_path().'/'.$image.'.'.Input::get('mime'),$base64_photo);

        $data->gambar_pemesanan = $image.'.'.Input::get('mime');


		$data->save();

		$nomor_pesanan = Pemesanan::orderBy('id','desc')->first();
		$success = true;
		try {
			$a = new \PHPMailer(true);
			$a->isSMTP();
			$a->CharSet = "utf-8";
			$a->SMTPAuth = true;
			$a->SMTPSecure = "tls";
			$a->Host = "smtp.gmail.com";
			$a->Port = 587;
			$a->Username = "aroeljhonsons@gmail.com";
			$a->Password = "iwhjrgbsceyhimxa";
			$a->SetFrom("admin@tatto.com", "Admin");
			$a->Subject = $subject;
			$a->MsgHTML($message);
			$a->addAddress($email);
			$a->send();
			return response()->json(compact('nomor_pesanan','success'));
		} catch (Exception $e) {
			dd($e);
		}

	}

}
