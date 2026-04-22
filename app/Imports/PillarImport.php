<?php

namespace App\Imports;

use App\Models\PillarInformation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PillarImport implements ToModel, WithHeadingRow {
    protected $categoryId;

    public function __construct( $categoryId ) {
        $this->categoryId = $categoryId;
    }

    public function model( array $row ) {
        $row = array_change_key_case( $row, CASE_LOWER );

        $get = function ( array $keys ) use ( $row ) {
            foreach ( $keys as $k ) {
                // Normalize key: convert to lowercase and replace spaces/special chars with underscores
                // This mimics how Laravel Excel slugifies headers like "Easting(m)" to "easting_m"
                $slug = str_replace([' ', '.', '(', ')', '/', '\\'], '_', strtolower($k));
                $slug = preg_replace('/__+/', '_', $slug); // Remove double underscores
                $slug = trim($slug, '_');

                if ( isset( $row[ $slug ] ) && $row[ $slug ] !== null && $row[ $slug ] !== '' ) {
                    return $row[ $slug ];
                }
            }
            return null;
        }
        ;

        return new PillarInformation( [
            'category_id'   => $this->categoryId,

            'plan_number'   => $get( [ 'plan_number', 'plan_no', 'plan_num', 'plan_number_' ] ),
            'plan_document' => $get(['plan_document', 'plan document', 'plan', 'plan_file', 'plan file']),
            'name'          => $get( [ 'name', 'names', 'pillar_name' ] ),
            'unit'          => $get( [ 'unit' ] ),
            'location'      => $get( [ 'location', 'locality' ] ),
            'survey'        => $get( [ 'survey' ] ),

            'pillar_number' => $get( [ 'pillar_number', 'pillar_no', 'pillar_num', 'pillar_no_' ] ),
            'eastings'      => $get( [ 'eastings', 'easting', 'easting_m', 'm_easting', 'eastings_m' ] ),
            'northings'     => $get( [ 'northings', 'northing', 'northing_m', 'm_northing', 'northings_m' ] ),

            'origin'        => $get( [ 'origin' ] ),
            'height'        => $get( [ 'height' ] ),
            'remarks'       => $get( [ 'remarks', 'remark' ] ),
        ] );
    }
}
