<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\AdministrativeCollective;
use App\Models\AdministrativeIndividual;
use App\Models\Attachment;
use App\Models\Defendant;
use App\Models\JudicialCollective;
use App\Models\JudicialIndividual;
use App\Models\Lawyer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SingleProccessController extends Controller
{
    public function index()
    {
        $loggedId = auth()->user();

        $judicialCollective = $loggedId->judicialCollectives;
        $judicialIndividual = $loggedId->judicialIndividuals;
        $administrativeCollective = $loggedId->administrativeCollectives;
        $administrativeIndividual = $loggedId->administrativeIndividuals;

        $process = $judicialCollective
            ->concat($judicialIndividual)
            ->concat($administrativeCollective)
            ->concat($administrativeIndividual);


        return view('admin.myProccess.index', [
            'process' => $process,
        ]);
    }

    public function showJudicialCollective(String $id)
    {
        $proccess = JudicialCollective::find($id);

        if ($proccess) {
            $user = $proccess->user;
            $attachment = Attachment::where('judicial_collective_id', $id)->get();
            $judicial = Lawyer::where('judicial_collective_id', $id)->get();
            $defendant = Defendant::where('judicial_collective_id', $id)->get();

            $user_1 = null;
            $user_2 = null;
            $user_3 = null;
            $user_4 = null;

            foreach ($judicial as $judicials) {
                $name_1 = $judicials->email_lawyer_1;
                $id_1 = $judicials->user_id_1;

                $name_2 = $judicials->email_lawyer_2;
                $id_2 = $judicials->user_id_2;

                $name_3 = $judicials->email_lawyer_3;
                $id_3 = $judicials->user_id_3;

                $name_4 = $judicials->email_lawyer_4;
                $id_4 = $judicials->user_id_4;

                if ($id_1) {
                    $user_1 = User::where('id', $id_1)->value('oab');
                }
                if ($id_2) {
                    $user_2 = User::where('id', $id_2)->value('oab');
                }
                if ($id_3) {
                    $user_3 = User::where('id', $id_3)->value('oab');
                }
                if ($id_4) {
                    $user_4 = User::where('id', $id_4)->value('oab');
                }
            }

            $lawData = [
                'lawyer_1' => $user_1 ? $user_1 : null,
                'lawyer_2' => $user_2 ? $user_2 : null,
                'lawyer_3' => $user_3 ? $user_3 : null,
                'lawyer_4' => $user_4 ? $user_4 : null,
            ];

            $data = [$name_1, $name_2, $name_3, $name_4];

            return view('admin.myProccess.details.judicialCollective', [
                'proccess' => $proccess,
                'user' => $user,
                'attachment' => $attachment,
                'data' => $data,
                'lawyer' => $lawData,
                'defendants' => $defendant,
            ]);
        }

        session()->flash('warning', 'Processo não encontrado.');
        return back();
    }

    public function showJudicialIndividual(String $id)
    {
        $proccess = JudicialIndividual::find($id);

        if ($proccess) {
            $user = $proccess->user;
            $attachment = Attachment::where('judicial_individual_id', $id)->get();
            $judicial = Lawyer::where('judicial_individual_id', $id)->get();
            $defendant = Defendant::where('judicial_individual_id', $id)->get();

            $user_1 = null;
            $user_2 = null;
            $user_3 = null;
            $user_4 = null;

            foreach ($judicial as $judicials) {
                $name_1 = $judicials->email_lawyer_1;
                $id_1 = $judicials->user_id_1;

                $name_2 = $judicials->email_lawyer_2;
                $id_2 = $judicials->user_id_2;

                $name_3 = $judicials->email_lawyer_3;
                $id_3 = $judicials->user_id_3;

                $name_4 = $judicials->email_lawyer_4;
                $id_4 = $judicials->user_id_4;

                if ($id_1) {
                    $user_1 = User::where('id', $id_1)->value('oab');
                }
                if ($id_2) {
                    $user_2 = User::where('id', $id_2)->value('oab');
                }
                if ($id_3) {
                    $user_3 = User::where('id', $id_3)->value('oab');
                }
                if ($id_4) {
                    $user_4 = User::where('id', $id_4)->value('oab');
                }
            }

            $lawData = [
                'lawyer_1' => $user_1 ? $user_1 : null,
                'lawyer_2' => $user_2 ? $user_2 : null,
                'lawyer_3' => $user_3 ? $user_3 : null,
                'lawyer_4' => $user_4 ? $user_4 : null,
            ];

            $data = [$name_1, $name_2, $name_3, $name_4];

            return view('admin.myProccess.details.judicialIndividual', [
                'proccess' => $proccess,
                'user' => $user,
                'attachment' => $attachment,
                'data' => $data,
                'lawyer' => $lawData,
                'defendants' => $defendant,
            ]);
        }

        session()->flash('warning', 'Processo não encontrado.');
        return back();
    }

    public function showAdmCollective(String $id)
    {
        $proccess = AdministrativeCollective::find($id);

        if ($proccess) {
            $user = $proccess->user;
            $attachment = Attachment::where('administrative_collective_id', $id)->get();
            $judicial = Lawyer::where('administrative_collective_id', $id)->get();
            $defendant = Defendant::where('administrative_collective_id', $id)->get();

            $user_1 = null;
            $user_2 = null;
            $user_3 = null;
            $user_4 = null;

            foreach ($judicial as $judicials) {
                $name_1 = $judicials->email_lawyer_1;
                $id_1 = $judicials->user_id_1;

                $name_2 = $judicials->email_lawyer_2;
                $id_2 = $judicials->user_id_2;

                $name_3 = $judicials->email_lawyer_3;
                $id_3 = $judicials->user_id_3;

                $name_4 = $judicials->email_lawyer_4;
                $id_4 = $judicials->user_id_4;

                if ($id_1) {
                    $user_1 = User::where('id', $id_1)->value('oab');
                }
                if ($id_2) {
                    $user_2 = User::where('id', $id_2)->value('oab');
                }
                if ($id_3) {
                    $user_3 = User::where('id', $id_3)->value('oab');
                }
                if ($id_4) {
                    $user_4 = User::where('id', $id_4)->value('oab');
                }
            }

            $lawData = [
                'lawyer_1' => $user_1 ? $user_1 : null,
                'lawyer_2' => $user_2 ? $user_2 : null,
                'lawyer_3' => $user_3 ? $user_3 : null,
                'lawyer_4' => $user_4 ? $user_4 : null,
            ];

            $data = [$name_1, $name_2, $name_3, $name_4];

            return view('admin.myProccess.details.admCollective', [
                'proccess' => $proccess,
                'user' => $user,
                'attachment' => $attachment,
                'data' => $data,
                'lawyer' => $lawData,
                'defendants' => $defendant,
            ]);
        }

        session()->flash('warning', 'Processo não encontrado.');
        return back();
    }

    public function showAdmIndividual(String $id)
    {
        $proccess = AdministrativeIndividual::find($id);

        if ($proccess) {
            $user = $proccess->user;
            $attachment = Attachment::where('administrative_individual_id', $id)->get();
            $judicial = Lawyer::where('administrative_individual_id', $id)->get();
            $defendant = Defendant::where('administrative_individual_id', $id)->get();

            $user_1 = null;
            $user_2 = null;
            $user_3 = null;
            $user_4 = null;

            foreach ($judicial as $judicials) {
                $name_1 = $judicials->email_lawyer_1;
                $id_1 = $judicials->user_id_1;

                $name_2 = $judicials->email_lawyer_2;
                $id_2 = $judicials->user_id_2;

                $name_3 = $judicials->email_lawyer_3;
                $id_3 = $judicials->user_id_3;

                $name_4 = $judicials->email_lawyer_4;
                $id_4 = $judicials->user_id_4;

                if ($id_1) {
                    $user_1 = User::where('id', $id_1)->value('oab');
                }
                if ($id_2) {
                    $user_2 = User::where('id', $id_2)->value('oab');
                }
                if ($id_3) {
                    $user_3 = User::where('id', $id_3)->value('oab');
                }
                if ($id_4) {
                    $user_4 = User::where('id', $id_4)->value('oab');
                }
            }

            $lawData = [
                'lawyer_1' => $user_1 ? $user_1 : null,
                'lawyer_2' => $user_2 ? $user_2 : null,
                'lawyer_3' => $user_3 ? $user_3 : null,
                'lawyer_4' => $user_4 ? $user_4 : null,
            ];

            $data = [$name_1, $name_2, $name_3, $name_4];

            return view('admin.myProccess.details.admIndividual', [
                'proccess' => $proccess,
                'user' => $user,
                'attachment' => $attachment,
                'data' => $data,
                'lawyer' => $lawData,
                'defendants' => $defendant,
            ]);
        }

        session()->flash('warning', 'Processo não encontrado.');
        return back();
    }

    public function downloadAttachment(String $id)
    {
        $attachment = Attachment::find($id);

        $path = $attachment->path;
        $fileName = $attachment->title;

        if (Storage::exists($path)) {
            return Storage::download($path, $fileName);
        }

        session()->flash('warning', 'Anexo não encontrado. Delete esse anexo e insira de novo.');
        return redirect()->back();
    }
}
