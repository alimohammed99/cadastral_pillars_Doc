<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\PillarInformation;

use Illuminate\Support\Facades\Storage;

class AdminController extends Controller {

    public function categories() {
        $categories = Category::orderBy( 'category_name', 'asc' )->get();
        return view( 'admin.categories', compact( 'categories' ) );
    }

    public function store_category( Request $request ) {
        $request->validate( [
            'category_name' => 'required|string|max:255',
        ] );

        Category::create( [
            'category_name' => $request->category_name,
        ] );

        return redirect()->back()->with( 'success', 'Category added successfully!' );
    }

    // Update category

    public function update_category( Request $request, $categoryId ) {
        $request->validate( [
            'category_name' => 'required|string|max:255',
        ] );

        $category = Category::findOrFail( $categoryId );
        $category->update( [
            'category_name' => $request->category_name,
        ] );

        return redirect()->route( 'categories' )->with( 'success', 'Category updated successfully.' );
    }

    // Delete category

    public function delete_category( $categoryId ) {
        // Retrieve the category
        $category = Category::findOrFail( $categoryId );

        // Delete all pillars associated with the category
        $category->pillars()->delete();

        // Delete the category itself
        $category->delete();

        return redirect()->route( 'categories' )->with( 'success', 'Category deleted successfully.' );
    }

    public function pillars( Request $request ) {
        $categories = Category::all();
        $selectedCategoryId = $request->input( 'category_id' );
        $selectedCategory = $selectedCategoryId ? Category::find( $selectedCategoryId ) : null;

        // Use pagination instead of fetching all records
        $pillars = $selectedCategory
        ? PillarInformation::where( 'category_id', $selectedCategory->id )->paginate( 10 ) // 10 items per page
        : collect();
        // Empty collection for initial load

        return view( 'admin.pillars', compact( 'categories', 'pillars', 'selectedCategory' ) );
    }

    public function showCategoryPillars( $categoryId ) {
        $category = Category::find( $categoryId );
        $pillars = PillarInformation::where( 'category_id', $categoryId )->paginate( 10 );
        // Use pagination
        $categories = Category::all();

        return view( 'admin.pillars_category_page', compact( 'category', 'pillars', 'categories' ) );
    }

    public function viewCategory( $pillarId ) {
        $pillar = PillarInformation::findOrFail( $pillarId );
        $categories = Category::all();
        // To show other categories if needed
        return view( 'admin.pillars_category_page', compact( 'pillar', 'categories' ) );
    }

    public function store_pillar( Request $request ) {
        try {
            $coordsRule = [ 'required', 'string', 'regex:/^\s*-?\d+(\.\d+)?(\s*,\s*-?\d+(\.\d+)?)*\s*$/' ];
            $pillarNumRule = [ 'required', 'string', 'regex:/^[^,]+(\s*,\s*[^,]+)*$/' ];

            $validated = $request->validate( [
                'category_id'   => 'required|exists:categories,id',
                'plan_number'   => 'required|string|max:255',
                'name'          => 'required|string|max:255',
                'unit'          => 'nullable|string|max:255',
                'location'      => 'required|string|max:255',
                'survey'        => 'nullable|string|max:255',
                'pillar_number' => $pillarNumRule,
                'eastings'      => $coordsRule,
                'northings'     => $coordsRule,
                'origin'        => $pillarNumRule,
                'height'        => 'nullable|numeric',
                'remarks'       => 'nullable|string',
                'plan_document' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            ], [
                'regex' => 'The :attribute format is invalid. Please ensure it is a proper comma-separated list.',
            ], [
                'pillar_number' => 'Serial Indices',
                'eastings'      => 'Eastings Matrix',
                'northings'     => 'Northings Matrix',
                'origin'        => 'Origin Matrix',
            ] );

            // Clean whitespace around commas
            $validated[ 'pillar_number' ] = preg_replace( '/\s*,\s*/', ',', trim( $validated[ 'pillar_number' ] ) );
            $validated[ 'eastings' ]  = preg_replace( '/\s*,\s*/', ',', trim( $validated[ 'eastings' ] ) );
            $validated[ 'northings' ] = preg_replace( '/\s*,\s*/', ',', trim( $validated[ 'northings' ] ) );
            $validated[ 'origin' ]    = preg_replace( '/\s*,\s*/', ',', trim( $validated[ 'origin' ] ) );

            // Validate matching counts
            $pCount = count(explode(',', $validated['pillar_number']));
            $eCount = count(explode(',', $validated['eastings']));
            $nCount = count(explode(',', $validated['northings']));
            $oCount = count(explode(',', $validated['origin']));

            if ($pCount !== $eCount || $pCount !== $nCount || $pCount !== $oCount) {
                return redirect()->back()
                    ->withErrors(['pillar_number' => "Data mismatch: You provided $pCount Pillar Numbers, $eCount Eastings, $nCount Northings, and $oCount Origins. Counts must be equal."])
                    ->withInput()
                    ->with('open_modal', 'addPillarModal');
            }

            if ( $request->hasFile( 'plan_document' ) ) {
                $path = $request->file( 'plan_document' )->store( 'pillars', 'public' );
                $validated[ 'plan_document' ] = $path;
            }

            PillarInformation::create( $validated );

            return redirect()->back()->with( 'success', 'Pillar added successfully.' );
        } catch ( \Illuminate\Validation\ValidationException $e ) {
            return redirect()->back()
            ->withErrors( $e->validator )
            ->withInput()
            ->with( 'open_modal', 'addPillarModal' );
        }
    }

    public function update_pillar( Request $request, $pillar ) {
        try {
            $coordsRule = [ 'required', 'string', 'regex:/^\s*-?\d+(\.\d+)?(\s*,\s*-?\d+(\.\d+)?)*\s*$/' ];
            $pillarNumRule = [ 'required', 'string', 'regex:/^[^,]+(\s*,\s*[^,]+)*$/' ];

            $validated = $request->validate( [
                'category_id'   => 'required|exists:categories,id',
                'plan_number'   => 'required|string|max:255',
                'name'          => 'required|string|max:255',
                'unit'          => 'nullable|string|max:255',
                'location'      => 'required|string|max:255',
                'survey'        => 'nullable|string|max:255',
                'pillar_number' => $pillarNumRule,
                'eastings'      => $coordsRule,
                'northings'     => $coordsRule,
                'origin'        => $pillarNumRule,
                'height'        => 'nullable|numeric',
                'remarks'       => 'nullable|string',
                'plan_document' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            ], [
                'regex' => 'The :attribute format is invalid. Please ensure it is a proper comma-separated list.',
            ], [
                'pillar_number' => 'Serial Indices',
                'eastings'      => 'Eastings Matrix',
                'northings'     => 'Northings Matrix',
                'origin'        => 'Origin Matrix',
            ] );

            $validated[ 'pillar_number' ] = preg_replace( '/\s*,\s*/', ',', trim( $validated[ 'pillar_number' ] ) );
            $validated[ 'eastings' ]  = preg_replace( '/\s*,\s*/', ',', trim( $validated[ 'eastings' ] ) );
            $validated[ 'northings' ] = preg_replace( '/\s*,\s*/', ',', trim( $validated[ 'northings' ] ) );
            $validated[ 'origin' ]    = preg_replace( '/\s*,\s*/', ',', trim( $validated[ 'origin' ] ) );

            // Validate matching counts
            $pCount = count(explode(',', $validated['pillar_number']));
            $eCount = count(explode(',', $validated['eastings']));
            $nCount = count(explode(',', $validated['northings']));
            $oCount = count(explode(',', $validated['origin']));

            if ($pCount !== $eCount || $pCount !== $nCount || $pCount !== $oCount) {
                return redirect()->back()
                    ->withErrors(['pillar_number' => "Data mismatch: You provided $pCount Pillar Numbers, $eCount Eastings, $nCount Northings, and $oCount Origins. Counts must be equal."])
                    ->withInput()
                    ->with('open_modal', 'editPillarModal-' . $pillar);
            }

            $pillarModel = PillarInformation::findOrFail( $pillar );

            if ( $request->hasFile( 'plan_document' ) ) {
                if ( !empty( $pillarModel->plan_document ) && Storage::disk( 'public' )->exists( $pillarModel->plan_document ) ) {
                    Storage::disk( 'public' )->delete( $pillarModel->plan_document );
                }

                $path = $request->file( 'plan_document' )->store( 'pillars', 'public' );
                $validated[ 'plan_document' ] = $path;
            } else {
                unset($validated['plan_document']);
            }

            $pillarModel->update( $validated );

            return redirect()->back()->with( 'success', 'Pillar updated successfully.' );
        } catch ( \Illuminate\Validation\ValidationException $e ) {
            return redirect()->back()
            ->withErrors( $e->validator )
            ->withInput()
            ->with( 'open_modal', 'editPillarModal-' . $pillar );
        }
    }

    public function delete_pillar( $pillar ) {
        $pillar = PillarInformation::find( $pillar );
        $pillar->delete();
        return redirect()->back()->with( 'success', 'Pillar deleted successfully.' );
    }
}
