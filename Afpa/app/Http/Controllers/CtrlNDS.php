<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestNDS;
use App\Models\ModelNDS;
use Illuminate\Support\Facades\Storage;

class CtrlNDS extends Controller
{
    public function indexNDS()
    {
        $notes_de_service = ModelNDS::whereNull('deleted_at')->get();
        return view('indexNDS', ['notes_de_service' => $notes_de_service]);
    }
      
    public function indexAdminNDS()
    {
        $notes_de_service = ModelNDS::whereNull('deleted_at')->get();
        return view('indexAdminNDS', ['notes_de_service' => $notes_de_service]);
    }

    public function afficherFormulaireNDS()
    {
        return view('formulaireNDS');
    }
    public function selectNDS($id)
    {
        $note_de_service = ModelNDS::findOrFail($id);
        return view('formulaireNDS', ['note_de_service' => $note_de_service]);
    }
    public function nouveauNDS(RequestNDS $request)
    {
        $pdf = $request->file('pdf');
        $pdfName = $pdf->getClientOriginalName();
        $pdfPath = $pdf->storeAs('public/NDS', $pdfName);

        $note_de_service = new ModelNDS();
        $note_de_service->titre = $request->input('titre');
        $note_de_service->pdf = $pdfPath;
        $note_de_service->auteur = $request->input('auteur');
        $note_de_service->date_creation = $request->input('date_creation');
        $note_de_service->save();

        return redirect('/admin/note_de_services')->with('success', 'La note de service "' . $note_de_service->titre . '" a été ajoutée avec succès.');
    }

    public function editNDS($id, RequestNDS $request)
    {
        $note_de_service = ModelNDS::findOrFail($id);

        $pdfPath = $note_de_service->pdf;

        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');
            $pdfName = $pdf->getClientOriginalName();
            $pdfPath = $pdf->storeAs('public/NDS', $pdfName);

            Storage::delete($note_de_service->pdf);
        }

        $note_de_service->titre = $request->input('titre');
        $note_de_service->pdf = $pdfPath;
        $note_de_service->auteur = $request->input('auteur');
        $note_de_service->date_creation = $request->input('date_creation');
        $note_de_service->save();

        return redirect('/admin/note_de_services')->with('success', 'La note de service "' . $note_de_service->titre . '" a été modifiée avec succès.');
    }

    public function softDeleteNDS($id)
    {
        $note_de_service = ModelNDS::findOrFail($id);
        $note_de_service->delete();
        return redirect('/admin/note_de_services')->with('success', 'La note de service "' . $note_de_service->titre . '" a été supprimée avec succès.');
    }
    
}    