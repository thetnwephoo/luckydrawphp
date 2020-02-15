<?php
 
// DataTables PHP library
include( "../../php/DataTables.php" );
 
// Alias Editor classes so they are easy to use
use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Options,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate,
    DataTables\Editor\ValidateOptions;
 
 
/*
 * Example PHP implementation used for the join.html example
 */
// Editor::inst( $db, 'lucky_numbers' )
//     ->field(
//         Field::inst( 'lucky_numbers.first_name' ),
//         Field::inst( 'lucky_numbers.last_name' ),
//         Field::inst( 'lucky_numbers.site' )
//             ->options( Options::inst()
//                 ->table( 'sites' )
//                 ->value( 'id' )
//                 ->label( 'name' )
//             ),
//         Field::inst( 'sites.name' )
//     )
//     ->leftJoin( 'sites', 'sites.id', '=', 'lucky_numbers.site' )
//     ->join(
//         Mjoin::inst( 'permission' )
//             ->link( 'lucky_numbers.id', 'user_permission.user_id' )
//             ->link( 'permission.id', 'user_permission.permission_id' )
//             ->order( 'name asc' )
//             ->fields(
//                 Field::inst( 'id' )
//                     ->validator( Validate::required() )
//                     ->options( Options::inst()
//                         ->table( 'permission' )
//                         ->value( 'id' )
//                         ->label( 'name' )
//                     ),
//                 Field::inst( 'name' )
//             )
//     )
//     ->process($_POST)
//     ->json();

    Editor::inst( $db, 'lucky_numbers' )
    ->field( 
      Field::inst('lucky_numbers.id'),
      Field::inst('lucky_numbers.lucky_number'),
      Field::inst('lucky_numbers.customer_id')

    )
    ->innerjoin(
        Mjoin::inst( 'customers' )
            ->link('customers.id','lucky_numbers.id')
            ->fields( 
              Field::inst('customers.id'),
              Field::inst('customers.name')
             )
    )
    ->process($_POST)
    ->json();
