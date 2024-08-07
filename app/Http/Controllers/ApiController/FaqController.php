<?php
namespace App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faq = Faq::all();
        return $this->responseService->success_response($faq);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $faq = Faq::create($request->toArray());
        return $this->responseService->success_response($faq);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function show(Request $request,$id)
    {
        $faq = Faq::find($id);
        if(!$faq) {
            return response()->json(['message' => 'Faq not found'], 404);
        }
        return $this->responseService->success_response($faq);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $faq = Faq::find($id);
        if(!$faq) {
            return $this->responseService->notFound_response();
        }
        $faq->update($request->all());
        return $this->responseService->success_response($faq);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $faq = Faq::find($id);
        if(!$faq) {
            return $this->responseService->notFound_response();
        }
        $faq->delete();
        return $this->responseService->success_response();

    }
}
