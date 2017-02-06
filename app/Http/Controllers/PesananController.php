<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use  App\Pemesanan;
use Illuminate\Http\Request;
use PDF;

class PesananController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getPesanan()
	{
		$data = Pemesanan::all();
		return view('data')->with('data', $data);
	}

		public function update_reject($id)
	{
		$pemesanan = Pemesanan::find($id);
		$pemesanan->status = "DITOLAK";
		$pemesanan->save();
		return redirect('/admin/pesanan');
	}
		public function update_accept($id)
	{
		$pemesanan = Pemesanan::find($id);
		$pemesanan->status = "DITERIMA";
		$pemesanan->save();
		return redirect('/admin/pesanan');
	}
		public function destroy($id){
			$pemesanan = Pemesanan::find($id);
			$pemesanan->delete();
			return redirect('/admin/pesanan');
		}

		public function search(Request $r)
	{
		$search = $r->input('cari');
		$order = Pemesanan::where('nama','like','%'.$search.'%')->orWhere('no_pesanan','like','%'.$search.'%')->orWhere('email','like','%'.$search.'%')->orWhere('telepon','like','%'.$search.'%')->get();
		return view('data',['data'=>$order]);
	}

	public function report()
	{
		$pemesanan = Pemesanan::orderBy('id','desc')->get();
		$pdf = PDF::loadView('report',['pemesanan'=>$pemesanan]);
		return $pdf->stream();
	}

 	public function bulan()
	{
		return view ('bulan');
	}

}
