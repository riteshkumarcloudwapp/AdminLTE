<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\TermsAndCondition;


class TermsAndConditionController extends Controller
{
    public function termsandcondition(Request $request)
{

            // If form is submitted
        if ($request->isMethod('POST')) {

            // Validate inputs
            $request->validate([
                'title' => 'required',
                'description' => 'required'
            ]);

            // Fetch first (and only) privacy policy record
            $terms = TermsAndCondition::first();

            if ($terms) {
                // UPDATE existing record
                $terms->update([
                    'title' => $request->title,
                    'description' => $request->description
                ]);

                return redirect()->back()->with('success', 'Terms and Condition updated successfully!');
            } else {
                // CREATE new record
                TermsAndCondition::create([
                    'title' => $request->title,
                    'description' => $request->description
                ]);

                return redirect()->back()->with('success', 'Terms and Condition created successfully!');
            }
        }

        // Load page with existing data so it stays after refresh
        $terms = TermsAndCondition::first();

        return view('admin.pages.termsAndCondition', compact('terms'));


}


}
