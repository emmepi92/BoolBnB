<?php

namespace App\Http\Controllers;
use App\Apartment;
use App\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $apartments= Apartment::all();
        $services = Service::all();

        $listServicesArray =[];
        foreach($apartments as $apartment) {
            $apartment->description=$this->cutText($apartment->description);

            $listServices =($apartment->service()->where('apartment_id','=', $apartment->id)->get())->toArray();

            foreach($listServices as $service){
                $listServicesArray[] = $service['id'];               
            }
            $lista[] = $listServicesArray;            
            $listServicesArray=[];

        }

        // dd($lista);

        
        return view('home', compact('apartments','services','lista'));        
      
    }

    public function show($id)
    {
        $apartment= Apartment::find($id);
        return view('apartments.show', compact('apartment'));
        
    }
    
    private function cutText ($text) {
        $cutText = substr($text,0, 190);

        $cutText =  $cutText . "...";
        return $cutText;
    }
}