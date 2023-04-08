<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestNDS;
use App\Models\ModelNDS;
use Illuminate\Support\Facades\Storage;

class CtrlNDS extends Controller
{
    public function indexAdminNDS()
    {
        try {
            $notes_de_service = ModelNDS::whereNull('deleted_at')->get();
        } catch (\Exception $e) {
            return view('indexAdminNDS')->with('error', 'Désolé, la base de donnée n\'est pas disponible.')
                ->with('notes_de_service', []);
        }

        return view('indexAdminNDS', ['notes_de_service' => $notes_de_service]);
    }

    public function indexNDS()
    {
        try {
            $notes_de_service = ModelNDS::whereNull('deleted_at')->get();
        } catch (\Exception $e) {
            return view('indexNDS')->with('error', 'Désolé, la base de donnée n\'est pas disponible.')
                ->with('notes_de_service', []);
        }

        return view('indexNDS', ['notes_de_service' => $notes_de_service]);
    }

    public function afficherFormulaireNDS()
    {
        return view('formulaireNDS');
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
            $note_de_service->save();
        } catch (\Exception $e) {
            return view('indexAdminNDS')->with('error', 'Désolé, la base de donnée n\'est pas disponible.')
            ->with('notes_de_service', []);
        }

        return redirect('/admin')->with('success', 'La note de service "' . $note_de_service->titre . '" a été ajoutée avec succès.');
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
            $note_de_service->save();
        } catch (\Exception $e) {
            return view('indexAdminNDS')->with('error', 'Désolé, la base de donnée n\'est pas disponible.')
            ->with('notes_de_service', []);
        }

        return redirect('/admin')->with('success', 'La note de service "' . $note_de_service->titre . '" a été modifiée avec succès.');
    }
    public function selectNDS($id)
    {
        try {
            $note_de_service = ModelNDS::findOrFail($id);
        } catch (\Exception $e) {
            return view('indexAdminNDS')->with('error', 'Désolé, la base de donnée n\'est pas disponible.')
            ->with('notes_de_service', []);
        }

        return view('formulaireNDS', ['note_de_service' => $note_de_service]);
    }

    public function updateNDS($id, RequestNDS $request)
    {
        try {
            $note_de_service = ModelNDS::findOrFail($id);
        } catch (\Exception $e) {
            return view('indexAdminNDS')->with('error', 'Désolé, la base de donnée n\'est pas disponible.')
            ->with('notes_de_service', []);
        }

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

        return redirect('/admin')->with('success', 'La note de service a été modifiée avec succès.');
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
        return redirect('/admin')->with('success', 'La note de service "' . $note_de_service->titre . '" a été supprimée avec succès.');
    }
}