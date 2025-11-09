<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\email_system_model;
use Illuminate\Support\Facades\Auth;

class email_controller extends Controller
{
    function email_fun()
    {
        $url = url('account/email-process');
        $title = 'Email Form';
        $data = compact('url', 'title');
        return view('emails/email_form')->with($data);
    }

    public function email_data(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'mail_from' => 'nullable',
            'mail_to' => 'required',
            'execution_time' => 'required|date',
            'recurring_days' => 'required|numeric',
            'recurring_end' => 'required|numeric',
            'repetition' => 'nullable',
            'cc' => 'nullable',
            'bcc' => 'nullable',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xlsx,csv,pptx|max:10048',
            'message' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file upload if attachment is present
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $attachmentPath = $attachment->store('attachments', 'public'); // Store the file in the public disk
        }
        // Insert data into mail_system table
        email_system_model::create([
            'mail_from' => $request->input('mail_from'),
            // 'sales_man' => $request->input('sales_man'),
            'mail_to' => $request->input('mail_to'),
            'execution_time' => $request->input('execution_time'),
            'recurring_days' => $request->input('recurring_days'),
            'recurring_end' => $request->input('recurring_end'),
            'repetition' => $request->input('repetition'),
            'cc' => $request->input('cc'),
            'bcc' => $request->input('bcc'),
            'attachment' => $attachmentPath,  // Save file path
            'message' => $request->input('message'),
        ]);

        // Redirect to a success page or back with a success message
        return redirect()->route('email_dashboard')->with('success', 'Mail scheduled successfully!');
    }

    function email_dashboard()
    {
        $user = Auth::user();

        if ($user->name === 'ADM') {
            // Admin sees all emails
            $emails = email_system_model::orderBy('created_at', 'desc')->paginate(10);
        } else {
            // Normal user sees only their own emails
            $emails = email_system_model::where('mail_from', $user->email)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return view('emails.emailDashboard', compact('emails'));
    }

    function email_edit($id)
    {
        $url = url('account/email_edit_process') . "/" . $id;
        $title = 'Edit Form';
        $row = email_system_model::find($id);
        $data = compact('url', 'title', 'row');
        return view('emails/email_form')->with($data);
    }

    function email_edit_process($id, Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'mail_from' => 'nullable',
            'mail_to' => 'required',
            'execution_time' => 'required|date',
            'recurring_days' => 'required|numeric',
            'recurring_end' => 'required|numeric',
            'repetition' => 'nullable',
            'cc' => 'nullable',
            'bcc' => 'nullable',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xlsx,csv,pptx|max:10048',
            'message' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file upload if attachment is present
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $attachmentPath = $attachment->store('attachments', 'public'); // Store the file in the public disk
        }

        // Find the record by ID
        $email = email_system_model::find($id);

        // Check if the record exists
        if (is_null($email)) {
            return back()->with('error', 'Email system record not found');
        }

        // If there is a file uploaded, handle the attachment path
        $attachmentPath = $request->hasFile('attachment') ? $request->file('attachment')->store('attachments') : $email->attachment;
        // Update the record
        $email->update([
            'mail_from' => $request->input('mail_from'),
            // 'sales_man' => $request->input('sales_man'),
            'mail_to' => $request->input('mail_to'),
            'execution_time' => $request->input('execution_time'),
            'recurring_days' => $request->input('recurring_days'),
            'recurring_end' => $request->input('recurring_end'),
            'repetition' => $request->input('repetition'),
            'cc' => $request->input('cc'),
            'bcc' => $request->input('bcc'),
            'attachment' => $attachmentPath,  // Save the file path if new file is uploaded
            'message' => $request->input('message'),
        ]);

        // Redirect to a relevant page with success message
        return redirect()->route('email_dashboard')->with('success', 'Email system record updated successfully!');
    }

    function email_stop($id)
    {
        $email = email_system_model::findOrFail($id);
        $email->status = '0';
        $email->save();
        return redirect()->back()->with('success', 'Email stopped successfully!');
    }

    function email_start($id)
    {
        $email = email_system_model::findOrFail($id);
        $email->status = '1';
        $email->save();
        return redirect()->back()->with('success', 'Email Started successfully!');
    }

    function email_delete($id)
    {
        $email = email_system_model::findOrFail($id);
        $email->delete();
        return redirect()->back()->with('success', 'Email deleted successfully!');
    }
}
