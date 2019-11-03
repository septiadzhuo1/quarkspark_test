<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Book;
use App\User;
use Auth;
use Mail;

CONST FROM_EMAIL = 'septiadi.testmail@gmail.com';
CONST FROM_NAME = 'System';

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $Book = Book::all();
        $data = array(
                'book'=>$Book,
            );
        return view('book.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $BookId = Book::max('id')+1;
        $BookId = "BOOKID-".str_pad($BookId, 4, '0', STR_PAD_LEFT);

        $data = array(
                'bookId'=>$BookId,
                'form'=>"create",
            );
        return view('book.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $Book = new Book;

        $BookId = Book::max('id')+1;
        $BookId = "BOOKID-".str_pad($BookId, 4, '0', STR_PAD_LEFT);

        $Book->book_id = $BookId;
        $Book->title = $request->title;
        $Book->author = $request->author;
        $Book->isbn = $request->isbn;
        $Book->publish_date = $request->publish_date;
        $Book->approval_status = "Pending";
        $Book->created_by = Auth::user()->id;
        $Book->save();

        $User = DB::table('users')->where('role', '=', 'admin')->get();

        foreach ($User as $value){
            $to_name = $value->name;
            $to_email = $value->email;
            $subject = "Verification for ".$Book->book_id;
            $fromEmail = FROM_EMAIL;
            $fromUsername = FROM_NAME;

            $data = array('name'=>$value->name, 'body' => $Book->book_id);
            Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email, $subject, $fromEmail, $fromUsername) {
            $message->to($to_email, $to_name)
            ->subject($subject);
            $message->from($fromEmail, $fromUsername);
            });    
        }
        

        return redirect()->route('book.index')->with(['success' => 'Book Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
        $Book = Book::find($id);
        if ($Book == ""){
            return redirect()->route('book.index');
        }
        if (Auth::user()->role == 'user'){
            if (Auth::user()->id != $Book->created_by){
                return redirect()->route('book.index');
            }
        } 
        $data = array(
                'book'=>$Book,
            );
        return view('book.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $Book = Book::find($id);

        if ($Book == ""){
            return redirect()->route('book.index');
        }
        if ($Book->approval_status != "Pending"){
            return redirect()->route('book.index');
        }
        if (Auth::user()->role == 'user'){
            if (Auth::user()->id != $Book->created_by){
                return redirect()->route('book.index');
            }
        } 
        $data = array(
                'book'=>$Book,
                'form'=>"edit",
            );
        return view('book.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $Book = Book::find($id);

        $Book->title = $request->title;
        $Book->author = $request->author;
        $Book->isbn = $request->isbn;
        $Book->publish_date = $request->publish_date;
        $Book->save();

        return redirect()->route('book.index')->with(['success' => 'Book Edited']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $Book = Book::find($id);
        if ($Book == ""){
            return redirect()->route('book.index');
        }
        if (Auth::user()->role == 'user'){
            if (Auth::user()->id != $Book->created_by){
                return redirect()->route('book.index');
            }
        }
        $Book->delete();

        return redirect()->route('book.index')->with(['success' => 'Book Deleted']);
    }

    public function Approval(Request $request){

        if (Auth::user()->role == 'admin'){
            $Book = Book::find($request->id);
            $Book->approval_status = $request->status;
            $Book->approve_by = Auth::user()->id;
            $Book->save();
        }
    }
}
