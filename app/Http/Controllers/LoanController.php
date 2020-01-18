<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\LoanHeader;
use App\LoanLine;
use DB;

class LoanController extends Controller
{
    public function __construct()
    {
        DB::enableQueryLog();
        // return response()->json(DB::getQueryLog());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loan_header = LoanHeader::where(['header_status'=>'active'])->get();
        return view('pages.home', ['loan_header' => $loan_header]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'loan_amount' => 'required|integer',
            'loan_term' => 'required|min:1|max:50',
            'interest_rate' => 'required|min:1|max:36}digits_between:0,2',
            'start_date' => 'required'
        ]);

        $p = $request->loan_amount;
        $r = $request->interest_rate;
        $y = $request->loan_term;
        $start_date = $request->start_date.'-01';

        $header = LoanHeader::create([
            'loan_amount' => $p,
            'loan_term' => $y,
            'interest_rate' => $r,
            'start_date' => $start_date,
            'header_status' => 'active',
            'created_by' => Auth::user()->name,
            'updated_by' => Auth::user()->name
        ]);

        $headerId = $header->id;
        $pmt = ($p * ( ($r/100) /12 ) )/ ( 1 - pow(1 + (($r/100)/12),(-12*$y)));
        $balance = $p;

        for($i=0;$i<$y*12;$i++){
            $interest = ($r/100/12) * $balance;
            $principal = $pmt - $interest;
            $balance = $balance - $principal;
            $date = date('Y-m-d', strtotime('+'.($i+1).' month', strtotime($start_date )));
            $line = LoanLine::create([
                'loan_header_id' => $headerId,
                'line_no' => $i+1,
                'date' => $date,
                'payment_amount' => $pmt,
                'principal' => $principal,
                'interest' => $interest,
                'balance' => $balance,
                'line_status' => 'active',
                'created_by' => Auth::user()->name,
                'updated_by' => Auth::user()->name
            ]);
        }
        return redirect()->route('loan.show', ['id' => $headerId])->with('alert', 'The loan has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loan_header = LoanHeader::findOrFail($id);
        $loan_line = LoanLine::where(['loan_header_id'=>$id, 'line_status'=>'active'])->get();
        return view('pages.show', ['loan_header' => $loan_header, 'loan_line' => $loan_line,]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loan_header = LoanHeader::findOrFail($id);
        return view('pages.edit', ['loan_header' => $loan_header]);
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
        $validatedData = $request->validate([
            'loan_amount' => 'required|integer',
            'loan_term' => 'required|min:1|max:50',
            'interest_rate' => 'required|min:1|max:36}digits_between:0,2',
            'start_date' => 'required'
        ]);

        $p = $request->loan_amount;
        $r = $request->interest_rate;
        $y = $request->loan_term;
        $start_date = $request->start_date.'-01';

        $header = LoanHeader::find($id);
        $header->loan_amount = $p;
        $header->loan_term = $y;
        $header->interest_rate = $r;
        $header->start_date = $start_date;
        $header->updated_by = Auth::user()->name;
        $header->save();

        $line = LoanLine::where('loan_header_id', $id)
                    ->update(['line_status' => 'deleted']);

        $pmt = ($p * ( ($r/100) /12 ) )/ ( 1 - pow(1 + (($r/100)/12),(-12*$y)));
        $balance = $p;

        for($i=0;$i<$y*12;$i++){
            $interest = ($r/100/12) * $balance;
            $principal = $pmt - $interest;
            $balance = $balance - $principal;
            $date = date('Y-m-d', strtotime('+'.($i+1).' month', strtotime($start_date )));
            $line = LoanLine::create([
                'loan_header_id' => $id,
                'line_no' => $i+1,
                'date' => $date,
                'payment_amount' => $pmt,
                'principal' => $principal,
                'interest' => $interest,
                'balance' => $balance,
                'line_status' => 'active',
                'created_by' => Auth::user()->name,
                'updated_by' => Auth::user()->name
            ]);
        }
        return redirect()->route('loan.show', ['id' => $id])->with('alert', 'The loan has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $header = LoanHeader::findOrFail($id);
        $header->header_status = 'deleted';
        $header->updated_by = Auth::user()->name;
        $header->save();        
        
        $line = LoanLine::where('loan_header_id', $id)->update(['line_status' => 'deleted']);
        return redirect()->route('loan')->with('alert', 'The loan has been deleted successfully.');;
    }
}
