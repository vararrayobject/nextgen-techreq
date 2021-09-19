<?php

namespace App\Http\Controllers;

use App\Models\PartDetail;
use App\Models\MetRequirement;
use Illuminate\Http\Request;


class MetRequirementController extends Controller
{
    public function metRequirements()
    {
        $metRequirements = PartDetail::whereHas('techReqs')->with(['techReqs', 'metReqs'])->get();
        return view('admin.met-requirements.index', compact('metRequirements'))->with(['i' => 0]);
    }

    public function metRequirementsEdit($id)
    {
        $part = PartDetail::whereId($id)
        ->with(['techReqs' => function ($techReqs) {
            $techReqs->with(['section']);
        }])->first();

        return view('admin.met-requirements.edit-add', compact('part'));
    }

    public function metRequirementsUpdate(Request $request)
    {
        $tempArr = [];
        foreach ($request->section as $key => $section) {
            $sectionNameArr = [];
            $sectionNameArr = [
                'section_id' => $section['section_id'][0],
                'sequence' => $section['sequence'][0],
                'section_type' => $section['section_type'][0],
                'section_name' => $section['section_name'][0]
            ];
            
            if ($section['section_type'][0] === '1') {
                foreach ($section['specs'] as $key => $value) {
                    $sectionNameArr['fields'][$section['params'][$key]] = [
                        'specs' => $value,
                        'test_method' => $section['testMethod'][$key],
                        'observations' => $section['observations'][$key],
                    ];
                }
                array_push($tempArr, $sectionNameArr);
            } else {
                foreach ($section['min'] as $key => $value) {
                    $sectionNameArr['fields'][$section['elements'][$key]] = [
                        'min' => $value,
                        'max' => $section['max'][$key],
                        'actuals' => $section['actuals'][$key],
                    ];
                }
                array_push($tempArr, $sectionNameArr);
            }
        }
        $techReq = new MetRequirement();
        $techReq->user_id = auth()->user()->id;
        $techReq->part_detail_id = $request->part_detail_id;
        $techReq->final_values = json_encode($tempArr);
        $techReq->save();
        return redirect()->route('met-requirements.index');
    }

    public function metRequirementsShow($part_detail_id)
    {
        $part = PartDetail::whereId($part_detail_id)
        ->with(['techReqs' => function ($techReqs) {
            $techReqs->with(['section']);
        }])->first();

        return view('admin.met-requirements.edit-add', compact('part'));
    }
}
