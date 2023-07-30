<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\{StoreContactRequest, UpdateContactRequest};
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:contact view')->only('index', 'show');
        $this->middleware('permission:contact delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $contacts = Contact::with('employee:id,nama_karyawan');
            return DataTables::of($contacts)
                ->addColumn('employee', function ($row) {
                    return $row->employee ? $row->employee->nama_karyawan : '';
                })->addColumn('action', 'contacts.include.action')
                ->toJson();
        }

        return view('contacts.index');
    }

    public function show(Contact $contact)
    {
        $contact->load('employee:id,nik');

		return view('contacts.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        try {
            $contact->delete();

            return redirect()
                ->route('contacts.index')
                ->with('success', __('The contact was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('contacts.index')
                ->with('error', __("The contact can't be deleted because it's related to another table."));
        }
    }
}
