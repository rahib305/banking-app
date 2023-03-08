<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statement;
class StatementController extends Controller
{
    public function Index() {
        $statements = Statement::where('user_id', auth()->user()->id)
                        ->orderBy('id', 'desc')
                        ->paginate('5');
        return view('statement', compact('statements'));
    }
}
