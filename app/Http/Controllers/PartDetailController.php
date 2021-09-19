<?php
/**
 * @author Yogesh Gholap
 * @email yagholap@gmail.com
 * @create date 2021-09-19
 * @modify date 2021-09-19
 * @desc [description]
*/

namespace App\Http\Controllers;

use App\Models\PartDetail;
use App\Models\SectionParameter;
use App\Models\TechRequirement;
use Illuminate\Http\Request;

class PartDetailController extends Controller
{
    public function partDetails()
    {
        $partDetails = PartDetail::all();
        return view('admin.part-details.index', compact('partDetails'))->with(['i' => 0]);
    }

    public function partDetailsEdit($id)
    {
        $part = PartDetail::whereId($id)
        ->with(['techReqs' => function ($techReqs) {
            $techReqs->with(['section']);
        }])->first();

        $techReqs = PartDetail::whereHas('techReqs')
        ->with(['techReqs'])
        ->get();
        return view('admin.part-details.edit-add', compact('part', 'techReqs'));
    }

    public function partDetailsUpdate(Request $request)
    {
        TechRequirement::wherePartDetailId($request->part_detail_id)->delete();
        foreach ($request->section as $key => $section) {
            $parameters = [];
            if ($section['section_type'][0] === '1') {
                foreach ($section['specs'] as $key => $value) {
                    $tempArr = [];
                    $tempArr[$section['params'][$key]] = [
                        'specs' => $value,
                        'test_method' => $section['testMethod'][$key],
                    ];
                    array_push($parameters, $tempArr);
                }
                $techReq = new TechRequirement();
                $techReq->user_id = auth()->user()->id;
                $techReq->section_id = $section['section_id'][0];
                $techReq->part_detail_id = $request->part_detail_id;
                $techReq->section_name = $section['section_name'][0];
                $techReq->sequence = $section['sequence'][0];
                $techReq->parameters = json_encode($parameters);
                $techReq->save();
            } else {
                foreach ($section['min'] as $key => $value) {
                    $tempArr = [];
                    $tempArr[$section['elements'][$key]] = [
                        'min' => $value,
                        'max' => $section['max'][$key],
                    ];
                    array_push($parameters, $tempArr);
                }
                $techReq = new TechRequirement();
                $techReq->user_id = auth()->user()->id;
                $techReq->part_detail_id = $request->part_detail_id;
                $techReq->section_id = $section['section_id'][0];
                $techReq->section_name = $section['section_name'][0];
                $techReq->sequence = $section['sequence'][0];
                $techReq->parameters = json_encode($parameters);
                $techReq->save();
            }
        }
        return redirect()->route('part-details.index');
    }

    public function sectionFields($sectionId)
    {
        return SectionParameter::whereSectionId($sectionId)->get();
    }

    public function techReq($part_detail_id)
    {
        return TechRequirement::wherePartDetailId($part_detail_id)->with('section')->get();
    }
}
