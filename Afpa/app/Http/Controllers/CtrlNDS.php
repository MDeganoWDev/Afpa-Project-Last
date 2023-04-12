<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestNDS;
use App\Models\ModelNDS;
use App\Models\Visibilite;
use App\Models\Etat;
use Illuminate\Support\Facades\Storage;

class CtrlNDS extends Controller
{
    public function indexNDS()
    {
        try {
            $notes_de_service = ModelNDS::whereNull('deleted_at')->get();
            $visibilites = Visibilite::all();
            $etats = Etat::all();
        } catch (\Exception $e) {
            return view('indexNDS')->with('error', 'Désolé, la base de donnée n\'est pas disponible.')
                ->with('notes_de_service', []);
        }

        return view('indexNDS', ['notes_de_service' => $notes_de_service, 'visibilites' => $visibilites, 'etats' => $etats]);
    }
    public function indexAdminNDS()
    {
        try {
            $notes_de_service = ModelNDS::whereNull('deleted_at')->get();
            $visibilites = Visibilite::all();
            $etats = Etat::all();
        } catch (\Exception $e) {
            return view('indexAdminNDS')->with('error', 'Désolé, la base de donnée n\'est pas disponible.')
                ->with('notes_de_service', []);
        }

        return view('indexAdminNDS', ['notes_de_service' => $notes_de_service, 'visibilites' => $visibilites, 'etats' => $etats]);
    }


    public function afficherFormulaireNDS()
    {
        try {
        $visibilites = Visibilite::all();
        $etats = Etat::all();
    } catch (\Exception $e) {
        return view('indexAdminNDS')->with('error', 'Désolé, la base de donnée n\'est pas disponible.')
            ->with('notes_de_service', []);
    }

        return view('formulaireNDS', ['visibilites' => $visibilites, 'etats' => $etats]);
    }

    public function nouveauNDS(RequestNDS $request)
    {
        try {
            $pdf = $request->file('pdf');
            $pdfName = $pdf->getClientOriginalName();
            $pdfPath = $pdf->storeAs('public/NDS', $pdfName);

            $note_de_service = new ModelNDS();
            $note_de_service->titre = $request->input('titre');
            $note_de_service->pdf = $pdfPath;
            $note_de_service->auteur = $request->input('auteur');
            $note_de_service->date_creation = $request->input('date_creation');
            $note_de_service->visibilite_id = $request->input('visibilite');
            $note_de_service->etat_id = $request->input('etat');
            $note_de_service->save();
        } catch (\Exception $e) {
            return view('indexAdminNDS')->with('error', 'Désolé, la base de donnée n\'est pas disponible.')
                ->with('notes_de_service', []);
        }

        return redirect('/admin/note_de_services')->with('success', 'La note de service "' . $note_de_service->titre . '" a été ajoutée avec succès.');
    }
    public function selectNDS($id)
    {
        try {
            $note_de_service = ModelNDS::with('visibilite', 'etat')->findOrFail($id);
            $visibilites = Visibilite::all();
            $etats = Etat::all();
        } catch (\Exception $e) {
            return view('indexAdminNDS')->with('error', 'Désolé, la base de donnée n\'est pas disponible.')
                ->with('notes_de_service', []);
        }
    
        return view('formulaireNDS', ['note_de_service' => $note_de_service, 'visibilites' => $visibilites, 'etats' => $etats]);
    }
    public function pageNDS($id)
{
    try {
        $note_de_service = ModelNDS::findOrFail($id);
    } catch (\Exception $e) {
        return view('indexNDS')->with('error', 'Désolé, la base de donnée n\'est pas disponible.')
            ->with('notes_de_service', []);
    }

    return view('pageNDS', ['note_de_service' => $note_de_service]);
}
    
    public function editNDS($id, RequestNDS $request)
    {
        try {
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
            $note_de_service->visibilite_id = $request->input('visibilite');
            $note_de_service->etat_id = $request->input('etat');
            $note_de_service->save();
        } catch (\Exception $e) {
            return view('indexAdminNDS')->with('error', 'Désolé, la base de donnée n\'est pas disponible.')
                ->with('notes_de_service', []);
        }

        return redirect('/admin/note_de_services')->with('success', 'La note de service "' . $note_de_service->titre . '" a été modifiée avec succès.');
    }
    public function softDeleteNDS($id)
    {
        try {
            $note_de_service = ModelNDS::findOrFail($id);
        } catch (\Exception $e) {
            return view('indexAdminNDS')->with('error', 'Désolé, la base de donnée n\'est pas disponible.')
                ->with('notes_de_service', []);
        }

        $note_de_service->delete();
        return redirect('/admin/note_de_services')->with('success', 'La note de service "' . $note_de_service->titre . '" a été supprimée avec succès.');
    }
}