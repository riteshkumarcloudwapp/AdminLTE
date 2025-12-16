<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;

class PrivacyPolicyController extends Controller
{
    public function privacypolicy(Request $request)
    {
        // If form is submitted
        if ($request->isMethod('POST')) {

            // Validate inputs
            $request->validate([
                'title' => 'required',
                'description' => 'required'
            ]);

            // Fetch first (and only) privacy policy record
            $policy = PrivacyPolicy::first();

            if ($policy) {
                // UPDATE existing record
                $policy->update([
                    'title' => $request->title,
                    'description' => $request->description
                ]);

                return redirect()->back()->with('success', 'Privacy Policy updated successfully!');
            } else {
                // CREATE new record
                PrivacyPolicy::create([
                    'title' => $request->title,
                    'description' => $request->description
                ]);

                return redirect()->back()->with('success', 'Privacy Policy created successfully!');
            }
        }

        // Load page with existing data so it stays after refresh
        $policy = PrivacyPolicy::first();

        return view('admin.pages.privacyPolicy', compact('policy'));
    }
}
