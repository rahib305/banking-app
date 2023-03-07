<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statement;
class StatementController extends Controller
{
    public function Index() {
        $statements = Statement::paginate('5');
        return view('statement', compact('statements'));
    }
}
