<?php

namespace App\Http\Controllers\Package;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package\Package;
use Illuminate\Database\QueryException;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'country_id' => 'required|exists:countries,id',
                'thumbnail' => 'required|string',
                'is_starting_price' => 'required|boolean',
                'is_day_night' => 'required|boolean',
                'starting_price' => 'nullable|required_if:is_starting_price,true|numeric',
                'day' => 'nullable|required_if:is_day_night,true|integer',
                'night' => 'nullable|required_if:is_day_night,true|integer',
            ]);

            // Create a new instance of your model and fill it with the validated data
            $tourPackage = new Package();
            $tourPackage->country_id = $validatedData['country_id'];
            $tourPackage->thumbnail = $validatedData['thumbnail'];
            $tourPackage->is_starting_price = $validatedData['is_starting_price'];
            $tourPackage->is_day_night = $validatedData['is_day_night'];

            // Insert starting_price only if is_starting_price is true
            if ($validatedData['is_starting_price']) {
                $tourPackage->starting_price = $validatedData['starting_price'];
            }

            // Insert day and night values only if is_day_night is true
            if ($validatedData['is_day_night']) {
                $tourPackage->day = $validatedData['day'];
                $tourPackage->night = $validatedData['night'];
            }

            // Save the new record to the database
            $tourPackage->save();

            return response()->json(['message' => 'Tour package created successfully'], 201);
        } catch (QueryException $e) {
            // Handle database query exceptions
            return response()->json(['message' => 'Database error: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            // Handle other general exceptions
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $getSingleData = Package::findOrFail($id);
            return view('backend.package.edit', compact('getSingleData'));
        } catch (\Exception $e) {
            // Handle the exception, such as logging or returning an error response
            return redirect()->back()->with('error', 'Error: Record not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $deleteSingleData = Package::destroy($id);
            $deleteMessage = "The Package has been deleted successfully";

            // Redirect back to the edit page with a success message
            return redirect()->route('package.edit', ['id' => $id])->withSuccess($deleteMessage);
        } catch (\Exception $e) {
            // Handle the exception, such as logging or returning an error response
            return redirect()->route('package.edit', ['id' => $id])->withError('An error occurred while deleting the package.');
        }
    }
}
