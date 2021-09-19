<?php
/**
 * ==================================================================================================
 * @author Yogesh Gholap
 * @email yagholap@gmail.com
 * @create date 2021-09-19
 * @modify date 2021-09-19
 * @desc [description]
 * ==================================================================================================
 */

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
        $metReq = MetRequirement::wherePartDetailId($request->part_detail_id)->first();
        if ($metReq) {
            $metReq->final_values = json_encode($tempArr);
        } else {
            $metReq = new MetRequirement();
            $metReq->user_id = auth()->user()->id;
            $metReq->part_detail_id = $request->part_detail_id;
        }

        try {
            $metReq->save();
        } catch (\Throwable $th) {
            //log the error
        }
        return redirect()->route('met-requirements.index');
    }

    public function metRequirementsShow($part_detail_id)
    {
        $metDetails = MetRequirement::whereId($part_detail_id)
        ->with(['partDetail'])
        ->first();

        return view('admin.met-requirements.show', compact('metDetails'));
    }
}
