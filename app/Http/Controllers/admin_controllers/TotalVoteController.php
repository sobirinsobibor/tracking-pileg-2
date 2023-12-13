<?php

namespace App\Http\Controllers\admin_controllers;

use App\Models\TotalVote;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTotalVoteRequest;
use App\Http\Requests\UpdateTotalVoteRequest;
use Illuminate\Http\Request;

class TotalVoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pilihkandidattps = $request->input('pilihkandidattps');
        $pilihkandidatdesa = $request->input('pilihkandidatdesa');
        $pilihkandidatkecamatan = $request->input('pilihkandidatkecamatan');
        $pilihkandidatdapil = $request->input('pilihkandidatdapil');
        $pilihtps = $request->input('pilihtps');
        $pilihdesa = $request->input('pilihdesa');
        $pilihkecamatan = $request->input('pilihkecamatan');
        $pilihdapil = $request->input('pilihdapil');
        $listtps = DB::table('voting_places')->get();
        $listdesa = DB::table('sub_districts')->get();
        $listkecamatan = DB::table('districts')->get();
        $listdapil = DB::table('electoral_districts')->get();

        if ($pilihkandidattps != null) {
            $idkandidattpspilihan = $pilihkandidattps;
        } else {
            if (!empty($listtps) && isset($listtps[0]->id)) {
                $idkandidattpspilihan = $listtps[0]->id;
            } else {
                $idkandidattpspilihan = 1;
            }
        }

        if ($pilihkandidatdesa != null) {
            $idkandidatdesapilihan = $pilihkandidatdesa;
        } else {
            if (!empty($listdesa) && isset($listdesa[0]->id)) {
                $idkandidatdesapilihan = $listdesa[0]->id;
            } else {
                $idkandidatdesapilihan = 1;
            }
        }

        if ($pilihkandidatkecamatan != null) {
            $idkandidatkecamatanpilihan = $pilihkandidatkecamatan;
        } else {
            if (!empty($listkecamatan) && isset($listkecamatan[0]->id)) {
                $idkandidatkecamatanpilihan = $listkecamatan[0]->id;
            } else {
                $idkandidatkecamatanpilihan = 1;
            }
        }

        if ($pilihkandidatdapil != null) {
            $idkandidatdapilpilihan = $pilihkandidatdapil;
        } else {
            if (!empty($listdapil) && isset($listdapil[0]->id)) {
                $idkandidatdapilpilihan = $listdapil[0]->id;
            } else {
                $idkandidatdapilpilihan = 1;
            }
        }

        if ($pilihtps != null) {
            $idtpspilihan = $pilihtps;
        } else {
            if (!empty($listtps) && isset($listtps[0]->id)) {
                $idtpspilihan = $listtps[0]->id;
            } else {
                $idtpspilihan = 1;
            }
        }

        if ($pilihdesa != null) {
            $iddesapilihan = $pilihdesa;
        } else {
            if (!empty($listdesa) && isset($listdesa[0]->id)) {
                $iddesapilihan = $listdesa[0]->id;
            } else {
                $iddesapilihan = 1;
            }
        }

        if ($pilihkecamatan != null) {
            $idkecamatanpilihan = $pilihkecamatan;
        } else {
            if (!empty($listkecamatan) && isset($listkecamatan[0]->id)) {
                $idkecamatanpilihan = $listkecamatan[0]->id;
            } else {
                $idkecamatanpilihan = 1;
            }
        }

        if ($pilihdapil != null) {
            $iddapilpilihan = $pilihdapil;
        } else {
            if (!empty($listdapil) && isset($listdapil[0]->id)) {
                $iddapilpilihan = $listdapil[0]->id;
            } else {
                $iddapilpilihan = 1;
            }
        }

        $candidatevotestps = DB::table('candidate_votes')->select('candidate_votes.candidate_vote_vote_count', 'candidates.candidate_name')->join('voting_places', 'candidate_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->join('candidates', 'candidate_votes.id_candidate', '=', 'candidates.candidate_encrypted_id')->where('voting_places.id', $idkandidattpspilihan)->get();
        $candidatevotesdesa = DB::table('candidate_votes')->select(DB::raw('SUM(candidate_votes.candidate_vote_vote_count) as total_vote_count'), 'candidates.candidate_name')->groupBy('candidates.candidate_encrypted_id')->join('voting_places', 'candidate_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->join('sub_districts', 'voting_places.id_sub_district', '=', 'sub_districts.sub_district_encrypted_id')->join('candidates', 'candidate_votes.id_candidate', '=', 'candidates.candidate_encrypted_id')->where('sub_districts.id', $idkandidatdesapilihan)->get();
        $candidatevoteskecamatan = DB::table('candidate_votes')->select(DB::raw('SUM(candidate_votes.candidate_vote_vote_count) as total_vote_count'), 'candidates.candidate_name')->groupBy('candidates.candidate_encrypted_id')->join('voting_places', 'candidate_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->join('sub_districts', 'voting_places.id_sub_district', '=', 'sub_districts.sub_district_encrypted_id')->join('districts', 'sub_districts.id_district', '=', 'districts.district_encrypted_id')->join('candidates', 'candidate_votes.id_candidate', '=', 'candidates.candidate_encrypted_id')->where('districts.id', $idkandidatkecamatanpilihan)->get();
        $candidatevotesdapil = DB::table('candidate_votes')->select(DB::raw('SUM(candidate_votes.candidate_vote_vote_count) as total_vote_count'), 'candidates.candidate_name')->groupBy('candidates.candidate_encrypted_id')->join('voting_places', 'candidate_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->join('electoral_districts', 'voting_places.id_electoral_district', '=', 'electoral_districts.electoral_district_encrypted_id')->join('candidates', 'candidate_votes.id_candidate', '=', 'candidates.candidate_encrypted_id')->where('electoral_districts.id', $idkandidatdapilpilihan)->get();
        $partyvotestps = DB::table('total_votes')->select('total_votes.total_vote_vote_count', 'parties.party_name')->join('parties', 'total_votes.id_party', '=', 'parties.party_encrypted_id')->join('voting_places', 'total_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->where('voting_places.id', $idtpspilihan)->get();
        $partyvotesdesa = DB::table('total_votes')->select(DB::raw('SUM(total_votes.total_vote_vote_count) as total_vote_count'), 'parties.party_name')->groupBy('parties.party_encrypted_id')->join('parties', 'total_votes.id_party', '=', 'parties.party_encrypted_id')->join('voting_places', 'total_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->join('sub_districts', 'voting_places.id_sub_district', '=', 'sub_districts.sub_district_encrypted_id')->where('sub_districts.id', $iddesapilihan)->get();
        $partyvoteskecamatan = DB::table('total_votes')->select(DB::raw('SUM(total_votes.total_vote_vote_count) as total_vote_count'), 'parties.party_name')->groupBy('parties.party_encrypted_id')->join('parties', 'total_votes.id_party', '=', 'parties.party_encrypted_id')->join('voting_places', 'total_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->join('sub_districts', 'voting_places.id_sub_district', '=', 'sub_districts.sub_district_encrypted_id')->join('districts', 'sub_districts.id_district', '=', 'districts.district_encrypted_id')->where('districts.id', $idkecamatanpilihan)->get();
        $partyvotesdapil = DB::table('total_votes')->select(DB::raw('SUM(total_votes.total_vote_vote_count) as total_vote_count'), 'parties.party_name')->groupBy('parties.party_encrypted_id')->join('parties', 'total_votes.id_party', '=', 'parties.party_encrypted_id')->join('voting_places', 'total_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->join('electoral_districts', 'voting_places.id_electoral_district', '=', 'electoral_districts.electoral_district_encrypted_id')->where('electoral_districts.id', $iddapilpilihan)->get();
        $tampilnamakandidattps = DB::table('voting_places')->where('id', $idkandidattpspilihan)->first();
        $tampilnamakandidatdesa = DB::table('sub_districts')->where('id', $idkandidatdesapilihan)->first();
        $tampilnamakandidatkecamatan = DB::table('districts')->where('id', $idkandidatkecamatanpilihan)->first();
        $tampilnamakandidatdapil = DB::table('electoral_districts')->where('id', $idkandidatdapilpilihan)->first();
        $tampilnamatps = DB::table('voting_places')->where('id', $idtpspilihan)->first();
        $tampilnamadesa = DB::table('sub_districts')->where('id', $iddesapilihan)->first();
        $tampilnamakecamatan = DB::table('districts')->where('id', $idkecamatanpilihan)->first();
        $tampilnamadapil = DB::table('electoral_districts')->where('id', $iddapilpilihan)->first();

        $labelspertps = [];
        $datapertps = [];
        $labelsperdesa = [];
        $dataperdesa = [];
        $labelsperkecamatan = [];
        $dataperkecamatan = [];
        $labelsperdapil = [];
        $dataperdapil = [];
        $labelspartaipertps = [];
        $datapartaipertps = [];
        $labelspartaiperdesa = [];
        $datapartaiperdesa = [];
        $labelspartaiperkecamatan = [];
        $datapartaiperkecamatan = [];
        $labelspartaiperdapil = [];
        $datapartaiperdapil = [];

        foreach ($candidatevotestps as $tpsdata) {
            $labelspertps[] = $tpsdata->candidate_name;
            $datapertps[] = (int)$tpsdata->candidate_vote_vote_count;
        }

        foreach ($candidatevotesdesa as $desadata) {
            $labelsperdesa[] = $desadata->candidate_name;
            $dataperdesa[] = (int)$desadata->total_vote_count;
        }

        foreach ($candidatevoteskecamatan as $kecamatandata) {
            $labelsperkecamatan[] = $kecamatandata->candidate_name;
            $dataperkecamatan[] = (int)$kecamatandata->total_vote_count;
        }

        foreach ($candidatevotesdapil as $dapildata) {
            $labelsperdapil[] = $dapildata->candidate_name;
            $dataperdapil[] = (int)$dapildata->total_vote_count;
        }

        foreach ($partyvotestps as $partaitpsdata) {
            $labelspartaipertps[] = $partaitpsdata->party_name;
            $datapartaipertps[] = (int)$partaitpsdata->total_vote_vote_count;
        }

        foreach ($partyvotesdesa as $partaidesadata) {
            $labelspartaiperdesa[] = $partaidesadata->party_name;
            $datapartaiperdesa[] = (int)$partaidesadata->total_vote_count;
        }

        foreach ($partyvoteskecamatan as $partaikecamatandata) {
            $labelspartaiperkecamatan[] = $partaikecamatandata->party_name;
            $datapartaiperkecamatan[] = (int)$partaikecamatandata->total_vote_count;
        }

        foreach ($partyvotesdapil as $partaidapildata) {
            $labelspartaiperdapil[] = $partaidapildata->party_name;
            $datapartaiperdapil[] = (int)$partaidapildata->total_vote_count;
        }
        return view('templating.admin-view.perolehan-suara.index', [
            'listtps' => $listtps,
            'listdesa' => $listdesa,
            'listkecamatan' => $listkecamatan,
            'listdapil' => $listdapil,
            'tampilnamakandidattps' => $tampilnamakandidattps,
            'tampilnamakandidatdesa' => $tampilnamakandidatdesa,
            'tampilnamakandidatkecamatan' => $tampilnamakandidatkecamatan,
            'tampilnamakandidatdapil' => $tampilnamakandidatdapil,
            'tampilnamatps' => $tampilnamatps,
            'tampilnamadesa' => $tampilnamadesa,
            'tampilnamakecamatan' => $tampilnamakecamatan,
            'tampilnamadapil' => $tampilnamadapil,
            'labelspertps' => array_values($labelspertps),
            'datapertps' => array_values($datapertps),
            'labelsperdesa' => array_values($labelsperdesa),
            'dataperdesa' => array_values($dataperdesa),
            'labelsperkecamatan' => array_values($labelsperkecamatan),
            'dataperkecamatan' => array_values($dataperkecamatan),
            'labelsperdapil' => array_values($labelsperdapil),
            'dataperdapil' => array_values($dataperdapil),
            'labelspartaipertps' => array_values($labelspartaipertps),
            'datapartaipertps' => array_values($datapartaipertps),
            'labelspartaiperdesa' => array_values($labelspartaiperdesa),
            'datapartaiperdesa' => array_values($datapartaiperdesa),
            'labelspartaiperkecamatan' => array_values($labelspartaiperkecamatan),
            'datapartaiperkecamatan' => array_values($datapartaiperkecamatan),
            'labelspartaiperdapil' => array_values($labelspartaiperdapil),
            'datapartaiperdapil' => array_values($datapartaiperdapil)
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTotalVoteRequest $request)
    {
        $pilihkandidattps = $request->input('pilihkandidattps');
        $pilihkandidatdesa = $request->input('pilihkandidatdesa');
        $pilihkandidatkecamatan = $request->input('pilihkandidatkecamatan');
        $pilihkandidatdapil = $request->input('pilihkandidatdapil');
        $pilihtps = $request->input('pilihtps');
        $pilihdesa = $request->input('pilihdesa');
        $pilihkecamatan = $request->input('pilihkecamatan');
        $pilihdapil = $request->input('pilihdapil');
        $listtps = DB::table('voting_places')->get();
        $listdesa = DB::table('sub_districts')->get();
        $listkecamatan = DB::table('districts')->get();
        $listdapil = DB::table('electoral_districts')->get();

        if ($pilihkandidattps != null) {
            $idkandidattpspilihan = $pilihkandidattps;
        } else {
            if (!empty($listtps) && isset($listtps[0]->id)) {
                $idkandidattpspilihan = $listtps[0]->id;
            } else {
                $idkandidattpspilihan = 1;
            }
        }

        if ($pilihkandidatdesa != null) {
            $idkandidatdesapilihan = $pilihkandidatdesa;
        } else {
            if (!empty($listdesa) && isset($listdesa[0]->id)) {
                $idkandidatdesapilihan = $listdesa[0]->id;
            } else {
                $idkandidatdesapilihan = 1;
            }
        }

        if ($pilihkandidatkecamatan != null) {
            $idkandidatkecamatanpilihan = $pilihkandidatkecamatan;
        } else {
            if (!empty($listkecamatan) && isset($listkecamatan[0]->id)) {
                $idkandidatkecamatanpilihan = $listkecamatan[0]->id;
            } else {
                $idkandidatkecamatanpilihan = 1;
            }
        }

        if ($pilihkandidatdapil != null) {
            $idkandidatdapilpilihan = $pilihkandidatdapil;
        } else {
            if (!empty($listdapil) && isset($listdapil[0]->id)) {
                $idkandidatdapilpilihan = $listdapil[0]->id;
            } else {
                $idkandidatdapilpilihan = 1;
            }
        }

        if ($pilihtps != null) {
            $idtpspilihan = $pilihtps;
        } else {
            if (!empty($listtps) && isset($listtps[0]->id)) {
                $idtpspilihan = $listtps[0]->id;
            } else {
                $idtpspilihan = 1;
            }
        }

        if ($pilihdesa != null) {
            $iddesapilihan = $pilihdesa;
        } else {
            if (!empty($listdesa) && isset($listdesa[0]->id)) {
                $iddesapilihan = $listdesa[0]->id;
            } else {
                $iddesapilihan = 1;
            }
        }

        if ($pilihkecamatan != null) {
            $idkecamatanpilihan = $pilihkecamatan;
        } else {
            if (!empty($listkecamatan) && isset($listkecamatan[0]->id)) {
                $idkecamatanpilihan = $listkecamatan[0]->id;
            } else {
                $idkecamatanpilihan = 1;
            }
        }

        if ($pilihdapil != null) {
            $iddapilpilihan = $pilihdapil;
        } else {
            if (!empty($listdapil) && isset($listdapil[0]->id)) {
                $iddapilpilihan = $listdapil[0]->id;
            } else {
                $iddapilpilihan = 1;
            }
        }

        $candidatevotestps = DB::table('candidate_votes')->select('candidate_votes.candidate_vote_vote_count', 'candidates.candidate_name')->join('voting_places', 'candidate_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->join('candidates', 'candidate_votes.id_candidate', '=', 'candidates.candidate_encrypted_id')->where('voting_places.id', $idkandidattpspilihan)->get();
        $candidatevotesdesa = DB::table('candidate_votes')->select(DB::raw('SUM(candidate_votes.candidate_vote_vote_count) as total_vote_count'), 'candidates.candidate_name')->groupBy('candidates.candidate_encrypted_id')->join('voting_places', 'candidate_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->join('sub_districts', 'voting_places.id_sub_district', '=', 'sub_districts.sub_district_encrypted_id')->join('candidates', 'candidate_votes.id_candidate', '=', 'candidates.candidate_encrypted_id')->where('sub_districts.id', $idkandidatdesapilihan)->get();
        $candidatevoteskecamatan = DB::table('candidate_votes')->select(DB::raw('SUM(candidate_votes.candidate_vote_vote_count) as total_vote_count'), 'candidates.candidate_name')->groupBy('candidates.candidate_encrypted_id')->join('voting_places', 'candidate_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->join('sub_districts', 'voting_places.id_sub_district', '=', 'sub_districts.sub_district_encrypted_id')->join('districts', 'sub_districts.id_district', '=', 'districts.district_encrypted_id')->join('candidates', 'candidate_votes.id_candidate', '=', 'candidates.candidate_encrypted_id')->where('districts.id', $idkandidatkecamatanpilihan)->get();
        $candidatevotesdapil = DB::table('candidate_votes')->select(DB::raw('SUM(candidate_votes.candidate_vote_vote_count) as total_vote_count'), 'candidates.candidate_name')->groupBy('candidates.candidate_encrypted_id')->join('voting_places', 'candidate_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->join('electoral_districts', 'voting_places.id_electoral_district', '=', 'electoral_districts.electoral_district_encrypted_id')->join('candidates', 'candidate_votes.id_candidate', '=', 'candidates.candidate_encrypted_id')->where('electoral_districts.id', $idkandidatdapilpilihan)->get();
        $partyvotestps = DB::table('total_votes')->select('total_votes.total_vote_vote_count', 'parties.party_name')->join('parties', 'total_votes.id_party', '=', 'parties.party_encrypted_id')->join('voting_places', 'total_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->where('voting_places.id', $idtpspilihan)->get();
        $partyvotesdesa = DB::table('total_votes')->select(DB::raw('SUM(total_votes.total_vote_vote_count) as total_vote_count'), 'parties.party_name')->groupBy('parties.party_encrypted_id')->join('parties', 'total_votes.id_party', '=', 'parties.party_encrypted_id')->join('voting_places', 'total_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->join('sub_districts', 'voting_places.id_sub_district', '=', 'sub_districts.sub_district_encrypted_id')->where('sub_districts.id', $iddesapilihan)->get();
        $partyvoteskecamatan = DB::table('total_votes')->select(DB::raw('SUM(total_votes.total_vote_vote_count) as total_vote_count'), 'parties.party_name')->groupBy('parties.party_encrypted_id')->join('parties', 'total_votes.id_party', '=', 'parties.party_encrypted_id')->join('voting_places', 'total_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->join('sub_districts', 'voting_places.id_sub_district', '=', 'sub_districts.sub_district_encrypted_id')->join('districts', 'sub_districts.id_district', '=', 'districts.district_encrypted_id')->where('districts.id', $idkecamatanpilihan)->get();
        $partyvotesdapil = DB::table('total_votes')->select(DB::raw('SUM(total_votes.total_vote_vote_count) as total_vote_count'), 'parties.party_name')->groupBy('parties.party_encrypted_id')->join('parties', 'total_votes.id_party', '=', 'parties.party_encrypted_id')->join('voting_places', 'total_votes.id_voting_place', '=', 'voting_places.voting_place_encrypted_id')->join('electoral_districts', 'voting_places.id_electoral_district', '=', 'electoral_districts.electoral_district_encrypted_id')->where('electoral_districts.id', $iddapilpilihan)->get();
        $tampilnamakandidattps = DB::table('voting_places')->where('id', $idkandidattpspilihan)->first();
        $tampilnamakandidatdesa = DB::table('sub_districts')->where('id', $idkandidatdesapilihan)->first();
        $tampilnamakandidatkecamatan = DB::table('districts')->where('id', $idkandidatkecamatanpilihan)->first();
        $tampilnamakandidatdapil = DB::table('electoral_districts')->where('id', $idkandidatdapilpilihan)->first();
        $tampilnamatps = DB::table('voting_places')->where('id', $idtpspilihan)->first();
        $tampilnamadesa = DB::table('sub_districts')->where('id', $iddesapilihan)->first();
        $tampilnamakecamatan = DB::table('districts')->where('id', $idkecamatanpilihan)->first();
        $tampilnamadapil = DB::table('electoral_districts')->where('id', $iddapilpilihan)->first();

        $labelspertps = [];
        $datapertps = [];
        $labelsperdesa = [];
        $dataperdesa = [];
        $labelsperkecamatan = [];
        $dataperkecamatan = [];
        $labelsperdapil = [];
        $dataperdapil = [];
        $labelspartaipertps = [];
        $datapartaipertps = [];
        $labelspartaiperdesa = [];
        $datapartaiperdesa = [];
        $labelspartaiperkecamatan = [];
        $datapartaiperkecamatan = [];
        $labelspartaiperdapil = [];
        $datapartaiperdapil = [];

        foreach ($candidatevotestps as $tpsdata) {
            $labelspertps[] = $tpsdata->candidate_name;
            $datapertps[] = (int)$tpsdata->candidate_vote_vote_count;
        }

        foreach ($candidatevotesdesa as $desadata) {
            $labelsperdesa[] = $desadata->candidate_name;
            $dataperdesa[] = (int)$desadata->total_vote_count;
        }

        foreach ($candidatevoteskecamatan as $kecamatandata) {
            $labelsperkecamatan[] = $kecamatandata->candidate_name;
            $dataperkecamatan[] = (int)$kecamatandata->total_vote_count;
        }

        foreach ($candidatevotesdapil as $dapildata) {
            $labelsperdapil[] = $dapildata->candidate_name;
            $dataperdapil[] = (int)$dapildata->total_vote_count;
        }

        foreach ($partyvotestps as $partaitpsdata) {
            $labelspartaipertps[] = $partaitpsdata->party_name;
            $datapartaipertps[] = (int)$partaitpsdata->total_vote_vote_count;
        }

        foreach ($partyvotesdesa as $partaidesadata) {
            $labelspartaiperdesa[] = $partaidesadata->party_name;
            $datapartaiperdesa[] = (int)$partaidesadata->total_vote_count;
        }

        foreach ($partyvoteskecamatan as $partaikecamatandata) {
            $labelspartaiperkecamatan[] = $partaikecamatandata->party_name;
            $datapartaiperkecamatan[] = (int)$partaikecamatandata->total_vote_count;
        }

        foreach ($partyvotesdapil as $partaidapildata) {
            $labelspartaiperdapil[] = $partaidapildata->party_name;
            $datapartaiperdapil[] = (int)$partaidapildata->total_vote_count;
        }
        return view('templating.admin-view.perolehan-suara.index', [
            'listtps' => $listtps,
            'listdesa' => $listdesa,
            'listkecamatan' => $listkecamatan,
            'listdapil' => $listdapil,
            'tampilnamakandidattps' => $tampilnamakandidattps,
            'tampilnamakandidatdesa' => $tampilnamakandidatdesa,
            'tampilnamakandidatkecamatan' => $tampilnamakandidatkecamatan,
            'tampilnamakandidatdapil' => $tampilnamakandidatdapil,
            'tampilnamatps' => $tampilnamatps,
            'tampilnamadesa' => $tampilnamadesa,
            'tampilnamakecamatan' => $tampilnamakecamatan,
            'tampilnamadapil' => $tampilnamadapil,
            'labelspertps' => array_values($labelspertps),
            'datapertps' => array_values($datapertps),
            'labelsperdesa' => array_values($labelsperdesa),
            'dataperdesa' => array_values($dataperdesa),
            'labelsperkecamatan' => array_values($labelsperkecamatan),
            'dataperkecamatan' => array_values($dataperkecamatan),
            'labelsperdapil' => array_values($labelsperdapil),
            'dataperdapil' => array_values($dataperdapil),
            'labelspartaipertps' => array_values($labelspartaipertps),
            'datapartaipertps' => array_values($datapartaipertps),
            'labelspartaiperdesa' => array_values($labelspartaiperdesa),
            'datapartaiperdesa' => array_values($datapartaiperdesa),
            'labelspartaiperkecamatan' => array_values($labelspartaiperkecamatan),
            'datapartaiperkecamatan' => array_values($datapartaiperkecamatan),
            'labelspartaiperdapil' => array_values($labelspartaiperdapil),
            'datapartaiperdapil' => array_values($datapartaiperdapil)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(TotalVote $totalVote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TotalVote $totalVote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTotalVoteRequest $request, TotalVote $totalVote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TotalVote $totalVote)
    {
        //
    }
}
