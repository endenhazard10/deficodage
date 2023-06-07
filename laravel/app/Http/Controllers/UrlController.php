<?php

namespace App\Http\Controllers;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
class UrlController extends Controller
{
    public function url(Request $request){
        $url=$request->url;
        $validator = Validator::make($request->all(), [
        'url' => ['required', 'url'],
        ]);
        if ($validator->fails()) {
        return response()->json(['message'=>'url invalide']);
        }
        $resultat=DB::table('urls')->where('url','=',$url)->get();
        if(count($resultat)==0){
            $short=Url::getUniqueShortUrl();
            $url_final='http://127.0.0.1:8000/'.$short;
            $resultat=new Url;
            $resultat->url=$url;
            $resultat->url_final=$url_final;
            $resultat->shortened=$short;
            $resultat->save();
            return response()->json($resultat,200);

        }
          return response()->json($resultat,200);
    }
    public function shortened($shortened){
      $resultat=DB::table('urls')->where('shortened','=',$shortened)->get();
      if (count($resultat)==0) {
        return response()->json(['message'=>"url n'existe pas"]);
      }
      return Redirect::away($resultat[0]->url);
    }
    public function urlListe(){
      $liste=DB::table('urls')->orderBy('click', 'desc')->get();
      return response()->json($liste,200);
    }
    public function compter(Request $request){
      $clickCount=$request->clickCount;
      $id=$request->id;
      $resultat=DB::table('urls')->where('id','=',$id)->get('click');
      $nombreDeclick=$resultat[0]->click+$clickCount;
      DB::table('urls')->where('id','=',$id)->update(['click'=>$nombreDeclick]);
      return response()->json($nombreDeclick,200);
    }
}
