<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentUploadController extends Controller
{
   public function upload_document(Request $request)
    {
        // validate data for upload
        $request->validate([
            'document_file' => 'required|file|mimes:pdf,jpg,jpeg,png,gif|max:5120',
            // 'document_name' => 'required|string|max:255',
            'document_type' => 'required|string'
        ]);
        
        // process and upload file
        $file = $request->file('document_file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('documents', $filename, 'public');
        
        // Save Document to database 
        $document = Document::create([
            'patient_id' => $request->patient_id,
            'opd_number' => $request->opd_number,
            // 'user_id' => auth()->user_id(),
            // 'name' => $request->document_name,
            'file_path' => $path,
            'file_name' => $filename,
            'file_type' => $file->getClientOriginalExtension(),
            'file_size' => $file->getSize(),
            'document_type' => $request->document_type,
            'mime_type' => $file->getMimeType(),
            'facility_id' => Auth::user()->facility_id ?? '',
            'user_id' => Auth::user()->user_id ?? '',
            'added_id' => Auth::user()->user_id ?? '',
            'added_by' => Auth::user()->user_fullname ?? '',
            'added_date' => now()->format('Y-m-d'),
            'status' => 'Active',
            'archived' => 'No',
            // 'added_date' => now()
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Document uploaded successfully',
            'document' => $document
        ]);
    }

    public function list()
    {
        $documents = Document::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        $html = view('documents.partials.list', compact('documents'))->render();
        
        return response()->json([
            'html' => $html
        ]);
    }
}
