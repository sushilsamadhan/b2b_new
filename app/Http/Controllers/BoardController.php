<?php

namespace App\Http\Controllers;

use App\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Alert;

class BoardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $boards = null;
        if ($request->get('search')) {
            $search = $request->search;
            $boards = Board::where('name', 'like', '%' . $search . '%')
                // ->with('parent')
                ->paginate(10);
        } else {
            $boards = Board::paginate(10);
        }
        return view('module.board.index', compact('boards'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('module.board.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => translate('Board name is required')
        ]);

        $board = new Board();
        $board->name = $request->name;
        
        // $board->slug = Str::slug($request->name);
        $board->board_state = $request->board_state;
        $board->description = $request->description;
        

        //store the icon
        // if ($request->has('icon')) {
        //     $category->icon = $request->icon;
        // }
        $board->save();
        notify()->success(translate('Board created successfully'));
        return back();
        
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $board = Board::find($id);
        // $boards = Board::published()
        //     ->where('parent_category_id', 0)
        //     ->get();
        return view('module.board.edit', compact('board'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        // if (env('DEMO') === "YES") {
        //     Alert::warning('warning', 'This is demo purpose only');
        //     return back();
        //   }
    
            $request->validate([
                'name' => 'required'
            ], [
                'name.required' => translate('Board name is required')
            ]);
    
    
            $update_board = Board::where('id', $request->id)->first();
            $update_board->name = $request->name;
            
            // $board->slug = Str::slug($request->name);
            $update_board->board_state = $request->board_state;
            $update_board->description = $request->description;

            // $update_category->slug = Str::slug($update_category->name) . $update_category->id;
            // $update_category->parent_category_id = $request->parent_category_id ?? 0;
            // $update_category->icon = $request->icon;
            $update_board->save();
    
            notify()->success(translate('Board updated successfully'));
            return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
            Board::where('id', $id)->delete();
            notify()->success(translate('Board deleted successfully'));
            return back();
        
    }
    //published
    public function published(Request $request)
    {

    //     if (env('DEMO') === "YES") {
    //     Alert::warning('warning', 'This is demo purpose only');
    //     return back();
    //   }

        
        $board = Board::where('id', $request->id)->first();
        if ($board->is_published == 1) {
            $board->is_published = 0;
            $board->save();
        } else {
            $board->is_published = 1;
            $board->save();
        }
        return response(['message' => translate('Board active status is changed ')], 200);
    }

    // published
}
