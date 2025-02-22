<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Portfolio;


class PortfolioController extends Controller
{
    public function create(){
        return view('portfolio.create');
    }
  
    public function store(Request $request)
    {
       
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'url' => 'required|url',
            'description' => 'nullable|string',
        ]);

        $imagePath = $request->file('image')->store('portfolio_images', 'public');

       
        Portfolio::create([
            'title' => $request->title,
            'image' => $imagePath,  
            'url' => $request->url,
            'description'=>$request->description,
        ]);

        return redirect()->route('portfolio.admin.index')->with('success', 'Portfolio created successfully!');
    }

    public function show()
    {
        $portfolios = Portfolio::all();
        return view('portfolio.index', compact('portfolios'));
    }
    public function edit($id)
    {
        $portfolios= Portfolio::findOrFail($id);
         return view('portfolio.edit', compact('portfolios'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'url' => 'required|url',
            'description' => 'nullable|string',
        ]);
        
    
        $portfolios = Portfolio::findOrFail($id);
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('portfolio_images', 'public');
            $portfolios->image = $imagePath;
        }
    
        $portfolios->title = $request->title;
        $portfolios->url = $request->url;
        $portfolios->description = $request->description;
        $portfolios->save();
    
        return redirect()->route('portfolio.admin.index')->with('success', 'Portfolio updated successfully!');
    }
    public function destroy($id){
        $portfolios = Portfolio::findOrFail($id);
        $portfolios->delete();
        return redirect()->route('portfolio.admin.index')->with('success', 'Portfolio deleted successfully!');
    }
    public function index()
    {
        $portfolios = Portfolio::all(); 
    
    
         return view('public.portfolio', compact('portfolios'));
    
    
    }
}
